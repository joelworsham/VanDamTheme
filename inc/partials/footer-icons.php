<?php
$icons = array(
	array(
		'alt' => 'Grand Rapids, MI Water Damage Company, Esporta Logo Image  - VanDam & Krusinga Building And Restoration',
		'link' => 'http://esporta.ca/',
		'img' => 'esporta.png',
	),
	array(
		'alt' => 'Remodeling And Home Builders Association Logo Image - VanDam & Krusinga Building And Restoration',
		'link' => 'http://mygrhome.com/',
		'img' => 'hbaggr.png',
	),
	array(
		'alt' => 'Grand Rapids, MI Remodeling Company, Better Business Bureau Logo Image - VanDam & Krusinga Building And Restoration',
		'link' => 'http://bbb.org',
		'img' => 'bbb.png',
	),
	array(
		'alt' => 'Grand Rapids, MI Remodeling Company, HBA Of Western Michigan Logo Image - VanDam & Krusinga Building And Restoration',
		'link' => 'http://hbawest.com/',
		'img' => 'hbawm.png',
	),
	array(
		'alt' => 'Grand Rapids, MI Water Damage Restoration Company, IICRC Logo Image - VanDam & Krusinga Building And Restoration',
		'link' => 'http://iicrc.org/',
		'img' => 'iicrc.png',
	),
	array(
		'alt' => 'Grand Rapids, MI Remodeling Company, NARI Logo Image - VanDam & Krusinga Building And Restoration',
		'link' => 'http://nari.org/',
		'img' => 'nari.png',
	),
	array(
		'alt' => 'Grand Rapids, MI Fire Restoration Company, RIA Logo Image - VanDam & Krusinga Building And Restoration',
		'link' => 'http://restorationindustry.org/',
		'img' => 'ria.png',
	),
);

foreach ( $icons as $icon ) {
	?>
	<a href="<?php echo $icon['link']; ?>" class="footer-icon">
		<img src="<?php echo get_template_directory_uri() . "/assets/images/$icon[img]"; ?>"
		     alt="<?php echo $icon['alt']; ?>" />
	</a>
<?php
}
