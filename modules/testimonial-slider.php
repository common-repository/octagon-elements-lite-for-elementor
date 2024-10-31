<?php

/**
 * Testimonial Slider
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
use \Elementor\Icons_Manager;
use \Elementor\Core\Schemes\Typography as Schemes_Typography;
use \Elementor\Core\Schemes\Color as Schemes_Color;

class OEE_Testimonial_Slider_Module extends OEE_Widget_Base {

	/**
	 * Get element name.
	 *
	 * @version  1.0 
	 * @since 1.0
	 * @access public
	 * @return string
	 */
	public function get_name() {
		return 'oee_testimonial_slider';
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
		return esc_html__( 'Testimonial Slider', 'octagon-elements-lite-for-elementor' );
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
		return 'oee-testimonial';
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
		return [ 'oee-testimonial-slider', 'oee-advance-button' ];
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
				'default' => 'classic',
				'options' => [
					'classic' => esc_html__( 'Classic', 'octagon-elements-lite-for-elementor' )
				],
			]
		);

		$this->add_control(
			'show_thumb',
			[
				'label'   => esc_html__( 'Show thumbnail?', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'show',
				'options' => $this->get_array( 'show' )
			]
		);

		$this->add_control(
			'show_name',
			[
				'label'   => esc_html__( 'Show client name?', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'show',
				'options' => $this->get_array( 'show' )
			]
		);

		$this->add_control(
			'show_job',
			[
				'label'   => esc_html__( 'Show client job?', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'show',
				'options' => $this->get_array( 'show' )
			]
		);

		$this->add_control(
			'show_rating',
			[
				'label'   => esc_html__( 'Show rating?', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'show',
				'options' => $this->get_array( 'show' )
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'   => esc_html__( 'Title Tag', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'p',
				'options' => $this->get_array( 'title_tag' )
			]
		);

		$this->add_control(
			'excerpt_limit',
			[
				'label'   => esc_html__( 'Excerpt Limit', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 30,
				'max'     => 400,
				'step'    => 10,
				'default' => 100
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
					'default' => esc_html__( 'Default', 'octagon-elements-lite-for-elementor' ),
					'id'      => esc_html__( 'ID', 'octagon-elements-lite-for-elementor' ),
					'rating'  => esc_html__( 'Rating', 'octagon-elements-lite-for-elementor' )
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
				'min'     => -1,
				'max'     => 20,
				'step'    => 1,
				'default' => 6
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
			'rating',
			[	
				'label'   => esc_html__( 'Rating', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '5',
				'options' => [
					'3+' => esc_html__( 'Above 3', 'octagon-elements-lite-for-elementor' ),
					'4+' => esc_html__( 'Above 4', 'octagon-elements-lite-for-elementor' ),
					'5'  => esc_html__( 'Only 5', 'octagon-elements-lite-for-elementor' )
				],
				'condition' => [
					'method' => 'rating'
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
			'offset',
			[
				'label' => esc_html__( 'Offset Count', 'octagon-elements-lite-for-elementor' ),
				'type'  => Controls_Manager::NUMBER
			]
		);

		$this->end_controls_section();


		/* Content Inner Section: Slider --------------------------------------------- */

		$this->start_controls_section(
			'slider_section',
			[
				'label' => esc_html__( 'Slider', 'octagon-elements-lite-for-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT
			]
		);

		$this->add_control(
			'slides_per_view',
			[
				'label'   => esc_html__( 'Slides Per View', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::NUMBER,
				'step'    => 1,
				'default' => 1
			]
		);

		$this->add_control(
			'loop',
			[
				'label'       => esc_html__( 'Loop', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'false',
				'options' => $this->get_array( 'true' )
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label'       => esc_html__( 'Autoplay', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => $this->get_array( 'true' )
			]
		);

		$this->add_control(
			'speed',
			[
				'label'   => esc_html__( 'Speed', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::NUMBER,
				'step'    => 1,
				'default' => 300
			]
		);

		$this->add_control(
			'auto_height',
			[	
				'label'       => esc_html__( 'Auto Height', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'false',
				'options' => $this->get_array( 'true' )
			]
		);

		$this->add_control(
			'direction',
			[	
				'label'       => esc_html__( 'Direction', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'horizontal',
				'options' => [
					'horizontal' => esc_html__( 'Horizontal', 'octagon-elements-lite-for-elementor' ),
					'vertical'   => esc_html__( 'Vertical', 'octagon-elements-lite-for-elementor' )
				],
			]
		);

		$this->add_control(
			'draggable',
			[	
				'label'       => esc_html__( 'Draggable', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => $this->get_array( 'true' )
			]
		);

		$this->add_control(
			'touch_move',
			[	
				'label'       => esc_html__( 'Touch Move', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => $this->get_array( 'true' )
			]
		);

		$this->add_control(
			'centered_slides',
			[	
				'label'       => esc_html__( 'Centered Slides', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'false',
				'options' => $this->get_array( 'true' )
			]
		);

		$this->add_control(
			'keyboard',
			[	
				'label'       => esc_html__( 'Keyboard', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'false',
				'options' => $this->get_array( 'true' )
			]
		);

		$this->add_control(
			'mousewheel',
			[	
				'label'       => esc_html__( 'Mouse Wheel', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'false',
				'options' => $this->get_array( 'true' )
			]
		);

		$this->add_control(
			'slider_pagination',
			[	
				'label'       => esc_html__( 'Pagination', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'show',
				'options' => $this->get_array( 'show' )
			]
		);

		$this->add_control(
			'slider_navigation',
			[	
				'label'       => esc_html__( 'Navigation', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'hide',
				'options' => $this->get_array( 'show' )
			]
		);

		$this->add_control(
			'effect',
			[	
				'label'       => esc_html__( 'Effect', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'slide',
				'options' => [
					'slide'     => esc_html__( 'Slide', 'octagon-elements-lite-for-elementor' ),
					'fade'      => esc_html__( 'Fade', 'octagon-elements-lite-for-elementor' ),
					'cube'      => esc_html__( 'Cube', 'octagon-elements-lite-for-elementor' ),
					'coverflow' => esc_html__( 'Coverflow', 'octagon-elements-lite-for-elementor' ),
					'flip'      => esc_html__( 'Flip', 'octagon-elements-lite-for-elementor' )
				],
			]
		);

		$this->add_control(
			'initial_slide',
			[
				'label'   => esc_html__( 'Initial Slide', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::NUMBER,
				'step'    => 1,
				'default' => 0
			]
		);

		$this->end_controls_section();


		/* ---------------------------------------------------------------------------
		 * Section: Style
		------------------------------------------------------------------------------ */

		/* Style Inner Section: Content ---------------------------------------------- */

		$this->start_controls_section(
			'section_style_content',
			[
				'label' => esc_html__( 'Content', 'octagon-elements-lite-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'content_typography',
				'selector' => '{{WRAPPER}} .excerpt'
			]
		);

		$this->add_control(
			'content_color',
			[
				'label'     => esc_html__( 'Color', 'octagon-elements-lite-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'scheme' => [
					'type'  => Schemes_Color::get_type(),
					'value' => Schemes_Color::COLOR_3
				],
				'selectors' => [
					'{{WRAPPER}} .excerpt' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label'      => esc_html__( 'Padding', 'elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .excerpt' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'content_text_shadow',
				'selector' => '{{WRAPPER}} .excerpt'
			]
		);

		$this->end_controls_section();


		/* Style Inner Section: Client Name ------------------------------------------ */

		$this->start_controls_section(
			'section_style_client_name',
			[
				'label' => esc_html__( 'Client Name', 'octagon-elements-lite-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'client_name_typography',
				'selector' => '{{WRAPPER}} .client-name'
			]
		);

		$this->add_control(
			'client_name_color',
			[
				'label'     => esc_html__( 'Color', 'octagon-elements-lite-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'scheme' => [
					'type'  => Schemes_Color::get_type(),
					'value' => Schemes_Color::COLOR_3
				],
				'selectors' => [
					'{{WRAPPER}} .client-name' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'client_name_padding',
			[
				'label'      => esc_html__( 'Padding', 'elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .client-name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'client_name_text_shadow',
				'selector' => '{{WRAPPER}} .client-name'
			]
		);

		$this->end_controls_section();


		/* Style Inner Section: Client Job ------------------------------------------- */

		$this->start_controls_section(
			'section_style_client_job',
			[
				'label' => esc_html__( 'Client Name', 'octagon-elements-lite-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'client_job_typography',
				'selector' => '{{WRAPPER}} .client-job'
			]
		);

		$this->add_control(
			'client_job_color',
			[
				'label'     => esc_html__( 'Color', 'octagon-elements-lite-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'scheme' => [
					'type'  => Schemes_Color::get_type(),
					'value' => Schemes_Color::COLOR_3
				],
				'selectors' => [
					'{{WRAPPER}} .client-job' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'client_job_padding',
			[
				'label'      => esc_html__( 'Padding', 'elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .client-job' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'client_job_text_shadow',
				'selector' => '{{WRAPPER}} .client-job'
			]
		);

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

		$settings = $this->get_settings_for_display();

		$attributes['wrapper']['class'][] = 'octagon-elements team loop-container';
		$attributes['wrapper']['class'][] = $settings['style'] ?? '';
		$attributes['wrapper']['class'][] = $settings['ex_class'] ?? '';

		/**
		 * Returns render attributes array based on {module}_render_attribute
		 *
		 * @version  1.0 
		 * @since 1.0
		 * 
		 */
		$attributes = apply_filters( 'oee_content_type_render_attribute', $attributes );
		

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
		do_action( 'oee_content_type_render_attributes' );

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

		echo oee_get_shortcode_template( 'testimonial-slider', $this );

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

		$method      = $settings['method'] ?? 'default';
		$limit       = $settings['limit'] ?? 6;
		$order       = $settings['order'] ?? 'desc';
		$orderby     = $settings['orderby'] ?? 'date';
		$post_in     = $settings['post_in'] ?? '';
		$post_not_in = $settings['post_not_in'] ?? '';
		$offset      = $settings['offset'] ?? '';
		$rating      = $settings['rating'] ?? '5';

		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : ( ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1 );

		$args = array(
			'post_type'           => 'octagon_testimonial',
			'ignore_sticky_posts' => true,
			'posts_per_page'      => $limit,
			'paged'               => $paged,
			'order'               => $order,
			'orderby'             => $orderby
		);

		if( '' != $post_not_in ) {
			$post_not_in_array = explode( ',', $post_not_in );

			$args['post__not_in'] = $post_not_in_array;
		}

		if( '' != $offset ) {
			$args['offset'] = $offset;
		}

		if( '' != $post_in && 'id' == $method ) {
			$post_in_array = explode( ',', $post_in );

			$args['post__in'] = $post_in_array;
		}
		elseif( 'rating' == $method ) {
			$args['meta_query'][] = array(
				'key'     => 'client_rating',
				'value'   => $rating,
				'compare' => '>='
			);
		}

		$this->args  = $args;

		return $this->args;

	}

	/**
	 * Returns slider data
	 * 
	 * @version 1.0
	 * @since  1.0
	 * @return array
	 */
	public function get_slider_data() {

		$settings = $this->get_settings_for_display();

		$slides_per_view = $settings['slides_per_view'] ?? 1;
		$loop            = $settings['loop'] ?? 'false';
		$autoplay        = $settings['autoplay'] ?? 'true';
		$speed           = $settings['speed'] ?? 300;
		$auto_height     = $settings['auto_height'] ?? 'false';
		$direction       = $settings['direction'] ?? 'horizontal';
		$draggable       = $settings['draggable'] ?? 'true';
		$touch_move      = $settings['touch_move'] ?? 'true';
		$centered_slides = $settings['centered_slides'] ?? 'false';
		$keyboard        = $settings['keyboard'] ?? 'false';
		$mousewheel      = $settings['mousewheel'] ?? 'false';
		$effect          = $settings['effect'] ?? 'slide';
		$initial_slide   = $settings['initial_slide'] ?? 0;

		$slider_data[] = 'data-slides-per-view="'. esc_attr( $slides_per_view ) .'"';
		$slider_data[] = 'data-loop="'. esc_attr( $loop ) .'"';
		$slider_data[] = 'data-autoplay="'. esc_attr( $autoplay ) .'"';
		$slider_data[] = 'data-speed="'. esc_attr( $speed ) .'"';
		$slider_data[] = 'data-auto-height="'. esc_attr( $auto_height ) .'"';
		$slider_data[] = 'data-direction="'. esc_attr( $direction ) .'"';
		$slider_data[] = 'data-draggable="'. esc_attr( $draggable ) .'"';
		$slider_data[] = 'data-touch-move="'. esc_attr( $touch_move ) .'"';
		$slider_data[] = 'data-centered-slides="'. esc_attr( $centered_slides ) .'"';
		$slider_data[] = 'data-keyboard="'. esc_attr( $keyboard ) .'"';
		$slider_data[] = 'data-mousewheel="'. esc_attr( $mousewheel ) .'"';
		$slider_data[] = 'data-effect="'. esc_attr( $effect ) .'"';
		$slider_data[] = 'data-initial-slide="'. esc_attr( $initial_slide ) .'"';

		return $slider_data;

	}

}