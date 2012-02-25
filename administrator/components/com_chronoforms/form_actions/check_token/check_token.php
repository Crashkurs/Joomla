<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionCheckToken{
	var $formname;
	var $formid;
	var $group = array('id' => 'form_security', 'title' => 'Security');
	var $events = array('success' => 0, 'fail' => 0);
	var $details = array('title' => 'Check Token', 'tooltip' => 'Check the security token');
	
	function run($form, $actiondata){
		$params = new JParameter($actiondata->params);
		if((!JRequest::checkToken())){
			$this->events['fail'] = 1;
		}else{
			$this->events['success'] = 1;
		}
	}
	
	function load($clear){
		if($clear){
			$action_params = array(
				
			);
		}
		return array('action_params' => $action_params);
	}
}
?>