<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionShowStopper{
	var $formname;
	var $formid;
	var $details = array('title' => 'Show Stopper', 'tooltip' => 'Will halt any future actions/events.');
	function run($form, $actiondata){
		$form->stop = 1;
	}
	
	function load($clear){
		if($clear){
			$action_params = array();
		}
		return array('action_params' => $action_params);
	}
}
?>