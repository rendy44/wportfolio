<?php
/**
 * UI Class
 * This class is used to manage content of the most of the pages.
 *
 * @author WPerfekt
 * @package WPortfolio
 * @version 0.2.5
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
		 *
		 * @version 0.0.2
		 * @since 0.0.1
		 */
		private function __construct() {
			$this->global_page();
			$this->front_page();
			$this->single_page();
			$this->archive_page();
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
		 * Add content for single post page.
		 *
		 * @since 0.1.1
		 */
		private function single_page() {

			// Global section.
			add_action( 'wportfolio_before_single_content', [ $this, 'single_page_section_open' ], 10, 2 );
			add_action( 'wportfolio_after_single_content', [ $this, 'single_page_section_close' ], 50, 2 );

			// Single post content.
			add_action( 'wportfolio_single_post_content', [ $this, 'single_post_meta' ], 10, 1 );
			add_action( 'wportfolio_single_post_content', [ $this, 'single_post_content' ], 20, 1 );
			add_action( 'wportfolio_single_post_content', [ $this, 'single_post_tag' ], 30, 1 );
			add_action( 'wportfolio_single_post_content', [ $this, 'single_post_like' ], 40, 1 );
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
		 * Modify archive page content.
		 *
		 * @since 0.2.3
		 */
		private function archive_page() {

			// Render section.
			add_action( 'wportfolio_before_archive', [ $this, 'archive_section_open' ], 10 );
			add_action( 'wportfolio_after_archive', [ $this, 'archive_section_close' ], 50 );

			// Render category.
			add_action( 'wportfolio_before_archive', [ $this, 'archive_category_list' ], 20 );

			// Render posts wrapper
			add_action( 'wportfolio_before_archive', [ $this, 'archive_post_wrapper_open' ], 30 );
			add_action( 'wportfolio_after_archive', [ $this, 'archive_post_wrapper_close' ], 40 );

			// Render post list.
			add_action( 'wportfolio_archive_post', [ $this, 'archive_post_list' ], 10, 1 );
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
		 * Callback for adding section open in single post.
		 *
		 * @param string $post_type name of the current post type.
		 * @param int $post_id id of the current post.
		 *
		 * @version 0.0.2
		 * @since 0.1.8
		 */
		public function single_page_section_open( $post_type, $post_id ) {
			$args = [
				/* translators: %1$s: post type name, %2$s : post id */
				'section_id'    => sprintf( '%1$s-%2$s', $post_type, $post_id ),
				'section_class' => 'section-single section-single-' . $post_type,
				'section_size'  => 'col-sm-4-5 col-md-2-3',
			];

			/**
			 * WPortfolio single section open args.
			 *
			 * @param array $args default args.
			 *
			 * @since 0.0.1
			 */
			$args = apply_filters( 'wportfolio_single_section_open_args', $args, $post_type, $post_id );

			Template::render( 'global/section-open', $args );
		}

		/**
		 * Callback for adding section close in single post.
		 *
		 * @param string $post_type name of the current post type.
		 * @param int $post_id id of the current post.
		 *
		 * @since 0.1.8
		 */
		public function single_page_section_close( $post_type, $post_id ) {
			Template::render( 'global/section-close' );
		}

		/**
		 * Callback for adding single post meta.
		 *
		 * @param int $post_id id of the current post.
		 *
		 * @version 0.0.2
		 * @since 0.1.9
		 */
		public function single_post_meta( $post_id ) {

			$args = [
				'meta_author_link' => get_the_author_posts_link(),
				'meta_date_time'   => get_the_date() . ' @ ' . get_the_time(),
				'meta_avatar'      => get_avatar( get_the_author_meta( 'ID' ), 50 ),
			];

			/**
			 * WPortfolio single post meta args filter hook.
			 *
			 * @param array $meta_items default meta items.
			 * @param int $post_id id of the current post.
			 *
			 * @since 0.0.1
			 */
			$args = apply_filters( 'wportfolio_single_post_meta_args', $args, $post_id );

			Template::render( 'blog/single/meta', $args );
		}

		/**
		 * Callback for adding single post content.
		 *
		 * @param int $post_id id of the current post.
		 *
		 * @since 0.1.9
		 */
		public function single_post_content( $post_id ) {
			the_content();
		}

		/**
		 * Callback for adding single post tag.
		 *
		 * @param int $post_id id of the current post.
		 *
		 * @since 0.2.1
		 */
		public function single_post_tag( $post_id ) {
			echo get_the_tag_list( '<div class="post-tags">', '', '</div>' ); // phpcs:ignore
		}

		/**
		 * Callback for adding single post like.
		 *
		 * @param int $post_id id of the current post.
		 *
		 * @since 0.2.2
		 */
		public function single_post_like( $post_id ) {

			// Instance post like object.
			$post_like = new Post_Like( $post_id );

			$args = [
				'post_id'    => $post_id,
				'like_count' => $post_like->get_likes(),
				'is_liked'   => $post_like->is_liked(),
			];

			/**
			 * WPortfolio single post like args filter hook.
			 *
			 * @param array $args default args.
			 * @param int $post_id id of the current post.
			 * @param Post_Like $post_like object of the current post like.
			 *
			 * @since 0.0.1
			 */
			$args = apply_filters( 'wportfolio_single_post_like_args', $args, $post_id, $post_like );

			Template::render( 'blog/single/like', $args );

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
		 * @version 0.0.2
		 * @since 0.0.2
		 */
		public function front_page_section_title( $section, $section_title, $post_id ) {
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
		 * @version 0.0.3
		 * @since 0.0.1
		 */
		public function front_page_section_close( $section, $section_title, $post_id ) {
			Template::render( 'global/section-close' );
		}

		/**
		 * Callback for section about content.
		 *
		 * @param string $section_title title of the current section. @since 0.0.2
		 * @param int $post_id id of the current page.
		 *
		 * @version 0.0.3
		 * @since 0.0.3
		 */
		public function front_page_about_content( $section_title, $post_id ) {
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
		 * @version 0.0.4
		 * @since 0.0.4
		 */
		public function front_page_focus_content( $section_title, $post_id ) {
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
		 * @version 0.0.2
		 * @since 0.1.4
		 */
		public function front_page_blog_content( $section_title, $post_id ) {
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
		 * @version 0.0.2
		 * @since 0.1.0
		 */
		public function front_page_contact_content( $section_title, $post_id ) {
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
		 * Callback for section open in archive.
		 *
		 * @version 0.0.2
		 * @since 0.2.3
		 */
		public function archive_section_open() {
			$args = [
				'section_id'    => 'archive',
				'section_class' => 'section-archive',
				'section_size'  => 'col-md-2-3',
			];

			/**
			 * WPortfolio archive section open args filter hook.
			 *
			 * @param array $args default args.
			 *
			 * @since 0.0.1
			 */
			$args = apply_filters( 'wportfolio_archive_section_open_args', $args );

			Template::render( 'global/section-open', $args );
		}

		/**
		 * Callback for section close in archive.
		 *
		 * @since 0.2.3
		 */
		public function archive_section_close() {
			Template::render( 'global/section-close' );
		}

		/**
		 * Callback for category list in archive page.
		 *
		 * @version 0.0.3
		 * @since 0.2.3
		 */
		public function archive_category_list() {
			$category_args = [
				'hide_empty' => false,
			];

			/**
			 * WPortfolio archive category args filter hook.
			 *
			 * @param array $category_args default args.
			 *
			 * @since 0.0.1
			 */
			$category_args = apply_filters( 'wportfolio_archive_category_args', $category_args );

			// Get all categories.
			$categories = get_categories( $category_args );

			$args = [
				'archive_categories' => $categories,
			];

			/**
			 * WPortfolio archive section args filter hook.
			 *
			 * @param array $args default args.
			 *
			 * @since 0.0.1
			 */
			$args = apply_filters( 'wportfolio_archive_section_args', $args );

			Template::render( 'blog/archive/category', $args );
		}

		/**
		 * Callback for archive posts wrapper open.
		 *
		 * @since 0.2.5
		 */
		public function archive_post_wrapper_open() { ?>
            <div class="archive-posts-wrapper">
		<?php }

		/**
		 * Callback for archive posts wrapper close.
		 *
		 * @since 0.2.5
		 */
		public function archive_post_wrapper_close() { ?>
            </div>
		<?php }

		/**
		 * Callback for rendering post list.
		 *
		 * @param int $post_id id of the current post.
		 *
		 * @since 0.2.5
		 */
		public function archive_post_list( $post_id ) {

			// Fetch thumbnail as bg.
			$thumbnail_url = get_the_post_thumbnail_url( $post_id );
			$bg_image      = $thumbnail_url ? "style='background-image: url({$thumbnail_url});'" : '';

			// Prepare args.
			$args = [
				'id'             => $post_id,
				'blog_bg'        => $bg_image,
				'blog_title'     => get_the_title( $post_id ),
				'blog_permalink' => get_permalink( $post_id ),
				'blog_excerpt'   => get_the_excerpt( $post_id ),
				'blog_date'      => get_the_date( '', $post_id ),
				'blog_category'  => get_the_category_list( '', '', $post_id ),
			];

			/**
			 * WPortfolio archive post list args filter hook.
			 *
			 * @param array $args default args.
			 * @param int $post_id id of the current post.
			 *
			 * @since 0.0.1
			 */
			$args = apply_filters( 'wportfolio_archive_post_list', $args, $post_id );

			Template::render( 'blog/archive/post', $args );
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