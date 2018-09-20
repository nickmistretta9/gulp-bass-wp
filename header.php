<?php
/* Theme Header */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta name="robots" content="noindex, nofollow"> <!-- NO SEO - REMOVE BEFORE GOING LIVE -->
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="mobile-web-app-capable" content="yes" />
    <meta name="theme-color" content="#FFFFFF" /> 
    <!-- jQuery Library -->  
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Fontawesome CDN Link -->
    <script defer src="https://use.fontawesome.com/releases/v5.2.0/js/all.js"></script>
    <!-- WordPress Header Items -->
	<?php wp_head(); ?>
	<link type="text/css" rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/dev/css/main.css">
</head>

<body <?php body_class(); ?>>
<?php
    if( ! ini_get('date.timezone') ) {
        date_default_timezone_set('EST');
    }
?>
<header class="site-header">
	<div class="container-fluid">
		<div class="logo">
			<a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php bloginfo('template_directory'); ?>/dev/images/logo.png" alt=""></a>
		</div>
		<nav class="navbar navbar-expand-md">	
			<?php if ( has_nav_menu( 'primary' ) ) : ?>
	            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#main-nav"><i class="fa fa-bars"></i> Navigation</button>
		        <div class="collapse navbar-collapse" id="main-nav">
					<?php get_template_part( 'template-parts/navigation/navigation', 'main' ); ?>
				</div>
			<?php endif; ?>
		</nav>
	</div>
</header>