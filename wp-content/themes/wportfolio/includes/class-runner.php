<?php
/**
 * Runner Class.
 * This class will trigger hooks that need to be run immediately.
 *
 * @author WPerfekt
 * @package WPortfolio
 * @version 0.0.1
 */

namespace WPortfolio;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WPortfolio\Runner' ) ) {

	/**
	 * Class Runner
	 *
	 * @package WPortfolio
	 */
	class Runner {

		/**
		 * Instance variable.
		 *
		 * @var null
		 */
		private static $instance = null;

		/**
		 * Singleton.
		 *
		 * @return Runner|null
		 */
		public static function init() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Runner constructor.
		 */
		private function __construct() {

			// Load front assets.
			add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_front_assets' ] );
		}

		/**
		 * Callback for loading front assets.
		 */
		public function enqueue_front_assets() {
			Assets_Loader::load_front_assets( 'css' );
			Assets_Loader::load_front_assets( 'js' );
		}
	}

	Runner::init();
}
