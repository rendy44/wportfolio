<?php
/**
 * Github Api Class.
 * Simple wrapper to acquire github v4 API
 *
 * @author WPerfekt
 * @package WPortfolio
 * @version 0.0.1
 */

namespace WPortfolio;

use WP_Error;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WPortfolio\Github_Api' ) ) {

	/**
	 * Class Github_Api
	 *
	 * @package WPortfolio
	 */
	class Github_Api {

		/**
		 * Access key variable.
		 *
		 * @var string
		 *
		 * @since 0.0.1
		 */
		private $access_key = '';

		/**
		 * Username variable.
		 *
		 * @var string
		 *
		 * @since 0.0.1
		 */
		private $username = '';

		/**
		 * Endpoint variable.
		 *
		 * @var string
		 *
		 * @since 0.0.1
		 */
		private $endpoint = 'https://api.github.com/graphql';

		/**
		 * Headers variable.
		 *
		 * @var array
		 *
		 * @since 0.0.1
		 */
		private $headers = [
			'Content-Type' => 'application/json',
		];

		/**
		 * Github_Api constructor.
		 *
		 * @param string $access_key personal access key.
		 * @param string $username username.
		 */
		public function __construct( $access_key, $username ) {
			$this->access_key = $access_key;
			$this->username   = $username;
		}

		/**
		 * Get authentication header.
		 *
		 * @return array
		 */
		private function get_auth() {
			return [ 'Authorization' => "bearer {$this->access_key}" ];
		}

		/**
		 * Validate and retrieve the api request.
		 *
		 * @param array|WP_Error $api_request response of api request.
		 * @param bool           $cache whether cache the result or not.
		 *
		 * @return mixed
		 */
		private function retrieve_data( $api_request, $cache = true ) {

			// Validate the request.
			if ( ! is_wp_error( $api_request ) ) {

				// Since request isn't error, parse the body.
				$request_body = wp_remote_retrieve_body( $api_request );

				return json_decode( $request_body );
			} else {
				return $api_request;
			}
		}

		/**
		 * Connect to the endpoint.
		 *
		 * @param string $name of the request.
		 * @param string $body body content of the graphql request.
		 *
		 * @return mixed
		 */
		private function connect( $name, $body ) {

			// Maybe get from the cache.
			$api_request = get_transient( $name );

			// Validate the cache.
			if ( ! $api_request ) {

				// Merge the headers.
				$headers = wp_parse_args( $this->get_auth(), $this->headers );

				// Process the request.
				$api_request = wp_remote_post(
					$this->endpoint,
					[
						'headers' => $headers,
						'body'    => $body,
					]
				);

				// Save to the cache.
				set_transient( $name, $api_request, WP_FS__TIME_12_HOURS_IN_SEC );
			}

			return $this->retrieve_data( $api_request );
		}

		/**
		 * Get contribution calendar.
		 *
		 * @return mixed
		 */
		public function get_contributions() {
			return $this->connect( 'get_contributions', '{"query":"{\\n    user(login: \\"' . $this->username . '\\") {\\n              contributionsCollection {\\n                  startedAt\\n                  endedAt\\n                contributionCalendar {\\n                  totalContributions\\n                }\\n              }\\n            }\\n          }","variables":{}}' );
		}

		/**
		 * Get pinned repositories.
		 *
		 * @return mixed
		 */
		public function get_pinned_repos() {
			return $this->connect( 'get_pinned_repos', '{"query":"{\\n  repositoryOwner(login: \\"' . $this->username . '\\") {\\n    ... on User {\\n      pinnedRepositories(first:4) {\\n        edges {\\n          node {\\n              forkCount\\n            name\\n            description\\n            url\\n            languages(first:5){\\n                edges{\\n                    node{\\n                        color\\n                        name\\n                    }\\n                }\\n            }\\n          }\\n        }\\n      }\\n    }\\n  }\\n}","variables":{}}' );
		}
	}
}
