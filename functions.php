<?php

/**
 * Class VanDam
 *
 * The main class for all functionality of the theme.
 *
 * @package WordPress
 * @subpackage VanDam
 *
 * @since VanDam 0.1
 */
class VanDam {

	/**
	 * The current theme version.
	 *
	 * @since VanDam 0.1
	 */
	public $version = '0.1.1';

	/**
	 * Classes to go into the wrapper div.
	 *
	 * @since VanDam 0.1
	 *
	 */
	public $wrapper_classes = '';

	/**
	 * All necessary files to require.
	 *
	 * @since VanDam 0.1
	 */
	public $necessities = array(
		'scripts',
		'shortcodes',
		'home-icons',
		'admin/admin',
		'testimonials',
	);

	/**
	 * All files to load.
	 *
	 * @since VanDam 0.1
	 */
	public $files = array(
		'frontend' => array(
			'css' => array(
				'all' => array(
					array(
						'handle'   => 'vandam',
						'filename' => 'vandam.min'
					)
				),
			),
			'js'  => array(
				'all'    => array(
					array(
						'handle'   => 'vandam',
						'filename' => 'vandam.min',
						'deps'     => array( 'jquery', 'vandam-deps' ),
						'footer'   => true
					),
					array(
						'handle'   => 'vandam-deps',
						'filename' => 'vandam-deps.min',
						'footer'   => true
					),
					array(
						'handle'   => 'googlemaps',
						'external' => 'http://maps.google.com/maps/api/js?sensor=false',
						'deps'     => array( 'jquery' ),
					),
					array(
						'handle'   => 'vandam-googlemaps',
						'filename' => 'vandam-google.min',
						'deps'     => array( 'googlemaps' ),
						'footer'   => true,
					)
				),
				'mobile' => array()
			)
		),
		'backend'  => array(
			'css' => array(
				'all' => array(
					array(
						'handle'   => 'vandam-admin',
						'filename' => 'vandam-admin.min',
					)
				),
			),
			'js'  => array(
				'all' => array(
					array(
						'handle'   => 'vandam-admin',
						'filename' => 'vandam-admin.min',
						'deps'     => array( 'jquery' ),
						'footer'   => true,
					)
				),
			),
		),
	);

	/**
	 * The nav menus to register in WordPress.
	 *
	 * @since VanDam 0.1
	 */
	public $nav_menus = array(
		array(
			'ID'   => 'sidebar',
			'name' => 'Sidebar',
		),
	);

	/**
	 * All sidebars to register.
	 *
	 * @since VanDam 0.1
	 */
	public $sidebars = array(
		array(
			'name'        => 'Content Sidebar',
			'id'          => 'content-sidebar',
			'description' => 'Widgets here will show on the right of the content.',
		),
		array(
			'name'          => 'Footer',
			'id'            => 'footer',
			'description'   => 'The site footer.',
			'before_widget' => '',
			'after_widget'  => '',
		),
	);

	/**
	 * The global length of the excerpt.
	 *
	 * @since VanDam 0.1
	 */
	public $excerpt_length = 100;

	public static $path;

	/**
	 * The main construct function.
	 *
	 * @since VanDam 0.1
	 */
	function __construct() {

		$this->require_necessities();
		self::$path = plugin_dir_path( __FILE__ );

		add_filter( 'body_class', array( $this, 'body_classes' ) );

		add_action( 'init', array( $this, 'register_nav_menus' ) );

		add_action( 'init', array( $this, 'register_sidebars' ) );

		add_filter( 'excerpt_length', array( $this, 'custom_excerpt_length' ), 999 );

		add_action( 'wp_head', array( $this, 'remove_html_margin' ), 1 );

		add_action( 'wp_head', array( $this, 'favicon' ) );

		add_filter( 'vandam_enqueue_file', array( $this, 'googlemaps' ), 10, 2 );

		add_filter( 'img_caption_shortcode', array( $this, 'modify_image_captions' ), 10, 3 );

		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'html5' );
	}

	public function modify_image_captions( $null, $attr, $content ) {

		$atts = shortcode_atts( array(
			'id'	  => '',
			'align'	  => 'alignnone',
			'width'	  => '',
			'caption' => '',
			'class'   => '',
		), $attr, 'caption' );

		$atts['width'] = (int) $atts['width'];

		if ( $atts['width'] < 1 || empty( $atts['caption'] ) )
			return $content;

		if ( ! empty( $atts['id'] ) )
			$atts['id'] = 'id="' . esc_attr( $atts['id'] ) . '" ';

		$class = trim( 'wp-caption ' . $atts['align'] . ' ' . $atts['class'] );

		$caption_width = 10 + $atts['width'];

		$style = '';
		if ( $caption_width )
			$style = 'style="width: ' . (int) $caption_width . 'px" ';

		preg_match( '/title="(.*?)"/i', $content, $title );

		$html = '';
		$html .= "<div $atts[id] $style class='" . esc_attr( $class ) . "'>";
		$html .= do_shortcode( $content );
		$html .= '<div class="wp-caption-content">';
		$html .= '<div class="wp-caption-button icon-information"></div>';
		$html .= '<div class="wp-caption-text">';
		$html .= ! empty( $title ) ? "<h4>$title[1]</h4>" : '';
		$html .= "<p>$atts[caption]</p>";
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';

		return $html;
	}

	public function googlemaps( $use, $file ) {

		global $post;

		if ( strpos( $file['handle'], 'googlemaps' ) !== false &&
		     get_post_meta( $post->ID, '_wp_page_template', true ) !== 'templates/contact.php'
		) {
			return false;
		}

		return true;
	}

	public function remove_html_margin() {
		remove_action( 'wp_head', '_admin_bar_bump_cb' );
	}

	public function favicon() {
		echo '<link rel="apple-touch-icon" href="' . get_stylesheet_directory_uri() . '/assets/images/apple-touch-icon.png">';
		echo '<link rel="icon" type="image/png" href="' . get_stylesheet_directory_uri() . '/assets/images/favicon.ico" />';
	}

	/**
	 * Requires all files for the theme.
	 *
	 * @since VanDam 0.1
	 */
	private function require_necessities() {

		foreach ( $this->necessities as $file ) {
			require_once( get_template_directory() . '/inc/' . $file . '.php' );
		}
	}

	/**
	 * Adds all classes for the wrapper.
	 *
	 * @since VanDam 0.1
	 */
	public function body_classes( $body_classes ) {

		if ( is_page_template( 'inc/template-full-width.php' ) ) {
			$body_classes[] = 'full-width';
		}

		if ( is_page_template( 'inc/template-landing-page.php' ) ) {
			$body_classes[] = 'full-width';
			$body_classes[] = 'landing-page';
		}

		return $body_classes;
	}

	/**
	 * Registers all nav menus for the theme.
	 *
	 * @since VanDam 0.1
	 */
	public function register_nav_menus() {

		foreach ( $this->nav_menus as $menu ) {
			register_nav_menu( $menu['ID'], $menu['name'] );
		}
	}

	/**
	 * Registers all sidebars for the theme.
	 *
	 * @since VanDam 0.1
	 */
	public function register_sidebars() {

		foreach ( $this->sidebars as $sidebar_args ) {
			register_sidebar( $sidebar_args );
		}
	}

	/**
	 * Modifies the default excerpt length.
	 *
	 * @since VanDam 0.1
	 *
	 * @return int The new excerpt length.
	 */
	public function custom_excerpt_length() {

		return $this->excerpt_length;
	}
}

$VanDam = new VanDam();