<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionAutoJavascriptValidation{
	var $formname;
	var $formid;
	var $group = array('id' => 'form_utilities', 'title' => 'Utilities');
	var $details = array('title' => 'Auto JavaScript Validation', 'tooltip' => 'Auto add some JS validtaion class to specific fields.');
	function run($form, $actiondata){
				
	}
	
	function load($clear){
		if($clear){
			$action_params = array(
				'required' => '',
				'alpha' => '',
				'alphanum' => '',
				'digit' => '',
				'nodigit' => '',
				'number' => '',
				'email' => '',
				'phone' => '',
				'phone_inter' => '',
				'url' => '',
				'image' => ''
			);
		}
		return array('action_params' => $action_params);
	}
}
?>