<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionAutocompleteProcessor{
	var $formname;
	var $formid;
	var $details = array('title' => 'Autocomplete Processor', 'tooltip' => 'Process the auto complete request for some field and send back the results.');
	var $group = array('id' => 'form_utilities', 'title' => 'Utilities');
	function load($clear){
		if($clear){
			$action_params = array(
				'table_name' => '',
				'field_name' => '',
				'minLength' => 3,
				'maxChoices' => 10,
				'maxLength' => 50,
				'content1' => '',
				'column_name' => ''
			);
		}
		return array('action_params' => $action_params);
	}
	
	function run($form, $actiondata){
		$params = new JParameter($actiondata->params);
		$mainframe =& JFactory::getApplication();
		//settings, vars
		$min = $params->get('minLength', 3);
		$max = $params->get('maxLength', 50);
		$choices = $params->get('maxChoices', 10);
		$search = (string)$form->data[$params->get('field_name', 'search')];
		$result = array();

		//quick validation
		if(strlen($search) >= $min && strlen($search) <= $max && $params->get('table_name', '') && $params->get('column_name', '')){
			$database =& JFactory::getDBO();
			if(strpos($params->get('column_name', ''), ",") !== false){
				$fields = explode(",", $params->get('column_name', ''));
				$where = array();
				foreach($fields as $field){
					$where[] = "`".trim($field)."` LIKE '%".$search."%'";
				}
				$where = implode(" OR ", $where);
			}else{
				$fields = array($params->get('column_name', ''));
				$where = "`".$params->get('column_name', '')."` LIKE '%".$search."%'";
			}
			//echo "SELECT DISTINCT * FROM `".$params->get('table_name', '')."` WHERE ".$where." LIMIT ".$choices;
			$database->setQuery("SELECT DISTINCT ".$params->get('column_name', '*')." FROM `".$params->get('table_name', '')."` WHERE ".$where." LIMIT ".$choices);
			$data = $database->loadAssocList();
			if(!is_array($data)){
				$form->data['_PLUGINS_']['autocomplete_processor']['data'] = $form->data['_PLUGINS_']['autocomplete_processor']['result'] = $result = $data = array();
			}else{
				$form->data['_PLUGINS_']['autocomplete_processor']['data'] = $data;
				foreach($fields as $field){
					foreach($data as $elem){
						$result[] = $elem[$field];
					}
				}
				$form->data['_PLUGINS_']['autocomplete_processor']['result'] = $result;
			}
			//allow custom data control
			$custom = $actiondata->content1;
			eval('?>'.$custom);
			//sleep(4); // delay if you want

			//push the JSON out
			header('Content-type: application/json');
			echo json_encode($form->data['_PLUGINS_']['autocomplete_processor']['result']);
			$mainframe->close();
		}else{
			$form->data['_PLUGINS_']['autocomplete_processor']['result'] = array();
			//push the JSON out
			header('Content-type: application/json');
			echo json_encode($form->data['_PLUGINS_']['autocomplete_processor']['result']);
			$mainframe->close();
		}
	}	
}
?>