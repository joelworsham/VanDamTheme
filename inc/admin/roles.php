<?php

add_action( 'init', '_vd_roles_init' );

function _vd_roles_init() {

	global $wp_roles;

	if ( get_option( 'vd_roles_init', false ) ) {
		return;
	}

	$seo_caps = $wp_roles->roles['editor']['capabilities'];
	$seo_caps['manage_options'] = true;

	$admin_caps = $wp_roles->roles['administrator']['capabilities'];

	if ( add_role( 'seo_manager', 'SEO Manager', $seo_caps ) === null ) {
		return;
	}

	if ( add_role( 'site_admin', 'Site Administrator', $admin_caps ) === null ) {
		return;
	}

	update_option( 'vd_roles_init', true );
}