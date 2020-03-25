<?php
/**
 * Section blog template for front-page.
 *
 * @author WPerfekt
 * @package WPortfolio
 * @version 0.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! empty( $blog_items ) ) { ?>
    <div class="blog-items-wrapper">
        <div class="frow">
			<?php foreach ( $blog_items as $blog_item ) { ?>
                <div class="col-sm-1-3">
                    <div class="blog-item">
                        <div class="thumbnail"></div>
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
<?php }
