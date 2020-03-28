<?php
/**
 * Post list template for archive page.
 *
 * @author WPerfekt
 * @package WPortfolio
 * @version 0.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<div class="blog-item">
    <div class="blog-thumbnail" <?php echo $blog_bg; // phpcs:ignore ?>></div>
	<div class="blog-detail">
		<?php echo $blog_category; // phpcs:ignore ?>
		<a href="<?php echo esc_attr( $blog_permalink ); ?>" class="link" title="<?php echo esc_attr( $blog_title ); ?>"><?php echo esc_html( $blog_title ); ?></a>
		<p class="excerpt"><?php echo esc_html( $blog_excerpt ); ?></p>
		<span class="date"><?php echo esc_html( $blog_date ); ?></span>
	</div>
</div>
