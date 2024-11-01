<?php

namespace SSMXtraPostInfo;

class PostInfo
{
    /**
     * Holds an instance of the object
     *
     * @var SSMXtraPostInfo
     **/
    private static $instance = null;

    /**
     * Returns the running object - implements the Singleton design pattern
     *
     * @return SSMXtraPostInfo
     **/
    public static function ssm_postinfo_init(){
        is_null( self::$instance ) AND self::$instance = new self;
        return self::$instance;
    }
    public static function ssm_postinfo_on_activation()
    {
        if ( ! current_user_can( 'activate_plugins' ) )
            return;
        $plugin = isset( $_REQUEST['plugin'] ) ? $_REQUEST['plugin'] : '';
        check_admin_referer( "activate-plugin_{$plugin}" );
    }
    public static function ssm_postinfo_on_deactivation()
    {
        if ( ! current_user_can( 'activate_plugins' ) )
            return;
        $plugin = isset( $_REQUEST['plugin'] ) ? $_REQUEST['plugin'] : '';
        check_admin_referer( "deactivate-plugin_{$plugin}" );
    }
    private function __construct(){
        add_action('manage_posts_custom_column', array($this, 'ssm_postinfo_columns_content'));
        add_filter('manage_posts_columns', array($this, 'ssm_postinfo_columns_head'));
    }
    // ADD NEW COLUMN
    public function ssm_postinfo_columns_head($columns) {
        $columns['featured_image'] = 'Featured Image';
        return $columns;
    }
    
    // SHOW THE FEATURED IMAGE
    public function ssm_postinfo_columns_content($column_name) {
        global $post;
        if ($column_name == 'featured_image') {
            $post_thumbnail_id = get_post_thumbnail_id($post_ID);
            if ($post_thumbnail_id) {
                $post_featured_image = wp_get_attachment_image_src($post_thumbnail_id, 'thumbnail');
            }
            if ($post_featured_image) {
                echo '<img src="' . $post_featured_image[0] . '" width=100% />';
            }else{
                echo '—';
            }
        }
    }
}


