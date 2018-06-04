<?php
/* 
The front page template file
If the user has selected a static page for their homepage, this is what will appear.
*/
get_header(); ?>

<section class="main-content">
	<?php // Show the selected frontpage content.
	if ( have_posts() ) :
		while ( have_posts() ) : the_post();
			get_template_part( 'template-parts/page/content', 'front-page' );
		endwhile;
	else :
		get_template_part( 'template-parts/post/content', 'none' );
	endif; ?>				
</section>

<?php get_footer();