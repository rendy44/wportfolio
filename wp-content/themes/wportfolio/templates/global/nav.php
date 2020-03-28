<?php
/**
 * Nav template.
 *
 * @author WPerfekt
 * @package WPortfolio
 * @version 0.0.1
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
    </div>
</nav>
