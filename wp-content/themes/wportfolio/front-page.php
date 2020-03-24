<?php
/**
 * Front page template
 *
 * @author WPerfekt
 * @package WPortfolio
 * @version 0.0.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Include header.
 *
 * @since 0.0.1
 */
get_header();

while ( have_posts() ) {
	the_post();

	// Get current id.
	$post_id = get_the_ID();

	// Prepare used sections.
	$sections = [
		'about' => __( 'About Me', 'wportfolio' ),
		'focus' => __( 'My Focus Point', 'wportfolio' ),
	];

	/**
	 * WPortfolio front page section filter hook.
	 *
	 * @param array $sections list of default section.
	 * @param int $post_id id of the current page.
	 *
	 * @since 0.0.1
	 */
	$sections = apply_filters( 'wportfolio_front_page_section', $sections, $post_id );

	// Loop all sections.
	foreach ( $sections as $section => $section_title ) {

		/**
		 * WPortfolio before section action hook.
		 *
		 * @param string $section name of the current section.
		 * @param string $section_title title of the current section. @since 0.0.2
		 * @param int $post_id id of the current page.
		 *
		 * @hooked UI::section_open - 10
		 * @hooked UI::section_title - 20 @since 0.0.2
		 *
		 * @version 0.0.2
		 * @since 0.0.1
		 */
		do_action( 'wportfolio_before_section', $section, $section_title, $post_id );

		/**
		 * WPortfolio section action hook.
		 *
		 * @param string $section_title title of the current section. @since 0.0.2
		 * @param int $post_id id of the current page.
		 *
		 * @hooked UI::section_close - 50
		 *
		 * @version 0.0.2
		 * @since 0.0.1
		 */
		do_action( 'wportfolio_section_' . $section, $section_title, $post_id );

		/**
		 * WPortfolio after section action hook.
		 *
		 * @param string $section name of the current section.
		 * @param string $section_title title of the current section. @since 0.0.2
		 * @param int $post_id id of the current page.
		 *
		 * @version 0.0.2
		 * @since 0.0.1
		 */
		do_action( 'wportfolio_after_section', $section, $section_title, $post_id );
	}
}

/**
 * Include footer.
 *
 * @since 0.0.1
 */
get_footer();