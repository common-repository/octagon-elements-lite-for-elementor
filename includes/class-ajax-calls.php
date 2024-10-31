<?php
/**
 *
 * @package octagon-elements-lite-for-elementor/includes
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.3
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;

if( ! class_exists( 'OEE_Ajax_Calls' ) ) {

	class OEE_Ajax_Calls {

		public $lostpassword_url = '';

		/**
		 * Constructor.
		 * 
		 * @version  1.3 
		 * @since 1.0
		 * @access public
		 */
		public function __construct() {

			/* Post Likes ---------------------------------------------------------------- */
			add_action( 'wp_ajax_octagon_post_likes',  [ $this, 'post_likes' ] );
			add_action( 'wp_ajax_nopriv_octagon_post_likes', [ $this, 'post_likes' ] );


			/* Content Type Element Loadmore --------------------------------------------- */
			add_action( 'wp_ajax_octagon_content_type_loadmore',  [ $this, 'content_type_loadmore' ] );
			add_action( 'wp_ajax_nopriv_octagon_content_type_loadmore', [ $this, 'content_type_loadmore' ] );


			/* Content Type List Element Loadmore ---------------------------------------- */
			add_action( 'wp_ajax_octagon_content_type_list_loadmore',  [ $this, 'content_type_list_loadmore' ] );
			add_action( 'wp_ajax_nopriv_octagon_content_type_list_loadmore', [ $this, 'content_type_list_loadmore' ] );


			/* Portfolio Element Loadmore ------------------------------------------------ */
			add_action( 'wp_ajax_octagon_portfolio_loadmore',  [ $this, 'portfolio_loadmore' ] );
			add_action( 'wp_ajax_nopriv_octagon_portfolio_loadmore', [ $this, 'portfolio_loadmore' ] );


			/* Products Element Loadmore ------------------------------------------------- */
			add_action( 'wp_ajax_octagon_products_loadmore',  [ $this, 'products_loadmore' ] );
			add_action( 'wp_ajax_nopriv_octagon_products_loadmore', [ $this, 'products_loadmore' ] );


			/* Login --------------------------------------------------------------------- */
			add_action( 'wp_ajax_octagon_login',  [ $this, 'login' ] );
			add_action( 'wp_ajax_nopriv_octagon_login', [ $this, 'login' ] );


			/* Lost Password ------------------------------------------------------------- */
			add_action( 'wp_ajax_octagon_lost_password',  [ $this, 'lostpassword' ] );
			add_action( 'wp_ajax_nopriv_octagon_lost_password', [ $this, 'lostpassword' ] );

			add_filter( 'retrieve_password_message', [ $this, 'retrieve_password_message' ], 10, 4 );


			/* Reset Password ------------------------------------------------------------ */
			add_action( 'wp_ajax_octagon_reset_password',  [ $this, 'resetpassword' ] );
			add_action( 'wp_ajax_nopriv_octagon_reset_password', [ $this, 'resetpassword' ] );


			/* Register ------------------------------------------------------------------ */
			add_action( 'wp_ajax_octagon_register',  [ $this, 'register' ] );
			add_action( 'wp_ajax_nopriv_octagon_register', [ $this, 'register' ] );


			/* Register ------------------------------------------------------------------ */
			add_action( 'wp_ajax_octagon_update_profile',  [ $this, 'update_profile' ] );
			add_action( 'wp_ajax_nopriv_octagon_update_profile', [ $this, 'update_profile' ] );


			/* Products Search ----------------------------------------------------------- */
			add_action( 'wp_ajax_octagon_products_search', [ $this, 'products_search' ] );
			add_action( 'wp_ajax_nopriv_octagon_products_search', [ $this, 'products_search' ] );


			/* Compare Products ---------------------------------------------------------- */

			add_action( 'wp_ajax_octagon_add_compare_products', [ $this, 'add_compare_products' ] );
			add_action( 'wp_ajax_nopriv_octagon_add_compare_products', [ $this, 'add_compare_products' ] );


			/* Remove Compare Products ---------------------------------------------------------- */

			add_action( 'wp_ajax_octagon_remove_compare_products', [ $this, 'remove_compare_products' ] );
			add_action( 'wp_ajax_nopriv_octagon_remove_compare_products', [ $this, 'remove_compare_products' ] );


			/* Wishlist ------------------------------------------------------------------ */

			add_action( 'wp_ajax_octagon_wishlist', [ $this, 'wishlist' ] );
			add_action( 'wp_ajax_nopriv_octagon_wishlist', [ $this, 'wishlist' ] );


			/* Remove Wishlist ------------------------------------------------------------ */

			add_action( 'wp_ajax_octagon_remove_wishlist', [ $this, 'remove_wishlist' ] );
			add_action( 'wp_ajax_nopriv_octagon_remove_wishlist', [ $this, 'remove_wishlist' ] );


			/* Quick View ---------------------------------------------------------------- */

			add_action( 'wp_ajax_octagon_quick_view', [ $this, 'quick_view' ] );
			add_action( 'wp_ajax_nopriv_octagon_quick_view', [ $this, 'quick_view' ] );
			
		}

		/**
		 * Update post like meta via AJAX Call
		 * 
		 * @version  1.0 
		 * @since 1.0
		 * @access public
		 * @return  mixed
		 */
		public function post_likes() {

			$like = 'not-liked';

			$id = isset( $_POST['id'] ) ? absint( $_POST['id'] ) : '';

			$old_values = octagon_get_cookie( 'octagon-post-likes' );
			$old_values = ! empty( $old_values ) ? explode( ',', trim( $old_values ) ) : array();

			if( ! in_array( $id, $old_values ) ) {

				$values = array_filter( array_unique( array_merge( $old_values, array( $id ) ) ) );
				$values = ! empty( $values ) && is_array( $values ) ? implode( ',', $values ) : '';			

				setcookie( 'octagon-post-likes', $values, strtotime( '+1 week' ), '/' );
				
				$like_count = octagon_get_meta( $id, 'octagon-post-likes-count' );
				$like_count = empty( $like_count ) ? 1 : $like_count + 1;

				update_post_meta( $id, 'octagon-post-likes-count', $like_count );

				$like = 'liked';
			}		

			echo json_encode( array( 'count' => $like_count, 'like' => $like ) );

			die();

		}

		/**
		 * Content Type Element Loadmore AJAX Call
		 * 
		 * @version 1.2 
		 * @since 1.0
		 * @access public
		 * @return  mixed
		 */
		public function content_type_loadmore() {

			$max   = isset( $_POST['max'] ) ? absint( $_POST['max'] ) : '';
			$paged = isset( $_POST['paged'] ) ? absint( $_POST['paged'] ) : '';

			if( ! octagon_is_number( $max ) || ! octagon_is_number( $paged ) ) {
				die();
			}

			$last_page = ( $paged == $max ) ? true : false;

			echo '<div class="ajax-content">';

				echo '<div class="html-content">';

					echo oee_get_shortcode_template( 'content-type', [] );

				echo '</div>';

				echo '<div class="json-values">';
					echo "<div class='json' data-value='". json_encode( array( 'paged' => $paged, 'last_page' => $last_page ) ) ."'></div>";
				echo '</div>';

			echo '</div>';

			die();
		}

		/**
		 * Content Type List Element Loadmore AJAX Call
		 * 
		 * @version 1.2 
		 * @since 1.0
		 * @access public
		 * @return  mixed
		 */
		public function content_type_list_loadmore() {

			$max   = isset( $_POST['max'] ) ? absint( $_POST['max'] ) : '';
			$paged = isset( $_POST['paged'] ) ? absint( $_POST['paged'] ) : '';

			if( ! octagon_is_number( $max ) || ! octagon_is_number( $paged ) ) {
				die();
			}

			$last_page = ( $paged == $max ) ? true : false;

			echo '<div class="ajax-content">';

				echo '<div class="html-content">';

					echo oee_get_shortcode_template( 'content-type-list', [] );

				echo '</div>';

				echo '<div class="json-values">';
					echo "<div class='json' data-value='". json_encode( array( 'paged' => $paged, 'last_page' => $last_page ) ) ."'></div>";
				echo '</div>';

			echo '</div>';

			die();
		}

		/**
		 * Portfolio Element Loadmore AJAX Call
		 * 
		 * @version  1.2 
		 * @since 1.0
		 * @access public
		 * @return  mixed
		 */
		public function portfolio_loadmore() {

			$max   = isset( $_POST['max'] ) ? absint( $_POST['max'] ) : '';
			$paged = isset( $_POST['paged'] ) ? absint( $_POST['paged'] ) : '';

			if( ! octagon_is_number( $max ) || ! octagon_is_number( $paged ) ) {
				die();
			}

			$last_page = ( $paged == $max ) ? true : false;

			echo '<div class="ajax-content">';

				echo '<div class="html-content">';

					echo oee_get_shortcode_template( 'portfolio', [] );

				echo '</div>';

				echo '<div class="json-values">';
					echo "<div class='json' data-value='". json_encode( array( 'paged' => $paged, 'last_page' => $last_page ) ) ."'></div>";
				echo '</div>';

			echo '</div>';

			die();
		}

		/**
		 * Products Element Loadmore AJAX Call
		 * 
		 * @version  1.2 
		 * @since 1.0
		 * @access public
		 * @return  mixed
		 */
		public function products_loadmore() {

			$max     = isset( $_POST['max'] ) ? absint( $_POST['max'] ) : '';
			$paged   = isset( $_POST['paged'] ) ? absint( $_POST['paged'] ) : '';

			if( ! octagon_is_number( $max ) || ! octagon_is_number( $paged ) ) {
				die();
			}

			$last_page = ( $paged == $max ) ? true : false;

			echo '<div class="ajax-content">';

				echo '<div class="html-content">';

					echo oee_get_shortcode_template( 'products', [] );

				echo '</div>';

				echo '<div class="json-values">';
					echo "<div class='json' data-value='". json_encode( array( 'paged' => $paged, 'last_page' => $last_page ) ) ."'></div>";
				echo '</div>';

			echo '</div>';

			die();
		}

		/**
		 * Login Form AJAX Call
		 * 
		 * @version  1.0 
		 * @since 1.0
		 * @access public
		 * @return  mixed
		 */
		public function login() {

			$userdata     = isset( $_POST['userdata'] ) ? array_map( 'sanitize_text_field', $_POST['userdata'] ) : [];
			$nonce        = isset( $_POST['nonce'] ) ? sanitize_text_field( $_POST['nonce'] ) : '';
			$testcookie   = isset( $_POST['testcookie'] ) ? sanitize_text_field( $_POST['testcookie'] ) : '';
			$redirect_to  = isset( $_POST['redirect_to'] ) ? absint( $_POST['redirect_to'] ) : '';

			$secure_cookie   = '';

			// If the user wants SSL but the session is not SSL, force a secure cookie.
			if( ! empty( $userdata['user_login'] ) && ! force_ssl_admin() ) {
				$user_name = sanitize_user( wp_unslash( $userdata['user_login'] ) );
				$user      = get_user_by( 'login', $user_name );

				if( ! $user && strpos( $user_name, '@' ) ) {
					$user = get_user_by( 'email', $user_name );
				}

				if( $user ) {
					if ( get_user_option( 'use_ssl', $user->ID ) ) {
						$secure_cookie = true;
						force_ssl_admin( true );
					}
				}
			}

			if( isset( $redirect_to ) ) {
				// Redirect to HTTPS if user wants SSL.
				if( $secure_cookie ) {
					$redirect_to = preg_replace( '|^http://|', 'https://', $redirect_to );
				}
			}

	        $user = wp_signon( $userdata, $secure_cookie );

	        if( empty( $user->get_error_codes() ) ) {
	        	echo json_encode( array(
					'success'     => esc_html__( 'You have logged in successfully.', 'octagon-elements-lite-for-elementor' ),
					'redirect_to' => $redirect_to
		        ) );
	        }
	        else {
	        	echo json_encode( $user );
	        }

			die();
		}

		/**
		 * Lost Password Form AJAX Call
		 * 
		 * @version  1.0 
		 * @since 1.0
		 * @access public
		 * @return  mixed
		 */
		public function lostpassword() {

			$user_login       = isset( $_POST['user_login'] ) ? sanitize_text_field( wp_unslash( $_POST['user_login'] ) ) : '';
			$reset_password   = isset( $_POST['reset_password'] ) ? sanitize_text_field( $_POST['reset_password'] ) : '';
			$lostpassword_url = isset( $_POST['lostpassword_url'] ) ? esc_url_raw( $_POST['lostpassword_url'] ) : '';
			$nonce            = isset( $_POST['nonce'] ) ? sanitize_text_field( $_POST['nonce'] ) : '';

			$this->lostpassword_url = $lostpassword_url;

			if( ! function_exists( 'retrieve_password' ) ) {
				ob_start();
				include_once( ABSPATH.'wp-login.php' );
				ob_clean();
			}

			$errors = retrieve_password();

			if( ! is_wp_error( $errors ) ) {
	        	echo json_encode( array(
					'success' => esc_html__( 'We have sent you an email.', 'octagon-elements-lite-for-elementor' )
		        ) );
	        }
	        else {
	        	echo json_encode( $errors );
	        }

			die();
		}

		/**
		 * Returns Password Reset mail message, In default it attaches the wp-admin link
		 * 
		 * @version  1.0 
		 * @since 1.0
		 * @access public
		 * @return  mixed
		 * @see retrieve_password_message() in wp-login.php
		 */
		public function retrieve_password_message( $message = '', $key = '', $user_login = '', $user_data = array() ) {

			if( is_multisite() ) {
				$site_name = get_network()->site_name;
			}
			else {
				$site_name = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );
			}

			$message = esc_html__( 'Someone has requested a password reset for the following account:', 'octagon-elements-lite-for-elementor' ) . "\r\n\r\n";
			/* translators: %s: Site name. */
			$message .= sprintf( esc_html__( 'Site Name: %s', 'octagon-elements-lite-for-elementor' ), $site_name ) . "\r\n\r\n";
			/* translators: %s: User login. */
			$message .= sprintf( esc_html__( 'Username: %s' ), $user_login ) . "\r\n\r\n";
			$message .= esc_html__( 'If this was a mistake, just ignore this email and nothing will happen.', 'octagon-elements-lite-for-elementor' ) . "\r\n\r\n";
			$message .= esc_html__( 'To reset your password, visit the following address:', 'octagon-elements-lite-for-elementor' ) . "\r\n\r\n";
			$message .= "$this->lostpassword_url?action=resetpassword&key=$key&login=". rawurlencode( $user_login );

			return apply_filters( 'oee_retrieve_password_message_template', $message, $this->lostpassword_url, $key, $user_login, $user_data );
		}

		/**
		 * Reset Password Form AJAX Call
		 * 
		 * @version  1.0 
		 * @since 1.0
		 * @access public
		 * @return  mixed
		 */
		public function resetpassword() {

			$user_password    = isset( $_POST['user_password'] ) ? sanitize_text_field( $_POST['user_password'] ) : '';
			$confirm_password = isset( $_POST['confirm_password'] ) ? sanitize_text_field( $_POST['confirm_password'] ) : '';
			$reset_password   = isset( $_POST['reset_password'] ) ? sanitize_text_field( $_POST['reset_password'] ) : '';
			$key              = isset( $_POST['key'] ) ? sanitize_text_field( $_POST['key'] ) : '';
			$login            = isset( $_POST['login'] ) ? sanitize_text_field( $_POST['login'] ) : '';
			$redirect_to      = isset( $_POST['redirect_to'] ) ? absint( $_POST['redirect_to'] ) : '';
			$nonce            = isset( $_POST['nonce'] ) ? sanitize_text_field( $_POST['nonce'] ) : '';

			if( isset( $key ) && isset( $login ) ) {

				$user = check_password_reset_key( $key, $login );
			}
			else {
				$user = false;
			}

			$errors = new WP_Error();

			if( ! $user || is_wp_error( $user ) ) {

				if( $user && $user->get_error_code() === 'expired_key' ) {
					$errors->add( 'expiredkey', esc_html__( 'Your password reset link has expired. Please request a new link below.', 'octagon-elements-lite-for-elementor' ) );
				}
				else {
					$errors->add( 'invalidkey', esc_html__( 'Your password reset link appears to be invalid. Please request a new link below.', 'octagon-elements-lite-for-elementor' ) );
				}
			}

			if( isset( $user_password ) && $user_password !== $confirm_password ) {
				$errors->add( 'password_reset_mismatch', esc_html__( 'The passwords do not match.', 'octagon-elements-lite-for-elementor' ) );
			}

			if( ( ! $errors->has_errors() ) && isset( $user_password ) && ! empty( $user_password ) ) {
				reset_password( $user, $user_password );

				echo json_encode( array(
					'success' => esc_html__( 'The passwords resetted successfully.', 'octagon-elements-lite-for-elementor' )
		        ) );

				exit;
			}
			else {
				echo json_encode( $errors );
			}

			die();
		}

		/**
		 * Register Form AJAX Call
		 * 
		 * @version  1.0 
		 * @since 1.0
		 * @access public
		 * @return  mixed
		 */
		public function register() {

			$user_login   = isset( $_POST['user_login'] ) ? sanitize_text_field( wp_unslash( $_POST['user_login'] ) ) : '';
			$user_email   = isset( $_POST['user_email'] ) ? sanitize_email( $_POST['user_email'] ) : '';
			$redirect_to  = isset( $_POST['redirect_to'] ) ? absint( $_POST['redirect_to'] ) : '';
			$nonce        = isset( $_POST['nonce'] ) ? sanitize_text_field( $_POST['nonce'] ) : '';

			$errors = register_new_user( $user_login, $user_email );

			if( ! is_wp_error( $errors ) ) {
				echo json_encode( array(
					'success'     => esc_html__( 'Registration confirmation will be emailed to you.', 'octagon-elements-lite-for-elementor' ),
					'redirect_to' => $redirect_to
		        ) );
			}
			else {
				echo json_encode( $errors );
			}

			die();
		}

		/**
		 * Update Profile Form AJAX Call
		 * 
		 * @version  1.0 
		 * @since 1.0
		 * @access public
		 * @return  mixed
		 */
		public function update_profile() {
			
			$first_name       = isset( $_POST['first_name'] ) ? sanitize_text_field( $_POST['first_name'] ) : '';
			$last_name        = isset( $_POST['last_name'] ) ? sanitize_text_field( $_POST['last_name'] ) : '';
			$display_name     = isset( $_POST['display_name'] ) ? sanitize_text_field( $_POST['display_name'] ) : '';
			$user_email       = isset( $_POST['user_email'] ) ? sanitize_email( $_POST['user_email'] ) : '';
			$current_password = isset( $_POST['current_password'] ) ? sanitize_text_field( $_POST['current_password'] ) : '';
			$user_password    = isset( $_POST['user_password'] ) ? sanitize_text_field( $_POST['user_password'] ) : '';
			$confirm_password = isset( $_POST['confirm_password'] ) ? sanitize_text_field( $_POST['confirm_password'] ) : '';
			$nonce            = isset( $_POST['nonce'] ) ? sanitize_text_field( $_POST['nonce'] ) : '';

			$user = get_userdata( get_current_user_id() );

			$errors = new WP_Error();

			if( ! empty( $user_password ) ) {
				if( empty( $current_password ) ) {
					$errors->add( 'current_password', esc_html__( 'You should enter the current password.', 'octagon-elements-lite-for-elementor' ) );
				}
				else if( $user_password !== $confirm_password ) {
					$errors->add( 'password_reset_mismatch', esc_html__( 'The passwords do not match.', 'octagon-elements-lite-for-elementor' ) );
				}				
				else if( ! wp_check_password( $current_password, $user->user_pass ) ) {
					$errors->add( 'password_incorrect', esc_html__( 'The password you entered for the username is incorrect.', 'octagon-elements-lite-for-elementor' ) );
				}
			}

			if( ! empty( $user_email ) ) {
				if( ! is_email( $user_email ) ) {
					$errors->add( 'invalid_email', esc_html__( 'The password you entered is invalid format.', 'octagon-elements-lite-for-elementor' ) );
				}
				else if( email_exists( $user_email ) ) {
					$errors->add( 'registered_email', esc_html__( 'This email is already registered, please choose another one.', 'octagon-elements-lite-for-elementor' ) );
				}
			}			

			if( ! $errors->has_errors() ) {

				wp_update_user(
					array(
						'ID'         => $user->ID,						
						'first_name' => $first_name,
						'last_name'  => $last_name,
						'user_email' => $user_email
					)
				);

				if( ! empty( $user_password ) ) {
					wp_update_user(
						array(
							'ID'        => $user->ID,
							'user_pass' => $user_password
						)
					);
				}

				echo json_encode( array(
					'success' => esc_html__( 'The profile updated successfully.', 'octagon-elements-lite-for-elementor' )
		        ) );

				exit;
			}
			else {
				echo json_encode( $errors );
			}

			die();
		}

		/**
		 * Return list of products based on search query via AJAX call
		 * 
		 * @version  1.0 
		 * @since 1.0
		 * @access public
		 * @return  mixed
		 */
		public function products_search() {

			$posts = '';

			$search_term = isset( $_POST['search_term'] ) ? sanitize_text_field( $_POST['search_term'] ) : '';

			$args = array(
				'ignore_sticky_posts' => true,
				'status'              => 'publish',
				'posts_per_page'      => 10,
				'post_type'           => 'product',
				's'                   => $search_term,
				'orderby'             => 'date',
				'orderby'             => 'desc'
			);

			$q = new WP_Query( $args );
			?>

			<div class="ajax-content">
				<?php if( ! empty( $search_term ) && $q->have_posts() ): ?>
					<?php
					ob_start();

					while( $q->have_posts() ):
						$q->the_post();

						global $product;

						$value['id'] = $product->get_id();

						$value['permalink'] = get_permalink();
						$value['thumbnail'] = get_post_thumbnail_id();

						$dimensions = apply_filters( 'oee_ajax_product_search_thumb_dimensions', array( 'width' => 60, 'height' => 60 ) );

						$allowed_html = array(
							'span' => array( 
								'class' => [] 
							), 
							'del' => [], 
							'ins' => [] 
						);
						
						$posts_html = '<div class="posts">';
							$posts_html .= '<div class="post-media">';
								$posts_html .= octagon_get_cropped_image( $value['thumbnail'], $dimensions['width'], $dimensions['height'] );
							$posts_html .= '</div>';
							
							$posts_html .= '<div class="post-content">';
								$posts_html .= the_title( '<h3 class="title"><a href="'. esc_url( $value['permalink'] ) .'">', '</a></h3>', false );
								if( $price_html = $product->get_price_html() ) :
									$posts_html .= sprintf( wp_kses( '<span class="price">%s</span>', $allowed_html ), $price_html );
								endif;
							$posts_html .= '</div>';
						$posts_html .= '</div>';

						echo apply_filters( 'oee_ajax_product_search_template', $posts_html, $value );

					endwhile;
					$posts = ob_get_clean();
					?>

					<div class="search-lists-posts">
						<?php

						$allowed_html = array( 
							'div' => array( 
								'class' => [] 
							),
							'h3' => array( 
								'class' => [] 
							),
							'img' => array( 
								'src' => [] 
							),
							'a' => array( 
								'href' => [] 
							),
							'span' => array( 
								'class' => [] 
							), 
							'del' => [], 
							'ins' => [] 
						);
						echo wp_kses( $posts, $allowed_html );
						?>
					</div> <!-- .search-lists-posts -->
					<?php
				else:
					?>
					<div class="search-lists-posts">
						<div class="notice-wrap">				
							<p class="notice"><?php esc_html_e( 'No Products Found', 'octagon-elements-lite-for-elementor' ); ?></p>
						</div> <!-- .post -->
					</div>
					<?php
				endif;
				?>
			</div> <!-- .ajax-content -->
			<?php
		    die();
		}

		/**
		 * WooCommerce add product into compare product list via AJAX
		 * 
		 * @version  1.0 
		 * @since 1.0
		 * @access public
		 * @return  mixed
		 */
		public function add_compare_products() {

			$id = isset( $_POST['id'] ) ? absint( $_POST['id'] ) : '';

			if( false === get_post_status( $id ) ) {
				die();
			}

			$old_values = octagon_get_cookie( 'octagon-compare-products' );
			$old_values = ! empty( $old_values ) ? explode( ',', trim( $old_values ) ) : [];

			$values = array_filter( array_unique( array_merge( $old_values, array( $id ) ) ) );

			$count = count( $values );

			$values = ! empty( $values ) && is_array( $values ) ? implode( ',', $values ) : '';

			if( ! empty( $values ) ) {
				setcookie( 'octagon-compare-products', $values, strtotime( '+1 week' ), '/' );
			}

			echo json_encode( array( 'count' => $count ) );

			die();

		}

		/**
		 * WooCommerce remove compare product list via AJAX
		 * 
		 * @version  1.0 
		 * @since 1.0
		 * @access public
		 * @return  mixed
		 */
		public function remove_compare_products() {

			$id = isset( $_POST['id'] ) ? absint( $_POST['id'] ) : '';

			if( false === get_post_status( $id ) ) {
				die();
			}

			$old_values = octagon_get_cookie( 'octagon-compare-products' );
			$count = count( $old_values );
			$old_values = ! empty( $old_values ) ? explode( ',', trim( $old_values ) ) : [];

			if( in_array( $id, $old_values ) ) {
				$values = array_diff( $old_values, array( $id ) );
				$count = count( $values );
				$values = ! empty( $values ) && is_array( $values ) ? implode( ',', $values ) : '';				
			}

			setcookie( 'octagon-compare-products', $values, strtotime( '+1 week' ), '/' );
			?>

			<div class="ajax-return" data-count="<?php echo esc_attr( $count ); ?>">
				<?php
				if( ! $count ) {

					$shop_url = get_permalink( wc_get_page_id( 'shop' ) );
					?>
					<div class="woocommerce-info">
						<?php esc_html_e( 'Compare product items not found!', 'octagon-elements-lite-for-elementor' ) ?>
						<a class="button" href="<?php echo esc_url( $shop_url ); ?>"><?php esc_html_e( 'Go shop', 'octagon-elements-lite-for-elementor' ) ?></a>
					</div>
					<?php
				}
				?>
			</div>
			
			<?php

			die();

		}

		/**
		 * WooCommerce add product into wishlist product list via AJAX
		 * 
		 * @version  1.0 
		 * @since 1.0
		 * @access public
		 * @return  mixed
		 */
		public function wishlist() {

			$id = isset( $_POST['id'] ) ? absint( $_POST['id'] ) : '';

			if( false === get_post_status( $id ) ) {
				die();
			}

			$old_values = octagon_get_cookie( 'octagon-wishlist' );
			$old_values = ! empty( $old_values ) ? explode( ',', trim( $old_values ) ) : [];

			if( in_array( $id, $old_values ) ) {
				$values = array_diff( $old_values, array( $id ) );
			}
			else {
				$values = array_filter( array_unique( array_merge( $old_values, array( $id ) ) ) );				
			}

			$count = count( $values );

			$values = ! empty( $values ) && is_array( $values ) ? implode( ',', $values ) : '';			

			setcookie( 'octagon-wishlist', $values, strtotime( '+1 week' ), '/' );

			echo json_encode( array( 'count' => $count ) );

			die();

		}

		/**
		 * WooCommerce remove wishlist product list via AJAX
		 * 
		 * @version  1.0 
		 * @since 1.0
		 * @access public
		 * @return  mixed
		 */
		public function remove_wishlist() {

			$id = isset( $_POST['id'] ) ? absint( $_POST['id'] ) : '';

			if( false === get_post_status( $id ) ) {
				die();
			}

			$old_values = octagon_get_cookie( 'octagon-wishlist' );
			$old_values = ! empty( $old_values ) ? explode( ',', trim( $old_values ) ) : [];

			if( in_array( $id, $old_values ) ) {
				$values = array_diff( $old_values, array( $id ) );
			}
			else {
				$values = array_filter( array_unique( array_merge( $old_values, array( $id ) ) ) );				
			}

			$count = count( $values );

			$values = ! empty( $values ) && is_array( $values ) ? implode( ',', $values ) : '';

			setcookie( 'octagon-wishlist', $values, strtotime( '+1 week' ), '/' );

			?>

			<div class="ajax-return" data-count="<?php echo esc_attr( $count ); ?>">
				<?php
				if( ! $count ) {

					$shop_url = get_permalink( wc_get_page_id( 'shop' ) );
					?>
					<div class="woocommerce-info">
						<?php esc_html_e( 'Wishlist items not found!', 'octagon-elements-lite-for-elementor' ) ?>
						<a class="button" href="<?php echo esc_url( $shop_url ); ?>"><?php esc_html_e( 'Go shop', 'octagon-elements-lite-for-elementor' ) ?></a>
					</div>
					<?php
				}
				?>
			</div>
			
			<?php
			die();

		}

		/**
		 * WooCommerce quick view product details
		 * 
		 * @version  1.0 
		 * @since 1.0
		 * @access public
		 * @return mixed
		 */
		public function quick_view() {

			$id = isset( $_POST['id'] ) ? absint( $_POST['id'] ) : '';

			if( false === get_post_status( $id ) ) {
				die();
			}
			
			$args = array(
				'post_type' => 'product',
				'p' => $id
			);

			$q = new Wp_Query( $args );

			if ( $q->have_posts() ) :

				while ( $q->have_posts() ) :
					$q->the_post();

					global $product;
					?>

					<div class="product-quick-view">
						<div class="container">						
							<div class="quick-view-inner">

								<div class="product-thumb">
									<?php echo octagon_get_cropped_image( '', 600, 600, false ); ?>
								</div>

								<div class="summary entry-summary">
									<?php
									woocommerce_template_single_title();
									woocommerce_template_single_price();
									woocommerce_template_single_excerpt();
									woocommerce_template_single_add_to_cart();
									?>
								</div>

								<a href="#" class="quick-view-close"><span class="oct-basic-cross"></span></a>
							</div>
						</div> <!-- .container -->
					</div> <!-- .product-quick-view -->

					<?php
				endwhile;
				wp_reset_postdata();

			endif;

			die();

		}

	}

	new OEE_Ajax_Calls;

}
