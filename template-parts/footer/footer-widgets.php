<?php
/* Displays footer widgets if assigned */
?>

<?php
	if ( is_active_sidebar( 'footer-left' ) || is_active_sidebar( 'footer-center' ) ) :
?>

<!-- Uncomment and enter layout HTML to display widgets here -->
<!-- <div class="row">
	<?php
	if ( is_active_sidebar( 'footer-left' ) ) { ?>
		<div class="footer-widget-1">
			<?php dynamic_sidebar( 'footer-left' ); ?>
		</div>
	<?php }
	if ( is_active_sidebar( 'footer-center' ) ) { ?>
		<div class="footer-widget-2">
			<?php dynamic_sidebar( 'footer-center' ); ?>
		</div>
	<?php } ?>	
</div> -->

<?php endif; ?>
