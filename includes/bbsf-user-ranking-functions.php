<?php

//update the user post count meta everytime the user creates a new post
function bbsf_increament_post_count(){
	global $current_user;
	
	$post_type = get_post_type();
	//bail unless we are creating topics or replies
	if ( $post_type == 'topic' || $post_type == 'reply' ){
	
		$current_user = wp_get_current_user();
		$user_id = $current_user->ID;
		$user_rank = get_user_meta($user_id, '_bbsf_rank_info');
		
		 //if this is their first post
		if ( empty($user_rank[0]) )
			bbsf_create_user_ranking_meta($user_id);

		bbsf_check_ranking($user_id);
		
	}
	return;
		
}
add_action('save_post','bbsf_increament_post_count');


function bbsf_check_ranking($user_id){

	$user_rank = get_user_meta( $user_id, '_bbsf_rank_info' );

	$post_count = $user_rank[0]['post_count'];
	$current_rank = $user_rank[0]['current_ranking'];
	//$next_rank = $user_rank[0]['count_next_ranking'];
	$post_count = $post_count + 1;

	$rankings = get_option( 'bbsf_ranking' );
	
	foreach ( (array) $rankings as $rank ){

		if ( isset( $rank['title'] ) && isset( $rank['start'] ) && isset( $rank['end'] ) ) {
			
			//if post count == the end value then this title no longer applies so remove it
			//we subtract one here to allow for the between number eg between 1 - 4 we still
			//want to dispaly the title if the post count is 4
			if ( $post_count - 1 == $rank['end'] ) {
				$current_rank ="";
			}
			
			if ( $post_count == $rank['start'] ) {
				$current_rank = $rank['title'];	
			}

		}

	}
		
	$meta = array(	'post_count' => $post_count,
					'current_ranking' => $current_rank,);
				
	update_user_meta( $user_id, '_bbsf_rank_info', $meta );

}


function bbsf_create_user_ranking_meta( $user_id ){

	$meta = array(
		'post_count' => '0', 
		'current_ranking' => ''
	);
	
	update_user_meta( $user_id, '_bbsf_rank_info', $meta);
}


function bbsf_display_user_title(){
	if ( 'on' === bbsf_get_option( 'bbsf_show_rank', 'bbsf_ranking', 'off' ) ){
		$user_id = bbp_get_reply_author_id();
		$user_rank = get_user_meta( $user_id, '_bbsf_rank_info' );

		if( !empty($user_rank[0]['current_ranking']) )
			echo '<div id ="bbsf-user-title">'.$user_rank[0]['current_ranking'] . '</div>';
	}
		
}


function bbsf_display_user_post_count(){
	if ( 'yes' == bbsf_get_option( 'bbsf_show_post_count', 'bbsf_ranking' ) ){
		$user_id = bbp_get_reply_author_id();
		$user_rank = get_user_meta( $user_id, '_bbsf_rank_info' );
		if( !empty($user_rank[0]['post_count']) )
			echo '<div id ="bbsf-post-count"> Post count: '.$user_rank[0]['post_count'] . '</div>';
		
	}
}


add_action('bbp_theme_after_reply_author_details', 'bbsf_display_user_title');
add_action('bbp_theme_after_reply_author_details', 'bbsf_display_user_post_count');
