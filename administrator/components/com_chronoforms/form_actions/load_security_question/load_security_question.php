<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionLoadSecurityQuestion{
	var $formname;
	var $formid;
	var $group = array('id' => 'form_security', 'title' => 'Security');
	var $details = array('title' => 'Load Security Question', 'tooltip' => 'Load a security question.');
	function run($form, $actiondata){
		$mainframe =& JFactory::getApplication();
		$session =& JFactory::getSession();
		$uri =& JFactory::getURI();
		$params = new JParameter($actiondata->params);
		//extract questions
		$q_as = explode("\n", $actiondata->content1);
		$rand = rand(0, count($q_as) - 1);
		$choosen = explode("=", $q_as[$rand]);
		//add a session prefix, useful if more than 1 form is opened by the same user
		$session_key_field = "";
		if((bool)$params->get('session_key', 1) === true){
			$session_key = $form->getSessionToken();
			$session->set("chrono_security_answers_".$session_key, explode(",", trim($choosen[1])), md5('chrono'));
			//$session_key_field = '<input type="hidden" alt="ghost" name="_cf_session_key_" value="'.$session_key.'" />';
		}else{
			$session->set("chrono_security_answers", explode(",", trim($choosen[1])), md5('chrono'));
			$session_key_field = "";
		}
		$form->form_details->content = str_replace('{chrono_security_question}', $session_key_field.trim($choosen[0]), $form->form_details->content);
	}
		
	function load($clear){
		if($clear){
			$action_params = array(
				'content1' => '',
				'enabled' => 1,
				'session_key' => 1
			);
		}
		return array('action_params' => $action_params);
	}
}
?>