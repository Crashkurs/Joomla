<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionAutoServerSideValidation{
	var $formname;
	var $formid;
	var $events = array('success' => 0, 'fail' => 0);
	var $details = array('title' => 'Auto Server Side Validation', 'tooltip' => 'Run some auto server side validation code.');
	function run($form, $actiondata){
		$params = new JParameter($actiondata->params);
		
		$rules = array('required', 'not_empty', 'empty', 'alpha', 'alphanumeric', 'digit', 'nodigit', 'number', 'email', 'phone', 'phone_inter', 'url');
		
		foreach($rules as $rule){
			$fields_string = trim($params->get($rule, ''));
			if(!empty($fields_string)){
				$fields = explode(",", $fields_string);
				foreach($fields as $field){
					$function = 'validate_'.$rule;
					$result = $this->$function(trim($field), $form);
					if(!$result){
						$this->events['fail'] = 1;
						if(!isset($form->validation_errors[trim($field)])){
							$form->validation_errors[trim($field)] = $params->get($rule.'_error');
						}else{
							if(is_array($form->validation_errors[trim($field)])){
								$form->validation_errors[trim($field)][] = $params->get($rule.'_error');
							}else{
								$form->validation_errors[trim($field)] = array($form->validation_errors[trim($field)], $params->get($rule.'_error'));
							}
						}
						//return false;
					}
				}
			}
		}
		
		if($this->events['fail'] == 0){
			$this->events['success'] = 1;
		}
	}
	
	function validate_required($str, $form){
		if(!isset($form->data[$str])){
			return false;
		}else{
			return true;
		}
	}
	
	function validate_not_empty($str, $form){
		if(isset($form->data[$str])){
			return preg_match('/[^.*]/', $form->data[$str]);
		}
	}
	
	function validate_empty($str, $form){
		if(isset($form->data[$str])){
			if(is_array($form->data[$str])){
				return !(bool)count($form->data[$str]);
			}else{
				return !(bool)strlen($form->data[$str]);
			}
		}
	}
	
	function validate_alpha($str, $form){
		if(isset($form->data[$str]) && strlen($form->data[$str]) > 0){
			return preg_match('/^[a-z ._-]+$/i', $form->data[$str]);
		}
		return true;
	}
	
	function validate_alphanumeric($str, $form){
		if(isset($form->data[$str]) && strlen($form->data[$str]) > 0){
			return preg_match('/^[a-z0-9 ._-]+$/i', $form->data[$str]);
		}
		return true;
	}
	
	function validate_digit($str, $form){
		if(isset($form->data[$str]) && strlen($form->data[$str]) > 0){
			return preg_match('/^[-+]?[0-9]+$/', $form->data[$str]);
		}
		return true;
	}
	
	function validate_nodigit($str, $form){
		if(isset($form->data[$str]) && strlen($form->data[$str]) > 0){
			return preg_match('/^[^0-9]+$/', $form->data[$str]);
		}
		return true;
	}
	
	function validate_number($str, $form){
		if(isset($form->data[$str]) && strlen($form->data[$str]) > 0){
			return preg_match('/^[-+]?\d*\.?\d+$/', $form->data[$str]);
		}
		return true;
	}
	
	function validate_email($str, $form){
		if(isset($form->data[$str]) && strlen($form->data[$str]) > 0){
			return preg_match('/^([a-zA-Z0-9_\.\-\+%])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/', $form->data[$str]);
		}
		return true;
	}
	
	function validate_phone($str, $form){
		if(isset($form->data[$str]) && strlen($form->data[$str]) > 0){
			return preg_match('/^\+{0,1}[0-9 \(\)\.\-]+$/', $form->data[$str]);
		}
		return true;
	}
	
	function validate_phone_inter($str, $form){
		if(isset($form->data[$str]) && strlen($form->data[$str]) > 0){
			return preg_match('/^\+{0,1}[0-9 \(\)\.\-]+$/', $form->data[$str]);
		}
		return true;
	}
	
	function validate_url($str, $form){
		if(isset($form->data[$str]) && strlen($form->data[$str]) > 0){
			return preg_match('/^(http|https|ftp)\:\/\/[a-z0-9\-\.]+\.[a-z]{2,3}(:[a-z0-9]*)?\/?([a-z0-9\-\._\?\,\'\/\\\+&amp;%\$#\=~])*$/i', $form->data[$str]);
		}
		return true;
	}
	
	function load($clear){
		if($clear){
			$action_params = array(
				'content1' => '',
				'required' => '',
				'not_empty' => '',
				'empty' => '',
				'alpha' => '',
				'alphanumeric' => '',
				'digit' => '',
				'nodigit' => '',
				'number' => '',
				'email' => '',
				'phone' => '',
				'phone_inter' => '',
				'url' => '',
				'required_error' => 'This field is required.',
				'not_empty_error' => 'This field should NOT be empty.',
				'empty_error' => 'This field should be empty.',
				'alpha_error' => 'This field should contain alphabetic characters only.',
				'alphanumeric_error' => 'This field should contain alphabetic characters or digits only.',
				'digit_error' => 'This field should contain digits only.',
				'nodigit_error' => 'This field should NOT contain any digits.',
				'number_error' => 'This field should contain a number.',
				'email_error' => 'This field should contain an email address.',
				'phone_error' => 'This field should contain a phone number.',
				'phone_inter_error' => 'This field should contain an international phone number.',
				'url_error' => 'This field should contain a URL.'
			);
		}
		return array('action_params' => $action_params);
	}
}
?>