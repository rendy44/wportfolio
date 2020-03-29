<?php
/**
 * Post Like Class.
 * Simple class to add function to give a like to a post.
 *
 * @author WPerfekt
 * @package WPortfolio
 * @version 0.0.3
 */

namespace WPortfolio;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WPortfolio\Post_Like' ) ) {

	/**
	 * Class Post_Like
	 *
	 * @package WPortfolio
	 */
	class Post_Like {

		/**
		 * Post id variable.
		 *
		 * @var int
		 *
		 * @since 0.0.1
		 */
		private $post_id = 0;

		/**
		 * Number of likes variable.
		 *
		 * @var int
		 *
		 * @since 0.0.1
		 */
		private $like_count = 0;

		/**
		 * Meta key variable.
		 *
		 * @var string
		 *
		 * @since 0.0.1
		 */
		private $meta_key = 'like_count';

		/**
		 * Cookie key.
		 *
		 * @var string
		 *
		 * @since 0.0.1
		 */
		private $cookie_like_key = '';

		/**
		 * Post_Like constructor.
		 *
		 * @param int $post_id id of the post.
		 *
		 * @since 0.0.1
		 */
		public function __construct( $post_id ) {

			// Define some properties.
			$this->post_id         = $post_id;
			$this->cookie_like_key = 'like_' . $this->post_id;
			$this->like_count      = $this->count_like_db();
		}

		/**
		 * Get post number of likes.
		 *
		 * @return int
		 *
		 * @since 0.0.1
		 */
		public function get_likes() {
			return $this->like_count;
		}

		/**
		 * Maybe add a like into the post.
		 *
		 * @return bool
		 *
		 * @since 0.0.1
		 */
		public function maybe_add_like() {
			$result = false;

			// Make sure that visitor hasn't liked yet.
			if ( ! $this->is_liked() ) {

				// Save the cookie.
				$this->add_cookie();

				// Define new likes.
				$this->like_count ++;

				// Update meta.
				Master::update_post_meta( $this->meta_key, $this->like_count, $this->post_id );

				// Update result.
				$result = true;
			}

			return $result;
		}

		/**
		 * Count the like from db.
		 *
		 * @return int
		 *
		 * @since 0.0.1
		 */
		private function count_like_db() {
			return (int) Master::get_post_meta( $this->meta_key, $this->post_id );
		}

		/**
		 * Add cookie to current visitor.
		 *
		 * @version 0.0.3
		 * @since 0.0.1
		 */
		private function add_cookie() {
			setcookie( $this->cookie_like_key, true, 3600 * 24 * 7 );
		}

		/**
		 * Check whether current post is already liked or not.
		 *
		 * @return bool
		 *
		 * @version 0.0.2
		 * @since 0.0.1
		 */
		public function is_liked() {
			return isset( $_COOKIE[ $this->cookie_like_key ] );
		}
	}
}
