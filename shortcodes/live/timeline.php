<?php

/**
 * Timeline
 *
 * @package octagon-elements-lite-for-elementor/shortcodes/live
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.0
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;

?>

<div class="octagon-elements timeline {{ settings.ex_class }}">

	<# if( settings.timeline.length ) { 		
		#>
		<span class="vertical-line"></span>
		<div class="timeline-set-group">
			<# 
			_.each( settings.timeline, function( set, index ) { 
				var subTitleKey = view.getRepeaterSettingKey( 'sub_title', 'timeline', index ),
					titleKey = view.getRepeaterSettingKey( 'title', 'timeline', index ),
					descKey = view.getRepeaterSettingKey( 'desc', 'timeline', index );

				view.addRenderAttribute( subTitleKey, {
					'class': [ 'sub-title' ]
				} );

				view.addRenderAttribute( titleKey, {
					'class': [ 'title' ]
				} );

				view.addRenderAttribute( descKey, {
					'class': [ 'desc' ]
				} );

				view.addInlineEditingAttributes( subTitleKey, 'none' );
				view.addInlineEditingAttributes( titleKey, 'none' );
				view.addInlineEditingAttributes( descKey, 'none' );
				#>
				<div class="timeline-set">
					<span {{{ view.getRenderAttributeString( subTitleKey ) }}}>{{{ set.sub_title }}}</span>
					<p {{{ view.getRenderAttributeString( titleKey ) }}}>{{{ set.title }}}</p>
					<p {{{ view.getRenderAttributeString( descKey ) }}}>{{{ set.desc }}}</p>
				</div> <!-- .timeline-set -->
				<# 
			});
			#>
		</div>
	<# } #>

</div> <!-- .timeline -->