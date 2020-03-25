<?php
/**
 * UI Class
 * This class is used to manage content of the most of the pages.
 *
 * @author WPerfekt
 * @package WPortfolio
 * @version 0.1.7
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
			$this->global_page();
			$this->front_page();
		}

		/**
		 * Add content for global pages.
		 *
		 * @since 0.1.5
		 */
		private function global_page() {

			// Render masthead.
			add_action( 'wp_body_open', [ $this, 'masthead_open' ], 10 );
			add_action( 'wp_body_open', [ $this, 'masthead_content' ], 20 );
			add_action( 'wp_body_open', [ $this, 'masthead_close' ], 30 );
			add_filter( 'wportfolio_masthead_title', [ $this, 'masthead_title' ], 10, 1 );

			// Render footer.
			add_action( 'wportfolio_footer', [ $this, 'footer_open' ], 10 );
			add_action( 'wportfolio_footer', [ $this, 'footer_content' ], 20 );
			add_action( 'wportfolio_footer', [ $this, 'footer_close' ], 30 );
		}

		/**
		 * Modify front page content.
		 *
		 * @since 0.0.1
		 */
		private function front_page() {

			// Masthead content.
			add_filter( 'wportfolio_masthead_open_args', [ $this, 'masthead_args' ], 10, 1 );
			add_filter( 'wportfolio_masthead_template', [ $this, 'masthead_template' ], 10, 1 );
			add_filter( 'wportfolio_masthead_content_args', [ $this, 'masthead_content_args' ], 10, 1 );

			// Global section.
			add_action( 'wportfolio_before_section', [ $this, 'front_page_section_open' ], 10, 3 );
			add_filter( 'wportfolio_section_open_args', [ $this, 'front_page_section_size' ], 10, 3 );
			add_action( 'wportfolio_before_section', [ $this, 'front_page_section_title' ], 20, 3 );
			add_action( 'wportfolio_after_section', [ $this, 'front_page_section_close' ], 50, 3 );

			// Section about.
			add_action( 'wportfolio_section_about', [ $this, 'front_page_about_content' ], 10, 2 );

			// Section focus.
			add_action( 'wportfolio_section_focus', [ $this, 'front_page_focus_content' ], 10, 2 );

			// Section blog.
			add_action( 'wportfolio_section_blog', [ $this, 'front_page_blog_content' ], 10, 2 );

			// Section contact.
			add_action( 'wportfolio_section_contact', [ $this, 'front_page_contact_content' ], 10, 2 );
		}

		/**
		 * Callback for masthead open content.
		 *
		 * @version 0.0.2
		 * @since 0.0.1
		 */
		public function masthead_open() {
			$args = [];

			/**
			 * WPortfolio masthead open filter hook.
			 *
			 * @param array $args default args.
			 *
			 * @hooked self::masthead_args - 10
			 *
			 * @since 0.0.1
			 */
			$args = apply_filters( 'wportfolio_masthead_open_args', $args );

			Template::render( 'global/masthead-open', $args );
		}

		/**
		 * Callback for masthead content.
		 *
		 * @version 0.0.3
		 * @since 0.0.1
		 */
		public function masthead_content() {
			$template       = 'global/masthead-content';
			$masthead_title = get_the_title();

			/**
			 * WPortfolio masthead template filter hook.
			 *
			 * @hooked self::masthead_template - 10
			 *
			 * @param string $template default template path.
			 */
			$template = apply_filters( 'wportfolio_masthead_template', $template );

			/**
			 * WPortfolio masthead title filter hook.
			 *
			 * @param string $masthead_title default title.
			 *
			 * @hooked self::masthead_title - 10
			 *
			 * @since 0.0.3
			 */
			$masthead_title = apply_filters( 'wportfolio_masthead_title', $masthead_title );

			$args = [
				'masthead_title' => $masthead_title,
			];

			/**
			 * WPortfolio masthead content args filter hook.
			 *
			 * @param array $args default args.
			 *
			 * @hooked self::masthead_content_args - 10
			 *
			 * @since 0.0.2
			 */
			$args = apply_filters( 'wportfolio_masthead_content_args', $args );

			Template::render( $template, $args );
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
		 * Callback for modifying masthead title.
		 *
		 * @param string $title default title.
		 *
		 * @return string
		 *
		 * @version 0.0.2
		 * @since 0.1.5
		 */
		public function masthead_title( $title ) {

			// Change masthead title depends on the current page.
			if ( is_front_page() ) {
				$title = __( 'Hi, I am Rendy,', 'wportfolio' );
			} elseif ( is_home() ) {
				$title = _x( 'Recent Posts', 'Masthead title', 'wportfolio' );
			} elseif ( is_archive() ) {
				$title = get_the_archive_title();
			}

			return $title;
		}

		/**
		 * Callback for modifying masthead args.
		 *
		 * @param array $args default args.
		 *
		 * @return array
		 *
		 * @since 0.1.5
		 */
		public function masthead_args( $args ) {

			// Add class for front page.
			if ( is_front_page() ) {
				$args['masthead_class'] = 'masthead-front-page';
			}

			return $args;
		}

		/**
		 * Callback for modifying masthead template.
		 *
		 * @param string $template default template.
		 *
		 * @return string
		 *
		 * @since 0.1.5
		 */
		public function masthead_template( $template ) {

			// Change template in front page.
			if ( is_front_page() ) {
				$template = 'front-page/masthead';
			}

			return $template;
		}

		/**
		 * Callback for modifying masthead content args.
		 *
		 * @param array $args default title.
		 *
		 * @return array
		 *
		 * @since 0.1.5
		 */
		public function masthead_content_args( $args ) {

			// Add args in front page.
			if ( is_front_page() ) {
				$args['masthead_subtitle'] = __( 'a WordPress Developer', 'wportfolio' );
			}

			return $args;
		}

		/**
		 * Callback for section open content.
		 *
		 * @param string $section name of the current section.
		 * @param string $section_title title of the current section. @since 0.0.2
		 * @param int $post_id id of the current page.
		 *
		 * @version 0.0.4
		 * @since 0.0.1
		 */
		public function front_page_section_open( $section, $section_title, $post_id ) {
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
			 * @hooked self::section_focus_size - 10
			 *
			 * @since 0.0.1
			 */
			$args = apply_filters( 'wportfolio_section_open_args', $args, $section, $post_id );

			Template::render( 'global/section-open', $args );
		}


		/**
		 * Callback for filtering section size.
		 *
		 * @param array $args default args.
		 * @param string $section name of the current section.
		 * @param int $post_id id of the current page.
		 *
		 * @return array
		 *
		 * @version 0.0.2
		 * @since 0.0.7
		 */
		public function front_page_section_size( $args, $section, $post_id ) {
			switch ( $section ) {
				case 'focus':
				case 'blog':

					// Add custom data.
					$args['section_size'] = 'col-md-2-3';
					break;
			}

			return $args;
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
		 * @version 0.0.2
		 * @since 0.0.3
		 */
		public function about_content( $section_title, $post_id ) {
			$args = [
				'about_content' => __( 'I am a WordPress Developer based in Yogyakarta, Indonesia. I am passionate to write clean and efficient code but highly customizable.', 'wportfolio' ),
			];

			/**
			 * WPortfolio section about content args filter hook.
			 *
			 * @param array $args default args.
			 * @param int $post_id id of the current page.
			 *
			 * @since 0.0.2
			 */
			$args = apply_filters( 'wportfolio_section_about_content_args', $args, $post_id );

			Template::render( 'front-page/section-about', $args );
		}

		/**
		 * Callback for section focus content.
		 *
		 * @param string $section_title title of the current section. @since 0.0.2
		 * @param int $post_id id of the current page.
		 *
		 * @version 0.0.3
		 * @since 0.0.4
		 */
		public function focus_content( $section_title, $post_id ) {
			$focus_items = [
				[
					'id'    => 'wpcs',
					'title' => __( 'WPCS Compliant', 'wportfolio' ),
					'desc'  => __( 'By following WPCS we can expect most of what WordPress can offers.', 'wportfolio' ),
				],
				[
					'id'    => 'config',
					'title' => __( 'Customizable', 'wportfolio' ),
					'desc'  => __( 'Thanks to WordPress hooks, they make development way more easier and simpler.', 'wportfolio' ),
				],
				[
					'id'    => 'secure',
					'title' => __( 'Secure', 'wportfolio' ),
					'desc'  => __( 'Beautiful and cutting-edge website is worth nothing if it is not secure.', 'wportfolio' ),
				],
			];

			/**
			 * WPortfolio focus items filter hooks.
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
		 * Callback for section blog content.
		 *
		 * @param string $section_title title of the current section. @since 0.0.2
		 * @param int $post_id id of the current page.
		 *
		 * @since 0.1.4
		 */
		public function blog_content( $section_title, $post_id ) {
			$blog_items = [];

			// Get posts.
			$posts_query = Master::get_posts( [ 'posts_per_page' => 3 ] );
			if ( $posts_query->have_posts() ) {
				while ( $posts_query->have_posts() ) {
					$posts_query->the_post();

					// Save post details.
					$blog_items[] = [
						'id'            => get_the_ID(),
						'title'         => get_the_title(),
						'permalink'     => get_permalink(),
						'thumbnail_url' => get_the_post_thumbnail_url(),
						'excerpt'       => get_the_excerpt(),
						'date'          => get_the_date(),
					];
				}
			}

			$args = [
				'blog_items' => $blog_items,
				'blog_empty' => __( 'No posts found', 'wportfolio' ),
			];

			/**
			 * WPortfolio section blog content args filter hook.
			 *
			 * @param array $args default args.
			 * @param int $post_id id of the current page.
			 *
			 * @since 0.0.1
			 */
			$args = apply_filters( 'wportfolio_section_blog_content_args', $args, $post_id );

			Template::render( 'front-page/section-blog', $args );
		}

		/**
		 * Callback for section contact content.
		 *
		 * @param string $section_title title of the current section. @since 0.0.2
		 * @param int $post_id id of the current page.
		 *
		 * @since 0.1.0
		 */
		public function contact_content( $section_title, $post_id ) {
			$contact_items = [
				[
					'id'  => 'email',
					'url' => 'mailto:rendy.de.p@gmail.com',
				],
				[
					'id'  => 'linkedin',
					'url' => 'https://www.linkedin.com/in/rendi-dwi-p-792576119',
				],
				[
					'id'  => 'github',
					'url' => 'https://github.com/rendy44',
				],
				[
					'id'  => 'whatsapp',
					'url' => 'http://wa.me/6282219186349',
				],
			];

			/**
			 * WPortfolio contact items filter hooks.
			 *
			 * @param array $contact_items default contact items.
			 * @param int $post_id id of the current page.
			 *
			 * @since 0.0.2
			 */
			$contact_items = apply_filters( 'wportfolio_contact_items', $contact_items, $post_id );

			// Prepare the args.
			$args = [
				'contact_content' => __( 'If you have projects that need to be get started, you may need some helps or just saying hey, let\'s get in touch.', 'wportfolio' ),
				'contact_items'   => $contact_items,
			];

			/**
			 * WPortfolio section contact content args filter hook.
			 *
			 * @param array $args default args.
			 * @param int $post_id id of the current page.
			 *
			 * @since 0.0.2
			 */
			$args = apply_filters( 'wportfolio_section_contact_content_args', $args, $post_id );

			Template::render( 'front-page/section-contact', $args );
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