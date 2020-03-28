<?php
/**
 * Header template
 *
 * @author WPerfekt
 * @package WPortfolio
 * @version 0.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

	<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
		<link rel="pingback" href=" <?php bloginfo( 'pingback_url' ); ?>">
		<?php wp_head(); ?>
	</head>
<body <?php body_class(); ?>>
<?php
wp_body_open();
