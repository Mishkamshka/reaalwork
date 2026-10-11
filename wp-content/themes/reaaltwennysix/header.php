<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package reaal_for_reaal
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="stylesheet" rel="preconnect" href="https://use.typekit.net/lmb7iuw.css">



	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'reaaltwennysix' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="site-branding">
			<?php the_custom_logo();?>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				)
			);
			?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->


<?php if (is_front_page() || is_page('work')): ?>
	       <div class="switch-right">
         <div class="grid-switch">
             <div class="grid-switch-btn">
                 <div class="switch-on"><h5>List</h5></div>
                 <div class=""><h5>Grid</h5></div>
				 <div id="grid-switch-btn-bk"></div>
             </div>
         </div>
     </div>
<?php endif; ?>

		<div id="smooth-wrapper">
  <div id="smooth-content">
