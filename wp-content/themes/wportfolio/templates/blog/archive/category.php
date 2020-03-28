<?php
/**
 * Category list template for archive page.
 *
 * @author WPerfekt
 * @package WPortfolio
 * @version 0.0.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<ul class="archive-categories-wrapper">
	<?php
	if ( ! empty( $archive_categories ) ) {
		foreach ( $archive_categories as $category ) {
			/* translators: %1$s: url category, %2$s: category name, %3$s: category count */
			echo sprintf( '<li><a href="%1$s">%2$s <span>%3$s</span></a></li>', esc_attr( get_category_link( $category ) ), esc_html( $category->name ), esc_html( $category->count ) );
		}
	}
	?>
</ul>
