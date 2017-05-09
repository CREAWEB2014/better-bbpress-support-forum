<?php
/*
 * Plugin Name: Better bbPress Support Forum
 * Plugin URI: http://averta.net
 * Description: Turn your new bb-Press 2.0 forums into support forums.
 * Author: averta
 * Version: 0.9.0
*/

// This is a fork of https://wordpress.org/plugins/bbpress-vip-support-plugin/ that updated 6 years ago :-)

/**
 * Activation functions
 */
function bbsf_activate() {
	
	//include the options page now so we can save the options on activation.
	include_once( plugin_dir_path(__FILE__).'includes/bbsf-core-options.php' );
	do_action( 'bbsf-activation' );

}

register_activation_hook( __FILE__ , 'bbsf_activate' );



require_once 'constants.php';
require_once 'includes/class-bbsf-main.php';




//register the widgets

add_action('widgets_init', 'bbsf_register_widgets');

function bbsf_register_widgets(){
	register_widget('bbsf_support_hours_widget');
	register_widget('bbsf_support_resolved_count_widget');
	register_widget('bbsf_support_urgent_topics_widget');
	register_widget('bbsf_support_recently_resolved_widget');
	register_widget('bbsf_claimed_topics_widget');
	
}