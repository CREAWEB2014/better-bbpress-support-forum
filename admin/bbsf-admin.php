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
	
	<p>
		<strong><?php _e( 'Support Forum:', 'bbsf' ); ?></strong>
		<input type="checkbox" name="bbsf-support-forum" value="1" <?php echo $checked1; ?>/>
		<br>
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

	/*----------------------------------------------------------------------------*/
	$new_options = array();
	$options_convert_array = array(

		'_bbps_status_permissions_urgent'    => 'bbsf_enable_urgent_status',
		'_bbps_enable_topic_move'            => 'bbsf_enable_move_topics',
		'_bbps_topic_assign'                 => 'bbsf_enable_assign_topics',
		'_bbps_claim_topic'                  => 'bbsf_enable_claim_topics',
		'_bbps_claim_topic_display'          => 'bbsf_show_claimed_user'

	);

	foreach ( $options_convert_array as $old => $new ) {
		$new_options[$new] = get_option( $old, '' ) ? 'on' : 'off';
	}

	update_option( 'bbsf_support_forum', $new_options );
	/*----------------------------------------------------------------------------*/

	/*----------------------------------------------------------------------------*/
	$new_options = array();
	$status_perm = get_option( '_bbps_status_permissions', array() );
	
	$new_options[ 'bbsf_allow_status_change_admin' ] = isset( $status_perm['admin'] ) ? 'on' : 'off';
	$new_options[ 'bbsf_allow_status_change_user' ]  = isset( $status_perm['user'] )  ? 'on' : 'off';
	$new_options[ 'bbsf_allow_status_change_mode' ]  = isset( $status_perm['mode'] )  ? 'on' : 'off';


	$default_status = get_option( '_bbps_default_status', 1 );

	switch ( $default_status ) {
		case 1:
			$new_default_status = 'not_resolved';
			break;
		case 2:
			$new_default_status = 'resolved';
			break;
		case 3:
			$new_default_status = 'not_support';
			break;
	}

	$new_options['bbsf_default_status'] = $new_default_status;

	$used_status = get_option( '_bbps_used_status', array() );

	$new_options['bbsf_show_status_not_resolved'] = isset( $used_status['notres'] ) ? 'on' : 'off';
	$new_options['bbsf_show_status_resolved']     = isset( $used_status['res'] )    ? 'on' : 'off';
	$new_options['bbsf_show_status_not_support']  = isset( $used_status['notsup'] ) ? 'on' : 'off';

	update_option( 'bbsf_topic_status', $new_options );
	/*----------------------------------------------------------------------------*/

	/*----------------------------------------------------------------------------*/
	$new_options = array();
	$reply_count = get_option( '_bbps_reply_count', array() );

	foreach ( $reply_count as $lvl => $details ) {
		
		$new_options[ 'bbsf_rank' . $lvl ]            = $details['title'];
		$new_options[ 'bbsf_rank' . $lvl . '_start' ] = $details['start'];
		$new_options[ 'bbsf_rank' . $lvl . '_end' ]   = $details['end'];

	}

	$new_options['bbsf_show_post_count'] = get_option( '_bbps_enable_post_count', false ) ? 'on' : 'off';
	$new_options['bbsf_show_rank']       = get_option( '_bbps_enable_user_rank', false )  ? 'on' : 'off';

	update_option( 'bbsf_ranking', $new_options );
	/*----------------------------------------------------------------------------*/


	// update_option( 'bbsf_imported_bbps', 'yes' );
	wp_send_json_success( get_option( '_bbsf_default_status', false ) );


}

add_action( 'wp_ajax_bbsf_import_bbps', 'bbsf_import_bbps_ajax' );