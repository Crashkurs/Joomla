<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionEmailVerificationResponse{
	var $formname;
	var $formid;
	var $group = array('id' => 'email_verification', 'title' => 'Email Verification');
	var $events = array('success' => 0, 'fail' => 0);
	var $details = array('title' => 'Email Verification Response', 'tooltip' => 'Checks the verification link.');
	function run($form, $actiondata){
		$mainframe =& JFactory::getApplication();	
		$params = new JParameter($actiondata->params);
		//save the data to db
		if($_GET['action'] == 'verify'){
			if(isset($_GET['hash']) && !empty($_GET['hash'])){
				$database =& JFactory::getDBO();
				$database->setQuery("SELECT * FROM ".$params->get('table_name')." WHERE ".$params->get('verify_field')."='".JRequest::getVar('hash')."' AND ".$params->get('verification_status_field')."='0'");
				$record = $database->loadAssoc();
				if(!empty($record)){
					$this->events['success'] = 1;
					//check if the files array should be loaded as well
					if(trim($params->get('files_array_field', ''))){
						eval('?>'.'<?php $form->files = '.$record[trim($params->get('files_array_field'))].'; ?>');
					}
					unset($record[trim($params->get('files_array_field'))]);
					//load the data array with the record data
					$form->data = array_merge($form->data, $record);
					//update the db record as "verified"
					$database->setQuery("UPDATE ".$params->get('table_name')." SET ".$params->get('verification_status_field')."='1' WHERE ".$params->get('verify_field')."='".JRequest::getVar('hash')."'");
					if(!$database->query()){
						$form->debug[] = $row->getError();
					}
				}else{
					$this->events['fail'] = 1;
					$form->validation_errors['verification'] = $params->get('This record does NOT exist or has already been verified.');
				}
			}else{
				$this->events['fail'] = 1;
			}
		}
	}
	
	function load($clear){
		if($clear){
			$action_params = array(
				'table_name' => '',
				'verify_field' => '',
				'verification_status_field' => '',
				'files_array_field' => '',
				'verification_link_path' => ''
			);
		}
		return array('action_params' => $action_params);
	}
}
?>