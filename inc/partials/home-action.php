<?php
global $home_icons;
$home_icons = array(
	'hammer'  => array(
		'title'       => 'Remodeling & Construction',
		'link' => '/contact',
	),
	'fire'        => array(
		'title'       => 'Fire & Smoke Damage',
		'link' => '/contact',
	),
	'water'       => array(
		'title'       => 'Water Damage',
		'link' => '/contact',
	),
	'wind'        => array(
		'title'       => 'Wind & Storm Damage',
		'link' => '/contact',
	),
	'lightening'  => array(
		'title'       => 'Storm Damage',
		'link' => '/contact',
	),
	'mold'        => array(
		'title'       => 'Mold Damage',
		'link' => '/contact',
	),
	'information' => array(
		'title'       => 'More Information',
		'link' => '#home-content',
	),
	'phone'     => array(
		'title'       => 'Contact Us',
		'link' => '/contact',
	),
)
?>

<section id="home-action">
	<img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/house.jpg'; ?>"/>

	<?php foreach ( $home_icons as $id => $icon ) : ?>
		<div class="icon-<?php echo $id; ?>">
			<a href="<?php echo $icon['link']; ?>">
				<div class="color-fill">
					<div class="content">
						<?php echo $icon['title']; ?>
					</div>
				</div>
			</a>
		</div>
	<?php endforeach; ?>
</section>