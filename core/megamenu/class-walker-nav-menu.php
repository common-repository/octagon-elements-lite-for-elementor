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
 * Core class used to implement an HTML list of nav menu items.
 *
 * @since 3.0.0
 *
 * @see Walker
 */
class Octagon_Walker_Nav_Menu extends Walker_Nav_Menu {
    /**
     * What the class handles.
     *
     * @since 3.0.0
     * @var string
     *
     * @see Walker::$tree_type
     */
    public $tree_type = array( 'post_type', 'taxonomy', 'custom' );

    /**
     * Database fields to use.
     *
     * @since 3.0.0
     * @todo Decouple this.
     * @var array
     *
     * @see Walker::$db_fields
     */
    public $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );

    /**
     * Starts the list before the elements are added.
     *
     * @since 3.0.0
     *
     * @see Walker::start_lvl()
     *
     * @param string   $output Used to append additional content (passed by reference).
     * @param int      $depth  Depth of menu item. Used for padding.
     * @param stdClass $args   An object of wp_nav_menu() arguments.
     */
    public function start_lvl( &$output, $depth = 0, $args = [] ) {
        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = str_repeat( $t, $depth );

        // Default class.
        $classes = array( 'sub-menu' );

        /**
         * Filters the CSS class(es) applied to a menu list element.
         *
         * @since 4.8.0
         *
         * @param array    $classes The CSS classes that are applied to the menu `<ul>` element.
         * @param stdClass $args    An object of `wp_nav_menu()` arguments.
         * @param int      $depth   Depth of menu item. Used for padding.
         */
        $class_names = join( ' ', apply_filters( 'nav_menu_submenu_css_class', $classes, $args, $depth ) );
        $attr[] = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        $attr = implode( ' ', $attr );

        $output .= "{$n}{$indent}<ul$attr>{$n}";
    }

    /**
     * Ends the list of after the elements are added.
     *
     * @since 3.0.0
     *
     * @see Walker::end_lvl()
     *
     * @param string   $output Used to append additional content (passed by reference).
     * @param int      $depth  Depth of menu item. Used for padding.
     * @param stdClass $args   An object of wp_nav_menu() arguments.
     */
    public function end_lvl( &$output, $depth = 0, $args = [] ) {
        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = str_repeat( $t, $depth );
        $output .= "$indent</ul>{$n}";
    }

    /**
     * Starts the element output.
     *
     * @since 3.0.0
     * @since 4.4.0 The {@see 'nav_menu_item_args'} filter was added.
     *
     * @see Walker::start_el()
     *
     * @param string   $output Used to append additional content (passed by reference).
     * @param WP_Post  $item   Menu item data object.
     * @param int      $depth  Depth of menu item. Used for padding.
     * @param stdClass $args   An object of wp_nav_menu() arguments.
     * @param int      $id     Current item ID.
     */
    public function start_el( &$output, $item, $depth = 0, $args = [], $id = 0 ) {
        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

        $this->disable_link   = isset( $item->disable_link ) && ( '' != $item->disable_link ) ? $item->disable_link : false;
        $this->align          = isset( $item->align ) && ( '' != $item->align ) ? $item->align : 'left';
        $this->megamenu       = isset( $item->megamenu ) && ( '' != $item->megamenu ) ? $item->megamenu : false;
        $this->columns        = isset( $item->columns ) && ( '' != $item->columns ) ? $item->columns : '4';
        $this->background     = isset( $item->background ) && ( '' != $item->background ) ? $item->background : '';
        $this->hide_title     = isset( $item->hide_title ) && ( '' != $item->hide_title ) ? $item->hide_title : false;
        $this->act_as_title     = isset( $item->act_as_title ) && ( '' != $item->act_as_title ) ? $item->act_as_title : false;
        $this->widget_area    = isset( $item->widget_area ) && ( '' != $item->widget_area ) ? $item->widget_area : '0';
        $this->icon           = isset( $item->icon ) && ( '' != $item->icon ) ? $item->icon : '';
        $this->batch          = isset( $item->batch ) && ( '' != $item->batch ) ? $item->batch : '';
        $this->batch_bg_color = isset( $item->batch_bg_color ) && ( '' != $item->batch_bg_color ) ? $item->batch_bg_color : '';
        $this->batch_color    = isset( $item->batch_color ) && ( '' != $item->batch_color ) ? $item->batch_color : '';

        $classes   = empty( $item->classes ) ? [] : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        $classes[] = ( 0 == $depth && $this->megamenu && $this->columns ) ? 'megamenu megamenu-'. $this->columns .'-column' : '';
        $classes[] = ( 0 == $depth && ! $this->megamenu  ) ? 'no-megamenu' : '';
        $classes[] = ( isset( $args->walker ) && $args->walker->has_children && ( ! $this->megamenu || ( $this->megamenu && ( '2' == $this->columns || '3' == $this->columns ) ) ) ) ? 'sub-menu-holder sub-menu-'. $this->align : '';
        $classes[] = ( isset( $args->walker ) && $args->walker->has_children && ! $this->megamenu && $this->hide_title ) ? 'hide-sub-menu-title' : '';
        $classes[] = ( 2 == $depth ) && ( isset( $args->walker ) && ! $this->megamenu && $this->act_as_title ) ? 'act-as-title' : '';
        
        $classes   = array_filter( $classes );

        /**
         * Filters the arguments for a single nav menu item.
         *
         * @since 4.4.0
         *
         * @param stdClass $args  An object of wp_nav_menu() arguments.
         * @param WP_Post  $item  Menu item data object.
         * @param int      $depth Depth of menu item. Used for padding.
         */
        $args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

        /**
         * Filters the CSS class(es) applied to a menu item's list item element.
         *
         * @since 3.0.0
         * @since 4.1.0 The `$depth` parameter was added.
         *
         * @param array    $classes The CSS classes that are applied to the menu item's `<li>` element.
         * @param WP_Post  $item    The current menu item.
         * @param stdClass $args    An object of wp_nav_menu() arguments.
         * @param int      $depth   Depth of menu item. Used for padding.
         */
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        /**
         * Filters the ID applied to a menu item's list item element.
         *
         * @since 3.0.1
         * @since 4.1.0 The `$depth` parameter was added.
         *
         * @param string   $menu_id The ID that is applied to the menu item's `<li>` element.
         * @param WP_Post  $item    The current menu item.
         * @param stdClass $args    An object of wp_nav_menu() arguments.
         * @param int      $depth   Depth of menu item. Used for padding.
         */
        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= $indent . '<li' . $id . $class_names .'>';

        $atts = [];

        $parse_url = parse_url( $item->url );
        $fragment = isset( $parse_url['fragment'] ) ? $parse_url['fragment'] : '';

        $atts['class'][]  = 'menu-link';
        $atts['class'][]  = ! empty( $fragment ) ? 'hash-url' : '';

        $atts['class']  = implode( ' ', $atts['class'] );
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';

        if( ! $this->disable_link ) {
            $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
            $atts['href']   = ! empty( $item->url )        ? $item->url        : '';
        }
        

        /**
         * Filters the HTML attributes applied to a menu item's anchor element.
         *
         * @since 3.6.0
         * @since 4.1.0 The `$depth` parameter was added.
         *
         * @param array $atts {
         *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
         *
         *     @type string $title  Title attribute.
         *     @type string $target Target attribute.
         *     @type string $rel    The rel attribute.
         *     @type string $href   The href attribute.
         * }
         * @param WP_Post  $item  The current menu item.
         * @param stdClass $args  An object of wp_nav_menu() arguments.
         * @param int      $depth Depth of menu item. Used for padding.
         */
        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        /** This filter is documented in wp-includes/post-template.php */
        $title = apply_filters( 'the_title', $item->title, $item->ID );

        /**
         * Filters a menu item's title.
         *
         * @since 4.4.0
         *
         * @param string   $title The menu item's title.
         * @param WP_Post  $item  The current menu item.
         * @param stdClass $args  An object of wp_nav_menu() arguments.
         * @param int      $depth Depth of menu item. Used for padding.
         */
        $title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

        $item_output = isset( $args->before ) ? $args->before : '';
        $item_output .= ( ! $this->disable_link ) ? '<a'. $attributes .'>' : '<span'. $attributes .'>';        
        $item_output .= isset( $this->icon ) && ! empty( isset( $this->icon ) ) ? '<span class="'. esc_attr( $this->icon ) .'"></span>' : '';
        $item_output .= isset( $args->link_before ) ? $args->link_before : '';
        $item_output .= $title;
        $item_output .= ! empty( $this->batch ) ? '<span class="batch">'. esc_html( $this->batch ) .'</span>' : '';
        $item_output .= isset( $args->link_after ) ? $args->link_after : '';
        $item_output .= ( ! $this->disable_link ) ? '</a>' : '</span>';
        $item_output .= isset( $args->after ) ? $args->after : '';

        if( isset( $args->walker ) && $args->walker->has_children ) {
            $item_output .= sprintf( '<span class="sub-menu-trigger %s"></span>', apply_filters( 'octagon_submenu_trigger_icon_class', '' ) );
        }

        if( ( 2 == $depth && '' != $this->widget_area && '0' != $this->widget_area ) ) {
            ob_start();
            dynamic_sidebar( $this->widget_area );
            $item_output = ob_get_contents();
            ob_end_clean();
        }
        

        /**
         * Filters a menu item's starting output.
         *
         * The menu item's starting output only includes `$args->before`, the opening `<a>`,
         * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
         * no filter for modifying the opening and closing `<li>` for a menu item.
         *
         * @since 3.0.0
         *
         * @param string   $item_output The menu item's starting HTML output.
         * @param WP_Post  $item        Menu item data object.
         * @param int      $depth       Depth of menu item. Used for padding.
         * @param stdClass $args        An object of wp_nav_menu() arguments.
         */
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

        // Placeholder style.
        wp_register_style( 'octagon-core-megamenu', false );
        wp_enqueue_style( 'octagon-core-megamenu' );
        
        $css = '';

        if( '' != $this->background ) {

            $image_url = wp_get_attachment_url( $this->background );

            $css .= '.main-menu .menu-item-' . esc_html( $item->ID ) .' > .sub-menu {
                background: url('. esc_url( $image_url ) .') no-repeat right top;
            }';
            
        }

        if( '' != $this->batch_bg_color || '' != $this->batch_color ) {

            $css .= '.main-menu .menu-item-' . esc_html( $item->ID ) .' > a .batch {';
                $css .= ( '' != $this->batch_bg_color ) ? 'background: '. esc_html( $this->batch_bg_color ) .';' : '';
                $css .= ( '' != $this->batch_color ) ? 'color: '. esc_html( $this->batch_color ) .';' : '';
            $css .= '}';

            $css .= '.main-menu ul .sub-menu .menu-item-' . esc_html( $item->ID ) .' > a .batch {';
                $css .= ( '' != $this->batch_color ) ? 'color: '. esc_html( $this->batch_color ) .';' : '';
            $css .= '}';
            
        }

        wp_add_inline_style( 'octagon-core-megamenu', octagon_minify( $css ) );

    }

    /**
     * Ends the element output, if needed.
     *
     * @since 3.0.0
     *
     * @see Walker::end_el()
     *
     * @param string   $output Used to append additional content (passed by reference).
     * @param WP_Post  $item   Page data object. Not used.
     * @param int      $depth  Depth of page. Not Used.
     * @param stdClass $args   An object of wp_nav_menu() arguments.
     */
    public function end_el( &$output, $item, $depth = 0, $args = [] ) {
        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }

        $output .= "</li>{$n}";
    }

} // Walker_Nav_Menu
