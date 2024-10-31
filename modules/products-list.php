<?php

/**
 * Products List
 *
 * @package octagon-elements-lite-for-elementor/modules
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.0
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Core\Schemes\Typography as Schemes_Typography;
use \Elementor\Core\Schemes\Color as Schemes_Color;

class OEE_Products_List_Module extends OEE_Widget_Base {

	/**
	 * Get element name.
	 *
	 * @version  1.0 
	 * @since 1.0
	 * @access public
	 * @return string
	 */
	public function get_name() {
		return 'oee_products_list';
	}

	/**
	 * Get element title.
	 *
	 * @version  1.0 
	 * @since 1.0
	 * @access public
	 * @return string
	 */
	public function get_title() {
		return esc_html__( 'Products List', 'octagon-elements-lite-for-elementor' );
	}

	/**
	 * Get element icon.
	 *
	 * @version  1.0 
	 * @since 1.0
	 * @access public
	 * @return string
	 */
	public function get_icon() {
		return 'oee-products';
	}

	/**
	 * Get element categories belongs to.
	 *
	 * @version  1.0 
	 * @since 1.0
	 * @access public
	 * @return array
	 */
	public function get_categories() {
		return [ 'octagon' ];
	}	

	/**
	 * Get style dependencies.
	 *
	 * Retrieve the list of style dependencies the element requires.
	 * 
	 * @version  1.0 
	 * @since 1.0
	 * @access public
	 * @return array
	 */
	public function get_style_depends() {
		return [ 'oee-products-list' ];
	}

	/**
	 * Register element controls.
	 * 
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @version  1.0 
	 * @since 1.0
	 * @access protected
	 */
	protected function _register_controls() {


		/* ---------------------------------------------------------------------------
		 * Section: Content
		------------------------------------------------------------------------------ */

		/* Content Inner Section: Content -------------------------------------------- */

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'octagon-elements-lite-for-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT
			]
		);

		$this->add_control(
			'style',
			[
				'label'   => esc_html__( 'Style', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [
					'style1' => esc_html__( 'Style 1', 'octagon-elements-lite-for-elementor' )
				],
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'   => esc_html__( 'Title Tag', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h3',
				'options' => $this->get_array( 'title_tag' )
			]
		);

		$this->add_control(
			'show_thumb',
			[
				'label'   => esc_html__( 'Show Thumbnail?', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'show',
				'options' => $this->get_array( 'show' )
			]
		);

		$this->add_control(
			'ex_class',
			[
				'label'       => esc_html__( 'Extra Class', 'octagon-elements-lite-for-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'input_type'  => 'text'
			]
		);

		$this->end_controls_section();


		/* Content Inner Section: Query ---------------------------------------------- */

		$this->start_controls_section(
			'query_section',
			[
				'label' => esc_html__( 'Query', 'octagon-elements-lite-for-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT
			]
		);

		$this->add_control(
			'method',
			[
				'label'   => esc_html__( 'Method', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default'      => esc_html__( 'Default', 'octagon-elements-lite-for-elementor' ),
					'id'           => esc_html__( 'ID', 'octagon-elements-lite-for-elementor' ),
					'terms'        => esc_html__( 'Terms', 'octagon-elements-lite-for-elementor' ),
					'author'       => esc_html__( 'Author', 'octagon-elements-lite-for-elementor' ),
					'featured'     => esc_html__( 'Featured', 'octagon-elements-lite-for-elementor' ),
					'not_featured' => esc_html__( 'Not Featured', 'octagon-elements-lite-for-elementor' ),
					'on_sale'      => esc_html__( 'On Sale', 'octagon-elements-lite-for-elementor' ),
					'best_selling' => esc_html__( 'Best Selling', 'octagon-elements-lite-for-elementor' )
				]
			]
		);

		$this->add_control(
			'order',
			[
				'label'   => esc_html__( 'Order', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'desc',
				'options' => $this->get_array( 'order' )
			]
		);

		$this->add_control(
			'orderby',
			[
				'label'   => esc_html__( 'Orderby', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => $this->get_array( 'orderby' )
			]
		);

		$this->add_control(
			'limit',
			[
				'label'   => esc_html__( 'Limit', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::NUMBER,
				'min' => -1,
				'max' => 20,
				'step' => 1,
				'default' => 3
			]
		);

		$this->add_control(
			'post_in',
			[
				'label'       => esc_html__( 'ID', 'octagon-elements-lite-for-elementor' ),
				'description' => esc_html__( 'Type the id (integer), Explode it with commas.', 'octagon-elements-lite-for-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'input_type'  => 'text',
				'condition' => [
					'method' => 'id'
				]
			]
		);

		$this->add_control(
			'terms_in',
			[
				'label'       => esc_html__( 'Terms', 'octagon-elements-lite-for-elementor' ),
				'description' => esc_html__( 'Type the terms slug, Explode it with commas.', 'octagon-elements-lite-for-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'input_type'  => 'text',
				'condition' => [
					'method' => 'terms'
				]
			]
		);

		$this->add_control(
			'author_in',
			[
				'label'       => esc_html__( 'Author', 'octagon-elements-lite-for-elementor' ),
				'description' => esc_html__( 'Type the author username, Explode it with commas.', 'octagon-elements-lite-for-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'input_type'  => 'text',
				'condition' => [
					'method' => 'author'
				]
			]
		);

		$this->add_control(
			'post_not_in',
			[
				'label'       => esc_html__( 'Exclude ID', 'octagon-elements-lite-for-elementor' ),
				'description' => esc_html__( 'Type the id (integer), Explode it with commas.', 'octagon-elements-lite-for-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'input_type'  => 'text'
			]
		);

		$this->add_control(
			'terms_not_in',
			[
				'label'       => esc_html__( 'Exclude Terms', 'octagon-elements-lite-for-elementor' ),
				'description' => esc_html__( 'Type the terms slug, Explode it with commas.', 'octagon-elements-lite-for-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'input_type'  => 'text'
			]
		);

		$this->add_control(
			'author_not_in',
			[
				'label'       => esc_html__( 'Exclude Author', 'octagon-elements-lite-for-elementor' ),
				'description' => esc_html__( 'Type the author username, Explode it with commas.', 'octagon-elements-lite-for-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'input_type'  => 'text'
			]
		);

		$this->add_control(
			'offset',
			[
				'label'   => esc_html__( 'Offset Count', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::NUMBER
			]
		);

		$this->end_controls_section();


		/* ---------------------------------------------------------------------------
		 * Section: Style
		------------------------------------------------------------------------------ */

		/* Style Inner Section: Title ------------------------------------------------ */

		$this->start_controls_section(
			'section_style_title',
			[
				'label' => esc_html__( 'Title', 'octagon-elements-lite-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .title a'
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Color', 'octagon-elements-lite-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Schemes_Color::get_type(),
					'value' => Schemes_Color::COLOR_1
				],
				'selectors' => [
					'{{WRAPPER}} .title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_margin',
			[
				'label'      => esc_html__( 'Margin', 'elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'title_padding',
			[
				'label'      => esc_html__( 'Padding', 'elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .title a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'title_text_shadow',
				'selector' => '{{WRAPPER}} .title a'
			]
		);

		$this->end_controls_section();


		/* Style Inner Section: Price ------------------------------------------------ */

		$this->start_controls_section(
			'section_style_price',
			[
				'label' => esc_html__( 'Price', 'octagon-elements-lite-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'price_typography',
				'selector' => '{{WRAPPER}} .price'
			]
		);

		$this->add_control(
			'price_color',
			[
				'label'     => esc_html__( 'Color', 'octagon-elements-lite-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Schemes_Color::get_type(),
					'value' => Schemes_Color::COLOR_3
				],
				'selectors' => [
					'{{WRAPPER}} .price' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'price_margin',
			[
				'label'      => esc_html__( 'Margin', 'elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'price_padding',
			[
				'label'      => esc_html__( 'Padding', 'elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'price_text_shadow',
				'selector' => '{{WRAPPER}} .price'
			]
		);

		$this->end_controls_section();


		/* Style Inner Section: Cart Button ------------------------------------------ */
		
		$this->start_controls_section(
			'section_style_cart_button',
			[
				'label' => esc_html__( 'Cart Button', 'octagon-elements-lite-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'cart_btn_typography',
				'selector' => '{{WRAPPER}} .button'
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'cart_btn_shadow',
				'selector' => '{{WRAPPER}} .button'
			]
		);

		$this->add_responsive_control(
			'cart_btn_padding',
			[
				'label'      => esc_html__( 'Padding', 'elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after'
			]
		);

		$this->add_responsive_control(
			'cart_btn_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_cart_button_style' );

		$this->start_controls_tab(
			'tab_cart_button_normal',
			[
				'label' => esc_html__( 'Normal', 'octagon-elements-lite-for-elementor' ),
			]
		);

		$this->add_control(
			'cart_btn_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'octagon-elements-lite-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .button' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'cart_btn_background_color',
			[
				'label'     => esc_html__( 'Background Color', 'octagon-elements-lite-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'cart_btn_border_color',
			[
				'label'     => esc_html__( 'Border Color', 'octagon-elements-lite-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .button' => 'border: 1px solid {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'cart_btn_box_shadow',
				'selector' => '{{WRAPPER}} .button',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_cart_button_hover',
			[
				'label' => esc_html__( 'Hover', 'octagon-elements-lite-for-elementor' )
			]
		);

		$this->add_control(
			'hover_cart_btn_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'octagon-elements-lite-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .button:hover, {{WRAPPER}} .button:focus' => 'color: {{VALUE}};',
					'{{WRAPPER}} .button:hover svg, {{WRAPPER}} .button:focus svg' => 'fill: {{VALUE}};'
				],
			]
		);

		$this->add_control(
			'hover_cart_btn_background_color',
			[
				'label'     => esc_html__( 'Background Color', 'octagon-elements-lite-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .button:hover, {{WRAPPER}} .button:focus' => 'background-color: {{VALUE}};'
				],
			]
		);

		$this->add_control(
			'hover_cart_btn_border_color',
			[
				'label'     => esc_html__( 'Border Color', 'octagon-elements-lite-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .button:hover, {{WRAPPER}} .button:focus' => 'border-color: {{VALUE}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'hover_cart_btn_box_shadow',
				'selector' => '{{WRAPPER}} .button:hover, {{WRAPPER}} .button:focus'
			]
		);

		$this->add_control(
			'hover_cart_btn_animation',
			[
				'label' => esc_html__( 'Hover Animation', 'octagon-elements-lite-for-elementor' ),
				'type'  => Controls_Manager::HOVER_ANIMATION
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

	}

	/**
	 * Set render attributes.
	 * 
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @version  1.0 
	 * @since 1.0
	 * @access protected
	 */
	protected function set_render_attributes() {

		/**
		 * Returns render attributes array based on {module}_render_attribute
		 *
		 * @version  1.0 
		 * @since 1.0
		 * 
		 */
		$attributes = apply_filters( 'oee_products_list_render_attribute', [] );
		

		// Add render attributes
		$this->add_render_attribute( $attributes );

		/**
		 * Render attributes based on {module}_render_attributes
		 *
		 * Fires before rendering elements content.
		 * 
		 * @version  1.0 
		 * @since 1.0
		 * 
		 */
		do_action( 'oee_products_list_render_attributes' );

	}

	/**
	 * Render widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 * 
	 * @version  1.0 
	 * @since 1.0
	 * @access protected
	 */
	protected function render() {

		$this->set_render_attributes();
		$this->get_query();

		echo oee_get_shortcode_template( 'products-list', $this );

	}

	/**
	 * Returns WP Query arguemnts
	 * 
	 * @version 1.0
	 * @since  1.0
	 * @return array
	 */
	public function get_query() {

		$settings = $this->get_settings_for_display();

		$method        = $settings['method'] ?? 'default';
		$limit         = $settings['limit'] ?? 6;
		$order         = $settings['order'] ?? 'desc';
		$orderby       = $settings['orderby'] ?? 'date';
		$post_in       = $settings['post_in'] ?? '';
		$terms_in      = $settings['terms_in'] ?? '';
		$author_in     = $settings['author_in'] ?? '';
		$post_not_in   = $settings['post_not_in'] ?? '';
		$terms_not_in  = $settings['terms_not_in'] ?? '';
		$author_not_in = $settings['author_not_in'] ?? '';
		$offset        = $settings['offset'] ?? '';

		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : ( ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1 );

		$args = array(
			'post_type'           => 'product',
			'ignore_sticky_posts' => true,
			'paged'               => $paged,
			'order'               => $order,
			'orderby'             => $orderby
		);

		if( 'id' != $method ) {
			$args['posts_per_page'] = $limit;
		}

		if( '' != $post_not_in ) {
			$post_not_in_array = explode( ',', $post_not_in );

			$args['post__not_in'] = $post_not_in_array;
		}

		if( '' != $offset ) {
			$args['offset'] = $offset;
		}

		if( '' != $terms_not_in ) {
			$terms_not_in_array = explode( ',', $terms_not_in );

			$args['tax_query'][] = array(
				'taxonomy' => 'product_cat',
				'field'    => 'slug',
				'terms'    => $terms_not_in_array,
				'operator' => 'NOT IN'
			);
		}

		if( '' != $author_not_in ) {
			$author_not_in_array = explode( ',', $author_not_in );

			foreach( $author_not_in_array as $key => $username ) {
				if ( username_exists( $username ) ) {
					$user_obj = get_user_by( 'login', $username );
					$user_not_in[] = $user_obj->ID;
				}
			}

			$args['author__not_in'] = $user_not_in;
		}

		if( '' != $post_in && 'id' == $method ) {
			$post_in_array = explode( ',', $post_in );

			$args['post__in'] = $post_in_array;
		}
		elseif( '' != $terms_in && 'terms' == $method ) {
			$terms_in_array = explode( ',', $terms_in );

			$args['tax_query'][] = array(
				'taxonomy' => 'product_cat',
				'field'    => 'slug',
				'terms'    => $terms_in_array
			);
		}
		elseif( '' != $author_in && 'author' == $method ) {
			$author_in_array = explode( ',', $author_in );

			foreach( $author_in_array as $key => $username ) {
				if ( username_exists( $username ) ) {
					$user_obj = get_user_by( 'login', $username );
					$user_in[] = $user_obj->ID;
				}					
			}

			$args['author__in'] = isset( $user_in ) ? $user_in : '';
		}
		elseif( 'featured' == $method ) {

			$product_visibility_term_ids = wc_get_product_visibility_term_ids();

			$args['tax_query'][] = array(
		        'taxonomy' => 'product_visibility',
				'field'    => 'term_taxonomy_id',
				'terms'    => array( $product_visibility_term_ids['featured'] )
		    );

		    $args['tax_query'][] = array(
				'taxonomy' => 'product_visibility',
				'field'    => 'term_taxonomy_id',
				'terms'    => array( $product_visibility_term_ids['exclude-from-catalog'] ),
				'operator' => 'NOT IN',
			);
		}
		elseif( 'not_featured' == $method ) {

			$product_visibility_term_ids = wc_get_product_visibility_term_ids();

			$args['tax_query'][] = array(
				'taxonomy' => 'product_visibility',
				'field'    => 'term_taxonomy_id',
				'terms'    => array( $product_visibility_term_ids['featured'] ),
				'operator' => 'NOT IN',
			);
		}			
		elseif( 'on_sale' == $method ) {
			$args['post__in'] = array_merge( array( 0 ), wc_get_product_ids_on_sale() );
		}			
		elseif( 'best_selling' == $method ) {
			$args['meta_key'] = 'total_sales';
			$args['order']    = 'DESC';
			$args['orderby']  = 'meta_value_num';
		}

		$this->args  = $args;

		return $this->args;

	}

}