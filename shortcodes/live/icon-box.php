<?php

/**
 * Icon Box
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
<# if( 'separate' == settings.style ) {  #>

	<div {{{ view.getRenderAttributeString( 'wrapper' ) }}}>
		
		{{{ printIcon }}}

		<div class="content">
			<#
			if( settings.title ) {
				#>
				<{{{ settings.title_tag }}} {{{ view.getRenderAttributeString( 'title' ) }}}>{{{ settings.title }}}</{{{ settings.title_tag }}}>
				<#
			}

			if( settings.desc ) {
				#>
				<p {{{ view.getRenderAttributeString( 'desc' ) }}}>{{{ settings.desc }}}</p>
				<#
			}
			#>
		</div> <!-- .content -->
		
		<div class="advance-btn">
			<a class="btn {{ settings.btn_size }} {{ settings.btn_type }} {{ settings.btn_color }}" href="{{ settings.link.url }}">
				<span>
					<# 
					if( '' != settings.icon.value && 'left' == settings.icon_position ) { #>
						{{{ btnIconHTML.value }}}
						<#
					}

					if( ! settings.only_icon ) {
		                #>
		                <span {{{ view.getRenderAttributeString( 'btn_text' ) }}}>{{{ settings.btn_text }}}</span>
		                <#
		            }

		            if( '' != settings.icon.value && 'right' == settings.icon_position ) { #>
						{{{ btnIconHTML.value }}}
						<#
					}
					#>
				</span>
			</a>
		</div>		

	</div> <!-- .icon-box -->

<# } 
else if( 'collapse' == settings.style ) {  #>

	<div {{{ view.getRenderAttributeString( 'wrapper' ) }}}>
	
		{{{ printIcon }}}

		<div class="content">
			<#
			if( settings.title ) {
				#>
				<{{{ settings.title_tag }}} {{{ view.getRenderAttributeString( 'title' ) }}}>{{{ settings.title }}}</{{{ settings.title_tag }}}>
				<#
			}

			if( settings.desc ) {
				#>
				<p {{{ view.getRenderAttributeString( 'desc' ) }}}>{{{ settings.desc }}}</p>
				<#
			}
			#>

			<div class="advance-btn">
				<a class="btn {{ settings.btn_size }} {{ settings.btn_type }} {{ settings.btn_color }}" href="{{ settings.link.url }}">
					<span>
						<# 
						if( '' != settings.icon.value && 'left' == settings.icon_position ) { #>
							{{{ btnIconHTML.value }}}
							<#
						}

						if( ! settings.only_icon ) {
			                #>
			                <span {{{ view.getRenderAttributeString( 'btn_text' ) }}}>{{{ settings.btn_text }}}</span>
			                <#
			            }

			            if( '' != settings.icon.value && 'right' == settings.icon_position ) { #>
							{{{ btnIconHTML.value }}}
							<#
						}
						#>
					</span>
				</a>
			</div>
		</div> <!-- .content -->

	</div> <!-- .icon-box -->

<# } #>
