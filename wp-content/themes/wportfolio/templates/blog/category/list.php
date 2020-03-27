<?php
/**
 * Category list template for archive page.
 *
 * @author WPerfekt
 * @package WPortfolio
 * @version 0.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<ul class="archive-categories-wrapper">
	<?php if ( ! empty( $archive_categories ) ) {
		foreach ( $archive_categories as $category ) {
			/* translators: %1$s: url category, %2$s: category name, %3$s: category count */
			echo sprintf( '<a href="%1$s">%2$s (%3$s)</a>', get_category_link( $category ), $category->name, $category->count );
		}
	} ?>
</ul>
