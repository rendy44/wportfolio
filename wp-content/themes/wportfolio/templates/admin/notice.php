<?php
/**
 * Notice template that will be displayed for admin only.
 *
 * @author WPerfekt
 * @package WPortfolio
 * @version 0.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Only for logged-in user.
if ( is_user_logged_in() ) {
	?>

	<div class="warning">
		<span class="warning-icon"></span>
		<p><?php echo esc_html( $warning_message ); ?></p>
		<p class="info"><?php esc_html_e( 'This message only visible to you.', 'wportfolio' ); ?></p>
	</div>

	<?php
}
