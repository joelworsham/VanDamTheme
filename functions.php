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
		'shortcodes'
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
						'handle'   => 'frontend-main',
						'filename' => 'frontend.main.min'
					)
				),
			),
			'js'  => array(
				'all' => array(
					array(
						'handle'   => 'frontend-main',
						'filename' => 'frontend.main.min',
						'deps'     => array( 'jquery', 'frontend-deps' ),
						'footer'   => true
					),
					array(
						'handle'   => 'frontend-deps',
						'filename' => 'frontend.deps.min',
						null,
						'footer'   => true
					)
				),
				'mobile' => array(

				)
			)
		),
		'backend'  => array(
			'css' => array(),
			'js'  => array()
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
			'name' => 'Main Sidebar',
			'id' => 'main-sidebar',
			'description' => 'Widgets here will show on the left, under the menu icon.',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		)
	);

	/**
	 * The global length of the excerpt.
	 *
	 * @since VanDam 0.1
	 */
	public $excerpt_length = 100;

	/**
	 * The main construct function.
	 *
	 * @since VanDam 0.1
	 */
	function __construct() {

		$this->require_necessities();

		add_filter( 'body_class', array( $this, 'body_classes' ) );

		add_action( 'init', array( $this, 'register_nav_menus' ) );

		add_action( 'init', array( $this, 'register_sidebars' ) );

		add_filter( 'excerpt_length', array( $this, 'custom_excerpt_length' ), 999 );

		add_action( 'wp_head', array( $this, 'remove_html_margin' ), 1 );

		add_theme_support( 'post-thumbnails' );
	}

	public function remove_html_margin() {
		remove_action( 'wp_head', '_admin_bar_bump_cb' );
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