<?php
/**
 * Single post template.
 *
 * @author WPerfekt
 * @package WPortfolio
 * @version 0.0.1
 */

use WPortfolio\Template;

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

	// Define variables.
	$post_type = get_post_type();
	$post_id   = get_the_ID();

	$args = [
		/* translators: %1$s: post type name, %2$s : post id */
		'section_id' => sprintf( '%1$s-%2$s', $post_type, $post_id ),
	];

	/**
	 * WPortfolio single section open args.
	 *
	 * @param array $args default args.
	 *
	 * @since 0.0.1
	 */
	$args = apply_filters( 'wportfolio_single_section_open_args', $args );

	Template::render( 'global/section-open', $args );

	/**
	 * WPortfolio before single post content action hook.
	 *
	 * @param string $post_type name of the current post type.
	 * @param int $post_id id of the current post.
	 *
	 * @since 0.0.1
	 */
	do_action( "wportfolio_before_single_content", $post_type, $post_id );

	/**
	 * WPortfolio single post content action hook.
	 *
	 * @param int $post_id id of the current post.
	 *
	 * @since 0.0.1
	 */
	do_action( "wportfolio_single_{$post_type}_content", $post_id );

	/**
	 * WPortfolio after single post content action hook.
	 *
	 * @param string $post_type name of the current post type.
	 * @param int $post_id id of the current post.
	 *
	 * @since 0.0.1
	 */
	do_action( "wportfolio_after_single_content", $post_type, $post_id );

	Template::render( 'global/section-close' );
}

/**
 * Include footer.
 *
 * @since 0.0.1
 */
get_footer();