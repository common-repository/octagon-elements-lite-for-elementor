/*!
 * Custom Sidebar v1.1
 *
 * 
 * Copyright (c) 2020 octagon web studio
 *
 */

(function( $, window, document, undefined ) {

	var octagonCustomSidebar = {
		init: function () {

			this.sidebarName = undefined;
			this.sidebarId = undefined;
			
			this.cacheDom();
			this.bindEvents();
		},
		cacheDom: function() {
			this.$form = $( '.add-sidebar-form' );
			this.$input = $( 'input.custom_sidebar' );
			this.$sidebarListsWrap = $( '.sidebar-lists' );
			this.$sidebarLists = $( '.custom-sidebar ul' );
		},
		bindEvents: function() {
			this.$form.on( 'click', '.add_custom_sidebar', this.addCustomSidebar );
			this.$sidebarListsWrap.on( 'click', '.remove_custom_sidebar', this.removeCustomSidebar );
		},
		addCustomSidebar: function() {

			var self = octagonCustomSidebar,
				$this = $( this );

			self.sidebarName = self.$input.val();

			$this.addClass( 'loading' );

			$.ajax({
				type: "POST",
				url: octagon_core_obj.ajaxurl,
				data: {
					'action' : 'add_custom_sidebar',
					'sidebar_name' : self.sidebarName
				},
			}).done(function( result ) {
				self.renderSidebars( result );
				$this.removeClass( 'loading' );
			});
		},
		removeCustomSidebar: function() {

			var self = octagonCustomSidebar,
				$this = $( this );

			self.sidebarId = $( this ).data( 'sidebar-id' );

			$this.addClass( 'loading' );

			$.ajax({
				type: "POST",
				url: octagon_core_obj.ajaxurl,
				data: {
					'action' : 'remove_custom_sidebar',
					'sidebar_id' : self.sidebarId
				},
			}).done(function( result ) {
				self.renderSidebars( result );
				$this.removeClass( 'loading' );
			});
		},
		renderSidebars: function( result ) {

			var self = octagonCustomSidebar;

			var $result = $( result ),
				$list = $result.find( 'ul' ).html();

			self.$sidebarLists.html( $list );
			self.$input.val( '' );
		}

	};

	octagonCustomSidebar.init();

})( jQuery, window, document );