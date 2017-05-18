<?php 

class BBSF_Autoreply {

    public $reply_time;
    public $reply_content;

    function __construct() {

        if ( 0 == $this->reply_time = bbsf_get_option( 'bbsf_auto_reply_time', 'bbsf_auto_reply', 0 ) ) {
            return;
        }

        $this->reply_content = bbsf_get_option( 'bbsf_auto_reply_content', 'bbsf_auto_reply', 0 );

        add_action( 'admin_init', array( $this, 'auto_reply' ), 100 );

    }


    function get_topics() {

        $users = get_users( array(
            'fields'   => 'user_id',
            'role__in' => array( 'subscriber', 'participant', 'bbp_participant' )
        ) );

        $post_type = bbp_get_topic_post_type();

        $query = new WP_Query( array ( 
            'fields'                 => 'ids',
            'cache_results'          => false,
            'update_post_term_cache' => false,
            'update_post_meta_cache' => false,
            'ignore_sticky_posts'    => 1,
            'post_type'              => $post_type,
            'post_status'            => 'publish',
            'author__in'             => $users,
            'posts_per_page'         => -1,
            'meta_query' => array(
                    array(
                        'type'    => 'DATETIME',
                        'key'     => '_bbp_last_active_time',
                        'value'   => date( "Y-m-d H:i:s", strtotime( '-' . $this->reply_time . ' days' ) ),
                        'compare' => '<'
                    )
                ) 
            ) 
        );

        return $query;

    }


    function auto_reply() {

        $data = get_transient( 'bbsf_autoreply_timer' );

        if ( 'on' !== $data && current_user_can( 'manage_options' ) ) {
        // if ( current_user_can( 'manage_options' ) ) {

            set_transient( 'bbsf_autoclose_timer', 'on', 60*60*6 ); // 6 hours

            $query = $this->get_topics();

            if ( $query->have_posts() ) {
                while ( $query->have_post() ) : the_post();
                    
                    $reply_args = array( 
                        'post_parent' => get_the_ID(),
                        'post_status' => bbp_get_public_status_id(),  
                        'post_type'   => bbp_get_reply_post_type(),  
                        'post_author' => 3785,
                        'post_content' => $this->reply_content,
                        'comment_status' => 'closed' 
                    );

                    bbp_insert_reply( $reply_args, $reply_meta );

                endwhile;
            }

        }


    }





}

new BBSF_Autoreply;