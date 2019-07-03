<?php
/*
Plugin Name: Puppies Dashboard
Description: Breeders dashboard managment
Version: 1.0
*/

define( 'BREEDS_CATEGORY_ID', 230 );
define( 'BREEDER_DASHBOARD_TEMPLATE', 'breeder-dashboard.php' );

require_once dirname(__FILE__) . '/includes/media.php';

new puppies_dashboard_main();

class puppies_dashboard_main {

  public $plugin_cron;
  public $class_media;

  public function __construct() {
    // Class media
    $this->class_media = new puppies_dashboard_media();
    // Init hook
    add_action( 'init', array( $this, 'init' ));
    // wp loaded hook
    add_action( 'wp', array( $this, 'main' ));
  }

  public function init() {
    // rewrites
    $this->rewrites();

    // cpt Parents
    $this->custom_post_type();

    // Dashboard menu item
    add_filter( 'wp_nav_menu_items', array( $this, 'menu_item' ), 10, 2 );

    // Show hidden custom fields
    add_filter( 'is_protected_meta', '__return_false' );

    // Show product author
    //add_post_type_support( 'product', 'author' );

    // thumbnail sizes
    add_image_size( 'dashboard-view', 258, 258, false );
    add_image_size( 'dashboard-parent', 128, 60, false );
    add_image_size( 'dashboard-main', 36, 36, false );
    add_image_size( 'dashboard-media', 150, 100, false );

    // enqueue_scripts
    add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ), 99 );

    // Ajax
    add_action( 'wp_ajax_puppy_media', array( $this->class_media, 'ajax_media' ) );
    add_action( 'wp_ajax_puppy_sold', array( $this, 'ajax_mark_sold' ) );
  }

  public function rewrites() {
    //add_rewrite_rule( '^breeder-dashboard/([^/]*)/?$', 'index.php?pagename=breeder-dashboard&type=$matches[1]', 'top' );
    //add_rewrite_rule( '^breeder-dashboard/parents/([^/]*)[/]*([^/]*)/?$', 'index.php?pagename=breeder-dashboard&type=parents&action=$matches[1]&id=$matches[2]', 'top' );
    //add_rewrite_rule( '^breeder-dashboard/puppies/([^/]*)[/]*([^/]*)/?$', 'index.php?pagename=breeder-dashboard&type=puppies&action=$matches[1]&id=$matches[2]', 'top' );
    add_rewrite_rule( '^breeder-dashboard/([^/]*)[/]*([^/]*)[/]*([^/]*)/?$', 'index.php?pagename=breeder-dashboard&type=$matches[1]&action=$matches[2]&id=$matches[3]', 'top' );
    add_filter( 'query_vars', function( $vars ) {
      $vars[] = 'type';
      $vars[] = 'action';
      $vars[] = 'id';
      return $vars;
    } );
  }

  public function custom_post_type() {
    register_post_type('puppy_parents', array(
      'labels'             => array(
        'name'               => 'Parents',
        'singular_name'      => 'Parent',
      ),
      'public'             => true,
      'publicly_queryable' => true,
      'show_ui'            => true,
      'show_in_menu'       => true,
      'query_var'          => true,
      'rewrite'            => true,
      'capability_type'    => 'post',
      'has_archive'        => false,
      'hierarchical'       => false,
      'menu_position'      => null,
      'supports'           => array('title','editor','author','thumbnail','excerpt','custom-fields')
    ) );
  }

  public function enqueue_scripts() {
    wp_localize_script( 'jquery', 'puppy_vars',
      array(
        'ajaxurl' => admin_url('admin-ajax.php')
      )
    );
  }

  public function menu_item ( $items, $args ) {
    if ($args->theme_location == 'above_header_menu') {
      $items = '<li><a href="' . get_home_url(null, '/breeder-dashboard') . '" class="menu-link "><span class="menu-text">Dashboard</span></a></li>' . $items;
    }
    return $items;
  }

  public function main() {

    /*echo '<pre>';
    print_r($_FILES);
    print_r($_POST);
    echo '</pre>';*/

    $this->plugin_cron = new tsl_puppies_direct_cron();

    if( !is_page_template(BREEDER_DASHBOARD_TEMPLATE) ) return;

    if(isset($_POST['dashboard_submit'])) {
      $this->submit( $_POST );
    }

    $this->output();

    add_action('wp_footer', array( $this, 'footer' ));
  }

  public function submit($data) {

    if($data['type'] == 'puppies' && $data['action'] == 'new' && (!$data['usda_agreement'] || !$data['price_agreement'])) {
      return;
    }

    if($data['action'] == 'new') {
      $data['VendorId'] = WC_Product_Vendors_Utils::get_user_active_vendor();

      if($data['type'] == 'parents') {
        $puppies_info = "Thank you for adding your new parents. We have received your puppy's information for review and will notify you when we have approved the puppy for sale. Please contact us with any questions.";
      } else {
        $puppies_info = "Thank you for adding your new puppy. We have received your puppy's information for review and will notify you when we have approved the puppy for sale. Please contact us with any questions.";
      }
      setcookie('puppies_info', $puppies_info, time()+600, '/');
    }

    $this->update( $data );

    if($data['type'] == 'puppies') {
      $action = '/pending';
    } else {
      $action = '';
    }

    wp_redirect(get_home_url(null, '/breeder-dashboard/'.$data['type'] . $action));
  }

  public function output() {
    $vars = array();
    /*if($_COOKIE['puppies_info']) {
      $vars['alert'] = '<div class="infobox">' . stripslashes($_COOKIE['puppies_info']) . '</div>';
      unset($_COOKIE['puppies_info']);
      setcookie('puppies_info', null, -1, '/');
    }*/
    $type = get_query_var('type');
    if($type) {
      $action = get_query_var('action');
      $path_id = get_query_var('id');
      $vars['type'] = $type;
      $vars['action'] = $action;
      $vars['path_id'] = $path_id;
      if($action == 'new') {
        $vars['template'] = 'dashboard/'.$type.'-new.php';
      } elseif($action == 'edit' && is_numeric($path_id)) {
        $vars['data'] = $this->get_product_data($path_id, $vars['type']);
        $vars['template'] = 'dashboard/'.$type.'-new.php';
      } elseif($action == 'delete' && is_numeric($path_id)) {
        wp_trash_post( $path_id );
        if($_GET['redirect']) {
          $action = '/' . $_GET['redirect'];
        } else {
          $action = '';
        }
        wp_redirect(get_home_url(null, '/breeder-dashboard/'.$type . $action));
      } elseif($action == 'media' && is_numeric($path_id)) {
        $vars['data'] = $this->class_media->get_media_data($path_id, $type);
        $vars['template'] = 'dashboard/media.php';
      } else {
        $vars['template'] = 'dashboard/' . $type . '.php';
      }
    } else {
      $vars['template'] = 'dashboard/main.php';
    }
    set_query_var( 'dashboard_variables', $vars );

    // Add scripts
    if( $vars['action'] == 'new' || $vars['action'] == 'edit' ) {
      wp_enqueue_script('jquery-ui-datepicker');
      wp_enqueue_style( 'jquery-ui-css', '//ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/themes/base/jquery-ui.css' );
    } elseif( $vars['action'] == 'media' ) {
      //wp_enqueue_style( 'dropzone', plugins_url(null, __FILE__).'/dropzone.css', '', time() );
      wp_enqueue_style( 'dropzone', '//cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css', '', time() );
      //wp_enqueue_script( 'dropzone-js', plugins_url(null, __FILE__).'/dropzone.js', '', '', true );
      wp_enqueue_script( 'dropzone-js', '//cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js', '', '', true );
    }
  }

  public function update( $data ) {

    /*echo '<pre>';
    print_r($data);
    echo '</pre>';*/
    //exit;

    if($data['product_id']) {
      $product_id = $data['product_id'];
    }

    if($data['type'] == 'parents') {
      $post_type = 'puppy_parents';
    } else {
      $post_type = 'product';
    }

    if( empty( $data['PetName'] )) {
      $data['PetName'] = $this->plugin_cron->randomPetName( $data['Gender'] );
      if( empty( $data['PetName'] )) {
        $data['PetName'] = $data['BreedName'];
      }
    }

    if (!$product_id) {

      $post = array(
        'post_type' => $post_type,
        'post_title' => $data['PetName'],
        'post_content' => $data['Description'],
        'post_status' => 'pending'
      );

      $product_id = wp_insert_post($post);

      //update_post_meta( $product_id, 'pd_status', 'yes' );
      //update_post_meta( $product_id, '_pd_status', 'yes' );
      update_post_meta( $product_id, '_stock_status', 'instock' );
      update_post_meta( $product_id, '_manage_stock', 'yes');
      update_post_meta( $product_id, '_stock', '1');
      //update_post_meta( $product_id, 'out_of_stock_by_pet_key', 'no' );

    } else {

      $post = array(
        'ID' => $product_id,
        'post_title' => $data['PetName'],
        'post_content' => $data['Description']
      );

      wp_update_post($post);

    }

    update_post_meta($product_id, '_pd_product', 'breeder');

    $data_categories = $this->plugin_cron->pd_woo_manage_category(array('Pets', $data['BreedName'] ));

    wp_set_object_terms( $product_id, $data_categories, 'product_cat' );

    $tags = array();

    $tags[] = $data['Gender'];
    $tags[] = $data['BreedName'];

    //if(isset($data['BreedName'])) update_post_meta( $product_id, '_pd_breed', $data['BreedName'] );
    //if(isset($data['OrgName'])) update_post_meta($product_id, '_pd_location', $data['OrgName']);
    //if(isset($data['ReferenceNumber'])) update_post_meta($product_id, '_pd_ref_no', $data['ReferenceNumber']);

    //update_post_meta($product_id, '_sku', $product_id);

    //if(isset($data['Age'])) update_post_meta($product_id, '_pd_age', $data['Age']);
    //if(isset($data['BirthDate'])) update_post_meta($product_id, '_pd_dob', date('m-d-Y', strtotime($data['BirthDate'])));
    //if(isset($data['Coloring'])) update_post_meta($product_id, '_pd_markings', $data['Coloring']);
    //if(isset($data['Weight'])) update_post_meta($product_id, '_pd_wight', $data['Weight']);
    //if(isset($data['Gender'])) update_post_meta($product_id, '_pd_gender', $data['Gender']);
    //if(isset($data['VideoUrl'])) update_post_meta($product_id, '_pd_video_url', $data['VideoUrl']);
    //if(isset($data['Microchip'])) update_post_meta($product_id, '_pd_microchip_number', $data['Microchip']);
    //update_post_meta($product_id, '_pd_id', $data['PetId'] );

    update_post_meta($product_id, '_sold_individually', 1 );

    if(isset($data['BreedName'])) update_post_meta( $product_id, 'pd_breed', $data['BreedName'] );
    //if(isset($data['OrgName'])) update_post_meta($product_id, 'pd_location', $data['OrgName']);
    //if(isset($data['ReferenceNumber'])) update_post_meta($product_id, 'pd_ref_no', $data['ReferenceNumber']);
    if(isset($data['RegisterNumber'])) update_post_meta($product_id, 'pd_reg_no', $data['RegisterNumber']);
    //if(isset($data['PetName'])) update_post_meta($product_id, 'pd_name', $data['PetName']);
    //if(isset($data['Age'])) update_post_meta($product_id, 'pd_age', $data['Age']);
    if(isset($data['BirthDate'])) update_post_meta($product_id, 'pd_dob', date('m-d-Y', strtotime($data['BirthDate'])));
    if(isset($data['Coloring'])) update_post_meta($product_id, 'pd_markings', $data['Coloring']);
    if(isset($data['Weight'])) update_post_meta($product_id, 'pd_wight', $data['Weight']);
    if(isset($data['Gender'])) update_post_meta($product_id, 'pd_gender', $data['Gender']);
    //if(isset($data['VideoUrl'])) update_post_meta($product_id, 'pd_video_url', $data['VideoUrl']);
    //if(isset($data['Microchip'])) update_post_meta($product_id, 'pd_microchip_number', $data['Microchip']);
    //update_post_meta($product_id, 'pd_id', $data['PetId'] );

    wp_set_object_terms($product_id, $tags, 'product_tag');

    // New fields - parents
    if(isset($data['ofa_certified'])) update_post_meta($product_id, 'pd_ofa_certified', $data['ofa_certified']);
    if(isset($data['champion'])) update_post_meta($product_id, 'pd_champion', $data['champion']);
    if(isset($data['has_been_shown'])) update_post_meta($product_id, 'pd_has_been_shown', $data['has_been_shown']);

    // New fields - puppies
    if(isset($data['marking_id'])) update_post_meta($product_id, 'marking_id', $data['marking_id']);
    if(isset($data['champion'])) update_post_meta($product_id, 'champion', $data['champion']);
    if(isset($data['puppy_discount'])) update_post_meta($product_id, 'puppy_discount', $data['puppy_discount']);
    if(isset($data['puppy_discount_amount'])) update_post_meta($product_id, 'puppy_discount_amount', $data['puppy_discount_amount']);
    if(isset($data['puppy_discount_reason'])) update_post_meta($product_id, 'puppy_discount_reason', $data['puppy_discount_reason']);
    if(isset($data['special_feeding_instructions'])) update_post_meta($product_id, 'special_feeding_instructions', $data['special_feeding_instructions']);
    if(isset($data['size_compared_to_litter'])) update_post_meta($product_id, 'size_compared_to_litter', $data['size_compared_to_litter']);
    if(isset($data['umbilical_hernia'])) update_post_meta($product_id, 'umbilical_hernia', $data['umbilical_hernia']);
    if(isset($data['inguinal_hernia'])) update_post_meta($product_id, 'inguinal_hernia', $data['inguinal_hernia']);
    if(isset($data['undescended_testicles'])) update_post_meta($product_id, 'undescended_testicles', $data['undescended_testicles']);
    if(isset($data['open_font'])) update_post_meta($product_id, 'open_font', $data['open_font']);
    if(isset($data['underbite'])) update_post_meta($product_id, 'underbite', $data['underbite']);
    if(isset($data['overbite'])) update_post_meta($product_id, 'overbite', $data['overbite']);
    if(isset($data['dewclaws'])) update_post_meta($product_id, 'dewclaws', $data['dewclaws']);
    if(isset($data['spayed_neutered'])) update_post_meta($product_id, 'spayed_neutered', $data['spayed_neutered']);
    if(isset($data['microchip'])) update_post_meta($product_id, 'microchip', $data['microchip']);
    if(isset($data['microchip_id'])) update_post_meta($product_id, 'microchip_id', $data['microchip_id']);
    if(isset($data['known_health'])) update_post_meta($product_id, 'known_health', $data['known_health']);
    if(isset($data['breeder_notes'])) update_post_meta($product_id, 'breeder_notes', $data['breeder_notes']);

    if(isset($data['RegistryName'])) {
      update_post_meta( $product_id, 'pd_registry', $data['RegistryName']);
    }

    if(isset($data['asking_price'])) {
      update_post_meta($product_id, '_price', $data['asking_price']);
      update_post_meta($product_id, '_regular_price', $data['asking_price']);
      update_post_meta($product_id, 'asking_price', $data['asking_price']);
    }

    // Set vendor
    if(isset($data['VendorId'])) wp_set_object_terms( $product_id, $data['VendorId'], WC_PRODUCT_VENDORS_TAXONOMY );
  }

  public function get_product_data($id, $type) {
    $product = get_post($id);
    $product_data = array(
      'PetName' => $product->post_title,
      'Description' => $product->post_content,
      'Gender' => get_post_meta($product->ID, 'pd_gender', true),
      'BirthDate' => str_replace('-', '/', get_post_meta($product->ID, 'pd_dob', true)),
      'BreedName' => get_post_meta($product->ID, 'pd_breed', true),
      'Weight' => get_post_meta($product->ID, 'pd_wight', true),
      'RegistryName' => get_post_meta($product->ID, 'pd_registry', true),
      'Coloring' => get_post_meta($product->ID, 'pd_markings', true),
      'RegisterNumber' => get_post_meta($product->ID, 'pd_reg_no', true),
      //'ReferenceNumber' => get_post_meta($product->ID, 'pd_ref_no', true),
    );
    if($type == 'parents') {
      $arr = array(
        'ofa_certified' => get_post_meta($product->ID, 'pd_ofa_certified', true),
        'champion' => get_post_meta($product->ID, 'pd_champion', true),
        'has_been_shown' => get_post_meta($product->ID, 'pd_has_been_shown', true),
      );
    } else {
      $arr = array(
        'asking_price' => get_post_meta($product->ID, 'asking_price', true),
        'marking_id' => get_post_meta($product->ID, 'marking_id', true),
        'puppy_discount' => get_post_meta($product->ID, 'puppy_discount', true),
        'puppy_discount_amount' => get_post_meta($product->ID, 'puppy_discount_amount', true),
        'puppy_discount_reason' => get_post_meta($product->ID, 'puppy_discount_reason', true),
        'special_feeding_instructions' => get_post_meta($product->ID, 'special_feeding_instructions', true),
        'size_compared_to_litter' => get_post_meta($product->ID, 'size_compared_to_litter', true),
        'umbilical_hernia' => get_post_meta($product->ID, 'umbilical_hernia', true),
        'inguinal_hernia' => get_post_meta($product->ID, 'inguinal_hernia', true),
        'undescended_testicles' => get_post_meta($product->ID, 'undescended_testicles', true),
        'open_font' => get_post_meta($product->ID, 'open_font', true),
        'underbite' => get_post_meta($product->ID, 'underbite', true),
        'overbite' => get_post_meta($product->ID, 'overbite', true),
        'dewclaws' => get_post_meta($product->ID, 'dewclaws', true),
        'spayed_neutered' => get_post_meta($product->ID, 'spayed_neutered', true),
        'microchip' => get_post_meta($product->ID, 'microchip', true),
        'microchip_id' => get_post_meta($product->ID, 'microchip_id', true),
        'known_health' => get_post_meta($product->ID, 'known_health', true),
        'breeder_notes' => get_post_meta($product->ID, 'breeder_notes', true),
      );
    }

    return array_merge($product_data, $arr);
  }

  public function ajax_mark_sold() {
    if($_POST['pid'] && $_POST['tostatus']) {
      update_post_meta($_POST['pid'], '_stock_status', $_POST['tostatus']);
      //echo get_home_url(null, '/breeder-dashboard/puppies/');
    }

    wp_die();
  }

  public function footer() {
?>
    <div class="modal-popup" id="popup-confirm">
      <div class="modal-popup-content">
        <h4 class="modal-popup-title">Are you sure?</h4>
        <div class="modal-popup-footer">
          <button class="accept">Yes</button>
          <button class="close">No</button>
        </div>
      </div>
    </div>
<?php
  }

}