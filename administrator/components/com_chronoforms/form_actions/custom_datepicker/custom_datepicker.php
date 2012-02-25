<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionCustomDatepicker{
	var $formname;
	var $formid;
	var $details = array('title' => 'Custom Datepicker', 'tooltip' => 'Load a custom Datepicker class.');
	var $group = array('id' => 'form_utilities', 'title' => 'Utilities');
	function load($clear){
		if($clear){
			$action_params = array(
				'field_class' => '',
				'pickerClass' => 'datepicker_dashboard',
				'format' => 'd-m-Y H:i:s',
				'inputOutputFormat' => 'Y-m-d H:i:s',
				'allowEmpty' => 1,
				'timePicker' => 1,
				'timePickerOnly' => 0,
				'content1' => '',
			);
		}
		return array('action_params' => $action_params);
	}
	
	function run($form, $actiondata){
		
	}	
}
?>