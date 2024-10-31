<?php

/**
 * Social Icons
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
use \Elementor\Repeater;
use \Elementor\Icons_Manager;
use \Elementor\Core\Schemes\Typography as Schemes_Typography;
use \Elementor\Core\Schemes\Color as Schemes_Color;

class OEE_Social_Icons_Module extends OEE_Widget_Base {

	/**
	 * Get element name.
	 *
	 * @version  1.0 
	 * @since 1.0
	 * @access public
	 * @return string
	 */
	public function get_name() {
		return 'oee_social_icons';
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
		return esc_html__( 'Social Icons', 'octagon-elements-lite-for-elementor' );
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
		return 'oee-share';
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
		return [ 'oee-social-icons' ];
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
				'default' => 'plain',
				'options' => [
					'plain'          => esc_html__( 'Plain', 'octagon-elements-lite-for-elementor' ),
					'outline-circle' => esc_html__( 'Outline Circle', 'octagon-elements-lite-for-elementor' ),
					'outline-square' => esc_html__( 'Outline Square', 'octagon-elements-lite-for-elementor' ),
					'solid-circle'   => esc_html__( 'Solid Circle', 'octagon-elements-lite-for-elementor' ),
					'solid-square'   => esc_html__( 'Solid Square', 'octagon-elements-lite-for-elementor' ),
					'icon-with-text' => esc_html__( 'Icon with Text', 'octagon-elements-lite-for-elementor' )
				],
			]
		);

		$this->add_control(
			'floating',
			[
				'label'        => esc_html__( 'Floating', 'octagon-elements-lite-for-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'octagon-elements-lite-for-elementor' ),
				'label_off'    => esc_html__( 'No', 'octagon-elements-lite-for-elementor' ),
				'return_value' => 'yes',
				'default'      => 'no'
			]
		);

		$this->add_control(
			'floating_position',
			[
				'label'   => esc_html__( 'Floating Position', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'floating-bottom-left',
				'options' => [
					'floating-top-left'     => esc_html__( 'Top Left', 'octagon-elements-lite-for-elementor' ),
					'floating-top-right'    => esc_html__( 'Top Right', 'octagon-elements-lite-for-elementor' ),
					'floating-bottom-left'  => esc_html__( 'Bottom Left', 'octagon-elements-lite-for-elementor' ),
					'floating-bottom-right' => esc_html__( 'Bottom Right', 'octagon-elements-lite-for-elementor' )
				],
				'condition' => [
					'floating' => 'yes'
				]
			]
		);

		$this->add_control(
			'official_color',
			[
				'label'        => esc_html__( 'Official Color', 'octagon-elements-lite-for-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'octagon-elements-lite-for-elementor' ),
				'label_off'    => esc_html__( 'No', 'octagon-elements-lite-for-elementor' ),
				'return_value' => 'yes',
				'default'      => 'no'
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
				'type'    => Controls_Manager::ICONS,
				'recommended' => [
					'octagon-social' => [
						'behance',
						'blogger',
						'delicious',
						'digg',
						'dribbble',
						'facebook',
						'flickr',
						'linkedin',
						'my-space',
						'pinterest',
						'path',
						'stumbleupon',
						'vimeo',
						'tumblr',
						'vine',
						'vk',
						'youtube',
						'yelp',
						'xing',
						'instagram',
						'twitter',
						'odnoklassniki',
						'deviantart',
						'foursquare',
						'viber',
						'telegram',
						'twitch',
						'weibo',
						'skype',
						'meetup',
						'mix',
						'mixcloud',
						'codepen',
						'bitbucket',
						'houzz',
						'reddit-alien',
						'wordpress',
						'github',
						'gitlab',
						'soundcloud',
						'spotify',
						'android',
						'apple',
						'stack-overflow',
						'steam'
					]
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

		$repeater->add_control(
			'background_color',
			[
				'label' => esc_html__( 'Background Color', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}.icon-wrap' => 'background-color: {{VALUE}};',
				],
			]
		);

		$repeater->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Schemes_Color::get_type(),
					'value' => Schemes_Color::COLOR_3
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}.icon-wrap i, {{WRAPPER}} {{CURRENT_ITEM}}.icon-wrap .brand' => 'color: {{VALUE}};',
					'{{WRAPPER}} {{CURRENT_ITEM}}.icon-wrap svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_set',
			[
				'label'   => esc_html__( 'Icon Set', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => [
					[
						'title' => esc_html__( 'Facebook', 'octagon-elements-lite-for-elementor' ),
						'icon'  => [
							'value'   => 'fab fa-facebook',
							'library' => 'fa-brands'
						],
					],
					[						
						'title' => esc_html__( 'Twitter', 'octagon-elements-lite-for-elementor' ),
						'icon' => [
							'value'   => 'fab fa-twitter',
							'library' => 'fa-brands'
						],
					],
					[
						'title' => esc_html__( 'Youtube', 'octagon-elements-lite-for-elementor' ),
						'icon' => [
							'value'   => 'fab fa-youtube',
							'library' => 'fa-brands'
						],
					],
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

		/* Style Inner Section: Icons ------------------------------------------------ */
		
		$this->start_controls_section(
			'section_style_icons',
			[
				'label' => esc_html__( 'Icons', 'octagon-elements-lite-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => esc_html__( 'Alignment', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'align-left'    => [
						'title' => esc_html__( 'Left', 'octagon-elements-lite-for-elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'align-center' => [
						'title' => esc_html__( 'Center', 'octagon-elements-lite-for-elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'align-right' => [
						'title' => esc_html__( 'Right', 'octagon-elements-lite-for-elementor' ),
						'icon' => 'eicon-text-align-right',
					]
				]
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .social-icons .icon-wrap i, {{WRAPPER}} .social-icons .icon-wrap svg' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_background_color',
			[
				'label' => esc_html__( 'Icon Background Color', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .social-icons .icon-wrap' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_border_color',
			[
				'label' => esc_html__( 'Icon Border Color', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .social-icons .icon-wrap' => 'border: 1px solid {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'icon_box_shadow',
				'selector' => '{{WRAPPER}} .social-icons .icon-wrap',
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'octagon-elements-lite-for-elementor' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50
					],
				],
				'selectors' => [
					'{{WRAPPER}} .social-icons .icon-wrap i, {{WRAPPER}} .social-icons .icon-wrap svg' => 'font-size: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'icon_width',
			[
				'label' => esc_html__( 'Width', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' => [
					'px' => [
						'max' => 200,
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
					'{{WRAPPER}} .social-icons .icon-wrap' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_height',
			[
				'label' => esc_html__( 'Height', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' => [
					'px' => [
						'max' => 200,
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
					'{{WRAPPER}} .social-icons .icon-wrap' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_line_height',
			[
				'label' => esc_html__( 'Line Height', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' => [
					'px' => [
						'max' => 200,
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
					'{{WRAPPER}} .social-icons .icon-wrap' => 'line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icons_margin',
			[
				'label' => esc_html__( 'Margin', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .social-icons .icon-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'icons_padding',
			[
				'label' => esc_html__( 'Padding', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .social-icons .icon-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

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

		$attributes['wrapper']['class'][] = 'octagon-elements social-icons';
		$attributes['wrapper']['class'][] = $settings['style'] ?? '';
		$attributes['wrapper']['class'][] = $settings['align'] ?? '';
		$attributes['wrapper']['class'][] = ( 'yes' == $settings['official_color'] ) ? 'official-color' : 'default-color';
		$attributes['wrapper']['class'][] = ( 'yes' == $settings['floating'] ) ? 'floating' : '';
		$attributes['wrapper']['class'][] = $settings['floating_position'] ?? '';
		$attributes['wrapper']['class'][] = $settings['ex_class'] ?? '';

		/**
		 * Returns render attributes array based on {module}_render_attribute
		 *
		 * @version  1.0 
		 * @since 1.0
		 * 
		 */
		$attributes = apply_filters( 'oee_social_icons_render_attribute', $attributes );
		

		// Add render attributes
		$this->add_render_attribute( $attributes );

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
		do_action( 'oee_social_icons_render_attributes' );

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
		var official_color = ( 'yes' == settings.official_color ) ? 'official-color' : 'default-color',
			floating = ( 'yes' == settings.floating ) ? 'floating' : '';
		
		view.addRenderAttribute( 'wrapper', {
			'class': [ 'octagon-elements', 'social-icons', settings.style, settings.align, official_color, floating, settings.floating_position, settings.ex_class ]
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
		do_action( 'oee_social_icons_live_attributes' );
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

		echo oee_get_shortcode_template( 'social-icons', $this );

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

		echo oee_get_live_template( 'social-icons' );
	}
	

	/**
	 * Render icons.
	 *
	 * @version  1.0 
	 * @since 1.0
	 * @access public
	 */
	public function render_icon_set() {

		$settings = $this->get_settings_for_display();

		$icon_set  = $settings['icon_set'] ?? [];

		$id_int = substr( $this->get_id_int(), 0, 3 );

		foreach( $icon_set as $index => $set ) :

			$count = $index + 1;

			$title_setting_key = $this->get_repeater_setting_key( 'title', 'icon_set', $index );		

			$icon_base = explode( '-', $set['icon']['value'] );

			$this->add_render_attribute( $title_setting_key, [
				'id'    => 'icon-wrap-' . $id_int . $count,
				'class' => [ 'icon-wrap', 'elementor-repeater-item-'. $set['_id'] , 'social-icon-'. end( $icon_base ) ],
				'title' => $set['title']
			] );

			if( ! empty( $set['link']['url'] ) ) {

				$this->add_render_attribute( $title_setting_key, [
					'href' => $set['link']['url']
				] );

				if( $set['link']['is_external'] ) {
					$this->add_render_attribute( $title_setting_key, [
						'target' => '_blank'
					] );
				}

				if( $set['link']['nofollow'] ) {
					$this->add_render_attribute( $title_setting_key, [
						'rel' => 'nofollow'
					] );
				}
			}

			$enclose_tag = ( ! empty( $set['link']['url'] ) ) ? 'a' : 'span';

			?>
			<<?php echo esc_html( $enclose_tag ); ?> <?php echo $this->get_render_attribute_string( $title_setting_key ); ?>>
                <?php Icons_Manager::render_icon( $set['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                <span class="brand"><?php echo esc_html( $set['title'] ); ?></span>
            </<?php echo esc_html( $enclose_tag ); ?>>

		<?php endforeach;
	}

}