<?php
global $home_icons;

$home_icons['location'] = $home_icons['phone'];
unset( $home_icons['phone'] );
?>

<section id="home-action-mobile">
	<div class="above">

		<p class="locations">
			Kalamazoo, Grand Rapids, South Haven
		</p>

		<a href="tel:+18004938763" class="button-alt">
			<div class="left">
				<span class="icon-phone"></span>
			</div>
			<div class="right">
				<?php echo get_bloginfo( 'description' ); ?><br/>
				1.800.493.8763
			</div>
		</a>
	</div>


	<ul class="home-icons row">
		<?php foreach ( $home_icons as $id => $icon ) : ?>
			<li>
				<a href="<?php echo $icon['link']; ?>">
					<div class="container">
						<div class="color-fill icon-<?php echo $id; ?>"></div>
					</div>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</section>