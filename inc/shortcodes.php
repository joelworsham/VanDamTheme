<?php

/**
 * Class VanDam_Shortcodes
 *
 * All shortcodes for the theme.
 *
 * @package WordPress
 * @subpackage VanDam
 *
 * @since VanDam 0.1
 */
class VanDam_Shortcodes extends VanDam {

	/**
	 * All shortcodes to load.
	 *
	 * @since VanDam 0.1
	 */
	public $shortcodes = array(
		array(
			'name' => 'button',
			'callback' => 'button',
		),
		array(
			'name' => 'foundation_row',
			'callback' => 'foundation_row',
		),
		array(
			'name' => 'foundation_column',
			'callback' => 'foundation_column',
		)
	);

	/**
	 * The main construct function.
	 *
	 * @since VanDam 0.1
	 */
	function __construct() {

		if ( ! empty( $this->shortcodes ) ) {
			foreach ( $this->shortcodes as $shortcode ) {
				if ( ! isset( $shortcode['callback'] ) ) {
					$callback = $shortcode['name'];
				} else {
					$callback = $shortcode['callback'];
				}

				add_shortcode( $shortcode['name'], array( $this, $callback ) );
			}
		}
	}

	public function button( $atts, $content ) {

		$atts = shortcode_atts( array(
			'link' => '#',
		), $atts);

		return "<a href='$atts[link]' class='button'>$content</a>";
	}

	public function foundation_row( $atts, $content ) {
		return '<div class="row">' . do_shortcode( $content ) . '</div>';
	}

	public function foundation_column( $atts, $content ) {

		$atts = shortcode_atts( array(
			'small' => false,
			'medium' => false,
			'large' => false
		), $atts);

		$classes = array();

		foreach ( $atts as $size => $value ) {

			if ( $value ) {
				$classes[] = "$size-$value";
			}
		}

		$classes = implode( ' ', $classes );

		return "<div class='columns $classes'>" . do_shortcode( $content ) . '</div>';
	}
}

new VanDam_Shortcodes();