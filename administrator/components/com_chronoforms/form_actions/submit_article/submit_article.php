<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionSubmitArticle{
	var $formname;
	var $formid;
	var $group = array('id' => 'joomla_functions', 'title' => 'Joomla Functions');
	var $details = array('title' => 'Submit Article', 'tooltip' => 'Get the response from the 2CO payment processor.');
	
	function run($form, $actiondata){
		$params = new JParameter($actiondata->params);
		$mainframe =& JFactory::getApplication();
		//save the data to db
		$db_save_details = $actiondata;
		$db_save_details->type = 'db_save';
		//create params
		$db_save_details_params = new JParameter('');
		$db_save_details_params->set('table_name', $mainframe->getCfg('dbprefix').'content');
		$db_save_details_params->set('model_id', 'Article');
		$db_save_details->params = $db_save_details_params->toString();
		//set data		
		$user =& JFactory::getUser();
		$form->data['created_by'] = $user->id;
		$form->data['created'] = date("Y-m-d H:i:s");
		$form->data['catid'] = $params->get('catid', '');
		$form->data['sectionid'] = $params->get('sectionid', 0);
		$form->data['state'] = $params->get('state', 0);
		$form->data['title'] = $form->data[$params->get('title', '')];
		$form->data['fulltext'] = $form->data[$params->get('fulltext', '')];
		$form->data['introtext'] = isset($form->data[$params->get('introtext', '')]) ? $form->data[$params->get('introtext', '')] : '';
		$form->data['created_by_alias'] = $form->data[$params->get('created_by_alias', '')];
		//alias
		$form->data['alias'] = JFilterOutput::stringURLSafe($form->data['title']);
		
		$form->data['id'] = null;
		//$form->data['alias'] = null;
		
		$form->runAction($db_save_details);
	}
	
	function load($clear){
		if($clear){
			$action_params = array(
				'title' => '',
				'fulltext' => '',
				'introtext' => '',
				'created_by_alias' => '',
				'state' => 0,
				'catid' => 0,
				'sectionid' => 0
			);
		}
		return array('action_params' => $action_params);
	}
	
}
?>