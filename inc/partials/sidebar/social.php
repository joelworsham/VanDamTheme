<?php

$socials = array(
	array(
		'link'  => 'http://www.facebook.com/pages/VanDam-Krusinga-Building-Restoration/107367515977661',
		'title' => 'View our Facebook profile',
		'class' => 'facebook'
	),
	array(
		'link'  => 'http://www.linkedin.com/company/5185105?trk=tyah&trkInfo=tarId%3A1398700765599%2Ctas%3Avandam%2Cidx%3A2-2-7',
		'title' => 'View our Linkedin profile',
		'class' => 'linkedin'
	),
	array(
		'link'  => 'http://www.youtube.com/user/vandamandkrusinga?sub_confirmation=1',
		'title' => 'View our Youtube profile',
		'class' => 'youtube'
	),
	array(
		'link'  => 'https://plus.google.com/b/100273903509535045053/100273903509535045053/about',
		'title' => 'View our Google Plus profile',
		'class' => 'googleplus'
	)
);
?>

<ul id="site-social">
	<?php foreach ( $socials as $social ) : ?>
		<li class="social-<?php echo $social['class']; ?>">
			<a href="<?php echo $social['link']; ?>"
			   title="<?php echo $social['title']; ?>"
			   class="icon-<?php echo $social['class']; ?>"></a>
		</li>
	<?php endforeach; ?>
</ul>