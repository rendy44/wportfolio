<?php
/**
 * Main Class.
 * This is the class that will be loaded first.
 *
 * @author WPerfekt
 * @package WPortfolio
 * @version 0.0.8
 */

namespace WPortfolio;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WPortfolio\Main' ) ) {

	/**
	 * Class Main
	 *
	 * @package WPortfolio
	 */
	class Main {

		/**
		 * Instance variable.
		 *
		 * @var null
		 */
		private static $instance = null;

		/**
		 * Singleton.
		 *
		 * @return Main|null
		 */
		public static function init() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Main constructor.
		 */
		private function __construct() {
			$this->load_class();
		}

		/**
		 * Load dependency classes.
		 *
		 * @since 0.0.1
		 */
		private function load_class() {

			// Get all classes.
			$classes = $this->map_classes();

			// Load all classes.
			foreach ( $classes as $class ) {
				include TEMP_DIR . "/includes/class-{$class}.php";
			}
		}

		/**
		 * Map all dependency classes.
		 *
		 * @return array
		 *
		 * @version 0.0.7
		 * @since 0.0.1
		 */
		private function map_classes() {
			$classes = array(
				'helper',
				'assets-loader',
				'assets',
				'runner',
				'github-api',
				'data',
				'master',
				'settings',
				'ui',
				'template',
				'post-like',
				'ajax',
				'rest-api',
			);

			/**
			 * WPortfolio dependency classes filter hook.
			 *
			 * @param array $classes default dependency classes.
			 *
			 * @since 0.0.1
			 */
			return apply_filters( 'wportfolio_dependency_classes', $classes );
		}
	}

	Main::init();
}
