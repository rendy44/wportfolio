<?php
/**
 * Masthead template for front-page.
 *
 * @author WPerfekt
 * @package WPortfolio
 * @version 0.0.5
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<h1><?php echo esc_html( $masthead_title ); ?></h1>
<h2><?php echo esc_html( $masthead_subtitle ); ?></h2>
<a href="#contact" class="button button-success button-cta"><?php esc_html_e( 'Contact me', 'wportfolio' ); ?></a>
<a href="#about" class="button button-text button-cta"><?php esc_html_e( 'Know more', 'wportfolio' ); ?></a>
