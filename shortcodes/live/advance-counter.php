<?php

/**
 * Advance Counter
 *
 * @package octagon-elements-lite-for-elementor/shortcodes/live
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.0
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;

?>

<div class="octagon-elements advance-counter {{ settings.align }} {{ settings.ex_class }}">
	
	<div class="counter-wrap">

		{{{iconHTML.value}}}

		<div class="counter-content">
			<div class="counter">
				
				<# if( '' != settings.prefix ) {  #>
					<span>{{{settings.prefix}}}</span>
				<# } #>

				<span {{{ view.getRenderAttributeString( 'number' ) }}}>{{{settings.number}}}</span>

				<# if( '' != settings.suffix ) {  #>
					<span>{{{settings.suffix}}}</span>
				<# } #>

			</div> <!-- .counter -->
			<div {{{ view.getRenderAttributeString( 'label' ) }}}>{{{ settings.label }}}</div>
		</div> <!-- .counter-content -->

	</div> <!-- .counter-wrap -->

</div> <!-- .advance-counter -->