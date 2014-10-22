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
		array(//			'name' => 'foundation_column'
		)
	);

	/**
	 * The main construct function.
	 *
	 * @since VanDam 0.1
	 */
	function __construct() {

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

new VanDam_Shortcodes();