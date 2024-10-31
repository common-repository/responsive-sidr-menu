<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
$files = array(
    'controllers/global.class.php'
);
foreach( $files as $file ) {
    require_once( $file );
}
?>
