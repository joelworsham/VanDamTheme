<?php get_header(); ?>

	<div class="body-content row single-post">

		<?php get_template_part( 'inc/loops/page' ); ?>

		<?php comments_template(); ?>

	</div>

<?php get_footer(); ?>