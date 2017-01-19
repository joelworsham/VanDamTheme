<?php
get_header();
the_post();
?>

<?php get_template_part( 'inc/partials/home-action' ); ?>
<?php get_template_part( 'inc/partials/home-action-mobile' ); ?>

	<section id="home-widgets">
		<ul class="home-widgets-list">
			<?php dynamic_sidebar( 'home' ); ?>
		</ul>
	</section>

	<section id="home-content" class="body-content">

		<div class="page-content columns small-12 large-9">
			<?php the_content(); ?>
		</div>

		<?php get_template_part( 'inc/partials/sidebar/content-sidebar' ); ?>

	</section>

<?php get_footer(); ?>