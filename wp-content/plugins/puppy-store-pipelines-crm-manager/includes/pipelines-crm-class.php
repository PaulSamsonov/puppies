<?php

class tsl_pd_pipelines_crm_manager
{

    private $deals_array = array();
    private $deal_id = null;

    private $user_id = null;

    public $contact_array = array();
    private $contact_email_array = array();
    public $contact_id = null;

    private $contacts_array = array();

    private $pipelines_domain;
    private $pipelines_user_email;
    private $pipelines_api_key;

    public $debug_mode;

    function __construct()
    {

        $this->pipelines_api_key = get_option( 'tsl-ps-pipelines-api_key' );
        $this->pipelines_domain = get_option( 'tsl-ps-pipelines-domain' );
        $this->pipelines_user_email = get_option( 'tsl-ps-pipelines-email' );

        $this->debug_mode = false;

    }

    function strip_http( $website_url ){

        $website_url = str_replace("http://",'',$website_url);
        $website_url = str_replace("https://",'',$website_url);
        $website_url = str_replace("~",'',$website_url);

        if(substr( $website_url , -1) == "/"){
            $website_url = substr($website_url, 0, -1);
        }

        return $website_url;

    }

    function get_contact( $email_address , $add = false, $firstname = null , $last_name = null , $phone = null , $url = null ){

        $contact = $this->tsl_pipelines_crm_curl_wrap("GET" , 'persons/find?term='. $email_address.'&search_by_email=true', true );
        $contact = json_decode($contact, True);

        if($firstname == null){
            $firstname = $this->create_first_name( $email_address );
        }

        if (is_array($contact) && sizeof( $contact['data']) > 0 ) {
            $this->contact_id = $contact['data'][0]['id'];
            $this->contact_array = $contact['data'][0];
        }else {
            if ($add) {
                $this->add_contact($email_address, $firstname , $phone );
            }
        }

        return $this->contact_array;

    }

    function remove_tag( $email , $tag  ){

        $fields = array(
            'email' => $email,
            'tags' => urlencode('["'.$tag.'"]')
            );
        $fields_string = '';

        foreach ($fields as $key => $value) {
            $fields_string .= $key . '=' . $value . '&';
        }

        $this->tsl_pipelines_crm_curl_wrap("contacts/email/tags/delete", rtrim($fields_string, '&'), "POST", "application/x-www-form-urlencoded");

    }

    function add_tags( $record_id , $tags_array ){

        return;

        $contact_json = array(
            "id" => $record_id, //It is mandatory field. Id of contact
            "tags" => $tags_array
        );

        $contact_json = json_encode($contact_json);
        $result = $this->tsl_pipelines_crm_curl_wrap("contacts/edit/tags", $contact_json, "PUT", "application/json");
        $result = json_decode($result, True);


        $this->contact_array = $result;

    }

    function add_contact( $email_address , $name = null,  $phone = null  ){

        if($name == null){
            $name = $this->create_first_name( $email_address );
        }

        $name = trim( $name );

        $contact_json["email"][] = $email_address;
        $contact_json["name"] = $name;
        $contact_json["visible_to"] = 3;
        if($phone) $contact_json["phone"][] = $phone;

        $result = $this->tsl_pipelines_crm_curl_wrap('POST' , 'persons' , false, $contact_json );
        $result = json_decode($result, True);
        $this->contact_id = $result['data'][0]['id'];
        $this->contact_array = $result['data'][0];

    }


    function add_note( $deal_id , $content = ''){

        $note_json = array(  "content" => $content,  "deal_id"=>$deal_id  );

        $this->tsl_pipelines_crm_curl_wrap("POST", 'notes', false, $note_json);
    }

    function create_first_name( $email_address ){

        $parts = explode("@", $email_address );

        return $parts[0];

    }

    function get_deals(){

        $deals = $this->tsl_pipelines_crm_curl_wrap("contacts/" . $this->contact_id . "/deals", null, "GET", "application/json");
        $deals = json_decode($deals, True);

        $this->deal_id = $deals[sizeof($deals) - 1]['id'];
        $this->deals_array = $deals;

    }

    function add_deal($title, $user_id , $value , $note = null ){

        $deal_json["title"] = $title;
        $deal_json["value"] = $value;
        $deal_json["user_id"] = $user_id;
        $deal_json["person_id"] = $this->contact_id;
        $deal_json["status"] = 'open';
        $deal_json["visible_to"] = '3';

        $result = $this->tsl_pipelines_crm_curl_wrap('POST' , 'deals' , false, $deal_json );
        $deal = json_decode($result, True);

        $this->deal_id = $deal['id'];
        $this->deals_array = $deal;

        if($note ){

            $this->add_note( $deal["id"] , $note );

        }

        return true;

    }

    function update_deal($milestone , $deal_id = null)
    {
        if( ! $deal_id ) $deal_id = $this->deal_id;
        if( ! $deal_id ) return;

        $opportunity_json = array(
            "id" => $deal_id, //It is mandatory field. Id of deal
            "milestone" => $milestone
        );

        $opportunity_json = json_encode($opportunity_json);
        $deals = $this->tsl_pipelines_crm_curl_wrap("opportunity/partial-update", $opportunity_json, "PUT", "application/json");
        $deals = json_decode($deals, True);

        $this->deals_array = $deals;
    }

    function get_contacts(){

        $contacts = $this->tsl_pipelines_crm_curl_wrap("contacts/related/".$this->company_id."?page_size=25", null, "GET", "application/json");
        $contacts = json_decode($contacts, True);

        $contact_array = array();
        $contact_email_array = array();

        for($x=0;$x<sizeof($contacts);$x++){
            $properties = $contacts[$x]['properties'];

            for ($y = 0; $y < sizeof($properties); $y++) {
                if ($properties[$y]['name'] == 'email' ) {
                    $contact_email_array[] = $properties[$y]['value'];
                }
            }

            $contact_array[] = $contacts[$x]['id'];
        }

        $this->contacts_array = $contact_array;
        $this->contact_email_array = $contact_email_array;

    }

    function add_task( $subject = null , $message = null , $user_id = null ){

        $contact_id = $this->contact_id;

        if(!$message) $message = "";
        if(!$subject) $subject = 'Contact Form';
        if(!$user_id) $user_id = $this->user_id;

        $task_json = array(
            "type" => "call",
            "person_id" => array($contact_id),
            "subject" => $subject,
            "note" => $message,
            "user_id" => $user_id
        );

        $task_json = json_encode($task_json);
        $task = $this->tsl_pipelines_crm_curl_wrap("POST", 'activities', false, $task_json );
        $task = json_decode($task, True);
        return $task;

    }

    function get_user_id(){
        $currentUser = $this->tsl_pipelines_crm_curl_wrap("users/current-user", null, "GET", NULL);
        $currentUser = json_decode($currentUser, True);
        $this->user_id = $currentUser['id'];

    }

    function get_all_users(){

        if(!$this->pipelines_api_key) return array();

        $Users = $this->tsl_pipelines_crm_curl_wrap("GET" , "users" );
        $Users = json_decode($Users, True);

        return $Users;

    }

    function has_tag( $customer_array, $tag ){

        for($x=0;$x<sizeof($customer_array['tags']);$x++){
            if($customer_array['tags'][$x] == $tag ) return true;
        }
        return false;
    }

    function get_activity_types(){

        $types = $this->tsl_pipelines_crm_curl_wrap("GET" , "activityTypes" );
        $types = json_decode($types, True);

        return $types;
    }


    function tsl_pipelines_crm_curl_wrap(  $method, $service, $has_modifiers  = false , $data = null )
    {

        $content_type = "application/json";


        if($data){
            $fld_count = sizeof( $data );
            $data = http_build_query( $data );
        }

        if($has_modifiers){
            $pipelines_url = 'https://' . $this->pipelines_domain . '.pipedrive.com/v1/' . $service . '&api_token=' . $this->pipelines_api_key;
        }else {
            $pipelines_url = 'https://' . $this->pipelines_domain . '.pipedrive.com/v1/' . $service . '?api_token=' . $this->pipelines_api_key;
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_UNRESTRICTED_AUTH, true);
        curl_setopt($ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1 );
        switch ($method) {
            case "POST":
                $url = $pipelines_url;
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch,CURLOPT_POST, $fld_count );
                break;
            case "GET":
                $url = $pipelines_url;
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
                break;
            case "PUT":
                $url = $pipelines_url;
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                break;
            case "DELETE":
                $url = $pipelines_url;
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
                break;
            default:
                break;
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 120);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $output = curl_exec($ch);

        if($errno = curl_errno($ch)) {
            $error_message = curl_strerror($errno);
            if($this->debug_mode) echo "cURL error ({$errno}):\n {$error_message}";
        }

        curl_close($ch);
        if($this->debug_mode)  print_r(json_decode($output));
        return $output;
    }
}