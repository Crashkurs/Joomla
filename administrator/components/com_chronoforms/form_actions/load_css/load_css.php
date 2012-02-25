<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionLoadCss{
	var $formname;
	var $formid;
	var $details = array('title' => 'Load CSS', 'tooltip' => 'Eval and load the CSS code');
	function load($clear){
		if($clear){
			$action_params = array('content1' => '');
		}
		return array('action_params' => $action_params);
	}
	
	function run($form, $actiondata){
		
	}	
}
?>