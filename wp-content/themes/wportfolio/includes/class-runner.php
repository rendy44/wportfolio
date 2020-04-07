<?php
/**
 * Runner Class.
 * This class will trigger hooks that need to be run immediately.
 *
 * @author WPerfekt
 * @package WPortfolio
 * @version 0.0.3
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
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_front_assets' ) );
			// Maybe convert js as module.
			add_filter( 'script_loader_tag', array( $this, 'load_as_module' ), 10, 3 );
		}

		/**
		 * Callback for loading front assets.
		 *
		 * @since 0.0.1
		 */
		public function enqueue_front_assets() {
			Assets_Loader::load_front_assets( 'css' );
			Assets_Loader::load_front_assets( 'js' );
		}

		/**
		 * Get all modules.
		 *
		 * @return array
		 *
		 * @since 0.0.3
		 */
		private function get_modules() {
			return Assets_Loader::get_all_modules();
		}

		/**
		 * Filters the HTML script tag of an enqueued script.
		 *
		 * @param string $tag The <script> tag for the enqueued script.
		 * @param string $handle The script's registered handle.
		 * @param string $src The script's source URL.
		 *
		 * @return  string
		 *
		 * @since 0.0.3
		 */
		public function load_as_module( $tag, $handle, $src ) {
			$js_prefix = TEMP_PREFIX . 'module_';
			if ( in_array( $handle, $this->get_modules(), true ) || false !== strpos( $handle, $js_prefix ) ) {
				$tag = '<script type="module" src="' . esc_url( $src ) . '"></script>'; // phpcs:ignore
			}

			return $tag;
		}
	}

	Runner::init();
}
