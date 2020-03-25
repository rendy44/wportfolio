<?php
/**
 * Section focus template for front-page.
 *
 * @author WPerfekt
 * @package WPortfolio
 * @version 0.0.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<div class="focus-items-wrapper">
    <div class="frow">
		<?php foreach ( $focus_items as $focus_item ) { ?>
            <div class="col-sm-1-3">
                <div class="focus-item item-<?php echo esc_attr( $focus_item['id'] ); ?>">
                    <div class="icon">
                        <span class="icon-fill"></span>
                    </div>
                    <h3><?php echo esc_html( $focus_item['title'] ); ?></h3>
                    <p><?php echo esc_html( $focus_item['desc'] ); ?></p>
                </div>
            </div>
		<?php } ?>
    </div>
</div>