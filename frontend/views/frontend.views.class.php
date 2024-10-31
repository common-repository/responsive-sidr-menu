<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
class RSM_Frontend_Views {

    function toggle( $settings = null ) {
        $classes = '';
        $classes .= isset( $settings['rsm_toggle_type'] ) && $settings['rsm_toggle_type'] ? $settings['rsm_toggle_type'] . ' ' : ' ';
        $classes .= isset( $settings['rsm_toggle_theme'] ) && $settings['rsm_toggle_theme'] ? $settings['rsm_toggle_theme'] . ' ' : 'dark ';
        $classes .= isset( $settings['rsm_direction'] ) && $settings['rsm_direction'] ? 'dir-' . $settings['rsm_direction'] . ' ' : 'dir-left ';
        ob_start();
?>
        <a
            href="#!"
            data-menu="#rsm-menu"
            class="rsm-toggle-container <?php echo $classes ; ?>"
        >
            <span class="rsm-toggle-wrapper">
                <button aria-expanded="false" aria-pressed="false" class="rsm-toggle" id="rsm_toggle">
                    <span class="menu-toggle-top-bar"></span>
                    <span class="menu-toggle-middle-bar"></span>
                    <span class="menu-toggle-bottom-bar"></span>
                </button>
                <?php if( isset($settings['rsm_toggle_label']) && $settings['rsm_toggle_label'] ) { ?>
                <span class="rsm-toggle-label"><?php echo $settings['rsm_toggle_label']; ?></span>
                <?php } ?>
            </span>
        </a>
<?php
        return ob_get_clean();
    }

    function front( $settings = null ) {
        $menu = wp_nav_menu( array('menu' => $settings['rsm_menu'], 'container' => '', 'echo' => false) );
        ob_start();
?>
        <div class="rsm-menu <?php echo isset( $settings['rsm_theme'] ) && $settings['rsm_theme'] ? $settings['rsm_theme'] : '' ?>" id="rsm-menu" data-menu="<?php echo $settings['rsm_menu']; ?>">
            <div class="rsm-menu-wrapper">
            <?php
                if( is_active_sidebar( 'sidr-top' ) ) {
                    dynamic_sidebar('sidr-top');
                }

                echo $menu;

                if( is_active_sidebar( 'sidr-bottom' ) ) {
                    dynamic_sidebar('sidr-bottom');
                }
            ?>
            </div>
        </div>
<?php
        echo ob_get_clean();
    }

}
?>
