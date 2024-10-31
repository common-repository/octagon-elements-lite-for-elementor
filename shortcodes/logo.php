<?php

/**
 * Logo
 *
 * @package octagon-elements-lite-for-elementor/shortcodes
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.0
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;

$settings = $element->get_settings_for_display();

?>

<div <?php echo $element->get_render_attribute_string( 'wrapper' ); ?>>

	<?php
	$logo_id = get_theme_mod( 'custom_logo', false );
	$logo_src = wp_get_attachment_image_src( $logo_id, 'thumbnail', false );
	?>

	<img src="<?php echo esc_url( $logo_src[0] ); ?>">

</div> <!-- .custom-logo -->