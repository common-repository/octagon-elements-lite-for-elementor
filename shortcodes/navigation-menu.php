<?php

/**
 * Navigation menu
 *
 * @package octagon-elements-lite-for-elementor/shortcodes
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.0
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;

$settings = $element->get_settings_for_display();

$menu = $settings['menu'] ?? '';

?>

<div <?php echo $element->get_render_attribute_string( 'wrapper' ); ?>>

	<?php
	$defaults = array( 
		'menu'            => $menu,
		'container'       => 'nav',
		'container_class' => 'main-menu clearfix',
		'menu_class'      => 'menu menu-main',
		'depth'           => 4,
		'fallback_cb'     => ''
	);

	if( class_exists( 'Octagon_Walker_Nav_Menu' ) ) {
		$args['walker'] = new Octagon_Walker_Nav_Menu;
	}

	$args = wp_parse_args( $args, $defaults );

	wp_nav_menu( $args );
	?>

</div> <!-- .custom-logo -->