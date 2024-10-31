<?php
/**
 *
 * @package octagon-elements-lite-for-elementor/core/template-builder/view
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.0
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if( ! current_theme_supports( 'title-tag' ) ) : ?>
		<title>
			<?php echo wp_get_document_title(); ?>
		</title>
	<?php endif; ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php

wp_body_open();

$template = Octagon_Core_Template_Builder::get_template_id( 'header' );

do_action( 'oee_before_header', $template );
?>

<div class="oee-header-template-markup oee-header-template-container">
	<?php
	echo Octagon_Core_Template_Builder::render_content( $template['header'] ); 
	?>
</div>

<?php do_action( 'oee_after_header', $template );
