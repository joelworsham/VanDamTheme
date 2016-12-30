<?php

class VanDam_Admin extends VanDam {

	private $settings = array();

	function __construct() {

		global $home_icons;

		require_once( get_template_directory() . '/inc/admin/roles.php' );

		add_action( 'load-post.php', array( $this, 'contact_page_template_meta_boxes' ) );
		add_action( 'load-post-new.php', array( $this, 'contact_page_template_meta_boxes' ) );

		add_action( 'admin_menu', array( $this, 'admin_menu' ) );

		add_action( 'admin_init', array( $this, 'register_settings' ) );

		// Establish icon settings
		foreach ( $home_icons as $id ) {

			$this->settings[] = array(
				'group' => 'vd_home_icons',
				'name'  => "vd_icon_{$id}_heading",
			);

			$this->settings[] = array(
				'group' => 'vd_home_icons',
				'name'  => "vd_icon_{$id}_body",
			);

			$this->settings[] = array(
				'group' => 'vd_home_icons',
				'name'  => "vd_icon_{$id}_link",
			);
		}
	}

	public function contact_page_template_meta_boxes() {
		include_once( self::$path . '/inc/admin/contact-page-template.php' );
	}

	public function admin_menu() {

		add_menu_page(
			'Theme Options',
			'Theme Options',
			'edit_posts',
			'theme-options',
			'_vandam_theme_options_output',
			'dashicons-admin-generic',
			81
		);

		include_once( 'theme-options.php' );
	}

	public function register_settings() {

		foreach ( $this->settings as $setting ) {
			register_setting( $setting['group'], $setting['name'] );
		}
	}
}

new VanDam_Admin();