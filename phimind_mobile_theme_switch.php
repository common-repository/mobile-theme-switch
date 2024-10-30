<?php
	/*
	Plugin Name: Mobile Theme Switch
	Plugin URI: http://www.phimind.com/phimind_mobile_theme_switch
	Description: Mobile Theme Switch enables you to create rules determining which theme will be used on wich platform/version
	Version: 0.1
	Author: Yuri Salame
	Author URI: http://www.phimind.com/
	*/

	define('DS' , DIRECTORY_SEPARATOR);

	//CHECKS IF IT IS AN ADMIN PAGE TO INITIATE THE PLUGIN
	if (is_admin())
	{
		require_once('vendors'.DS.'MobileDetect'.DS.'Mobile_Detect.php');
		if (!class_exists('phimind_plugin_manager_0_2'))
			require_once('controllers'.DS.'class.phimind.php');
		require_once('controllers'.DS.'class.phimind_mobile_theme_switch.php');

		//INSTANTIATE THE PLUGIN CLASS
		$phimind_plugin_manager = new phimind_mobile_theme_switch();

		//TRIGGER AN AJAX METHOD WHEN CALLED
		if ($_REQUEST["action"] == "phimind_mobile_theme_switch_ajax_call")
		{
			$method = $_REQUEST["method"];
			if (@$_REQUEST["class"] != '')
				$class = new $_REQUEST["class"]();
			else
				$class = $phimind_plugin_manager;

			call_user_method($method, $class);
		}

	} else {

		//GET THE SWITCH ON/OFF FLAG
		$flag_on_off = get_option('phimind_mobile_theme_switch_switch_state');

		//CHECK TO SWITCH TO SEE IF THE PLUGIN WILL BE USED OR NOT
		if ($flag_on_off == 1)
		{
			require_once('vendors'.DS.'MobileDetect'.DS.'Mobile_Detect.php');
			if (!class_exists('phimind_plugin_manager_0_2'))
				require_once('controllers'.DS.'class.phimind.php');
			require_once('controllers'.DS.'class.phimind_mobile_theme_switch.php');

			//INSTANTIATE THE BASE CLASS AND TRIGGER THE INIT_CONFIGURATION METHOD
			$phimind_mobile_theme_switch = new phimind_mobile_theme_switch();

			//ADD HOOKS FOR FILTERING THE THEME NAME TO BE USED
			add_filter('template', array($phimind_mobile_theme_switch, 'process_theme'));
			add_filter('option_template', array($phimind_mobile_theme_switch, 'process_theme'));
			add_filter('option_stylesheet', array($phimind_mobile_theme_switch, 'process_theme'));
		}

	}

?>