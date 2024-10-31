<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
class RSM_Config {

    var $frontend, $settings, $global;

    function __construct() {
        $this->global = new RSM_Global_Static;
        $this->settings = $this->global::get_settings();
        $this->frontend = new RSM_Frontend;
        add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ) );

    }

    function scripts() {

        $theme = isset( $this->settings['rsm_theme'] ) && $this->settings['rsm_theme'] ? $this->settings['rsm_theme'] : 'dark';

        wp_enqueue_style( 'rsm-theme', RSMURL . '/frontend/assets/scripts/sidr/stylesheets/jquery.sidr.' . $theme . '.min.css' );
        wp_enqueue_style( 'rsm-main', RSMURL . '/frontend/assets/css/rsm-main.css' );

        wp_enqueue_script( 'rsm-sidr-main', RSMURL . '/frontend/assets/scripts/sidr/jquery.sidr.min.js', array('jquery'), '', true );
        wp_enqueue_script( 'rsm-main', RSMURL . '/frontend/assets/js/rsm-main.js', array('jquery'), '', true );
        wp_localize_script( 'rsm-main', 'rsm', array(
            'msw' => isset( $this->settings['rsm_min_screen_width'] ) && $this->settings['rsm_min_screen_width'] ? $this->settings['rsm_min_screen_width'] : '100',
            'md'  => isset( $this->settings['rsm_direction'] ) && $this->settings['rsm_direction'] ? $this->settings['rsm_direction'] : 'left',
            'ms'  => isset( $this->settings['rsm_menu'] ) && $this->settings['rsm_menu'] ? $this->settings['rsm_menu'] : ''
        ));

    }

}
new RSM_Config;
?>
