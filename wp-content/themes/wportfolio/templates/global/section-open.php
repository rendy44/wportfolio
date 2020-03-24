<?php
/**
 * Section opener template.
 *
 * @author WPerfekt
 * @package WPortfolio
 * @version 0.0.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$section_class = isset( $section_class ) && $section_class ? $section_class : '';
$section_size  = isset( $section_size ) && $section_size ? $section_size : '2-3';
?>

<section class="section <?php echo esc_attr( $section_class ); ?>" id="<?php echo esc_attr( $section_id ); ?>">
    <div class="left-section"></div>
    <div class="right-section"></div>
    <div class="frow-container">
        <div class="frow">
            <div class="col-sm-<?php echo esc_attr( $section_size ); ?>">
