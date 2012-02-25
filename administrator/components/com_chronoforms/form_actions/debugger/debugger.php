<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionDebugger{
	var $formname;
	var $formid;
	var $details = array('title' => 'Debugger', 'tooltip' => 'Display the form debug data.');
	function run($form, $actiondata){
		echo "Data Array: <br />";
		print_r2($form->data);
	}
	
	function load($clear){
		if($clear){
			$action_params = array(
				'reset_after_display' => 0
			);
		}
		return array('action_params' => $action_params);
	}
}
?>