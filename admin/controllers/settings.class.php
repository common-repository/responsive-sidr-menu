<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
class RSM_Admin_Settings {

    private $views, $settings;

    function __construct() {
        $this->global = new RSM_Global_Static;
        $this->settings = $this->global::get_settings();
        $this->views = new RSM_Admin_Views;
        add_action( 'admin_menu', array( $this, 'menu' ) );
        add_action( 'admin_init', array( $this, 'display' ) );
    }

    function get_settings() {

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

    function menu() {
        add_options_page(
            'Responsive Sidr Menu',
            'Responsive Sidr Menu',
            'manage_options',
            'responsive-sidr-menu',
            array($this, 'settings')
        );
    }

    function settings() {
        echo $this->views->settings();
    }

    function display() {

        add_settings_section('rsm_settings', __('Settings', 'rsm-admin'), array( $this, 'display_settings' ), 'responsive-sidr-menu');

        $settings_fields = array(
            'rsm_enabled' => array(
                'label' => __('Enabled', 'rsm-admin'),
                'callback' => 'enabled_checkbox'
            ),
            'rsm_menu' => array(
                'label' => sprintf( __('Menu', 'rsm-admin') . '<br/><small><a href="%snav-menus.php" target="_blank">' . __('Edit Nav Menus', 'rsm-admin') . '</a></small>', admin_url() ),
                'callback' => 'menu_select'
            ),
            'rsm_theme' => array(
                'label' => __('Theme', 'rsm-admin'),
                'callback' => 'theme_select'
            ),
            'rsm_direction' => array(
                'label' => __('Slides from', 'rsm-admin'),
                'callback' => 'direction_select'
            ),
            'rsm_toggle_label' => array(
                'label' => __('Text before menu toggle icon', 'rsm-admin'),
                'callback' => 'toggle_label_text'
            ),
            'rsm_toggle_type' => array(
                'label' => __('Toggle button type', 'rsm-admin'),
                'callback' => 'toggle_type_select'
            ),
            'rsm_toggle_theme' => array(
                'label' => __('Toggle Theme', 'rsm-admin'),
                'callback' => 'toggle_theme_select'
            ),
            'rsm_min_screen_width' => array(
                'label' => __('Only display menu when the browser width is less than a certain value. Leave empty to always display the menu', 'rsm-admin'),
                'callback' => 'min_screen_width_text'
            ),
            'rsm_widgets' => array(
                'label' => sprintf( __('Widgets', 'rsm-admin') . '<br/><small><a href="%swidgets.php" target="_blank">' . __('Edit Widgets', 'rsm-admin') . '</a></small>', admin_url() ),
                'callback' => 'widgets_paragraph'
            )
        );

        foreach( $settings_fields as $fieldid => $field ) {
            add_settings_field($fieldid, $field['label'], array( $this, $field['callback'] ), 'responsive-sidr-menu', 'rsm_settings');
            register_setting( 'rsm_settings', $fieldid );
        }

    }

    function display_settings() {
        //echo 'RSM Settings';
    }

    function enabled_checkbox() {
        $enabled = $this->settings['rsm_enabled'];
        echo $this->views->markup( 'checkbox', array( 'id' => 'rsm_enabled', 'value' => $enabled ) );
    }

    function menu_select() {

        $menus = wp_get_nav_menus();
        $options = array();
        foreach( $menus as $menu ) {
            $options[ $menu->term_id ] = $menu->name;
        }
        $value = $this->settings['rsm_menu'];

        echo $this->views->markup( 'select', array( 'id' => 'rsm_menu', 'value' => $value, 'options' => $options ) );

    }

    function theme_select() {

        $options = array(
            'light' => __('Light', 'rsm-admin'),
            'dark'  => __('Dark', 'rsm-admin')
        );
        $value = $this->settings['rsm_theme'];

        echo $this->views->markup( 'select', array( 'id' => 'rsm_theme', 'value' => $value, 'options' => $options ) );

    }

    function direction_select() {

        $options = array(
            'left'  => __('Left', 'rsm-admin'),
            'right' => __('Right', 'rsm-admin')
        );
        $value = $this->settings['rsm_direction'];

        echo $this->views->markup( 'select', array( 'id' => 'rsm_direction', 'value' => $value, 'options' => $options ) );

    }

    function toggle_label_text() {

        $value = $this->settings['rsm_toggle_label'];
        echo $this->views->markup( 'text', array( 'id' => 'rsm_toggle_label', 'value' => $value ) );

    }

    function toggle_type_select() {

        $options = array(
            'bar'       => __('Button in top bar', 'rsm-admin'),
            'no_bar'    => __('Button Only', 'rsm-admin')
        );
        $value = $this->settings['rsm_toggle_type'];

        echo $this->views->markup( 'select', array( 'id' => 'rsm_toggle_type', 'value' => $value, 'options' => $options ) );

    }

    function toggle_theme_select() {

        $options = array(
            'light' => __('Light', 'rsm-admin'),
            'dark'  => __('Dark', 'rsm-admin')
        );
        $value = $this->settings['rsm_toggle_theme'];

        echo $this->views->markup( 'select', array( 'id' => 'rsm_toggle_theme', 'value' => $value, 'options' => $options ) );

    }

    function min_screen_width_text() {

        $value = $this->settings['rsm_min_screen_width'];
        echo $this->views->markup( 'text', array( 'id' => 'rsm_min_screen_width', 'value' => $value ) );

    }

    function widgets_paragraph() {

        if( ! is_active_sidebar('sidr-top') && ! is_active_sidebar('sidr-bottom') ) {
            echo '<p>' . __( 'You haven\'t published any widgets before, nor after the menu.', 'rsm-admin' ) . '</p>';
        } elseif( is_active_sidebar('sidr-top') && ! is_active_sidebar('sidr-bottom') ) {
            echo '<p>' . __( 'You have published some widgets before the menu, but you haven\'t published any after the menu.', 'rsm-admin' ) . '</p>';
        } elseif( ! is_active_sidebar('sidr-top') && is_active_sidebar('sidr-bottom') ) {
            echo '<p>' . __( 'You have published some widgets after the menu, but you haven\'t published any before the menu.', 'rsm-admin' ) . '</p>';
        } else {
            echo '<p>' . __( 'You have published some widgets before and after the menu. Well done!', 'rsm-admin' ) . '</p>';
        }
        
    }

}
?>
