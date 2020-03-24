<?php
/**
 * Front page template
 *
 * @author WPerfekt
 * @package WPortfolio
 * @version 0.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Include header.
 */
get_header();

while ( have_posts() ) {
	the_post();

	// Get current id.
	$post_id = get_the_ID();

	// Prepare used sections.
	$sections = [ 'about' ];

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
	foreach ( $sections as $section ) {

		/**
		 * WPortfolio before section action hook.
		 *
		 * @param string $section name of the current section.
		 * @param int $post_id id of the current page.
		 *
		 * @hooked UI::section_open - 10
		 *
		 * @since 0.0.1
		 */
		do_action( 'wportfolio_before_section', $section, $post_id );

		/**
		 * WPortfolio section action hook.
		 *
		 * @param int $post_id id of the current page.
		 *
		 * @hooked UI::section_close - 50
		 *
		 * @since 0.0.1
		 */
		do_action( 'wportfolio_section_' . $section, $post_id );

		/**
		 * WPortfolio after section action hook.
		 *
		 * @param string $section name of the current section.
		 * @param int $post_id id of the current page.
		 *
		 * @since 0.0.1
		 */
		do_action( 'wportfolio_after_section', $section, $post_id );
	}
}

/**
 * Include footer.
 */
get_footer();