<?php
/**
 * Settings Class
 * This class is used to override default behaviour of the WordPress.
 *
 * @author WPerfekt
 * @package WPortfolio
 * @version 0.0.1
 */

namespace WPortfolio;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WPortfolio\Settings' ) ) {

	/**
	 * Class Settings
	 *
	 * @package WPortfolio
	 */
	class Settings {

		/**
		 * Instance variable.
		 *
		 * @var null
		 */
		private static $instance = null;

		/**
		 * Singleton.
		 *
		 * @return Settings|null
		 */
		public static function init() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Settings constructor.
		 */
		private function __construct() {
			$this->theme_supports();
		}

		/**
		 * Modify theme supports.
		 */
		private function theme_supports() {

			// Add supports.
			add_theme_support( 'title-tag' );
			add_theme_support( 'menus' );
			add_theme_support( 'post-thumbnails' );

			// Remove tag generator.
			remove_action( 'wp_head', 'wp_generator' );
		}
	}

	Settings::init();
}