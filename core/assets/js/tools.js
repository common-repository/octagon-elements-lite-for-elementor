/*!
 * JQuery Helpers v1.0
 *
 * 
 * Copyright (c) 2020 octagon web studio
 *
 */

(function( $, window, document, undefined ) {

	"use strict";

	if( typeof( octagon ) == 'undefined' ) {
		window.octagon = {};
	}


	/* ---------------------------------------------------------------------------------------------------------
	 *
	 * Global Fuctions
	 *
	 * --------------------------------------------------------------------------------------------------------- */

	window.octagon.utils = $.extend( {

		/* ---------------------------------------------------------------------------------------------------------
		 * Check User Agent
		------------------------------------------------------------------------------------------------------------ */

		userAgent : function() {

			if( navigator.userAgent.match( /Tablet|iPad/i ) ) {
				return 'tablet';
			}
			else if( navigator.userAgent.match( /Mobile|Windows Phone|Lumia|Android|webOS|iPhone|iPod|Blackberry|PlayBook|BB10|Opera Mini|\bCrMo\/|Opera Mobi/i ) ) {
				return 'mobile';
			}
			else {
				return 'desktop';
			}

		},


		/* ---------------------------------------------------------------------------------------------------------
		 * Random String
		------------------------------------------------------------------------------------------------------------ */

		random : function( n ) {
			var text = "";
			var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

			for( var i = 0; i < n; i++ ) {
				text += possible.charAt( Math.floor( Math.random() * possible.length ) );
			}

			return text;
		},


		/* ---------------------------------------------------------------------------------------------------------
		 * Add Query Arguement | Pass the key and value with current URL to get the proper URL format
		------------------------------------------------------------------------------------------------------------ */

		addQueryArg : function( key, value, url ) {

			var re = new RegExp( "([?&])" + key + "=.*?(&|$)", "i" ),
				separator = url.indexOf( '?' ) !== -1 ? '&' : '?';

			if( url.match( re ) ) {
				return url.replace( re, '$1' + key + "=" + value + '$2' );
			}
			else {
				return url + separator + key + "=" + value;
			}

		},


		/* ---------------------------------------------------------------------------------------------------------
		 * Disable Scroll
		------------------------------------------------------------------------------------------------------------ */

		disableScroll : function() {

			$( 'body' ).css({
				overflow: 'hidden',
				width: '100%',
				height: '100vh'
			});

		},


		/* ---------------------------------------------------------------------------------------------------------
		 * Reset Scroll
		------------------------------------------------------------------------------------------------------------ */

		resetScroll : function() {

			$( 'body' ).css({
				overflow: 'auto',
				width: 'auto',
				height: 'auto'
			});
			
		}


	});

})( jQuery, window, document );
