<?php
/* The blog index template file */
get_header(); ?>

<section class="main-content">
	<div class="container-fluid">
		<div class="row">
			<main class="content">
				<h1><?php single_post_title(); ?></h1>
				<?php
					if ( have_posts() ) :
						/* Start the Loop */
						while ( have_posts() ) : the_post();

							get_template_part( 'template-parts/post/content-excerpt', get_post_format() );

						endwhile;

						the_posts_pagination( array(
							'prev_text' => '<button class="btn btn-primary">' . __( 'Previous page' ) . '</button>',
							'next_text' => '<button class="btn btn-primary">' . __( 'Next page' ) . '</button>',
							'before_page_number' => '<button class="meta-nav btn btn-primary">' . __( 'Page ' ),
							'after_page_number' => '</button>',
						) );

					else :

						get_template_part( 'template-parts/post/content', 'none' );

					endif;
				?>				
			</main>
			<!-- Sidebar -->
			<aside class="sidebar">
				<?php get_sidebar(); ?>
			</aside>
		</div> <!-- .row -->
	</div> <!-- .container-fluid -->
</section>

<?php get_footer();