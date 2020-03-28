<?php
/**
 * Home template
 * Template for displaying posts as an archive.
 *
 * @author WPerfekt
 * @package WPortfolio
 * @version 0.0.4
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

/**
 * WPortfolio before archive action hook.
 *
 * @hooked UI::archive_section_open - 10
 * @hooked UI::archive_category_list - 20
 * @hooked UI::archive_post_wrapper_open - 30
 *
 * @version 0.0.2
 * @since 0.0.2
 */
do_action( 'wportfolio_before_archive' );

if ( have_posts() ) {

	// Loop available post.
	while ( have_posts() ) {
		the_post();

		/**
		 * WPortfolio archive post action hook.
		 *
		 * @param int $post_id id of the current post.
		 *
		 * @hooked UI::archive_post_list - 10
		 *
		 * @version 0.0.2
		 * @since 0.0.2
		 */
		do_action( 'wportfolio_archive_post', get_the_ID() );
	}
} else {

	/**
	 * WPortfolio archive no post action hook.
	 *
	 * @hooked UI::archive_no_post - 10
	 *
	 * @since 0.0.3
	 */
	do_action( 'wportfolio_archive_no_post' );
}

/**
 * WPortfolio after archive action hook.
 *
 * @hooked UI::archive_post_wrapper_close - 40
 * @hooked UI::archive_section_close - 50
 *
 * @since 0.0.2
 */
do_action( 'wportfolio_after_archive' );

/**
 * Include footer.
 *
 * @since 0.0.1
 */
get_footer();
