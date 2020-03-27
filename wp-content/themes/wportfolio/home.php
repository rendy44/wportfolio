<?php
/**
 * Home template
 * Template for displaying posts as an archive.
 *
 * @author WPerfekt
 * @package WPortfolio
 * @version 0.0.2
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
 *
 * @since 0.0.2
 */
do_action( 'wportfolio_before_archive' );

while ( have_posts() ) {
	the_post();

	/**
	 * WPortfolio archive post action hook.
	 *
	 * @param int $post_id id of the current post.
	 *
	 * @since 0.0.2
	 */
	do_action( 'wportfolio_archive_post', get_the_ID() );
}

/**
 * WPortfolio after archive action hook.
 *
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