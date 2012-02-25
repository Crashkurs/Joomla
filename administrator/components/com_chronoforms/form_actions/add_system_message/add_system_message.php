<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionAddSystemMessage{
	var $formname;
	var $formid;
	var $details = array('title' => 'Add System Message', 'tooltip' => 'Add a system message of any type.');
	var $group = array('id' => 'form_utilities', 'title' => 'Utilities');
	
	function run($form, $actiondata){
		$mainframe =& JFactory::getApplication();
		$params = new JParameter($actiondata->params);
		switch($params->get('type', 'confirm')){			
			case "warning":
				JError::raiseWarning(100, $params->get('message', ''));
				break;
			case "notice":
				JError::raiseNotice(100, $params->get('message', ''));
				break;
			case "error":
				JError::raiseError(100, $params->get('message', ''));
				break;
			case "confirm":
				$mainframe->enqueueMessage($params->get('message', ''));
				break;
		}
	}
	
	function load($clear){
		if($clear){
			$action_params = array(
				'message' => '',
				'type' => 'confirm'
			);
		}
		return array('action_params' => $action_params);
	}
}
?>