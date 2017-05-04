<?php

//hook into the forum atributes meta box

add_action('bbp_forum_metabox' , 'bbsf_extend_forum_attributes_mb');

/* the support forum checkbox will add resolved / not resolved status to all forums */
/* The premium forum will create a support forum that can only be viewed by that user and admin users */
function bbsf_extend_forum_attributes_mb($forum_id){

	//get out the forum meta
	$premium_forum = bbsf_is_premium_forum( $forum_id );
	if( $premium_forum )
		$checked = "checked";
	else
		$checked = "";
		
	$support_forum = bbsf_is_support_forum( $forum_id );
	if( $support_forum )
		$checked1 = "checked";
	else
		$checked1 = "";

	?>	
	<hr />

<!--
This is not tested enough for people to start using so for now we will only have support forums
<p>
		<strong> Premium Forum:</strong>
		<input type="checkbox" name="bbsf-premium-forum" value="1"  echo $checked; />
		<br />
		<small>Click here for more information about creating a premium forum.</small>
	</p>
-->
	
	<p>
		<strong><?php _e( 'Support Forum:', 'bbsf' ); ?></strong>
		<input type="checkbox" name="bbsf-support-forum" value="1" <?php echo $checked1; ?>/>
		<br />
		<!-- <small>Click here To learn more about the support forum setting.</small> -->
	</p>

<?php	
}

//hook into the forum save hook.

add_action( 'bbp_forum_attributes_metabox_save' , 'bbsf_forum_attributes_mb_save' );

function bbsf_forum_attributes_mb_save($forum_id){

//get out the forum meta
$premium_forum = get_post_meta( $forum_id, '_bbsf_is_premium' );
$support_forum = get_post_meta( $forum_id, '_bbsf_is_support');

	//if we have a value then save it
	if ( !empty( $_POST['bbsf-premium-forum'] ) )
		update_post_meta($forum_id, '_bbsf_is_premium', $_POST['bbsf-premium-forum']);
	
	//the forum used to be premium now its not
	if ( !empty($premium_forum) && empty( $_POST['bbsf-premium-forum'] ) )
		update_post_meta($forum_id, '_bbsf_is_premium', 0);
		
	//support options
	if ( !empty( $_POST['bbsf-support-forum'] ) )
		update_post_meta($forum_id, '_bbsf_is_support', $_POST['bbsf-support-forum']);
	
	//the forum used to be premium now its not
	if ( !empty($premium_forum) && empty( $_POST['bbsf-support-forum'] ) )
		update_post_meta($forum_id, '_bbsf_is_support', 0);
		
	
	
	return $forum_id;

}


//register the settings
	function bbsf_register_admin_settings() {

		// Add getshopped forum section
		add_settings_section( 'bbsf-forum-setting',                __( 'User ranking system',           'bbsf-forum' ), 'bbsf_admin_setting_callback_getshopped_section',  'bbpress'             );
		
		
		register_setting  ( 'bbpress', '_bbsf_reply_count', 'bbsf_validate_options' );
		// user title setting start - this is the start number of the post 
/*
		add_settings_field( '_bbsf_reply_count_start', __( 'Replies Between', 'bbsf-forum' ), 'bbsf_admin_setting_callback_reply_count_start', 'bbpress', 'bbsf-forum-setting' );
	 	add_settings_field( '_bbsf_reply_count_end', __( 'and', 'bbsf-forum' ), 'bbsf_admin_setting_callback_reply_count_end', 'bbpress', 'bbsf-forum-setting' );
	 	add_settings_field( '_bbsf_reply_count_title', __( 'Custom title', 'bbsf-forum' ), 'bbsf_admin_setting_callback_reply_count_title',      'bbpress', 'bbsf-forum-setting' );
*/
	 	
	 	//worst code ever starting now
	 	add_settings_field( '_bbsf_reply_count_title1', 'User ranking level 1', 'bbsf_admin_setting_callback_reply_count_title1',      'bbpress', 'bbsf-forum-setting' );
	 	add_settings_field( '_bbsf_reply_count_start1', '', 'bbsf_admin_setting_callback_reply_count_start1', 'bbpress', 'bbsf-forum-setting' );
	 	add_settings_field( '_bbsf_reply_count_end1','' , 'bbsf_admin_setting_callback_reply_count_end1', 'bbpress', 'bbsf-forum-setting' );


	 	add_settings_field( '_bbsf_reply_count_title2', 'User ranking level 2', 'bbsf_admin_setting_callback_reply_count_title2',      'bbpress', 'bbsf-forum-setting' );
	 	add_settings_field( '_bbsf_reply_count_start2',  '', 'bbsf_admin_setting_callback_reply_count_start2', 'bbpress', 'bbsf-forum-setting' );
	 	add_settings_field( '_bbsf_reply_count_end2', '', 'bbsf_admin_setting_callback_reply_count_end2', 'bbpress', 'bbsf-forum-setting' );

	 	add_settings_field( '_bbsf_reply_count_title3', 'User ranking level 3', 'bbsf_admin_setting_callback_reply_count_title3',      'bbpress', 'bbsf-forum-setting' );
	 	add_settings_field( '_bbsf_reply_count_start3', '', 'bbsf_admin_setting_callback_reply_count_start3', 'bbpress', 'bbsf-forum-setting' );
	 	add_settings_field( '_bbsf_reply_count_end3', '', 'bbsf_admin_setting_callback_reply_count_end3', 'bbpress', 'bbsf-forum-setting' );

	 	add_settings_field( '_bbsf_reply_count_title4','User ranking level 4', 'bbsf_admin_setting_callback_reply_count_title4',      'bbpress', 'bbsf-forum-setting' );
	 	add_settings_field( '_bbsf_reply_count_start4', '', 'bbsf_admin_setting_callback_reply_count_start4', 'bbpress', 'bbsf-forum-setting' );
	 	add_settings_field( '_bbsf_reply_count_end4','', 'bbsf_admin_setting_callback_reply_count_end4', 'bbpress', 'bbsf-forum-setting' );

	 	add_settings_field( '_bbsf_reply_count_title5', 'User ranking level 5', 'bbsf_admin_setting_callback_reply_count_title5',      'bbpress', 'bbsf-forum-setting' );
	 	add_settings_field( '_bbsf_reply_count_start5', '', 'bbsf_admin_setting_callback_reply_count_start5', 'bbpress', 'bbsf-forum-setting' );
	 	add_settings_field( '_bbsf_reply_count_end5', '', 'bbsf_admin_setting_callback_reply_count_end5', 'bbpress', 'bbsf-forum-setting' );

	 	///worst code ever ends now
	 	
		// show post count
		add_settings_field( '_bbsf_enable_post_count', __( 'Show forum post count', 'bbsf-forum' ), 'bbsf_admin_setting_callback_post_count',      'bbpress', 'bbsf-forum-setting' );
	 	register_setting  ( 'bbpress', '_bbsf_enable_post_count', 'intval');
		//show user rank
		add_settings_field( '_bbsf_enable_user_rank', __( 'Show Rank', 'bbsf-forum' ), 'bbsf_admin_setting_callback_user_rank',      'bbpress', 'bbsf-forum-setting' );
	 	register_setting  ( 'bbpress', '_bbsf_enable_user_rank', 'intval');
						
		
		// Add the forum status section
		add_settings_section( 'bbsf-status-setting',                __( 'Topic Status Settings',           'bbsf-forum' ), 'bbsf_admin_setting_callback_status_section',  'bbpress'             );
		
		register_setting  ( 'bbpress', '_bbsf_default_status', 'intval' );
		add_settings_field( '_bbsf_default_status', __( 'Default Status:', 'bbsf-forum' ), 'bbsf_admin_setting_callback_default_status', 'bbpress', 'bbsf-status-setting' );

		
		// default topic option
		register_setting  ( 'bbpress', '_bbsf_used_status', 'bbsf_validate_checkbox_group' );
		// each drop down option for selection
		add_settings_field( '_bbsf_used_status_1', __( 'Display Status:', 'bbsf-forum' ), 'bbsf_admin_setting_callback_displayed_status_res', 'bbpress', 'bbsf-status-setting' );
		add_settings_field( '_bbsf_used_status_2', __( 'Display Status:', 'bbsf-forum' ), 'bbsf_admin_setting_callback_displayed_status_notres', 'bbpress', 'bbsf-status-setting' );
		add_settings_field( '_bbsf_used_status_3', __( 'Display Status:', 'bbsf-forum' ), 'bbsf_admin_setting_callback_displayed_status_notsup', 'bbpress', 'bbsf-status-setting' );
		
		// who can update the status
		register_setting  ( 'bbpress', '_bbsf_status_permissions', 'bbsf_validate_checkbox_group' );
		// each drop down option for selection
		add_settings_field( '_bbsf_status_permissions_admin', __( 'Admin', 'bbsf-forum' ), 'bbsf_admin_setting_callback_permission_admin', 'bbpress', 'bbsf-status-setting' );
		add_settings_field( '_bbsf_status_permissions_user', __( 'Topic Creator', 'bbsf-forum' ), 'bbsf_admin_setting_callback_permission_user', 'bbpress', 'bbsf-status-setting' );
		add_settings_field( '_bbsf_status_permissions_moderator', __( 'Forum Moderator', 'bbsf-forum' ), 'bbsf_admin_setting_callback_permission_moderator', 'bbpress', 'bbsf-status-setting' );
		
/*
		register_setting  ( 'bbpress', '_bbsf_status_color_change', 'bbsf_validate_status_permissions' );
		add_settings_field( '_bbsf_status_color_change', __( 'Change colour of resolved topics', 'bbsf-forum' ), 'bbsf_admin_setting_callback_color_change', 'bbpress', 'bbsf-status-setting' );
*/
/* support forum misc settings */
		add_settings_section( 'bbsf-topic_status-setting',                __( 'Support Froum Settings',           'bbsf-forum' ), 'bbsf_admin_setting_callback_support_forum_section',  'bbpress'             );

		register_setting  ( 'bbpress', '_bbsf_status_permissions_urgent', 'intval' );
		// each drop down option for selection
		add_settings_field( '_bbsf_status_permissions_urgent', __( 'Urgent Topic Status', 'bbsf-forum' ), 'bbsf_admin_setting_callback_urgent', 'bbpress', 'bbsf-topic_status-setting' );
		
		//the ability to move topics
	 	add_settings_field( '_bbsf_enable_topic_move', __( 'Move topics', 'bbsf-forum' ), 'bbsf_admin_setting_callback_move_topic',      'bbpress', 'bbsf-topic_status-setting' );
	 	register_setting  ( 'bbpress', '_bbsf_enable_topic_move', 'intval');
	 	
	 	//the ability to assign a topic to a mod or admin
	 	add_settings_field( '_bbsf_topic_assign', __( 'Assign topics', 'bbsf-forum' ), 'bbsf_admin_setting_callback_assign_topic',      'bbpress', 'bbsf-topic_status-setting' );
	 	register_setting  ( 'bbpress', '_bbsf_topic_assign', 'intval');
	 	
	 	//ability for admin and moderators to claim topics
	 	add_settings_field( '_bbsf_claim_topic', __( 'Claim topics', 'bbsf-forum' ), 'bbsf_admin_setting_callback_claim_topic',      'bbpress', 'bbsf-topic_status-setting' );
	 	register_setting  ( 'bbpress', '_bbsf_claim_topic', 'intval');
	 	
	 	add_settings_field( '_bbsf_claim_topic_display', __( 'Display Username:', 'bbsf-forum' ), 'bbsf_admin_setting_callback_claim_topic_display',      'bbpress', 'bbsf-topic_status-setting' );
	 	register_setting  ( 'bbpress', '_bbsf_claim_topic_display', 'intval');



}
add_action( 'bbp_register_admin_settings' , 'bbsf_register_admin_settings' );

function bbsf_validate_checkbox_group($input){
    //update only the needed options
    foreach ($input as $key => $value){
        $newoptions[$key] = $value;
    }
    //return all options
    return $newoptions;
}

function bbsf_validate_options($input){

	$options = get_option('_bbsf_reply_count');
	
	$i = 1;
	foreach ($input as $array){	
		foreach ($array as $key => $value){
		      $options[$i][$key] = $value;
		        
		    }
			$i++;
		}
    return $options;
}


?>