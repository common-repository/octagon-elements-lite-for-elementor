<?php
/**
 *
 * @package octagon-elements-lite-for-elementor/core
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.0
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;	


add_action( 'wp_footer', 'octagon_wp_footer', 10, 1 );

if( ! function_exists( 'octagon_wp_footer' ) ) {
	function octagon_wp_footer() {
		?>
		<div id="dialog-popup">
			<div class="overlay-box"></div>
			<div id="dialog-content"></div>
		</div>
		<?php
	}
}
