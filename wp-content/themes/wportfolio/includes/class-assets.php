<?php
/**
 * Assets Class.
 * This class is used for collecting and mapping assets that will be loaded both in front-end and wp-admin.
 *
 * @author WPerfekt
 * @package WPortfolio
 * @version 0.0.5
 */

namespace WPortfolio;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WPortfolio\Assets' ) ) {

	/**
	 * Class Assets
	 *
	 * @package WPortfolio
	 */
	class Assets {

		/**
		 * Instance variable.
		 *
		 * @var null
		 */
		private static $instance = null;

		/**
		 * Singleton.
		 *
		 * @return Assets|null
		 */
		public static function init() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Assets constructor.
		 */
		private function __construct() {
			$this->load_front_assets();
		}

		/**
		 * Load assets in front-end.
		 *
		 * @version 0.0.2
		 * @since 0.0.1
		 */
		private function load_front_assets() {

			// Prepare front-end js.
			$js_files = array(
				'wportfolio' => array(
					'src'  => TEMP_URI . '/assets/js/wportfolio.js',
					'deps' => array( 'jquery' ),
					'vars' => array(
						'ajax_url' => admin_url( 'admin-ajax.php' ),
						'prefix'   => TEMP_PREFIX,
					),
				),
			);

			/**
			 * WPortfolio front-end js filter hook.
			 *
			 * @param array $js_files default js files.
			 *
			 * @since 0.0.1
			 */
			$js_files = apply_filters( 'wportfolio_front_end_js', $js_files );

			// Do load js files.
			$this->do_load_assets( $js_files, 'js' );

			// Prepare front-end css.
			$css_files = array(
				'font'       => array(
					'src' => 'https://fonts.googleapis.com/css?family=Baloo+2:400,500,600|Dancing+Script:700&display=swap',
				),
				'remixicon'  => array(
					'src' => TEMP_URI . '/assets/lib/remixicon/remixicon.css',
				),
				'wportfolio' => array(
					'src' => TEMP_URI . '/assets/css/wportfolio.css',
				),
			);

			/**
			 * WPortfolio front-end css filter hook.
			 *
			 * @param array $css_files default css files.
			 *
			 * @since 0.0.1
			 */
			$css_files = apply_filters( 'wportfolio_front_end_css', $css_files );

			// Do load css files.
			$this->do_load_assets( $css_files, 'css' );
		}

		/**
		 * Do load the assets.
		 *
		 * @param array  $assets list of the assets.
		 * @param string $type type of the asset, css|js.
		 *
		 * @since 0.0.1
		 */
		private function do_load_assets( $assets, $type = 'css' ) {

			// Make sure the assets is available.
			if ( ! empty( $assets ) ) {

				// Loop the assets.
				foreach ( $assets as $asset_name => $asset_arg ) {

					// Add the asset.
					Assets_Loader::add_front_asset( $asset_name, $asset_arg, $type );
				}
			}
		}
	}

	Assets::init();
}
