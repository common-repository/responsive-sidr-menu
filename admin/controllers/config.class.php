<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
class RSM_Admin_Config {

    var $settings;

    function __construct() {

        $this->settings = new RSM_Admin_Settings;

        add_action( 'admin_enqueue_scripts', array( $this, 'scripts' ) );
        add_filter( 'plugin_action_links_'  . RSMBASE, array($this, 'settings_link_plugins_screen') );

    }

    function scripts() {
        wp_enqueue_style( 'rsm-admin-css', RSMURL . '/admin/assets/css/rsm-admin.css' );
    }

    function settings_link_plugins_screen( $links ) {

		$the_links = array();

		$settings = esc_url( add_query_arg(
			array('page' => 'responsive-sidr-menu'),
			get_admin_url() . 'admin.php/options-general.php'
		) );

		$the_links[] = '<a href=' . $settings . '>' . __( 'Settings', 'rsm-admin' ) . '</a>';

		foreach( $the_links as $the_link ) {
			array_push( $links, $the_link );
		}

		return $links;
	}

}
new RSM_Admin_Config;
?>
