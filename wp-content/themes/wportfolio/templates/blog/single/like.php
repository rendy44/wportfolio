<?php
/**
 * Single blog like template.
 *
 * @author WPerfekt
 * @package WPortfolio
 * @version 0.0.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<div class="single-like">
	<button class="button-like" data-id="<?php echo esc_attr( $post_id ); ?>"></button>
	<span class="counter">
	<?php
	/* translators: %s : number of likes */
		echo esc_html( sprintf( _n( '%s love', '%s loves', $like_count, 'wportfolio' ), $like_count ) );
	?>
	</span>
</div>
