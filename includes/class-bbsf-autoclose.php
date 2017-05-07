<?php 

class BBSF_Autoclose {

    function __construct() {
        
        // // Check for existing bbPress
        // if ( ! defined( 'BBCODE_VERSION' ) ) {
        //     return;
        // }

        // error_log(date("Y-m-d H:i:s", strtotime("-2 month")));

        add_action( 'admin_init', array( $this, 'auto_close' ) );

    }


    function auto_close() {
   
            // Get Transient
            $data = get_transient( 'bbsf_autoclose_timer' );
           
            // Process only if transient isn't set and if current user is admin (to avoid decreasing page loading perfomance for users)
            if( current_user_can( 'manage_options' ) ) {
                   
                    // Set Transient
                    set_transient( 'bbsf_autoclose_timer', 'on', 60*60*24 ); // 12 hours
                   
                    // Get all old topics
                    $post_type      = bbp_get_topic_post_type();
                                           
                     $query = new WP_Query( array ( 
                            'fields'                 => 'ids',
                            'cache_results'          => false,
                            'update_post_term_cache' => false,
                            'update_post_meta_cache' => false,
                            'ignore_sticky_posts'    => 1,
                            'post_type'              => $post_type,
                            'posts_per_page'         => -1,
                            'meta_query' => array(
                                            array(
                                                    'type'    => 'DATETIME',
                                                    'key'     => '_bbp_last_active_time',
                                                    'value'   => date("Y-m-d H:i:s", strtotime("-2 month")),
                                                    'compare' => '<'
                                            )
                                    ) 
                            ) 
                    );
                   
                    //Get topics count
                    $post_count = $query->post_count;
                   
                    // Loop through topics
                    if( $post_count > 0) :
                   
                            // Loop
                            while ( $query->have_posts() ) : $query->the_post();

                                    // Update status
                                    update_post_meta( get_the_ID(), '_bbsf_topic_status', 2 );

                                    wp_update_post( array(
                                        'ID' => get_the_ID(),
                                        'post_status' => 'closed'
                                        ) );
                                   
                            endwhile;
                           
                    endif;
                   
                    // Reset query to prevent conflicts
                    wp_reset_query();
                           
            }
   
    }



}

new BBSF_Autoclose;