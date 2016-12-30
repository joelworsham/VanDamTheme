<?php the_post(); ?>

<div class="page-content columns small-12 large-9">

	<div class="service-image">
		<?php the_post_thumbnail( 'full' ); ?>
	</div>

	<h1 class="page-title">
		<?php the_title(); ?>
		<?php edit_post_link( '<span class="icon-pencil"></span>' ); ?>
	</h1>

	<?php the_content(); ?>

</div>

<?php get_template_part( 'inc/partials/sidebar/content-sidebar' ); ?>
