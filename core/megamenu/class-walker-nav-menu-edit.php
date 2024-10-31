<?php
/**
 *
 * @package octagon-elements-lite-for-elementor/core/megamenu
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.0
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Create HTML list of nav menu input items.
 *
 * @since 3.0.0
 *
 * @see Walker_Nav_Menu
 */
class Octagon_Walker_Nav_Menu_Edit extends Walker_Nav_Menu {
    /**
     * Starts the list before the elements are added.
     *
     * @see Walker_Nav_Menu::start_lvl()
     *
     * @since 3.0.0
     *
     * @param string $output Passed by reference.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   Not used.
     */
    public function start_lvl( &$output, $depth = 0, $args = [] ) {}

    /**
     * Ends the list of after the elements are added.
     *
     * @see Walker_Nav_Menu::end_lvl()
     *
     * @since 3.0.0
     *
     * @param string $output Passed by reference.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   Not used.
     */
    public function end_lvl( &$output, $depth = 0, $args = [] ) {}

    /**
     * Start the element output.
     *
     * @see Walker_Nav_Menu::start_el()
     * @since 3.0.0
     *
     * @global int $_wp_nav_menu_max_depth
     *
     * @param string $output Used to append additional content (passed by reference).
     * @param object $item   Menu item data object.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   Not used.
     * @param int    $id     Not used.
     */
    public function start_el( &$output, $item, $depth = 0, $args = [], $id = 0 ) {
        global $_wp_nav_menu_max_depth;
        $_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

        ob_start();
        $item_id = esc_attr( $item->ID );
        $removed_args = array(
            'action',
            'customlink-tab',
            'edit-menu-item',
            'menu-item',
            'page-tab',
            '_wpnonce',
        );

        $original_title = false;
        if ( 'taxonomy' == $item->type ) {
            $original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
            if ( is_wp_error( $original_title ) )
                $original_title = false;
        } elseif ( 'post_type' == $item->type ) {
            $original_object = get_post( $item->object_id );
            $original_title = get_the_title( $original_object->ID );
        } elseif ( 'post_type_archive' == $item->type ) {
            $original_object = get_post_type_object( $item->object );
            if ( $original_object ) {
                $original_title = $original_object->labels->archives;
            }
        }

        $classes = array(
            'menu-item menu-item-depth-' . $depth,
            'menu-item-' . esc_attr( $item->object ),
            'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
        );

        $title = $item->title;

        if ( ! empty( $item->_invalid ) ) {
            $classes[] = 'menu-item-invalid';
            /* translators: %s: title of menu item which is invalid */
            $title = sprintf( __( '%s (Invalid)', 'octagon-elements-lite-for-elementor' ), $item->title );
        } elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
            $classes[] = 'pending';
            /* translators: %s: title of menu item in draft status */
            $title = sprintf( __( '%s (Pending)', 'octagon-elements-lite-for-elementor' ), $item->title );
        }

        $title = ( ! isset( $item->label ) || '' == $item->label ) ? $title : $item->label;

        ?>
        <li id="menu-item-<?php echo esc_attr( $item_id ); ?>" class="<?php echo esc_attr( implode(' ', $classes ) ); ?>">
            <div class="menu-item-bar">
                <div class="menu-item-handle">
                    <span class="item-title"><span class="menu-item-title"><?php echo esc_html( $title ); ?></span> <span class="is-submenu not-depth-<?php echo esc_attr( $depth ); ?>"><?php esc_html_e( 'sub item', 'octagon-elements-lite-for-elementor' ); ?></span></span>
                    <span class="item-controls">
                        <span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
                        <span class="item-order hide-if-js">
                            <a href="<?php
                                echo wp_nonce_url(
                                    add_query_arg(
                                        array(
                                            'action' => 'move-up-menu-item',
                                            'menu-item' => $item_id,
                                        ),
                                        remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
                                    ),
                                    'move-menu_item'
                                );
                            ?>" class="item-move-up" aria-label="<?php esc_attr_e( 'Move up', 'octagon-elements-lite-for-elementor' ) ?>">&#8593;</a>
                            |
                            <a href="<?php
                                echo wp_nonce_url(
                                    add_query_arg(
                                        array(
                                            'action' => 'move-down-menu-item',
                                            'menu-item' => $item_id,
                                        ),
                                        remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
                                    ),
                                    'move-menu_item'
                                );
                            ?>" class="item-move-down" aria-label="<?php esc_attr_e( 'Move down', 'octagon-elements-lite-for-elementor' ) ?>">&#8595;</a>
                        </span>
                        <a class="item-edit" id="edit-<?php echo esc_attr( $item_id ); ?>" href="<?php
                            echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
                        ?>" aria-label="<?php esc_attr_e( 'Edit menu item', 'octagon-elements-lite-for-elementor' ); ?>"><span class="screen-reader-text"><?php esc_html_e( 'Edit', 'octagon-elements-lite-for-elementor' ); ?></span></a>
                    </span>
                </div>
            </div>

            <div class="menu-item-settings wp-clearfix" id="menu-item-settings-<?php echo esc_attr( $item_id ); ?>">
                <?php if ( 'custom' == $item->type ) : ?>
                    <p class="field-url description description-wide">
                        <label for="edit-menu-item-url-<?php echo esc_attr( $item_id ); ?>">
                            <?php esc_html_e( 'URL', 'octagon-elements-lite-for-elementor' ); ?><br />
                            <input type="text" id="edit-menu-item-url-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
                        </label>
                    </p>
                <?php endif; ?>
                <p class="description description-wide">
                    <label for="edit-menu-item-title-<?php echo esc_attr( $item_id ); ?>">
                        <?php esc_html_e( 'Navigation Label', 'octagon-elements-lite-for-elementor' ); ?><br />
                        <input type="text" id="edit-menu-item-title-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
                    </label>
                </p>
                <p class="field-title-attribute field-attr-title description description-wide">
                    <label for="edit-menu-item-attr-title-<?php echo esc_attr( $item_id ); ?>">
                        <?php esc_html_e( 'Title Attribute', 'octagon-elements-lite-for-elementor' ); ?><br />
                        <input type="text" id="edit-menu-item-attr-title-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
                    </label>
                </p>
                <p class="field-link-target description">
                    <label for="edit-menu-item-target-<?php echo esc_attr( $item_id ); ?>">
                        <input type="checkbox" id="edit-menu-item-target-<?php echo esc_attr( $item_id ); ?>" value="_blank" name="menu-item-target[<?php echo esc_attr( $item_id ); ?>]"<?php checked( $item->target, '_blank' ); ?> />
                        <?php esc_html_e( 'Open link in a new tab', 'octagon-elements-lite-for-elementor' ); ?>
                    </label>
                </p>
                <p class="field-css-classes description description-thin">
                    <label for="edit-menu-item-classes-<?php echo esc_attr( $item_id ); ?>">
                        <?php esc_html_e( 'CSS Classes (optional)', 'octagon-elements-lite-for-elementor' ); ?><br />
                        <input type="text" id="edit-menu-item-classes-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
                    </label>
                </p>
                <p class="field-xfn description description-thin">
                    <label for="edit-menu-item-xfn-<?php echo esc_attr( $item_id ); ?>">
                        <?php esc_html_e( 'Link Relationship (XFN)', 'octagon-elements-lite-for-elementor' ); ?><br />
                        <input type="text" id="edit-menu-item-xfn-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
                    </label>
                </p>
                <p class="field-description description description-wide">
                    <label for="edit-menu-item-description-<?php echo esc_attr( $item_id ); ?>">
                        <?php esc_html_e( 'Description', 'octagon-elements-lite-for-elementor' ); ?><br />
                        <textarea id="edit-menu-item-description-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo esc_attr( $item_id ); ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
                        <span class="description"><?php esc_html_e('The description will be displayed in the menu if the current theme supports it.', 'octagon-elements-lite-for-elementor' ); ?></span>
                    </label>
                </p>

                <!-- Custom Menu fields -->

                <?php 

                    $item->disable_link   = isset( $item->disable_link ) && ( '' != $item->disable_link ) ? $item->disable_link : false;
                    $item->align          = isset( $item->align ) && ( '' != $item->align ) ? $item->align : 'left';
                    $item->megamenu       = isset( $item->megamenu ) && ( '' != $item->megamenu ) ? $item->megamenu : false;
                    $item->columns        = isset( $item->columns ) && ( '' != $item->columns ) ? $item->columns : '4';
                    $item->background     = isset( $item->background ) && ( '' != $item->background ) ? $item->background : '';
                    $item->hide_title     = isset( $item->hide_title ) && ( '' != $item->hide_title ) ? $item->hide_title : false;
                    $item->act_as_title   = isset( $item->act_as_title ) && ( '' != $item->act_as_title ) ? $item->act_as_title : false;
                    $item->widget_area    = isset( $item->widget_area ) && ( '' != $item->widget_area ) ? $item->widget_area : '0';
                    $item->icon           = isset( $item->icon ) && ( '' != $item->icon ) ? $item->icon : '';
                    $item->batch          = isset( $item->batch ) && ( '' != $item->batch ) ? $item->batch : '';
                    $item->batch_bg_color = isset( $item->batch_bg_color ) && ( '' != $item->batch_bg_color ) ? $item->batch_bg_color : '';
                    $item->batch_color    = isset( $item->batch_color ) && ( '' != $item->batch_color ) ? $item->batch_color : '';

                ?>

                <p class="custom-nav-fields all-depth">
                    <label for="edit-menu-item-disable-link-<?php echo esc_attr( $item_id ); ?>">
                        <input id="edit-menu-item-disable-link-<?php echo esc_attr( $item_id ); ?>" type="checkbox" name="menu-item-disable-link[<?php echo esc_attr( $item_id ); ?>]" value="1" <?php checked( 1, $item->disable_link, true ); ?>>
                        <?php esc_html_e( 'Disable Link', 'octagon-elements-lite-for-elementor' ); ?><br />                        
                    </label>
                </p>

                <p class="custom-nav-fields depth-0">
                    <label for="edit-menu-item-align-<?php echo esc_attr( $item_id ); ?>">
                        <?php esc_html_e( 'Sub Menu Align', 'octagon-elements-lite-for-elementor' ); ?><br />
                        <select id="edit-menu-item-align-<?php echo esc_attr( $item_id ); ?>" name="menu-item-align[<?php echo esc_attr( $item_id ); ?>]">
                            <option value="left" <?php selected( 'left', $item->align, true ); ?>><?php esc_html_e( 'Left', 'octagon-elements-lite-for-elementor' ); ?></option>
                            <option value="right" <?php selected( 'right', $item->align, true ); ?>><?php esc_html_e( 'Right', 'octagon-elements-lite-for-elementor' ); ?></option>
                        </select>          
                    </label>
                </p>
                
                <p class="custom-nav-fields depth-0">
                    <label for="edit-menu-item-megamenu-<?php echo esc_attr( $item_id ); ?>">
                        <input id="edit-menu-item-megamenu-<?php echo esc_attr( $item_id ); ?>" type="checkbox" name="menu-item-megamenu[<?php echo esc_attr( $item_id ); ?>]" value="1" <?php checked( 1, $item->megamenu, true ); ?>>
                        <?php esc_html_e( 'Act as Megamenu', 'octagon-elements-lite-for-elementor' ); ?><br />                        
                    </label>
                </p>

                <p class="custom-nav-fields depth-0">
                    <label for="edit-menu-item-columns-<?php echo esc_attr( $item_id ); ?>">
                        <?php esc_html_e( 'Columns', 'octagon-elements-lite-for-elementor' ); ?><br />
                        <select id="edit-menu-item-columns-<?php echo esc_attr( $item_id ); ?>" name="menu-item-columns[<?php echo esc_attr( $item_id ); ?>]">
                            <option value="2" <?php selected( '2', $item->columns, true ); ?>><?php esc_html_e( '2 Columns', 'octagon-elements-lite-for-elementor' ); ?></option>
                            <option value="3" <?php selected( '3', $item->columns, true ); ?>><?php esc_html_e( '3 Columns', 'octagon-elements-lite-for-elementor' ); ?></option>
                            <option value="4" <?php selected( '4', $item->columns, true ); ?>><?php esc_html_e( '4 Columns', 'octagon-elements-lite-for-elementor' ); ?></option>
                            <option value="5" <?php selected( '5', $item->columns, true ); ?>><?php esc_html_e( '5 Columns', 'octagon-elements-lite-for-elementor' ); ?></option>
                            <option value="6" <?php selected( '6', $item->columns, true ); ?>><?php esc_html_e( '6 Columns', 'octagon-elements-lite-for-elementor' ); ?></option>
                        </select>          
                    </label>
                </p>

                <?php
                    $preview_html = octagon_get_media_preview( $item->background, 'image' );
                ?>

                <div class="custom-nav-fields depth-0">
                    <label for="edit-menu-item-background-<?php echo esc_attr( $item_id ); ?>">
                        <?php esc_html_e( 'Menu Background', 'octagon-elements-lite-for-elementor' ); ?><br />
                    </label>
                    <div class="custom-media-upload image" data-type="image" data-allow-multiple="false">
                        <input type="hidden" name="menu-item-background[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->background ); ?>" class="media-upload-image">
                        <div class="media-lists"><?php echo wp_kses( $preview_html, array( 'div' => array( 'class' => [] ), 'img' => array( 'src' => [] ), 'span' => array( 'class' => [], 'data-id' => [] ) ) ); ?></div>
                        <a href="#" class="custom-media-upload-btn button button-primary button-small"><?php esc_html_e( 'Upload', 'octagon-elements-lite-for-elementor' ); ?></a>
                    </div>
                </div>

                <p class="custom-nav-fields depth-1">
                    <label for="edit-menu-item-hide-title-<?php echo esc_attr( $item_id ); ?>">
                        <input id="edit-menu-item-hide-title-<?php echo esc_attr( $item_id ); ?>" type="checkbox" name="menu-item-hide-title[<?php echo esc_attr( $item_id ); ?>]" value="1" <?php checked( 1, $item->hide_title, true ); ?>>
                        <?php esc_html_e( 'Hide Sub Menu Title', 'octagon-elements-lite-for-elementor' ); ?><br />                        
                    </label>
                </p>

                <p class="custom-nav-fields depth-2">
                    <label for="edit-menu-item-act-as-title-<?php echo esc_attr( $item_id ); ?>">
                        <input id="edit-menu-item-act-as-title-<?php echo esc_attr( $item_id ); ?>" type="checkbox" name="menu-item-act-as-title[<?php echo esc_attr( $item_id ); ?>]" value="1" <?php checked( 1, $item->act_as_title, true ); ?>>
                        <?php esc_html_e( 'Act as Title( Only works on Megamenu )', 'octagon-elements-lite-for-elementor' ); ?><br />                        
                    </label>
                </p>

                <?php global $wp_registered_sidebars; ?>

                <p class="custom-nav-fields depth-2">
                    <label for="edit-menu-item-widget-area-<?php echo esc_attr( $item_id ); ?>">
                        <?php esc_html_e( 'Widget Area', 'octagon-elements-lite-for-elementor' ); ?><br />
                        <select id="edit-menu-item-widget-area-<?php echo esc_attr( $item_id ); ?>" name="menu-item-widget-area[<?php echo esc_attr( $item_id ); ?>]">
                            <?php if( ! empty( $wp_registered_sidebars ) ) : ?>
                                <option value="0"><?php echo esc_html_e( 'Choose Widget Area', 'octagon-elements-lite-for-elementor' ); ?></option>
                                <?php foreach( $wp_registered_sidebars as $key => $sidebar ) : ?>
                                    <option value="<?php echo esc_attr( $sidebar['id'] ); ?>" <?php selected( $sidebar['id'], $item->widget_area, true ); ?>><?php echo esc_html( $sidebar['name'] ); ?></option>
                                <?php endforeach;
                            endif; ?>
                            
                        </select>          
                    </label>
                </p>

                <div class="custom-nav-fields all-depth">
                    <label for="edit-menu-item-icon-<?php echo esc_attr( $item_id ); ?>">
                        <?php esc_html_e( 'Icon', 'octagon-elements-lite-for-elementor' ); ?><br />
                    </label>
                    <div class="field-icon_picker">
                        <div class="icon-picker-field">
                            <span class="js-icon-picker-close-window icon-picker-close dashicons dashicons-no-alt"></span>
                            <span class="current-icon <?php echo esc_attr( $item->icon ); ?>"></span>
                            <input type="text" name="menu-item-icon[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->icon ); ?>" class="textfield icon-picker-textfield">
                            <div class="icons-lists"></div>
                            <a href="#" class="js-icon-picker-btn button button-primary button-medium"><?php esc_html_e( 'Choose Icon', 'octagon-elements-lite-for-elementor' ); ?></a>
                        </div>
                    </div>
                </div>
                
                <p class="custom-nav-fields all-depth">
                    <label for="edit-menu-item-batch-<?php echo esc_attr( $item_id ); ?>">
                        <?php esc_html_e( 'Batch', 'octagon-elements-lite-for-elementor' ); ?><br />  
                        <input id="edit-menu-item-batch-<?php echo esc_attr( $item_id ); ?>" type="text" name="menu-item-batch[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->batch ); ?>">                      
                    </label>
                </p>
                
                <p class="custom-nav-fields depth-0">
                    <label for="edit-menu-item-batch-bg-color-<?php echo esc_attr( $item_id ); ?>">
                        <?php esc_html_e( 'Batch Background Color', 'octagon-elements-lite-for-elementor' ); ?>                     
                    </label><br />
                    <input id="edit-menu-item-batch-bg-color-<?php echo esc_attr( $item_id ); ?>" type="text" name="menu-item-batch-bg-color[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->batch_bg_color ); ?>" data-alpha="false" class="color-field">   
                </p>
                
                <p class="custom-nav-fields all-depth">
                    <label for="edit-menu-item-batch-color-<?php echo esc_attr( $item_id ); ?>">
                        <?php esc_html_e( 'Batch Color', 'octagon-elements-lite-for-elementor' ); ?>                     
                    </label><br />
                    <input id="edit-menu-item-batch-color-<?php echo esc_attr( $item_id ); ?>" type="text" name="menu-item-batch-color[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->batch_color ); ?>" data-alpha="false" class="color-field">   
                </p>

                <!-- Custom Menu fields --> 

                <fieldset class="field-move hide-if-no-js description description-wide">
                    <span class="field-move-visual-label" aria-hidden="true"><?php esc_html_e( 'Move', 'octagon-elements-lite-for-elementor' ); ?></span>
                    <button type="button" class="button-link menus-move menus-move-up" data-dir="up"><?php esc_html_e( 'Up one', 'octagon-elements-lite-for-elementor' ); ?></button>
                    <button type="button" class="button-link menus-move menus-move-down" data-dir="down"><?php esc_html_e( 'Down one', 'octagon-elements-lite-for-elementor' ); ?></button>
                    <button type="button" class="button-link menus-move menus-move-left" data-dir="left"></button>
                    <button type="button" class="button-link menus-move menus-move-right" data-dir="right"></button>
                    <button type="button" class="button-link menus-move menus-move-top" data-dir="top"><?php esc_html_e( 'To the top', 'octagon-elements-lite-for-elementor' ); ?></button>
                </fieldset>

                <div class="menu-item-actions description-wide submitbox">
                    <?php if ( 'custom' != $item->type && $original_title !== false ) : ?>
                        <p class="link-to-original">
                            <?php printf( __( 'Original: %s', 'octagon-elements-lite-for-elementor' ), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
                        </p>
                    <?php endif; ?>
                    <a class="item-delete submitdelete deletion" id="delete-<?php echo esc_attr( $item_id ); ?>" href="<?php
                    echo wp_nonce_url(
                        add_query_arg(
                            array(
                                'action' => 'delete-menu-item',
                                'menu-item' => $item_id,
                            ),
                            admin_url( 'nav-menus.php' )
                        ),
                        'delete-menu_item_' . $item_id
                    ); ?>"><?php esc_html_e( 'Remove', 'octagon-elements-lite-for-elementor' ); ?></a> <span class="meta-sep hide-if-no-js"> | </span> <a class="item-cancel submitcancel hide-if-no-js" id="cancel-<?php echo esc_attr( $item_id ); ?>" href="<?php echo esc_url( add_query_arg( array( 'edit-menu-item' => $item_id, 'cancel' => time() ), admin_url( 'nav-menus.php' ) ) );
                        ?>#menu-item-settings-<?php echo esc_attr( $item_id ); ?>"><?php esc_html_e( 'Cancel', 'octagon-elements-lite-for-elementor' ); ?></a>
                </div>

                <input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item_id ); ?>" />
                <input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
                <input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
                <input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
                <input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
                <input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
            </div><!-- .menu-item-settings-->
            <ul class="menu-item-transport"></ul>
        <?php
        $output .= ob_get_clean();
    }

} // Walker_Nav_Menu_Edit