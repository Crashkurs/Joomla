<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionCustomCode{
	var $formname;
	var $formid;
	var $details = array('title' => 'Custom Code', 'tooltip' => 'Run some custom code.');
	function run($form, $actiondata){
		$mainframe =& JFactory::getApplication();
		$params = new JParameter($actiondata->params);
		if($params->get('mode', 'controller') == 'controller'){
			$message = $actiondata->content1;
			eval('?>'.$message);
		}
	}
	
	function load($clear){
		if($clear){
			$action_params = array(
				'content1' => '',
				'action_label' => '',
				'mode' => 'controller'
			);
		}
		return array('action_params' => $action_params);
	}
}
?>