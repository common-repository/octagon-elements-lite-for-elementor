## Changelog

### 1.4 - May 30 2020

* Element - "Gallery Block" element added.
* Tweak - Removed `octagon_make_class()` and `octagon_trim()`, added `octagon_change_case()`.
* Tweak - Removed `octagon_builder_exists()`.
* Dev - Filter introduced `octagon_allow_adaptive_images` to allow image srcset on cropped images.
* Dev - Filter introduced `octagon_get_placeholder_image_src` to set a default placeholder image src.

#### Files Change:

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

#### Files Added:

* ../assets/less/shortcodes/gallery-block.less
* ../core/library/js/shuffle.min.js
* ../modules/gallery-block.php
* ../shortcodes/gallery-block.php


### 1.3 - May 26 2020

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

#### Files Change:

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

#### Files Added:

* ../core/library/css/image-compare-viewer.min.css
* ../core/library/js/image-compare-viewer.min.js
* ../modules/image-compare.php
* ../shortcodes/image-compare.php

#### Files Removed:

* ../core/library/css/slick.min.css
* ../core/library/js/slick.min.js


### 1.2 - May 23 2020

* Template - "Login & Register Form" element template adjusted.
* Tweak - Online documentation and Support forum link changed in admin area header.
* Tweak - Change log link changed in welcome page.
* Tweak - Meta box tab menu width adjusted.
* Tweak - Unwanted "$options" and "$elements" variables removed in all "loadmore" ajax call functions.
* Fix - Icon picker switching icons pack "option" tag not rendered properly, because of `wp_kses` allowed html.
* Fix - Data validation and sanitization improved.
* Dev - Filter introduced `octagon_portfolio_general_meta_fields` to modify portfolio general fields.
* Dev - Filter introduced `octagon_portfolio_meta_fields_group` to modify portfolio tabs.
* Dev - Filter introduced `octagon_testimonial_general_meta_fields` to modify testimonial general fields.
* Dev - Filter introduced `octagon_testimonial_meta_fields_group` to modify testimonial tabs.
* Dev - Filter introduced `octagon_team_general_meta_fields` to modify team general fields.
* Dev - Filter introduced `octagon_team_social_meta_fields` to modify team social fields.
* Dev - Filter introduced `octagon_team_social_default_fields` to set the team social default repeatable field values.
* Dev - Filter introduced `octagon_team_meta_fields_group` to modify team tabs.

#### Files Change:

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


### 1.1 - May 21 2020

* Enhancement - Add "Style Section" for Notices on "Compare Products" element.
* Enhancement - Add "Style Section" for Notices on "Wishlist" element.
* Enhancement - Add "Style Section" for ( Excerpt, Client Name and Client Job ) on "Testimonial" element.
* Enhancement - Add "Content Section" for Load More on "Content Type" element.
* Enhancement - Add "Style Section" for ( Load More, Page Numbers, Next/Previous ) on "Content Type" element.
* Enhancement - Add "Content Section" for Load More on "Content Type List" element.
* Enhancement - Add "Style Section" for ( Load More, Page Numbers, Next/Previous ) on "Content Type List" element.
* Enhancement - Add "Content Section" for Load More on "Portfolio" element.
* Enhancement - Add "Style Section" for ( Load More, Page Numbers, Next/Previous ) on "Portfolio" element.
* Enhancement - Add "Content Section" for Load More on "Product" element.
* Enhancement - Add "Style Section" for ( Load More, Page Numbers, Next/Previous ) on "Product" element.
* Enhancement - Add "Style Section" for ( Title, Input and Button ) on "AJAX Product Search" element.
* Template - Few element templates updated( Compare products, Content type, Content type list, Portfolio, Products, Wishlist ).
* Tweak - Removed "$wrapper_attr[]" in /shortcodes/compare-products.php and change into elementor function `get_render_attribute_string()`.
* Tweak - Dynamic CSS file updated.
* Fix - Gradient palette style not applies in Advance Button, when "From Gradient Palette" option used.
* Fix - "Icon Position" and "Only Icon" not shown in "Image Box" element.
* Fix - Number pagination CSS style corrected.
* Localization - Translations strings updated.

#### Files Change:

* ../core/assets/css/gradient-palette.css
* ../core/assets/css/octagon.css
* ../core/class-enqueue-scripts.php
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


### 1.0 - May 20 2020

* Info - Initial Release.


[See changelog for all versions](https://docs.octagonwebstudio.com/elementor-elements/change-logs/).
