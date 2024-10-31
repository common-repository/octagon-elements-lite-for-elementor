<?php

/**
 * Logo
 *
 * @package octagon-elements-lite-for-elementor/modules
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.0
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;

use \Elementor\Controls_Manager;

class OEE_Logo_Module extends OEE_Widget_Base {

	/**
	 * Get element name.
	 *
	 * @version  1.0 
	 * @since 1.0
	 * @access public
	 * @return string
	 */
	public function get_name() {
		return 'oee_logo';
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
		return esc_html__( 'Logo', 'octagon-elements-lite-for-elementor' );
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
		return 'oee-brand';
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
		return [ 'oee-logo' ];
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
			'ex_class',
			[
				'label'       => esc_html__( 'Extra Class', 'octagon-elements-lite-for-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'input_type'  => 'text'
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

		$attributes['wrapper']['class'][] = 'octagon-elements custom-logo';
		$attributes['wrapper']['class'][] = $settings['ex_class'] ?? '';

		/**
		 * Returns render attributes array based on {module}_render_attribute
		 *
		 * @version  1.0 
		 * @since 1.0
		 * 
		 */
		$attributes = apply_filters( 'oee_logo_render_attribute', $attributes );
		

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
		do_action( 'oee_logo_render_attributes' );

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

		echo oee_get_shortcode_template( 'logo', $this );

	}

}