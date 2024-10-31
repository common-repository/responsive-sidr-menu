<?php
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

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
    delete_option( $setting );
}
?>
