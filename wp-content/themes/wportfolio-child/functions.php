<?php
/**
 * Main file of the theme.
 *
 * @author WPerfekt
 * @package WPortfolio
 * @version 0.0.1
 */

/**
 * Callback for modifying sections.
 *
 * @param array $sections default sections.
 *
 * @return array
 *
 * @since 0.0.1
 * @see Data::get_sections() to get all of available sections.
 */
function change_sections( $sections ) {

	// We'll remove experience section.
	unset( $sections['experience'] );

	// We'll add custom section.
	$sections['custom'] = __( 'Our Custom Section', 'wportfolio' );

	return $sections;
}

/**
 * WPortfolio data sections filter hook.
 *
 * @since 0.0.1
 */
add_filter( 'wportfolio_data_sections', 'change_sections', 10, 1 );

/**
 * Callback for rendering section `custom` content.
 *
 * @param string $section_title title of the section.
 * @param int    $page_id       id of the current page.
 *
 * @since 0.0.1
 */
function section_custom( $section_title, $page_id ) {
	$args = array(
		'custom_content' => __( 'Hi, I am a custom content for section custom', 'wportfolio' ),
	);

	// We will render template in folder `templates` and the name of the file is `section-custom.php`.
	WPortfolio\Template::render( 'section-custom', $args );
}

/**
 * WPortfolio section custom action hook.
 *
 * @since 0.0.1
 */
add_action( 'wportfolio_section_custom', 'section_custom', 10, 2 );
