<?php
/**
 * Footer content template.
 *
 * @author WPerfekt
 * @package WPortfolio
 * @version 0.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<div class="text-center">
	<?php
	/* translators: %1$s : name of the site, %2$s : current year */
	echo sprintf( __( '<p>&copy; %1$s - %2$s</p>', 'wportfolio' ), esc_html( get_bloginfo( 'name' ) ), esc_html( date( 'Y' ) ) );
	?>
</div>
