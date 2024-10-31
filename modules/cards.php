<?php

/**
 * Cards
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

class OEE_Cards_Module extends OEE_Widget_Base {

	/**
	 * Get element name.
	 *
	 * @version  1.0 
	 * @since 1.0
	 * @access public
	 * @return string
	 */
	public function get_name() {
		return 'oee_cards';
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
		return esc_html__( 'Cards', 'octagon-elements-lite-for-elementor' );
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
		return 'oee-notes';
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
		return [ 'oee-cards' ];
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
			'icon',
			[
				'label'   => esc_html__( 'Icon', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::ICONS
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
			'box_gap',
			[
				'label'      => esc_html__( 'Gap', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'max' => 15,
					],
				],
				'default' => [
					'unit' => 'px',
				],
				'tablet_default' => [
					'unit' => 'px',
				],
				'mobile_default' => [
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .cards .card' => 'padding: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'box_padding',
			[
				'label' => esc_html__( 'Padding', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .cards .card .card-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_control(
			'box_background_color',
			[
				'label' => esc_html__( 'Background Color', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cards .card .card-inner' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'box_border_color',
			[
				'label' => esc_html__( 'Border Color', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cards .card .card-inner' => 'border-color: {{VALUE}};'
				],
			]
		);

		$this->add_responsive_control(
			'box_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'octagon-elements-lite-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .cards .card .card-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_box_shadow',
				'selector' => '{{WRAPPER}} .cards .card .card-inner',
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
					'{{WRAPPER}} .cards .icon-wrap > i, {{WRAPPER}} .cards .icon-wrap > span' => 'font-size: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label'     => esc_html__( 'Color', 'octagon-elements-lite-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cards .icon-wrap > i, {{WRAPPER}} .cards .icon-wrap > span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_background_color',
			[
				'label'     => esc_html__( 'Background Color', 'octagon-elements-lite-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cards .icon-wrap > i, {{WRAPPER}} .cards .icon-wrap > span' => 'background-color: {{VALUE}};'
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
					'{{WRAPPER}} .cards .icon-wrap > i, {{WRAPPER}} .cards .icon-wrap > span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_control(
			'icon_border_color',
			[
				'label' => esc_html__( 'Border Color', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cards .icon-wrap > i, {{WRAPPER}} .cards .icon-wrap > span' => 'border: 1px solid {{VALUE}};'
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
					'{{WRAPPER}} .cards .icon-wrap > i, {{WRAPPER}} .cards .icon-wrap > span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'icon_text_shadow',
				'selector' => '{{WRAPPER}} .cards .icon-wrap > i, {{WRAPPER}} .cards .icon-wrap > span'
			]
		);	

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'icon_box_shadow',
				'selector' => '{{WRAPPER}} .cards .icon-wrap > i, {{WRAPPER}} .cards .icon-wrap > span'
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
				'selector' => '{{WRAPPER}} .cards .title'
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Color', 'octagon-elements-lite-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cards .title' => 'color: {{VALUE}};'
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
					'{{WRAPPER}} .cards .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'title_text_shadow',
				'selector' => '{{WRAPPER}} .cards .title'
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

		$attributes['wrapper']['class'][] = 'octagon-elements cards';
		$attributes['wrapper']['class'][] = $settings['columns'] ?? 'columns-4';
		$attributes['wrapper']['class'][] = $settings['ex_class'] ?? '';

		/**
		 * Returns render attributes array based on {module}_render_attribute
		 *
		 * @version  1.0 
		 * @since 1.0
		 * 
		 */
		$attributes = apply_filters( 'oee_cards_render_attribute', $attributes );

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
		do_action( 'oee_cards_render_attributes' );

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
			'class': [ 'octagon-elements', 'cards', settings.columns, settings.ex_class ]
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
		do_action( 'oee_cards_live_attributes' );
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

		echo oee_get_shortcode_template( 'cards', $this );

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

		echo oee_get_live_template( 'cards' );
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
			$wrap_setting_key = $this->get_repeater_setting_key( 'link', 'icon_set', $index );

			$this->add_render_attribute( $title_setting_key, [
				'class' => [ 'title' ]
			] );

			$this->add_render_attribute( $wrap_setting_key, [
				'class' => [ 'card' ]
			] );

			if( ! empty( $set['link']['url'] ) ) {

				$this->add_render_attribute( $wrap_setting_key, [
					'href' => $set['link']['url']
				] );

				if( $set['link']['is_external'] ) {
					$this->add_render_attribute( $wrap_setting_key, [
						'target' => '_blank'
					] );
				}

				if( $set['link']['nofollow'] ) {
					$this->add_render_attribute( $wrap_setting_key, [
						'rel' => 'nofollow'
					] );
				}
			}

			$this->add_inline_editing_attributes( $title_setting_key, 'none' );

			$title = $set['title'] ?? '';

			$wrap_tag = ! empty( $set['link']['url'] ) ? 'a' : 'span';
			?>
			
			<<?php echo esc_html( $wrap_tag ); ?> <?php echo $this->get_render_attribute_string( $wrap_setting_key ); ?>>

				<div class="card-inner">

					<div class="icon-wrap">
	                    <?php
	                    if( isset( $set['icon']['value'] ) && ! empty( $set['icon']['value'] ) ) :
	                        Icons_Manager::render_icon( $set['icon'], [ 'aria-hidden' => 'true' ] );
	                    endif;
	                    ?>
	                </div> <!-- .icon-wrap -->

					<div class="content">
						<?php 
						if( ! empty( $title ) ) : 
							?>
							<<?php echo octagon_title_tag( $title_tag ); ?> class="title">

								<span <?php echo $this->get_render_attribute_string( $title_setting_key ); ?>><?php echo esc_html( $title ); ?></span>

							</<?php echo octagon_title_tag( $title_tag ); ?>>
							<?php
						endif;
						?>
					</div> <!-- .content -->

				</div> <!-- .card-inner -->

			</<?php echo esc_html( $wrap_tag ); ?>> <!-- .card -->

		<?php endforeach;
	}

}