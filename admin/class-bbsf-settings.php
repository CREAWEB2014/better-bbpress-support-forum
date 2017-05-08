<?php

/**
 * WordPress settings API demo class
 *
 * @author Tareq Hasan
 */
if ( !class_exists('BBSF_Settings' ) ):
class BBSF_Settings {

    private $settings_api;

    function __construct() {
        $this->settings_api = new BBSF_Settings_API;

        add_action( 'admin_init', array($this, 'admin_init') );
        add_action( 'admin_menu', array($this, 'admin_menu') );
    }

    function admin_init() {

        //set the settings
        $this->settings_api->set_sections( $this->get_settings_sections() );
        $this->settings_api->set_fields( $this->get_settings_fields() );

        //initialize settings
        $this->settings_api->admin_init();
    }

    function admin_menu() {
        add_options_page( 'BBSF Settings', 'BBSF Settings', 'delete_posts', 'bbsf-settings-page', array($this, 'plugin_page') );
    }

    function get_settings_sections() {
        $sections = array(
            array(
                'id'    => 'bbsf_ranking',
                'title' => __( 'User Ranking', 'bbsf' ),
                'desc'  => __( 'User ranking allows you to differentiate and reward your forum users with Custom Titles based on the number of topics and replies they have contributed to.', 'bbsf' )
            ),
            array(
                'id'    => 'bbsf_topic_status',
                'title' => __( 'Topic Status', 'bbsf' ),
                'desc'  => __( 'Enable and configure the settings for topic statuses these will be displayed on each topic.', 'bbsf' )
            ),
            array(
                'id'    => 'bbsf_support_forum',
                'title' => __( 'support Forum', 'bbsf' ),
                'desc'  => __( 'Enable and configure the settings for support forums, these options will be displayed on each topic within your support forums.', 'bbsf' )
            ),
            array(
                'id'    => 'bbsf_import_settings',
                'title' => __( 'Import settings', 'bbsf' ),
                'desc'  => __( 'Import settings from other plugins or another site.', 'bbsf' )
            ),
        );
        return $sections;
    }

    /**
     * Returns all the settings fields
     *
     * @return array settings fields
     */
    function get_settings_fields() {
        $settings_fields = array(

            'bbsf_ranking' => array(
                array(
                    'name'              => 'bbsf_rank1',
                    'label'             => __( 'User ranking level 1', 'bbsf' ),
                    'desc'              => __( 'Rank Title', 'bbsf' ),
                    'placeholder'       => __( 'Member', 'bbsf' ),
                    'type'              => 'text',
                    'default'           => 'Member',
                    'sanitize_callback' => 'sanitize_text_field'
                ),
                array(
                    'name'              => 'bbsf_rank1_start',
                    'label'             => __( 'Minimum topics', 'bbsf' ),
                    'desc'              => __( 'Minimum topics count to assign ranking', 'bbsf' ),
                    'placeholder'       => __( '1', 'bbsf' ),
                    'step'              => '1',
                    'type'              => 'number',
                    'default'           => '1',
                    'sanitize_callback' => 'floatval'
                ),
                array(
                    'name'              => 'bbsf_rank1_end',
                    'label'             => __( 'Maximum topics', 'bbsf' ),
                    'desc'              => __( 'Maximum topics count to assign ranking', 'bbsf' ),
                    'placeholder'       => __( '100', 'bbsf' ),
                    'min'               => 1,
                    'step'              => '1',
                    'type'              => 'number',
                    'default'           => '100',
                    'sanitize_callback' => 'floatval'
                ),
                array(
                    'name'              => 'bbsf_rank2',
                    'label'             => __( 'User ranking level 2', 'bbsf' ),
                    'desc'              => __( 'Rank Title', 'bbsf' ),
                    'placeholder'       => __( 'Member', 'bbsf' ),
                    'type'              => 'text',
                    'default'           => 'Member',
                    'sanitize_callback' => 'sanitize_text_field'
                ),
                array(
                    'name'              => 'bbsf_rank2_start',
                    'label'             => __( 'Minimum topics', 'bbsf' ),
                    'desc'              => __( 'Minimum topics count to assign ranking', 'bbsf' ),
                    'placeholder'       => __( '1', 'bbsf' ),
                    'step'              => '1',
                    'type'              => 'number',
                    'default'           => '1',
                    'sanitize_callback' => 'floatval'
                ),
                array(
                    'name'              => 'bbsf_rank2_end',
                    'label'             => __( 'Maximum topics', 'bbsf' ),
                    'desc'              => __( 'Maximum topics count to assign ranking', 'bbsf' ),
                    'placeholder'       => __( '100', 'bbsf' ),
                    'min'               => 1,
                    'step'              => '1',
                    'type'              => 'number',
                    'default'           => '100',
                    'sanitize_callback' => 'floatval'
                ),
                array(
                    'name'              => 'bbsf_rank3',
                    'label'             => __( 'User ranking level 3', 'bbsf' ),
                    'desc'              => __( 'Rank Title', 'bbsf' ),
                    'placeholder'       => __( 'Member', 'bbsf' ),
                    'type'              => 'text',
                    'default'           => 'Member',
                    'sanitize_callback' => 'sanitize_text_field'
                ),
                array(
                    'name'              => 'bbsf_rank3_start',
                    'label'             => __( 'Minimum topics', 'bbsf' ),
                    'desc'              => __( 'Minimum topics count to assign ranking', 'bbsf' ),
                    'placeholder'       => __( '1', 'bbsf' ),
                    'step'              => '1',
                    'type'              => 'number',
                    'default'           => '1',
                    'sanitize_callback' => 'floatval'
                ),
                array(
                    'name'              => 'bbsf_rank3_end',
                    'label'             => __( 'Maximum topics', 'bbsf' ),
                    'desc'              => __( 'Maximum topics count to assign ranking', 'bbsf' ),
                    'placeholder'       => __( '100', 'bbsf' ),
                    'min'               => 1,
                    'step'              => '1',
                    'type'              => 'number',
                    'default'           => '100',
                    'sanitize_callback' => 'floatval'
                ),
                array(
                    'name'              => 'bbsf_rank4',
                    'label'             => __( 'User ranking level 4', 'bbsf' ),
                    'desc'              => __( 'Rank Title', 'bbsf' ),
                    'placeholder'       => __( 'Member', 'bbsf' ),
                    'type'              => 'text',
                    'default'           => 'Member',
                    'sanitize_callback' => 'sanitize_text_field'
                ),
                array(
                    'name'              => 'bbsf_rank4_start',
                    'label'             => __( 'Minimum topics', 'bbsf' ),
                    'desc'              => __( 'Minimum topics count to assign ranking', 'bbsf' ),
                    'placeholder'       => __( '1', 'bbsf' ),
                    'step'              => '1',
                    'type'              => 'number',
                    'default'           => '1',
                    'sanitize_callback' => 'floatval'
                ),
                array(
                    'name'              => 'bbsf_rank4_end',
                    'label'             => __( 'Maximum topics', 'bbsf' ),
                    'desc'              => __( 'Maximum topics count to assign ranking', 'bbsf' ),
                    'placeholder'       => __( '100', 'bbsf' ),
                    'min'               => 1,
                    'step'              => '1',
                    'type'              => 'number',
                    'default'           => '100',
                    'sanitize_callback' => 'floatval'
                ),
                array(
                    'name'              => 'bbsf_rank5',
                    'label'             => __( 'User ranking level 5', 'bbsf' ),
                    'desc'              => __( 'Rank Title', 'bbsf' ),
                    'placeholder'       => __( 'Member', 'bbsf' ),
                    'type'              => 'text',
                    'default'           => 'Member',
                    'sanitize_callback' => 'sanitize_text_field'
                ),
                array(
                    'name'              => 'bbsf_rank5_start',
                    'label'             => __( 'Minimum topics', 'bbsf' ),
                    'desc'              => __( 'Minimum topics count to assign ranking', 'bbsf' ),
                    'placeholder'       => __( '1', 'bbsf' ),
                    'step'              => '1',
                    'type'              => 'number',
                    'default'           => '1',
                    'sanitize_callback' => 'floatval'
                ),
                array(
                    'name'              => 'bbsf_rank5_end',
                    'label'             => __( 'Maximum topics', 'bbsf' ),
                    'desc'              => __( 'Maximum topics count to assign ranking', 'bbsf' ),
                    'placeholder'       => __( '100', 'bbsf' ),
                    'min'               => 1,
                    'step'              => '1',
                    'type'              => 'number',
                    'default'           => '100',
                    'sanitize_callback' => 'floatval'
                ),
                array(
                    'name'              => 'bbsf_show_post_count',
                    'label'             => __( 'Show forum post count', 'bbsf' ),
                    'desc'              => __( 'Show the users post count below their gravatar?', 'bbsf' ),
                    'type'              => 'checkbox',
                    'default'           => 'on'
                ),
                array(
                    'name'              => 'bbsf_show_rank',
                    'label'             => __( 'Show Rank', 'bbsf' ),
                    'desc'              => __( 'Display the users rank title below their gravatar?', 'bbsf' ),
                    'type'              => 'checkbox',
                    'default'           => 'off'
                ),
            ),

            'bbsf_topic_status'         => array(
                array(
                    'name'              => 'bbsf_default_status',
                    'label'             => __( 'Default Status', 'bbsf' ),
                    'desc'              => __( 'This is the default status that will get displayed on all topics', 'bbsf' ),
                    'type'              => 'select',
                    'options'           => array(
                        'not_resolved'  => __( 'Not resolved', 'bbsf' ),
                        'resolved'      => __( 'Resolved', 'bbsf' ),
                        'not_support'   => __( 'Not a support question', 'bbsf' )
                    )
                ),
                array(
                    'name'              => 'bbsf_show_status_not_resolved',
                    'label'             => __( 'Display Status', 'bbsf' ),
                    'desc'              => __( 'Not resolved', 'bbsf' ),
                    'type'              => 'checkbox',
                    'default'           => 'on'
                ),
                array(
                    'name'              => 'bbsf_show_status_resolved',
                    'label'             => __( 'Display Status', 'bbsf' ),
                    'desc'              => __( 'Resolved', 'bbsf' ),
                    'type'              => 'checkbox',
                    'default'           => 'on'
                ),
                array(
                    'name'              => 'bbsf_show_status_not_support',
                    'label'             => __( 'Display Status', 'bbsf' ),
                    'desc'              => __( 'Not a support question', 'bbsf' ),
                    'type'              => 'checkbox',
                    'default'           => 'on'
                ),
                array(
                    'name'              => 'bbsf_allow_status_change_admin',
                    'label'             => __( 'Admin', 'bbsf' ),
                    'desc'              => __( 'Allow the admin to update the topic status (recommended).', 'bbsf' ),
                    'type'              => 'checkbox',
                    'default'           => 'on'
                ),
                array(
                    'name'              => 'bbsf_allow_status_change_creator',
                    'label'             => __( 'Topic Creator', 'bbsf' ),
                    'desc'              => __( 'Allow the person who created the topic to update the status.', 'bbsf' ),
                    'type'              => 'checkbox',
                    'default'           => 'on'
                ),
                array(
                    'name'              => 'bbsf_allow_status_change_moderator',
                    'label'             => __( 'Forum Moderator', 'bbsf' ),
                    'desc'              => __( 'Allow the forum moderators to update the post status.', 'bbsf' ),
                    'type'              => 'checkbox',
                    'default'           => 'on'
                ),
            ),

            'bbsf_support_forum'        => array(
                array(
                    'name'              => 'bbsf_enable_urgent_status',
                    'label'             => __( 'Urgent Topic Status', 'bbsf' ),
                    'desc'              => __( 'Allow the forum moderators and admin to mark a topic as Urgent, this will mark the topic title with [urgent].', 'bbsf' ),
                    'type'              => 'checkbox',
                    'default'           => 'on'
                ),
                array(
                    'name'              => 'bbsf_enable_move_topics',
                    'label'             => __( 'Move topics', 'bbsf' ),
                    'desc'              => __( 'Allow the forum moderators and admin to move topics to other forums.', 'bbsf' ),
                    'type'              => 'checkbox',
                    'default'           => 'on'
                ),
                array(
                    'name'              => 'bbsf_enable_assign_topics',
                    'label'             => __( 'Assign topics', 'bbsf' ),
                    'desc'              => __( 'Allow administrators and forum moderators to assign topics to other administrators and forum moderators', 'bbsf' ),
                    'type'              => 'checkbox',
                    'default'           => 'on'
                ),
                array(
                    'name'              => 'bbsf_enable_claim_topics',
                    'label'             => __( 'Claim topics', 'bbsf' ),
                    'desc'              => __( 'Allow the forum moderators and admin to claim a topic, this will mark the topic title with [claimed] but will only show to forum moderators and admin users', 'bbsf' ),
                    'type'              => 'checkbox',
                    'default'           => 'on'
                ),
                array(
                    'name'              => 'bbsf_show_claimed_user',
                    'label'             => __( 'Display Username', 'bbsf' ),
                    'desc'              => __( 'By selecting this option if a topic is claimed the claimed persons username will be displayed next to the topic title instead of the words [claimed], leaving this unchecked will default to [claimed]', 'bbsf' ),
                    'type'              => 'checkbox',
                    'default'           => 'on'
                ),

            ),

            'bbsf_import_settings'      => array(

            )

        );
        
        if ( 'no' === get_option( 'bbsf_imported_bbps', 'no' ) ) {

            $settings_fields['bbsf_import_settings'][] = array(
                'name'  => 'import_bbps_settings',
                'label' => 'Import Settings from bbPress VIP Support Forum',
                'desc'  => '<a href="#" id="bbsf-import-bbps" class="button button-secondary" data-nonce="' . wp_create_nonce( "bbsf_import_bbps" ) . '">' . __( 'Start importing', 'bbsf' ) . '</a>',
                'type'  => 'html'
            );

        } else {

            $settings_fields['bbsf_import_settings'][] = array(
                'name'  => 'import_bbps_settings',
                'label' => 'Import Settings from bbPress VIP Support Forum',
                'desc'  => __( 'Settings are already imported. you can disable old plugin.', 'bbsf' ),
                'type'  => 'html'
            );

        }


                
        return $settings_fields;
    }

    function plugin_page() {
        echo '<div class="wrap">';

        $this->settings_api->show_navigation();
        $this->settings_api->show_forms();

        echo '</div>';
    }

    /**
     * Get all the pages
     *
     * @return array page names with key value pairs
     */
    function get_pages() {
        $pages = get_pages();
        $pages_options = array();
        if ( $pages ) {
            foreach ($pages as $page) {
                $pages_options[$page->ID] = $page->post_title;
            }
        }

        return $pages_options;
    }

}
endif;
