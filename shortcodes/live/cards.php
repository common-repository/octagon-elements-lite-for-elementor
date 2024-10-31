<?php

/**
 * Cards
 *
 * @package octagon-elements-lite-for-elementor/shortcodes/live
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.0
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>
<div {{{ view.getRenderAttributeString( 'wrapper' ) }}}>

	<# 
	if( settings.icon_set.length ) {

		_.each( settings.icon_set, function( set, index ) { 

			var titleKey = view.getRepeaterSettingKey( 'text', 'icon_set', index ),
				wrapKey = view.getRepeaterSettingKey( 'link', 'icon_set', index ),
				iconHTML = elementor.helpers.renderIcon( view, set.icon, { 'aria-hidden': true }, 'i' , 'object' ),
				wrapTag = ( set.link.url ) ? 'a' : 'span';

			view.addRenderAttribute( wrapKey, 'class', 'card' );
			view.addRenderAttribute( titleKey, 'class', 'title' );

			view.addInlineEditingAttributes( titleKey );
			#>			

			<{{{wrapTag}}} {{{ view.getRenderAttributeString( wrapKey ) }}}>

				<div class="card-inner">

					<# if( '' != set.icon.value ) { #>
						<div class="icon-wrap">
		                    {{{iconHTML.value}}}
		                </div>
					<# } #>				

					<div class="content">
						<# if( set.title ) { #>
							<{{{ settings.title_tag }}} class="title">
								<span {{{ view.getRenderAttributeString( titleKey ) }}}>{{{ set.title }}}</span>
							</{{{ settings.title_tag }}}>
						<# } #>
					</div> <!-- .content -->

				</div> <!-- .card-inner -->

			</{{{wrapTag}}}> <!-- .card -->	
					
			<# 
		});
	}
	#>

</div> <!-- .cards -->
