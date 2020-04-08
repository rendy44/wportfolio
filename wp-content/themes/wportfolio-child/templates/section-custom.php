<?php
/**
 * Custom template that will be rendered in section `custom`.
 *
 * @author WPerfekt
 * @package WPortfolio
 * @version 0.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<div class="text-center">
	<p><?php echo esc_html( $custom_content ); ?></p>
</div>
