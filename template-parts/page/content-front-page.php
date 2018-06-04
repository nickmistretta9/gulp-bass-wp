<?php
/* Displays content for front page */
?>

<div class="container-fluid">
	<div class="row">
		<main class="content" id="post-<?php the_ID(); ?>">
			<?php the_title( '<h1>', '</h1>' ); ?>
			<?php the_content(); ?>
			<?php theme_edit_link( get_the_ID() ); ?>
		</main>
	</div> <!-- .row -->
</div> <!-- .container-fluid -->