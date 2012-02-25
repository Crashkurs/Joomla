<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionShowHtml{
	var $formname;
	var $formid;
	var $details = array('title' => 'Show HTML', 'tooltip' => 'Eval and show the form HTML code');
	function load($clear){
		if($clear){
			$action_params = array(
				'data_republish' => 1,
				'display_errors' => 1,
				'load_token' => 1,
				'keep_alive' => 0,
				'curly_replacer' => 0,
				'submit_event' => 'submit',
				'page_number' => '1'
			);
		}
		return array('action_params' => $action_params);
	}
	
	function run($form, $actiondata){
		$params = new JParameter($actiondata->params);
		/*if((int)$params->get('data_republish', 1)){
			include_once(JPATH_SITE.DS.'components'.DS.'com_chronoforms'.DS.'libraries'.DS.'includes'.DS.'data_republish.php');
			$HTMLFormPostDataLoad = new HTMLFormPostDataLoad();
			//$HTMLFormPostDataLoad->validation_errors = $form->validation_errors;
			if(isset($form->data['chrono_verification']) && !empty($form->data['chrono_verification'])){
				$form->data['chrono_verification'] = '';
			}
			$form->form_details->content = $HTMLFormPostDataLoad->load($form->form_details->content, $form->data);
		}
		if((int)$params->get('display_errors', 1)){
			include_once(JPATH_SITE.DS.'components'.DS.'com_chronoforms'.DS.'libraries'.DS.'includes'.DS.'display_errors.php');
			$HTMLFormPostDisplayErrors = new HTMLFormPostDisplayErrors();
			$HTMLFormPostDisplayErrors->validation_errors = $form->validation_errors;
			$form->form_details->content = $HTMLFormPostDisplayErrors->load($form->form_details->content, $form->data);
		}*/
	}	
}
?>