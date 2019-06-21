<?php
/**
 * Created by PhpStorm.
 * User: Fred
 * Date: 4/30/18
 * Time: 11:30 AM
 */

class tsl_puppies_direct_cron
{

    public $url = "http://api.petkey.org/v4/partners/";
    public $new_puppies;
    private $json_reponse;
    private $this_current_key;
    private $debug;

    public function update_inventory()
    {

        set_time_limit ( 300 );
        $this->new_puppies = array();

        $api_array = get_option('pd_apikey');

        $all_pet_data = array();

        $last_key = get_option('tsl_pd_last_key');

        if(!$last_key) $last_key = 0;

        if($last_key >= sizeof($api_array)) $last_key = 0;

        $key = $api_array[$last_key];

        $this->json_reponse[] = $last_key;

        $response = wp_remote_post($this->url .'search', array(
                'method' => 'POST',
                'timeout' => 45,
                'redirection' => 5,
                'httpversion' => '1.0',
                'blocking' => true,
                'headers' => array('Authorization' => 'PETKEY-AUTH ' . $key),
                'body' => array('dataType' => 'json', 'contentType' => "application/json", 'processdata' => false, 'Status' => 'available'),
                'cookies' => array()
            )
        );

        if (is_wp_error($response)) {
            $this->json_reponse[] = $response->get_error_message();
        } else {
            $data = json_decode(wp_remote_retrieve_body($response), true);

            $this->this_current_key = $key;
            $this->json_reponse[] = $key;

            foreach ($data as $pet) {
                $pet['apikey'] = $key;
                $all_pet_data[] = $pet;
            }
        }

        $this->delete_trash();
        //echo '<pre>'; print_r($all_pet_data);
        $this->update_pet_inventory( $all_pet_data );
        $this->remove_pet_inventory( $all_pet_data );
        $this->update_pricing();

        $last_key++;

        update_option( 'tsl_pd_last_key' , $last_key );

        return $this->json_reponse;
    }

    function delete_trash(){

        $args = array(
            'numberposts' => -1,
            'post_type' => 'product',
            'post_status' => 'trash'
        );

        $args['meta_query'][] = array( 'key' => '_pdm_pet_product', 'value' => 'pet' );

        $pets = get_posts($args);

        foreach( $pets as $pet ) {
//            if( ! get_post_meta( $pet->ID, '_price', true ) && get_post_meta( $pet->ID, '_price', true ) < 1 ) {
                wp_delete_post( $pet->ID ,true );
            }
//        }

    }

    public function remove_pet_inventory( $all_pet_data = array() ){

        if(sizeof($all_pet_data)==0) return;

        $args = array(
            'numberposts' => -1,
            'post_type' => 'product',
            'meta_query' => array(
                array(
                    'key' => '_pdm_pet_product',
                    'value' => 'pet',
                ),
                array(
                    'key' => '_pdm_pet_api_key',
                    'value' => $this->this_current_key,
                )
            )
        );

        $pets = get_posts($args);

        $excluded_breeds = get_option('pd_excluded_breeds');

        foreach( $pets as $pet ){

            $PetId = get_post_meta($pet->ID, '_sku', true );
            $remove_pet = true;

            foreach ($all_pet_data as $this_pet) {

                if( $this_pet['PetId'] == $PetId ){
                    $remove_pet = false;
                }

            }

            $breed = get_post_meta($pet->ID, '_pdm_pet_breed', true);
            if(isset($excluded_breeds[str_replace(' ' , '_',$breed)])){
                $remove_pet = true;
            }

            if( $remove_pet ){
                update_post_meta( $pet->ID, '_pdm_pet_status', 'no' );
                update_post_meta( $pet->ID, '_stock_status', 'outofstock' );
                update_post_meta( $pet->ID, 'out_of_stock_by_pet_key', 'yes' );
/**
                $pet_post = array(
                      'ID'           => $pet->ID,
                      'post_status' => 'draft'
                  );

                // Update the post into the database
                  wp_update_post( $pet_post );
**/

            }
        }
    }

    public function update_pet_inventory( $all_pet_data, $is_cron = true )
    {

        if (!function_exists('wc_get_product_id_by_sku')) return;
        /*echo '<pre>';
        print_r($all_pet_data);
        echo '</pre>';*/
        //exit;

        if($is_cron) {
          $status = 'publish';
          $pdm_pet_product = 'pet';
        } else {
          $status = 'pending';
          $pdm_pet_product = 'breeder';
        }

        foreach ($all_pet_data as $pet) {

            if($is_cron) {
              if (empty($pet['PetId'])) {
                $this->json_reponse[] = 'Skipped: ' . $pet['PetName'];
                continue;
              }

              $product_id = wc_get_product_id_by_sku($pet['PetId']);
            } else {
              if($pet['action'] == 'new') {
                $product_id = false;
              } else {
                $product_id = $pet['product_id'];
              }
            }

            if( empty( $pet['PetName'] )) {
                $pet['PetName'] = $this->randomPetName( $pet['Gender'] );
                if( empty( $pet['PetName'] )) {
                  $pet['PetName'] = $pet['BreedName'];
                }
            }

            if(empty($pet['Description'])){
              $Description = ' ';
            }else{
              $Description = $pet['Description'];
            }

            if (!$product_id) {
                //insert into WooCommerce

                $post = array(
                    //'post_author' > 1,
                    'post_content' => $Description,
                    'post_status' => $status,
                    'post_title' => $pet['PetName'],
                    'post_parent' => '',
                    'post_type' => "product",
                );

                if($is_cron) {
                  $post['post_author'] = 1;
                }

                $product_id = wp_insert_post($post);

                $this->new_puppies[] = $product_id;

                update_post_meta( $product_id, 'pdm_pet_status', 'yes' );
                update_post_meta( $product_id, '_pdm_pet_status', 'yes' );
                update_post_meta( $product_id, '_stock_status', 'instock' );
                update_post_meta( $product_id, '_manage_stock', 'yes');
                update_post_meta( $product_id, '_stock', '1');
                update_post_meta( $product_id, 'out_of_stock_by_pet_key', 'no' );

            }else{
                //if($pet->ID) {
                    $pet_post = array(
                        //'ID' => $pet->ID,
                        'ID' => $product_id,
                        //'post_status' => $status,
                        'post_title' => $pet['PetName'],
                        'post_content' => $Description
                    );

                    wp_update_post($pet_post);

                //}
            }

            update_post_meta($product_id, '_pdm_pet_product', $pdm_pet_product);

            $pet_breed = $pet['BreedName'];
            $pet_categories = $this->pd_woo_manage_category(array('Pets', $pet_breed ));

            wp_set_object_terms( $product_id, $pet_categories, 'product_cat' );

            if(get_post_meta( $product_id, 'out_of_stock_by_pet_key',true)){
                if(get_post_meta( $product_id, 'out_of_stock_by_pet_key',true) == 'yes' ){
                    update_post_meta( $product_id, 'pdm_pet_status', 'yes' );
                    update_post_meta( $product_id, '_pdm_pet_status', 'yes' );
                    update_post_meta( $product_id, '_stock_status', 'instock' );
                    update_post_meta( $product_id, '_manage_stock', 'yes');
                    update_post_meta( $product_id, '_stock', '1');
                    update_post_meta( $product_id, 'out_of_stock_by_pet_key', 'no' );

                }
            }

            $tags = array();

            $tags[] = $pet['Gender'];
            $tags[] = $pet['BreedName'];

            if(isset($pet['BreedName'])) update_post_meta( $product_id, '_pdm_pet_breed', $pet['BreedName'] );
            if(isset($pet['OrgName'])) update_post_meta($product_id, '_pdm_pet_location', $pet['OrgName']);
            if(isset($pet['ReferenceNumber'])) update_post_meta($product_id, '_pdm_pet_ref_no', $pet['ReferenceNumber']);
            if(isset($pet['PetId'])) update_post_meta($product_id, '_sku', $pet['PetId']);
            if(isset($pet['PetName'])){
                update_post_meta($product_id, '_pdm_pet_name', $pet['PetName']);
                $my_post = array(
                  'ID'           => $product_id,
                  'post_title'   => $pet['PetName']
              );

              wp_update_post( $my_post );

            }
            if(isset($pet['Age'])) update_post_meta($product_id, '_pdm_pet_age', $pet['Age']);
            if(isset($pet['BirthDate'])) update_post_meta($product_id, '_pdm_pet_dob', date('m-d-Y', strtotime($pet['BirthDate'])));
            if(isset($pet['Coloring'])) update_post_meta($product_id, '_pdm_pet_markings', $pet['Coloring']);
            if(isset($pet['Weight'])) update_post_meta($product_id, '_pdm_pet_wight', $pet['Weight']);
            if(isset($pet['Gender'])) update_post_meta($product_id, '_pdm_pet_gender', $pet['Gender']);
            if(isset($pet['VideoUrl'])) update_post_meta($product_id, '_pdm_pet_video_url', $pet['VideoUrl']);
            if(isset($pet['Microchip'])) update_post_meta($product_id, '_pdm_pet_microchip_number', $pet['Microchip']);
            update_post_meta($product_id, '_pdm_pet_id', $pet['PetId'] );
            if($is_cron) update_post_meta($product_id, '_pdm_pet_api_key', $pet['apikey'] );
            update_post_meta($product_id, '_sold_individually', 1 );


            if(isset($pet['BreedName'])) update_post_meta( $product_id, 'pdm_pet_breed', $pet['BreedName'] );
            if(isset($pet['OrgName'])) update_post_meta($product_id, 'pdm_pet_location', $pet['OrgName']);
            if(isset($pet['ReferenceNumber'])) update_post_meta($product_id, 'pdm_pet_ref_no', $pet['ReferenceNumber']);
            if(isset($pet['PetName'])) update_post_meta($product_id, 'pdm_pet_name', $pet['PetName']);
            if(isset($pet['Age'])) update_post_meta($product_id, 'pdm_pet_age', $pet['Age']);
            if(isset($pet['BirthDate'])) update_post_meta($product_id, 'pdm_pet_dob', date('m-d-Y', strtotime($pet['BirthDate'])));
            if(isset($pet['Coloring'])) update_post_meta($product_id, 'pdm_pet_markings', $pet['Coloring']);
            if(isset($pet['Weight'])) update_post_meta($product_id, 'pdm_pet_wight', $pet['Weight']);
            if(isset($pet['Gender'])) update_post_meta($product_id, 'pdm_pet_gender', $pet['Gender']);
            if(isset($pet['VideoUrl'])) update_post_meta($product_id, 'pdm_pet_video_url', $pet['VideoUrl']);
            if(isset($pet['Microchip'])) update_post_meta($product_id, 'pdm_pet_microchip_number', $pet['Microchip']);
            update_post_meta($product_id, 'pdm_pet_id', $pet['PetId'] );

            wp_set_object_terms($product_id, $tags, 'product_tag');

            // New fields
            if(isset($pet['ofa_certified'])) update_post_meta($product_id, 'pdm_pet_ofa_certified', $pet['ofa_certified']);
            if(isset($pet['champion'])) update_post_meta($product_id, 'pdm_pet_champion', $pet['champion']);
            if(isset($pet['has_been_shown'])) update_post_meta($product_id, 'pdm_pet_has_been_shown', $pet['has_been_shown']);

            if(!$is_cron && isset($pet['RegistryName'])) {
              update_post_meta( $product_id, '_pdm_pet_registry', $pet['RegistryName']);
              //if (isset($pet['RegistryName'])) update_post_meta( $pet->ID, 'pdm_pet_registry', $pet['RegistryName']);
            }

            // Set vendor
            if(isset($pet['VendorId'])) wp_set_object_terms( $product_id, $pet['VendorId'], WC_PRODUCT_VENDORS_TAXONOMY );

            // add images
            if(!$is_cron && $_FILES['Photo']) {
              $images[] = $this->download_image_to_wp_media_library( $_FILES['Photo']['tmp_name'], $product_id, $_FILES['Photo']['name'], false );
              $this->setImages($images, $product_id);
            }

        }
    }

    function pd_woo_manage_category($required_categories){

        //$parent_term_id = 230; //68;
        $parent_term_id = BREEDS_CATEGORY_ID;

        $pet_categories = [];
        $category = [];

        $cat_args = array(
            'orderby'    => 'name',
            'order'      => 'asc',
            'hide_empty' => false,

        );

        $product_categories = get_terms( 'product_cat', $cat_args );

        if($product_categories) {

            foreach ($product_categories as $product_category) {

                $pet_categories[$product_category->name] = $product_category->term_id;

            }
        }

        for($i=0; $i<count($required_categories);$i++){

            if(isset($pet_categories[$required_categories[$i]])){

                $category[] = $pet_categories[$required_categories[$i]];

                $term_metas = get_option("taxonomy_".$pet_categories[$required_categories[$i]]."_metas");

                if( isset($term_metas['parent_one']) ){
                    $category[] = (int)$term_metas['parent_one'];

                }
                if( isset($term_metas['parent_two']) ){
                    $category[] = (int)$term_metas['parent_two'];
                }

            } else {

                $new_cat_id = wp_insert_term(
                    $required_categories[$i],
                    'product_cat',
                    array(
                        'parent' => $parent_term_id,
                    )

                );

                if (is_wp_error($new_cat_id)) {
                   // print_r($new_cat_id->get_error_message());

                }else {

                    $category[] = $new_cat_id['term_id'];
                }

                if( ! get_option('tsl-pd-breed-'.$required_categories[$i])) {

                    update_option('tsl-pd-breed-'.$required_categories[$i] , '1');

                    $admin_email = get_option('admin_email');

                    wp_mail($admin_email, 'Missing Puppy Category', 'The following breed needs to be added to the list of available categories<br><br>' . $required_categories[$i]);
                }

            }

        }

        return $category;

    }

    function get_breed_category( $cat_array , $category ){

        foreach($cat_array as $index => $cat ){

            if($cat == $category ) return $index;
        }

        return null;
    }

    function randomPetName($gender){

        $male_pet_names = get_option('male_pet_names');
        $female_pet_names = get_option('female_pet_names');

        if ($gender == "Male") {
            if(!$male_pet_names) return 'Bob';
            $petName = explode(",", $male_pet_names);
        } else {
            if(!$female_pet_names) return 'Susan';
            $petName = explode(",", $female_pet_names);
        }

        $randomPetNameKey = array_rand($petName);
        $randomPetName = $petName[$randomPetNameKey];

        return $randomPetName;

    }

    function update_pricing(){

        set_time_limit ( 300 );

        $args = array(
            'numberposts' => -1,
            'post_type' => 'product',
            'meta_query' => array(
                array(
                    'key' => '_pdm_pet_product',
                    'value' => 'pet',
                ),
                array(
                    'key' => '_pdm_pet_api_key',
                    'value' => $this->this_current_key,
                )
            )
        );

        $pets = get_posts($args);

        foreach( $pets as $pet ) {

            $product = wc_get_product( $pet->ID );
            $product_data = $product->get_data();
            $product_pricing = $product_data['pricing'];

            if(!$product_pricing){

                $pet_id = get_post_meta($pet->ID, '_pdm_pet_id', true);
                $key = get_post_meta($pet->ID, '_pdm_pet_api_key', true);

                if($key) {

                    $response = wp_remote_get($this->url . 'Pet/' . $pet_id, array(
                            'method' => 'GET',
                            'timeout' => 45,
                            'redirection' => 5,
                            'httpversion' => '1.0',
                            'blocking' => true,
                            'headers' => array('Authorization' => 'PETKEY-AUTH ' . $key),
                            'body' => array('dataType' => 'json', 'contentType' => "application/json", 'processdata' => false ),
                            'cookies' => array()
                        )
                    );

                    if (is_wp_error($response)) {
                        $error_message = $response->get_error_message();
                    } else {
                        $data = json_decode(wp_remote_retrieve_body($response), true);


                        if (isset($data['RegistryName'])) update_post_meta( $pet->ID, '_pdm_pet_registry', $data['RegistryName']);
                        if (isset($data['RegistryName'])) update_post_meta( $pet->ID, 'pdm_pet_registry', $data['RegistryName']);

                        update_post_meta( $pet->ID, '_price', $data['SalePrice'] );
                        update_post_meta( $pet->ID, '_regular_price', $data['SalePrice'] );

                        if($data['SalePrice'] == 0 ){
/**
                            $pet_post = array(
                                  'ID'           => $pet->ID,
                                  'post_status' => 'draft'
                              );

                              wp_update_post( $pet_post );
 **/

                            update_post_meta( $pet->ID, '_pdm_pet_status', 'no' );
                            update_post_meta( $pet->ID, '_stock_status', 'outofstock' );
                            update_post_meta( $pet->ID, 'out_of_stock_by_pet_key', 'yes' );

                        }

//                        echo get_post_meta( $pet->ID, '_sku', true ) . '<br>';

                        $images = array();

                        //add images
                        if($data['Photo']){
                            $url = $data['Photo']['BaseUrl'] . $data['Photo']['Original'];
                            $images[] = $this->download_image_to_wp_media_library( $url, $pet->ID , $data['Photo']['Original']);
                        }else{
                            $this->json_reponse[] = 'Missing Image: ' . $pet->ID;
                        }


                        $this->setImages($images, $pet->ID);

                        if(isset($data['Breed']['Description'])) {

                            $post = array(
                                'ID' => $pet->ID,
                                'post_content' => $data['Breed']['Description']
                            );

                            wp_update_post($post);

                        }
                    }
                }
            }
        }
    }

    function center_crop_image( $attachment_id , $parent_post_id , $image_id){

        $attachment = wp_get_attachment_image_src( $attachment_id , 'full' );

        if($attachment) {
            $url = $attachment[0];
            $width = $attachment[1];
            $height = $attachment[2];

            $check[] = $attachment;

            if($width ==0 || $height == 0 ) return;

            $aspect = $height / $width;

            $goal_width = 413;
            if(get_option('ps_image_width')){
                $goal_width = get_option('ps_image_width');
            }

            $goal_height = 320;
            if(get_option('ps_image_height')){
                $goal_height = get_option('ps_image_height');
            }

            $goal_aspect = $goal_height / $goal_width;
            $filename_path = null;

            if( $aspect != $goal_aspect ){

                if( $aspect > $goal_aspect ){
                    $new_height = $width * $goal_aspect;
                    $new_width = $width;
                }else{
                    $new_height = $height;
                    $new_width = $height / $goal_aspect;
                }

                $wp_upload_dir = wp_upload_dir();

                if($ext = pathinfo( $url, PATHINFO_EXTENSION) == 'png') {
                    $im = imagecreatefrompng($url );
                    $filename_path = md5(time().uniqid()).".png";

                    imagePng($this->cropAlign($im, $new_width, $new_height, 'center', 'middle'), $wp_upload_dir['path'].'/'.$filename_path);
                }else if($ext = pathinfo( $url, PATHINFO_EXTENSION) == 'jpg') {
                    $im = imagecreatefromjpeg( $url );
                    $filename_path = md5(time().uniqid()).".jpg";

                    imagejpeg($this->cropAlign($im, $new_width, $new_height, 'center', 'middle'), $wp_upload_dir['path'].'/'.$filename_path);
                }

                if($filename_path){

                    $filetype = wp_check_filetype( basename( $filename_path ), null );
                    $attachment = array(
                        'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename_path ),
                        'post_mime_type' => $filetype['type'],
                        'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename_path ) ),
                        'post_content'   => 'Puppy image',
                        'post_status'    => 'inherit',
                        'post_parent' => $parent_post_id
                    );

                    // Insert the attachment.
                    $attachment_id = wp_insert_attachment( $attachment, $wp_upload_dir['path'].'/'.$filename_path, $parent_post_id );

                    if ( ! is_wp_error($attachment_id) ) {

                        // Make sure that this file is included, as wp_generate_attachment_metadata() depends on it.
                        require_once(ABSPATH . 'wp-admin/includes/image.php');

                        // Generate the metadata for the attachment, and update the database record.
                        $attach_data = wp_generate_attachment_metadata($attachment_id, $wp_upload_dir['path'] . '/' . $filename_path);

                        wp_update_attachment_metadata($attachment_id, $attach_data);

                        set_post_thumbnail($parent_post_id, $attachment_id);

//                        $this->json_reponse[] = 'Original: ' . $width . ' - ' . $height . ' New: ' . $new_width . ' - ' . $new_height . ' - ' . $aspect . ' - ' .  $goal_aspect;

                        return $attachment_id;
                    }
                }
            }
        }

        return $attachment_id;

    }

    function cropAlign($image, $cropWidth, $cropHeight, $horizontalAlign = 'center', $verticalAlign = 'middle') {
        $width = imagesx($image);
        $height = imagesy($image);
        $horizontalAlignPixels = $this->calculatePixelsForAlign($width, $cropWidth, $horizontalAlign);
        $verticalAlignPixels = $this->calculatePixelsForAlign($height, $cropHeight, $verticalAlign);

        return imageCrop($image, [
            'x' => $horizontalAlignPixels[0],
            'y' => $verticalAlignPixels[0],
            'width' => $horizontalAlignPixels[1],
            'height' => $verticalAlignPixels[1]
        ]);
    }

    function calculatePixelsForAlign($imageSize, $cropSize, $align) {
        switch ($align) {
            case 'left':
            case 'top':
                return [0, min($cropSize, $imageSize)];
            case 'right':
            case 'bottom':
                return [max(0, $imageSize - $cropSize), min($cropSize, $imageSize)];
            case 'center':
            case 'middle':
                return [
                    max(0, floor(($imageSize / 2) - ($cropSize / 2))),
                    min($cropSize, $imageSize),
                ];
            default: return [0, $imageSize];
        }
    }

    function download_image_to_wp_media_library( $url, $post_id, $image_name, $is_cron = true ){

        $image_id = str_replace(' ','_',$image_name );

        if( get_post_meta( $post_id , 'tsl_pd_image_file_' . $image_id , true ) && ! isset( $_REQUEST['override_image']) ){
            return get_post_meta( $post_id , 'tsl_pd_image_file_' . $image_id , true );
        }

        if ( !function_exists('media_handle_upload') ) {
            require_once(ABSPATH . "wp-admin" . '/includes/image.php');
            require_once(ABSPATH . "wp-admin" . '/includes/file.php');
            require_once(ABSPATH . "wp-admin" . '/includes/media.php');
        }

        if($is_cron) {
          $tmp = download_url( $url );
        } else {
          $tmp = $url;
        }

        if( is_wp_error( $tmp ) ){
        // download failed, handle error
        }

        $desc = get_the_title($post_id);
        $file_array = array();

        // Set variables for storage
        // fix file filename for query strings
        if($is_cron) {
          preg_match('/[^?]+.(jpg|jpe|jpeg|gif|png)/i', $url, $matches);
          $file_array['name'] = basename($matches[0]);
        } else {
          $file_array['name'] = $image_id;
        }
        $file_array['tmp_name'] = $tmp;

        // If error storing temporarily, unlink
        if ( is_wp_error( $tmp ) ) {
            @unlink($file_array['tmp_name']);
            $file_array['tmp_name'] = '';
        }

        // do the validation and storage stuff
        $attachment_id = media_handle_sideload( $file_array, $post_id, $desc );

        // If error storing permanently, unlink
        if ( is_wp_error($attachment_id) ) {
            @unlink($file_array['tmp_name']);
        }else {

            $attachment_id = $this->center_crop_image( $attachment_id , $post_id , $image_id);
            update_post_meta( $post_id , 'tsl_pd_image_file_' . $image_id ,  $attachment_id );

            return $attachment_id;

        }
    }

    function setImages($images, $product_id) {
      if(sizeof($images) > 0){
        $images = array_unique($images);
        set_post_thumbnail( $product_id, $images[0] );
        update_post_meta( $product_id, '_product_image_gallery', implode(',', $images) );
      }
    }

}