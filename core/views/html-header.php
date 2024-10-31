<?php
/**
 *
 * @package octagon-elements-lite-for-elementor/core/views
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.2
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;

?>

<header>
	<div class="brand">
		<div class="logo">
			<div>
				<img src="<?php echo esc_url( OEE_URL . 'assets/image/logo-dark.png' ); ?>">
				<span class="version"><?php echo sprintf( esc_html__( 'V %s', 'octagon-elements-lite-for-elementor' ), OEE_VERSION ); ?></span>
			</div>
		</div>
		<div class="btn-group">
			<a href="https://docs.octagonwebstudio.com/elementor-elements/" class="bttn bttn-border bttn-medium"><?php esc_html_e( 'Documentation', 'octagon-elements-lite-for-elementor' ); ?></a>
			<a href="mailto:octagonwebstudio@gmail.com" class="bttn bttn-gradient bttn-medium"><?php esc_html_e( 'Support Questions', 'octagon-elements-lite-for-elementor' ); ?></a>
		</div>		
	</div>
	<p class="desc"><?php esc_html_e( 'Octagon Elements for Elementor is a unique shortcode elements addon for Elementor Page Builder. For any assistance, Please contact us via our support forum.', 'octagon-elements-lite-for-elementor' ); ?></p>
</header>
