<?php

if( ! class_exists( 'ps_gravity_forms_forms_manager' )){

    class ps_gravity_forms_forms_manager{

        public function is_gravity_forms_loaded(){

            if(class_exists( 'GFAPI')){
                return true;
            }
            return false;

        }

        public function get_all_gravity_forms(){

            $forms = GFAPI::get_forms();

            return $forms;

        }

        public function get_gravity_form( $form_id ) {

            $form = GFAPI::get_form( $form_id );

            return $form;
        }

        public function submit_form_entry( $entry ){

            $entry_id = GFAPI::add_entry( $entry );

            return $entry_id;
        }

    }
}
