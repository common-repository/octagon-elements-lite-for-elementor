<?php
/**
 *
 * @package octagon-elements-lite-for-elementor/views
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.0
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;

?>

<div class="octagon-admin-page">

	<?php

	if( defined( 'OCTAGON_CORE_PATH' ) ) {
		include_once OCTAGON_CORE_PATH . '/views/html-header.php';
	}

	if( isset( $_POST['save_settings'] ) ) :

		$nonce = isset( $_POST['nonce'] ) ? sanitize_text_field( $_POST['nonce'] ) : [];

		if( wp_verify_nonce( $nonce, 'nonce-octagon-settings' ) ) {

			$primary_color = isset( $_POST['oee_primary_color'] ) ? sanitize_hex_color( $_POST['oee_primary_color'] ) : '';
			$gradient_palette = isset( $_POST['oee_gradient_palette'] ) ? sanitize_text_field( $_POST['oee_gradient_palette'] ) : '';

			update_option( 'oee_primary_color', $primary_color );
			update_option( 'oee_gradient_palette', $gradient_palette );
		}

		/*
		 * It reset the dynamic CSS 'octagon-elements' cache, and it regenerate the dynamic CSS file.
		 */
		update_option( 'octagon-elements-has-cached', false );

	endif;
	?>
	
	<div class="settings">

		<div class="title-area">
			<div class="info">
				<p class="main-title"><?php esc_html_e( 'Settings', 'octagon-elements-lite-for-elementor' ); ?></p>
				<p class="sub"><?php esc_html_e( 'Those settings applies globally.', 'octagon-elements-lite-for-elementor' ); ?></p>
			</div>
		</div>
		
		<form method="post">

			<?php

			$primary_color    = get_option( 'oee_primary_color', false );
			$gradient_palette = get_option( 'oee_gradient_palette', false );
			?>	
					
			<div class="grids one-column">
				<div class="column">
					<div class="grid">
						
						<h3><?php esc_html_e( 'General', 'octagon-elements-lite-for-elementor' ); ?></h3>						
						
						<div class="field">
							<div class="left-side">
								<h3 class="field-title"><?php esc_html_e( 'Primay Color', 'octagon-elements-lite-for-elementor' ); ?></h3>
								<p class="field-description"><?php esc_html_e( 'If it\'s chosen, it applies on elements where it\'s selected color as primary color.', 'octagon-elements-lite-for-elementor' ); ?></p>
							</div>
							<div class="right-side">
								<input type="text" name="oee_primary_color" value="<?php echo esc_attr( $primary_color ); ?>" data-alpha="false" class="color-field">
							</div>
						</div>

						<div class="field">
							<div class="left-side">
								<h3 class="field-title"><?php esc_html_e( 'Gradient Palette', 'octagon-elements-lite-for-elementor' ); ?></h3>
								<p class="field-description"><?php esc_html_e( 'If it\'s chosen, it applies on elements where it\'s selected color as gradient palette.', 'octagon-elements-lite-for-elementor' ); ?></p>
							</div>
							<div class="right-side">
								<?php
								$palette = [
									'none'             => esc_html__( 'None', 'octagon-elements-lite-for-elementor' ),
									'orange-pulp'      => esc_html__( 'Orange Pulp', 'octagon-elements-lite-for-elementor' ),
									'warm-flame'       => esc_html__( 'Warm Flame', 'octagon-elements-lite-for-elementor' ),
									'night-fade'       => esc_html__( 'Night Fade', 'octagon-elements-lite-for-elementor' ),
									'sunny-morning'    => esc_html__( 'Sunny Morning', 'octagon-elements-lite-for-elementor' ),
									'tempting-azure'   => esc_html__( 'Tempting Azure', 'octagon-elements-lite-for-elementor' ),
									'young-passion'    => esc_html__( 'Young Passion', 'octagon-elements-lite-for-elementor' ),
									'deep-blue'        => esc_html__( 'Deep Blue', 'octagon-elements-lite-for-elementor' ),
									'malibu-beach'     => esc_html__( 'Malibu Beach', 'octagon-elements-lite-for-elementor' ),
									'plum-plate'       => esc_html__( 'Plum Plate', 'octagon-elements-lite-for-elementor' ),
									'evarlasting-sky'  => esc_html__( 'Evarlasting Sky', 'octagon-elements-lite-for-elementor' ),
									'aqua-splash'      => esc_html__( 'Aqua Splash', 'octagon-elements-lite-for-elementor' ),
									'desert-hump'      => esc_html__( 'Desert Hump', 'octagon-elements-lite-for-elementor' ),
									'night-sky'        => esc_html__( 'Night Sky', 'octagon-elements-lite-for-elementor' ),
									'passionate-red'   => esc_html__( 'Passionate Red', 'octagon-elements-lite-for-elementor' ),
									'heavy-rain'       => esc_html__( 'Heavy Rain', 'octagon-elements-lite-for-elementor' ),
									'healthy-water'    => esc_html__( 'Healthy Water', 'octagon-elements-lite-for-elementor' ),
									'lily-meadow'      => esc_html__( 'Lily Meadow', 'octagon-elements-lite-for-elementor' ),
									'happy-memories'   => esc_html__( 'Happy Memories', 'octagon-elements-lite-for-elementor' ),
									'mountain-rock'    => esc_html__( 'Mountain Rock', 'octagon-elements-lite-for-elementor' ),
									'sea-shore'        => esc_html__( 'Sea Shore', 'octagon-elements-lite-for-elementor' ),
									'cheerful-caramel' => esc_html__( 'Cheerful Caramel', 'octagon-elements-lite-for-elementor' ),
									'spiky-naga'       => esc_html__( 'Spiky Naga', 'octagon-elements-lite-for-elementor' ),
									'love-kiss'        => esc_html__( 'Love Kiss', 'octagon-elements-lite-for-elementor' ),
									'lush'             => esc_html__( 'Lush', 'octagon-elements-lite-for-elementor' ),
									'landing-aircraft' => esc_html__( 'Landing Aircraft', 'octagon-elements-lite-for-elementor' ),
									'sand-strike'      => esc_html__( 'Sand Strike', 'octagon-elements-lite-for-elementor' ),
									'vicious-stance'   => esc_html__( 'Vicious Stance', 'octagon-elements-lite-for-elementor' ),
									'smart-indigo'     => esc_html__( 'Smart Indigo', 'octagon-elements-lite-for-elementor' ),
									'big-mango'        => esc_html__( 'Big Mango', 'octagon-elements-lite-for-elementor' ),
									'new-life'         => esc_html__( 'New Life', 'octagon-elements-lite-for-elementor' )
								];
								?>
								<select name="oee_gradient_palette">
									<?php foreach( $palette as $code => $name ) : ?>
										<option value="<?php echo esc_attr( $code ); ?>" <?php echo selected( $gradient_palette, $code, true ); ?>><?php echo esc_html( $name ); ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>

					</div>

				</div>
			</div>

			<?php $nonce = wp_create_nonce( 'nonce-octagon-settings' ); ?>

			<input type="hidden" name="nonce" value="<?php echo esc_attr( $nonce ); ?>">
			<button name="save_settings" class="bttn bttn-gradient bttn-medium"><?php esc_html_e( 'Save', 'octagon-elements-lite-for-elementor' ); ?></button>
		</form>
		
	</div> <!-- .settings -->

</div> <!-- .octagon-admin-page -->