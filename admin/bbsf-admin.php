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


?>