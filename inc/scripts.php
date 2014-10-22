<?php

/**
 * Class VanDam_Scripts
 *
 * Loads all files needed for the theme.
 *
 * @package WordPress
 * @subpackage VanDam
 *
 * @since VanDam 0.1
 */
class VanDam_Scripts extends VanDam {

	/**
	 * The main construct function.
	 *
	 * @since VanDam 0.1
	 */
	function __construct() {

		add_action( 'init', array( $this, 'register_files' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_frontend_files' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_backend_files' ) );
	}

	/**
	 * Registers all files for the the theme.
	 *
	 * @since VanDam 0.1
	 */
	public function register_files() {

		foreach ( $this->files['frontend'] as $type => $contexts ) {
			foreach ( $contexts as $context => $files ) {
				foreach ( $files as $file ) {
					if ( $type == 'css' ) {
						wp_register_style(
							$file['handle'],
							get_template_directory_uri() . '/assets/css/' . ( isset( $file['filename'] ) ? $file['filename'] : $file['handle'] ) . '.css',
							isset( $file['deps'] ) ? $file['deps'] : null,
							isset( $file['version'] ) ? $file['version'] : $this->version
						);
					} elseif ( $type == 'js' ) {
						wp_register_script(
							$file['handle'],
							get_template_directory_uri() . '/assets/js/' . ( isset( $file['filename'] ) ? $file['filename'] : $file['handle'] ) . '.js',
							isset( $file['deps'] ) ? $file['deps'] : null,
							isset( $file['version'] ) ? $file['version'] : $this->version,
							isset( $file['footer'] ) ? $file['footer'] : false
						);
					}
				}
			}
		}
	}

	/**
	 * Enqueues all of the files for the frontend of the theme.
	 *
	 * @since VanDam 0.1
	 */
	public function enqueue_frontend_files() {

		foreach ( $this->files['frontend'] as $type => $contexts ) {
			foreach ( $contexts as $context => $files ) {
				foreach ( $files as $file ) {
					if ( $context == 'mobile' && wp_is_mobile() || $context == 'all' ) {
						if ( $type == 'css' || $type == 'font' ) {
							wp_enqueue_style( $file['handle'] );
						} else {
							wp_enqueue_script( $file['handle'] );
						}
					}
				}
			}
		}

		$ajax_data = array(
			'ajaxurl' => admin_url( 'admin-ajax.php' )
		);

		wp_localize_script( 'ajax', 'ajax_data', $ajax_data );

		// Custom font(s)
		echo '<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700" rel="stylesheet" type="text/css">';
	}

	/**
	 * Enqueues all of the files for the backend of the theme.
	 *
	 * @since VanDam 0.1
	 */
	public function enqueue_backend_files() {

		foreach ( $this->files['backend'] as $types ) {
			foreach ( $types as $type => $files ) {
				foreach ( $files as $file ) {
					if ( $type == 'css' ) {
						wp_enqueue_style( $file['handle'] );
					} else {
						wp_enqueue_script( $file['handle'] );
					}
				}
			}
		}
	}
}

new VanDam_Scripts();