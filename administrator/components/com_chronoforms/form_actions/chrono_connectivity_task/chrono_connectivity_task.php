<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionChronoConnectivityTask{
	var $formname;
	var $formid;
	var $details = array('title' => 'Chrono Connectivity Task', 'tooltip' => 'Run a Chrono Connectivity Task.');
	var $group = array('id' => 'x_chronoforms_apps', 'title' => 'ChronoForms Apps');
	var $events = array('success' => 0, 'fail' => 0);
	
	function run($form, $actiondata){
		$mainframe =& JFactory::getApplication();
		$params = new JParameter($actiondata->params);
		$session_token = $form->getSessionToken();
		$session =& JFactory::getSession();
		//$session->clear('chronoforms', md5('chrono'));
		if($session->has('chronoforms', md5('chrono'))){
			$session_data = $session->get('chronoforms', array(), md5('chrono'));
			print_r2($session_data);
			if(isset($session_data['apps']['chrono_connectivity'][$session_token]['connection_name'][$actiondata->order])){
				require_once(JPATH_SITE.DS.'components'.DS.'com_chronoconnectivity'.DS.'libraries'.DS.'chronoconnection.php');
				$task = $session_data['apps']['chrono_connectivity'][$session_token]['task'][$actiondata->order];
				$connection_name = $session_data['apps']['chrono_connectivity'][$session_token]['connection_name'][$actiondata->order];
				$data = $session_data['apps']['chrono_connectivity'][$session_token]['data'][$actiondata->order];
				$return = true;
				$MyConnection =& CFChronoConnection::getInstance($connection_name);
				switch($task){
					case 'delete_data':
						//delete records code here
						$return = $MyConnection->delete_record_data($data);
						break;
					case 'save_data':
						//delete records code here
						$return = $MyConnection->save_action($data);
						break;
					case 'edit_data':
						//delete records code here
						$row_data = $MyConnection->load_record_data($data);
						$form->data = array_merge($row_data, $form->data);
						//update the form code
						$form = $MyConnection->updateChronoForm($form);
						//set the save data settings
						$MyConnection->process_data('save', array('data' => array()), false);						
						break;
					case 'binary_data':
						//binary records code here
						$field_name = $session_data['apps']['chrono_connectivity'][$session_token]['field_name'][$actiondata->order];
						$return = $MyConnection->binary_record_data($field_name, $data);
						break;
					case 'list_data':
					default:
						//list records code here
						$actiondata->content1 = $MyConnection->get_list_output();
						break;
				}
				//check events
				if($return === true){
					$this->events['success'] = 1;
				}else{
					$this->events['fail'] = 1;
					if(is_string($return)){
						if((bool)$params->get('show_returned_errors', 0) === true){
							$form->validation_errors[] = $return;
						}else{
							$form->validation_errors[] = $params->get('error_message', '');
							$form->debug['Chrono Connectivity Task'][$actiondata->order] = $return;
						}
					}
				}
			}else{
				$this->events['fail'] = 1;
				if((bool)$params->get('show_returned_errors', 0) === true){
					$form->validation_errors[] = "Error occurred, session data couldn't be found.";
				}else{
					$form->validation_errors[] = $params->get('error_message', '');
					$form->debug['Chrono Connectivity Task'][$actiondata->order] = "Error occurred, session data couldn't be found.";
				}
			}
			//purge old session data
			if((bool)$params->get('purge_old_data', 1) === true){
				$session_lifetime = (int)$params->get('purge_data_lifetime', 15) * 60;
				foreach($session_data['apps']['chrono_connectivity'] as $token => $form_data){
					if(isset($form_data['started'][$actiondata->order])){
						$data_expiry = $form_data['started'][$actiondata->order] + $session_lifetime;
						if($data_expiry <= time()){
							unset($session_data['apps']['chrono_connectivity'][$token]);
						}
					}
				}
				$session->set('chronoforms', $session_data, md5('chrono'));
			}
		}
	}
	
	function load($clear){
		if($clear){
			$action_params = array(
				'action' => '',
				'param_name' => '',
				'connection' => '',
				'error_message' => 'An error has occurred.',
				'show_returned_errors' => 0,
				'purge_old_data' => 1,
				'purge_data_lifetime' => 15
			);
		}
		return array('action_params' => $action_params);
	}
}
?>