<?php

/*
Plugin Name: Puppies Direct Inventory Manager
Description: Inventory Manager that Connects to Petkey and Updates WooCommerce
Version: 1.3
Author: Tiny Screen Labs, LLC
Author URI: https://tinyscreenlabs.com
License: Puppies Direct
*/

define( 'BREEDS_CATEGORY_ID', 230 );

require_once 'includes/admin-settings.php';
require_once 'includes/puppies-direct-cron.php';
require_once  'includes/petkey-crm.php';

add_action( 'plugins_loaded', array( 'tsl_puppies_direct_main', 'init' ));

class tsl_puppies_direct_main
{

    private $app_version = '1.1';

    public static function init()
    {
        /*if(!defined('BREEDS_CATEGORY_ID')) {
          echo 'Plugin "' . basename(__DIR__) . '": BREEDS_CATEGORY_ID is not defined';
          exit;
        }*/
        $class = __CLASS__;
        new $class;
    }

    public function __construct()
    {


        add_action( 'wp_ajax_pd_ajax_handler', array( $this , 'ajax_handler' ));
		add_action( 'wp_ajax_nopriv_pd_ajax_handler',  array( $this , 'ajax_handler' ) );

        if (is_admin()) {
            add_action('admin_menu', array($this, 'add_settings_page'));


            if (isset($_REQUEST['page']) && $_REQUEST['page'] == 'tsl-puppies-direct-settings') {
                add_action('admin_enqueue_scripts', array($this, 'admin_manager_scripts'));
            }
        }
    }


    function admin_manager_scripts(){
		wp_register_style('tsl-general-css', plugins_url( "css/tsl-general-css.css", __FILE__ ), array(), $this->app_version, 'screen');
	    wp_enqueue_style(array( 'tsl-general-css' ));
	}

	function add_settings_page(){

		$admin_settings_page = new tsl_puppies_direct_admin_settings_page();
		$admin_settings_page->add_settings_page();
	}

	function ajax_handler(){

        $update_status = array('status' => 'Go home and shove off' );

        if($_REQUEST['pdkey'] == 'lsdkfjhiusdhijskdhf8735h8iefukryt9hgusv'){
            $tsl_puppies_direct_cron = new tsl_puppies_direct_cron();
            $result = $tsl_puppies_direct_cron->update_inventory();
            $update_status = array('status' => 'Success' , 'results' => $result );
        }

		wp_send_json( $update_status );
        die();


    }

}