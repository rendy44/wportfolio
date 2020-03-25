<?php
/**
 * UI Class
 * This class is used to manage content of the most of the pages.
 *
 * @author WPerfekt
 * @package WPortfolio
 * @version 0.0.6
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
			add_action( 'wportfolio_before_section', [ $this, 'section_open' ], 10, 3 );
			add_action( 'wportfolio_before_section', [ $this, 'section_title' ], 20, 3 );
			add_action( 'wportfolio_after_section', [ $this, 'section_close' ], 50, 3 );

			// Section about.
			add_action( 'wportfolio_section_about', [ $this, 'about_content' ], 10, 2 );

			// Section focus.
			add_action( 'wportfolio_section_focus', [ $this, 'focus_content' ], 10, 2 );

			// Render footer.
			add_action( 'wportfolio_footer', [ $this, 'footer_open' ], 10 );
			add_action( 'wportfolio_footer', [ $this, 'footer_content' ], 20 );
			add_action( 'wportfolio_footer', [ $this, 'footer_close' ], 30 );
		}

		/**
		 * Callback for masthead open content.
		 *
		 * @since 0.0.1
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
		 *
		 * @since 0.0.1
		 */
		public function masthead_content() {
			Template::render( 'front-page/masthead' );
		}

		/**
		 * Callback for masthead close content.
		 *
		 * @since 0.0.1
		 */
		public function masthead_close() {
			Template::render( 'global/masthead-close' );
		}

		/**
		 * Callback for section open content.
		 *
		 * @param string $section name of the current section.
		 * @param string $section_title title of the current section. @since 0.0.2
		 * @param int $post_id id of the current page.
		 *
		 * @version 0.0.3
		 * @since 0.0.1
		 */
		public function section_open( $section, $section_title, $post_id ) {
			$args = [
				'section_class' => 'section-' . $section,
				'section_id'    => $section,
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
		 * Callback for section open content.
		 *
		 * @param string $section name of the current section.
		 * @param string $section_title title of the current section.
		 * @param int $post_id id of the current page.
		 *
		 * @since 0.0.2
		 */
		public function section_title( $section, $section_title, $post_id ) {
			$args = [
				'section_title' => $section_title,
			];

			/**
			 * WPortfolio section title args filter hook.
			 *
			 * @param array $args default args.
			 * @param string $section name of the current section.
			 * @param int $post_id id of the current page.
			 *
			 * @since 0.0.2
			 */
			$args = apply_filters( 'wportfolio_section_title_args', $args, $section, $post_id );

			Template::render( 'global/section-title', $args );
		}

		/**
		 * Callback for section close content.
		 *
		 * @param string $section name of the current section.
		 * @param string $section_title title of the current section. @since 0.0.2
		 * @param int $post_id id of the current page.
		 *
		 * @version 0.0.2
		 * @since 0.0.1
		 */
		public function section_close( $section, $section_title, $post_id ) {
			Template::render( 'global/section-close' );
		}

		/**
		 * Callback for section about content.
		 *
		 * @param string $section_title title of the current section. @since 0.0.2
		 * @param int $post_id id of the current page.
		 *
		 * @since 0.0.3
		 */
		public function about_content( $section_title, $post_id ) {
			Template::render( 'front-page/section-about' );
		}

		/**
		 * Callback for section focus content.
		 *
		 * @param string $section_title title of the current section. @since 0.0.2
		 * @param int $post_id id of the current page.
		 *
		 * @version 0.0.2
		 * @since 0.0.4
		 */
		public function focus_content( $section_title, $post_id ) {
			$focus_items = [
				[
					'id'    => 'wpcs',
					'title' => __( 'WPCS Compliant', 'wportfolio' ),
					'desc'  => __( 'One of the biggest advantage of passing WPCS compliant is that we can build our theme nor plugin beautifully.', 'wportfolio' ),
				],
				[
					'id'    => 'config',
					'title' => __( 'Customizable', 'wportfolio' ),
					'desc'  => __( 'Another great advantage of using WordPress is its hooks, which make development way more easier and simpler.', 'wportfolio' ),
				],
				[
					'id'    => 'secure',
					'title' => __( 'Secure', 'wportfolio' ),
					'desc'  => __( 'No matter how beautiful and advance the website is, if it is not secure, it is worth nothing.', 'wportfolio' ),
				],
			];

			/**
			 * WPortfolio focus item filter hooks.
			 *
			 * @param array $focus_items default focus items.
			 * @param int $post_id id of the current page.
			 *
			 * @since 0.0.2
			 */
			$focus_items = apply_filters( 'wportfolio_focus_items', $focus_items, $post_id );

			// Prepare the args.
			$args = [
				'focus_items' => $focus_items,
			];

			/**
			 * WPortfolio section focus content args filter hook.
			 *
			 * @param array $args default args.
			 * @param int $post_id id of the current page.
			 *
			 * @since 0.0.2
			 */
			$args = apply_filters( 'wportfolio_section_focus_content_args', $args, $post_id );

			Template::render( 'front-page/section-focus', $args );
		}

		/**
		 * Callback for footer open content.
		 *
		 * @since 0.0.1
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
		 *
		 * @since 0.0.1
		 */
		public function footer_content() {
			Template::render( 'global/footer-content' );
		}

		/**
		 * Callback for footer close content.
		 *
		 * @since 0.0.1
		 */
		public function footer_close() {
			Template::render( 'global/footer-close' );
		}
	}

	UI::init();
}