<?php
/**
 *
 * @package octagon-elements-lite-for-elementor/core/views
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.3
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;

$icon_set = Octagon_Core_Icon_Manager::get_icon_set();
?>

<div class="octagon-admin-page">

	<?php
	include_once OCTAGON_CORE_PATH . '/views/html-header.php';
	?>

	<div class="icon-manager"> 
		
		<form method="post" class="icon-manager-form">

			<div class="grids one-column"> 

				<div class="column">
					<div class="grid">

						<div class="title-area">
							<div class="info">
								<p class="main-title"><?php esc_html_e( 'Available Icons', 'octagon-elements-lite-for-elementor' ); ?></p>
								<p class="sub"><?php esc_html_e( 'Pick the icon set which are going to use on website.', 'octagon-elements-lite-for-elementor' ); ?></p>
							</div>
						</div>

						<div class="content-area">
								
							<div class="options-group">

								<?php 
								if( isset( $_POST['save_icon_set'] ) ) :

									$nonce = isset( $_POST['nonce'] ) ? $_POST['nonce'] : [];

									if( wp_verify_nonce( $nonce, 'nonce-octagon-icon-set' ) ) {

										$value = isset( $_POST['icon_set'] ) ? array_map( 'sanitize_text_field', wp_unslash( $_POST['icon_set'] ) ) : [];

										update_option( 'octagon_icon_set', $value );

									}
									
								endif;

								$active_icon_set = get_option( 'octagon_icon_set', [] );

								if( isset( $icon_set ) && ! empty( $icon_set ) ) : 
									foreach( $icon_set as $key => $icons ) :

										if( in_array( $key, $active_icon_set ) ) :
											$active = 'active';
											$in_active = 'in-active';
											$checked = 'checked="checked"';
										else :
											$active = 'in-active';
											$in_active = 'active';
											$checked = '';
										endif;
										?>

										<div class="toggle-switch">
											<p><?php echo esc_html( $icons['label'] ); ?></p>

											<div class="toggle">
												<input type="checkbox" name="icon_set[]" value="<?php echo esc_attr( $key ); ?>" <?php echo esc_attr( $checked ); ?>>

												<span data-value="<?php echo esc_attr( $key ); ?>" class="<?php echo esc_attr( $active ); ?>"><?php esc_html_e( 'Yes', 'octagon-elements-lite-for-elementor' ); ?></span>
												<span data-value="" class="<?php echo esc_attr( $in_active ); ?>"><?php esc_html_e( 'No', 'octagon-elements-lite-for-elementor' ); ?></span>

											</div>
										</div>

										<?php
									endforeach;
								endif;

								$nonce = wp_create_nonce( 'nonce-octagon-icon-set' );
								?>

							</div>
						</div>

						<input type="hidden" name="nonce" value="<?php echo esc_attr( $nonce ); ?>">
						<button name="save_icon_set" class="bttn bttn-gradient bttn-medium"><?php esc_html_e( 'Save Icon', 'octagon-elements-lite-for-elementor' ); ?></button>

					</div>
				</div>

			</div>
			
		</form>

		<form method="post" class="custom-icon-manager-form">

			<div class="grids one-column"> 

				<div class="column">
					<div class="grid">

						<div class="title-area">
							<div class="info">
								<p class="main-title"><?php esc_html_e( 'Custom Icons', 'octagon-elements-lite-for-elementor' ); ?></p>
								<p class="sub"><?php esc_html_e( 'Don\'t rely on the pre build icons everyone else is using! Differentiate your website and your style with custom icons.', 'octagon-elements-lite-for-elementor' ); ?></p>
							</div>
							<div class="mini-link">
								<a href="https://docs.octagonwebstudio.com/elementor-elements/" class="simple-link"><?php esc_html_e( 'Learn More', 'octagon-elements-lite-for-elementor' ); ?></a>
							</div>
						</div>

						<div class="content-area">
							
							<div class="pro-notice">
								<p><strong><?php esc_html_e( 'Custom icon import is available only on Pro version.', 'octagon-elements-lite-for-elementor' ); ?></strong></p>
								<a href="https://codecanyon.net/item/octagon-elements-lite-for-elementor/26752840" class="bttn bttn-gradient bttn-tiny"><?php esc_html_e( 'Get Pro', 'octagon-elements-lite-for-elementor' ); ?></a>
							</div>						

						</div>
						
					</div>
				</div>

			</div>
			
		</form>

	</div> <!-- .icon-manager -->

</div> <!-- .octagon-admin-page -->
