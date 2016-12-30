<?php
// FIXED Footer icons
// FIXED darken social icons and VK
// FIXED Look into caption title for images
// FIXED margin for images bigger
// FIXED Setup blog
// FIXED Revise contact page
// FIXED plugin for managing analytics
// FIXED footer not going to bottom properly

// Things todo after the site is launched on the new domain
// TODO Upload the KML files (currently in assets) (includes the xml file), then sync them with google webmaster tools
?>

<?php get_header(); ?>

	<div class="body-content row">

		<?php
		// The blog posts loop
		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();
				get_template_part( '/inc/loops/posts' );
			}
		}
		?>

	</div>

<?php get_footer(); ?>