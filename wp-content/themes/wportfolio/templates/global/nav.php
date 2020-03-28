<?php
/**
 * Nav template.
 *
 * @author WPerfekt
 * @package WPortfolio
 * @version 0.0.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$nav_class = isset( $nav_class ) && $nav_class ? $nav_class : ''; ?>

<nav class="nav <?php echo esc_attr( $nav_class ); ?>">
    <div class="frow-container">
        <div class="brand">
            <a href="<?php echo esc_attr( $nav_url ); ?>"><?php echo esc_html( $nav_text ); ?></a>
        </div>
        <ul class="contact-items-wrapper">
			<?php foreach ( $nav_items as $nav_item ) {
				/* translators: %1$s: item id, %2$s item url */
				echo sprintf( '<li class="contact-item item-%1$s"><a href="%2$s" target="_blank"></a></li>', $nav_item['id'], $nav_item['url'] );
			} ?>
        </ul>
    </div>
</nav>
