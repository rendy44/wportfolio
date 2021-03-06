<?php
/**
 * Ajax Class
 * Class to add custom ajax endpoints.
 *
 * @author  WPerfekt
 * @package WPortfolio
 * @version 0.0.3
 */

namespace WPortfolio;

use WP_Error;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WPortfolio\Ajax' ) ) {

	/**
	 * Class Ajax
	 *
	 * @package WPortfolio
	 */
	class Ajax {

		/**
		 * Instance variable
		 *
		 * @var null
		 */
		private static $instance = null;

		/**
		 * Singleton function
		 *
		 * @return Ajax|null
		 */
		public static function init() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Ajax constructor.
		 */
		private function __construct() {
			$endpoints = $this->get_default_endpoints();

			foreach ( $endpoints as $endpoint => $endpoint_obj ) {
				$args = $this->maybe_convert_endpoint_obj( $endpoint_obj );

				$this->add_endpoint( $endpoint, $args['callback'], $args['public'], $args['logged_in'] );
			}
		}

		/**
		 * Maybe convert ajax endpoint object to fill the default args.
		 *
		 * @param array $endpoint_object default endpoint.
		 *
		 * @return array
		 *
		 * @since 0.0.1
		 */
		private function maybe_convert_endpoint_obj( $endpoint_object ) {
			$default_args = array(
				'callback'  => false,
				'public'    => true,
				'logged_in' => true,
			);

			return wp_parse_args( $endpoint_object, $default_args );
		}

		/**
		 * Register ajax endpoint.
		 *
		 * @param string   $endpoint the endpoint name.
		 * @param callable $callback obect of the endpoint.
		 * @param bool     $is_public whether set endpoint as public or not.
		 * @param bool     $is_logged_in whether set endpoint as accessible in logged in user or not.
		 *
		 * @since 0.0.1
		 */
		private function add_endpoint( $endpoint, $callback, $is_public = true, $is_logged_in = true ) {

			// Only register endpoint that has callback.
			if ( is_callable( $callback ) ) {

				// Register endpoint for public access.
				if ( $is_public ) {
					add_action( 'wp_ajax_nopriv_' . TEMP_PREFIX . $endpoint, $callback );
				}

				// Register endpoint for admin access.
				if ( $is_logged_in ) {
					add_action( 'wp_ajax_' . TEMP_PREFIX . $endpoint, $callback );
				}
			}
		}

		/**
		 * Get posted data.
		 *
		 * @return bool|mixed
		 *
		 * @since 0.0.1
		 */
		private function get_posted_data() {
			return Helper::post( 'data' );
		}

		/**
		 * Map ajax endpoint and its callback
		 *
		 * @return array
		 *
		 * @version 0.0.2
		 * @since 0.0.1
		 */
		private function get_default_endpoints() {
			return array(
				'like_post' => array(
					'callback' => array( $this, 'like_single_post' ),
				),
			);
		}

		/**
		 * Callback for liking a post.
		 *
		 * @version 0.0.3
		 * @since 0.0.1
		 */
		public function like_single_post() {
			$result  = '';
			$data    = $this->get_posted_data();
			$post_id = Helper::array_val( $data, 'post_id' );

			// Validate input.
			if ( $post_id ) {

				// Instance post like.
				$post_like = new Post_Like( $post_id );

				// Do give a like.
				$post_like->add_like();

				// Get new like count.
				$new_like_count = $post_like->get_likes();

				/* translators: %s: amount of the loves */
				$result = sprintf( _n( '%s love', '%s loves', $new_like_count, 'wportfolio' ), $new_like_count );

			} else {
				$result = new WP_Error( 'no_post_id', __( 'Please insert post id', 'wportfolio' ) );
			}

			wp_send_json( $result );
		}
	}

	Ajax::init();
}
