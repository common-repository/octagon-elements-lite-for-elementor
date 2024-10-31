<?php
/**
 *
 * @package octagon-elements-lite-for-elementor/includes
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.1
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;

add_filter( 'use_block_editor_for_post_type', '__return_false' );

if( ! function_exists( 'oee_get_shortcode_template' ) ) {

	/**
	 * Get other templates passing attributes and including the file
	 * 
	 * @version  1.0
	 * @since  1.0
	 * @param  string 	$name 	Template File
	 * @param  array 	$atts 	Arguements
	 * @return string
	 */
	function oee_get_shortcode_template( $name = '', $element = '', $content = '', $code = '' ) {

		$template_name = "/shortcodes/{$name}.php";

		if( file_exists( get_template_directory() . $template_name ) ) {
			$located = get_template_directory() . $template_name;
		}
		elseif( file_exists( get_stylesheet_directory() . $template_name ) ) {
			$located = get_stylesheet_directory() . $template_name;
		}
		else {
			$located = OEE_PATH . "/shortcodes/{$name}.php";
		}

		ob_start();
		include $located;
		return ob_get_clean();

	}

}

if( ! function_exists( 'oee_get_live_template' ) ) {

	/**
	 * Include elements live template
	 * 
	 * @version  1.0
	 * @since  1.0
	 * @param  string 	$name 	Template File
	 * @param  array 	$atts 	Arguements
	 * @return string
	 */
	function oee_get_live_template( $name = '' ) {

		$template_name = "/shortcodes/live/{$name}.php";

		if( file_exists( get_template_directory() . $template_name ) ) {
			$located = get_template_directory() . $template_name;
		}
		elseif( file_exists( get_stylesheet_directory() . $template_name ) ) {
			$located = get_stylesheet_directory() . $template_name;
		}
		else {
			$located = OEE_PATH . "shortcodes/live/{$name}.php";
		}

		ob_start();
		include $located;
		return ob_get_clean();

	}

}

if( ! function_exists( 'octagon_title_tag' ) ) {

	/**
	 * Returns title tag
	 * 
	 * @version  1.0
	 * @since  1.0
	 * @param  string  $tag HTML Tag
	 * @return array
	 */
	function octagon_title_tag( $tag = 'h3' ) {

		$value = [];

		$tag_list = ['h1','h2','h3','h4','h5','h6','p','span','div'];

		return in_array( $tag, $tag_list ) ? $tag : 'h3';

	}

}

if( ! function_exists( 'octagon_all_consequence_term_ids' ) ) {

	/**
	 * Returns all related term ids based on posts
	 * 
	 * @version  1.0
	 * @since  1.0
	 * @param  int  $id 	Post ID
	 * @param  string  $taxonomy Taxonomy
	 * @return array
	 */
	function octagon_all_consequence_term_ids( $id = 0, $taxonomy = 'category' ) {

		$value = [];

		$terms = get_the_terms( $id, $taxonomy );
		
		if( ! empty( $terms ) ) {
			foreach( $terms as $key => $term ) {
				$value[] = $term->term_id;
			}
		}

		return $value;

	}

}

if( ! function_exists( 'octagon_all_consequence_term_slugs' ) ) {

	/**
	 * Returns all related term slugs based on posts
	 * 
	 * @version  1.0
	 * @since  1.0
	 * @param  int  $id 	Post ID
	 * @param  string  $taxonomy Taxonomy
	 * @return array
	 */
	function octagon_all_consequence_term_slugs( $id = 0, $taxonomy = 'category' ) {

		$value = [];

		$terms = get_the_terms( $id, $taxonomy );
		
		if( ! empty( $terms ) ) {
			foreach( $terms as $key => $term ) {
				$value[] = $term->slug;
			}
		}

		return $value;

	}

}

if( ! function_exists( 'octagon_get_excerpt' ) ) {

	/**
	 * Get excerpt
	 * 
	 * @version  1.0
	 * @since  1.0
	 * @param  int  $charlength Character Length
	 * @return string
	 */
	function octagon_get_excerpt( $charlength = 150 ) {

		return octagon_short_text( get_the_excerpt(), $charlength );

	}

}



if( ! function_exists( 'octagon_get_meta' ) ) {

	/**
	 * Get metabox value
	 * 
	 * @version  1.0
	 * @since  1.0
	 * @param  int  	$post_id 	Post ID
	 * @param  string  	$key 		Meta Key
	 * @param  string  	$default 	Default Value
	 * @return string
	 */
	function octagon_get_meta( $post_id = null, $key = '', $default = '' ) {

		$value = get_post_meta( $post_id, $key, true );

		$value = ( null == $value || '' == $value ) ? $default : $value;

		return $value;

	}

}



if( ! function_exists( 'octagon_pagination' ) ) {

	/**
	 * Get pagination
	 * 
	 * @version  1.1
	 * @since  1.0
	 * @param  string 	$style 	Style
	 * @param  array 	$value 	Required Values
	 * @return mixed
	 */
	function octagon_pagination( $style = 'number', $value = array( 'type' => 'page', 'args' => [], 'options' => [], 'max' => null, 'ajax' => '' ) ) {

		$pagination = '';

		$type    = isset( $value['type'] ) ? $value['type'] : 'page';
		$args    = isset( $value['args'] ) ? $value['args'] : [];
		$options = isset( $value['options'] ) ? $value['options'] : [];
		$max     = isset( $value['max'] ) ? $value['max'] : null;
		$ajax    = isset( $value['ajax'] ) ? $value['ajax'] : 'post_loadmore';

		if( ! isset( $max ) || null == $max ) {
			global $wp_query;
			$max = $wp_query->max_num_pages;
		}

		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : ( ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1 );

		$paginate = array(
			'base'               => esc_url_raw( str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ) ),
			'format'             => '?paged=%#%',
			'total'              => $max,
			'current'            => max( 1, $paged ),
			'show_all'           => false,
			'end_size'           => 3,
			'mid_size'           => 3,
			'prev_next'          => true,
			'prev_text'          => esc_html__( 'Previous', 'octagon-elements-lite-for-elementor' ),
			'next_text'          => esc_html__( 'Next', 'octagon-elements-lite-for-elementor' ),
			'type'               => 'list',
			'add_args'           => false
		);

		$uid = octagon_random();

		$object = array( 
			$uid => array(
				'options' => ! empty( $options ) ? $options : [],
				'args'    => ! empty( $args ) ? $args : [],
				'max'     => $max,
				'isotope' => isset( $options['isotope'] ) && ( $options['isotope'] ) ? true : false,
				'ajax'    => $ajax
			)
		);

		$btn_class   = array( 'btn btn-size-mini' );
		$btn_class[] = isset( $options['loadmore_btn_type'] ) ? $options['loadmore_btn_type'] : 'btn-type-solid-ellipse';
		$btn_class[] = isset( $options['loadmore_btn_color'] ) ? $options['loadmore_btn_color'] : 'btn-color-black';
		$btn_class[] = isset( $options['loadmore_btn_gradient_palette'] ) ? $options['loadmore_btn_gradient_palette'] : '';

		octagon_concatenate_localize_scripts( 'octagon-core-tools', 'octagon_localize', $object );

		ob_start();

		if( 'number' == $style ) :
			?>

			<nav class="pagination">
				<?php echo paginate_links( $paginate ); ?>
			</nav> <!-- .pagination -->

			<?php
		elseif( 'next-prev' == $style ) :
			?>
			<nav class="pagination">
				<ul>
					<?php if( get_previous_posts_link() ) : ?>
						<li class="previous"><?php echo get_previous_posts_link( esc_html__( 'Previous', 'octagon-elements-lite-for-elementor' ) ); ?></li>
					<?php endif;
					if( get_next_posts_link( '', $max ) ) : ?>
						<li class="next"><?php echo get_next_posts_link( esc_html__( 'Next', 'octagon-elements-lite-for-elementor' ), $max ); ?></li>
					<?php endif; ?>
				</ul>
			</nav> <!-- .pagination -->
			<?php 
		elseif( 'loadmore' == $style ) :
			?>

			<div class="btn-loadmore" data-type="<?php echo esc_attr( $type ); ?>" data-uid="<?php echo esc_attr( $uid ); ?>" data-paged="<?php echo esc_attr( $paged ); ?>">
	
				<?php if( get_next_posts_link( '', $max ) ) : ?>
					<a href="<?php echo esc_url( get_next_posts_page_link() ); ?>" class="<?php echo esc_attr( implode( ' ', $btn_class ) ); ?>">
						<div class="loader"><div></div></div>
						<?php esc_html_e( 'Loadmore', 'octagon-elements-lite-for-elementor' ) ?>
					</a>
				<?php endif; ?>

			</div> <!-- .btn-loadmore -->
			<?php
		elseif( 'infinite-scroll' == $style ) :
			?>

			<div class="btn-loadmore infinite-scroll" data-type="<?php echo esc_attr( $type ); ?>" data-uid="<?php echo esc_attr( $uid ); ?>" data-paged="<?php echo esc_attr( $paged ); ?>">
	
				<?php if( get_next_posts_link( '', $max ) ) : ?>
					<a href="<?php echo esc_url( get_next_posts_page_link() ); ?>" class="btn">
						<div class="loader"><div></div></div>
						<?php esc_html_e( 'Loadmore', 'octagon-elements-lite-for-elementor' ) ?>
					</a>
				<?php endif; ?>

			</div> <!-- .btn-loadmore -->

			<?php
		endif;

		$pagination = ob_get_clean();

		return $pagination;
	}

}
