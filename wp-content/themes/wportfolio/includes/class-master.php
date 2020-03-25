<?php
/**
 * Master Class
 * Class to manage and view posts.
 *
 * @author WPerfekt
 * @package WPortfolio
 * @version 0.0.1
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
		 * @since 0.0.1
		 */
		public static function get_posts( $args = [] ) {

			// Prepare default args.
			$default_args = [
				'post_type'   => 'post',
				'post_status' => 'publish',
				'orderby'     => 'date',
				'order'       => 'desc',
			];

			// Merge the args.
			$args = wp_parse_args( $args, $default_args );

			// Define as string.
			$cache_key = serialize( $args );

			// Maybe get from cache.
			$query = wp_cache_get( $cache_key );

			// Validate the cache.
			if ( ! $query ) {

				// Re-define the query.
				$query = new WP_Query( $args );

				// Save to cache.
				wp_cache_set( $cache_key, $query, '', 3600 );
			}

			return $query;
		}
	}
}