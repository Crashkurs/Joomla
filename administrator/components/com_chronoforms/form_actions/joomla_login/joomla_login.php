<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionJoomlaLogin{
	var $formname;
	var $formid;
	var $group = array('id' => 'joomla_functions', 'title' => 'Joomla Functions');
	var $events = array('success' => 0, 'fail' => 0);
	var $details = array('title' => 'Joomla Login', 'tooltip' => 'Register some user to Joomla.');
	function run($form, $actiondata){
		$params = new JParameter($actiondata->params);
		$mainframe =& JFactory::getApplication();
		// Get required system objects
		JRequest::setVar('username', JRequest::getVar($params->get('username', '')));
		JRequest::setVar('password', JRequest::getVar($params->get('password', '')));
		
		$credentials = array();
		$credentials['username'] = JRequest::getVar('username');
		$credentials['password'] = JRequest::getVar('password');
		if($mainframe->login($credentials) === true){
			$this->events['success'] = 1;
			//redirect if so
			$redirect = $params->get('redirect_url', '');
			if(!empty($redirect)){
				$mainframe->redirect($redirect);
			}
		}else{
			$this->events['fail'] = 1;
			$form->validation_errors[] = 'Invalid username or password.';
			return false;
		}		
	}
	
	function load($clear){
		if($clear){
			$action_params = array(
				'username' => '',
				'password' => '',
				'redirect_url' => 'index.php'
			);
		}
		return array('action_params' => $action_params);
	}
}
?>