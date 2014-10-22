<?php

/**
 * Class VanDam_Nav_Walker_Flyout
 *
 * Outputs the flyout nav menu for the sidebar.
 *
 * @since VanDam 0.1.0
 *
 * @package VanDam
 * @subpackage Sidebar
 */
class VanDam_Nav_Walker_Flyout extends Walker_Nav_Menu {

	function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {

		// Skip elements without children
		if ( ! isset( $children_elements[ $element->ID ] ) ) {
			return;
		}

		$output .= "<ul class='sub-menu-$element->ID left-off-canvas-menu flyout'>";

		foreach ( $children_elements[ $element->ID ] as $child ) {

			$output .= '<li>';
			$output .= '<a href="' . $child->url . '">';
			$output .= $child->title;
			$output .= '</a>';
			$output .= '</li>';
		}

		$output .= '</ul>';
	}
}

/**
 * Class VanDam_Nav_Walker
 *
 * Outputs the main nav menu in the sidebar.
 *
 * @since VanDam 0.1.0
 *
 * @package VanDam
 * @subpackage Sidebar
 */
class VanDam_Nav_Walker extends Walker_Nav_Menu {

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		if ( $depth === 0 && in_array( 'menu-item-has-children', $item->classes ) ) {
			add_filter( 'nav_menu_link_attributes', array( $this, 'remove_link_atts' ) );
		} else {
			remove_filter( 'nav_menu_link_attributes', array( $this, 'remove_link_atts' ) );
		}

		parent::start_el( $output, $item, $depth, $args, $id );
	}

	function remove_link_atts( $atts ) {

		unset( $atts['href'] );
		return $atts;
	}

	function add_data( $atts ) {

	}
}
?>

<nav id="site-nav">
	<?php
	wp_nav_menu( array(
		'theme_location' => 'sidebar',
		'container' => false,
		'walker' => new VanDam_Nav_Walker(),
	) );
	?>
</nav>