<?php
/**
 * UI Class
 * This class is used to manage content of the most of the pages.
 *
 * @author WPerfekt
 * @package WPortfolio
 * @version 0.0.1
 */

namespace WPortfolio;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WPortfolio\UI' ) ) {

	/**
	 * Class UI
	 *
	 * @package WPortfolio
	 */
	class UI {

		/**
		 * Instance variable.
		 *
		 * @var null
		 */
		private static $instance = null;

		/**
		 * Singleton
		 *
		 * @return UI|null
		 */
		public static function init() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * UI constructor.
		 */
		private function __construct() {
			$this->front_page();
		}

		/**
		 * Modify front page content.
		 */
		private function front_page() {

			// Render masthead.
			add_action( 'wp_body_open', [ $this, 'masthead_open' ], 10 );
			add_action( 'wp_body_open', [ $this, 'masthead_content' ], 20 );
			add_action( 'wp_body_open', [ $this, 'masthead_close' ], 30 );

			// Global section.
			add_action( 'wportfolio_before_section', [ $this, 'section_open' ], 10, 2 );
			add_action( 'wportfolio_after_section', [ $this, 'section_close' ], 50, 2 );

			// Render footer.
			add_action( 'wportfolio_footer', [ $this, 'footer_open' ], 10 );
			add_action( 'wportfolio_footer', [ $this, 'footer_content' ], 20 );
			add_action( 'wportfolio_footer', [ $this, 'footer_close' ], 30 );
		}

		/**
		 * Callback for masthead open content.
		 */
		public function masthead_open() {
			$args = [];

			// Add extra class if accessed in front-page.
			if ( is_front_page() ) {
				$args['masthead_class'] = 'masthead-front-page';
			}

			/**
			 * WPortfolio masthead open filter hook.
			 *
			 * @param array $args default args.
			 *
			 * @since 0.0.1
			 */
			$args = apply_filters( 'wportfolio_masthead_open_args', $args );

			Template::render( 'global/masthead-open', $args );
		}

		/**
		 * Callback for masthead content.
		 */
		public function masthead_content() {
			Template::render( 'front-page/masthead' );
		}

		/**
		 * Callback for masthead close content.
		 */
		public function masthead_close() {
			Template::render( 'global/masthead-close' );
		}

		/**
		 * Callback for section open content.
		 *
		 * @param string $section name of the current section.
		 * @param int $post_id id of the current page.
		 */
		public function section_open( $section, $post_id ) {
			$args = [
				'section_class' => 'section-' . $section,
			];

			/**
			 * WPortfolio section open args filter hook.
			 *
			 * @param array $args default args.
			 * @param string $section name of the current section.
			 * @param int $post_id id of the current page.
			 *
			 * @since 0.0.1
			 */
			$args = apply_filters( 'wportfolio_section_open_args', $args, $section, $post_id );

			Template::render( 'global/section-open', $args );
		}

		/**
		 * Callback for section close content.
		 *
		 * @param string $section name of the current section.
		 * @param int $post_id id of the current page.
		 */
		public function section_close( $section, $post_id ) {
			Template::render( 'global/section-close' );
		}

		/**
		 * Callback for footer open content.
		 */
		public function footer_open() {
			$args = [
				'footer_class' => 'footer-dark',
			];

			/**
			 * WPortfolio footer open args filter hook.
			 *
			 * @param array $args default args.
			 *
			 * @since 0.0.1
			 */
			$args = apply_filters( 'wportfolio_footer_open_args', $args );

			Template::render( 'global/footer-open', $args );
		}

		/**
		 * Callback for footer content.
		 */
		public function footer_content() {
			Template::render( 'global/footer-content' );
		}

		/**
		 * Callback for footer close content.
		 */
		public function footer_close() {
			Template::render( 'global/footer-close' );
		}
	}

	UI::init();
}