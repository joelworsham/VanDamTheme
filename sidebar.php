<aside id="site-sidebar" class="left-off-canvas-menu">
	<div class="off-canvas-toggle-full-sidebar icon-newspaper"></div>

	<div class="left-border"></div>

	<?php get_template_part( 'inc/partials/sidebar/logo' ); ?>

	<?php get_template_part( 'inc/partials/sidebar/nav' ); ?>

	<?php get_template_part( 'inc/partials/sidebar/social' ); ?>

	<div class="secondary-logo">
		<img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/vk.png'; ?>" />
		<span class="tagline">
			<?php echo get_bloginfo( 'description' ); ?><br/>
			<span class="phone">1.800.493.8673</span>
		</span>
	</div>

</aside>