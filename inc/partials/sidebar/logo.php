<header id="site-logo" class="row">
	<div class="columns large-12">
		<?php
		if ( ! is_front_page() ) {
			echo '<a href="' . home_url() . '">';
		}
		?>
		<img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/logo.png'; ?>" alt="Water Damage Restoration, Grand Rapids, MI, Company Logo Image - VanDam & Krusinga Building And Restoration" title="Water Damage Restoration, Grand Rapids, MI, Company Logo Image" />

		<?php
		if ( ! is_front_page() ) {
			echo '</a>';
		}
		?>

		<p class="address">
			Kalamazoo &bull; Grand Rapids &bull; South Haven
		</p>
	</div>
</header>
