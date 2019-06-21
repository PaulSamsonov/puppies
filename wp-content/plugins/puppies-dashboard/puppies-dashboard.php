<?php

/*
Plugin Name: Puppies Dashboard
Description: Breeders dashboard managment
Version: 1.0
*/

define('BREEDER_DASHBOARD_TEMPLATE', 'breeder-dashboard.php');

new puppies_dashboard_main();

class puppies_dashboard_main {

  public function __construct() {

    add_action( 'init', array( $this, 'rewrites' ));
    add_action( 'wp', array( $this, 'main' ));

  }

  public function rewrites() {
    add_rewrite_rule( '^breeder-dashboard/([^/]*)/?$', 'index.php?pagename=breeder-dashboard&type=$matches[1]', 'top' );
    add_rewrite_rule( '^breeder-dashboard/parents/([^/]*)[/]*([^/]*)/?$', 'index.php?pagename=breeder-dashboard&type=parents&action=$matches[1]&id=$matches[2]', 'top' );
    add_filter( 'query_vars', function( $vars ) {
      $vars[] = 'type';
      $vars[] = 'action';
      $vars[] = 'id';
      return $vars;
    } );
  }

  public function main() {
    if( !is_page_template(BREEDER_DASHBOARD_TEMPLATE) ) return;

    if(isset($_POST['dashboard_submit'])) {
      $this->submit( $_POST );
    }

    $this->output();
  }

  public function submit($data) {
    if($data['action'] == 'new') {
      $data['VendorId'] = WC_Product_Vendors_Utils::get_user_active_vendor();
    }
    //$data['PetId'] = $data['ReferenceNumber'];

    $data = array( $data );
    $tsl_puppies_direct_cron = new tsl_puppies_direct_cron();
    $tsl_puppies_direct_cron->update_pet_inventory( $data, false );
    wp_redirect(get_home_url(null, '/breeder-dashboard/parents'));
  }

  public function output() {
    $vars = array();
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
        $vars['data'] = $this->get_product_data($path_id);
        $vars['template'] = 'dashboard/'.$type.'-new.php';
      } elseif($action == 'delete' && is_numeric($path_id)) {
        wp_trash_post( $path_id );
        wp_redirect(get_home_url(null, '/breeder-dashboard/parents'));
      } else {
        $vars['template'] = 'dashboard/' . $type . '.php';
      }
    } else {
      $vars['template'] = 'dashboard/main.php';
    }
    set_query_var( 'dashboard_variables', $vars );
    wp_enqueue_script('jquery-ui-datepicker');
    wp_enqueue_style( 'jquery-ui-css', '//ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/themes/base/jquery-ui.css' );
  }

  public function get_product_data($id) {
    $product = get_post($id);
    $product_data = array(
      'PetName' => $product->post_title,
      'Description' => $product->post_content,
      'Gender' => get_post_meta($product->ID, '_pdm_pet_gender', true),
      'BirthDate' => str_replace('-', '/', get_post_meta($product->ID, '_pdm_pet_dob', true)),
      'BreedName' => get_post_meta($product->ID, '_pdm_pet_breed', true),
      'Weight' => get_post_meta($product->ID, '_pdm_pet_wight', true),
      'RegistryName' => get_post_meta($product->ID, '_pdm_pet_registry', true),
      'Coloring' => get_post_meta($product->ID, '_pdm_pet_markings', true),
      'ReferenceNumber' => get_post_meta($product->ID, 'pdm_pet_ref_no', true),
      'ofa_certified' => get_post_meta($product->ID, 'pdm_pet_ofa_certified', true),
      'champion' => get_post_meta($product->ID, 'pdm_pet_champion', true),
      'has_been_shown' => get_post_meta($product->ID, 'pdm_pet_has_been_shown', true),
      'Photo' => get_post_meta($product->ID, '_thumbnail_id', true),
      //'PhotoGallery' => get_post_meta($product->ID, '_product_image_gallery', true), //66598,66507
    );

    return $product_data;
  }

}