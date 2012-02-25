<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionConfirmationPage{
	var $formname;
	var $formid;
	var $group = array('id' => 'form_utilities', 'title' => 'Utilities');
	var $events = array('confirm' => 0, 'back' => 0, 'show' => 0);
	var $details = array('title' => 'Confirmation Page', 'tooltip' => 'Show a confirmation page.');
	
	function run($form, $actiondata){
		$params = new JParameter($actiondata->params);
		if(isset($_POST['confirmation_page'])){
			if($_POST['confirmation_page'] == '_confirm'){
				$this->events['confirm'] = 1;
			}else if($_POST['confirmation_page'] == '_back'){
				$this->events['back'] = 1;
			}
		}else{
			//show confimration page event
			$this->events['show'] = 1;
		}
	}
	
	function load($clear){
		if($clear){
			$action_params = array(
				'buttons' => 1,
				'content1' => ''
			);
		}
		return array('action_params' => $action_params);
	}
}
?>