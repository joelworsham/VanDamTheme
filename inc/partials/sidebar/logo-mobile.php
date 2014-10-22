<header id="site-logo-mobile" class="row">
	<div class="columns large-12">
		<?php
		if ( ! is_front_page() ) {
			echo '<a href="' . site_url() . '">';
		}
		?>
			<h1><img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/logo.png'; ?>" /></h1>
		<?php
		if ( ! is_home() ) {
			echo '</a>';
		}
		?>
	</div>
</header>