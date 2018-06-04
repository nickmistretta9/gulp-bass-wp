<?php
/* The template for displaying the footer */
?>

<footer class="site-footer">
	<div class="container-fluid">
		<?php
			/* Get any template parts you may need to include here */
			// get_template_part( 'template-parts/footer/footer', 'widgets' );
		?>
	</div>
</footer>

<!-- build:js js/scripts.min.js -->
<script src="<?php bloginfo('template_directory'); ?>/dev/js/vendor/modernizr.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/dev/js/vendor/bootstrap.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/dev/js/vendor/jquery.validate.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/dev/js/vendor/jquery.matchHeight-min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/dev/js/vendor/nav.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/dev/js/vendor/slick.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/dev/js/vendor/jquery.magnific-popup.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/dev/js/vendor/aos.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/dev/js/main.js"></script>
<!-- endbuild -->
<!-- WordPress Footer Items -->
<?php wp_footer(); ?>

</body>
</html>
