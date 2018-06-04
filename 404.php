<?php
/* The template for displaying 404 pages (not found) */
get_header(); ?>

<section class="main-content">
	<div class="container-fluid">
		<div class="row">
			<main class="col-sm-8 content">
				<h1>404 Error</h1>
				<?php get_search_form(); ?>
			</main>
			<!-- Sidebar -->
			<aside class="col-sm-4 sidebar">
				<?php get_sidebar(); ?>
			</aside>
		</div> <!-- .row -->
	</div> <!-- .container-fluid -->
</section>

<?php get_footer();