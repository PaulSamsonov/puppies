<?php


class tsl_puppy_store_pipelines_crm_admin_settings_page
{

    private $users_list;

    function add_settings_page()
    {

        if (empty ($GLOBALS['admin_page_hooks']['local_app_metrics'])) {
            add_menu_page('PS Pipedrive CRM', 'PS Pipedrive CRM', 'manage_options', 'tsl-puppy-store-pipelines-settings', array($this, 'create_admin_page'), 'dashicons-networking', 10);
        }
    }

    function create_admin_page(){

        if(isset($_REQUEST['testing'])){
            echo '<pre>Test<br><br>';
            $pipelines = new tsl_pd_pipelines_crm_manager();
            $pipelines->debug_mode = true;
            $slug = 'ps-puppy-video';
            $selected = get_option('tsl-ps-pipelines-contact-'.$slug);

            $output = $pipelines->get_contact( 'TEST@massdivision.com' , true );
            $pipelines->add_deal( 'test', $selected , 1500 );

            print_r($output);
        }

        $html_line = '<div class="tsl-admin-settings-holder">';

        $html_line .= $this->headline('Puppy Store pipelines CRM Settings');

        $html_line .= '<form method="get">';
        $html_line .= '<input type="hidden" value="tsl-puppy-store-pipelines-settings" name="page">';

        $store_info['id'] = 'tsl-pipelines-store-id';
        $store_info['title'] = 'Store Tag';

        $html_line .= $this->do_text_field( $store_info);

        $html_line .= $this->section_seperator();

        $html_line .= $this->sub_heading('Puppy Form');

        $slug = 'ps-puppy';
		$html_line .= $this->assign_form($slug , 'Puppy Information Form');
        $html_line .= $this->do_assign_pipelines_user( $slug );
        $html_line .= $this->do_response_email_subject( $slug );
        $html_line .= $this->do_response_email_body( $slug );


		if(get_option('tsl-ps-form-'.$slug.'-form')){

			$field_slug = 'ps-first-name';
			$html_line .= $this->assign_form_field($field_slug , 'First Name Field' , get_option('tsl-ps-form-'.$slug.'-form'));
			$field_slug = 'ps-last-name';
			$html_line .= $this->assign_form_field($field_slug , 'Last Name Field' , get_option('tsl-ps-form-'.$slug.'-form'));
			$field_slug = 'ps-email';
			$html_line .= $this->assign_form_field($field_slug , 'Email Name Field' , get_option('tsl-ps-form-'.$slug.'-form'));
			$field_slug = 'ps-phone';
			$html_line .= $this->assign_form_field($field_slug , 'Phone Field' , get_option('tsl-ps-form-'.$slug.'-form'));
			$field_slug = 'comments';
			$html_line .= $this->assign_form_field($field_slug , 'Comments Field' , get_option('tsl-ps-form-'.$slug.'-form'));
			$field_slug = 'ok-to-text';
			$html_line .= $this->assign_form_field($field_slug , 'Okay to Text Field' , get_option('tsl-ps-form-'.$slug.'-form'));
			$field_slug = 'ps-puppy-id';
			$html_line .= $this->assign_form_field($field_slug , 'Puppy ID Field' , get_option('tsl-ps-form-'.$slug.'-form'));
			$field_slug = 'ps-puppy-name';
			$html_line .= $this->assign_form_field($field_slug , 'Puppy Name Field' , get_option('tsl-ps-form-'.$slug.'-form'));
			$field_slug = 'ps-puppy-reference';
			$html_line .= $this->assign_form_field($field_slug , 'Puppy Reference Field' , get_option('tsl-ps-form-'.$slug.'-form'));
			$field_slug = 'ps-puppy-link';
			$html_line .= $this->assign_form_field($field_slug , 'Puppy Link Field' , get_option('tsl-ps-form-'.$slug.'-form'));
			$field_slug = 'ps-puppy-breed';
			$html_line .= $this->assign_form_field($field_slug , 'Puppy Breed Field' , get_option('tsl-ps-form-'.$slug.'-form'));
		}

		$html_line .= $this->section_seperator();

        $html_line .= $this->sub_heading('Puppy Video RequestForm');

        $slug = 'ps-puppy-video';
		$html_line .= $this->assign_form($slug , 'Puppy Video Form');
        $html_line .= $this->do_assign_pipelines_user( $slug );
        $html_line .= $this->do_response_email_subject( $slug );
        $html_line .= $this->do_response_email_body( $slug );


		if(get_option('tsl-ps-form-'.$slug.'-form')){

			$field_slug = 'ps-first-name';
			$html_line .= $this->assign_form_field($field_slug , 'First Name Field' , get_option('tsl-ps-form-'.$slug.'-form'));
			$field_slug = 'ps-last-name';
			$html_line .= $this->assign_form_field($field_slug , 'Last Name Field' , get_option('tsl-ps-form-'.$slug.'-form'));
			$field_slug = 'ps-email';
			$html_line .= $this->assign_form_field($field_slug , 'Email Name Field' , get_option('tsl-ps-form-'.$slug.'-form'));
			$field_slug = 'ps-phone';
			$html_line .= $this->assign_form_field($field_slug , 'Phone Field' , get_option('tsl-ps-form-'.$slug.'-form'));
			$field_slug = 'comments';
			$html_line .= $this->assign_form_field($field_slug , 'Comments Field' , get_option('tsl-ps-form-'.$slug.'-form'));
			$field_slug = 'ok-to-text';
			$html_line .= $this->assign_form_field($field_slug , 'Okay to Text Field' , get_option('tsl-ps-form-'.$slug.'-form'));
			$field_slug = 'ps-puppy-id';
			$html_line .= $this->assign_form_field($field_slug , 'Puppy ID Field' , get_option('tsl-ps-form-'.$slug.'-form'));
			$field_slug = 'ps-puppy-name';
			$html_line .= $this->assign_form_field($field_slug , 'Puppy Name Field' , get_option('tsl-ps-form-'.$slug.'-form'));
			$field_slug = 'ps-puppy-reference';
			$html_line .= $this->assign_form_field($field_slug , 'Puppy Reference Field' , get_option('tsl-ps-form-'.$slug.'-form'));
			$field_slug = 'ps-puppy-link';
			$html_line .= $this->assign_form_field($field_slug , 'Puppy Link Field' , get_option('tsl-ps-form-'.$slug.'-form'));
			$field_slug = 'ps-puppy-breed';
			$html_line .= $this->assign_form_field($field_slug , 'Puppy Breed Field' , get_option('tsl-ps-form-'.$slug.'-form'));
		}

		$html_line .= $this->section_seperator();


		$slug = 'ps-puppy-breed-interest';
		$html_line .= $this->assign_form($slug , 'Puupy Match Email Sign Up Form');
		if(get_option('tsl-ps-form-'.$slug.'-form')){

		    $html_line .= $this->do_assign_pipelines_user( $slug );
		    $html_line .= $this->do_response_email_subject( $slug );
		    $html_line .= $this->do_response_email_body( $slug );

			$field_slug = 'ps-first-name';
			$html_line .= $this->assign_form_field($field_slug , 'Name Field' , get_option('tsl-ps-form-'.$slug.'-form'));
			$field_slug = 'ps-last-name';
			$html_line .= $this->assign_form_field($field_slug , 'Last Name Field' , get_option('tsl-ps-form-'.$slug.'-form'));
			$field_slug = 'ps-email';
			$html_line .= $this->assign_form_field($field_slug , 'Email Field' , get_option('tsl-ps-form-'.$slug.'-form'));
			$field_slug = 'ps-phone';
			$html_line .= $this->assign_form_field($field_slug , 'Phone Field' , get_option('tsl-ps-form-'.$slug.'-form'));
			$field_slug = 'comments';
			$html_line .= $this->assign_form_field($field_slug , 'Puppy Quiz Answers Field' , get_option('tsl-ps-form-'.$slug.'-form'));
			$field_slug = 'ps-puppy-breed';
			$html_line .= $this->assign_form_field($field_slug , 'Puppy Breed Field' , get_option('tsl-ps-form-'.$slug.'-form'));

		}

		$html_line .= $this->section_seperator();

		$slug = 'ps-general-contact';
		$html_line .= $this->assign_form($slug , 'Contact Us Form');
		if(get_option('tsl-ps-form-'.$slug.'-form')){

		    $html_line .= $this->do_assign_pipelines_user( $slug );
		    $html_line .= $this->do_response_email_subject( $slug );
		    $html_line .= $this->do_response_email_body( $slug );

			$field_slug = 'ps-first-name';
			$html_line .= $this->assign_form_field($field_slug , 'First Name Field' , get_option('tsl-ps-form-'.$slug.'-form'));
			$field_slug = 'ps-last-name';
			$html_line .= $this->assign_form_field($field_slug , 'Last Name Field' , get_option('tsl-ps-form-'.$slug.'-form'));
			$field_slug = 'ps-email';
			$html_line .= $this->assign_form_field($field_slug , 'Email Field' , get_option('tsl-ps-form-'.$slug.'-form'));
			$field_slug = 'ps-phone';
			$html_line .= $this->assign_form_field($field_slug , 'Phone Field' , get_option('tsl-ps-form-'.$slug.'-form'));
			$field_slug = 'comments';
			$html_line .= $this->assign_form_field($field_slug , 'Comments Field' , get_option('tsl-ps-form-'.$slug.'-form'));
//			$field_slug = 'ok-to-text';
//			$html_line .= $this->assign_form_field($field_slug , 'Okay to Text Field' , get_option('tsl-ps-form-'.$slug.'-form'));

		}

        $html_line .= $this->section_seperator();

		$slug = 'ps-puppy-newsletter';
		$html_line .= $this->assign_form($slug , 'Newsletter Sign Up Form');
		if(get_option('tsl-ps-form-'.$slug.'-form')) {

            $field_slug = 'ps-first-name';
            $html_line .= $this->assign_form_field($field_slug, 'First Name Field', get_option('tsl-ps-form-' . $slug . '-form'));
            $field_slug = 'ps-last-name';
            $html_line .= $this->assign_form_field($field_slug, 'Last Name Field', get_option('tsl-ps-form-' . $slug . '-form'));
            $field_slug = 'ps-email';
			$html_line .= $this->assign_form_field($field_slug , 'Email Field' , get_option('tsl-ps-form-'.$slug.'-form'));

        }

        $html_line .= $this->section_seperator();

		$html_line .= $this->do_pipelines_login_text_field( );


        $html_line .= $this->section_seperator();

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


    function do_response_email_subject( $slug){

        if(isset($_REQUEST['tsl-ps-pipelines-response-subject-'.$slug])){
			update_option('tsl-ps-pipelines-response-subject-'.$slug , $_REQUEST['tsl-ps-pipelines-response-subject-'.$slug] );
		}

		$selected = get_option('tsl-ps-pipelines-response-subject-'.$slug);

		$html_line = '<table class="tsl-admin-pref-table" >';
		$html_line .= '<tr>';
		$html_line .= '<td class="tsl-admin-pref-table-heading">pipelines Response Email Subject:</td>';
		$html_line .= '<td class="tsl-admin-pref-table-heading" align="right">'.$this->make_textfield( 'tsl-ps-pipelines-response-subject-'.$slug,  $selected).'</td>';
		$html_line .= '</tr>';
		$html_line .= '</table>';

		return $html_line;

    }

    function do_response_email_body( $slug){

        if(isset($_REQUEST['tsl-ps-pipelines-response-body-'.$slug])){
			update_option('tsl-ps-pipelines-response-body-'.$slug , $_REQUEST['tsl-ps-pipelines-response-body-'.$slug] );
		}

		$selected = get_option('tsl-ps-pipelines-response-body-'.$slug);

		$html_line = '<table class="tsl-admin-pref-table" >';
		$html_line .= '<tr>';
		$html_line .= '<td class="tsl-admin-pref-table-heading">pipelines Response Email Body:</td>';
		$html_line .= '<td class="tsl-admin-pref-table-heading" align="right">'.$this->make_textarea( 'tsl-ps-pipelines-response-body-'.$slug,  $selected).'</td>';
		$html_line .= '</tr>';
		$html_line .= '</table>';

		return $html_line;

    }

    function do_assign_pipelines_user( $slug ){

        if(isset($_REQUEST['tsl-ps-pipelines-contact-'.$slug])){
			update_option('tsl-ps-pipelines-contact-'.$slug , $_REQUEST['tsl-ps-pipelines-contact-'.$slug] );
		}

		$selected = get_option('tsl-ps-pipelines-contact-'.$slug);

		$html_line = '<table class="tsl-admin-pref-table" >';
		$html_line .= '<tr>';
		$html_line .= '<td class="tsl-admin-pref-table-heading">pipelines User Email:</td>';
		$html_line .= '<td class="tsl-admin-pref-table-heading" align="right">'.$this->make_dropdown( 'tsl-ps-pipelines-contact-'.$slug, $this->make_pipelines_user_list(), $selected).'</td>';
		$html_line .= '</tr>';
		$html_line .= '</table>';

		return $html_line;

    }

    function assign_form( $slug , $title ){

		if(isset($_REQUEST['tsl-ps-form-'.$slug.'-form'])){
		    if( $_REQUEST['tsl-ps-form-'.$slug.'-form'] == 0){
		        delete_option('tsl-ps-form-' . $slug . '-form' );
            }else {
                update_option('tsl-ps-form-' . $slug . '-form', $_REQUEST['tsl-ps-form-' . $slug . '-form']);
            }
		}

		$selected = get_option('tsl-ps-form-'.$slug.'-form');

		$html_line = '<table class="tsl-admin-pref-table" >';
		$html_line .= '<tr>';
		$html_line .= '<td class="tsl-admin-pref-table-heading">'.$title.':</td>';
		$html_line .= '<td class="tsl-admin-pref-table-heading" align="right">'.$this->make_dropdown( 'tsl-ps-form-'.$slug.'-form', $this->make_form_list(), $selected).'</td>';
		$html_line .= '</tr>';
		$html_line .= '</table>';

		return $html_line;

	}

	function assign_form_field( $slug , $title , $form_id ){

		if(isset($_REQUEST['tsl-ps-form-'.$form_id.'-'.$slug.'-form-field'])){
			update_option('tsl-ps-form-'.$form_id.'-'.$slug.'-form-field' , $_REQUEST['tsl-ps-form-'.$form_id.'-'.$slug.'-form-field'] );
		}

		$selected = get_option('tsl-ps-form-'.$form_id.'-'.$slug.'-form-field');

		$html_line = '<table class="tsl-admin-pref-table">';
		$html_line .= '<tr>';
		$html_line .= '<td class="tsl-admin-pref-table-heading">'.$title.':</td>';
		$html_line .= '<td class="tsl-admin-pref-table-heading" align="right">'.$this->make_dropdown( 'tsl-ps-form-'.$form_id.'-'.$slug.'-form-field', $this->make_form_field_list( $form_id ), $selected).'</td>';
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

	function make_pipelines_user_list(){

        if( $this->users_list ){
            return $this->users_list;
        }

        $forms = array();

        $pipelines = new tsl_pd_pipelines_crm_manager();
        $Users = $pipelines->get_all_users();

        if($Users) {

            foreach ($Users['data'] as $user) {

                $forms[] = array('slug' => $user['id'], 'name' => $user['name'] . ' - ' . $user['email']);
            }
        }

        $this->users_list = $forms;

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

		if( ! $selected ){
		    $html_line .= '<option value="0" selected>Select...</option>';
        }else{
		     $html_line .= '<option value="0" >Select...</option>';
        }

		foreach($options as $option){
			$selected_item = '';
			if($option['slug'] == $selected ) $selected_item = 'selected';
			$html_line .= '<option  value="'.$option['slug'].'" '.$selected_item.'>' .$option['name'].'</option>';
		}

		$html_line .= '</select>';

		return $html_line;

	}



    function make_apikey( $id,  $value = ''){

        $html_line = '<table class="tsl-admin-pref-table">';
		$html_line .= '<tr>';
		$html_line .= '<td><input type="text" style="width:400px;" id="'.$id.'" name="'.$id.'" value="'.$value.'"></td>';
		$html_line .= '</tr>';

		$html_line .= '</table>';

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

    function do_text_field( $variable ){

        if(  isset($_REQUEST[$variable['id']]) ){
			update_option($variable['id'] , $_REQUEST[$variable['id']] );
		}

		$selected = get_option($variable['id']);

        $html_line = '<table class="tsl-admin-pref-table">';
		$html_line .= '<tr>';
		$html_line .= '<td class="tsl-admin-pref-table-heading">'.$variable['title'].':</td>';
		$html_line .= '<td class="tsl-admin-pref-table-heading" align="right">'.$this->make_textfield( $variable['id'] , $selected).'</td>';
		$html_line .= '</tr>';
		$html_line .= '</table>';

		return $html_line;
    }

    function make_textfield( $id,  $value = ''){

        return '<input type="text" id="'.$id.'" name="'.$id.'" value="'.$value.'">';
    }

    function make_textarea( $id, $value = ''){

        return '<textarea id="'.$id.'" name="'.$id.'" rows="4" cols="50">'.$value.'</textarea>';
    }

    function do_pipelines_login_text_field(){

        if(  isset($_REQUEST['pipelines_email']) ){
			update_option('tsl-ps-pipelines-email' , $_REQUEST['pipelines_email'] );
		}
		$email_address = get_option( 'tsl-ps-pipelines-email' );

        if(  isset($_REQUEST['pipelines_domain']) ){
			update_option('tsl-ps-pipelines-domain' , $_REQUEST['pipelines_domain'] );
		}
		$domain_prefix = get_option( 'tsl-ps-pipelines-domain' );

        if(  isset($_REQUEST['pipelines_api_key']) ){
			update_option('tsl-ps-pipelines-api_key' , $_REQUEST['pipelines_api_key'] );
		}
		$api_key = get_option( 'tsl-ps-pipelines-api_key' );


        $html_line = '<table class="tsl-admin-pref-table">';
		$html_line .= '<tr>';
		$html_line .= '<td class="tsl-admin-pref-table-heading">pipelines Email Address:</td>';
		$html_line .= '<td class="tsl-admin-pref-table-heading" align="right">'.$this->make_textfield( 'pipelines_email' , $email_address).'</td>';
		$html_line .= '</tr>';

		$html_line .= '<tr>';
		$html_line .= '<td class="tsl-admin-pref-table-heading">pipelines Domain Address:</td>';
		$html_line .= '<td class="tsl-admin-pref-table-heading" align="right">'.$this->make_textfield( 'pipelines_domain' , $domain_prefix).'</td>';
		$html_line .= '</tr>';

		$html_line .= '<tr>';
		$html_line .= '<td class="tsl-admin-pref-table-heading">pipelines API Key:</td>';
		$html_line .= '<td class="tsl-admin-pref-table-heading" align="right">'.$this->make_textfield( 'pipelines_api_key' , $api_key).'</td>';
		$html_line .= '</tr>';

		$html_line .= '</table>';

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