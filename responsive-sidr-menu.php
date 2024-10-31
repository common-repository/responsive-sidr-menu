<?php
/*
Plugin Name: Responsive Sidr Menu
Plugin URI: https://www.tudorache.me/responsive-sidr-menu.html
Description: Adds a responsive menu which can be toggled from inside the website theme. The menu is based on Sidr by Berriart
Version: 1.0.1
Author: Adrian Emil Tudorache
Author URI: https://www.tudorache.me
License: GPLv2 or later
*/
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'RSMPATH', plugin_dir_path( __FILE__ ) );
define( 'RSMBASE', plugin_basename( __FILE__ ) );
define( 'RSMURL', plugin_dir_url( __FILE__ ) );

class RSM {

    static function init() {
        require_once( RSMPATH . '/global/init.php' );
        if( ! is_admin() ) {
            require_once( RSMPATH . '/frontend/init.php');
        }
        if( is_admin() ) {
            require_once( RSMPATH . '/admin/init.php');
        }
    }

}

RSM::init();

?>
