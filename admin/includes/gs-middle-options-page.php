<?php 
$roles = get_editable_roles();
$menus = frontend_admin_menu_menus();

if( ! empty( $_POST['Submit'] ) && $_POST['Submit'] == 'Save options' ) {

    $frontend_admin_menu_status = sanitize_text_field ( isset( $_POST['frontend_admin_menu_status'] ) ? esc_html( trim( $_POST['frontend_admin_menu_status'] ) ) : null );
    $frontend_admin_menu_admin_bar = sanitize_text_field ( isset( $_POST['frontend_admin_menu_admin_bar'] ) ? esc_html( trim( $_POST['frontend_admin_menu_admin_bar'] ) ) : null );
    $frontend_admin_menu_admin_menu_backend = sanitize_text_field ( isset( $_POST['frontend_admin_menu_admin_menu_backend'] ) ? esc_html( trim( $_POST['frontend_admin_menu_admin_menu_backend'] ) ) : null );
            
    $frontend_admin_menu_mapping = array();
    foreach ( $roles as $key => $rol ) {
        $frontend_admin_menu_mapping[$key] = sanitize_text_field ( isset( $_POST['frontend_admin_menu_mapping_' . $key] ) ? esc_html( trim( $_POST['frontend_admin_menu_mapping_' . $key] ) ) : null );
        update_option( 'frontend_admin_menu_mapping_' . $key, $frontend_admin_menu_mapping[$key]);
    }
    update_option( 'frontend_admin_menu_status', $frontend_admin_menu_status );
    update_option( 'frontend_admin_menu_admin_bar', $frontend_admin_menu_admin_bar );
    update_option( 'frontend_admin_menu_admin_menu_backend',  $frontend_admin_menu_admin_menu_backend);

    print '<div class="updated">';
         _e( 'Options saved.' );
    print '</div>';

}

$frontend_admin_menu_status = get_option( 'frontend_admin_menu_status' );
$frontend_admin_menu_admin_bar = get_option( 'frontend_admin_menu_admin_bar' );
$frontend_admin_menu_admin_menu_backend = get_option( 'frontend_admin_menu_admin_menu_backend' );


if ( $frontend_admin_menu_status > 0 ) {
    
    $checked_status = "checked";
    
} else {
  
    $checked_status = false;
    
}

if ( $frontend_admin_menu_admin_bar > 0 ) {
    
    $checked_admin_bar = "checked";
    
} else {
  
    $checked_admin_bar = false;
    
}

if ( $frontend_admin_menu_admin_menu_backend > 0 ) {
    
    $checked_backend_menu = "checked";
    
} else {
  
    $checked_backend_menu = false;
    
} 
?>

<div class="container">
    <form name="frontend_admin_menu_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI'] ); ?>">
         <div class="wgc-box wgc-box-1">
            <div class="header medium">
                <?php _e( '<h4>Basic options</h4>', 'frontend-admin-menu' ); ?>
            </div>
            <div class="wgc-box-body">
                <table>
                    <tr>
                        <td><input type="checkbox" name="frontend_admin_menu_status" id="frontend_admin_menu_status" value="1" <?php print $checked_status; ?> /></td>
                        <td><label for="frontend_admin_menu_status"><?php _e( 'Enabled frontend admin menu? <i>(Remember to mapping a menu to rol)</i>', 'frontend-admin-menu' ); ?></label></td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" name="frontend_admin_menu_admin_bar" id="frontend_admin_menu_admin_bar" value="1" <?php print $checked_admin_bar; ?> /></td>
                        <td><label for="frontend_admin_menu_admin_bar"><?php _e( 'Hide admin bar? <i>(Reload page after save)</i>', 'frontend-admin-menu' ); ?></label></td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" name="frontend_admin_menu_admin_menu_backend" id="frontend_admin_menu_admin_menu_backend" value="1" <?php print $checked_backend_menu; ?> /></td>
                        <td><label for="frontend_admin_menu_admin_menu_backend"><?php _e( 'Enable admin backend menu to all roles? <i>(This isn´t apply to Administrator)</i>', 'frontend-admin-menu' ); ?></label></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="wgc-box wgc-box-2">
            <div class="header medium">
                <?php _e( '<h4>Mapping menu to roles</h4>', 'frontend-admin-menu' ); ?>
                ( <a href="<?php echo admin_url(); ?>nav-menus.php">Manage your menus</a> - <a href="<?php echo admin_url(); ?>nav-menus.php?action=edit&menu=0">Create new menu</a> )
            </div>
            <div class="wgc-box-body">
                <table>
                    <?php
                    $frontend_admin_menu_mapping_option = array();
                    foreach ( $roles as $key => $rol ) {
                        $currentmenu = get_option( 'frontend_admin_menu_mapping_' . $key );
                        print '<tr>';
                            print '<td>';
                                print _e( 'Choose a menu to', 'frontend-admin-menu' ).' '.$rol['name'].': ';
                            print '</td>';
                            print '<td>';
                            print '<select name="frontend_admin_menu_mapping_' . $key . '" id="frontend_admin_menu_mapping_' . $key . '">';
                                print '<option value=""> -- No menu selected -- </option>';
                                foreach ( $menus as $val => $menu ) {
                                    if ( $currentmenu == $menu->slug) {
                                        $selectedmenu = 'selected';
                                    } else {
                                        $selectedmenu = false;
                                    }
                                    print '<option value="' . $menu->slug . '" ' . $selectedmenu . '>' . $menu->name . '</option>';
                                }
                            print '</select>';
                            print '</td>';
                        print '</tr>';
                    }
                    ?>
                </table>
            </div>
        </div>
        <div class="block">
            <p class="submit">
                <input type="submit" class="button button-primary" name="Submit" id="Submit" value="<?php _e( 'Save options', 'frontend-admin-menu' ); ?>" />
            </p>
        </div>
    </form>
</div> <!-- container -->

