<?php
/* Template part for displaying page content in page.php */
?>

<?php the_title( '<h1>', '</h1>' ); ?>
<?php the_content(); ?>
<?php theme_edit_link( get_the_ID() ); ?>
