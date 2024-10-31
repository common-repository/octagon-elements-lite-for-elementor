<?php

/**
 * Icon Box
 *
 * @package octagon-elements-lite-for-elementor/shortcodes
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.0
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;

$settings = $element->get_settings_for_display();

$style     = $settings['style'] ?? 'separate';
$title_tag = $settings['title_tag'] ?? 'h3';
$title     = $settings['title'] ?? '';
$desc      = $settings['desc'] ?? '';

if( 'separate' == $style ) :
	?>

	<div <?php echo $element->get_render_attribute_string( 'wrapper' ); ?>>
	
		<?php $element->render_icon(); ?>

		<div class="content">
			<?php
			if( ! empty( $title ) ) :
				?>
				<<?php echo octagon_title_tag( $title_tag ); ?> <?php echo $element->get_render_attribute_string( 'title' ); ?>><?php echo esc_html( $title ); ?></<?php echo octagon_title_tag( $title_tag ); ?>>
				<?php 
			endif;

			if( ! empty( $desc ) ) :
				?>
				<p <?php echo $element->get_render_attribute_string( 'desc' ); ?>><?php echo esc_html( $desc ); ?></p>
				<?php 
			endif; 
			?>
		</div> <!-- .content -->
		
		<?php $element->render_btn(); ?>

	</div> <!-- .icon-box -->
	<?php
elseif( 'collapse' == $style ) :
	?>
	<div <?php echo $element->get_render_attribute_string( 'wrapper' ); ?>>
	
		<?php $element->render_icon(); ?>

		<div class="content">
			<?php
			if( ! empty( $title ) ) :
				?>
				<<?php echo octagon_title_tag( $title_tag ); ?> <?php echo $element->get_render_attribute_string( 'title' ); ?>><?php echo esc_html( $title ); ?></<?php echo octagon_title_tag( $title_tag ); ?>>
				<?php 
			endif;

			if( ! empty( $desc ) ) :
				?>
				<p <?php echo $element->get_render_attribute_string( 'desc' ); ?>><?php echo esc_html( $desc ); ?></p>
				<?php 
			endif;

			$element->render_btn();
			?>
		</div> <!-- .content -->

	</div> <!-- .icon-box -->
	<?php
endif;