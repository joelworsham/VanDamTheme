<?php
global $post;

$author_name = get_the_author_meta( 'display_name' );
$author_link = get_author_posts_url( $post->post_author );
?>
<article class="post-post">
	<header>
		<h2 class="post-title">
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h2>

		<div class="post-meta">
			<p>This was written by <a href="<?php echo $author_link; ?>"><?php echo $author_name; ?></a>
				on <?php the_date(); ?>
				in <?php the_category( ', ' ); ?><?php edit_post_link( ' | <span class="icon-pencil"></span> Edit This' ); ?>
		</div>
	</header>

	<div class="post-content">
		<?php the_excerpt(); ?>
	</div>
</article>