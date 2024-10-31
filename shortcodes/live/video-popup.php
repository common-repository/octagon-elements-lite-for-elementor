<?php

/**
 * Video Popup
 *
 * @package octagon-elements-lite-for-elementor/shortcodes/live
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.0
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;

?>

<div {{{ view.getRenderAttributeString( 'wrapper' ) }}}>
	<# if( settings.link ) { #>
		<a {{{ view.getRenderAttributeString( 'trigger' ) }}}>
			{{{triggerHTML}}}
		</a>
	<# } #>
</div> <!-- .timeline -->