<?php
/* The template for displaying all single posts */
get_header(); ?>

<section class="main-content">
	<div class="container-fluid">
		<div class="row">
			<main class="content">
				<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();
					get_template_part( 'template-parts/post/content' );
					the_post_navigation( array(
						'prev_text' => '<button class="btn btn-primary">' . __( 'Previous Post' ) . '</button>',
						'next_text' => '<button class="btn btn-primary">' . __( 'Next Post' ) . '</button>',
					));
				endwhile;
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
