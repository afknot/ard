<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ard
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-5RFJHG5');</script>
	<!-- End Google Tag Manager -->
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta property="author" content="https://www.ard.com" />
	<meta property="description" content="<?php if(get_field('description')){echo sanitize_text_field(get_field('description'));}else{echo sanitize_text_field(get_bloginfo('description'));} ?>" />
	<meta property="keywords" content="<?php if(get_field('keywords')){echo sanitize_text_field(get_field('keywords'));}else{echo sanitize_text_field(get_bloginfo('name'));} ?>" />
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="shortcut icon" href="<?php echo esc_url( home_url( '/' ) ); ?>/wp-content/themes/ard/favicon.ico" type="image/x-icon">
	<link rel="icon" href="<?php echo esc_url( home_url( '/' ) ); ?>/wp-content/themes/ard/favicon.ico" type="image/x-icon">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5RFJHG5"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'ard' ); ?></a>
<div id="nav-content-cols">
	<header id="masthead" class="site-header">

		<nav id="site-navigation" class="main-navigation">
		<div class="site-branding">
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		</div><!-- .site-branding -->
		<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu of "To Dos"', 'ard' ); ?></button>
			<?php
			wp_nav_menu( array(
				'theme_location' => 'menu-1',
				'menu_id'        => 'primary-menu',
			) );
			?>
		</nav><!-- #site-navigation -->

	</header><!-- #masthead -->

	<div id="content" class="site-content">
