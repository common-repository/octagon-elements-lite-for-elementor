<?php
/**
 *
 * @package octagon-elements-lite-for-elementor/core/views
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.4
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;

?>

<div class="octagon-admin-page">

	<?php
	include_once OCTAGON_CORE_PATH . '/views/html-header.php';
	?>
	
	<div class="welcome-info grids two-column no-flex">

		<div class="column">

			<div class="grid with-bg">
				<div class="title-area">
					<div class="info">
						<p class="main-title"><?php esc_html_e( 'Theme Requirements', 'octagon-elements-lite-for-elementor' ); ?></p>
						<p class="sub"><?php esc_html_e( 'Theme and Server requirements listed here.', 'octagon-elements-lite-for-elementor' ); ?></p>
					</div>
				</div>

				<div class="content-area">
					<ul class="status-list">
						<?php
						if( isset( $this->error['status'] ) ) :
							foreach( $this->error['status'] as $key => $error ) :
								?>
								<li>
									<?php echo wp_kses( $error['batch'], array( 'span' => array( 'class' => [] ) ) ); ?>
									<span class="list-title"><?php echo esc_html( $error['title'] ); ?></span>
									<?php echo esc_html( $error['value'] ); ?>
									<?php echo wp_kses( $error['info'], array( 'span' => array( 'class' => [] ), 'strong' => [] ) ); ?>
								</li>
								<?php
							endforeach;
						else :
							?>
							<li><?php esc_html_e( 'Looks good!!', 'octagon-elements-lite-for-elementor' ); ?></li>
							<?php
						endif;
						?>
					</ul>
				</div>
				
			</div>

		</div>
		<div class="column">

			<div class="grid with-bg">
				<div class="title-area">
					<div class="info">
						<p class="main-title"><?php esc_html_e( 'Recent Logs', 'octagon-elements-lite-for-elementor' ); ?></p>
						<p class="sub"><?php esc_html_e( 'New features and Bug fixes.', 'octagon-elements-lite-for-elementor' ); ?></p>
					</div>
					<div class="mini-link">
						<a href="https://docs.octagonwebstudio.com/elementor-elements/change-logs/" class="simple-link"><?php esc_html_e( 'View Logs', 'octagon-elements-lite-for-elementor' ); ?></a>
					</div>
				</div>

				<div class="content-area">
<pre>
= 1.4 - May 30 2020 =

* Element - "Gallery Block" element added.
* Tweak - Removed `octagon_make_class()` and `octagon_trim()`, added `octagon_change_case()`.
* Tweak - Removed `octagon_builder_exists()`.
* Dev - Filter introduced `octagon_allow_adaptive_images` to allow image srcset on cropped images.
* Dev - Filter introduced `octagon_get_placeholder_image_src` to set a default placeholder image src.

Files Change:

* ../assets/js/scripts.js
* ../assets/js/frontend.js
* ../core/assets/css/octagon.css
* ../core/class-enqueue-scripts.php
* ../core/helper-functions.php
* ../core/class-metabox.php
* ../core/icon-manager/class-icon-manager.php
* ../core/class-sidebar.php
* ../core/views/html-welcome.php
* ../includes/class-enqueue-scripts.php
* ../modules/initialize-elements.php

Files Added:

* ../assets/less/shortcodes/gallery-block.less
* ../core/library/js/shuffle.min.js
* ../modules/gallery-block.php
* ../shortcodes/gallery-block.php
</pre>
				</div>				
			</div>

		</div>
		
	</div> <!-- .welcome-info -->

</div> <!-- .octagon-admin-page -->
