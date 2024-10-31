<?php

/**
 * Gradient Text
 *
 * @package octagon-elements-lite-for-elementor/shortcodes
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.0
 * @since 1.0
 */
defined( 'ABSPATH' ) || exit;

$settings = $element->get_settings_for_display();

$title_tag = $settings['title_tag'] ?? 'p';
$title     = $settings['title'] ?? esc_html__( 'Default Title', 'octagon-elements-lite-for-elementor' );

?>

<div <?php echo $element->get_render_attribute_string( 'wrapper' ); ?>>
	<?php if( $title ) : ?>
		<<?php echo octagon_title_tag( $title_tag ); ?> <?php echo $element->get_render_attribute_string( 'text' ); ?>>
			<span <?php echo $element->get_render_attribute_string( 'title' ); ?>><?php echo esc_html( $title ) ?></span>
		</<?php echo octagon_title_tag( $title_tag ); ?>">
	<?php endif; ?>
</div> <!-- .gradient-text -->