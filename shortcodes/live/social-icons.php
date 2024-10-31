<?php

/**
 * Social Icons
 *
 * @package octagon-elements-lite-for-elementor/shortcodes/live
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.0
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;

?>

<div {{{ view.getRenderAttributeString( 'wrapper' ) }}}>

	<# 
	if( settings.icon_set.length ) {

		var index = view.getIDInt().toString().substr( 0, 3 );

		_.each( settings.icon_set, function( set ) { 

			var encloseTag = ( set.link.url ) ? 'a' : 'span',
				title = set.link ? set.title : '',
				link = set.link ? set.link.url : '',
				iconBase = set.icon.value.split('-');
				iconHTML = elementor.helpers.renderIcon( view, set.icon, { 'aria-hidden': true }, 'i' , 'object' );
			#>

			<{{{encloseTag}}} id="icon-wrap-{{set._id}}" class="icon-wrap elementor-repeater-item-{{set._id}} social-icon-{{iconBase[iconBase.length-1]}}" href="{{link}}" title="{{title}}">
                {{{iconHTML.value}}}
                <span class="brand">{{{title}}}</span>
            </{{{encloseTag}}}>
			<# 
		});
	}
	#>

</div> <!-- .social-icons -->