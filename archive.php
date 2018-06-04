<?php
/* The template for displaying archive pages */
get_header(); ?>

<section class="main-content">
	<div class="container-fluid">
		<div class="row">
			<main class="content">
				<?php if ( have_posts() ) : ?>
					<?php
						the_archive_title( '<h1>', '</h1>' );
						the_archive_description( '<div class="taxonomy-description">', '</div>' );
					?>
				<?php endif; ?>
				<?php
				// Posts Feed
				if ( have_posts() ) : ?>
					<?php
					// Start the Loop
					while ( have_posts() ) : the_post();
						get_template_part( 'template-parts/post/content', get_post_format() );
					endwhile;
					the_posts_pagination( array(
						'prev_text' => '<button class="btn btn-primary">' . __( 'Previous page' ) . '</button>',
						'next_text' => '<button class="btn btn-primary">' . __( 'Next page' ) . '</button>',
						'before_page_number' => '<button class="meta-nav btn btn-primary">' . __( 'Page ' ),
						'after_page_number' => '</button>',
					) );
				else :
					// If no posts to display...
					get_template_part( 'template-parts/post/content', 'none' );
				endif; ?>				
			</main>
			<!-- Sidebar -->
			<aside class="sidebar">
				<?php get_sidebar(); ?>
			</aside>
		</div> <!-- .row -->
	</div> <!-- .container-fluid -->
</section>

<?php get_footer();
