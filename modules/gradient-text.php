<?php

/**
 * Gradient Text
 *
 * @package octagon-elements-lite-for-elementor/modules
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.0
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Core\Schemes\Typography as Schemes_Typography;

class OEE_Gradient_Text_Module extends OEE_Widget_Base {

	/**
	 * Get element name.
	 *
	 * @version  1.0 
	 * @since 1.0
	 * @access public
	 * @return string
	 */
	public function get_name() {
		return 'oee_gradient_text';
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
		return esc_html__( 'Gradient Text', 'octagon-elements-lite-for-elementor' );
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
		return 'oee-gradient';
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
		return [ 'oee-gradient-text' ];
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
			'title',
			[
				'label'      => esc_html__( 'Title', 'octagon-elements-lite-for-elementor' ),
				'type'       => Controls_Manager::TEXT,
				'input_type' => 'text',
				'default'    => esc_html__( 'Default Title', 'octagon-elements-lite-for-elementor' )
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'   => esc_html__( 'Title Tag', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'p',
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'p'  => 'P'
				],
			]
		);

		$this->add_control(
			'gradient_palette',
			[
				'label'   => esc_html__( 'Gradient Palette', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'orange-pulp',
				'options' => $this->get_array( 'gradient_palette' )
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


		/* ---------------------------------------------------------------------------
		 * Section: Style
		------------------------------------------------------------------------------ */

		/* Style Inner Section: Text ------------------------------------------------- */
		
		$this->start_controls_section(
			'section_style_button',
			[
				'label' => esc_html__( 'Title', 'octagon-elements-lite-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'text_typography',
				'scheme'   => Schemes_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .sub-title span'
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'text_gradient',
				'label'    => esc_html__( 'Gradient', 'octagon-elements-lite-for-elementor' ),
				'types'    => [ 'gradient' ],
				'selector' => '{{WRAPPER}} .sub-title span'
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Set render attributes.
	 *
	 * @version  1.0 
	 * @since 1.0
	 * @access protected
	 */
	protected function set_render_attributes() {

		$settings = $this->get_settings_for_display();

		$attributes['wrapper']['class'][] = 'octagon-elements gradient-text';
		$attributes['wrapper']['class'][] = $settings['ex_class'] ?? '';

		$attributes['text']['class'][] = 'sub-title';

		$attributes['title']['class'][] = $settings['gradient_palette'] ?? 'orange-pulp';

		/**
		 * Returns render attributes array based on {module}_render_attribute
		 *
		 * @version  1.0 
		 * @since 1.0
		 * 
		 */
		$attributes = apply_filters( 'oee_gradient_text_render_attribute', $attributes );

		// Add render attributes
		$this->add_render_attribute( $attributes );


		$this->add_inline_editing_attributes( 'title', 'none' );

		/**
		 * Render attributes based on {module}_render_attributes
		 *
		 * Fires before rendering elements content.
		 * 
		 * @version  1.0 
		 * @since 1.0
		 * 
		 */
		do_action( 'oee_gradient_text_render_attribute' );

	}

	/**
	 * Set live attributes.
	 *
	 * @version  1.0 
	 * @since 1.0
	 * @access protected
	 */
	protected function set_live_attributes() {
		?>

		<#
		view.addRenderAttribute( 'title', {
			'class': [ settings.gradient_palette ]
		} );

		view.addInlineEditingAttributes( 'title', 'none' );
		#>

		<?php

		/**
		 * Render attributes based on {module}_live_attributes
		 *
		 * Fires before rendering live template content.
		 * 
		 * @version  1.0 
		 * @since 1.0
		 * 
		 */
		do_action( 'oee_gradient_text_live_attributes' );
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

		echo oee_get_shortcode_template( 'gradient-text', $this );

	}

	/**
	 * Render button widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 * 
	 * @version  1.0 
	 * @since 1.0
	 * @access protected
	 */
	protected function _content_template() {

		$this->set_live_attributes();

		echo oee_get_live_template( 'gradient-text' );
	}

}