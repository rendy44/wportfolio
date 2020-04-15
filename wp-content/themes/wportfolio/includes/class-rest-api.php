<?php
/**
 * Rest API Class
 * Class to manage custom rest-api.
 *
 * @author WPerfekt
 * @package WPortfoli
 * @version 0.0.3
 */

namespace WPortfolio;

use WP_REST_Request;
use WP_REST_Response;
use WP_REST_Server;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WPortfolio\Rest_Api' ) ) {

	/**
	 * Class Rest_Api.
	 *
	 * @package WPortfolio
	 */
	class Rest_Api {

		/**
		 * Instance variable.
		 *
		 * @var null
		 */
		private static $instance = null;

		/**
		 * Data variable.
		 *
		 * @var null
		 */
		private $obj_data;

		/**
		 * Namespace variable.
		 *
		 * @var string
		 */
		private $namespace;

		/**
		 * Routes variable.
		 *
		 * @var array
		 */
		private $routes;

		/**
		 * Singleton.
		 *
		 * @return Rest_Api|null
		 */
		public static function init() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Rest_Api constructor.
		 *
		 * @since 0.0.1
		 */
		private function __construct() {

			// Set namespace.
			$this->namespace = 'public';

			// Register custom rest api.
			add_action( 'rest_api_init', array( $this, 'register_rest_api' ) );

			// Instance object data.
			$this->obj_data = new Data();

			// Map routes.
			$this->map_routes();
		}

		/**
		 * Map rest api routes.
		 *
		 * @version 0.0.3
		 * @since 0.0.1
		 */
		private function map_routes() {
			$this->routes = array(
				'sections'     => array(
					'methods'  => 'GET',
					'callback' => array( $this, 'get_sections' ),
				),
				'recent_posts' => array(
					'methods'  => 'GET',
					'callback' => array( $this, 'get_recent_posts' ),
				),
				'post_detail'  => array(
					'methods'  => 'GET',
					'callback' => array( $this, 'get_post_detail' ),
				),
			);
		}

		/**
		 * Callback for registering rest api.
		 *
		 * @param WP_REST_Server $server rest api server.
		 *
		 * @since 0.0.1
		 */
		public function register_rest_api( WP_REST_Server $server ) {

			// Validate routes.
			if ( ! empty( $this->routes ) ) {

				// Loop routes.
				foreach ( $this->routes as $route => $route_obj ) {
					register_rest_route( $this->namespace, $route, $route_obj );
				}
			}
		}

		/**
		 * Callback for getting sections.
		 *
		 * @param WP_REST_Request $request api request.
		 *
		 * @return WP_REST_Response
		 *
		 * @since 0.0.1
		 */
		public function get_sections( WP_REST_Request $request ) {
			$response = new WP_REST_Response( $this->obj_data->get_sections() );
			$response->set_status( 200 );

			return $response;
		}

		/**
		 * Callback for getting recent posts.
		 *
		 * @param WP_REST_Request $request api request.
		 *
		 * @return WP_REST_Response
		 *
		 * @since 0.0.2
		 */
		public function get_recent_posts( WP_REST_Request $request ) {

			// Define variable to store items.
			$blog_items = array();

			// Get latest posts.
			$posts_query = Master::get_posts( array( 'posts_per_page' => 3 ) );
			if ( $posts_query->have_posts() ) {
				while ( $posts_query->have_posts() ) {
					$posts_query->the_post();

					// Save post details.
					$blog_items[] = array(
						'id'            => get_the_ID(),
						'title'         => get_the_title(),
						'permalink'     => get_permalink(),
						'slug'          => get_post_field( 'post_name' ),
						'thumbnail_url' => get_the_post_thumbnail_url( get_the_ID(), 'medium' ),
						'excerpt'       => get_the_excerpt(),
						'date'          => get_the_date(),
					);
				}
			}
			wp_reset_postdata();

			$response = new WP_REST_Response( $blog_items );
			$response->set_status( 200 );

			return $response;
		}

		/**
		 * Callback for getting post detail.
		 *
		 * @param WP_REST_Request $request api request.
		 *
		 * @return WP_REST_Response
		 *
		 * @since 0.0.3
		 */
		public function get_post_detail( WP_REST_Request $request ) {
			$param    = $request->get_param( 'slug' );
			$response = new WP_REST_Response();

			// Find post.
			$find_post = get_page_by_path( $param, OBJECT, 'post' );

			// Validate post.
			if ( $find_post ) {
				$response->set_data(
					array(
						'id'                => $find_post->ID,
						'title'             => $find_post->post_title,
						'content'           => apply_filters( 'the_content', $find_post->post_content ),
						'date'              => get_the_date( '', $find_post ),
						'time'              => get_the_time( '', $find_post ),
						'thumbnail'         => get_the_post_thumbnail_url( $find_post, 'large' ),
						'thumbnail_caption' => get_the_post_thumbnail_caption( $find_post ),
						'tags'              => wp_get_post_tags( $find_post->ID ),
						'author_avatar_url' => get_avatar_url( $find_post->post_author ),
						'author_name'       => get_the_author_meta( 'user_nicename', $find_post->post_author ),
					)
				);
				$response->set_status( 200 );
			} else {
				$response->set_data( __( 'Post not found', 'wportfolio' ) );
				$response->set_status( 404 );
			}

			return $response;
		}
	}

	Rest_Api::init();
}
