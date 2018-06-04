<?php
/* Theme functions and definitions */


// THEME SETUP
function theme_setup() {
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	// Let WordPress manage the document title.
		/* By adding theme support, we declare that this theme does not use a hard-coded <title> tag in the document head, and expect WordPress to provide it for us. */
	add_theme_support( 'title-tag' );
	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );
	// Switch default core markup for search form, comment form, and comments
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	));
	// Register wp_nav_menu() navigation menu locations.
	register_nav_menus( array(
		'primary' => __('Main Navigation'),
		// 'top'  => __('Top Menu'), /* Add any additional menus here */
	));
}
add_action( 'after_setup_theme', 'theme_setup' );


// ENQUEUE SCRIPTS AND STYLES
function theme_scripts() {
	// Theme stylesheet
	wp_enqueue_style( 'main-styles', get_template_directory_uri() . '/assets/css/main.css' );
	// Theme sripts
	wp_enqueue_script( 'main-scripts', get_theme_file_uri( '/assets/js/scripts.min.js' ), array( 'jquery' ), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'theme_scripts' );


// REGISTER WIDGET AREAS
function theme_widgets_init() {
	register_sidebar(array(
		'name'          => __( 'Main Sidebar'),
		'id'            => 'main-sidebar',
		'description'   => __( 'Add widgets here to appear in your sidebar on standard pages.'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
	/* Add any additional dynamic sidebars or widgetized areas here */
	// register_sidebar( array(
	// 	'name'          => __( 'Footer Left'),
	// 	'id'            => 'footer-left',
	// 	'description'   => __( 'Add widgets here to appear in the left footer column.'),
	// 	'before_widget' => '<section id="%1$s" class="widget %2$s">',
	// 	'after_widget'  => '</section>',
	// 	'before_title'  => '<h2 class="widget-title">',
	// 	'after_title'   => '</h2>',
	// ));
}
add_action( 'widgets_init', 'theme_widgets_init' );


// FRONT PAGE TEMPLATE
function theme_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template',  'theme_front_page_template' );


// CUSTOM EXCERPTS
/* Replaces "[...]" (appended to automatically generated excerpts) with ... and a 'Continue reading' link. */
function theme_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}
	$link = sprintf( '<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		sprintf( __( 'Continue reading'), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'theme_excerpt_more' );


// ADDITIONAL FUNCTIONS
/* Custom template tags. */
require get_parent_theme_file_path( '/inc/template-tags.php' );

/* Additional features to allow styling of the templates. */
require get_parent_theme_file_path( '/inc/template-functions.php' );

/* Bootstrap Navwalker. */
require get_parent_theme_file_path( '/inc/bootstrap_navwalker.php' );

/* Breadcrumbs. */
// require get_parent_theme_file_path( '/inc/breadcrumbs.php' );

/* Gallery. */
// require get_parent_theme_file_path( '/inc/gallery.php' );

/* Customizer. */
// require get_parent_theme_file_path( '/inc/customizer.php' );