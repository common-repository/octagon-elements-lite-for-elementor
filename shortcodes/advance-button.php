<?php

/**
 * Advance Button
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

	<a <?php echo $element->get_render_attribute_string( 'button' ); ?>>
		<?php $element->render_text(); ?>
	</a>

</div> <!-- .advance-btn -->