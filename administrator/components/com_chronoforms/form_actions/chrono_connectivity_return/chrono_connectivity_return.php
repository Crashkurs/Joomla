<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionChronoConnectivityReturn{
	var $formname;
	var $formid;
	var $details = array('title' => 'Chrono Connectivity Return', 'tooltip' => 'Return to the Connection listing page.');
	var $group = array('id' => 'x_chronoforms_apps', 'title' => 'ChronoForms Apps');
	
	function run($form, $actiondata){
		$mainframe =& JFactory::getApplication();
		$params = new JParameter($actiondata->params);
		$session_token = $form->getSessionToken();
		$session =& JFactory::getSession();
		if($session->has('chronoforms', md5('chrono'))){
			$session_data = $session->get('chronoforms', array(), md5('chrono'));
			if(isset($session_data['apps']['chrono_connectivity'][$session_token]['connection_name'][$actiondata->order])){
				$connection_name = $session_data['apps']['chrono_connectivity'][$session_token]['connection_name'][$actiondata->order];
				//purge old session data
				if((bool)$params->get('purge_old_data', 1) === true){
					unset($session_data['apps']['chrono_connectivity'][$session_token]);
					$session->set('chronoforms', $session_data, md5('chrono'));
				}				
				$mainframe->redirect("index.php?option=com_chronoconnectivity&chronoconnection=".$connection_name."&task=list_data");
			}
		}
	}
	
	function load($clear){
		if($clear){
			$action_params = array(
				'action' => '',
				'param_name' => '',
				'connection' => '',
				'purge_old_data' => 1,
			);
		}
		return array('action_params' => $action_params);
	}
}
?>