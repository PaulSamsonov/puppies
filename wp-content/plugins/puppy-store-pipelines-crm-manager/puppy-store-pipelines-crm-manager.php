<?php

/*
Plugin Name: Puppy Store Pipelines CRM Manager
Description: Pipelines CRM Manager for Puppy Store
Version: 1.1
Author: Tiny Screen Labs, LLC
Author URI: https://tinyscreenlabs.com
License: Private
*/

include_once 'includes/tsl-puppy-store-pipelines-crm-settings.php';
include_once 'includes/pipelines-crm-class.php';
include_once 'includes/gravity-form-manager.php';


add_action( 'plugins_loaded', array( 'tsl_puppies_store_pipelines_crm_main', 'init' ));

class tsl_puppies_store_pipelines_crm_main
{

    private $app_version = '1.0.0';
    private $form_info;

    private $price = 0;
    private $pet_id;

    public static function init()
    {
        $class = __CLASS__;
        new $class;
    }

    public function __construct()
    {

        add_action( 'tsl_pd_process_crm', array( $this , 'form_submission_handler' ));
        add_action( 'tsl_pd_process_video_crm', array( $this , 'form_submission_handler_video' ));

//        $slug = 'ps-puppy';
//        $ps_puppy_form_id = get_option('tsl-ps-form-'.$slug.'-form');
//        if($ps_puppy_form_id) add_action( 'gform_pre_submission_'.$ps_puppy_form_id, array( $this , 'gravity_form_submission_handler_puppy_info' ) );

        $slug = 'ps-puppy-breed-interest';
        $ps_puppy_form_id = get_option('tsl-ps-form-'.$slug.'-form');
        if($ps_puppy_form_id) add_action( 'gform_pre_submission_'.$ps_puppy_form_id, array( $this , 'gravity_form_submission_handler_breed_interest' ) );

        $slug = 'ps-general-contact';
        $ps_puppy_form_id = get_option('tsl-ps-form-'.$slug.'-form');
        if($ps_puppy_form_id) add_action( 'gform_pre_submission_'.$ps_puppy_form_id, array( $this , 'gravity_form_submission_handler_general_contact' ) );

        $slug = 'ps-puppy-newsletter';
        $ps_puppy_form_id = get_option('tsl-ps-form-'.$slug.'-form');
        if($ps_puppy_form_id) add_action( 'gform_pre_submission_'.$ps_puppy_form_id, array( $this , 'gravity_form_submission_handler_newsletter' ) );

        add_action( 'gform_after_submission', array($this, 'after_submission'), 10, 2 );



        if (is_admin()) {

            add_action('admin_menu', array($this, 'add_settings_page'));

            if (isset($_REQUEST['page']) && $_REQUEST['page'] == 'tsl-puppy-store-pipelines-settings') {
                add_action('admin_enqueue_scripts', array($this, 'admin_manager_scripts'));
            }
        }

    }

    function after_submission( $entry, $form ) {

        $slug = 'ps-puppy';
        $ps_puppy_form_id = get_option('tsl-ps-form-'.$slug.'-form');

        if($form['id'] == $ps_puppy_form_id ){

            $puppy_link = $entry['source_url'];

            $postid = url_to_postid( $puppy_link );

            $email = $this->get_email_value( $slug );
            $first_name = $this->get_first_name_value( $slug );
            $last_name = $this->get_last_name_value( $slug );
            $phone = $this->get_phone_value( $slug );
            $message = $this->get_comments_value( $slug );

            $puppy_id = get_post_meta( $postid , '_pdm_pet_ref_no' , true );
            $puppy_name = get_post_meta( $postid , 'pdm_pet_name' , true );
            $puppy_breed = get_post_meta( $postid , 'pdm_pet_breed' , true );

            $this->pet_id = $postid;

            $this->send_puppy_info_to_pipelines( $slug, $email, $first_name, $last_name, $phone, $message, $puppy_id, $puppy_name, $puppy_link , $puppy_breed);

        }

    }

    public function form_submission_handler_video(){

        $slug = 'ps-puppy-video';

        $first_name = $_POST['formdata'][0]['value'];
        $last_name = ' ';
        $email = $_POST['formdata'][2]['value'];
        $phone = $_POST['formdata'][1]['value'];

        $pet_id = $_POST['formdata'][3]['value'];
        $pet_name = $_POST['formdata'][4]['value'];

        $message = '';
        $puppy_link = $this->get_puppy_for_sku( $pet_id );
        $pet_id = $this->getreference_no_for_sku( $pet_id );

        $puppy_breed = $this->get_puppy_breed_value( $slug );


        $this->send_puppy_info_to_pipelines( $slug, $email, $first_name, $last_name, $phone, $message, $pet_id, $pet_name, $puppy_link , $puppy_breed );

    }


    public function form_submission_handler( ){

        //this is a legacy handler for the custom form on puppies for sale today only

        $first_name = $_POST['formdata'][0]['value'];
        $last_name = $_POST['formdata'][1]['value'];
        $email = $_POST['formdata'][2]['value'];
        $phone = $_POST['formdata'][3]['value'];
        $radio = $_POST['formdata'][4]['value'];

        $pet_id = $_POST['formdata'][5]['value'];
        $pet_name = $_POST['formdata'][6]['value'];

        $message = '';
        $puppy_link = $this->get_puppy_for_reference_number( $pet_id );

        $puppy_breed = $this->get_breed_for_reference_number( $pet_id );

        $slug = 'ps-puppy';

        $this->send_puppy_info_to_pipelines( $slug, $email, $first_name, $last_name, $phone, $message, $pet_id, $pet_name, $puppy_link , $puppy_breed);


    }

    public function getreference_no_for_sku( $sku ){

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

            if(get_post_meta( $pet->ID, '_sku',true) == $sku ) {
                $this->pet_id = $pet->ID;
                return get_post_meta( $pet->ID, '_pdm_pet_ref_no',true);
            }
        }

        return 'Not found';
    }

    public function get_puppy_for_sku( $sku ){

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

            if(get_post_meta( $pet->ID, '_sku',true) == $sku ) {
                $this->pet_id = $pet->ID;
                return get_permalink( $pet->ID );
            }
        }

        return 'Link not found';
    }

    public function get_puppy_for_reference_number( $ref_no ){

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

            if(get_post_meta( $pet->ID, '_pdm_pet_ref_no',true) == $ref_no ) {
                $this->pet_id = $pet->ID;
                return get_permalink( $pet->ID );
            }
        }

        return 'Link not found';
    }

    public function get_breed_for_reference_number( $ref_no ){

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

            if(get_post_meta( $pet->ID, '_pdm_pet_ref_no',true) == $ref_no ) {
                $this->pet_id = $pet->ID;
                return get_post_meta( $pet->ID, '_pdm_pet_breed',true);
            }
        }

        return '';
    }

    public function send_puppy_info_to_pipelines( $slug, $email, $first_name = '', $last_name = '', $phone = '', $message = "  ", $puppy_id = null, $puppy_name = null, $puppy_link = '' , $breed = null  ){

        $pipelines = new tsl_pd_pipelines_crm_manager();
        $full_name = $first_name . ' ' . $last_name;

        $values = null;

        if($puppy_name) $values['puppy_name'] = $puppy_name;
        if($puppy_id) $values['puppy_id'] = $puppy_id;

        if(!$puppy_link && $puppy_id){
            $puppy_link = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        }

        if($puppy_id) $puppy_subject = 'about ' . $puppy_name . ' ('.$puppy_id.')';

        $pipelines->get_contact($email, true, $first_name , $last_name , $phone , $puppy_link);

        $store_tag = array( get_option('tsl-pipelines-store-id') , 'PetID '.$puppy_id , 'Puppy Inquiry' );

        if($puppy_name) $store_tag[] = $puppy_name;
        if($breed) $store_tag[] = $breed;

        $user_id = get_option( 'tsl-ps-pipelines-contact-'.$slug );

        $body = $message;
        $subject = get_option('tsl-ps-pipelines-response-subject-'.$slug );

        if($values) $body = $this->replace_fields_in_text(get_option('tsl-ps-pipelines-response-body-'.$slug).'%0D%0A%0D%0A' . $message, $values );
        if($values) $subject = $this->replace_fields_in_text( get_option('tsl-ps-pipelines-response-subject-'.$slug ) , $values );

            $email_html = '<table>';
            $email_html .= '<tr><td colspan="2">We received an inquiry from the web site '.$puppy_subject.'</td></tr>';
            $email_html .= '<tr><td>Name:</td><td>'.$full_name.'</td></tr>';
            $email_html .= '<tr><td>Email:</td><td>'.$this->format_email_link( $email , $subject , $body ) .'</td></tr>';
            if($phone) $email_html .= '<tr><td>Phone:</td><td>'.$phone.'</td></tr>';
            $email_html .= '<tr><td>Message:</td><td>'.$message.'</td></tr>';
            if($puppy_name) $email_html .= '<tr><td>Puppy Name:</td><td>'.$puppy_name.'</td></tr>';
            if($puppy_id) $email_html .= '<tr><td>Puppy ID:</td><td>'.$puppy_id.'</td></tr>';
            if($puppy_link) $email_html .= '<tr><td>Puppy:</td><td><a clicktracking=off href="'.$puppy_link.'">Puppy Info</a></td></tr>';

            $email_html .= '</table>';

        $task_info = $pipelines->add_deal( $full_name . ' - ' . $puppy_name . ' - ' . $puppy_id, $user_id, $this->get_puppy_price_value() , $email_html );

        if($task_info){

            $domain_prefix = get_option( 'tsl-ps-pipelines-domain' );

            $email_html = '<table>';
            $email_html .= '<tr><td colspan="2">We received an inquiry from the web site '.$puppy_subject.'</td></tr>';
            $email_html .= '<tr><td>Name:</td><td>'.$full_name.'</td></tr>';
            $email_html .= '<tr><td>Email:</td><td>'.$this->format_email_link( $email , $subject , $body ) .'</td></tr>';
            if($phone) $email_html .= '<tr><td>Phone:</td><td>'.$phone.'</td></tr>';
            $email_html .= '<tr><td>Message:</td><td>'.$message.'</td></tr>';
//            $email_html .= '<tr><td colspan="2"><a clicktracking=off href="https://'.$domain_prefix.'.pipelinescrm.com/#task/'.$task_info['id'].'">Link to Task on pipelinesCRM</a></td></tr>';
            if($puppy_name) $email_html .= '<tr><td>Puppy Name:</td><td>'.$puppy_name.'</td></tr>';
            if($puppy_id) $email_html .= '<tr><td>Puppy ID:</td><td>'.$puppy_id.'</td></tr>';
            if($puppy_link) $email_html .= '<tr><td>Puppy:</td><td><a clicktracking=off href="'.$puppy_link.'">Puppy Info</a></td></tr>';

            $email_html .= '</table>';
            $headers = array('Content-Type: text/html; charset=UTF-8');

            wp_mail($task_info['taskOwner']['email'], $subject , $email_html , $headers );

        }
    }

    public function gravity_form_submission_handler_puppy_info( $form ){

        $slug = 'ps-puppy';

        $form_handler = new ps_gravity_forms_forms_manager();
        if($form_handler->is_gravity_forms_loaded()) {

            $email = $this->get_email_value( $slug );
            $first_name = $this->get_first_name_value( $slug );
            $last_name = $this->get_last_name_value( $slug );
            $phone = $this->get_phone_value( $slug );
            $message = $this->get_comments_value( $slug );
            $puppy_id = $this->get_puppy_id_value( $slug );
            $puppy_name = $this->get_puppy_name_value( $slug );
            $puppy_link = $this->get_puppy_link_value( $slug );
            $puppy_breed = $this->get_puppy_breed_value( $slug );

            $this->send_puppy_info_to_pipelines( $slug, $email, $first_name, $last_name, $phone, $message, $puppy_id, $puppy_name, $puppy_link , $puppy_breed);

        }
    }

    public function gravity_form_submission_handler_breed_interest( $form ){

        $slug = 'ps-puppy-breed-interest';

        $form_handler = new ps_gravity_forms_forms_manager();
        if($form_handler->is_gravity_forms_loaded()) {

            $email = $this->get_email_value( $slug );
            $first_name = $this->get_first_name_value( $slug );
            $last_name = $this->get_last_name_value( $slug );
            $phone = $this->get_phone_value( $slug );
            $message = $this->get_comments_value( $slug );

            $this->send_puppy_info_to_pipelines( $slug, $email, $first_name, $last_name, $phone, $message );

        }

    }

    public function gravity_form_submission_handler_newsletter( $form )
    {

        $slug = 'ps-puppy-newsletter';

        $form_handler = new ps_gravity_forms_forms_manager();
        if ($form_handler->is_gravity_forms_loaded()) {

            $pipelines = new tsl_pd_pipelines_crm_manager();
            $email = $this->get_email_value($slug);
            $first_name = $this->get_first_name_value($slug);
            $last_name = $this->get_last_name_value($slug);

            $pipelines->get_contact($email, true, $first_name, $last_name );

            $store_tag = array(get_option('tsl-pipelines-store-id'), 'Newsletter' );

//            if ($store_tag) $pipelines->add_tags($pipelines->contact_id, $store_tag);

        }
    }

    public function gravity_form_submission_handler_general_contact( $form ){

        $slug = 'ps-general-contact';

        $form_handler = new ps_gravity_forms_forms_manager();
        if($form_handler->is_gravity_forms_loaded()) {

            $pipelines = new tsl_pd_pipelines_crm_manager();
            $email = $this->get_email_value( $slug );
            $first_name = $this->get_first_name_value( $slug );
            $last_name = $this->get_last_name_value( $slug );
            $phone = $this->get_phone_value( $slug );
            $message = $this->get_comments_value( $slug );

            $full_name = $first_name . ' ' . $last_name;

            $pipelines->get_contact($email, true, $first_name , $last_name , $phone);

            $store_tag = array(get_option('tsl-pipelines-store-id'));

//            if($store_tag) $pipelines->add_tags( $pipelines->contact_id , $store_tag );

            $user_id = get_option('tsl-ps-pipelines-contact-'.$slug);
            $subject = get_option('tsl-ps-pipelines-response-body-'.$slug);

            $task_info = $pipelines->add_deal( $full_name, $user_id, $this->get_puppy_price_value() );

            if($task_info){

                $domain_prefix = 'thepuppystore';//get_option( 'tsl-ps-pipelines-domain' );
                $body = get_option('tsl-ps-pipelines-response-subject-'.$slug).'%0D%0A%0D%0A' . $message;

                $email_html = '<table>';
                $email_html .= '<tr><td colspan="2">We received an inquiry from the web site</td></tr>';
                $email_html .= '<tr><td>Name:</td><td>'.$full_name.'</td></tr>';
                $email_html .= '<tr><td>Email:</td><td>'.$this->format_email_link( $email , $subject , $body ) .'</td></tr>';
                if($phone) $email_html .= '<tr><td>Phone:</td><td>'.$phone.'</td></tr>';
                $email_html .= '<tr><td>Message:</td><td>'.$message.'</td></tr>';
//      //todo fix this url
//                $email_html .= '<tr><td colspan="2"><a clicktracking=off href="https://'.$domain_prefix.'.pipelinescrm.com/#task/'.$task_info['id'].'">Link to Task on pipelines</a></td></tr>';
                $email_html .= '</table>';
                $headers = array('Content-Type: text/html; charset=UTF-8');

                wp_mail($task_info['taskOwner']['email'], $subject , $email_html , $headers );

            }
        }
    }

    function replace_fields_in_text( $text , $values = array() ){

        $replace_array[] = array('tag' => '**|PUPPY NAME|**' , 'replace_with' => 'puppy_name' );

        foreach ($replace_array as $item) {

            $text = str_replace($item['tag'], $values[$item['replace_with']], $text);

        }

        return $text;
    }

    function format_email_link( $email = null, $subject = null , $body = null ){

        if(!$email) return '';

        $link = '<a href="mailto:'.$email;
        if($subject) $link .= '?subject='.$subject;
        if($body) $link .= '&body='.$body.'">'.$email.'</a>​';

        Return $link;

    }

    function get_full_name_value( $form_slug ){

        $field_slug = 'ps-full-name';
        return $this->get_value( $form_slug , $field_slug );

    }

    function get_first_name_value( $form_slug ){

        $field_slug = 'ps-first-name';
        return $this->get_value( $form_slug , $field_slug );

    }

    function get_last_name_value( $form_slug ){

        $field_slug = 'ps-last-name';
        return $this->get_value( $form_slug , $field_slug );

    }

    function get_phone_value( $form_slug ){

        $field_slug = 'ps-phone';
        return $this->get_value( $form_slug , $field_slug );

    }

    function get_comments_value( $form_slug ){

        $field_slug = 'comments';
        return $this->get_value( $form_slug , $field_slug );

    }

    function get_ok_to_text_value( $form_slug ){

        $field_slug = 'ok-to-text';
        return $this->get_value( $form_slug , $field_slug );

    }

    function get_puppy_id_value( $form_slug ){

        $field_slug = 'ps-puppy-id';
        return $this->get_value( $form_slug , $field_slug );

    }

    function get_puppy_name_value( $form_slug ){

        $field_slug = 'ps-puppy-name';
        return $this->get_value( $form_slug , $field_slug );

    }

    function get_puppy_link_value( $form_slug )
    {
        $field_slug = 'ps-puppy-link';
        return $this->get_value( $form_slug , $field_slug );
    }

    function get_email_value( $form_slug ){

        $field_slug = 'ps-email';
        return $this->get_value( $form_slug , $field_slug );

    }

    function get_value( $form_slug, $field_slug ){

        $form_id = get_option('tsl-ps-form-'.$form_slug.'-form');
        $field_id = get_option('tsl-ps-form-'.$form_id.'-'.$field_slug.'-form-field');

        return $_REQUEST['input_' . $field_id ];

    }

    function get_puppy_breed_value(  $form_slug ){

        $field_slug = 'ps-puppy-breed';
        return $this->get_value( $form_slug , $field_slug );

    }

    function get_puppy_price_value(){

        return get_post_meta( $this->pet_id , '_price' , true );

    }

    function add_settings_page(){

		$admin_settings_page = new tsl_puppy_store_pipelines_crm_admin_settings_page();
		$admin_settings_page->add_settings_page();
	}

    function admin_manager_scripts(){
		wp_register_style('tsl-general-css', plugins_url( "css/tsl-general-css.css", __FILE__ ), array(), $this->app_version, 'screen');
	    wp_enqueue_style(array( 'tsl-general-css' ));
	}
}