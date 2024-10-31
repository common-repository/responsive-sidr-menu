<?php
class RSM_Admin_Views {

    function settings( $data = null ) {
        $settings = isset( $data['settings'] ) && $data['settings'] ? $data['settings'] : null;
        $menus    = isset( $data['nav_menus'] ) && $data['nav_menus'] ? $data['nav_menus'] : null;
        ob_start();
    ?>
    <div class="wrap">
        <h1><?php _e('Responsive Sidr Menu', 'rsm-admin'); ?></h1>
        <form action="<?php echo admin_url(); ?>/options.php" method="POST">
        <?php
            settings_fields("rsm_settings");
            do_settings_sections("responsive-sidr-menu");
            submit_button();
        ?>
        </form>
    </div>
    <?php
        return ob_get_clean();
    }

    function markup( $type, $args ) {
        ob_start();

        switch( $type ) {
            case 'checkbox':
?>
        <input id="<?php echo $args['id']; ?>" name="<?php echo $args['id']; ?>" type="checkbox" <?php echo $args['value'] == 'on' ? 'checked="checked"' : ''; ?> />
<?php
            break;
            case 'select':
?>
        <select id="<?php echo $args['id']; ?>" name="<?php echo $args['id']; ?>">
        <?php foreach( $args['options'] as $value => $label ) { ?>
            <option <?php echo $value == $args['value'] ? 'selected="selected"' : ''; ?> value="<?php echo $value; ?>"><?php echo $label; ?></option>
        <?php } ?>
        </select>
<?php
            break;
            case 'text':
?>
        <input type="text" id="<?php echo $args['id']; ?>" name="<?php echo $args['id']; ?>" value="<?php echo $args['value']; ?>" />
<?php
            break;
        }

        return ob_get_clean();
    }

}
?>
