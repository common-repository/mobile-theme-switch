<?php 

	$_PHIMIND_CURRENT_CONFIG_VARS = array();

	$_PHIMIND_CURRENT_CONFIG_VARS["plugin_root"] = WP_PLUGIN_DIR.DS.'mobile-theme-switch';
	$_PHIMIND_CURRENT_CONFIG_VARS["plugin_root_web"] = WP_PLUGIN_URL.'/mobile-theme-switch';
	$_PHIMIND_CURRENT_CONFIG_VARS["plugin_menu_name"] = 'Mobile Theme Switch';
	$_PHIMIND_CURRENT_CONFIG_VARS["plugin_page_name"] = 'phimind_mts';
	$_PHIMIND_CURRENT_CONFIG_VARS["plugin_index_class_name"] = 'phimind_mobile_theme_switch';

	$plugin_js_files = array();
	$plugin_js_files[] = '/assets/css/bootstrap/js/bootstrap.min.js';
	$plugin_js_files[] = '/assets/js/global.js';
	$_PHIMIND_CURRENT_CONFIG_VARS["plugin_admin_js_files"] = $plugin_js_files;

	$plugin_css_files = array();
	$plugin_css_files[] = '/assets/css/bootstrap/css/bootstrap.min.css';
	$plugin_css_files[] = '/assets/css/global.css';
	$_PHIMIND_CURRENT_CONFIG_VARS["plugin_admin_css_files"] = $plugin_css_files;

	$plugin_css_frontend_files = array();
	$plugin_css_frontend_files[] = '/assets/css/global_frontend.css';
	$_PHIMIND_CURRENT_CONFIG_VARS["plugin_css_frontend_files"] = $plugin_css_frontend_files;
?>