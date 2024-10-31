<?php
/**
 *
 * @package octagon-elements-lite-for-elementor/core
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.4
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;

if( ! function_exists( 'octagon_concatenate_localize_scripts' ) ) {

	/**
	 * Append and Print the localize scripts object if it is possess same handle
	 * 
	 * @version 1.0
	 * @since  1.0
	 * @param  string $handle    Enqueue JS Handle
	 * @param  string $name   	 Object Name
	 */
	function octagon_concatenate_localize_scripts( $handle = '', $name = '', $value = [] ) {

		global $wp_scripts;
		$data = $wp_scripts->get_data( $handle, 'data' );

		if( empty( $data ) ) {
			wp_localize_script( $handle, $name, $value );
		}
		else {

			if( ! is_array( $data ) ) {
				$data = json_decode( str_replace( 'var '. $name .' = ', '', substr( $data, 0, -1 ) ), true );
			}

			$localize_script = array_merge( $data, $value );
			$wp_scripts->add_data( $handle, 'data', '' );
			
			wp_localize_script( $handle, $name, $localize_script );
		}
	}
}

if( ! function_exists( 'octagon_minify' ) ) {

	/**
	 * Minify CSS
	 * 
	 * @version 1.0
	 * @since  1.0
	 * @param  string $css    CSS Rules
	 * @return string
	 */
	function octagon_minify( $css ) {

		// Remove comments
		$css = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css );

		// Remove whitespace
		$css = str_replace( array("\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $css );

		return $css;
	}

}

if( ! function_exists( 'octagon_remove_extra_space' ) ) {

	/**
	 * Remove extra spaces
	 * 
	 * @version 1.0
	 * @since  1.0
	 * @param  string $string String
	 * @return string
	 */
	function octagon_remove_extra_space( $string ) {

		$string = preg_replace( '/\s+/', ' ', $string );

		return $string;
	}

}

if( ! function_exists( 'octagon_raw_content' ) ) {

	/**
	 * Return raw post content
	 * 
	 * @version 1.0
	 * @since  1.0
	 * @param  string 	$id 	Post ID
	 * @return mixed
	 */
	function octagon_raw_content( $id = 0 ) {

		$content = '';

		if( false !== get_post_status( $id ) ) {

			$content = get_post_field( 'post_content_filtered', $id );
			if( empty( $content ) ) {
				$content = get_post_field( 'post_content', $id );
			}

		}

		return $content;
	}

}

if( ! function_exists( 'octagon_get_cookie' ) ) {

	/**
	 * Get cookie value
	 * 
	 * @version 1.0
	 * @since  1.0
	 * @param  string  	$key 	Cookie Key
	 * @return mixed
	 */
	function octagon_get_cookie( $key = '' ) {

		$value = isset( $_COOKIE[$key] ) ? $_COOKIE[$key] : '';

		return $value;
	}
}

if( ! function_exists( 'octagon_short_text' ) ) {

	/**
	 * Shorten string
	 * 
	 * @version 1.0
	 * @since  1.0
	 * @param  string  $string 	Text
	 * @param  int  $charlength Character Length
	 * @return string
	 */
	function octagon_short_text( $string = '', $charlength = 150 ) {

		$suffix = apply_filters( 'octagon_get_excerpt_suffix', '...' );

		if( '' != $string ) {

			$charlength++;

			if ( mb_strlen( $string ) > $charlength ) {

				$subex = mb_substr( $string, 0, $charlength - 5 );
				$exwords = explode( ' ', $subex );
				$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );

				if ( $excut < 0 ) {
					return mb_substr( $subex, 0, $excut ) . $suffix;
				}
				else {
					return $subex . $suffix;
				}
			}
			else {
				return $string;
			}

		}

	}

}

if( ! function_exists( 'octagon_random' ) ) {

	/**
	 * Generate random string
	 * 
	 * @version 1.0
	 * @since  1.0
	 * @param  int $length    String Length
	 * @return string
	 */
	function octagon_random( $length = 10 ) {
	    return substr( str_shuffle( str_repeat( $x='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil( $length/strlen( $x ) ) ) ), 1, $length );
	}
}

if( ! function_exists( 'octagon_change_case' ) ) {

	/**
	 * Change string cases
	 * 
	 * @version 1.0
	 * @since  1.4
	 * @param  string $string String
	 * @param  string $case Case type
	 * @return string
	 * @see https://www.chaseadams.io/posts/most-common-programming-case-types/
	 */
	function octagon_change_case( $string = '', $case = 'kebab' ) {

		$value = '';

		if( '' != $string ) {
			$value = trim( $string );

			switch ( $case ) {

				/*
				 * Eg: 'kebab-case-var'
				 */
				case 'kebab':
					$value = strtolower( $string );
					$value = preg_replace( array( '/\s+/', '/_/' ), '-', $value );
				break;

				/*
				 * Eg: 'camelCaseVar'
				 */
				case 'camel':
					$value = lcfirst( ucwords( $string ) );
					$value = preg_replace( array( '/\s+/', '/_/', '/-/' ), '', $value );
				break;
				
				/*
				 * Eg: 'PascalCaseVar'
				 */
				case 'pascal':
					$value = ucwords( $string );
					$value = preg_replace( array( '/\s+/', '/_/', '/-/' ), '', $value );
				break;

				/*
				 * Eg: 'snake_case_var'
				 */
				case 'snake':
					$value = strtolower( $string );
					$value = preg_replace( array( '/\s+/', '/-/' ), '_', $value );
				break;

				/*
				 * Eg: 'SNAKE_CAPS_CASE_VAR'
				 */
				case 'snake-caps':
					$value = strtoupper( $string );
					$value = preg_replace( array( '/\s+/', '/-/' ), '_', $value );
				break;

				/*
				 * Eg: 'Snake_Pascal_Var'
				 */
				case 'snake-pascal':
					$value = ucwords( $string );
					$value = preg_replace( array( '/\s+/', '/-/' ), '_', $value );
				break;
				
				default:
				break;
			}
		}

		return $value;
	}
}

if( ! function_exists( 'octagon_current_url' ) ) {

	/**
	 * Returns current page URL
	 * 
	 * @version 1.0
	 * @since  1.0
	 * @return string
	 */
	function octagon_current_url() {
		global $wp;
	    return home_url( $wp->request );
	}
}

if( ! function_exists( 'octagon_width_from_column' ) ) {

	/**
	 * Get width based on column
	 * 
	 * @version  1.0
	 * @since  1.4
	 * @param  string $column  Column number
	 * @return int
	 */
	function octagon_width_from_column( $column = '3', $total_width = '1140' ) {

		if( '1' == $column ) {
			$percentage = 8.33333333;
		}
		elseif( '2' == $column ) {
			$percentage = 16.66666667;
		}
		elseif( '3' == $column ) {
			$percentage = 25;
		}
		elseif( '4' == $column ) {
			$percentage = 33.33333333;
		}
		elseif( '5' == $column ) {
			$percentage = 41.66666667;
		}
		elseif( '6' == $column ) {
			$percentage = 50;
		}
		elseif( '7' == $column ) {
			$percentage = 58.33333333;
		}
		elseif( '8' == $column ) {
			$percentage = 66.66666667;
		}
		elseif( '9' == $column ) {
			$percentage = 75;
		}
		elseif( '10' == $column ) {
			$percentage = 83.33333333;
		}
		elseif( '11' == $column ) {
			$percentage = 91.66666667;
		}
		elseif( '12' == $column ) {
			$percentage = 100;
		}

		$width = (int) round( ( $percentage/100 ) * $total_width );

		return $width;
	}
}

if( ! function_exists( 'octagon_in_percentage' ) ) {

	/**
	 * Convert interger based on percntage
	 * 
	 * @version 1.0
	 * @since  1.4
	 * @param  int 	$value 			Value
	 * @param  int 	$percentage 	Percentage
	 * @return int
	 */
	function octagon_in_percentage( $value = '', $percentage = 100 ) {

		$percent_in_decimal = $percentage / 100;

		$convert = ( int ) ceil( $percent_in_decimal * $value );

		return $convert;
	}
}

if( ! function_exists( 'octagon_is_tel' ) ) {

	/**
	 * Validate phone number
	 * 
	 * @version 1.0
	 * @since  1.0
	 * @param  string $tel    Phone Number
	 * @return bool
	 */
	function octagon_is_tel( $tel ) {

		$result = preg_match( '/^[+]?[0-9() -]*$/', $tel );
		
		return apply_filters( 'octagon_is_tel', $result, $tel );

	}
}

if( ! function_exists( 'octagon_is_email' ) ) {

	/**
	 * Validate email address
	 * 
	 * @version 1.0
	 * @since  1.0
	 * @param  string $string    Email Address
	 * @return bool
	 */
	function octagon_is_email( $string ) {

		$result = ( false !== filter_var( $url, FILTER_VALIDATE_URL ) );

		return apply_filters( 'octagon_is_email', $result, $url );

	}
}

if( ! function_exists( 'octagon_is_url' ) ) {

	/**
	 * Validate url
	 * 
	 * @version 1.0
	 * @since  1.0
	 * @param  string $url    URL
	 * @return bool
	 */
	function octagon_is_url( $url ) {

		$result = ( false !== filter_var( $url, FILTER_VALIDATE_URL ) );

		return apply_filters( 'octagon_is_url', $result, $url );

	}
}

if( ! function_exists( 'octagon_is_number' ) ) {

	/**
	 * Validate number
	 * 
	 * @version 1.0
	 * @since  1.0
	 * @param  string $number    number
	 * @return bool
	 */
	function octagon_is_number( $number ) {

		$result = is_numeric( $number );

		return apply_filters( 'octagon_is_number', $result, $number );

	}
}

if( ! function_exists( 'octagon_in_array_all' ) ) {

	/**
	 * Check all passed array values exists in array
	 * 
	 * @version 1.3
	 * @since  1.0
	 * @param  array $needles    Checking array value
	 * @param  array $haystack   Main Array
	 * @return string
	 */
	function octagon_in_array_all( $needles, $haystack ) {
	    return is_array( $needles ) && is_array( $haystack ) ? empty( array_diff( $needles, $haystack ) ) : false;
	}
}



if( ! function_exists( 'octagon_in_array_any' ) ) {

	/**
	 * Check any of the passed array values exists in array
	 * 
	 * @version 1.0
	 * @since  1.0
	 * @param  array $needles    Checking array value
	 * @param  array $haystack   Main Array
	 * @return string
	 */
	function octagon_in_array_any( $needles, $haystack ) {
	    return ! empty( array_intersect( $needles, $haystack ) );
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

if( ! function_exists( 'octagon_get_cropped_image' ) ) {
	
	/**
	 * Returns HTML elements
	 * 
	 * @version 1.0
	 * @since  1.0
	 * @param  int  	$attachment_id Attachment ID
	 * @param  int  	$width         Image Width
	 * @param  int  	$height        Image Height
	 * @param  bool 	$required      Required Image
	 * @param  array   	$srcset        Image src Set
	 * @param  array   	$attribute     Image Additional Attributes
	 * @return mixed
	 */
	function octagon_get_cropped_image( $attachment_id = '', $width = 'full', $height = 'full', $required = false, $srcset = [], $attribute = [] ) {

		$image = '';

		$attachment_id = ( '' == $attachment_id ) ? get_post_thumbnail_id() : $attachment_id;

		$url = octagon_get_cropped_url( $attachment_id, $width, $height );
		$caption = wp_get_attachment_caption( $attachment_id );

		if( $url ) {

			$attr[] = 'src="'. esc_url( $url ) .'"';
			$attr[] = ! empty( $srcset ) ? octagon_get_image_set( $attachment_id, $srcset ) : '';
			$attr[] = 'alt="'. esc_attr( $caption ) .'"';
			$attr[] = ! empty( $attribute ) ? implode( ' ', $attribute ) : '';

			$attr = array_filter( $attr );

			$image = '<img '. implode( ' ', $attr ) .'  >';
		}
		elseif( ! $url && $required ) {
			$image = octagon_get_placeholder_image( $width, $height );
		}

		return apply_filters( 'octagon_get_cropped_image', $image, $attachment_id );
	}
}

if( ! function_exists( 'octagon_get_cropped_url' ) ) {

	/**
	 * Returns Image url
	 * 
	 * @version 1.0
	 * @since  1.0
	 * @param  int  	$attachment_id Attachment ID
	 * @param  int  	$width         Image Width
	 * @param  int  	$height        Image Height
	 * @return string
	 */
	function octagon_get_cropped_url( $attachment_id = '', $width = null, $height = null ) {

		$crop_url = false;

		$attachment_id = ( '' == $attachment_id ) ? get_post_thumbnail_id() : $attachment_id;

		$url = wp_get_attachment_url( $attachment_id );

		if( $url && null != $width ) {
			$crop_url = function_exists( 'octagon_crop' ) ? octagon_crop( $url, $width, $height ) : false;
		}

		$url = ! empty( $crop_url ) ? $crop_url : $url;

		return $url;
	}
}

if( ! function_exists( 'octagon_get_placeholder_image' ) ) {

	/**
	 * Returns placeholder image HTML element
	 * 
	 * @version 1.4
	 * @since  1.0
	 * @param  int 	$width 		Image Width
	 * @param  int 	$height 	Image Height
	 * @return mixed
	 */
	function octagon_get_placeholder_image( $width = 'full', $height = 'full' ) {

		$width  = ( 'full' == $width || null == $width ) ? 1200 : $width;
		$height = ( 'full' == $height || null == $height ) ? 1200 : $height;

		/**
		 * To modify the placeholder image src.
		 *
		 * @since 1.4
		 */
		$image_src = apply_filters( 'octagon_get_placeholder_image_src', OEE_URL .'assets/image/placeholder.png' );

		$image = '<img src="'. esc_url( $image_src ) .'" class="placeholder-image" width="'. esc_attr( $width ) .'" height="'. esc_attr( $height ) .'" alt="'. esc_attr__( 'Placeholder Image', 'octagon-elements-lite-for-elementor' ) .'">';

		/**
		 * To modify the placeholder image html.
		 *
		 * @since 1.0
		 */
		return apply_filters( 'octagon_get_placeholder_image', $image );
	}
}

if( ! function_exists( 'octagon_get_image_set' ) ) {

	/**
	 * Returns image src set attributes
	 * 
	 * @version 1.4
	 * @since  1.0
	 * @param  int 		$attachment_id 	Attachment ID
	 * @param  array 	$srcset 		Image src Set
	 * @return string
	 */
	function octagon_get_image_set( $attachment_id = '', $srcset = [] ) {

		$srcset_html = [];

		/**
		 * Allow adaptive images srcset.
		 *
		 * @since 1.4
		 */
		$adaptive_images = apply_filters( 'octagon_allow_adaptive_images', false );

		if( ! empty( $srcset ) && $adaptive_images ) {

			foreach( $srcset as $key => $set ) {
				$srcset_html[] .= octagon_get_cropped_url( $attachment_id, $set[0], $set[1] ) . ' '. $key . 'w';
			}

			return 'srcset="'. esc_attr( implode( ', ', $srcset_html ) ) .'"';
		}
		else {
			return false;
		}

		
	}
}

if( ! function_exists( 'octagon_post_type_list' ) ) {

	/**
	 * Post type array list
	 * 
	 * @version 1.0
	 * @since  1.0
	 * @return array
	 */
	function octagon_post_type_list() {

		$content_type_list = [];
		$post_types = get_post_types( array(
				'public'   => true,
				'_builtin' => false
			),
			'name'
		);

		$post_types = array_merge( array( 'post' => 'post' ), $post_types );

		foreach( $post_types as $key => $post_type ) {
			$obj = get_post_type_object( $key );
			$content_type_list[$key] = $obj->labels->singular_name;
		}

		return $content_type_list;

	}

}

if( ! function_exists( 'octagon_taxonomy_list' ) ) {

	/**
	 * Taxonomy array list
	 * 
	 * @version 1.0
	 * @since  1.0
	 * @return array
	 */
	function octagon_taxonomy_list() {

		$taxonomy_list = [];
		$taxonomies = get_taxonomies( array(
				'public'   => true,
				'_builtin' => false
			),
			'names'
		);

		$taxonomies = array_merge( array( 'category' => 'category' ), $taxonomies );
		foreach( $taxonomies as $key => $taxonomy ) {
			$obj = get_taxonomy( $key );
			$taxonomy_list[$key] = $obj->labels->singular_name;
		}

		return $taxonomy_list;

	}

}

if( ! function_exists( 'octagon_nav_menu_list' ) ) {

	/**
	 * Created navigation menus array list
	 * 
	 * @version 1.0
	 * @since  1.0
	 * @return array
	 */
	function octagon_nav_menu_list() {

		$nav_menus_list = false;

		$nav_menus = wp_get_nav_menus();

		if( null != $nav_menus ) {
			$nav_menus_list = wp_list_pluck( $nav_menus, 'name', 'slug' );
		}

		return $nav_menus_list;

	}

}

if( ! function_exists( 'octagon_get_server_info' ) ) {

	/**
	 * Get server info
	 * @version 1.0
	 * @since  1.0
	 * @return string
	 */
	function octagon_get_server_info() {
		return isset( $_SERVER['SERVER_SOFTWARE'] ) ? wp_unslash( $_SERVER['SERVER_SOFTWARE'] ) : '';
	}
}

if( ! function_exists( 'octagon_get_current_post_type' ) ) {

	/**
	 * Get current post type on admin screens
	 * 
	 * @version 1.0
	 * @since  1.0
	 * @return string
	 */
	function octagon_get_current_post_type() {

		global $post, $typenow, $current_screen;

		$post_type = isset( $_GET['post_type'] ) ? sanitize_key( $_GET['post_type'] ) : '';
		$post_id   = isset( $_GET['post'] ) ? absint( $_GET['post'] ) : '';

		// we have a post so we can just get the post type from that
		if( $post && $post->post_type ) {
			return $post->post_type;
		}

		// check the global $typenow - set in admin.php
		elseif( $typenow ) {
			return $typenow;
		}

		// check the global $current_screen object - set in sceen.php
		elseif( $current_screen && $current_screen->post_type ) {
			return $current_screen->post_type;
		}

		// check the post_type querystring
		elseif( $post_type ) {
			return $post_type;
		}

		// lastly check if post ID is in query string
		elseif( isset( $post_id ) ) {
			return get_post_type( $post_id );
		}

		// we do not know the post type!
		return null;

	}
}

if( ! function_exists( 'octagon_page_ids_array' ) ) {

	/**
	 * Page list array
	 * 
	 * @version  1.4
	 * @since  1.0
	 * @param  array  $pages Pages
	 * @return array
	 */
	function octagon_page_ids_array( $args = [], $pages = [] ) {

		$woo_id = [];

		if( octagon_woo_exists() ) {
			$woo_id[] = wc_get_page_id( 'shop' ); 
			$woo_id[] = wc_get_page_id( 'cart' ); 
			$woo_id[] = wc_get_page_id( 'checkout' );
			$woo_id[] = wc_get_page_id( 'myaccount' );
			$woo_id[] = wc_get_page_id( 'terms' );
		}		

		$defaults = array(
			'orderby'     => 'title',
			'exclude'     => $woo_id,
			'post_type'   => 'page',
			'post_parent' => '',
			'numberposts' => -1,
			'post_status' => 'publish'
		);

		$args = wp_parse_args( $args, $defaults );

		$pages_obj = get_posts( $args );

		$pages[0] = esc_html__( 'Choose a Page', 'octagon-elements-lite-for-elementor' );
		if( ! empty( $pages_obj ) ) {
			foreach( $pages_obj as $key => $value ) {
				$pages[$value->ID] = $value->post_title;
			}
		}

		/**
		 * List of page ID's and title as arrays.
		 *
		 * @since 1.0
		 */
		return apply_filters( 'octagon_page_ids_array_filter', $pages );
	}
}

if( ! function_exists( 'octagon_allowed_html_tags' ) ) {

	/**
	 * Allowed HTML tags
	 * 
	 * @version  1.0
	 * @since  1.0
	 * @return array
	 */
	function octagon_allowed_html_tags() {

		$allowed_tags = array(
			'a' => array(
				'class' => [],
				'href'  => [],
				'rel'   => [],
				'title' => [],
			),
			'abbr' => array(
				'title' => [],
			),
			'b' => [],
			'blockquote' => array(
				'cite'  => [],
			),
			'cite' => array(
				'title' => [],
			),
			'code' => [],
			'del' => array(
				'datetime' => [],
				'title' => [],
			),
			'dd' => [],
			'div' => array(
				'class' => [],
				'title' => [],
				'style' => [],
			),
			'dl' => [],
			'dt' => [],
			'em' => [],
			'h1' => array(
				'class'  => []
			),
			'h2' => array(
				'class'  => []
			),
			'h3' => array(
				'class'  => []
			),
			'h4' => array(
				'class'  => []
			),
			'h5' => array(
				'class'  => []
			),
			'h6' => array(
				'class'  => []
			),
			'i' => array(
				'class'  => []
			),
			'img' => array(
				'alt'    => [],
				'class'  => [],
				'height' => [],
				'src'    => [],
				'width'  => [],
			),
			'li' => array(
				'class' => [],
			),
			'ol' => array(
				'class' => [],
			),
			'p' => array(
				'class' => [],
			),
			'q' => array(
				'cite' => [],
				'title' => [],
			),
			'span' => array(
				'class' => [],
				'title' => [],
				'style' => [],
			),
			'strike' => [],
			'strong' => [],
			'ul' => array(
				'class' => [],
			),
		);
		
		/**
		 * Global allowed html tags for `wp_kses` function.
		 *
		 * @since 1.0
		 */
		return apply_filters( 'octagon_allowed_html_tags', $allowed_tags );
	}

}

if( ! function_exists( 'octagon_mime_type' ) ) {

	/**
	 * Split the mime type to file type. Eg: image/jpeg to image
	 * 
	 * @version  1.0
	 * @since  1.0
	 * @param  string  	$mime_type 	Mime Type
	 * @return string
	 */
	function octagon_mime_type( $mime_type ) {

		$type = false;

		if( $mime_type ) {
			$mime_type = explode( '/', $mime_type );
			$type = isset( $mime_type ) ? $mime_type[0]: false;
		}

		return $type;
	}

}

if( ! function_exists( 'octagon_get_media_preview' ) ) {

	/**
	 * Returns media preview HTML elements
	 * 
	 * @version  1.0
	 * @since  1.0
	 * @param  int  	$attachment_id 	Attachment ID
	 * @param  string  	$library 		Image, Audio, Video, Text or Application
	 * @return mixed
	 */
	function octagon_get_media_preview( $attachment_id, $library ) {

		$html = '';

		if( ! empty( $attachment_id ) ) {

			$attachment_id = explode( ',', $attachment_id );

			if( 'image' == $library ) {
				foreach( $attachment_id as $key => $id ) {

					$mime_type = get_post_mime_type( $id );

					$mime = octagon_mime_type( $mime_type );

					if( $mime && 'image' == $mime ) {
						$image = wp_get_attachment_image_src( $id, 'thumbnail', false );
						$html .= '<div class="media">';
							$html .= '<img src="'. esc_url( $image[0] ) .'">';
							$html .= '<span class="remove-icon remove-custom-media" data-id="'. esc_attr( $id ) .'">x</span>';
						$html .= '</div>';
					}
				}
			}
			elseif( 'video' == $library || 'audio' == $library ) {

				foreach( $attachment_id as $key => $id ) {

					$mime_type = get_post_mime_type( $id );

					$mime = octagon_mime_type( $mime_type );

					$url = wp_get_attachment_url( $id );

					if( $mime && ( 'video' == $mime || 'audio' == $mime ) ) {							

						$html .= '<div class="media">';
							$html .= '<'. esc_html( $mime ) .' controls>
								<source src="'. esc_attr( $url ) .'" type="'. esc_attr( $mime_type ) .'">
							</'. esc_html( $mime ) .'>';
							$html .= '<span class="remove-icon remove-custom-media" data-id="'. esc_attr( $id ) .'">x</span>';
						$html .= '</div>';

					}
					
				}

			}
			elseif( 'text' == $library || 'application' == $library ) {

				foreach( $attachment_id as $key => $id ) {

					$mime_type = get_post_mime_type( $id );

					$mime = octagon_mime_type( $mime_type );

					if( $mime && ( 'text' == $mime || 'application' == $mime ) ) {

						$html .= '<div class="media">';
							$html .= '<span class="doc-icon dashicons dashicons-media-default"></span>';
							$html .= '<p class="file-name">'. esc_html( wp_basename( get_attached_file( $id ) ) ) .'</p>';
							$html .= '<span class="remove-icon remove-custom-media" data-id="'. esc_attr( $id ) .'">x</span>';
						$html .= '</div>';

					}
					
				}					

			}

		}

		return $html;

	}
}

add_action( 'wp_ajax_octagon_get_media_preview_ajax',  'octagon_get_media_preview_ajax' );
add_action( 'wp_ajax_nopriv_octagon_get_media_preview_ajax', 'octagon_get_media_preview_ajax' );

if( ! function_exists( 'octagon_get_media_preview_ajax' ) ) {

	/**
	 * Returns HTML elements
	 * 
	 * @version  1.0
	 * @since  1.0
	 * @return mixed
	 */
	function octagon_get_media_preview_ajax() {

		$attachment_id = isset( $_POST['attachment_id'] ) ? array_map( 'intval', $_POST['attachment_id'] ) : '';
		$library       = isset( $_POST['library'] ) && in_array( $_POST['library'], array( 'image', 'audio', 'video', 'text', 'application' ) ) ? sanitize_key( $_POST['library'] ) : 'image';

		if( ! empty( $attachment_id ) ) {
			$attachment_id = implode( ',', $attachment_id );
			echo octagon_get_media_preview( $attachment_id, $library );
		}

		die();

	}
}

if( ! function_exists( 'octagon_woo_exists' ) ) {

	/**
	 * WooCommerce Exists
	 * 
	 * @version  1.0
	 * @since  1.0
	 * @return bool
	 */
	function octagon_woo_exists() {

		$exists = false;

		if( class_exists( 'WooCommerce' ) ) {
			$exists = true;
		}

		return $exists;

	}

}

if( ! function_exists( 'octagon_contact_form_exists' ) ) {

	/**
	 * Contact Form 7 Exists
	 * 
	 * @version  1.0
	 * @since  1.0
	 * @return bool
	 */
	function octagon_contact_form_exists() {

		$exists = false;

		if( class_exists( 'WPCF7' ) ) {
			$exists = true;
		}

		return $exists;

	}

}

if( ! function_exists( 'octagon_bbpress_exists' ) ) {

	/**
	 * bbPress Exists
	 * 
	 * @version  1.0
	 * @since  1.0
	 * @return bool
	 */
	function octagon_bbpress_exists() {

		$exists = false;

		if( class_exists( 'bbPress' ) ) {
			$exists = true;
		}

		return $exists;

	}

}
