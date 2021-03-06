<?php
/**
 * Helper Class
 * Class that contains useful functions.
 *
 * @author  WPerfekt
 * @package WPortfolio
 * @version 0.0.4
 */

namespace WPortfolio;

use get_transient;
use set_transient;
use base64_decode; // phpcs:ignore

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WPortfolio\Helper' ) ) {

	/**
	 * Class Helper
	 *
	 * @package WPortfolio
	 */
	class Helper {

		/**
		 * Convert date.
		 *
		 * @param int $timestamp unique timestamp.
		 *
		 * @return false|string
		 */
		public static function convert_date( $timestamp ) {
			$date_format = get_option( 'date_format' );

			return date( $date_format, $timestamp ); // phpcs:ignore
		}

		/**
		 * Get serialized value
		 *
		 * @param array  $unserialized_data unserialized data to be parsed.
		 * @param string $key key name of data.
		 *
		 * @return array|bool|mixed
		 *
		 * @since 0.0.1
		 */
		public static function get_serialized_val( $unserialized_data, $key ) {
			$result           = '';
			$temporary_result = array();
			foreach ( $unserialized_data as $obj ) {
				if ( $obj['name'] === $key ) {
					$temporary_result[] = $obj['value'];
				}
			}
			$count_result = count( $temporary_result );
			if ( $count_result > 0 ) {
				$result = count( $temporary_result ) > 1 ? $temporary_result : $temporary_result[0];
			}

			return $result;
		}

		/**
		 * Simple $_POST request handler
		 *
		 * @param string $key post key.
		 *
		 * @return bool|mixed
		 *
		 * @since 0.0.1
		 */
		public static function post( $key ) {
			return ! empty( $_POST[ $key ] ) ? $_POST[ $key ] : false; // phpcs:ignore
		}

		/**
		 * Simple $_GET request handler
		 *
		 * @param string $key get key.
		 *
		 * @return bool|mixed
		 *
		 * @since 0.0.1
		 */
		public static function get( $key ) {
			return ! empty( $_GET[ $key ] ) ? $_GET[ $key ] : false; // phpcs:ignore
		}

		/**
		 * Get array value by its key.
		 *
		 * @param array  $array array object.
		 * @param string $key array key.
		 * @param mixed  $return_false return on false.
		 *
		 * @return bool|mixed will be returned false once array does not have key.
		 *
		 * @since 0.0.1
		 */
		public static function array_val( array $array, $key, $return_false = array() ) {
			return ! empty( $array[ $key ] ) ? $array[ $key ] : $return_false;
		}

		/**
		 * Convert data from wpdb into readable array for cmb2.
		 *
		 * @param array $data original array of object data.
		 *
		 * @return array
		 *
		 * @since 0.0.1
		 */
		public static function convert_wpdb_into_array( array $data ) {
			$result = array();
			if ( ! empty( $data ) ) {
				foreach ( $data as $id => $obj ) {
					$result[ $id ] = $obj->post_title;
				}
			}

			return $result;
		}

		/**
		 * Please let this line available.
		 *
		 * @return string
		 *
		 * @version 0.0.2
		 * @since 0.0.2
		 */
		public static function get_author() {
			$data = array(
				'name' => 'V1BlcmZla3Q=',
				'url'  => 'aHR0cHM6Ly93cGVyZmVrdC5jb20=',
				'text' => 'Q3JlYXRlZCBhbmQgRGVzaWduZWQgYnk=',
			);

			// Maybe get from transient.
			$decoded_transient = get_transient( 'credit_author_footer' );

			// Validate the transient.
			if ( ! $decoded_transient ) {

				// Decode manually.
				foreach ( $data as $data_key => $data_value ) {
					$decoded_transient[ $data_key ] = base64_decode( $data_value ); // phpcs:ignore
				}

				// Save into transient.
				set_transient( 'credit_author_footer', $decoded_transient, 3600 * 24 * 360 );
			}

			/* translators: %1$s: credit text, %2$s: credit url, %3$s: credit name */
			return sprintf( '%1$s <a href="%2$s" target="_blank">%3$s</a>', $decoded_transient['text'], $decoded_transient['url'], $decoded_transient['name'] );
		}
	}
}
