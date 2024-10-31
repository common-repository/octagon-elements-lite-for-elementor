<?php

/**
 * Info Icons
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
				iconHTML = elementor.helpers.renderIcon( view, set.icon, { 'aria-hidden': true }, 'i' , 'object' );

			view.addRenderAttribute( titleKey, 'class', 'title' );

			view.addInlineEditingAttributes( titleKey );
			#>

			<div class="info-icon-group">

				<div class="icon-wrap icon-type-{{{ set.type }}} icon-method-{{{ set.method }}}">
                    <# if( 'icon' == set.type ) { #>
                        {{{iconHTML.value}}}
                    <# } else if( 'image' == set.type ) {
                        if ( set.image.url ) {
							var image = {
								id: set.image.id,
								url: set.image.url,
								size: set.image_size,
								dimension: set.image_custom_dimension,
								model: view.getEditModel()
							};

							var image_url = elementor.imagesManager.getImageUrl( image );

							if( ! image_url ) {
								return;
							}
						}
						#>
						<img src="{{{image_url}}}">
                    <# } #>
                </div>

				<div class="content">
					<# if( set.title ) { #>
						<{{{ settings.title_tag }}} class="info-icon-title sub-title">
							<# if( set.link.url ) { #>
								<a href="{{ set.link.url }}">
							<# } #>
								<span {{{ view.getRenderAttributeString( titleKey ) }}}>{{{ set.title }}}</span>
							<# if( set.link.url ) { #>
								</a>
							<# } #>
						</{{{ settings.title_tag }}}>
					<# } #>
				</div> <!-- .content -->
			</div> <!-- .info-icon-group -->
			<# 
		});
	}
	#>

</div> <!-- .info-icons -->
