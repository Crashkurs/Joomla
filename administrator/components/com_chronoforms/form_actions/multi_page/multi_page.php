<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionMultiPage{
	var $formname;
	var $formid;
	var $details = array('title' => 'Multi Page', 'tooltip' => 'Handles Multi page form.');
	var $group = array('id' => 'form_utilities', 'title' => 'Utilities');
	function run($form, $actiondata){
		$params = new JParameter($actiondata->params);
		$session_key = $form->getSessionToken();
		//Data to Session config
		$data_to_session_details = new stdClass();
		$data_to_session_details->type = 'data_to_session';
		$data_to_session_Params = new JParameter('');
		$data_to_session_Params->set('merge', 1);
		if((bool)$params->get('session_key', 0) === true){
			$data_to_session_Params->set('key', $session_key);
		}
		$data_to_session_details->params = $data_to_session_Params->toString();
		$form->runAction($data_to_session_details);
		//Session to Data config
		$session_to_data_details = new stdClass();
		$session_to_data_details->type = 'session_to_data';
		$session_to_data_Params = new JParameter('');
		if((bool)$params->get('session_key', 0) === true){
			$session_to_data_Params->set('key', $session_key);
		}
		$session_to_data_details->params = $session_to_data_Params->toString();
		$form->runAction($session_to_data_details);
	}
	
	function load($clear){
		if($clear){
			$action_params = array(
				'show_navigation' => 0,
				'session_key' => 0
			);
		}
		return array('action_params' => $action_params);
	}
}
?>