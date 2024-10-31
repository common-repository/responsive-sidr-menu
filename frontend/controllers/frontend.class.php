<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
class RSM_Frontend {

    protected $views, $settings, $global;

    function __construct() {
        $this->views = new RSM_Frontend_Views;
        $this->global = new RSM_Global_Static;
        $this->settings = $this->global::get_settings();
        if( ( isset( $this->settings['rsm_enabled'] ) && $this->settings['rsm_enabled'] == 'on' ) &&
            ( isset( $this->settings['rsm_menu'] ) && $this->settings['rsm_menu'] ) ) {
            add_action( 'wp_footer', array($this, 'toggle') );
            add_action( 'wp_footer', array($this, 'front') );
        }
    }



    function toggle() {
        echo $this->views->toggle( $this->settings );
    }

    function front() {
        echo $this->views->front( $this->settings );
    }

}
?>
