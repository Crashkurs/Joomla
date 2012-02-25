<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionShowForm{
	var $formname;
	var $formid;
	var $group = array('id' => 'form_utilities', 'title' => 'Utilities');
	//var $events = array('confirm' => 0, 'back' => 0);
	var $details = array('title' => 'Show Form', 'tooltip' => 'Show a another form.');
	
	function run($form, $actiondata){
		$params = new JParameter($actiondata->params);
		//get the form name
		$formname = $params->get('form_name', '');
		if(!empty($formname)){
			$method = $params->get('action_taken', '');
			//get the event to load
			$event = $params->get('form_event', 'load');
			if(!trim($event)){
				$event = 'load';
			}
			//switch the showing method
			if($method == 'load'){
				$MyForm = CFChronoForm::getInstance($formname);				
				$MyForm->process($event);
				HTML_ChronoForms::processView($MyForm);
			}else{
				$mainframe =& JFactory::getApplication();
				$form_url = "index.php?option=com_chronoforms&amp;chronoform=".$formname."&amp;event=".$event;				
				$mainframe->redirect($form_url);
			}
		}
	}
	
	function load($clear){
		if($clear){
			$action_params = array(
				'action_taken' => 'load',
				'form_name' => '',
				'form_event' => ''
			);
		}
		return array('action_params' => $action_params);
	}
}
?>