<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionAuthenticator{
	var $formname;
	var $formid;
	var $events = array('allowed' => 0, 'denied' => 0);
	var $group = array('id' => 'form_security', 'title' => 'Security');
	var $details = array('title' => 'Authenticator', 'tooltip' => 'Check the users permissions.');
	function run($form, $actiondata){
		$params = new JParameter($actiondata->params);
		$user =& JFactory::getUser();
		//check guests
		$guest = $params->get('guests', 1);
		if($user->guest && $guest){
			$this->events['allowed'] = 1;
			return true;
		}
		//check other groups
		if(trim($params->get('groups', ''))){
			$_groups = explode(',', trim($params->get('groups', '')));
			array_walk($_groups, 'trim');
			
			$int_groups = array();
			foreach($_groups as $_group){
				$int_groups[] = (int)$_group;
			}
			
			if(!empty($user->groups)){
				foreach($user->groups as $kg => $group){
					if(in_array($group, $int_groups)){
						$this->events['allowed'] = 1;
						return true;
					}
				}
			}
		}
		//all failed, set not allowed
		$this->events['denied'] = 1;
		return true;
	}
	
	function load($clear){
		if($clear){
			$action_params = array(
				'guests' => 1,
				'content1' => '',
				'groups' => ''
			);
		}
		return array('action_params' => $action_params);
	}
}
?>