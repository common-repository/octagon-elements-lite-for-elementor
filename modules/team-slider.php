<?php

/**
 * Team Slider
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

class OEE_Team_Slider_Module extends OEE_Widget_Base {

	/**
	 * Get element name.
	 *
	 * @version  1.0 
	 * @since 1.0
	 * @access public
	 * @return string
	 */
	public function get_name() {
		return 'oee_team_slider';
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
		return esc_html__( 'Team Slider', 'octagon-elements-lite-for-elementor' );
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
		return 'oee-team';
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
		return [ 'oee-team', 'oee-team-slider' ];
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
			'title_tag',
			[
				'label'   => esc_html__( 'Title Tag', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h3',
				'options' => $this->get_array( 'title_tag' )
			]
		);

		$this->add_control(
			'show_job',
			[
				'label'   => esc_html__( 'Show Job?', 'octagon-elements-lite-for-elementor' ),
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
					'default'  => esc_html__( 'Default', 'octagon-elements-lite-for-elementor' ),
					'id'       => esc_html__( 'ID', 'octagon-elements-lite-for-elementor' ),
					'terms'    => esc_html__( 'Terms', 'octagon-elements-lite-for-elementor' ),
					'author'   => esc_html__( 'Author', 'octagon-elements-lite-for-elementor' ),
					'popular'  => esc_html__( 'Popular', 'octagon-elements-lite-for-elementor' ),
					'featured' => esc_html__( 'Featured', 'octagon-elements-lite-for-elementor' )
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
				'default' => 4
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
				'selector' => '{{WRAPPER}} .title'
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
					'{{WRAPPER}} .title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_padding',
			[
				'label'      => esc_html__( 'Padding', 'elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'title_text_shadow',
				'selector' => '{{WRAPPER}} .title'
			]
		);

		$this->end_controls_section();


		/* Style Inner Section: Meta ------------------------------------------------- */

		$this->start_controls_section(
			'section_style_meta',
			[
				'label' => esc_html__( 'Meta', 'octagon-elements-lite-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'meta_typography',
				'selector' => '{{WRAPPER}} .meta-group, {{WRAPPER}} .meta-group a'
			]
		);

		$this->add_control(
			'meta_color',
			[
				'label'     => esc_html__( 'Color', 'octagon-elements-lite-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Schemes_Color::get_type(),
					'value' => Schemes_Color::COLOR_2
				],
				'selectors' => [
					'{{WRAPPER}} .meta-group p, {{WRAPPER}} .meta-group p a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'meta_padding',
			[
				'label'      => esc_html__( 'Padding', 'elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .meta-group, {{WRAPPER}} .meta-group a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'meta_text_shadow',
				'selector' => '{{WRAPPER}} .meta-group, {{WRAPPER}} .meta-group a'
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
		$attributes = apply_filters( 'oee_team_slider_render_attribute', $attributes );
		

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
		do_action( 'oee_team_slider_render_attributes' );

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

		echo oee_get_shortcode_template( 'team-slider', $this );

	}

	/**
	 * Returns WP Query arguemnts
	 * 
	 * @version 1.0
	 * @since  1.0
	 * @return array
	 */
	public function get_query() {

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
			'post_type'           => 'octagon_member',
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

		if( '' != $terms_not_in ) {
			$terms_not_in_array = explode( ',', $terms_not_in );

			$args['tax_query'][] = array(
				'taxonomy' => 'octagon_member_job',
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
				'taxonomy' => 'octagon_member_job',
				'field'    => 'slug',
				'terms'    => $terms_in_array,
				'operator' => 'IN'
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
		elseif( 'popular' == $method ) {
			$args['orderby'] = 'comment_count';
		}
		elseif( 'featured' == $method ) {
			$args['meta_query'][] = array(
				'key'   => 'featured_post',
				'value' => 'featured'
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

		$slides_per_view = $settings['slides_per_view'] ?? 4;
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