<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionDataToSession{
	var $formname;
	var $formid;
	var $group = array('id' => 'session', 'title' => 'Session Data');
	var $details = array('title' => 'Data To Session', 'tooltip' => 'Save form data array into session.');
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
		if($session->has('_chronoform_data_'.$session_key, $session_ns)){
			$stored = $session->get('_chronoform_data_'.$session_key, array(), $session_ns);
			if(!empty($stored) && is_array($stored) && (int)$params->get('merge', 0) == 1){
				$session->set('_chronoform_data_'.$session_key, array_merge($stored, $form->data), $session_ns);
			}else{
				$session->set('_chronoform_data_'.$session_key, $form->data, $session_ns);
			}
		}else{
			$session->set('_chronoform_data_'.$session_key, $form->data, $session_ns);
		}
	}
	
	function load($clear){
		if($clear){
			$action_params = array(
				'namespace' => '',
				'key' => '',
				'merge' => 0
			);
		}
		return array('action_params' => $action_params);
	}
}
?>