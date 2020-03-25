<?php
/**
 * Section contact template for front-page.
 *
 * @author WPerfekt
 * @package WPortfolio
 * @version 0.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<div class="text-center">
    <p><?php echo esc_html( $contact_content ); ?></p>

    <ul class="contact-items-wrapper">
		<?php foreach ( $contact_items as $contact_item ) { ?>
            <li class="contact-item item-<?php echo esc_attr( $contact_item['id'] ); ?>">
                <a href="<?php echo esc_attr( $contact_item['url'] ); ?>" target="_blank"></a>
            </li>
		<?php } ?>
    </ul>
</div>