<?php
/**
 *
 * @package octagon-elements-lite-for-elementor/core/views
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.3
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;

?>

<div class="status grids two-column">

	<div class="column">

		<div class="grid with-bg">
			<div class="title-area">
				<div class="info">
					<p class="main-title"><?php esc_html_e( 'WordPress environment', 'octagon-elements-lite-for-elementor' ); ?></p>
				</div>
			</div>

			<div class="content-area">
				<ul class="status-list">
					<li><span class="list-title"><?php esc_html_e( 'Home URL:', 'octagon-elements-lite-for-elementor' ); ?></span><?php echo esc_html( $this->data['status']['homeurl'] ); ?></li>
					<li><span class="list-title"><?php esc_html_e( 'Site URL:', 'octagon-elements-lite-for-elementor' ); ?></span><?php echo esc_html( $this->data['status']['siteurl'] ); ?></li>
					<li><span class="list-title"><?php esc_html_e( 'WordPress Version:', 'octagon-elements-lite-for-elementor' ); ?></span><?php echo esc_html( $this->data['status']['wp_version'] ); ?></li>
					<li><span class="list-title"><?php esc_html_e( 'WordPress Multisite:', 'octagon-elements-lite-for-elementor' ); ?></span><?php echo esc_html( $this->data['status']['multisite'] ); ?></li>
					<li><span class="list-title"><?php esc_html_e( 'Debug Mode:', 'octagon-elements-lite-for-elementor' ); ?></span><?php echo esc_html( $this->data['status']['debug'] ); ?></li>
					<li><span class="list-title"><?php esc_html_e( 'Language:', 'octagon-elements-lite-for-elementor' ); ?></span><?php echo esc_html( $this->data['status']['language'] ); ?></li>
					<li><span class="list-title"><?php esc_html_e( 'Text Direction:', 'octagon-elements-lite-for-elementor' ); ?></span><?php echo esc_html( $this->data['status']['text_direction'] ); ?></li>
					<li><span class="list-title"><?php esc_html_e( 'Child Theme:', 'octagon-elements-lite-for-elementor' ); ?></span><?php echo esc_html( $this->data['status']['child_theme'] ); ?></li>
				</ul>
			</div>
		</div>

	</div>
	<div class="column">

		<div class="grid with-bg">
			<div class="title-area">
				<div class="info">
					<p class="main-title"><?php esc_html_e( 'Server environment', 'octagon-elements-lite-for-elementor' ); ?></p>
				</div>
			</div>

			<div class="content-area">
				<ul class="status-list">
					<?php if( isset( $this->data['status']['server'] ) && ! empty( $this->data['status']['server'] ) ) : ?>
						<li><span class="list-title"><?php esc_html_e( 'Server Info:', 'octagon-elements-lite-for-elementor' ); ?></span><?php echo esc_html( $this->data['status']['server'] ); ?></li>
					<?php endif; ?>
					<li><span class="list-title"><?php esc_html_e( 'MySQL version:', 'octagon-elements-lite-for-elementor' ); ?></span><?php echo esc_html( $this->data['status']['mysql'] ); ?></li>
					<li>						
						<?php echo wp_kses( $this->data['notice']['memory_limit']['batch'], array( 'span' => array( 'class' => [] ) ) ); ?>
						<span class="list-title"><?php esc_html_e( 'Memory Limit:', 'octagon-elements-lite-for-elementor' ); ?></span>
						<?php echo esc_html( size_format( $this->data['status']['memory_limit'] ) ); ?>						
						<?php echo wp_kses( $this->data['notice']['memory_limit']['info'], array( 'span' => array( 'class' => [] ), 'strong' => [] ) ); ?>
					</li>
					<li>						
						<?php echo wp_kses( $this->data['notice']['php_version']['batch'], array( 'span' => array( 'class' => [] ) ) ); ?>
						<span class="list-title"><?php esc_html_e( 'PHP Version:', 'octagon-elements-lite-for-elementor' ); ?></span>
						<?php echo esc_html( $this->data['status']['php_version'] ); ?>
						<?php echo wp_kses( $this->data['notice']['php_version']['info'], array( 'span' => array( 'class' => [] ), 'strong' => [] ) ); ?>
					</li>
					<li>
						<?php echo wp_kses( $this->data['notice']['post_max_size']['batch'], array( 'span' => array( 'class' => [] ) ) ); ?>
						<span class="list-title"><?php esc_html_e( 'Post Max Size:', 'octagon-elements-lite-for-elementor' ); ?></span>
						<?php echo esc_html( size_format( $this->data['status']['post_max_size'] ) ); ?>
						<?php echo wp_kses( $this->data['notice']['post_max_size']['info'], array( 'span' => array( 'class' => [] ), 'strong' => [] ) ); ?>
					</li>
					<li>
						<?php echo wp_kses( $this->data['notice']['time_limit']['batch'], array( 'span' => array( 'class' => [] ) ) ); ?>
						<span class="list-title"><?php esc_html_e( 'Time Limit:', 'octagon-elements-lite-for-elementor' ); ?></span>
						<?php echo esc_html( $this->data['status']['time_limit'] ); ?>
						<?php echo wp_kses( $this->data['notice']['time_limit']['info'], array( 'span' => array( 'class' => [] ), 'strong' => [] ) ); ?>
					</li>
					<li>
						<?php echo wp_kses( $this->data['notice']['max_input_vars']['batch'], array( 'span' => array( 'class' => [] ) ) ); ?>
						<span class="list-title"><?php esc_html_e( 'Max Input Vars:', 'octagon-elements-lite-for-elementor' ); ?></span>
						<?php echo esc_html( $this->data['status']['max_input_vars'] ); ?>						
						<?php echo wp_kses( $this->data['notice']['max_input_vars']['info'], array( 'span' => array( 'class' => [] ), 'strong' => [] ) ); ?>
					</li>
					<li><span class="list-title"><?php esc_html_e( 'Max Upload Size:', 'octagon-elements-lite-for-elementor' ); ?></span><?php echo esc_html( $this->data['status']['upload_size'] ); ?></li>
					<li><span class="list-title"><?php esc_html_e( 'cURL:', 'octagon-elements-lite-for-elementor' ); ?></span><?php echo esc_html( $this->data['status']['curl'] ); ?></li>
					<li><span class="list-title"><?php esc_html_e( 'DOMDocument:', 'octagon-elements-lite-for-elementor' ); ?></span><?php echo esc_html( $this->data['status']['dom'] ); ?></li>
				</ul>
			</div>				
		</div>

	</div>
	
</div> <!-- .status -->

<div class="override-files grids one-column">

	<div class="column">

		<div class="grid with-bg">
			<div class="title-area">
				<div class="info">
					<p class="main-title"><?php esc_html_e( 'Shortcode Overrides', 'octagon-elements-lite-for-elementor' ); ?></p>
					<p class="sub"><?php esc_html_e( 'What are the elements are overrides?', 'octagon-elements-lite-for-elementor' ); ?></p>
				</div>
				<div class="mini-link">
					<a href="https://docs.octagonwebstudio.com/elementor-elements/" class="simple-link"><?php esc_html_e( 'Learn More', 'octagon-elements-lite-for-elementor' ); ?></a>
				</div>
			</div>

			<div class="content-area">
				<ul class="override-list">
					<?php
					if( is_array( $this->data['override'] ) && isset( $this->data['override'] ) ) :
						foreach( $this->data['override'] as $key => $override ) :

							if ( $override['core_version'] && ( empty( $override['version'] ) || version_compare( $override['version'], $override['core_version'], '<' ) ) ) {
								$current_version = $override['version'] ? $override['version'] : '-';
								echo sprintf(
									/* Translators: %1$s: Template name, %2$s: Template version, %3$s: Core version. */
									__( '<li>%1$s version %2$s is out of date. The core version is %3$s</li>', 'woocommerce' ),
									'<code>' . esc_html( $override['file'] ) . '</code>',
									'<span class="strong-red">' . esc_html( $current_version ) . '</span>',
									esc_html( $override['core_version'] )
								);
							}
							else {
								echo sprintf( '<li>%s</li>', esc_html( $override['file'] ) );
							}
						endforeach;
					else :
						?>
						<li><?php esc_html_e( 'You are not override any of the shortcodes.', 'octagon-elements-lite-for-elementor' ); ?></li>
						<?php
					endif;
					?>
				</ul>
			</div>
			
		</div>

	</div>
	
</div> <!-- .override-files -->
