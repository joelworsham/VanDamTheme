<?php global $VanDam; ?>

	<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<?php // Basic, needed html stuff ?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

		<?php // The page title ?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>

		<?php wp_head(); ?>
	</head>
<body <?php body_class();?>>

<div id="wrapper" class="off-canvas-wrap" data-offcanvas>

<?php get_template_part( 'inc/partials/mobile-header' ); ?>

	<div class="inner-wrap">

<?php get_sidebar(); ?>

<?php
wp_nav_menu( array(
	'theme_location' => 'sidebar',
	'walker'         => new VanDam_Nav_Walker_Flyout(),
	'container'      => false,
	'items_wrap'     => '%3$s',
) );
?>

	<section id="site-content" class="off-canvas-wrap" data-offcanvas>
	<div class="inner-wrap">

<?php get_template_part( 'inc/partials/sidebar/logo-mobile' ); ?>