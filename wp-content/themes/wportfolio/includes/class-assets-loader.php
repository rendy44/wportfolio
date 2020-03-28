<?php
/**
 * Assets Loader Class.
 * This class contains useful functions to assets.
 *
 * @author WPerfekt
 * @package WPortfolio
 * @version 0.0.3
 */

namespace WPortfolio;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WPortfolio\Assets_Loader' ) ) {

	/**
	 * Class Assets_Loader.
	 *
	 * @package WPortfolio
	 */
	class Assets_Loader {

		/**
		 * Front-end css variable.
		 *
		 * @var array
		 *
		 * @since 0.0.1
		 */
		private static $front_css;

		/**
		 * Front-end js variable.
		 *
		 * @var array
		 *
		 * @since 0.0.1
		 */
		private static $front_js;

		/**
		 * Treat js as module variable.
		 *
		 * @var array
		 *
		 * @since 0.0.3
		 */
		private static $as_module;

		/**
		 * Add asset for front-end.
		 *
		 * @param string $name name of the asset.
		 * @param array  $args array of the new asset.
		 * @param string $type type of the asset, css|js.
		 *
		 * @version 0.0.2
		 * @since 0.0.1
		 */
		public static function add_front_asset( $name, $args, $type = 'css' ) {

			// Prepare default args.
			$default_args = [
				'src'       => '',
				'deps'      => [],
				'ver'       => '0.0.1',
				'in_footer' => false,
				'is_module' => true,
			];

			// Merge args.
			$args = wp_parse_args( $args, $default_args );

			// Maybe add to module.
			if ( 'js' === $type && $args['is_module'] ) {
				self::$as_module[] = $name;
			}

			// Merge the assets, whether it is css or js.
			if ( 'css' === $type ) {
				self::$front_css[ $name ] = $args;
				$args['in_footer']        = 'all';
			} else {
				self::$front_js[ $name ] = $args;
			}
		}

		/**
		 * Get front-end's assets.
		 *
		 * @param string $type type of the asset, css|js.
		 *
		 * @since 0.0.1
		 */
		public static function load_front_assets( $type = 'css' ) {
			$assets          = self::$front_js;
			$loader_function = 'wp_enqueue_script';

			if ( 'css' === $type ) {
				$assets          = self::$front_css;
				$loader_function = 'wp_enqueue_style';
			}

			// Loop assets.
			if ( ! empty( $assets ) ) {
				foreach ( $assets as $asset_name => $asset_arg ) {
					$loader_function( $asset_name, $asset_arg['src'], $asset_arg['deps'], $asset_arg['ver'], $asset_arg['in_footer'] );

					// Maybe localize script.
					if ( 'js' === $type && ! empty( $asset_arg['vars'] ) ) {
						wp_localize_script( $asset_name, 'obj', $asset_arg['vars'] );
					}
				}
			}
		}

		/**
		 * Get all js that should be treated as module.
		 *
		 * @return array
		 *
		 * @since 0.0.3
		 */
		public static function get_all_modules() {
			return self::$as_module;
		}
	}
}
