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

	// Default options
	$options = array (
	//user counts and titles
		// The default display for topic status we used not resolved as default
		'_bbsf_default_status'  => '1',
		//enable user post count display
		'_bbsf_enable_post_count'   => '1',
		//enable user rank
		'_bbsf_enable_user_rank'   => '1',
		//defaults for who can change the topic status
		'_bbsf_status_permissions'   => '',
		// the reply counts / boundaries for the custom forum poster titles this has no default as the user must set these
		'_bbsf_reply_count'    => '',
		//the status people want to show on their topics.
		'_bbsf_used_status'        => '',
		//give admin and forum moderators the ability to move topics into other forums default = enabled
		'_bbsf_enable_topic_move' => '1',
		//urgent topics
		'_bbsf_status_permissions_urgent' => '',
		//do a color change for resolved topics
		//'_bbsf_status_color_change' => '1',
	);
	// Add default options
	foreach ( $options as $key => $value )
		add_option( $key, $value );

}

function bbsf_is_post_count_enabled(){
	return get_option( '_bbsf_enable_post_count' );
}

function bbsf_is_user_rank_enabled(){
	return get_option( '_bbsf_enable_user_rank' );
}

function bbsf_is_resolved_enabled(){
	$options = get_option( '_bbsf_used_status' );
	return $options['res'];
}

function bbsf_is_not_resolved_enabled(){
	$options = get_option( '_bbsf_used_status' );
	return $options['notres'];
}

function bbsf_is_not_support_enabled(){
	$options = get_option( '_bbsf_used_status' );
	return $options['notsup'];
}

function bbsf_is_moderator_enabled(){
	$options = get_option( '_bbsf_status_permissions' );
	return $options['mod'];	
}

function bbsf_is_admin_enabled(){
	$options = get_option( '_bbsf_status_permissions' );
	return $options['admin'];	
}

function bbsf_is_user_enabled(){
	$options = get_option( '_bbsf_status_permissions' );
	return $options['user'];	
}

function bbsf_is_topic_move_enabled(){
	return get_option( '_bbsf_enable_topic_move' );
}

function bbsf_is_topic_urgent_enabled(){
	return get_option( '_bbsf_status_permissions_urgent' );
}

function bbsf_is_topic_claim_enabled(){
	return get_option( '_bbsf_claim_topic' );
}

function bbsf_is_topic_claim_display_enabled(){
	return get_option( '_bbsf_claim_topic_display' );
}

function bbsf_is_topic_assign_enabled(){
	return get_option( '_bbsf_topic_assign' );
}

function bbsf_is_user_trusted_enabled(){
	return get_option( '_bbsf_enable_trusted_tag' );
}




?>