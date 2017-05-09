<?php
//add the option on the activation of this plugin
add_action( 'bbsf-activation',   'bbsf_add_options'  );

/*
function bbsf_add_options
Creates the default options
simply extend the array to add more options.

Note: These options only get added on 
activation so if your adding more options
you will need to reactivate your plugin
*/
function bbsf_add_options() {



}


function bbsf_get_option( $option, $section, $default = '' ) {

    $options = get_option( $section );

    if ( isset( $options[$option] ) ) {
        return $options[$option];
    }

    return $default;
}