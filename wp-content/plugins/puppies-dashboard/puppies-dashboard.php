<?php

/*
Plugin Name: Puppies Dashboard
Description: Breeders dashboard managment
Version: 1.0
*/

add_action( 'wp', array( 'puppies_dashboard_main', 'init' ));

class puppies_dashboard_main {

  function init() {
    $data = $_POST;
    if(isset($data['dashboard_parents_new'])) {
      $data['PetId'] = $data['ReferenceNumber'];
      $data['VendorId'] = WC_Product_Vendors_Utils::get_user_active_vendor();
      $data = array( $data );
      $tsl_puppies_direct_cron = new tsl_puppies_direct_cron();
      $tsl_puppies_direct_cron->update_pet_inventory( $data, false );
    }
  }

}