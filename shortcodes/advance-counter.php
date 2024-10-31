<?php

/**
 * Advance Counter
 *
 * @package octagon-elements-lite-for-elementor/shortcodes
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.0
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;

$settings = $element->get_settings_for_display();

$number = $settings['number'] ?? '100';
$label  = $settings['label'] ?? '';
$prefix = $settings['prefix'] ?? '';
$suffix = $settings['suffix'] ?? '';

$prefix = ! empty( $prefix ) ? sprintf( '<span %s>%s</span>', $element->get_render_attribute_string( 'prefix' ), $prefix ) : '';
$suffix = ! empty( $suffix ) ? sprintf( '<span %s>%s</span>', $element->get_render_attribute_string( 'suffix' ), $suffix ) : '';

$number = ! empty( $number ) ? sprintf( '<span %s>%s</span>', $element->get_render_attribute_string( 'number' ), esc_html( $number ) ) : '';
?>

<div <?php echo $element->get_render_attribute_string( 'wrapper' ); ?>>
	
	<div class="counter-wrap">

		<?php $element->render_icon(); ?>

		<div class="counter-content">
			<div class="counter">
				<?php echo wp_kses( sprintf( '%s %s %s', $prefix, $number, $suffix ), array( 'span' => array( 'class' => [], 'data-decimals' => [], 'data-decimal-delimiter' => [], 'data-thousand-delimiter' => [], 'data-elementor-setting-key' => [], 'data-elementor-inline-editing-toolbar' => [] ) ) ); ?>
			</div>
			<div <?php echo $element->get_render_attribute_string( 'label' ); ?>><?php echo esc_html( $label ); ?></div>
		</div> <!-- .counter-content -->

	</div> <!-- .counter-wrap -->

</div> <!-- .advance-counter -->