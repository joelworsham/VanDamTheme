<footer id="site-footer" style="opacity: 0;"> <?php // for fadein ?>
	<?php dynamic_sidebar( 'footer' ); ?>

	<p>
		<?php get_template_part( 'inc/partials/footer-icons' ); ?>
	</p>

	<p>
		<a href="/sitemap">Sitemap</a> &bull; &copy; <?php echo date( 'Y' ); ?> VanDam & Krusinga | Website by <a href="http://realbigmarketing.com" rel="no-follow">Real Big Marketing</a>
	</p>
</footer>

<?php // Closing the #content section and .inner-wrap div?>
</section>

<?php // Closing the next .inner-wrap div ?>
</div>

<?php // Closing the #wrapper div ?>
</div>

<?php wp_footer(); ?>
<script>
	/* So since we can't change the words of the menu items without changing h1 names we have this script
	 * What you do if you create a page or change an h1 and don't want the menu item to change.
	 *  1) Add what you want the menu item to be in the $good_menu_items array.
	 *  2) Add what the H1 to the $not_good_menu_items array.
	 *  				a) the contains method is cas sensitve so use the case matching the html on the actual page
	 *  3) Check that it worked
	 *  4) You're All done.
	 */
	var bQuery = jQuery.noConflict();
	bQuery(document).ready(
		function(){
			var $good_menu_items = ["REMODELING & CONSTRUCTION",
																											"PROPERTY DAMAGE RESTORATION",
																											"WATER DAMAGE",
																											"MOLD",
																											"CONTACT US"];
			var $not_good_menu_items=[
																											"Remodeling in West Michigan",
																											"Property Damage Restoration",
																											"Water Damage Restoration in West Michigan",
																											"MOLD",
																											"Contact Us For West Michigan Building and Restoration"]
				for (var i = 0; i< $not_good_menu_items.length; i++) {
						var $live_menu_item = bQuery('#site-nav li a:contains('+ $not_good_menu_items[i] +')')
						bQuery($live_menu_item).text($good_menu_items[i])
		
					}
				
				
				}//end function inside of each


	);//ends ready*/
</script>
</body>
</html>