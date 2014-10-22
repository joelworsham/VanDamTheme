<?php
get_header();
the_post();
?>

<?php get_template_part( 'inc/partials/home-action' ); ?>
<?php get_template_part( 'inc/partials/home-action-mobile' ); ?>

	<section id="home-content" class="body-content">
		<hr/>
		<?php the_content(); ?>
	</section>

<?php get_footer(); ?>