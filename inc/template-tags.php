<?php
/* Custom template tags for this theme */

if ( ! function_exists( 'theme_posted_on' ) ) :
// Prints HTML with meta information for the current post-date/time and author.
function theme_posted_on() {
	// Get the author name; wrap it in a link.
	$byline = sprintf(
		// translators: %s: post author 
		__( 'by %s', 'theme' ),
		get_the_author()
	);
	// Finally, let's write all of this to the page.
	echo '<span class="posted-on">' . theme_time_link() . '</span><span class="byline"> ' . $byline . '</span>';
}
endif;

if ( ! function_exists( 'theme_time_link' ) ) :
// Gets a nicely formatted string for the published date.
function theme_time_link() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	$time_string = sprintf( $time_string,
		get_the_date( DATE_W3C ),
		get_the_date()
	);
	// Preface the time string with 'Posted on'.
	return sprintf(
		// translators: %s: post date 
		__( '<span class="screen-reader-text">Posted on</span> %s', 'theme' ),
		$time_string
	);
}
endif;

if ( ! function_exists( 'theme_entry_footer' ) ) :
// Prints HTML with meta information for the categories, tags and comments.
function theme_entry_footer() {
	// translators: used between list items, there is a space after the comma
	$separate_meta = __( ', ', 'theme' );
	// Get Categories for posts.
	$categories_list = get_the_category_list( $separate_meta );
	// Get Tags for posts.
	$tags_list = get_the_tag_list( '', $separate_meta );
	// We don't want to output .entry-footer if it will be empty, so make sure its not.
	if (((theme_categorized_blog() && $categories_list) || $tags_list) || get_edit_post_link()) {
		echo '<div class="entry-footer">';
			if ( 'post' === get_post_type() ) {
				if (($categories_list && theme_categorized_blog()) || $tags_list) {
					// Make sure there's more than one category before displaying.
					if ( $categories_list && theme_categorized_blog() ) {
						echo '<div class="cat-links"><i class="fa fa-folder-open"></i>' . __( 'Category: ', 'theme' ) . $categories_list . '</div>';
					}
					if ($tags_list) {
						echo '<div class="tags-links"><i class="fa fa-tags"></i>' . '<span class="screen-reader-text">' . __( 'Tags: ', 'theme' ) . '</span>' . $tags_list . '</div>';
					}
				}
			}
			theme_edit_link();
		echo '</div> <!-- .entry-footer -->';
	}
}
endif;


if ( ! function_exists( 'theme_edit_link' ) ) :
// Returns an accessibility-friendly link to edit a post or page.
function theme_edit_link() {
	edit_post_link(
		sprintf(
			// translators: %s: Name of current post
			__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'theme' ),
			get_the_title()
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/* Returns true if a blog has more than 1 category. */
function theme_categorized_blog() {
	$category_count = get_transient( 'theme_categories' );
	if ( false === $category_count ) {
		// Create an array of all the categories that are attached to posts.
		$categories = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );
		// Count the number of categories that are attached to the posts.
		$category_count = count( $categories );
		set_transient( 'theme_categories', $category_count );
	}
	// Allow viewing case of 0 or 1 categories in post preview.
	if (is_preview()) {
		return true;
	}
	return $category_count > 1;
}

/* Flush out the transients used in theme_categorized_blog. */
function theme_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'theme_categories' );
}
add_action( 'edit_category', 'theme_category_transient_flusher' );
add_action( 'save_post',     'theme_category_transient_flusher' );
