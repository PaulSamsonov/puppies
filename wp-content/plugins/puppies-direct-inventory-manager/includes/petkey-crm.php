<?php
/**
 * Created by PhpStorm.
 * User: Fred
 * Date: 5/1/18
 * Time: 4:51 PM
 */

class tsl_petkey_crm{

    public $PetId;
    public $FirstName;
    public $LastName;
    public $Phone;
    public $Email;
    public $Message;
    public $Notes;
    public $Source = 'Online';

    function send_contact_form(){

        $key = '1f6f9919-90e5-472f-ab33-7c54d6ace30d';

        $body_array['PetId']     = $this->PetId;
        $body_array['FirstName'] = $this->FirstName;
        $body_array['LastName']  = $this->LastName;
        $body_array['Phone']     = $this->Phone;
        $body_array['Email']     = $this->Email;
        $body_array['Message']   = $this->Message;
        $body_array['Notes']     = $this->Notes;
        $body_array['Source']    = 'Online';

        foreach( $body_array as $index => $field ){
            if( strlen( $field ) == 0 ) $body_array[$index] = 'No Data: ' . $index;
        }

        $response = wp_remote_post( "http://api.petkey.org/v4/partners/CustomerInquiry", array(
                'method' => 'POST',
                'timeout' => 45,
                'redirection' => 5,
                'httpversion' => '1.0',
                'blocking' => true,
                'headers' => array('Authorization' => 'PETKEY-AUTH ' . $key),
                'body' => $body_array,
                'cookies' => array()
            )
        );

            if (is_wp_error($response)) {
                $error_message = $response->get_error_message();
            } else {
//                echo '<pre>';
//                print_r($response);
//                return;
//                $data = json_decode(wp_remote_retrieve_body($response), true);

//                print_r($data);
//                echo '</pre>';
//                return;

            }

    }



}