<?php
/**
 *
 * @package octagon-elements-lite-for-elementor/includes
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.0
 * @since 1.0
 */

if( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$post_types = [];

if( ! class_exists( 'OEE_Init_Elements' ) ) {
	include_once OEE_PATH . '/modules/initialize-elements.php';
}

$active_modules = OEE_Init_Elements::active_modules_list();

$content_type_modules = array(
	'portfolio'   => array( 'portfolio', 'portfolio_slider', 'portfolio_extend_slider' ),
	'team'        => array( 'team', 'team_slider' ),
	'testimonial' => array( 'testimonial_slider' )
);

if( class_exists( 'Octagon_Core_Post_type' ) ) {

	if( octagon_in_array_any( $content_type_modules['portfolio'], $active_modules ) ) {

		$post_types['portfolio'] = array(
			'id'       => 'octagon_portfolio',
			'name'     => esc_html__( 'Portfolio', 'octagon-elements-lite-for-elementor' ),
			'singular' => esc_html__( 'Portfolio', 'octagon-elements-lite-for-elementor' ),
			'labels'   => array(
				'all_items' => esc_html__( 'All Portfolio', 'octagon-elements-lite-for-elementor' ),
			),
			'options'  => array(
				'menu_icon' => 'dashicons-format-image',
				'supports'  => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ),
				'has_archive'  => true,
				'rewrite' 	=> array(
					'slug' => 'portfolio-archive'
				)
			),
			'taxonomy'  => array(

				array(
					'id'       => 'octagon_portfolio_cat',
					'name'     => esc_html__( 'Categories', 'octagon-elements-lite-for-elementor' ),
					'singular' => esc_html__( 'Category', 'octagon-elements-lite-for-elementor' ),
					'labels'   => array(
						'name'      => esc_html__( 'Portfolio Categories', 'octagon-elements-lite-for-elementor' ),
						'all_items' => esc_html__( 'All Categories', 'octagon-elements-lite-for-elementor' )
					),
					'options'  => array(
						'hierarchical' => true,
						'rewrite' 	=> array(
							'slug' => 'portfolio-cat'
						)
					),
				)
				
			)
		);

	}	

	if( octagon_in_array_any( $content_type_modules['team'], $active_modules ) ) {

		$post_types['member'] = array(
			'id'       => 'octagon_member',
			'name'     => esc_html__( 'Team', 'octagon-elements-lite-for-elementor' ),
			'singular' => esc_html__( 'Member', 'octagon-elements-lite-for-elementor' ),
			'labels'   => array(
				'all_items' => esc_html__( 'All Members', 'octagon-elements-lite-for-elementor' ),
			),
			'options'  => array(
				'menu_icon' => 'dashicons-businessman',
				'supports'  => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
				'has_archive'  => 'team-archive'
			),
			'taxonomy'  => array(

				array(
					'id'       => 'octagon_member_job',
					'name'     => esc_html__( 'Jobs', 'octagon-elements-lite-for-elementor' ),
					'singular' => esc_html__( 'Job', 'octagon-elements-lite-for-elementor' ),
					'labels'   => array(
						'name'      => esc_html__( 'Team Jobs', 'octagon-elements-lite-for-elementor' ),
						'all_items' => esc_html__( 'All Jobs', 'octagon-elements-lite-for-elementor' )
					),
					'options'  => array(
						'hierarchical' => true
					),
				)
				
			)
		);

	}

	if( octagon_in_array_any( $content_type_modules['testimonial'], $active_modules ) ) {

		$post_types['testimonial'] = array(
			'id'       => 'octagon_testimonial',
			'name'     => esc_html__( 'Testimonials', 'octagon-elements-lite-for-elementor' ),
			'singular' => esc_html__( 'Testimonial', 'octagon-elements-lite-for-elementor' ),
			'labels'   => array(
				'all_items' => esc_html__( 'All Testimonials', 'octagon-elements-lite-for-elementor' ),
			),
			'options'  => array(
				'menu_icon' => 'dashicons-star-half',
				'supports'  => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
				'has_archive'  => 'testimonial-archive'
			),
			'taxonomy'  => array(

				array(
					'id'       => 'octagon_testimonial_job',
					'name'     => esc_html__( 'Jobs', 'octagon-elements-lite-for-elementor' ),
					'singular' => esc_html__( 'Job', 'octagon-elements-lite-for-elementor' ),
					'labels'   => array(
						'name'      => esc_html__( 'Testimonial Jobs', 'octagon-elements-lite-for-elementor' ),
						'all_items' => esc_html__( 'All Jobs', 'octagon-elements-lite-for-elementor' )
					),
					'options'  => array(
						'hierarchical' => true
					),
				)
				
			)
		);

	}

	$post_types = apply_filters( 'octagon_custom_post_types', $post_types );

	if( ! empty( $post_types ) ) {
		foreach( $post_types as $key => $value ) {
			new Octagon_Core_Post_type( $value );
		}		
	}

}
