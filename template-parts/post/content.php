<?php
/* Template part for displaying posts */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-header">
		<?php
			the_title( '<h1>', '</h1>' );
			if ( 'post' === get_post_type() ) {
				echo '<div class="entry-meta">';
					if ( is_single() ) {
						theme_posted_on();
					} else {
						echo theme_time_link();
						theme_edit_link();
					};
				echo '</div><!-- .entry-meta -->';
			};		
		?>
	</div><!-- .entry-header -->

	<?php if ( '' !== get_the_post_thumbnail() && ! is_single() ) : ?>
		<div class="featured-img">
			<?php the_post_thumbnail( 'theme-featured-image' ); ?>
		</div><!-- .featured-img -->
	<?php endif; ?>

	<?php the_content(); ?>

	<?php
		if ( is_single() ) {
			theme_entry_footer();
		}
	?>
</article><!-- #post-## -->
