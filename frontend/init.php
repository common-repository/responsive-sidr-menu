<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
$files = array(
    'views/frontend.views.class.php',
    'controllers/frontend.class.php',
    'controllers/config.class.php'
);
foreach( $files as $file ) {
    require_once( $file );
}
?>
