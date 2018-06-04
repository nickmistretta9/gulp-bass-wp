<?php
/* The template for displaying standard pages */
get_header(); ?>

<section class="main-content">
	<div class="container-fluid">
		<div class="row">
			<main class="content">
				<?php
					while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/page/content', 'page' );

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
