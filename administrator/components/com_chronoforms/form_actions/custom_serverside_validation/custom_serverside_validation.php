<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionCustomServerSideValidation{
	var $formname;
	var $formid;
	var $events = array('success' => 0, 'fail' => 0);
	var $details = array('title' => 'Custom Server Side Validation', 'tooltip' => 'Run some custom server side validation code.');
	function run($form, $actiondata){
		$code = $actiondata->content1;
		$return = eval('?>'.$code);
		if($return === false){
			$this->events['fail'] = 1;
		}else{
			$this->events['success'] = 1;
		}
	}
	
	function load($clear){
		if($clear){
			$action_params = array(
				'content1' => ''
			);
		}
		return array('action_params' => $action_params);
	}
}
?>