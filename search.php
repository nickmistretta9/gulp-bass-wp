<?php
/* The template for displaying search results pages */
get_header(); ?>

<section class="main-content">
	<div class="container-fluid">
		<div class="row">
			<main class="content">
				<?php if ( have_posts() ) : ?>
					<h1><?php printf( __( 'Search Results for: %s' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				<?php else : ?>
					<h1><?php _e( 'Nothing Found' ); ?></h1>
				<?php endif; ?>
				<?php
				// Posts Feed
				if ( have_posts() ) : ?>
					<?php
					// Start the Loop
					while ( have_posts() ) : the_post();
						get_template_part( 'template-parts/post/content', 'excerpt' );
					endwhile;
					the_posts_pagination( array(
						'prev_text' => '<button class="btn btn-primary">' . __( 'Previous page' ) . '</button>',
						'next_text' => '<button class="btn btn-primary">' . __( 'Next page' ) . '</button>',
						'before_page_number' => '<button class="meta-nav btn btn-primary">' . __( 'Page ' ),
						'after_page_number' => '</button>',
					) );
				else : ?>
					<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.' ); ?></p>
					<?php get_search_form();
				endif; ?>	
			</main>
			<!-- Sidebar -->
			<aside class="sidebar">
				<?php get_sidebar(); ?>				
			</aside>
		</div> <!-- .row -->
	</div><!-- .container-fluid -->
</section>

<?php get_footer();
