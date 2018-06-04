<?php
/* Additional features to allow styling of the templates */

/* Adds custom classes to the array of body classes. */
function theme_body_classes( $classes ) {
	// Add class if we're viewing the Customizer for easier styling of theme options.
	if ( is_customize_preview() ) {
		$classes[] = 'customizer-view';
	}
	// Add class on front page.
	if ( is_front_page() && 'posts' !== get_option( 'show_on_front' ) ) {
		$classes[] = 'front-page';
	}
	return $classes;
}
add_filter( 'body_class', 'theme_body_classes' );

/* Checks to see if we're on the home page or not. */
function theme_is_frontpage() {
	return ( is_front_page() && ! is_home() );
}
