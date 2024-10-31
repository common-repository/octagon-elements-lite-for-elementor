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

<div class="octagon-elements advance-btn {{ settings.align }} {{ settings.ex_class }}">

	<a class="btn {{ settings.btn_size }} {{ settings.btn_type }} {{ settings.btn_color }} {{ settings.gradient_palette }}" href="{{ settings.link.url }}">
		<span class="octagon-button-content-wrapper">

			<# 
			if( '' != settings.icon.value && 'left' == settings.icon_position ) { #>
				{{{ iconHTML.value }}}
				<#
			}

			if( ! settings.only_icon ) {
                #>
                <span {{{ view.getRenderAttributeString( 'btn_text' ) }}}>{{{ settings.btn_text }}}</span>
                <#
            }

            if( '' != settings.icon.value && 'right' == settings.icon_position ) { #>
				{{{ iconHTML.value }}}
				<#
			}
			#>
		</span>
	</a>

</div> <!-- .advance-btn -->