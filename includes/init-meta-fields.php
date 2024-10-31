<?php
/**
 *
 * @package octagon-elements-lite-for-elementor/includes
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.2
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;

if( ! class_exists( 'Octagon_Core_Metabox' ) ) {
	return;
}

add_action( 'init', 'octagon_init_metaboxes' );

if( ! function_exists( 'octagon_init_metaboxes' ) ) {

	function octagon_init_metaboxes() {


		/* ---------------------------------------------------------------------------
		 * Meta Fields
		------------------------------------------------------------------------------ */


		/* Portfolio ----------------------------------------------------------------- */

		$portfolio_general[] = array(
			'id'          => 'live_preview',
			'title'       => esc_html__( 'Live Preview', 'octagon-elements-lite-for-elementor' ),
			'description' => esc_html__( 'Enter the project URL.', 'octagon-elements-lite-for-elementor' ),
			'type'        => 'text',
			'in_type'     => 'url',
			'default'     => '',
			'class'       => ''
		);

		$portfolio_general[] = array(
			'id'             => 'thumbnail',
			'title'          => esc_html__( 'Thumbnail', 'octagon-elements-lite-for-elementor' ),
			'description'    => esc_html__( 'Separate thumbnail, If it\'s set, it loads instead of feature thumbnail in shortcodes.', 'octagon-elements-lite-for-elementor' ),
			'type'           => 'media_upload',
			'in_type'        => 'image', // image, audio, video, text, application { @ref: https://codex.wordpress.org/Function_Reference/get_allowed_mime_types }
			'allow_multiple' => false,
			'default'        => '',
			'class'          => ''
		);

		/**
		 * To modify the portfolio meta box general tab fields.
		 *
		 * @since 1.2
		 */
		$portfolio_general = apply_filters( 'octagon_portfolio_general_meta_fields', $portfolio_general );


		/* Testimonial --------------------------------------------------------------- */

		$testimonial_general[] = array(
			'id'          => 'client_rating',
			'title'       => esc_html__( 'Rating', 'octagon-elements-lite-for-elementor' ),
			'description' => esc_html__( 'Choose rating.', 'octagon-elements-lite-for-elementor' ),
			'type'        => 'select',
			'default'     => '5',
			'options'     => array(
				'1' => esc_html__( 'Bad', 'octagon-elements-lite-for-elementor' ),
				'2' => esc_html__( 'OK', 'octagon-elements-lite-for-elementor' ),
				'3' => esc_html__( 'Average', 'octagon-elements-lite-for-elementor' ),
				'4' => esc_html__( 'Good', 'octagon-elements-lite-for-elementor' ),
				'5' => esc_html__( 'Better', 'octagon-elements-lite-for-elementor' )
			),
			'class'       => ''
		);

		/**
		 * To modify the testimonial meta box general tab fields.
		 *
		 * @since 1.2
		 */
		$testimonial_general = apply_filters( 'octagon_testimonial_general_meta_fields', $testimonial_general );


		/* Team General -------------------------------------------------------------- */

		$team_general[] = array(
			'id'          => 'email',
			'title'       => esc_html__( 'Email', 'octagon-elements-lite-for-elementor' ),
			'description' => esc_html__( 'Type email address here.', 'octagon-elements-lite-for-elementor' ),
			'type'        => 'text',
			'in_type'     => 'email',
			'default'     => '',
			'class'       => ''
		);

		$team_general[] = array(
			'id'          => 'website',
			'title'       => esc_html__( 'Website', 'octagon-elements-lite-for-elementor' ),
			'description' => esc_html__( 'Add website links here.', 'octagon-elements-lite-for-elementor' ),
			'type'        => 'text',
			'in_type'     => 'url',
			'default'     => '',
			'class'       => ''
		);

		/**
		 * To modify the team meta box general tab fields.
		 *
		 * @since 1.2
		 */
		$team_general = apply_filters( 'octagon_team_general_meta_fields', $team_general );


		/* Team Social --------------------------------------------------------------- */

		$team_social_fields[] = array(
			'id'      => 'icon',
			'title'   => esc_html__( 'Icon', 'octagon-elements-lite-for-elementor' ),
			'type'    => 'icon_picker',
			'default' => '',
			'class'   => ''
		);

		$team_social_fields[] = array(
			'id'      => 'link',
			'title'   => esc_html__( 'Link', 'octagon-elements-lite-for-elementor' ),
			'type'    => 'text',
			'in_type' => 'url',
			'default' => '',
			'class'   => ''
		);

		/**
		 * To set the team social default repeatable field values.
		 *
		 * @since 1.2
		 */

		// default array key is randomly generated, cause to prevent the sortable issue
		$team_social_default_fields = apply_filters( 'octagon_team_social_default_fields', array(
			'Yud3S' => array(
				'icon' => '',
				'url'  => ''
			)
		) );

		$team_social[] = array(
			'id'          => 'social',
			'title'       => esc_html__( 'Social', 'octagon-elements-lite-for-elementor' ),
			'description' => esc_html__( 'Add social links here.', 'octagon-elements-lite-for-elementor' ),
			'type'        => 'repeatable',
			'options'     => $team_social_fields,
			'default'     => $team_social_default_fields,
			'class'       => ''
		);

		/**
		 * To modify the team meta box social tab fields.
		 *
		 * @since 1.2
		 */
		$team_social = apply_filters( 'octagon_team_social_meta_fields', $team_social );


		/* ---------------------------------------------------------------------------
		 * Prepare Meta Fields
		------------------------------------------------------------------------------ */	
		
		
		/* Portfolio ----------------------------------------------------------------- */

		/**
		 * To modify the portfolio meta box tabs.
		 *
		 * @since 1.2
		 */
		$portfolio_field = apply_filters( 'octagon_portfolio_meta_fields_group', [
			esc_html__( 'General', 'octagon-elements-lite-for-elementor' ) => $portfolio_general
		] );


		/* Testimonial --------------------------------------------------------------- */

		/**
		 * To modify the testimonial meta box tabs.
		 *
		 * @since 1.2
		 */
		$testimonial_field = apply_filters( 'octagon_testimonial_meta_fields_group', [
			esc_html__( 'General', 'octagon-elements-lite-for-elementor' ) => $testimonial_general
		] );


		/* Team ---------------------------------------------------------------------- */

		/**
		 * To modify the team meta box tabs.
		 *
		 * @since 1.2
		 */
		$team_field = apply_filters( 'octagon_team_meta_fields_group', [
			esc_html__( 'General', 'octagon-elements-lite-for-elementor' ) => $team_general,
			esc_html__( 'Social', 'octagon-elements-lite-for-elementor' )  => $team_social
		] );


		/* ---------------------------------------------------------------------------
		 * Create Metabox
		------------------------------------------------------------------------------ */


		/* Portfolio Metabox --------------------------------------------------------- */

		new Octagon_Core_Metabox( array(
			'id'            => 'octagon_portfolio_metabox',
			'title'         => esc_html__( 'Portfolio Options', 'octagon-elements-lite-for-elementor' ),
			'content_types' => array( 'octagon_portfolio' ),
			'show_on_cb'    => true,
			'context'       => 'normal',
			'priority'      => 'high',
			'classes'       => '',
			'fields'		=> $portfolio_field
		) );


		/* Testimonial Metabox ------------------------------------------------------- */

		new Octagon_Core_Metabox( array(
			'id'            => 'octagon_testimonial_metabox',
			'title'         => esc_html__( 'Testimonial Options', 'octagon-elements-lite-for-elementor' ),
			'content_types' => array( 'octagon_testimonial' ),
			'show_on_cb'    => true,
			'context'       => 'side',
			'priority'      => 'high',
			'classes'       => '',
			'fields'		=> $testimonial_field
		) );


		/* Team Metabox -------------------------------------------------------------- */

		new Octagon_Core_Metabox( array(
			'id'            => 'octagon_team_metabox',
			'title'         => esc_html__( 'Team Options', 'octagon-elements-lite-for-elementor' ),
			'content_types' => array( 'octagon_member' ),
			'show_on_cb'    => true,
			'context'       => 'normal',
			'priority'      => 'high',
			'classes'       => '',
			'fields'		=> $team_field
		) );

	}

}
