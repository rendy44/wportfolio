<?php
/**
 * Single blog like template.
 *
 * @author WPerfekt
 * @package WPortfolio
 * @version 0.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$button_like_class  = 'button-like';
$button_like_class .= $is_liked ? ' liked' : '';
?>

<div class="single-like">
	<button class="<?php echo esc_attr( $button_like_class ); ?>" data-id="<?php echo esc_attr( $post_id ); ?>"></button>
	<span class="counter">
	<?php
	/* translators: %s : number of likes */
		echo esc_html( sprintf( _n( '%s love', '%s loves', $like_count, 'wportfolio' ), $like_count ) );
	?>
		</span>
</div>
