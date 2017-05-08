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


function bbsf_admin_scripts() {

	wp_enqueue_script( 'bbsf-admin', BBSF_URL . 'admin/js/admin.js' );

}

add_action( 'admin_enqueue_scripts', 'bbsf_admin_scripts' );


function bbsf_import_bbps_ajax() {

	$nonce = isset( $_POST['n'] ) ? $_POST['n'] : '';

	if ( ! wp_verify_nonce( $nonce, 'bbsf_import_bbps' ) ) {
		wp_send_json_error();
	}

	if ( 'yes' === get_option( 'bbsf_imported_bbps', 'no' ) ) {
		wp_send_json_error();
	}

	$options_convert_array = array(

		'bbsf_ranking' => array(
			'_bbps_reply_count_title1'           => 'bbsf_rank1',
			'_bbps_reply_count_start1'           => 'bbsf_rank1_start',
			'_bbps_reply_count_end1'             => 'bbsf_rank1_end',
			'_bbps_reply_count_title2'           => 'bbsf_rank2',
			'_bbps_reply_count_start2'           => 'bbsf_rank2_start',
			'_bbps_reply_count_end2'             => 'bbsf_rank2_end',
			'_bbps_reply_count_title3'           => 'bbsf_rank3',
			'_bbps_reply_count_start3'           => 'bbsf_rank3_start',
			'_bbps_reply_count_end3'             => 'bbsf_rank3_end',
			'_bbps_reply_count_title4'           => 'bbsf_rank4',
			'_bbps_reply_count_start4'           => 'bbsf_rank4_start',
			'_bbps_reply_count_end4'             => 'bbsf_rank4_end',
			'_bbps_reply_count_start5'           => 'bbsf_rank5',
			'_bbps_reply_count_start5'           => 'bbsf_rank5_start',
			'_bbps_reply_count_end5'             => 'bbsf_rank5_end'
		),

		'bbsf_topic_status' => array(
			'_bbps_enable_post_count'            => 'bbsf_show_post_count',
			'_bbps_enable_user_rank'             => 'bbsf_show_rank',
			'_bbps_default_status'               => 'bbsf_default_status',
			'_bbps_used_status_1'                => 'bbsf_show_status_not_resolved',
			'_bbps_used_status_2'                => 'bbsf_show_status_resolved',
			'_bbps_used_status_3'                => 'bbsf_show_status_not_support',
			'_bbps_status_permissions_admin'     => 'bbsf_allow_status_change_admin',
			'_bbps_status_permissions_user'      => 'bbsf_allow_status_change_creator',
			'_bbps_status_permissions_moderator' => 'bbsf_allow_status_change_moderator'
		),

		'bbsf_support_forum' => array(
			'_bbps_status_permissions_urgent'    => 'bbsf_enable_urgent_status',
			'_bbps_enable_topic_move'            => 'bbsf_enable_move_topics',
			'_bbps_topic_assign'                 => 'bbsf_enable_assign_topics',
			'_bbps_claim_topic'                  => 'bbsf_enable_claim_topics',
			'_bbps_claim_topic_display'          => 'bbsf_show_claimed_user'
		)

	);


	foreach ( $options_convert_array as $option_section => $options ) {
		
		$new_options = array();

		foreach ( $options as $old => $new ) {
			$new_options[$new] = get_option( $old, '' );
		}

		update_option( $option_section, $new_options );

	}

	update_option( 'bbsf_imported_bbps', 'yes' );

	wp_send_json_success( get_option( '_bbsf_default_status', $default = false ) );


}

add_action( 'wp_ajax_bbsf_import_bbps', 'bbsf_import_bbps_ajax' );