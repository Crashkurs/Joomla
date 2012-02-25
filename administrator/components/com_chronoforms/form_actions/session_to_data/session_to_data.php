<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionSessionToData{
	var $formname;
	var $formid;
	var $group = array('id' => 'session', 'title' => 'Session Data');
	var $details = array('title' => 'Session To Data', 'tooltip' => 'Load the form data array values from session.');
	function run($form, $actiondata){
		$params = new JParameter($actiondata->params);
		$mainframe =& JFactory::getApplication();
		$session =& JFactory::getSession();
		$session_ns = $params->get('namespace', '');
		$session_key = $params->get('key', '');
		if(empty($session_key)){
			$session_key = $form->form_details->name;
		}
		if(empty($session_ns)){
			$session_ns = 'default';
		}
		$form->data = array_merge($form->data, $session->get('_chronoform_data_'.$session_key, array(), $session_ns));
		//clear the session if the clear option is set to yes
		if((int)$params->get('clear', 0) == 1){
			$session->clear('_chronoform_data_'.$session_key, $session_ns);
		}
	}
	
	function load($clear){
		if($clear){
			$action_params = array(
				'namespace' => '',
				'key' => '',
				'clear' => 0
			);
		}
		return array('action_params' => $action_params);
	}
}
?>