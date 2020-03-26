<?php
/**
 * Single blog meta template.
 *
 * @author WPerfekt
 * @package WPortfolio
 * @version 0.0.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<div class="single-meta">
    <div class="author-avatar">
		<?php echo $meta_avatar; ?>
    </div>
    <div class="author-detail">
		<?php echo $meta_author_link; // phpcs:ignore ?>
        <span class="meta-date"><?php echo esc_html( $meta_date_time ); ?></span>
    </div>
</div>