<?php
//The GetShopped Section
function bbsf_admin_setting_callback_getshopped_section(){
?>
	<p><?php _e( 'User ranking allows you to differentiate and reward your forum users with Custom Titles based on the number of topics and replies they have contributed to.', 'bbsf-forum' ); ?></p>
<?php	
}

function bbsf_admin_setting_callback_status_section(){
?>
	<p><?php _e( 'Enable and configure the settings for topic statuses these will be displayed on each topic', 'bbsf-forum' ); ?></p>
<?php	
}

function bbsf_admin_setting_callback_support_forum_section(){
?>
	<p><?php _e( 'Enable and configure the settings for support forums, these options will be displayed on each topic within your support forums', 'bbsf-forum' ); ?></p>
<?php	

}

// worst code ever starts here but for now its jsut testing need to do this wayyyyy better
function bbsf_admin_setting_callback_reply_count_start1(){
	$options = get_option('_bbsf_reply_count');
/* 	exit('<pre>'.print_r($options,1).'</pre>'); */
	?>
	<p>at least
	<input  name="_bbsf_reply_count[1][start]" type="text" id="bbsf_reply_count_start" value="<?php if ($options[1]){ echo $options[1]['start']; } ?>" class="small-text" />
	<label  for="_bbsf_reply_count[start]">posts but</label></p>
	<?php
}

function bbsf_admin_setting_callback_reply_count_end1(){
	$options = get_option('_bbsf_reply_count');
?>
<p>not more than
	<input  name="_bbsf_reply_count[1][end]" type="text" id="bbsf_reply_count_end" value="<?php if ($options[1]){ echo $options[1]['end']; }?>" class="small-text" />
	<label  for="_bbsf_reply_count[start]">posts</label></p>
	<!-- <hr style="width:200px;"/> -->
<?php
}

function bbsf_admin_setting_callback_reply_count_title1(){
	$options = get_option('_bbsf_reply_count');
?><p>Rank Title </p>
	<input  name="_bbsf_reply_count[1][title]" type="text" id="_bbsf_reply_count_title" value="<?php if ($options[1]) { echo $options[1]['title']; } ?>" />
		<p><label for="_bbsf_reply_count_title">is granted when a user has</label></p>

<?php
}

function bbsf_admin_setting_callback_reply_count_start2(){
	$options = get_option('_bbsf_reply_count');
/* 	exit('<pre>'.print_r($options,1).'</pre>'); */
	?>
	<p>at least
	<input  name="_bbsf_reply_count[2][start]" type="text" id="bbsf_reply_count_start" value="<?php if ($options[2]){ echo $options[2]['start']; } ?>" class="small-text" />
	<label  for="_bbsf_reply_count[start]">posts but</label></p>
	<?php
}

function bbsf_admin_setting_callback_reply_count_end2(){
	$options = get_option('_bbsf_reply_count');
?>
<p>not more than
	<input  name="_bbsf_reply_count[2][end]" type="text" id="bbsf_reply_count_end" value="<?php if ($options[2]){ echo $options[2]['end']; }?>" class="small-text" />
	<label  for="_bbsf_reply_count[start]">posts</label></p>
	<!-- <hr style="width:200px;"/> -->
<?php
}

function bbsf_admin_setting_callback_reply_count_title2(){
	$options = get_option('_bbsf_reply_count');
?><p>Rank Title </p>
	<input  name="_bbsf_reply_count[2][title]" type="text" id="_bbsf_reply_count_title" value="<?php if ($options[2]) { echo $options[2]['title']; } ?>" />
		<p><label for="_bbsf_reply_count_title">is granted when a user has</label></p>

<?php
}
function bbsf_admin_setting_callback_reply_count_start3(){
	$options = get_option('_bbsf_reply_count');
/* 	exit('<pre>'.print_r($options,1).'</pre>'); */
	?>
	<p>at least
	<input  name="_bbsf_reply_count[3][start]" type="text" id="bbsf_reply_count_start" value="<?php if ($options[3]){ echo $options[3]['start']; } ?>" class="small-text" />
	<label  for="_bbsf_reply_count[start]">posts but</label></p>
	<?php
}

function bbsf_admin_setting_callback_reply_count_end3(){
	$options = get_option('_bbsf_reply_count');
?>
<p>not more than
	<input  name="_bbsf_reply_count[3][end]" type="text" id="bbsf_reply_count_end" value="<?php if ($options[3]){ echo $options[3]['end']; }?>" class="small-text" />
	<label  for="_bbsf_reply_count[start]">posts</label></p>
	<!-- <hr style="width:200px;"/> -->
<?php
}

function bbsf_admin_setting_callback_reply_count_title3(){
	$options = get_option('_bbsf_reply_count');
?><p>Rank Title </p>
	<input  name="_bbsf_reply_count[3][title]" type="text" id="_bbsf_reply_count_title" value="<?php if ($options[3]) { echo $options[3]['title']; } ?>" />
		<p><label for="_bbsf_reply_count_title">is granted when a user has</label></p>

<?php
}

function bbsf_admin_setting_callback_reply_count_start4(){
	$options = get_option('_bbsf_reply_count');
/* 	exit('<pre>'.print_r($options,1).'</pre>'); */
	?>
	<p>at least
	<input  name="_bbsf_reply_count[4][start]" type="text" id="bbsf_reply_count_start" value="<?php if ($options[4]){ echo $options[4]['start']; } ?>" class="small-text" />
	<label  for="_bbsf_reply_count[start]">posts but</label></p>
	<?php
}

function bbsf_admin_setting_callback_reply_count_end4(){
	$options = get_option('_bbsf_reply_count');
?>
<p>not more than
	<input  name="_bbsf_reply_count[4][end]" type="text" id="bbsf_reply_count_end" value="<?php if ($options[4]){ echo $options[4]['end']; }?>" class="small-text" />
	<label  for="_bbsf_reply_count[start]">posts</label></p>
	<!-- <hr style="width:200px;"/> -->
<?php
}

function bbsf_admin_setting_callback_reply_count_title4(){
	$options = get_option('_bbsf_reply_count');
?><p>Rank Title </p>
	<input  name="_bbsf_reply_count[4][title]" type="text" id="_bbsf_reply_count_title" value="<?php if ($options[4]) { echo $options[4]['title']; } ?>" />
		<p><label for="_bbsf_reply_count_title">is granted when a user has</label></p>

<?php
}

function bbsf_admin_setting_callback_reply_count_start5(){
	$options = get_option('_bbsf_reply_count');
/* 	exit('<pre>'.print_r($options,1).'</pre>'); */
	?>
	<p>at least
	<input  name="_bbsf_reply_count[5][start]" type="text" id="bbsf_reply_count_start" value="<?php if ($options[5]){ echo $options[5]['start']; } ?>" class="small-text" />
	<label  for="_bbsf_reply_count[start]">posts but</label></p>
	<?php
}

function bbsf_admin_setting_callback_reply_count_end5(){
	$options = get_option('_bbsf_reply_count');
?>
<p>not more than
	<input  name="_bbsf_reply_count[5][end]" type="text" id="bbsf_reply_count_end" value="<?php if ($options[5]){ echo $options[5]['end']; }?>" class="small-text" />
	<label  for="_bbsf_reply_count[start]">posts</label></p>
	<!-- <hr style="width:200px;"/> -->
<?php
}

function bbsf_admin_setting_callback_reply_count_title5(){
	$options = get_option('_bbsf_reply_count');
?><p>Rank Title </p>
	<input  name="_bbsf_reply_count[5][title]" type="text" id="_bbsf_reply_count_title" value="<?php if ($options[5]) { echo $options[5]['title']; } ?>" />
		<p><label for="_bbsf_reply_count_title">is granted when a user has</label></p>

<?php
}


// worst code ever ends here
function bbsf_admin_setting_callback_post_count(){
?>
	<input id="_bbsf_enable_post_count" name="_bbsf_enable_post_count" type="checkbox" <?php checked( bbsf_is_post_count_enabled(),1 ); ?> value="1" />
	<label for="_bbsf_enable_post_count"><?php _e( 'Show the users post count below their gravatar?', 'bbpress' ); ?></label>
<?php
}

function bbsf_admin_setting_callback_user_rank(){
?>
	<input id="bbsf_enable_user_rank" name="_bbsf_enable_user_rank" type="checkbox" <?php checked( bbsf_is_user_rank_enabled(),1 ); ?> value="1" />
	<label for="bbsf_enable_user_rank"><?php _e( 'Display the users rank title below their gravatar?', 'bbpress' ); ?></label>
<?php
}

function bbsf_admin_setting_callback_default_status(){
	$option = get_option('_bbsf_default_status');
	?>
		<select name="_bbsf_default_status" id="bbsf_default_status">
			<option value="1" <?php  selected( $option, 1 ) ; ?> >not resolved</option>
			<option value="2" <?php  selected( $option, 2 ) ; ?> >resolved</option>
			<option value="3" <?php	 selected( $option, 3 ) ; ?> >not a support question</option>
		</select>
	<label for="bbsf_default_status"><?php _e( 'This is the default status that will get displayed on all topics', 'bbpress' ); ?></label>
	<?php
}

function bbsf_admin_setting_callback_displayed_status_res(){
?>
	<input id="bbsf_used_status" name="_bbsf_used_status[res]" <?php checked( bbsf_is_resolved_enabled(),1 ); ?> type="checkbox"  value="1" />
	<label for="bbsf_used_status"><?php _e( 'Resolved', 'bbpress' ); ?></label>
<?php
}

function bbsf_admin_setting_callback_displayed_status_notres(){
?>
	<input id="bbsf_used_status" name="_bbsf_used_status[notres]" <?php checked( bbsf_is_not_resolved_enabled(),1 ); ?> type="checkbox"  value="1" />
	<label for="bbsf_used_status"><?php _e( 'Not Resolved', 'bbpress' ); ?></label>
<?php
}

function bbsf_admin_setting_callback_displayed_status_notsup(){
?>
	<input id="bbsf_used_status" name="_bbsf_used_status[notsup]" <?php checked( bbsf_is_not_support_enabled(),1 ); ?> type="checkbox"  value="1" />
	<label for="bbsf_used_status"><?php _e( 'Not a support question', 'bbpress' ); ?></label>
<?php
}

function bbsf_admin_setting_callback_permission_admin(){
?>
	<input id="bbsf_status_permissions" name="_bbsf_status_permissions[admin]" <?php checked( bbsf_is_admin_enabled(),1 ); ?> type="checkbox"  value="1" />
	<label for="bbsf_status_permissions"><?php _e( 'Allow the admin to update the topic status (recommended).', 'bbpress' ); ?></label>
<?php
}

function bbsf_admin_setting_callback_permission_user(){
?>
	<input id="bbsf_status_permissions" name="_bbsf_status_permissions[user]" <?php checked( bbsf_is_user_enabled(),1 ); ?> type="checkbox"  value="1" />
	<label for="bbsf_status_permissions"><?php _e( 'Allow the person who created the topic to update the status.', 'bbpress' ); ?></label>
<?php
}

function bbsf_admin_setting_callback_permission_moderator(){
?>
	<input id="bbsf_status_permissions" name="_bbsf_status_permissions[mod]" <?php checked( bbsf_is_moderator_enabled(),1 ); ?> type="checkbox"  value="1" />
	<label for="bbsf_status_permissions"><?php _e( 'Allow the forum moderators to update the post status.', 'bbpress' ); ?></label>
<?php
}

function bbsf_admin_setting_callback_move_topic(){
?>
	<input id="bbsf_enable_topic_move" name="_bbsf_enable_topic_move" <?php checked( bbsf_is_topic_move_enabled(),1 ); ?> type="checkbox"  value="1" />
	<label for="bbsf_enable_topic_move"><?php _e( 'Allow the forum moderators and admin to move topics to other forums.', 'bbpress' ); ?></label>
<?php
}

function bbsf_admin_setting_callback_urgent(){
?>
	<input id="bbsf_status_permissions_urgent" name="_bbsf_status_permissions_urgent" <?php checked( bbsf_is_topic_urgent_enabled(),1 ); ?> type="checkbox"  value="1" />
	<label for="bbsf_status_permissions_urgent"><?php _e( 'Allow the forum moderators and admin to mark a topic as Urgent, this will mark the topic title with [urgent].', 'bbpress' ); ?></label>
<?php
}

function bbsf_admin_setting_callback_claim_topic(){
?>
	<input id="bbsf_claim_topic" name="_bbsf_claim_topic" <?php checked( bbsf_is_topic_claim_enabled(),1 ); ?> type="checkbox"  value="1" />
	<label for="bbsf_claim_topic"><?php _e( 'Allow the forum moderators and admin to claim a topic, this will mark the topic title with [claimed] but will only show to forum moderators and admin users', 'bbpress' ); ?></label>
<?php
}

function bbsf_admin_setting_callback_claim_topic_display(){
?>
	<input id="bbsf_claim_topic_display" name="_bbsf_claim_topic_display" <?php checked( bbsf_is_topic_claim_display_enabled(),1 ); ?> type="checkbox"  value="1" />
	<label for="bbsf_claim_topic_display"><?php _e( 'By selecting this option if a topic is claimed the claimed persons username will be displayed next to the topic title instead of the words [claimed], leaving this unchecked will default to [claimed]', 'bbpress' ); ?></label>
<?php

}

function bbsf_admin_setting_callback_assign_topic(){
?>
	<input id="bbsf_topic_assign" name="_bbsf_topic_assign" <?php checked( bbsf_is_topic_assign_enabled(),1 ); ?> type="checkbox"  value="1" />
	<label for="bbsf_topic_assign"><?php _e( 'Allow administrators and forum moderators to assign topics to other administrators and forum moderators', 'bbpress' ); ?></label>
<?php

}

?>