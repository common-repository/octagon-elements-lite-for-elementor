<?php
/**
 *
 * @package octagon-elements-lite-for-elementor/core/template-builder/view
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.0
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;

$template = Octagon_Core_Template_Builder::get_template_id( 'footer' );

do_action( 'oee_before_footer', $template );
?>

<div class="oee-footer-template-markup oee-footer-template-container">
	<?php
	echo Octagon_Core_Template_Builder::render_content( $template['footer'] ); 
	?>
</div>

<?php 
do_action( 'oee_after_footer', $template );
wp_footer();
?>

</body>
</html>
