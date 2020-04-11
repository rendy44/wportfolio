<?php
/**
 * Github Api Class.
 * Simple wrapper to acquire github v4 API
 *
 * @author WPerfekt
 * @package WPortfolio
 * @version 0.0.7
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
		 * Error message variable.
		 *
		 * @var string
		 *
		 * @since 0.0.6
		 */
		private $error = '';

		/**
		 * Endpoint variable.
		 *
		 * @var string
		 *
		 * @since 0.
		 * 0.1
		 */
		private $endpoint = 'https://api.github.com/graphql';

		/**
		 * Headers variable.
		 *
		 * @var array
		 *
		 * @since 0.0.1
		 */
		private $headers = array(
			'Content-Type' => 'application/json',
		);

		/**
		 * Github_Api constructor.
		 *
		 * @version 0.0.2
		 * @since 0.0.1
		 */
		public function __construct() {

			// Validate the key.
			if ( $this->is_valid_key_and_user() ) {
				$this->access_key = GITHUB_KEY;
				$this->username   = GITHUB_USER;
			} else {
				$this->error = __( 'Please define GITHUB_KEY and GITHUB_USER constants', 'wportfolio' );
			}
		}

		/**
		 * Get github username.
		 *
		 * @return string
		 *
		 * @since 0.0.4
		 */
		public function get_username() {
			return $this->username;
		}

		/**
		 * Print admin notification in front-end.
		 *
		 * @since 0.0.5
		 */
		private function print_admin_notice() {
			$args = array(
				'warning_message' => $this->error,
			);

			/**
			 * WPortfolio admin notice filter hook.
			 *
			 * @param array $args default args.
			 *
			 * @since 0.0.1
			 */
			$args = apply_filters( 'wportfolio_admin_notice_args', $args );

			Template::render( 'admin/notice', $args );
		}

		/**
		 * Check whether github key nor github user are defined or not.
		 *
		 * @return bool
		 *
		 * @since 0.0.5
		 */
		private function is_valid_key_and_user() {
			return ( defined( 'GITHUB_KEY' ) && GITHUB_KEY ) && ( defined( 'GITHUB_USER' ) && GITHUB_USER );
		}

		/**
		 * Maybe print admin notice.
		 *
		 * @return void|bool
		 *
		 * @since 0.0.5
		 */
		public function maybe_print_admin_notice() {
			// Validate constants.
			if ( ! $this->is_valid_key_and_user() ) {
				$this->print_admin_notice();
				return true;
			}
		}

		/**
		 * Get authentication header.
		 *
		 * @return array
		 */
		private function get_auth() {
			return array( 'Authorization' => "bearer {$this->access_key}" );
		}

		/**
		 * Validate and retrieve the api request.
		 *
		 * @param array|WP_Error $api_request response of api request.
		 *
		 * @return mixed
		 *
		 * @version 0.0.2
		 * @since 0.0.1
		 */
		private function retrieve_data( $api_request ) {

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
		 *
		 * @version 0.0.4
		 * @since 0.0.1
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
					array(
						'headers' => $headers,
						'body'    => $body,
					)
				);

				// Save to the cache.
				set_transient( $name, $api_request, 3600 * 12 );
			}

			return $this->retrieve_data( $api_request );
		}

		/**
		 * Get contribution calendar.
		 *
		 * @return mixed
		 *
		 * @since 0.0.1
		 */
		public function get_contributions() {
			return $this->connect( 'get_contributions', '{"query":"{\\n    user(login: \\"' . $this->username . '\\") {\\n              contributionsCollection {\\n                  startedAt\\n                  endedAt\\n                contributionCalendar {\\n                  totalContributions\\n                }\\n              }\\n            }\\n          }","variables":{}}' );
		}

		/**
		 * Get pinned repositories.
		 *
		 * @return mixed
		 *
		 * @version 0.0.2
		 * @since 0.0.1
		 */
		public function get_pinned_repos() {
			return $this->connect( 'get_pinned_repos', '{"query":"{\\n  repositoryOwner(login: \\"' . $this->username . '\\") {\\n    ... on User {\\n      pinnedRepositories(first:4) {\\n        edges {\\n          node {\\n              forkCount\\n            name\\n            description\\n            url\\n            languages(first:3){\\n                edges{\\n                    node{\\n                        color\\n                        name\\n                    }\\n                }\\n            }\\n          }\\n        }\\n      }\\n    }\\n  }\\n}","variables":{}}' );
		}
	}
}
