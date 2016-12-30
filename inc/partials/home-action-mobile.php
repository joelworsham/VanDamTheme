<?php
global $home_icons;
?>

<section id="home-action-mobile">
	<div class="above">

		<p class="locations">
			Kalamazoo, Grand Rapids, South Haven
		</p>

		<a href="tel:+18004938673" class="button-alt">
			<div class="left">
				<span class="icon-phone"></span>
			</div>
			<div class="right">
				<?php echo get_bloginfo( 'description' ); ?><br/>
				1.800.493.8673
			</div>
		</a>
	</div>


	<ul class="home-icons row">
		<?php
		foreach ( $home_icons as $id ) :

			if ( $id !== 'information' ) {
				$link = get_option( "vd_icon_{$id}_link", false ) ? get_option( "vd_icon_{$id}_link" ) : false;
				$link = $link ? get_permalink( $link ) : '';
			} else {
				$link = '#home-content';
			}

			// Change phone to location on mobile
			$id = $id === 'phone' ? 'location' : $id;
			?>
			<li>
				<a href="<?php echo $link; ?>">
					<div class="container">
						<div class="color-fill icon-<?php echo $id; ?>"></div>
					</div>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</section>