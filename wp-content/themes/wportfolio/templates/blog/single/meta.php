<?php
/**
 * Single blog meta template.
 *
 * @author WPerfekt
 * @package WPortfolio
 * @version 0.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<ul class="single-meta-items-wrapper">
	<?php foreach ( $meta_items as $meta_item ) { ?>
        <li class="meta-<?php echo esc_attr( $meta_item['id'] ); ?>">
            <span><?php echo $meta_item['html']; // phpcs:ignore ?></span>
        </li>
	<?php } ?>
</ul>
