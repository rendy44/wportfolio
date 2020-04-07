<?php
/**
 * Master Class
 * Class to manage and view posts.
 *
 * @author WPerfekt
 * @package WPortfolio
 * @version 0.0.4
 */

namespace WPortfolio;

use WP_Query;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WPortfolio\Master' ) ) {

	/**
	 * Class Master
	 *
	 * @package WPortfolio
	 */
	class Master {

		/**
		 * Get posts.
		 *
		 * @param array $args wp_query args.
		 *
		 * @return bool|mixed|WP_Query
		 *
		 * @version 0.0.2
		 * @since 0.0.1
		 */
		public static function get_posts( $args = array() ) {

			// Prepare default args.
			$default_args = array(
				'post_type'   => 'post',
				'post_status' => 'publish',
				'orderby'     => 'date',
				'order'       => 'desc',
			);

			// Merge the args.
			$args = wp_parse_args( $args, $default_args );

			// Define as string.
			$data_key = wp_json_encode( $args );

			// Maybe get from transient.
			$query = get_transient( $data_key );

			// Validate the transient.
			if ( ! $query ) {

				// Re-define the query.
				$query = new WP_Query( $args );

				// Save to transient.
				set_transient( $data_key, $query, 3600 );
			}

			return $query;
		}

		/**
		 * Update post meta.
		 *
		 * @param string   $key post meta key.
		 * @param string   $value new post meta value.
		 * @param bool|int $post_id id of the post.
		 *
		 * @version 0.0.2
		 * @since 0.0.2
		 */
		public static function update_post_meta( $key, $value, $post_id = false ) {

			// Maybe redefine post id.
			if ( ! $post_id ) {
				$post_id = get_the_ID();
			}

			update_post_meta( $post_id, TEMP_PREFIX . $key, $value );
		}

		/**
		 * Get post meta.
		 *
		 * @param string|array $key post meta key.
		 * @param bool|string  $post_id post id.
		 * @param bool         $single_value whether the meta is single or array.
		 * @param bool         $with_prefix whether format field with auto prefix or not.
		 *
		 * @return array|bool|mixed
		 *
		 * @version 0.0.2
		 * @since 0.0.2
		 */
		public static function get_post_meta( $key, $post_id = false, $single_value = true, $with_prefix = true ) {
			$result = false;

			// Maybe redefine post id.
			if ( ! $post_id ) {
				$post_id = get_the_ID();
			}

			$prefix = $with_prefix ? TEMP_PREFIX : '';
			if ( is_array( $key ) ) {
				foreach ( $key as $single_key ) {
					$result[ $single_key ] = get_post_meta( $post_id, $prefix . $single_key, $single_value );
				}
			} else {
				$result = get_post_meta( $post_id, $prefix . $key, $single_value );
			}

			return $result;
		}
	}
}
