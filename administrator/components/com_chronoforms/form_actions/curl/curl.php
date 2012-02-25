<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionCurl{
	var $formname;
	var $formid;
	var $group = array('id' => 'curl', 'title' => 'CURL');
	var $details = array('title' => 'Curl', 'tooltip' => 'Submit form data to another URL using the CURL method.');
	function run($form, $actiondata){
		$mainframe =& JFactory::getApplication();
		$params = new JParameter($actiondata->params);
		if(function_exists('curl_init')){
            $form->debug['curl'][] = "CURL OK : the CURL function was found on this server.";
        }else{
			$form->debug['curl'][] = "CURL problem : the CURL function was not found on this server.";
			return;
		}
		
		if(!empty($actiondata->content1)){
			$list = explode("\n", trim($actiondata->content1));
			$curl_values = array();
			foreach($list as $item){
				$fields_data = explode("=", $item);
				$curl_values[$fields_data[0]] = $form->data[trim($fields_data[1])];
			}
		}
		$query = JURI::buildQuery($curl_values);

		$form->debug['curl'][] = '$curl_values: '.print_r($query, true);
		$form->debug['curl'][] = 'curl_target_url: '.$params->get('target_url');
		$ch = curl_init($params->get('target_url'));
		curl_setopt($ch, CURLOPT_HEADER, $params->get('header_in_response', 0));// set to 0 to eliminate header info from response
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);// Returns response data instead of TRUE(1)
		curl_setopt($ch, CURLOPT_POSTFIELDS, $query);// use HTTP POST to send form data
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		$response = curl_exec($ch);//execute post and get results
		curl_close($ch);
		
		//add the response in the form data array
		$form->data['curl'] = $response;
	}
	
	function load($clear){
		if($clear){
			$action_params = array(
				'header_in_response' => 0,
				'target_url' => 'http://',
				'content1' => ''
			);
		}
		return array('action_params' => $action_params);
	}
}
?>