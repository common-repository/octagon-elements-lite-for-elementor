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

	$modules_group = OEE_Init_Elements::modules_list();
	$modules_list = array_keys( call_user_func_array( 'array_merge', $modules_group ) );

	if( isset( $_POST['save_modules'] ) ) :

		$nonce = isset( $_POST['nonce'] ) ? sanitize_text_field( $_POST['nonce'] ) : [];

		if( wp_verify_nonce( $nonce, 'nonce-octagon-modules' ) ) {

			$modules = isset( $_POST['modules'] ) && ( octagon_in_array_all( $_POST['modules'], $modules_list ) ) ? array_map( 'sanitize_text_field', $_POST['modules'] ) : [];

			update_option( 'oee_modules', $modules );
		}

	endif;
	?>
	
	<div class="modules">

		<div class="title-area">
			<div class="info">
				<p class="main-title"><?php esc_html_e( 'Modules', 'octagon-elements-lite-for-elementor' ); ?></p>
				<p class="sub"><?php esc_html_e( 'Select the shortcode elements.', 'octagon-elements-lite-for-elementor' ); ?></p>
			</div>
		</div>
		
		<form method="post">		
					
			<?php
			$active_modules = OEE_Init_Elements::active_modules_list();

			$pro_modules = [
				'image-box',
				'image-mask',
				'login-register-form',
				'portfolio',
				'portfolio-slider',
				'portfolio-extend-slider',
				'team',
				'products',
				'products-slider',
				'compare-products',
				'wishlist',
				'ajax-product-search'
			];

			foreach( $modules_group as $key => $modules ) :
				?>
				<div class="grids one-column">
					<div class="column">
						<div class="grid">
							<h3><?php echo esc_html( $key ); ?></h3>
							<?php

							foreach( $modules as $key => $module ) :

								if( in_array( $key, $active_modules ) ) :
									$active = 'active';
									$in_active = 'in-active';
									$checked = 'checked="checked"';
								else :
									$active = 'in-active';
									$in_active = 'active';
									$checked = '';
								endif;

								$disable = in_array( $key, $pro_modules ) ? 'disable pro-module' : '';
								?>
								<div class="toggle-switch <?php echo esc_attr( $disable ); ?>">
									<p><?php echo esc_html( $module ); ?></p>

									<div class="toggle">
										<input type="checkbox" name="modules[]" value="<?php echo esc_attr( $key ); ?>" <?php echo esc_attr( $checked ); ?>>

										<span data-value="<?php echo esc_attr( $key ); ?>" class="<?php echo esc_attr( $active ); ?>"><?php esc_html_e( 'Yes', 'octagon-elements-lite-for-elementor' ); ?></span>
										<span data-value="" class="<?php echo esc_attr( $in_active ); ?>"><?php esc_html_e( 'No', 'octagon-elements-lite-for-elementor' ); ?></span>

									</div>
								</div>
								<?php
							endforeach;
							?>
					
						</div>

					</div>
				</div>
				<?php
			endforeach;

			$nonce = wp_create_nonce( 'nonce-octagon-modules' );
			?>

			<input type="hidden" name="nonce" value="<?php echo esc_attr( $nonce ); ?>">
			<button name="save_modules" class="bttn bttn-gradient bttn-medium"><?php esc_html_e( 'Save', 'octagon-elements-lite-for-elementor' ); ?></button>
		</form>
		
	</div> <!-- .modules -->

</div> <!-- .octagon-admin-page -->