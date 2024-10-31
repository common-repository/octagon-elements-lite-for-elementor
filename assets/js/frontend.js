/*!
 * Elementor Frontend Scripts v1.4
 *
 * To load the JS framework callable scripts for elementor front end.
 * @see https://code.elementor.com/js-hooks/
 * 
 * Copyright (c) 2020 octagon web studio
 * 
 */

(function($){

    "use strict";


    /* ---------------------------------------------------------------------------------------------------------
	 *
	 * Global Fuctions
	 *
	 * --------------------------------------------------------------------------------------------------------- */


	/* ---------------------------------------------------------------------------------------------------------
	 * Swiper Slider
	------------------------------------------------------------------------------------------------------------ */

	var carousel = function( $slider ) {

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
				'touchMove'      : $this.data( 'touch-move' ),
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

	};



    /* ---------------------------------------------------------------------------------------------------------
	 *
	 * Handler Classes
	 *
	 * --------------------------------------------------------------------------------------------------------- */


	/* ---------------------------------------------------------------------------------------------------------
	 * Advance Counter
	------------------------------------------------------------------------------------------------------------ */

    class OEE_AdvanceCounterClass extends elementorModules.frontend.handlers.Base {
	    getDefaultSettings() {
			return {
				selectors: {
					number: '.counter .number',
				},
			};
		}

		getDefaultElements() {
			const selectors = this.getSettings( 'selectors' );
			return {
				$number: this.$element.find( selectors.number ),
			};
		}

		onInit() {
			super.onInit();

			this.elements.$number.countimator();
		}
	}

	/* ---------------------------------------------------------------------------------------------------------
	 * Gallery Block
	------------------------------------------------------------------------------------------------------------ */

    class OEE_GalleryBlockClass extends elementorModules.frontend.handlers.Base {

		onInit() {
			super.onInit();

			shuffle( '.block-module' );
		}
	}

	/* ---------------------------------------------------------------------------------------------------------
	 * Content Type
	------------------------------------------------------------------------------------------------------------ */

    class OEE_contentTypeClass extends elementorModules.frontend.handlers.Base {
	    getDefaultSettings() {
			return {
				selectors: {
					container: '.masonry .post-loop:not(.no-isotope)',
					itemSelector: '.isotope-item',
					columnWidth: '.isotope-item-sizer'
				},
			};
		}

		getDefaultElements() {
			const selectors = this.getSettings( 'selectors' );
			return {
				$container: this.$element.find( selectors.container ),
			};
		}

		onInit() {

			const selectors = this.getSettings( 'selectors' );

			super.onInit();

			this.elements.$container.isotope({
				itemSelector: selectors.itemSelector,
				percentPosition: true,
				masonry: {
					columnWidth: selectors.columnWidth,
				}
			});
		}
	}


	/* ---------------------------------------------------------------------------------------------------------
	 * Content Type Slider
	------------------------------------------------------------------------------------------------------------ */

    class OEE_contentTypeSliderClass extends elementorModules.frontend.handlers.Base {

		onInit() {
			super.onInit();

			carousel( '.swiper-container' );
		}
	}


	/* ---------------------------------------------------------------------------------------------------------
	 * Portfolio Slider
	------------------------------------------------------------------------------------------------------------ */

    class OEE_portfolioSliderClass extends elementorModules.frontend.handlers.Base {

		onInit() {
			super.onInit();

			carousel( '.swiper-container' );
		}
	}


	/* ---------------------------------------------------------------------------------------------------------
	 * Portfolio Extend Slider
	------------------------------------------------------------------------------------------------------------ */

    class OEE_portfolioExtendSliderClass extends elementorModules.frontend.handlers.Base {

		onInit() {
			super.onInit();

			carousel( '.swiper-container' );
		}
	}


	/* ---------------------------------------------------------------------------------------------------------
	 * Team Slider
	------------------------------------------------------------------------------------------------------------ */

    class OEE_teamSliderClass extends elementorModules.frontend.handlers.Base {

		onInit() {
			super.onInit();

			carousel( '.swiper-container' );
		}
	}


	/* ---------------------------------------------------------------------------------------------------------
	 * Products Slider
	------------------------------------------------------------------------------------------------------------ */

    class OEE_productsSliderClass extends elementorModules.frontend.handlers.Base {

		onInit() {
			super.onInit();

			carousel( '.swiper-container' );
		}
	}


	/* ---------------------------------------------------------------------------------------------------------
	 * Compare Products
	------------------------------------------------------------------------------------------------------------ */

    class OEE_compareProductsClass extends elementorModules.frontend.handlers.Base {

		onInit() {
			super.onInit();

			carousel( '.swiper-container' );
		}
	}


	/* ---------------------------------------------------------------------------------------------------------
	 * Video Popup
	------------------------------------------------------------------------------------------------------------ */

    class OEE_videoPopupClass extends elementorModules.frontend.handlers.Base {
	    getDefaultSettings() {
			return {
				selectors: {
					container: '.magnify-video',
				},
			};
		}

		getDefaultElements() {
			const selectors = this.getSettings( 'selectors' );
			return {
				$container: this.$element.find( selectors.container ),
			};
		}

		onInit() {
			super.onInit();

			this.elements.$container.magnificPopup({
				disableOn: 700,
				type: 'iframe',
				mainClass: 'mfp-fade',
				removalDelay: 160,
				preloader: false,
				fixedContentPos: false
			});
		}
	}



	/* ---------------------------------------------------------------------------------------------------------
	 *
	 * Handler Events
	 *
	 * --------------------------------------------------------------------------------------------------------- */

	$( window ).on( 'elementor/frontend/init', () => {


		/* -----------------------------------------------------------------------------------------------------
		 * Advance Counter
		 * ----------------------------------------------------------------------------------------------------- */

		const advanceCounterHandler = ( $element ) => {
			elementorFrontend.elementsHandler.addHandler( OEE_AdvanceCounterClass, {
				$element,
			} );
		};

		elementorFrontend.hooks.addAction( 'frontend/element_ready/oee_advance_counter.default', advanceCounterHandler );


		/* -----------------------------------------------------------------------------------------------------
		 * Gallery Block
		 * ----------------------------------------------------------------------------------------------------- */

		const galleryBlockHandler = ( $element ) => {
			elementorFrontend.elementsHandler.addHandler( OEE_GalleryBlockClass, {
				$element,
			} );
		};

		elementorFrontend.hooks.addAction( 'frontend/element_ready/oee_gallery_block.default', galleryBlockHandler );


		/* -----------------------------------------------------------------------------------------------------
		 * Content Type
		 * ----------------------------------------------------------------------------------------------------- */

		const contentTypeHandler = ( $element ) => {
			elementorFrontend.elementsHandler.addHandler( OEE_contentTypeClass, {
				$element,
			} );
		};

		elementorFrontend.hooks.addAction( 'frontend/element_ready/oee_content_type.default', contentTypeHandler );


		/* -----------------------------------------------------------------------------------------------------
		 * Content Type Slider
		 * ----------------------------------------------------------------------------------------------------- */

		const contentTypeSliderHandler = ( $element ) => {
			elementorFrontend.elementsHandler.addHandler( OEE_contentTypeSliderClass, {
				$element,
			} );
		};

		elementorFrontend.hooks.addAction( 'frontend/element_ready/oee_content_type_slider.default', contentTypeSliderHandler );


		/* -----------------------------------------------------------------------------------------------------
		 * Portfolio Slider
		 * ----------------------------------------------------------------------------------------------------- */

		const portfolioSliderHandler = ( $element ) => {
			elementorFrontend.elementsHandler.addHandler( OEE_portfolioSliderClass, {
				$element,
			} );
		};

		elementorFrontend.hooks.addAction( 'frontend/element_ready/oee_portfolio_slider.default', portfolioSliderHandler );


		/* -----------------------------------------------------------------------------------------------------
		 * Portfolio Extend Slider
		 * ----------------------------------------------------------------------------------------------------- */

		const portfolioExtendSliderHandler = ( $element ) => {
			elementorFrontend.elementsHandler.addHandler( OEE_portfolioExtendSliderClass, {
				$element,
			} );
		};

		elementorFrontend.hooks.addAction( 'frontend/element_ready/oee_portfolio_extend_slider.default', portfolioExtendSliderHandler );


		/* -----------------------------------------------------------------------------------------------------
		 * Team Slider
		 * ----------------------------------------------------------------------------------------------------- */

		const teamSliderHandler = ( $element ) => {
			elementorFrontend.elementsHandler.addHandler( OEE_teamSliderClass, {
				$element,
			} );
		};

		elementorFrontend.hooks.addAction( 'frontend/element_ready/oee_team_slider.default', teamSliderHandler );


		/* -----------------------------------------------------------------------------------------------------
		 * Products Slider
		 * ----------------------------------------------------------------------------------------------------- */

		const productsSliderHandler = ( $element ) => {
			elementorFrontend.elementsHandler.addHandler( OEE_productsSliderClass, {
				$element,
			} );
		};

		elementorFrontend.hooks.addAction( 'frontend/element_ready/oee_products_slider.default', productsSliderHandler );


		/* -----------------------------------------------------------------------------------------------------
		 * Compare Products
		 * ----------------------------------------------------------------------------------------------------- */

		const compareProductsHandler = ( $element ) => {
			elementorFrontend.elementsHandler.addHandler( OEE_compareProductsClass, {
				$element,
			} );
		};

		elementorFrontend.hooks.addAction( 'frontend/element_ready/oee_compare_products.default', compareProductsHandler );


		/* -----------------------------------------------------------------------------------------------------
		 * Video Popup
		 * ----------------------------------------------------------------------------------------------------- */

		const videoPopupHandler = ( $element ) => {
			elementorFrontend.elementsHandler.addHandler( OEE_videoPopupClass, {
				$element,
			} );
		};

		elementorFrontend.hooks.addAction( 'frontend/element_ready/oee_video_popup.default', videoPopupHandler );

	} );

})(jQuery);
