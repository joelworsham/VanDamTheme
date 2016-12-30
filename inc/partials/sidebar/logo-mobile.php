<header id="site-logo-mobile" class="row">
	<div class="columns large-12">
		<?php
		if ( ! is_front_page() ) {
			echo '<a href="' . home_Url() . '">';
		}
		?>
			<img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/logo.png'; ?>" alt="vandam and krusinga" />
		<?php
		if ( ! is_front_page() ) {
			echo '</a>';
		}
		?>
	</div>
</header>