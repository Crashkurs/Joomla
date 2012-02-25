<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionDbRecordLoader{
	var $formname;
	var $formid;
	var $events = array('found' => 0, 'notfound' => 0, 'nodata' => 0);
	var $group = array('id' => 'db_operations', 'title' => 'DB Operations');
	var $details = array('title' => 'DB Record Loader', 'tooltip' => 'Load some record from the database based on some request data.');
	function run($form, $actiondata){
		$params = new JParameter($actiondata->params);
		$table_name = $params->get('table_name', '');
		if(!empty($table_name) && (trim($params->get('dbfield', '')) || trim($actiondata->content1))){
			$mainframe =& JFactory::getApplication();
			$database =& JFactory::getDBO();
			if(!isset($form->data[$params->get('request_param', '')])){
				$req_param = '';
			}else{
				$req_param = $form->data[$params->get('request_param', '')];
			}
			$where = trim($actiondata->content1) ? $this->_processWhere(trim($actiondata->content1), $form) : "`".$params->get('dbfield', '')."` = '".$req_param."'";
			//load the model_id
			$model_id_sub = preg_replace('/(?:^|_)(.?)/e', "strtoupper('$1')", $table_name);
			$model_id = $params->get('model_id', '');
			if(empty($model_id)){
				$model_id = $model_id_sub;
			}
			//add a copy of the qury to the debug
			$form->debug['db_record_loader'][] = "SELECT * FROM `".$table_name."` AS `".$model_id."` WHERE ".$where;
			//run the query
			$database->setQuery("SELECT * FROM `".$table_name."` AS `".$model_id."` WHERE ".$where);
			$data = $database->loadAssoc();
			if(!is_array($data)){
				$data = array();
			}
			
			//check array fields
			if(trim($params->get('array_fields_sets', '')) && trim($params->get('array_separators', ''))){
				$fields_sets = explode('-', trim($params->get('array_fields_sets', '')));
				$separators = explode('-', trim($params->get('array_separators', '')));
				foreach($fields_sets as $k1 => $fields_set){
					$fields_list = explode(',', $fields_set);
					foreach($fields_list as $k2 => $field){
						if(isset($data[$field])){
							$data[$field] = explode($separators[$k1], $data[$field]);
						}
					}
				}
			}
			
			if((int)$params->get('load_under_modelid', 1) == 1){
				$form->data[$model_id] = $data;
			}else{
				$form->data = array_merge($form->data, $data);
			}
			//check the result
			$request_val = $req_param;//JRequest::getVar($params->get('request_param', ''));
			if(!empty($data)){
				$this->events['found'] = 1;
			}else if(empty($request_val)){
				$this->events['nodata'] = 1;
			}else if(empty($data)){
				$this->events['notfound'] = 1;
			}else{
			
			}/*else{
				$this->events['found'] = 1;
			}*/
			
			//replace all the curly brackets strings
			if(isset($form->form_details->content)){
				if((int)$params->get('curly_replacer', 1)){
					$form->form_details->content = $form->curly_replacer($form->form_details->content, $form->data);
				}
				//load any form fields if this setting is enabled
				if((int)$params->get('load_fields', 1)){
					include_once(JPATH_SITE.DS.'components'.DS.'com_chronoforms'.DS.'libraries'.DS.'includes'.DS.'data_republish.php');
					$HTMLFormPostDataLoad = new HTMLFormPostDataLoad();
					$form->form_details->content = $HTMLFormPostDataLoad->load($form->form_details->content, $form->data);
				}
			}
		}
	}
	
	function _processWhere($code, $form){
		ob_start();
		eval("?>".$code);
		$code = ob_get_clean();
		return $code;
	}
	
	function load($clear){
		if($clear){
			$action_params = array(
				'dbfield' => '',
				'table_name' => '',
				'request_param' => '',
				'load_fields' => 1,
				'curly_replacer' => 1,
				'model_id' => '',
				'array_fields_sets' => '',
				'array_separators' => '',
				'load_under_modelid' => '',
				'content1' => ''
			);
		}
		return array('action_params' => $action_params);
	}
}
?>