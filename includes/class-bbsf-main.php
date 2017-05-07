<?php 

class BBSF_Main {

    function __construct() {

        $this->admin_files();
        $this->general_files();

    }


    function admin_files() {
        
        if ( is_admin() ) {
            
            require_once BBSF_ADMIN_PATH . 'bbsf-admin.php';    
            require_once BBSF_ADMIN_PATH . 'class-bbsf-settings.php';    
            require_once BBSF_ADMIN_PATH . 'class-bbsf-settings-api.php';

            new BBSF_Settings;

        }

    }


    function general_files() {

        require_once 'bbsf-common-functions.php';
        require_once 'bbsf-core-options.php';
        require_once 'bbsf-support-functions.php';
        require_once 'bbsf-user-ranking-functions.php';
        require_once 'class-bbsf-autoclose.php';

    }


}

new BBSF_Main;