<?php
/**
 * Section blog template for front-page.
 *
 * @author WPerfekt
 * @package WPortfolio
 * @version 0.0.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! empty( $blog_items ) ) { ?>
	<div class="blog-items-wrapper">
		<div class="frow">
			<?php
			foreach ( $blog_items as $blog_item ) {
				$bg_image = $blog_item['thumbnail_url'] ? "style='background-image: url({$blog_item['thumbnail_url']});'" : '';
				?>
				<div class="col-sm-1-3">
					<div class="blog-item">
						<div class="thumbnail" <?php echo $bg_image; // phpcs:ignore ?>></div>
						<a href="<?php echo esc_attr( $blog_item['permalink'] ); ?>" title="<?php echo esc_attr( $blog_item['title'] ); ?>"><h3><?php echo esc_html( $blog_item['title'] ); ?></h3></a>
						<p class="excerpt"><?php echo esc_html( $blog_item['excerpt'] ); ?></p>
						<p class="blog-time"><?php echo esc_html( $blog_item['date'] ); ?></p>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
<?php } else { ?>
	<div class="text-center">
		<p><?php echo esc_html( $blog_empty ); ?></p>
	</div>
	<?php
}

if ( $blog_url ) {
	?>
	<div class="text-center">
		<a href="<?php echo esc_attr( $blog_url ); ?>" class="button"><?php esc_html_e( 'All Posts', 'wportfolio' ); ?></a>
	</div>
	<?php
}
