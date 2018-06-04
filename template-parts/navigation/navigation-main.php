<?php
/* Displays main navigation */
?>

<?php
   wp_nav_menu( array(
       'menu'              => 'Main Nav',
       'theme_location'    => 'primary',
       'depth'             => 2,
       'container'         => '',
       'container_class'   => '',
       'menu_class'        => 'navbar-nav',
       'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
       'walker'            => new wp_bootstrap_navwalker())
   );
?>