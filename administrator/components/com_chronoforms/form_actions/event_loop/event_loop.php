<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionEventLoop{
	var $formname;
	var $formid;
	var $details = array('title' => 'Event Loop', 'tooltip' => 'Load another event');
	function run($form, $actiondata){
		$events = unserialize(base64_decode($form->form_details->events_actions_map));
		$params = new JParameter($actiondata->params);
		$targetEvent = $params->get('target_event', '_form_actions_events_map[myform][events][load]');
		if(empty($targetEvent)){
			$targetEvent = '_form_actions_events_map[myform][events][load]';
		}
		$targetEvent = str_replace(array('_form_actions_events_map[', ']'), '', $targetEvent);
		$path = explode('[', $targetEvent);
		unset($path[0]);
		foreach($path as $k => $v){
			if($k == count($path)){
				break;
			}
			$events = $events[$v];
		}
		
		$form->_processEvents($path[count($path)], $events);
		if($params->get('quit_next', 1)){
			//halt any future scheduled actions processing (exit the main actions loop)
			$form->stop = true;
		}
	}
	
	function load($clear){
		if($clear){
			$action_params = array(
				'target_event' => '',
				'quit_next' => 1
			);
		}
		return array('action_params' => $action_params);
	}
}
?>