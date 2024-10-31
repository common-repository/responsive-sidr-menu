<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
$files = array(
    'views/admin.views.class.php',
    'controllers/settings.class.php',
    'controllers/config.class.php'
);
foreach( $files as $file ) {
    require_once( $file );
}
?>
