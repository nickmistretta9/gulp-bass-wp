<?php
/* The sidebar containing the main widget area */

if ( ! is_active_sidebar( 'main-sidebar' ) ) {
	return;
}
?>

<?php dynamic_sidebar( 'main-sidebar' ); ?>
