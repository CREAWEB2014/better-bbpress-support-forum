<?php
/*
Plugin Name: Better bbPress Support Forum
Plugin URI: http://averta.net
Description: Turn your new bb-Press 2.0 forums into support forums.
Author: averta
Version: 1.0.0
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


/*
function bbsf_setup
called by the init hook.
uses:
@function bbsf_define_constants
@function bbsf_includes
add any additional setup function calls into here
*/
function bbsf_setup(){
	require_once 'includes/constants.php';
	bbsf_includes(); // includes all plugin files
}
add_action( 'plugins_loaded', 'bbsf_setup');


/*
function bbsf_includes
includes all the files to add more files simply 
add the file name to the correct array
@return: nothing
*/
function bbsf_includes(){

	//admin folder
	if ( is_admin() ){
		$admin_files = array(
				'bbsf-admin',	//meta box and save functions
				'bbsf-settings', //Settings section content prints out under the bb-press forum settings    
				);
				
		foreach ($admin_files as $file){
			include(BBSF_ADMIN_PATH . $file .'.php');
		}
	}
	
	//includes folder
	$include_files = array(
			'bbsf-common-functions',		// common functions used through the plugin
			'bbsf-support-functions',		//functions relating the the update and edit of the topic status  
			'bbsf-core-options',			//sets up the core options
			'bbsf-user-ranking-functions', // contains functions relating to the user ranking
			'bbsf-premium-forum'			//functions relating to the premium restricted forums
			);
			
	foreach ($include_files as $file){
		include_once(BBSF_INCLUDES_PATH.$file. '.php');
	}
	
	//widgets folder
		$widget_files = array(
			'bbsf-forum-hours-widget',	//forum hours widget - display the opening hour of your forum
			'bbsf-resolved-count-widget', //resolved topic count
			'bbsf-urgent-topics-widget', //shows a list of urgent topics to forum mods and admin
			'bbsf-recently-resolved-widget', //shows a list of recently resolved topics	
			'bbsf-claimed-topics-widget', //show a list of topics claimed by the user	
		);
	foreach ($widget_files as $file){
		include_once(BBSF_WIDGETS_PATH.$file. '.php');
	}
	
}


//register the widgets

add_action('widgets_init', 'bbsf_register_widgets');

function bbsf_register_widgets(){
	register_widget('bbsf_support_hours_widget');
	register_widget('bbsf_support_resolved_count_widget');
	register_widget('bbsf_support_urgent_topics_widget');
	register_widget('bbsf_support_recently_resolved_widget');
	register_widget('bbsf_claimed_topics_widget');
	
}