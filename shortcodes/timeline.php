<?php

/**
 * Timeline
 *
 * @package octagon-elements-lite-for-elementor/shortcodes
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.0
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;

$settings = $element->get_settings_for_display();

$timeline = $settings['timeline'] ?? [];
?>

<div <?php echo $element->get_render_attribute_string( 'wrapper' ); ?>>
	
	<?php
	if( ! empty( $timeline ) ) : ?>
		
		<span class="vertical-line"></span>

		<div class="timeline-set-group">
			<?php $element->render_timeline(); ?>
		</div> <!-- .timeline-set-group -->
		<?php
	endif;
	?>

</div> <!-- .timeline -->