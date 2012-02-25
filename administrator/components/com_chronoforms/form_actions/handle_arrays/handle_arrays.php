<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionHandleArrays{
	var $formname;
	var $formid;
	var $details = array('title' => 'Handle Arrays', 'tooltip' => 'Concatenate any array values using some delimiter.');
	function run($form, $actiondata){
		$params = new JParameter($actiondata->params);
		$skipped = $params->get('skipped', '');
		if(!empty($skipped)){
			$skipped = explode(',', $skipped);
		}else{
			$skipped = array();
		}
		$form->data = $this->array_handler($form->data, $skipped, $params->get('delimiter', ","));
	}
	
	function array_handler($data = array(), $skipped = array(), $del = ","){
		foreach($data as $name => $value){
			if(is_array($value) && !in_array($name, $skipped)){
				$value = $this->array_handler($value, $skipped, $del);
				$data[$name] = implode($del, $value);
			}
		}
		return $data;
	}
	
	function load($clear){
		if($clear){
			$action_params = array(
				'delimiter' => ",",
				'skipped' => ''
			);
		}
		return array('action_params' => $action_params);
	}
}
?>