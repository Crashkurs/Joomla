<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionDynamicDropdown{
	var $formname;
	var $formid;
	var $details = array('title' => 'Dynamic Dropdown', 'tooltip' => 'Creates a dynamic dropdown.');
	var $group = array('id' => 'form_utilities', 'title' => 'Utilities');
	function load($clear){
		if($clear){
			$action_params = array(
				'target_dropdown_id' => '',
				'source_dropdown_id' => '',
				'enable_ajax' => 0,
				'ajax_event_name' => '',
				'action_label' => '',
				'content1' => '',
			);
		}
		return array('action_params' => $action_params);
	}
	
	function run($form, $actiondata){
		
	}	
}
?>