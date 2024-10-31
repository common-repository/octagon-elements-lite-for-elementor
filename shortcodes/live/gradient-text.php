<?php

/**
 * Advance Button
 *
 * @package octagon-elements-lite-for-elementor/shortcodes/live
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.0
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;

?>

<div class="octagon-elements gradient-text {{ settings.ex_class }}">

	<{{ settings.title_tag }} class="sub-title">
		<span {{{ view.getRenderAttributeString( 'title' ) }}}>{{{ settings.title }}}</span>
	</{{ settings.title_tag }}>

</div> <!-- .advance-btn -->