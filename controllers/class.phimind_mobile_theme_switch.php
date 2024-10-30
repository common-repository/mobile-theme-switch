<?php 
	
	class phimind_mobile_theme_switch extends phimind_plugin_manager_0_2
	{

		var $debug_msg;

		function __construct()
		{
			require('config.php');

			parent::__construct();
			parent::init_configuration();
		}

		function index()
		{

			if (@$_REQUEST["form_submit"] == '1')
			{
				//UPDATE ALL RULES
				$rules = array();
				for ($i = 0 ; $i < count($_REQUEST["source"]) ; $i++)
				{
					if ($_REQUEST["theme"][$i] != '')
						$rules[] = array("source" => $_REQUEST["source"][$i], "device" => $_REQUEST["device"][$i], "os" => $_REQUEST["os"][$i], "browser" => $_REQUEST["browser"][$i], "theme" => $_REQUEST["theme"][$i]);
				}
				update_option('phimind_mobile_theme_switch_rules', $rules);

				//UPDATE THE ON/OFF FLAG
				update_option('phimind_mobile_theme_switch_switch_state', $_REQUEST["flag_on_off"]);

				//SETUP THE FLASH MESSAGE
				$this->set('flag_updated', 1);
			}

			//GET ALL THEMES REGISTERED WITHIN WP
			$themes = wp_get_themes();
			$this->set('themes', $themes);

			//GET ALL THE CURRENT RULES
			$rules = get_option('phimind_mobile_theme_switch_rules');
			$this->set('rules', $rules);

			//GET THE SWITCH ON/OFF FLAG
			$flag_on_off = get_option('phimind_mobile_theme_switch_switch_state');
			$this->set('flag_on_off', $flag_on_off);

			$mobile_detect_extension = new mobile_detect_extension();
			$this->set('phone_devices', $mobile_detect_extension->get_phone_devices());
			$this->set('tablet_devices', $mobile_detect_extension->get_tablet_devices());
			$this->set('operating_systems', $mobile_detect_extension->get_operating_systems());
			$this->set('user_agents', $mobile_detect_extension->get_user_agents());

			$this->render('index');
		}

		function process_theme($current_theme)
		{

			//GET ALL THE CURRENT RULES
			$rules = get_option('phimind_mobile_theme_switch_rules');

			//IF NO RULES ARE SET THEN USE THE CURRENT THEME
			if (empty($rules))
				return $current_theme;

			$target_theme = $current_theme;

			//INSTANCIATE THE EXTENSION CLASS TO GET ALL VALIDATIONS
			$mobile_detect_extension = new mobile_detect_extension();

			$msg = '';
			$msg .= 'Current Theme : <strong>'.$current_theme.'</strong><br>';

			foreach ($rules as $rule)
			{
				$rule_source = 0;
				$rule_device = 0;
				$rule_os = 0;
				$rule_browser = 0;

				$msg .= '<div class="rule_header">Checking rule</div>';
				
				if (!empty($rule["source"]))
					$msg .= '<div class="rule"> + Source : '.$rule["source"].'</div>';
				if (!empty($rule["device"]))
					$msg .= '<div class="rule"> + Device : '.$rule["device"].'</div>';
				if (!empty($rule["os"]))
					$msg .= '<div class="rule"> + OS : '.$rule["os"].'</div>';
				if (!empty($rule["browser"]))
					$msg .= '<div class="rule"> + Browser : '.$rule["browser"].'</div>';
				if (!empty($rule["theme"]))
					$msg .= '<div class="rule"> + Theme : '.$rule["theme"].'</div>';

				//SOURCE HAS TO BE MANAGED DIFFERENT
				//isMobile = True for Mobile AND Tablet
				if (!empty($rule["source"]))
				{
					if ($rule["source"] == "Mobile")
					{
						if ($mobile_detect_extension->isMobile() && !$mobile_detect_extension->isTablet())
						{
							$rule_source = 1;
							$msg .= 'Check if is'.$rule["source"].'() : true<br>';
						} else {
							$msg .= 'Check if is'.$rule["source"].'() : false<br>';
						}
					} elseif ($rule["source"] == "Tablet") {
						if ($mobile_detect_extension->isTablet())
						{
							$rule_source = 1;
							$msg .= 'Check if is'.$rule["source"].'() : true<br>';
						} else {
							$msg .= 'Check if is'.$rule["source"].'() : false<br>';
						}
					}

				} else {
					$rule_source = 1;
				}

				if (!empty($rule["device"]))
				{
					if ($mobile_detect_extension->{'is'.$rule["device"]}())
					{
						$rule_device = 1;
						$msg .= 'Check if true : '.'is'.$rule["device"].'()<br>';
					} else {
						$msg .= 'Check if is'.$rule["device"].'() : false<br>';
					}
				} else {
					$rule_device = 1;
				}

				if (!empty($rule["os"]))
				{
					if ($mobile_detect_extension->{'is'.$rule["os"]}())
					{
						$rule_os = 1;
						$msg .= 'Check if true : '.'is'.$rule["os"].'()<br>';
					} else {
						$msg .= 'Check if is'.$rule["os"].'() : false<br>';
					}
				} else {
					$rule_os = 1;
				}

				if (!empty($rule["browser"]))
				{
					if ($mobile_detect_extension->{'is'.$rule["browser"]}())
					{
						$rule_browser = 1;
						$msg .= 'Check if true : '.'is'.$rule["browser"].'()<br>';
					} else {
						$msg .= 'Check if is'.$rule["browser"].'() : false<br>';
					}
				} else {
					$rule_browser = 1;
				}

				if ($rule_source && $rule_device && $rule_os && $rule_browser)
				{
					$msg .= 'Valid Rule.<br>';
					$msg .= 'New theme : '.$rule["theme"].'<br>';
					$target_theme = $rule["theme"];
					break;
				} else {
					$msg .= '<div class="invalid_rule">Rule not valid.</div>';
				}

			}

			$msg .= '<br><br><strong>Theme To Be Used : '.$target_theme.'</strong>';

			if ($flag_debug || 1 == 1)
			{		
				$this->debug_msg = $msg;

				//SET THE ACTION FOR THE FOOTER
				add_action('shutdown', array($this, 'show_debug'));
			}

			return $target_theme;

		}

		function show_debug()
		{
			echo '<div id="mobile_theme_switch_debug_container">
				<div class="title">Mobile Theme Switch DEBUG</div>
				<div class="content">'.$this->debug_msg.'</div>
			</div>';
		}

	}

	class mobile_detect_extension extends Mobile_Detect
	{

		function get_phone_devices()
		{
			return $this->phoneDevices;
		}

		function get_tablet_devices()
		{
			return $this->tabletDevices;
		}

		function get_operating_systems()
		{
			return $this->operatingSystems;
		}

		function get_user_agents()
		{
			return $this->userAgents;
		}
		
	}

?>