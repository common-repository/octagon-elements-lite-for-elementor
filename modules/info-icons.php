<?php

/**
 * Info Icons
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
use \Elementor\Group_Control_Image_Size;
use \Elementor\Icons_Manager;
use \Elementor\Utils;
use \Elementor\Repeater;
use \Elementor\Core\Schemes\Typography as Schemes_Typography;
use \Elementor\Core\Schemes\Color as Schemes_Color;

class OEE_Info_Icons_Module extends OEE_Widget_Base {

	/**
	 * Get element name.
	 *
	 * @version  1.0 
	 * @since 1.0
	 * @access public
	 * @return string
	 */
	public function get_name() {
		return 'oee_info_icons';
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
		return esc_html__( 'Info Icons', 'octagon-elements-lite-for-elementor' );
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
		return 'oee-info';
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
		return [ 'oee-info-icons', 'oee-advance-button' ];
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
			'columns',
			[
				'label'   => esc_html__( 'Columns', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'columns-4',
				'options' => [
					'columns-2' => esc_html__( '2 Column', 'octagon-elements-lite-for-elementor' ),
					'columns-3' => esc_html__( '3 Column', 'octagon-elements-lite-for-elementor' ),
					'columns-4' => esc_html__( '4 Column', 'octagon-elements-lite-for-elementor' ),
					'columns-5' => esc_html__( '5 Column', 'octagon-elements-lite-for-elementor' ),
					'columns-6' => esc_html__( '6 Column', 'octagon-elements-lite-for-elementor' )
				],
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'   => esc_html__( 'Title Tag', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h3',
				'options' => [
					'h1'   => 'H1',
					'h2'   => 'H2',
					'h3'   => 'H3',
					'h4'   => 'H4',
					'h5'   => 'H5',
					'h6'   => 'H6',
					'p'    => 'P',
					'span' => 'Span'
				],
			]
		);

		$this->add_control(
			'alignment',
			[
				'label'   => esc_html__( 'Alignment', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left'   => esc_html__( 'Left', 'octagon-elements-lite-for-elementor' ),
					'right'  => esc_html__( 'Right', 'octagon-elements-lite-for-elementor' ),
					'center' => esc_html__( 'Center', 'octagon-elements-lite-for-elementor' )
				]
			]
		);

		$this->add_control(
			'with_border',
			[
				'label'   => esc_html__( 'Cover with border?', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'with-border',
				'options' => [
					'with-border'    => esc_html_x( 'With Border', 'octagon-elements-lite-for-elementor' ),
					'without-border' => esc_html_x( 'Without Border', 'octagon-elements-lite-for-elementor' )
				]
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'title', [
				'label'       => esc_html__( 'Title', 'octagon-elements-lite-for-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Default Title', 'octagon-elements-lite-for-elementor' ),
				'label_block' => true
			]
		);		

		$repeater->add_control(
			'type',
			[
				'label'   => esc_html__( 'Type', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'icon',
				'options' => [
					'icon'  => esc_html_x( 'Icon', 'octagon-elements-lite-for-elementor' ),
					'image' => esc_html_x( 'Image', 'octagon-elements-lite-for-elementor' )
				]
			]
		);

		$repeater->add_control(
			'icon',
			[
				'label'   => esc_html__( 'Icon', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::ICONS
			]
		);

		$repeater->add_control(
			'image',
			[
				'label' => esc_html__( 'Image', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src()
				]
			]
		);		

		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'default'   => 'thumbnail',
				'separator' => 'none'				
			]
		);

		$repeater->add_control(
			'method',
			[
				'label'   => esc_html__( 'Method', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'square',
				'options' => [
					'square' => esc_html_x( 'Square', 'octagon-elements-lite-for-elementor' ),
					'round'  => esc_html_x( 'Round', 'octagon-elements-lite-for-elementor' )
				]
			]
		);

		$repeater->add_control(
			'link',
			[
				'label'         => esc_html__( 'Link', 'octagon-elements-lite-for-elementor' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => esc_html__( 'https://your-link.com', 'octagon-elements-lite-for-elementor' ),
				'show_external' => true,
				'default'       => [
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true
				],
			]
		);

		$this->add_control(
			'icon_set',
			[
				'label'       => esc_html__( 'Icon Set', 'octagon-elements-lite-for-elementor' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default' => [
					[
						'icon' => [
							'value'   => 'oct-basic-forward',
							'library' => 'octagon-basic'
						],
						'title' => esc_html__( 'Quick Delivery', 'octagon-elements-lite-for-elementor' )
					],
					[
						'icon' => [
							'value'   => 'oct-basic-lock',
							'library' => 'octagon-basic'
						],
						'title' => esc_html__( 'Secure Payments', 'octagon-elements-lite-for-elementor' )
					],
					[
						'icon' => [
							'value'   => 'oct-basic-history',
							'library' => 'octagon-basic'
						],
						'title' => esc_html__( '24/7 Live Support', 'octagon-elements-lite-for-elementor' )
					],
					[
						'icon' => [
							'value'   => 'oct-basic-random',
							'library' => 'octagon-basic'
						],
						'title' => esc_html__( 'Free Returns', 'octagon-elements-lite-for-elementor' )
					]
				],
				'title_field' => '{{{ title }}}'
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

		/* Style Inner Section: Box -------------------------------------------------- */
		
		$this->start_controls_section(
			'section_style_box',
			[
				'label' => esc_html__( 'Box', 'octagon-elements-lite-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
			'box_padding',
			[
				'label'      => esc_html__( 'Padding', 'elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .info-icon-group' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);		

		$this->add_control(
			'box_border_color',
			[
				'label' => esc_html__( 'Border Color', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .info-icons.with-border .info-icon-group' => 'border-color: {{VALUE}};'
				],
			]
		);

		$this->end_controls_section();


		/* Style Inner Section: Icon ------------------------------------------------- */
		
		$this->start_controls_section(
			'section_style_icon',
			[
				'label' => esc_html__( 'Icon', 'octagon-elements-lite-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'octagon-elements-lite-for-elementor' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .info-icons .icon-wrap i, {{WRAPPER}} .info-icons .icon-wrap span' => 'font-size: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label'     => esc_html__( 'Color', 'octagon-elements-lite-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'scheme' => [
					'type'  => Schemes_Color::get_type(),
					'value' => Schemes_Color::COLOR_1
				],
				'selectors' => [
					'{{WRAPPER}} .info-icons .icon-wrap i, {{WRAPPER}} .info-icons .icon-wrap span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_background_color',
			[
				'label'     => esc_html__( 'Background Color', 'octagon-elements-lite-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .info-icons .icon-wrap i, {{WRAPPER}} .info-icons .icon-wrap span' => 'background-color: {{VALUE}};'
				],
			]
		);

		$this->add_responsive_control(
			'icon_padding',
			[
				'label'      => esc_html__( 'Padding', 'elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .info-icons .icon-wrap i, {{WRAPPER}} .info-icons .icon-wrap span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_control(
			'icon_border_color',
			[
				'label' => esc_html__( 'Border Color', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .info-icons .icon-wrap i, {{WRAPPER}} .info-icons .icon-wrap span' => 'border: 1px solid {{VALUE}};'
				],
			]
		);

		$this->add_responsive_control(
			'icon_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'octagon-elements-lite-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .info-icons .icon-wrap i, {{WRAPPER}} .info-icons .icon-wrap span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'icon_text_shadow',
				'selector' => '{{WRAPPER}} .info-icons .icon-wrap i, {{WRAPPER}} .info-icons .icon-wrap span'
			]
		);	

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'icon_box_shadow',
				'selector' => '{{WRAPPER}} .info-icons .icon-wrap i, {{WRAPPER}} .info-icons .icon-wrap span'
			]
		);

		$this->end_controls_section();


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
				'scheme'   => Schemes_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .info-icons .info-icon-title .title'
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Color', 'octagon-elements-lite-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'scheme' => [
					'type'  => Schemes_Color::get_type(),
					'value' => Schemes_Color::COLOR_3
				],
				'selectors' => [
					'{{WRAPPER}} .info-icons .info-icon-title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .info-icons .info-icon-title a' => 'color: {{VALUE}};'
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
					'{{WRAPPER}} .info-icons .info-icon-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'title_text_shadow',
				'selector' => '{{WRAPPER}} .info-icons .info-icon-title'
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

		$attributes['wrapper']['class'][] = 'octagon-elements info-icons';
		$attributes['wrapper']['class'][] = 'info-icons-'. $settings['alignment'];
		$attributes['wrapper']['class'][] = $settings['columns'] ?? 'columns-4';
		$attributes['wrapper']['class'][] = $settings['with_border'] ?? 'with-border';
		$attributes['wrapper']['class'][] = $settings['ex_class'] ?? '';

		if( ! empty( $settings['link']['url'] ) ) {

			$attributes['button']['href'] = $settings['link']['url'];

			if( $settings['link']['is_external'] ) {			
				$attributes['button']['target'] = '_blank';
			}

			if( $settings['link']['nofollow'] ) {			
				$attributes['button']['rel'] = 'nofollow';
			}
		}

		$attributes['title']['class'][] = 'info-icon-title sub-title';

		/**
		 * Returns render attributes array based on {module}_render_attribute
		 *
		 * @version  1.0 
		 * @since 1.0
		 * 
		 */
		$attributes = apply_filters( 'oee_info_icons_render_attribute', $attributes );

		// Add render attributes
		$this->add_render_attribute( $attributes );

		$this->add_inline_editing_attributes( 'title', 'none' );
		$this->add_inline_editing_attributes( 'btn_text', 'none' );
		

		/**
		 * Render attributes based on {module}_render_attributes
		 *
		 * Fires before rendering elements content.
		 * 
		 * @version  1.0 
		 * @since 1.0
		 * 
		 */
		do_action( 'oee_info_icons_render_attributes' );

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
		view.addRenderAttribute( 'wrapper', {
			'class': [ 'octagon-elements', 'info-icons', 'info-icons-'+ settings.alignment, settings.columns, settings.with_border, settings.ex_class ]
		} );
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
		do_action( 'oee_info_icons_live_attributes' );
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

		$settings = $this->get_settings_for_display();

		echo oee_get_shortcode_template( 'info-icons', $this );

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

		echo oee_get_live_template( 'info-icons' );
	}

	/**
	 * Render icon.
	 *
	 * @version  1.0 
	 * @since 1.0
	 * @access public
	 */
	public function render_icon_set() {

		$settings = $this->get_settings_for_display();

		$icon_set  = $settings['icon_set'] ?? [];
		$title_tag = $settings['title_tag'] ?? 'h3';

		$id_int = substr( $this->get_id_int(), 0, 3 );

		foreach( $icon_set as $index => $set ) :

			$count = $index + 1;

			$title_setting_key = $this->get_repeater_setting_key( 'title', 'icon_set', $index );

			$this->add_render_attribute( $title_setting_key, [
				'class' => [ 'title' ]
			] );

			$this->add_inline_editing_attributes( $title_setting_key, 'none' );

			$icon_wrap_class[] = 'icon-wrap';
			$icon_wrap_class[] = 'icon-type-'. $set['type'];
			$icon_wrap_class[] = 'icon-method-'. $set['method'];

			$icon_wrap_class   = array_filter( $icon_wrap_class );

			$title = $set['title'] ?? '';

			?>

			<div class="info-icon-group">

				<div class="<?php echo esc_attr( implode( ' ', $icon_wrap_class ) ); ?>">
                    <?php
                    if( 'icon' == $set['type'] ) :
                        Icons_Manager::render_icon( $set['icon'], [ 'aria-hidden' => 'true' ] );
                    elseif( 'image' == $set['type'] ) :
                    	echo Group_Control_Image_Size::get_attachment_image_html( $set, 'image' );
                    endif;
                    ?>
                </div>

				<div class="content">
					<?php 
					if( ! empty( $title ) ) : 
						?>
						<<?php echo octagon_title_tag( $title_tag ); ?> class="info-icon-title sub-title">

							<?php if( ! empty( $settings['link']['url'] ) ) : ?>
								<a <?php echo $this->get_render_attribute_string( 'button' ); ?>>
							<?php endif; ?>

								<span <?php echo $this->get_render_attribute_string( $title_setting_key ); ?>><?php echo esc_html( $title ); ?></span>

							<?php if( ! empty( $settings['link']['url'] ) ) : ?>
								</a>
							<?php endif; ?>

						</<?php echo octagon_title_tag( $title_tag ); ?>>
						<?php
					endif;
					?>
				</div> <!-- .content -->

			</div> <!-- .info-icon-group -->

		<?php endforeach;
	}

}