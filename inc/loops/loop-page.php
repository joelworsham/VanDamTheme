<div class="body-content">
	<h1 class="page-title">
		<?php the_title(); ?>
		<?php edit_post_link( '<span class="icon-pencil"></span>'); ?>
	</h1>

	<?php the_post(); ?>

	<?php the_content(); ?>
</div>