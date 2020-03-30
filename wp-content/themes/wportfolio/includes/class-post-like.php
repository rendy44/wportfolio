<?php
/**
 * Post Like Class.
 * Simple class to add function to give a like to a post.
 *
 * @author WPerfekt
 * @package WPortfolio
 * @version 0.0.4
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
			$this->cookie_like_key = 'have_liked_' . $this->post_id;
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
		 * Add a like into the post.
		 *
		 * @version 0.0.2
		 * @since 0.0.1
		 */
		public function add_like() {

			// Define new likes.
			$this->like_count ++;

			// Update meta.
			Master::update_post_meta( $this->meta_key, $this->like_count, $this->post_id );
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
	}
}
