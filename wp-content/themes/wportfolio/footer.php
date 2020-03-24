<?php
/**
 * Footer template
 *
 * @author WPerfekt
 * @package WPortfolio
 * @version 0.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * WPortfolio footer action hook.
 *
 * @hooked UI::footer_open - 10
 * @hooked UI::footer_content - 20
 * @hooked UI::footer_close - 30
 *
 * @since 0.0.1
 */
do_action( 'wportfolio_footer' );

wp_footer(); ?>
</body>
</html>
