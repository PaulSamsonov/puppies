<?php
/**
 * Created by PhpStorm.
 * User: Fred
 * Date: 4/30/18
 * Time: 11:26 AM
 */

class tsl_puppies_direct_admin_settings_page
{

    function add_settings_page()
    {

        if (empty ($GLOBALS['admin_page_hooks']['local_app_metrics'])) {
            add_menu_page('Puppies Direct', 'Puppies Direct', 'manage_options', 'tsl-puppies-direct-settings', array($this, 'create_admin_page'), 'dashicons-networking', 10);
        }
    }

    function create_admin_page(){

        if (!current_user_can('manage_options')) return 'No one is home';

        if(isset($_REQUEST['pd_apikey'])){

            foreach ( $_REQUEST['pd_apikey'] as $index => $key ){
                if(strlen($key) == 0) unset( $_REQUEST['pd_apikey'][$index]);
            }
            foreach ( $_REQUEST['pd_name_apikey'] as $index => $key ){
                if(strlen($key) == 0) unset( $_REQUEST['pd_name_apikey'][$index]);
            }

            update_option( 'pd_apikey' , $_REQUEST['pd_apikey'] );
            update_option( 'pd_name_apikey' , $_REQUEST['pd_name_apikey'] );

            if(isset( $_REQUEST['pd_image_width'])) update_option( 'pd_image_width' , $_REQUEST['pd_image_width'] );
            if(isset( $_REQUEST['pd_image_height'])) update_option( 'pd_image_height' , $_REQUEST['pd_image_height'] );
        }

        if(isset($_REQUEST['formprocessor'])){

            $excluded = array();

            foreach( $_REQUEST['breed'] as $index => $breed ){
                $excluded[$index] = 1;
            }


            update_option( 'pd_excluded_breeds' , $excluded );

            wp_redirect($_SERVER['HTTP_REFERER']);
            exit;
        }

        if(isset($_REQUEST['update'])) {
            //manually run the cron job

            $tsl_puppies_direct_cron = new tsl_puppies_direct_cron();
            $test = $tsl_puppies_direct_cron->update_inventory();
            echo '<pre>';
            print_r($test);

        }
        $html_line = '<div class="tsl-admin-settings-holder">';

        $html_line .= $this->headline('Petkey Inventory Manager Settings');

        $html_line .= '<form method="POST">';
        $html_line .= '<input type="hidden" value="tsl-puppies-direct-settings" name="page">';
        $html_line .= '<input type="hidden" value="tsl-puppies-direct-form" name="formprocessor">';

        $html_line .= $this->sub_heading('API Keys');

        if(isset($_REQUEST['pd_apikey'])){

            foreach ( $_REQUEST['pd_apikey'] as $index => $key ){
                if(strlen($key) == 0) unset( $_REQUEST['pd_apikey'][$index]);
            }
            foreach ( $_REQUEST['pd_name_apikey'] as $index => $key ){
                if(strlen($key) == 0) unset( $_REQUEST['pd_name_apikey'][$index]);
            }


            update_option( 'pd_apikey' , $_REQUEST['pd_apikey'] );
            update_option( 'pd_name_apikey' , $_REQUEST['pd_name_apikey'] );

        }

        $apikeys = get_option('pd_apikey');
        $namekeys = get_option( 'pd_name_apikey');
        $last_key = 0;

        $html_line .= '<table class="tsl-admin-pref-table">';
        $html_line .= '<tr><td>API Key</td><td>Store Name</td></tr>';

        foreach( $apikeys as $index => $key ){

            $name = $namekeys[$index];

            $html_line .= $this->make_apikey( "pd_apikey[".$last_key."]" , $key , "pd_name_apikey[".$last_key."]" , $name);
            $last_key++;
        }

        $html_line .= $this->make_apikey( "pd_apikey[".$last_key."]" , '' , "pd_name_apikey[".$last_key."]" , '' );

		$html_line .= '</table>';

        $html_line .= $this->section_seperator();

        $html_line .= $this->sub_heading('Exclude these Breeds from Inventory');

        $html_line .= $this->create_excluded_breed_list();


        $html_line .= $this->section_seperator();

        $id = 'pd_image_width';
        $html_line .= $this->make_textfield( $id, 'Image Width', get_option($id) );

        $id = 'pd_image_height';
        $html_line .= $this->make_textfield( $id, 'Image Height', get_option($id) );

		$html_line .= '<table class="tsl-admin-pref-table">';
		$html_line .= '<tr>';
		$html_line .= '<td></td>';
		$html_line .= '<td></td>';
		$html_line .= '<td>'.$this->submit_button().'</td>';
		$html_line .= '</tr>';

		$html_line .= '</table>';

		$html_line .= '</form>';

		$html_line .= '</div>';

		echo $html_line;
    }

    function make_textfield( $id,  $title, $value = '' )
    {

        $html_line = '<table class="tsl-admin-pref-table">';
        $html_line .= '<tr>';
        $html_line .= '<td class="tsl-admin-pref-table-heading">'.$title.':</td>';
        $html_line .= '<td class="tsl-admin-pref-table-heading" align="right"><input style="width:25em" type="text" id="'.$id.'" name="'.$id.'" value="'.$value.'"/></td>';
        $html_line .= '</tr>';
        $html_line .= '</table>';

       return $html_line;

    }

    function create_excluded_breed_list(){

        $args = array(
            'numberposts' => -1,
            'post_type' => 'product',
            'meta_query' => array(
                array(
                    'key' => '_pdm_pet_product',
                    'value' => 'pet',
                )
            )
        );

        $pets = get_posts($args);

        foreach( $pets as $pet ) {

            if(!empty(get_post_meta($pet->ID, '_pdm_pet_breed', true))) {
                $PetBreeds[get_post_meta($pet->ID, '_pdm_pet_breed', true)] = get_post_meta($pet->ID, '_pdm_pet_breed', true);
            }

        }

        $totalBreeds = sizeof($PetBreeds);
        $rows = ceil($totalBreeds / 5);
        sort($PetBreeds);

        $excluded_breeds = get_option('pd_excluded_breeds');

        $html_line = '<table style="width:100%" border="1">';

        for($x=0;$x<$rows;$x++){

            $html_line .= '<tr>';
            $html_line .= '<td>'.current($PetBreeds).'</td><td><input type="checkbox" name="breed['.str_replace(' ' , '_',current($PetBreeds)).']" value="'.$excluded_breeds[str_replace(' ' , '_',current($PetBreeds))].'" '.$this->isBreedChecked( str_replace(' ' , '_',current($PetBreeds)) , $excluded_breeds).'></td><td>&nbsp;&nbsp;</td>';
            next($PetBreeds);
            $html_line .= '<td>'.current($PetBreeds).'</td><td><input type="checkbox" name="breed['.str_replace(' ' , '_',current($PetBreeds)).']" value="'.$excluded_breeds[str_replace(' ' , '_',current($PetBreeds))].'" '.$this->isBreedChecked( str_replace(' ' , '_',current($PetBreeds)) , $excluded_breeds).'></td><td>&nbsp;&nbsp;</td>';
            next($PetBreeds);
            $html_line .= '<td>'.current($PetBreeds).'</td><td><input type="checkbox" name="breed['.str_replace(' ' , '_',current($PetBreeds)).']" value="'.$excluded_breeds[str_replace(' ' , '_',current($PetBreeds))].'" '.$this->isBreedChecked( str_replace(' ' , '_',current($PetBreeds)) , $excluded_breeds).'></td><td>&nbsp;&nbsp;</td>';
            next($PetBreeds);
            $html_line .= '<td>'.current($PetBreeds).'</td><td><input type="checkbox" name="breed['.str_replace(' ' , '_',current($PetBreeds)).']" value="'.$excluded_breeds[str_replace(' ' , '_',current($PetBreeds))].'" '.$this->isBreedChecked( str_replace(' ' , '_',current($PetBreeds)) , $excluded_breeds).'></td><td>&nbsp;&nbsp;</td>';
            next($PetBreeds);
            $html_line .= '<td>'.current($PetBreeds).'</td><td><input type="checkbox" name="breed['.str_replace(' ' , '_',current($PetBreeds)).']" value="'.$excluded_breeds[str_replace(' ' , '_',current($PetBreeds))].'" '.$this->isBreedChecked( str_replace(' ' , '_',current($PetBreeds)) , $excluded_breeds).'></td><td>&nbsp;&nbsp;</td>';
            next($PetBreeds);
            $html_line .= '</tr>';

        }

        $html_line .= '</table>';

        return $html_line;

    }

    function isBreedChecked( $breed , $excluded_breeds){

        if(isset($excluded_breeds[str_replace(' ' , '_',$breed)])){
            return 'checked';
        }
        return '';

    }

    function assign_form( $slug , $title ){

		if(isset($_REQUEST['tsl-pd-form-'.$slug.'-form'])){
			update_option('tsl-pd-form-'.$slug.'-form' , $_REQUEST['tsl-pd-form-'.$slug.'-form'] );
		}

		$selected = get_option('tsl-pd-form-'.$slug.'-form');

		$html_line = '<table class="tsl-admin-pref-table" style="width:50em;">';
		$html_line .= '<tr>';
		$html_line .= '<td class="tsl-admin-pref-table-heading">'.$title.':</td>';
		$html_line .= '<td class="tsl-admin-pref-table-heading" align="right">'.$this->make_dropdown( 'tsl-pd-form-'.$slug.'-form', $this->make_form_list(), $selected).'</td>';
		$html_line .= '</tr>';
		$html_line .= '</table>';

		return $html_line;

	}

	function assign_form_field( $slug , $title , $form_id ){

		if(isset($_REQUEST['tsl-pd-form-'.$form_id.'-'.$slug.'-form-field'])){
			update_option('tsl-pd-form-'.$form_id.'-'.$slug.'-form-field' , $_REQUEST['tsl-pd-form-'.$form_id.'-'.$slug.'-form-field'] );
		}

		$selected = get_option('tsl-pd-form-'.$form_id.'-'.$slug.'-form-field');

		$html_line = '<table class="tsl-admin-pref-table">';
		$html_line .= '<tr>';
		$html_line .= '<td class="tsl-admin-pref-table-heading">'.$title.':</td>';
		$html_line .= '<td class="tsl-admin-pref-table-heading" align="right">'.$this->make_dropdown( 'tsl-pd-form-'.$form_id.'-'.$slug.'-form-field', $this->make_form_field_list( $form_id ), $selected).'</td>';
		$html_line .= '</tr>';
		$html_line .= '</table>';

		return $html_line;

	}

	function make_form_list(){

		$forms = array();

		if(class_exists('mam_for_gravity_forms_forms_manager')){
			$mam_for_gravity_forms_forms_manager = new mam_for_gravity_forms_forms_manager();
			$form_list = $mam_for_gravity_forms_forms_manager->get_all_gravity_forms();

			foreach( $form_list as $form ){
				$forms[] = array('slug' => $form['id'] , 'name' => $form['title'] );
			}

		}

		return $forms;

	}

	function make_form_field_list( $form_id ){

		$forms = array();

		if(class_exists('mam_for_gravity_forms_forms_manager')){

			$mam_for_gravity_forms_forms_manager = new mam_for_gravity_forms_forms_manager();
			$form_list = $mam_for_gravity_forms_forms_manager->get_gravity_form( $form_id );

			foreach( $form_list['fields'] as $form ){
				$forms[] = array('slug' => $form['id'] , 'name' => $form['label'] );
			}

		}

		return $forms;

	}

	 function make_dropdown( $id , $options = array() , $selected = null ){

		if( ! $id || sizeof($options) == 0 ) return '';

		$html_line = '<select id="'.$id.'" name="'.$id.'">';

		if( ! $selected ) $html_line .= '<option value="0" selected>Select...</option>';

		foreach($options as $option){
			$selected_item = '';
			if($option['slug'] == $selected ) $selected_item = 'selected';
			$html_line .= '<option  value="'.$option['slug'].'" '.$selected_item.'>' .$option['name'].'</option>';
		}

		$html_line .= '</select>';

		return $html_line;

	}


    function make_apikey( $id,  $value = '' , $name_id = '', $name_value = '' ){

		$html_line = '<tr>';
		$html_line .= '<td><input type="text" style="width:400px;" id="'.$id.'" name="'.$id.'" value="'.$value.'"></td>';
		$html_line .= '<td><input type="text" style="width:200px;" id="'.$name_id.'" name="'.$name_id.'" value="'.$name_value.'"></td>';
		$html_line .= '</tr>';

        return $html_line;
    }

    function headline( $headline ){

		$html_line = '<div class="tsl-admin-headline">';
		$html_line .= $headline;
		$html_line .= '</div>';

		return $html_line;

	}

	function sub_heading( $sub_heading ){

		$html_line = '<div class="tsl-admin-subheading">';
		$html_line .= $sub_heading;
		$html_line .= '</div>';

		return $html_line;

	}

	function section_seperator(){
		return '<hr class="tsl-admin-settings-seperator">';
	}



	function submit_button(){
		return '<input name="submit" id="submit" style="float:right" class="button button-primary button-large" value="Save Changes" type="submit">';
	}
}

if(!class_exists('mam_for_gravity_forms_forms_manager') && class_exists('GFAPI') ) {

    class mam_for_gravity_forms_forms_manager
    {

        public function get_all_gravity_forms()
        {

            $forms = GFAPI::get_forms();

            return $forms;

        }

        public function get_gravity_form($form_id)
        {

            $form = GFAPI::get_form($form_id);

            return $form;
        }

        public function submit_form_entry($entry)
        {

            $entry_id = GFAPI::add_entry($entry);

            return $entry_id;
        }
    }

}