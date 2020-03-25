<?php
/**
 * Masthead opener template.
 *
 * @author WPerfekt
 * @package WPortfolio
 * @version 0.0.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$masthead_class = isset( $masthead_class ) && $masthead_class ? $masthead_class : '';
$masthead_size  = isset( $masthead_size ) && $masthead_size ? $masthead_size : 'col-md-2-3';
?>

<section class="masthead <?php echo esc_attr( $masthead_class ); ?>">
    <div class="left-masthead"></div>
    <div class="right-masthead"></div>
    <div class="frow-container">
        <div class="frow">
            <div class="<?php echo esc_attr( $masthead_size ); ?>">
