<?php
/**
 * Section activity template for front-page.
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
	// Make sure it is success process.
	if ( $activity_success ) {
		?>
		<span class="activity-count" id="activity-count"><?php echo esc_html( $activity_total ); ?></span>
		<p><?php echo esc_html( $activity_content ); ?></p>
		<?php
	} else {
		?>
		<p><?php echo esc_html( $activity_error ); ?></p>
	<?php } ?>
</div>
