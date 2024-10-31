/*!
 * Frontend Scripts v1.4
 *
 * 
 * Copyright (c) 2020 octagon web studio
 * 
 */

(function($){

    "use strict";

    /* ---------------------------------------------------------------------------------------------------------
	 * Global Variables
	------------------------------------------------------------------------------------------------------------ */

	var ScrollPos = 0;
	var userAgent = false;


	/* -----------------------------------------------------------------------------------------------------
	 * Post Likes
	 * ----------------------------------------------------------------------------------------------------- */

	var postLikes = function( $this ) {

		var id = $this.data( 'id' );

		if( $this.hasClass( 'loading' ) || $this.hasClass( 'in-the-like' )) {
			return;
		}

		$this.addClass( 'loading' );

		$.ajax({
			type: 'post',
			url: octagon_localize.ajax_url,
			data: {
				'action'  : 'octagon_post_likes',
				'id' : id
			},
		}).done(function( result ) {

			var obj = JSON.parse( result );

			if( 'liked' == obj.like ) {
				$this.addClass( 'in-the-like' );
				$this.find( 'span' ).addClass( 'oct-basic-heart-fill' ).removeClass( 'oct-basic-heart' );
			}
			else {
				$this.removeClass( 'in-the-like' );
				$this.find( 'span' ).addClass( 'oct-basic-heart' ).removeClass( 'oct-basic-heart-fill' );
			}

			$this.removeClass( 'loading' );
			
		});
	},


	/* -----------------------------------------------------------------------------------------------------
	 * Swiper Slider
	 * ----------------------------------------------------------------------------------------------------- */

	carousel = function( $slider ) {

		$( $slider ).each( function( index, el ) {

			var $this = $( this );

			var obj = {
				'slidesPerView'  : $this.data( 'slides-per-view' ),
				'loop'           : $this.data( 'loop' ),
				'autoplay'       : $this.data( 'autoplay' ),
				'speed'          : $this.data( 'speed' ),
				'autoHeight'     : $this.data( 'auto-height' ),
				'direction'      : $this.data( 'direction' ),
				'draggable'      : $this.data( 'draggable' ),
				'allowTouchMove' : $this.data( 'touch-move' ),
				'centeredSlides' : $this.data( 'centered-slides' ),
				'keyboard'       : $this.data( 'keyboard' ),
				'mousewheel'     : $this.data( 'mousewheel' ),
				'effect'         : $this.data( 'effect' ),
				'initialSlide'   : $this.data( 'initial-slide' ),
				'fadeEffect'     : {
					'crossFade' : true
				},
				'pagination' : {
					'el'        : '.swiper-pagination',
					'clickable' : true
				}
			}

			var swiper = new Swiper( $this, obj );

		});			

	},


	/* -----------------------------------------------------------------------------------------------------
	 * Shuffle
	 * ----------------------------------------------------------------------------------------------------- */

	shuffle = function( $block ) {

		var Shuffle = window.Shuffle;

		$( $block ).each( function( index, el ) {

			var $this = $( this );

			$this.imagesLoaded().progress( function() {

				var sizer = $this.find( '.block-sizer' );

				var shuffleInstance = new Shuffle( $this, {
					itemSelector: '.block-item',
					sizer: sizer
				});
				
			});

		});			

	},


	/* -----------------------------------------------------------------------------------------------------
	 * Image Compare
	 * ----------------------------------------------------------------------------------------------------- */

	imageCompare = function( $selector ) {

		var viewers = document.querySelectorAll( $selector );

		for( var i = 0; i <= viewers.length - 1; i++ ) {

			var view = viewers[i].dataset;

			var config = {
				controlColor: typeof( view['color'] ) === 'undefined' ? '#ffffff' : view['color'],
				controlShadow: view['shadow'] === "false" ? false : true,
				addCircle: view['circle'] === "false" ? false : true,
				addCircleBlur: view['circleblur'] === "false" ? false : true,
				smoothing: view['smoothing'] === "false" ? false : true,
				smoothingAmount: parseInt( view['smoothingamount'] ),
				hoverStart: view['hoverstart'] === "false" ? false : true,
				startingPoint: parseInt( view['startingpoint'] ),
			};

			new ImageCompare( viewers[i], config ).mount();
		}

	},


	/* ---------------------------------------------------------------------------------------------------------
	 * Loadmore | It loads loop content via php function
	------------------------------------------------------------------------------------------------------------ */

	queryLoadMore = function( $this ) {

		var $con         = $this.closest( '.loop-container' ),
			$selector    = $con.find( '.ajax-content-pull' ),
			itemSelector = '.isotope-item',
			columnWidth  = '.isotope-item-sizer',
			$btn         = $this.closest( '.btn-loadmore' ),
			uid          = $btn.data( 'uid' ),
			obj          = octagon_localize[uid],
			paged        = $btn.data( 'paged' ),
			isotope      = obj.isotope,
			slider       = obj.slider,
			paged        = parseInt( paged ) + 1;

		$btn.find( 'a' ).addClass( 'loading' );

		$.ajax({
			type: 'post',
			url: octagon_localize.ajax_url,
			data: {
				'action'  : obj.ajax,
				'options' : obj['options'],
				'args'    : obj['args'],
				'max'     : obj['max'],
				'paged'   : paged
			},
		}).done(function( result ) {

			$btn.find( 'a' ).removeClass( 'loading' );

			var $result   = $( result ),
				$html     = $( $result.find( '.html-content' ).html() ),
				$items    = $html.find( '.element' ),
				obj       = $result.find( '.json' ).data( 'value' ),
				paged     = obj.paged,
				last_page = obj.last_page;

			if( isotope ) {
				$selector.isotope({
					itemSelector: itemSelector,
					percentPosition: true,
					masonry: {
						columnWidth: columnWidth,
					}
				}).append( $items )
				  .isotope( 'appended', $items );

				$selector.imagesLoaded().progress( function() {
					$selector.isotope('layout');
				});
			}
			else {
				$selector.append( $items );
			}			

			if( ! last_page ) {
				$btn.data( 'paged', paged );
			}
			else {
				$btn.remove();
			}
			
		});
	},


	/* -----------------------------------------------------------------------------------------------------
	 * Loadmore | It loads all the page content and pick the required content and replace it
	 * ----------------------------------------------------------------------------------------------------- */

	pageLoadMore = function( $this ) {

		var $con         = $this.closest( '.loop-container' ),
			$selector    = $con.find( '.post-loop' ),
			itemSelector = '.isotope-item',
			columnWidth  = '.isotope-item-sizer',
			$btn         = $this.closest( '.btn-loadmore' ),
			uid          = $btn.data( 'uid' ),
			obj          = octagon_localize[uid],
			href         = $this.attr( 'href' ),
			isotope      = obj.isotope,
			slider       = obj.slider;

		$btn.find( 'a' ).addClass( 'loading' );

		$.get( href, function( data ) {

			$btn.find( 'a' ).removeClass( 'loading' );

			var $content = $( '.post-loop', data ).html(),
				$newBtn  = $( '.btn-loadmore a', data ),
				href     = $( '.btn-loadmore a', data ).attr( 'href' );

			if( isotope ) {

				$content = $( $content ).not( '.isotope-item-sizer' );

				$selector.isotope({
					itemSelector: itemSelector,
					percentPosition: true,
					masonry: {
						columnWidth: columnWidth,
					}
				}).append( $content )
				  .isotope( 'appended', $content );

				$selector.imagesLoaded().progress( function() {
					$selector.isotope('layout');
				});
			}
			else {
				$selector.append( $content );
			}
			
			if( href ) {
				$btn.find( 'a' ).remove();
				$btn.append( $newBtn );
				$btn.show();
			}
			else {
				$btn.find( 'a' ).remove();
			}

		});
	},

	/* -----------------------------------------------------------------------------------------------------
	 * Compare Products
	 * ----------------------------------------------------------------------------------------------------- */

	compareProducts = function( $this ) {

		var $con = $this.closest( '.product-icons' ),
			id = $con.data( 'id' );

		$this.addClass( 'loading' );

    	$.ajax({
			type: 'post',
			url: octagon_localize.ajax_url,
			data: {
				'action'  : 'octagon_add_compare_products',
				'id' : id
			},
		}).done(function( result ) {

			var obj = JSON.parse( result );

			$this.removeClass( 'loading' );
			
		});

	},

	/* -----------------------------------------------------------------------------------------------------
	 * Remove Compare Products
	 * ----------------------------------------------------------------------------------------------------- */

	removeCompareProducts = function( $this ) {

		var $table = $this.closest( '.compare-products-table' ),
			$slider = $this.closest( '.compare-product-slide' ),
			$count = $( '.table-header .count' ),
			total = $slider.data( 'count' ),
			$slide = $this.closest( '.slide' ),
			slideIndex = $slide.data( 'index' ),
			recount,
			id = $this.data( 'id' );

		$this.addClass( 'loading' );

    	$.ajax({
			type: 'post',
			url: octagon_localize.ajax_url,
			data: {
				'action'  : 'octagon_remove_compare_products',
				'id' : id
			},
		}).done(function( result ) {

			var $result = $( result ),
				notice = $result.html(),
				newCount = $result.data( 'count' );

			if( $count.length ) {
				$count.html( newCount );
			}

			$this.removeClass( 'loading' );

			if( newCount ) {

				$slide.remove();

				recount = ( 3 < total ) ? 3 : total - 1;
				$slider.data( 'slides-per-view', recount );

				carousel( $slider );

				$slider.data( 'count', total - 1 );

			}
			else {
				$table.html( notice );
			}
			
		});

	},

	/* -----------------------------------------------------------------------------------------------------
	 * Wishlist
	 * ----------------------------------------------------------------------------------------------------- */

	wishlist = function( $this ) {

		var $con = $this.closest( '.product-icons' ),
			id = $con.data( 'id' );

		$this.addClass( 'loading' );

    	$.ajax({
			type: 'post',
			url: octagon_localize.ajax_url,
			data: {
				'action' : 'oee_wishlist',
				'id' : id
			},
		}).done(function( result ) {

			var obj = JSON.parse( result );

			if( $this.hasClass( 'in-the-wishlist' ) ) {
				$this.removeClass( 'in-the-wishlist' );
				$this.find( '.oct-basic-heart-fill' ).addClass( 'oct-basic-heart' ).removeClass( 'oct-basic-heart-fill' );
			}
			else {
				$this.addClass( 'in-the-wishlist' );
				$this.find( '.oct-basic-heart' ).addClass( 'oct-basic-heart-fill' ).removeClass( 'oct-basic-heart' );
			}

			$this.removeClass( 'loading' );
			
		});

	},

	/* -----------------------------------------------------------------------------------------------------
	 * Remove Wishlist
	 * ----------------------------------------------------------------------------------------------------- */

	removeWishlist = function( $this ) {

		var $table = $this.closest( '.wishlist-table' ),
			$tableHead = $table.find( '.table-header' ),
			id = $this.data( 'id' );

		$this.addClass( 'loading' );

    	$.ajax({
			type: 'post',
			url: octagon_localize.ajax_url,
			data: {
				'action' : 'oee_remove_wishlist',
				'id' : id
			},
		}).done(function( result ) {

			var $result = $( result ),
				notice = $result.html(),
				count = $result.data( 'count' );

			$this.removeClass( 'loading' );

			$this.closest( '.table-content' ).remove();

			if( ! $( '.table-content' ).length ) {
				$table.html( notice );
			}

			if( $tableHead.length ) {
				$tableHead.find( '.count' ).html( count );
			}
			
		});

	},

	/* -----------------------------------------------------------------------------------------------------
	 * Quick View
	 * ----------------------------------------------------------------------------------------------------- */

	quickView = function( $this ) {

		var $con = $this.closest( '.product-icons' ),
			id = $con.data( 'id' );

		$this.addClass( 'btn-loading' );

    	$.ajax({
			type: 'post',
			url: octagon_localize.ajax_url,
			data: {
				'action' : 'oee_quick_view',
				'id' : id
			},
		}).done(function( result ) {

			$this.removeClass( 'btn-loading' );

			appendInDialog( result );			
			
		});

	},

	/* -----------------------------------------------------------------------------------------------------
	 * Login
	 * ----------------------------------------------------------------------------------------------------- */

	login = function( $this ) {

		if( $this.hasClass( 'loading' ) ) {
			return;
		}

		$this.addClass( 'loading' );

		var $wrap = $this.closest( '.login-register-form' ),
			$con = $this.closest( '.form-login' ),
			serialize = $this.serializeArray(),
			data = {};

		$.each( serialize, function( index, obj ) {
			data[obj.name] = obj.value;
		});

		var userdata = {
			'user_login' : data['user_login'],
			'user_password' : data['user_password'],
			'remember' : data['remember']
		}

    	$.ajax({
			type: 'post',
			url: octagon_localize.ajax_url,
			data: {
				'action'  : 'octagon_login',
				'userdata' : userdata,
				'redirect_to' : data['redirect_to'],
				'testcookie' : data['testcookie'],
				'nonce' : data['octagon-login-nonce']
			},
		}).done(function( result ) {

			$this.removeClass( 'loading' );
			$wrap.find( '.notices' ).html( '' );

			var data = $.parseJSON( result );

			if( data.errors ) {
				$.each( data.errors, function( index, val ) {
					$wrap.find( '.notices' ).append( '<span>'+ val[0] + '</span>' );
				});
			}
			else {
				$( location ).attr( 'href', data.redirect_to );
			}
			
		});

	},

	/* -----------------------------------------------------------------------------------------------------
	 * Lost Password
	 * ----------------------------------------------------------------------------------------------------- */

	lostPassword = function( $this ) {

		if( $this.hasClass( 'loading' ) ) {
			return;
		}

		$this.addClass( 'loading' );

		var $wrap = $this.closest( '.login-register-form' ),
			$con = $this.closest( '.form-lost-password' ),
			serialize = $this.serializeArray(),
			data = {};

		$.each( serialize, function( index, obj ) {
			data[obj.name] = obj.value;
		});

    	$.ajax({
			type: 'post',
			url: octagon_localize.ajax_url,
			data: {
				'action'  : 'octagon_lost_password',
				'user_login' : data.user_login,
				'reset_password' : data['reset_password'],
				'lostpassword_url' : data['lostpassword_url'],
				'nonce' : data['octagon-lostpassword-nonce']
			},
		}).done(function( result ) {

			$this.removeClass( 'loading' );
			$wrap.find( '.notices' ).html( '' );

			var data = $.parseJSON( result );

			if( data.errors ) {
				$.each( data.errors, function( index, val ) {
					$wrap.find( '.notices' ).append( '<span>'+ val[0] + '</span>' );
				});
			}
			else {
				$wrap.find( '.notices' ).append( '<span>'+ data.success + '</span>' );
			}
			
		});

	},

	/* -----------------------------------------------------------------------------------------------------
	 * Reset Password
	 * ----------------------------------------------------------------------------------------------------- */

	resetPassword = function( $this ) {

		if( $this.hasClass( 'loading' ) ) {
			return;
		}

		$this.addClass( 'loading' );

		var $wrap = $this.closest( '.login-register-form' ),
			$con = $this.closest( '.form-reset-password' ),
			serialize = $this.serializeArray(),
			data = {};

		$.each( serialize, function( index, obj ) {
			data[obj.name] = obj.value;
		});

    	$.ajax({
			type: 'post',
			url: octagon_localize.ajax_url,
			data: {
				'action'  : 'octagon_reset_password',
				'user_password' : data['user_password'],
				'confirm_password' : data['confirm_password'],
				'reset_password' : data['reset_password'],
				'key' : data['key'],
				'login' : data['login'],
				'redirect_to' : data['redirect_to'],
				'nonce' : data['octagon-resetpassword-nonce']
			},
		}).done(function( result ) {

			$this.removeClass( 'loading' );
			$wrap.find( '.notices' ).html( '' );

			var data = $.parseJSON( result );

			if( data.errors ) {
				$.each( data.errors, function( index, val ) {
					$wrap.find( '.notices' ).append( '<span>'+ val[0] + '</span>' );
				});
			}
			else {
				$wrap.find( '.notices' ).append( '<span>'+ data.success + '</span>' );
			}
			
		});

	},

	/* -----------------------------------------------------------------------------------------------------
	 * Register
	 * ----------------------------------------------------------------------------------------------------- */

	register = function( $this ) {

		if( $this.hasClass( 'loading' ) ) {
			return;
		}

		$this.addClass( 'loading' );

		var $wrap = $this.closest( '.login-register-form' ),
			$con = $this.closest( '.form-register' ),
			serialize = $this.serializeArray(),
			data = {};

		$.each( serialize, function( index, obj ) {
			data[obj.name] = obj.value;
		});

    	$.ajax({
			type: 'post',
			url: octagon_localize.ajax_url,
			data: {
				'action'  : 'octagon_register',
				'user_login' : data['user_login'],
				'user_email' : data['user_email'],
				'redirect_to' : data['redirect_to'],
				'nonce' : data['octagon-register-nonce']
			},
		}).done(function( result ) {

			$this.removeClass( 'loading' );
			$wrap.find( '.notices' ).html( '' );

			var data = $.parseJSON( result );

			if( data.errors ) {
				$.each( data.errors, function( index, val ) {
					$wrap.find( '.notices' ).append( '<span>'+ val[0] + '</span>' );
				});
			}
			else {
				$( location ).attr( 'href', data.redirect_to );
			}
			
		});

	},

	/* -----------------------------------------------------------------------------------------------------
	 * Profile
	 * ----------------------------------------------------------------------------------------------------- */

	updateProfile = function( $this ) {

		if( $this.hasClass( 'loading' ) ) {
			return;
		}

		$this.addClass( 'loading' );

		var $wrap = $this.closest( '.login-register-form' ),
			$con = $this.closest( '.form-profile' ),
			serialize = $this.serializeArray(),
			data = {};

		$.each( serialize, function( index, obj ) {
			data[obj.name] = obj.value;
		});

    	$.ajax({
			type: 'post',
			url: octagon_localize.ajax_url,
			data: {
				'action'  : 'octagon_update_profile',
				'first_name' : data['first_name'],
				'last_name' : data['last_name'],
				'display_name' : data['display_name'],
				'user_email' : data['user_email'],
				'current_password' : data['current_password'],
				'user_password' : data['user_password'],
				'confirm_password' : data['confirm_password'],
				'nonce' : data['octagon-update-profile-nonce']
			},
		}).done(function( result ) {

			$this.removeClass( 'loading' );
			$wrap.find( '.notices' ).html( '' );

			var data = $.parseJSON( result );

			if( data.errors ) {
				$.each( data.errors, function( index, val ) {
					$wrap.find( '.notices' ).append( '<span>'+ val[0] + '</span>' );
				});
			}
			else {
				$wrap.find( '.notices' ).append( '<span>'+ data.success + '</span>' );
			}
			
		});

	},

	/* -----------------------------------------------------------------------------------------------------
	 * AJAX Product Search
	 * ----------------------------------------------------------------------------------------------------- */

	productSearch = function( $this ) {

		var searchTerm = $this.val(),
			$wrap = $this.closest( '.ajax-product-search' ),
			$appendPostsWrap = $wrap.find( '.search-posts-data' ),
			$appendPosts = $appendPostsWrap.find( '.search-lists-posts' );

		$appendPosts.html( '' );
		$appendPostsWrap.removeClass( 'active' );

		if( $wrap.hasClass( 'loading' ) || searchTerm.length < 3 ) {
			return;
		}

		$wrap.addClass( 'loading' );
		$appendPostsWrap.removeClass( 'active' );
		$appendPosts.html( '' );

    	$.ajax({
			type: 'post',
			url: octagon_localize.ajax_url,
			data: {
				'action'  : 'octagon_products_search',
				'search_term' : searchTerm
			},
		}).done(function( result ) {

			var $result = $(result),
				$posts = $result.find( '.search-lists-posts' ).html();

			$wrap.removeClass( 'loading' );			
			$appendPostsWrap.addClass( 'active' );

			$appendPosts.html( $posts );

		});

	},

	/* -----------------------------------------------------------------------------------------------------
	 * Append Content in Dialog Box
	 * ----------------------------------------------------------------------------------------------------- */

	appendInDialog = function( content ) {

		if( $( '#dialog-popup' ).length ) { 

			$( '#dialog-content' ).html( content );
			$( '#dialog-popup' ).addClass( 'active' );

			centerDialogPopup();
			octagon.utils.disableScroll();
		}

	},


	/* -----------------------------------------------------------------------------------------------------
	 * Center Dialog Box
	 * ----------------------------------------------------------------------------------------------------- */

	centerDialogPopup = function( $this ) {

		if( $( '#dialog-popup' ).length ) { 

			var windowHeight = $(window).height(),
				centerPosition = ( ( windowHeight/2 ) - 290 ).toFixed(),
				centerPosition = ( centerPosition < 0 ) ? 0 : centerPosition;

			$( '#dialog-content' ).css( 'top', centerPosition + 'px' );

		}

	},


	/* -----------------------------------------------------------------------------------------------------
	 * Reset Dialog Box
	 * ----------------------------------------------------------------------------------------------------- */

	resetDialog = function( $this ) {

		$( '#dialog-content' ).empty();
		$( '#dialog-popup' ).removeClass( 'active' );

		octagon.utils.resetScroll();

	};


	/* ---------------------------------------------------------------------------------------------------------
	 *
	 * $( document ).ready()
	 *
	 * --------------------------------------------------------------------------------------------------------- */

	$( document ).ready( function(){

		/* -----------------------------------------------------------------------------------------------------
		 * General
		 * ----------------------------------------------------------------------------------------------------- */

		$( 'html' ).removeClass( 'no-js' );

		/* -----------------------------------------------------------------------------------------------------
		 * SVG Icon | If img tag contains svg src, it changes the img tag to svg tag
		 * ----------------------------------------------------------------------------------------------------- */

		$( 'img[src$=".svg"]' ).each( function() {

			var $img = $(this),
				imgURL = $img.attr( 'src' );

			$.get( imgURL, function( data ) {

				// Get the SVG tag, ignore the rest
				var $svg = $( data ).find( 'svg' );

				// Remove any invalid XML tags as per http://validator.w3.org
				$svg = $svg.removeAttr( 'xmlns:a' );

				// Check if the viewport is set, if the viewport is not set the SVG wont't scale.
				if( ! $svg.attr( 'viewBox' ) && $svg.attr( 'height' ) && $svg.attr( 'width' ) ) {
					$svg.attr( 'viewBox', '0 0 ' + $svg.attr( 'height' ) + ' ' + $svg.attr( 'width' ) );
				}

				// Replace image with new SVG
				$img.replaceWith( $svg );

			}, 'xml');

		});


		/* -----------------------------------------------------------------------------------------------------
		 * Counter
		 * ----------------------------------------------------------------------------------------------------- */

		if( $( '.counter' ).length ) {
			$( '.counter .number' ).countimator();
		}


		/* -----------------------------------------------------------------------------------------------------
		 * Post Likes
		 * ----------------------------------------------------------------------------------------------------- */

		$( '.post-loop' ).on('click', '.js-octagon-like', function (e) {

			e.preventDefault();

			postLikes( $( this ) );

		});


		/* -----------------------------------------------------------------------------------------------------
		 * Shuffle
		 * ----------------------------------------------------------------------------------------------------- */

		shuffle( '.block-module' );


		/* -----------------------------------------------------------------------------------------------------
		 * Isotope
		 * ----------------------------------------------------------------------------------------------------- */

		var $selector = $( '.masonry .post-loop:not(.no-isotope), .grid-block .grid-isotope, .js-portfolio-isotope .post-loop' ),
			itemSelector = '.isotope-item',
			columnWidth  = '.isotope-item-sizer';

		if( $selector.length ) {
			$selector.isotope({
				itemSelector: itemSelector,
				percentPosition: true,
				masonry: {
					columnWidth: columnWidth,
				}
			});

			$selector.imagesLoaded().progress( function() {
				$selector.isotope('layout');
			});
		}


		/* -----------------------------------------------------------------------------------------------------
		 * Isotope Filter
		 * ----------------------------------------------------------------------------------------------------- */

		var $con = $( '.js-portfolio-isotope' ),
			$filter = $con.find( '.filter' );

		$filter.find( 'li' ).on('click', function(e) {
			e.preventDefault();

			var $this = $(this),
				$selector = $this.closest( '.js-portfolio-isotope' ).find( '.post-loop' ),
				itemSelector = '.isotope-item',
				columnWidth = '.isotope-item-sizer',
				filter = $this.data( 'filter' );

			$this.addClass( 'active' ).siblings().removeClass( 'active' );
				
			$selector.isotope({
				itemSelector: itemSelector,
				percentPosition: true,
				filter: filter,
				masonry: {
					columnWidth: columnWidth,
				}
			});

			$selector.imagesLoaded().progress( function() {
				$selector.isotope( 'layout' );
			});

		});


		/* -----------------------------------------------------------------------------------------------------
		 * Swiper Slider
		 * ----------------------------------------------------------------------------------------------------- */

		carousel( '.swiper-container' );


		/* -----------------------------------------------------------------------------------------------------
		 * Image Compare
		 * ----------------------------------------------------------------------------------------------------- */

		if( $( '.image-compare' ).length ) {
			imageCompare( '.image-compare' );
		}		
		

		/* -----------------------------------------------------------------------------------------------------
		 * Magnific Popup
		 * ----------------------------------------------------------------------------------------------------- */

		if( $( '.magnify-image' ).length ) {
			$( '.magnify-image' ).magnificPopup({
				type: 'image',
				autoFocusLast: false,
				image: {
					titleSrc: function( item ) {
						return item.el.data( 'caption' );
					}
				}
			});
		}

		if( $( '.magnify-gallery' ).length ) {
			$( '.magnify-gallery' ).magnificPopup({
				delegate: 'a',
				type: 'image',
				gallery: {
					enabled: true,
					navigateByImgClick: true
				}
			});
		}

		if( $( '.magnify-video' ).length ) {
			$( '.magnify-video' ).magnificPopup({
				disableOn: 700,
				type: 'iframe',
				mainClass: 'mfp-fade',
				removalDelay: 160,
				preloader: false,
				fixedContentPos: false
			});
		}		
		

		/* -----------------------------------------------------------------------------------------------------
		 * Compare Products
		 * ----------------------------------------------------------------------------------------------------- */

		if( $( '.octagon-compare-product' ).length ) {

			$( '.post-wrapper, .product-quick-view, .recent-products' ).on( 'click', '.octagon-compare-product', function (e) {

				e.preventDefault();

				compareProducts( $( this ) );

			});

		}

		/* -----------------------------------------------------------------------------------------------------
		 * Remove Compare Products
		 * ----------------------------------------------------------------------------------------------------- */

		if( $( '.remove-compare-list' ).length ) {

			$( '.compare-products-table' ).on( 'click', '.remove-compare-list', function (e) {

				e.preventDefault();

				removeCompareProducts( $( this ) );

			});

		}



		/* -----------------------------------------------------------------------------------------------------
		 * Wishlist
		 * ----------------------------------------------------------------------------------------------------- */

		if( $( '.octagon-wishlist' ).length ) {

			$( '.post-wrapper, .product-quick-view, .recent-products, .products-grid' ).on( 'click', '.octagon-wishlist', function (e) {

				e.preventDefault();

				wishlist( $( this ) );

			});

		}

		/* -----------------------------------------------------------------------------------------------------
		 * Wishlist
		 * ----------------------------------------------------------------------------------------------------- */

		if( $( '.remove-wishlist' ).length ) {

			$( '.remove-wishlist' ).on( 'click', function (e) {

				e.preventDefault();

				removeWishlist( $( this ) );

			});

		}


		/* -----------------------------------------------------------------------------------------------------
		 * Quick View
		 * ----------------------------------------------------------------------------------------------------- */

		if( $( '.octagon-quick-view' ).length ) {

			$( '.post-wrapper, .recent-products' ).on('click', '.octagon-quick-view', function (e) {

				e.preventDefault();

				quickView( $( this ) );

			});

		}


		/* -----------------------------------------------------------------------------------------------------
		 * Remove Quick View
		 * ----------------------------------------------------------------------------------------------------- */

		$( 'body' ).on( 'click', '.quick-view-close', function (e) {

			e.preventDefault();

			resetDialog();

		});


		/* -----------------------------------------------------------------------------------------------------
		 * Login Form
		 * ----------------------------------------------------------------------------------------------------- */

		$( '.form-login' ).on( 'submit', function (e) {
			e.preventDefault();

			var $this = $( this );

			login( $this );

		});


		/* -----------------------------------------------------------------------------------------------------
		 * Lost Password Form
		 * ----------------------------------------------------------------------------------------------------- */

		$( '.form-lost-password' ).on( 'submit', function (e) {
			e.preventDefault();

			var $this = $( this );

			lostPassword( $this );

		});


		/* -----------------------------------------------------------------------------------------------------
		 * Reset Password Form
		 * ----------------------------------------------------------------------------------------------------- */

		$( '.form-reset-password' ).on( 'submit', function (e) {
			e.preventDefault();

			var $this = $( this );

			resetPassword( $this );

		});


		/* -----------------------------------------------------------------------------------------------------
		 * Register Form
		 * ----------------------------------------------------------------------------------------------------- */

		$( '.form-register' ).on( 'submit', function (e) {
			e.preventDefault();

			var $this = $( this );

			register( $this );

		});


		/* -----------------------------------------------------------------------------------------------------
		 * Profile Form
		 * ----------------------------------------------------------------------------------------------------- */

		$( '.form-profile' ).on( 'submit', function (e) {
			e.preventDefault();

			var $this = $( this );

			updateProfile( $this );

		});


		/* -----------------------------------------------------------------------------------------------------
		 * AJAX Search
		 * ----------------------------------------------------------------------------------------------------- */

		$( '.ajax-product-search' ).on( 'keyup', '.search-field', function(e) {
			e.preventDefault();

			var $this = $( this );

			setTimeout(function() {
				productSearch( $this );
			}, 300 );

		});
		

	});



	/* ---------------------------------------------------------------------------------------------------------
	 *
	 * $( window ).load()
	 *
	 * --------------------------------------------------------------------------------------------------------- */

	$( window ).on( 'load', function(){
		

		/* -----------------------------------------------------------------------------------------------------
		 * Loadmore
		 * ----------------------------------------------------------------------------------------------------- */

		$( '.btn-loadmore' ).on( 'click', 'a', function(e) {
    		e.preventDefault();

    		var $this = $( this ),
    			$btn = $this.closest( '.btn-loadmore' ),
    			type = $btn.data( 'type' );

    		if( ! $btn.find( 'a' ).hasClass( 'loading' ) ) {
    			if( 'query' == type ) {
	    			queryLoadMore( $this );
	    		}
	    		else {
	    			pageLoadMore( $this );
	    		}
    		}    		
    		
    	});

	});



	/* ---------------------------------------------------------------------------------------------------------
	 *
	 * $( window ).on( 'scroll' )
	 *
	 * --------------------------------------------------------------------------------------------------------- */

	var timer;

	$( window ).on( 'scroll', function(){

		var currentScrollPos = $( this ).height() + $( this ).scrollTop();

		/* -----------------------------------------------------------------------------------------------------
		 * Infinite Scroll
		 * ----------------------------------------------------------------------------------------------------- */

		if( $( '.infinite-scroll' ).length ) {

			var $this = $( '.infinite-scroll a' ),
    			$btn = $this.closest( '.infinite-scroll' ),
    			type = $btn.data( 'type' ),
    			targetOffset = $btn.offset().top;

			if( currentScrollPos > targetOffset ) {	    

	    		if( ! $btn.find( 'a' ).hasClass( 'loading' ) ) {
	    			if( 'query' == type ) {
		    			queryLoadMore( $this );
		    		}
		    		else {
		    			pageLoadMore( $this );
		    		}
	    		}

			}
		}

		/* -----------------------------------------------------------------------------------------------------
		 * Triggers on scroll stops
		 * ----------------------------------------------------------------------------------------------------- */

		clearTimeout( timer );

		timer = setTimeout(function() {
			$(window).trigger( 'scrollStop' );
		}, 60 );
		

	});

})(jQuery);
