=== Octagon Elements for Elementor ===
Contributors: octagonwebstudio
Tags: elementor, shortcodes, framework, toolkit, custom icons, mega menu
Requires at least: 5.0
Tested up to: 5.4
Requires PHP: 7.0
Stable tag: 1.4
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Tons of unique shortcodes elements addon for Elementor Page Builder.


== Description ==

Using 'Octagon Elements for Elementor' helps to create a page without touching any lines of code.

There are many other features to help you build better websites:

* Header and Footer Builder
* Icon Manager
* Custom Icon Import
* Mega Menu
* Template Overrides
* Register Custom Sidebar
* System Status
* Automatic CSS Generation
* Duplicate Post
* Taxonomy Image
* Custom Post Type Class
* Custom Meta Box Class
* And much more.

Included more than 30+ elements make developing a themes a lot faster for developers and meaningful for users.

Any doubts, Please check out our [Documentation](https://docs.octagonwebstudio.com/elementor-elements/)  
Look out our [Live Demos](https://addons.octagonwebstudio.com/elementor-elements/)  
Check out the full [changelogs](https://docs.octagonwebstudio.com/elementor-elements/change-logs/) here.  
Premium plugin available in [Codecanyon](https://codecanyon.net/item/octagon-elements-lite-for-elementor/26752840).  


= 15 free elements and counting =

- **Advance Button**. 10+ button styles with 30+ gradient palette feature.
- **Advance Counter**. Show stats and numbers in an escalating manner.
- **Gradient Text**. Add eye-catching headlines with 30+ gradient palette feature.
- **Icon Box**. Contain with icon, headline, text and button.
- **Info Icons**. Show icons and text in simple manner.
- **Cards**. Show icons and text like cards.
- **Timeline**. Show heading and texts in horizontal timeline view.
- **Video Popup**. Triggers HTML/Youtube/Vimeo in a Popup view.
- **Image Compare**. Before and After image comparison slide.
- **Gallery Block**. 15+ image grid and masonry blocks styles.
- **Social Icons**. Simple social icons group to mention social accounts links, and it has 5+ styles.
- **Content Type**. Show grid/masonry style blog posts with 4 types of paginations support.
- **Content Type List**. Show list style blog posts with 4 types of paginations support.
- **Content Type Slider**. Show grid/masonry style blog posts carousel.
- **Team Slider**. Show team members in grid view carousel.
- **Testimonial Slider**. Customer testimonials that show social proof.
- **Products List**. List style products depends on queries.
- **And counting...**

= 12 pro elements and counting =

- **Image Box**. Split one column with image and another with headline, text and button.
- **Image Mask**. Present the image in 10+ unique manner.
- **Login & Register Form**. Full AJAX login and register form.
- **Portfolio**. Show projects/works in grid/masonry view.
- **Portfolio Slider**. Show projects/works in grid/masonry view carousel.
- **Portfolio Extend Slider**. Show projects/works in full width carousel.
- **Team**. Show team members in grid view.
- **Products**. Show products in grid view.
- **Products Slider**. Show products in grid view carousel.
- **Compare Products**. Set of products details in table view.
- **Wishlist**. User can add/view the favourite products.
- **Ajax Product Search**. Enter atleast 3 letters to show products list via AJAX.
- **And counting...**


== Requirements ==

Simply install as a normal WordPress plugin and activate and it requires elementor page builder.

= Minimum Requirements =

* WordPress 5.0 or greater
* PHP version 7.0 or greater
* MySQL version 5.0 or greater

= We recommend your host supports: =

* WordPress Memory limit of 64 MB or greater ( 128 MB or higher is preferred )


== Installation ==

1. Install using the WordPress built-in Plugin installer, or Extract the zip file and drop the contents in the 'wp-content/plugins/' directory of your WordPress installation.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Go to Pages > Add New.
4. Press the 'Edit with Elementor' button.
5. New elements are added at the Elementor elements Menu Called "Octagon". Make sure you enabled the modules in "Octagon > Modules".


== Notes ==

* It requires Elementor Page Builder should be activated.


== Frequently Asked Questions ==

= Does it work with any WordPress theme? =

Yes, it will work with any WordPress theme as long as you are using Elementor as a page builder.

= Will this plugin slow down my website speed? =

Octagon Elements for Elementor is light weight and we also gave you the control to enable only the elements you actually use on your website for faster performance.

= Where can i find the new element added =

Edit the page with elementor, elements are added at the menu Called "Octagon". Make sure you enabled the modules in "Octagon > Modules".


== Screenshots ==

1. **Toggle Modules.** You can enable/disable the elements to improve performance.
2. **Icon Manager.** You can choose what are the icon fonts going to choose and import the custom icons zip archives.
3. **Mega Menu.** Easy way to create a mega menu up to 6 columns.
4. **Elements.** 30+ elements and counting.
5. **Custom Sidebar.** You can register custom widget area.
6. **System Status.** Check the site health.


== Changelog ==

= 1.4 - May 30 2020 =

* Element - "Gallery Block" element added.
* Tweak - Removed `octagon_make_class()` and `octagon_trim()`, added `octagon_change_case()`.
* Tweak - Removed `octagon_builder_exists()`.
* Dev - Filter introduced `octagon_allow_adaptive_images` to allow image srcset on cropped images.
* Dev - Filter introduced `octagon_get_placeholder_image_src` to set a default placeholder image src.

Files Change:

* ../assets/js/scripts.js
* ../assets/js/frontend.js
* ../core/assets/css/octagon.css
* ../core/class-enqueue-scripts.php
* ../core/helper-functions.php
* ../core/class-metabox.php
* ../core/icon-manager/class-icon-manager.php
* ../core/class-sidebar.php
* ../core/views/html-welcome.php
* ../includes/class-enqueue-scripts.php
* ../modules/initialize-elements.php

Files Added:

* ../assets/less/shortcodes/gallery-block.less
* ../core/library/js/shuffle.min.js
* ../modules/gallery-block.php
* ../shortcodes/gallery-block.php


= 1.3 - May 26 2020 =

* Element - "Image Compare" element added.
* Template - Action `oee_content_type_loadmore` changed to `octagon_content_type_loadmore` in "Content Type" element.
* Template - Action `oee_content_type_list_loadmore` changed to `octagon_content_type_list_loadmore` in "Content Type List" element.
* Template - Action `oee_portfolio_loadmore` changed to `octagon_portfolio_loadmore` in "Portfolio" element.
* Template - Action `oee_products_loadmore` changed to `octagon_products_loadmore` in "Portfolio" element.
* Fix - Repeatable type in meta box class raise error, when the value is empty.
* Fix - Select2 allow multiple in meta box class not saving when value is empty.
* Tweak - Add `taxonomy_exists()` check in `octagon_first_term()` to prevent non-object error.
* Tweak - Add `taxonomy_exists()` check in `octagon_all_consequence_term_slugs()` to prevent non-object error.
* Tweak - All ajax action prefix changed from "oee" to "octagon".
* Tweak - Slick JS library removed, since it's not used.
* Enhancement - Default "btn_size" value changed to "btn-size-mini" in "Content Type" and "Content Type Slider" element.

Files Change:

* ../assets/js/scripts.js
* ../core/assets/css/admin.css
* ../core/class-enqueue-scripts.php
* ../core/class-metabox.php
* ../core/helper-functions.php
* ../core/theme-functions.php
* ../core/views/html-icon-manager.php
* ../core/views/html-status.php
* ../core/views/html-welcome.php
* ../includes/helper-functions.php
* ../includes/class-ajax-calls.php
* ../modules/initialize-elements.php
* ../modules/content-type.php
* ../modules/content-type-slider.php
* ../shortcodes/content-type.php
* ../shortcodes/content-type-list.php
* ../shortcodes/content-type-slider.php
* ../shortcodes/portfolio.php
* ../shortcodes/products.php

Files Added:

* ../core/library/css/image-compare-viewer.min.css
* ../core/library/js/image-compare-viewer.min.js
* ../modules/image-compare.php
* ../shortcodes/image-compare.php

Files Removed:

* ../core/library/css/slick.min.css
* ../core/library/js/slick.min.js


= 1.2 - May 23 2020 =

* Template - 'Login & Register Form' element template adjusted.
* Tweak - Online documentation and Support forum link changed in admin area header.
* Tweak - Change log link changed in welcome page.
* Tweak - Meta box tab menu width adjusted.
* Tweak - Unwanted '$options' and '$elements' variables removed in all 'loadmore' ajax call functions.
* Fix - Icon picker switching icons pack 'option' tag not rendered properly, because of 'wp_kses' allowed html.
* Fix - Data validation and sanitization improved.
* Dev - Filter introduced 'octagon_portfolio_general_meta_fields' to modify portfolio general fields.
* Dev - Filter introduced 'octagon_portfolio_meta_fields_group' to modify portfolio tabs.
* Dev - Filter introduced 'octagon_testimonial_general_meta_fields' to modify testimonial general fields.
* Dev - Filter introduced 'octagon_testimonial_meta_fields_group' to modify testimonial tabs.
* Dev - Filter introduced 'octagon_team_general_meta_fields' to modify team general fields.
* Dev - Filter introduced 'octagon_team_social_meta_fields' to modify team social fields.
* Dev - Filter introduced 'octagon_team_social_default_fields' to set the team social default repeatable field values.
* Dev - Filter introduced 'octagon_team_meta_fields_group' to modify team tabs.

Files Change:
* ../core/assets/css/admin.css
* ../core/class-enqueue-scripts.php
* ../core/select2-data.php
* ../core/views/html-header.php
* ../core/views/html-welcome.php
* ../core/icon-manager/class-icon-manager.php
* ../includes/list-tables/class-admin-list-table-templates.php
* ../includes/list-tables/class-admin-list-table-testimonial.php
* ../includes/class-ajax-calls.php
* ../includes/init-meta-fields.php
* ../shortcodes/login-register-form.php


= 1.1 - May 21 2020 =

* Enhancement - Add 'Style Section' for Notices on 'Compare Products' element.
* Enhancement - Add 'Style Section' for Notices on 'Wishlist' element.
* Enhancement - Add 'Style Section' for ( Excerpt, Client Name and Client Job ) on 'Testimonial' element.
* Enhancement - Add 'Content Section' for Load More on 'Content Type' element.
* Enhancement - Add 'Style Section' for ( Load More, Page Numbers, Next/Previous ) on 'Content Type' element.
* Enhancement - Add 'Content Section' for Load More on 'Content Type List' element.
* Enhancement - Add 'Style Section' for ( Load More, Page Numbers, Next/Previous ) on 'Content Type List' element.
* Enhancement - Add 'Content Section' for Load More on 'Portfolio' element.
* Enhancement - Add 'Style Section' for ( Load More, Page Numbers, Next/Previous ) on 'Portfolio' element.
* Enhancement - Add 'Content Section' for Load More on 'Product' element.
* Enhancement - Add 'Style Section' for ( Load More, Page Numbers, Next/Previous ) on 'Product' element.
* Enhancement - Add 'Style Section' for ( Title, Input and Button ) on 'AJAX Product Search' element.
* Template - Few element templates updated( Compare products, Content type, Content type list, Portfolio, Products, Wishlist ).
* Tweak - Removed '$wrapper_attr[]' in /shortcodes/compare-products.php and change into elementor function 'get_render_attribute_string()'.
* Tweak - Dynamic CSS file updated.
* Fix - Gradient palette style not applies in Advance Button, when 'From Gradient Palette' option used.
* Fix - 'Icon Position' and 'Only Icon' not shown in 'Image Box' element.
* Fix - Number pagination CSS style corrected.
* Localization - Translations strings updated.

Files Change:
* ../core/assets/css/gradient-palette.css
* ../core/assets/css/octagon.css
* ../core/class-enqueue-scripts.php
* ../includes/custom-styles.php
* ../includes/class-enqueue-scripts.php
* ../includes/helper-functions.php
* ../modules/ajax-product-search.php
* ../modules/compare-products.php
* ../modules/content-type.php
* ../modules/content-type-list.php
* ../modules/image-box.php
* ../modules/portfolio.php
* ../modules/products.php
* ../modules/wishlist.php
* ../modules/testimonial-slider.php
* ../shortcodes/compare-products.php
* ../shortcodes/content-type.php
* ../shortcodes/content-type-list.php
* ../shortcodes/portfolio.php
* ../shortcodes/products.php
* ../shortcodes/wishlist.php
* ../languages/octagon-elements-lite-for-elementor.pot


= 1.0 - May 20 2020 =
* Info - Initial Release.