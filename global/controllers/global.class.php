<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
class RSM_Global {

    function __construct() {
        add_action( 'widgets_init', array( $this, 'sidebars' ) );
    }

    function sidebars() {

        register_sidebar( array(
            'name'          => __( 'Sidr Top', 'rsm' ),
            'id'            => 'sidr-top',
            'description'   => __( 'Widgets in this area will be shown on all posts and pages.', 'rsm' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<div class="sidr-widget-title">',
            'after_title'   => '</div>',
        ) );

        register_sidebar( array(
            'name'          => __( 'Sidr Bottom', 'rsm' ),
            'id'            => 'sidr-bottom',
            'description'   => __( 'Widgets in this area will be shown on all posts and pages.', 'rsm' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<div class="sidr-widget-title">',
            'after_title'   => '</div>',
        ) );

    }

}
new RSM_Global;

class RSM_Global_Static {

    var $settings;

    public static function get_settings() {

        $thesettings = array();
        $settings = array(
            'rsm_enabled',
            'rsm_menu',
            'rsm_theme',
            'rsm_direction',
            'rsm_toggle_label',
            'rsm_toggle_type',
            'rsm_toggle_theme',
            'rsm_min_screen_width'
        );
        foreach( $settings as $setting ) {
            $thesettings[ $setting ] = get_option( $setting );
        }

        return $thesettings;

    }

}
?>
