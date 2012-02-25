<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
defined('_JEXEC') or die('Restricted access');
jimport('joomla.html.parameter');
//multi purpose function
if(!function_exists('print_r2')){
	function print_r2($array = array()){
		echo '<pre>';
		print_r($array);
		echo '</pre>';
	}
}

class CFChronoForm extends JObject{
	var $form_details;
	var $form_name;
	var $form_params;
	var $form_actions = array();
	var $form_actions_data = array();
	var $form_output = '';
	var $main_event_actions = array();
	var $validation_errors = array();
	var $data = array();
	var $debug = array();
	var $files = array();
	var $stop = false;
	var $loaded_validation = false;
	var $admin = false;
	var $session_token = null;
	var $extra_content = '';
	
	function __construct($formname = ''){
		if(!empty($formname)){
			if((strpos($formname, "_virtual_form_") !== false) && (strpos($formname, "_virtual_form_") == 0)){
				$this->getVForm($formname);
			}
			$this->getForm($this->_cleanName($formname));
		}else{
			die('Form name can NOT be empty!');
		}
	}
	
	function &getInstance($formname = '', $reset = false){
		static $instances;
		$mainframe =& JFactory::getApplication();
		if(!isset($instances)){
			$instances = array();
		}
		if(empty($instances[trim($formname)]) || $reset){
			$instances[trim($formname)] = new CFChronoForm($formname);
			return $instances[trim($formname)];
		}else{
			return $instances[trim($formname)];
		}
	}
	
	function getForm($formname){
		$mainframe =& JFactory::getApplication();
		$database =& JFactory::getDBO();
		$query = "SELECT * FROM `#__chronoforms` WHERE `name` = '".$formname."' AND `published` = '1'";
		$database->setQuery($query);
		$form = $database->loadObject();
		
		if(!empty($form)){
			$this->form_details = $form;
			$this->form_name = $form->name;
			//load params
			$this->form_params = new JParameter($form->params);	
			//load actions
			$query = "SELECT * FROM `#__chronoform_actions` WHERE `chronoform_id` = '".$form->id."' ORDER BY `order`";
			$database->setQuery($query);
			$this->form_actions = $database->loadObjectList();
			return true;
		}else{
			$this->form_details = new stdClass();
			$this->form_name = '';//$formname;
			$this->form_params = new JParameter('');
			return false;
		}
	}
	
	function getVForm($fid){
		$this->form_details = new stdClass();
		$this->form_name = $fid;
		$this->form_params = new JParameter('');
		return $this;
	}
	//get action data
	function get($action_id, $param_name){
		if(isset($this->form_actions_data['cfaction_'.$action_id])){
			$v = $this->form_actions_data['cfaction_'.$action_id];
			if(isset($v->$param_name)){
				//we need to get the data of a main element
				return $v->$param_name;
			}else{
				//we need to get a param value
				$params = new JParameter($v->params);
				return $params->get($param_name, '');
			}
		}else{
			
		}
	}
	
	//set action data
	function set($action_id, $param_name, $param_value){
		if(isset($this->form_actions_data) && !empty($this->form_actions_data)){
			if(isset($this->form_actions_data['cfaction_'.$action_id])){
				$v = $this->form_actions_data['cfaction_'.$action_id];
				if(isset($v->$param_name)){
					//we need to get the data of a main element
					$v->$param_name = $param_value;
					return true;
				}else{
					//we need to get a param value
					$params = new JParameter($v->params);
					$params->set($param_name, $param_value);
					$v->params = $params->toString();
					return true;
				}
			}else{
				return false;
			}
		}else if(isset($this->form_actions) && !empty($this->form_actions)){
			$action_id_pcs = explode("_", $action_id);
			$id = $action_id_pcs[count($action_id_pcs) - 1];
			foreach($this->form_actions as $v){
				if($v->order == $id){
					if(isset($v->$param_name)){
						//we need to get the data of a main element
						$v->$param_name = $param_value;
						return true;
					}else{
						//we need to get a param value
						$params = new JParameter($v->params);
						$params->set($param_name, $param_value);
						$v->params = $params->toString();
						return true;
					}
				}
			}
			return false;
		}else{
			return false;
		}
	}
	
	function process($event = null){
		$return = true;
		if($event && !empty($this->form_name)){
			//set the form data
			if(isset($_POST) && !empty($_POST)){
				$this->data = JRequest::get('post', JREQUEST_ALLOWRAW);
			}
			if(isset($_GET) && !empty($_GET)){
				$this->data = array_merge($this->data, JRequest::get('get', JREQUEST_ALLOWRAW));
			}
			//process the event
			$events = unserialize(base64_decode($this->form_details->events_actions_map));
			//print_r2($events);
			$actionsArray = array();
    		if(isset($this->form_actions) && !empty($this->form_actions)){
    			foreach($this->form_actions as $action_index => $action_data){
    				$actionsArray['cfaction_'.$action_data->type.'_'.$action_data->order] = $action_data;
    			}
    		}
			$this->form_actions_data = $actionsArray;
			//print_r2($this->form_actions_data);
			$return = $this->_processEvents($event, $events['events']);
			//for the val
			$object = new stdClass();
			$object->type = 'show_val';
			$object->enabled = 1;
			$object->required = 1;
			$object->content1 = $this->__checkVal();
			$this->main_event_actions[] = $object;
		}
		return $return;
	}
	
	function _processEvents($currentEvent, $events = null){
		$return = true;
		if(is_array($events) && isset($events[$currentEvent])){
			$event_value = $events[$currentEvent];
			if(isset($event_value['actions']) && is_array($event_value['actions'])){
				$event_actions = $event_value['actions'];
				foreach($event_actions as $action => $action_data){
					if(!$this->stop){
						if(is_int($action)){
							$action = $action_data;
							$action_data = array();
						}
						$action_events = null;
						$action_events = $this->_processAction($this->form_actions_data[$action], $action_data);
						//check action events
						if($action_events && is_array($action_data) && isset($action_data['events'])){
							foreach($action_events as $action_event => $v){
								$action_event = 'cfactionevent_'.$this->form_actions_data[$action]->type.'_'.$this->form_actions_data[$action]->order.'_'.$action_event;
								$this->_processEvents($action_event, $action_data['events']);
							}
						}
					}else{
						//add a stop sign to halt the views processing at this point
						$object = new stdClass();
						$object->type = '_STOP_';
						$this->main_event_actions[] = $object;
						$return = false;
					}
				}
			}
		}
		return $return;
	}
	
	function _processAction($action_details, $action_data = array()){
		$action = $action_details->type;
		if($action && isset($action_details->enabled) && (int)$action_details->enabled == 1){
			$this->main_event_actions[] = $action_details;
			return $this->runAction($action_details);
		}
	}
	
	function runAction($action_details, $forceView = false){
		if($forceView){
			$this->main_event_actions[] = $action_details;
		}
		$action = $action_details->type;
		$actionFile = JPATH_SITE.DS."administrator".DS."components".DS."com_chronoforms".DS.'form_actions'.DS.$action.DS.$action.'.php';			
		if(file_exists($actionFile)){
			$classname = 'Cfaction'.$this->_camilize($action);
			if(!class_exists($classname)){
				require_once($actionFile);					
			}
			${$classname} = new $classname();
			$methods = get_class_methods(${$classname});
			if(in_array('run', $methods)){
				if(isset($this->form_details->id)){
					${$classname}->form_id = $this->form_details->id;
				}
				${$classname}->form_name = $this->form_name;
				$this->loadActionHelper($action);
				ob_start();
				${$classname}->run($this, $action_details);
				$this->form_output .= ob_get_clean();
				
				if(isset(${$classname}->events) && is_array(${$classname}->events)){
					return array_filter(${$classname}->events);
				}else{
					return false;
				}
			}				
		}else{
			die('ChronoForms action file missing, Please make sure this file exists:<br> '.ROOT.DS.ADMIN_DIR.DS.'views'.DS.'chronoforms'.DS.'form_actions'.DS.$action.'.php');
		}
	}
	
	function loadActionHelper($action){
		//Try to load helper file
		$classname = 'Cfaction'.$this->_camilize($action).'Helper';
		$actionFile = JPATH_SITE.DS."administrator".DS."components".DS."com_chronoforms".DS.'form_actions'.DS.$action.DS.'cfaction_'.$action.'.php';
		if(class_exists($classname)){
			return true;
		}else if(!class_exists($classname) && file_exists($actionFile)){
			require_once($actionFile);
			return true;
		}else{
			return false;
		}
	}
	
	function getActionDetails($action_id){
		if(isset($this->form_actions_data['cfaction_'.$action_id])){
			return $this->form_actions_data['cfaction_'.$action_id];
		}else{
			return false;
		}
	}
	
	function __checkVal(){
		$mainframe =& JFactory::getApplication();
		$database =& JFactory::getDBO();
		$jversion = new JVersion();
		if($jversion->RELEASE > 1.5){
			$query = "SELECT * FROM `#__extensions` WHERE `element` = 'com_chronoforms' AND `type` = 'component'";
		}else{
			$query = "SELECT * FROM `#__components` WHERE `option` = 'com_chronoforms' AND `parent` = '0' AND `admin_menu_link` = 'option=com_chronoforms'";
		}
		$database->setQuery($query);
		$result = $database->loadObject();
		$configs = new JParameter($result->params);
		if($configs->get('licensevalid', 0)){
			return '';
		}else{
			return base64_decode('PCEtLSBkb24ndCByZW1vdmUgdGhlIGZvbGxvd2luZyAzIGxpbmVzIGlmIHlvdSBkaWRuJ3QgYnV5IGEgc3Vic2NyaXB0aW9uIC0tPiANCjxkaXYgY2xhc3M9ImNocm9ub2Zvcm0iPg0KPGEgaHJlZj0iaHR0cDovL3d3dy5jaHJvbm9lbmdpbmUuY29tIj5Qb3dlcmVkIEJ5IENocm9ub0Zvcm1zIC0gQ2hyb25vRW5naW5lLmNvbTwvYT4NCg0KPC9kaXY+DQo8IS0tIGRvbid0IHJlbW92ZSB0aGUgMyBsaW5lcyBhYm92ZSBpZiB5b3UgZGlkbid0IGJ1eSBhIHN1YnNjcmlwdGlvbiAtLT4=');
		}
	}
	
	function addDebugMsg($msg = ''){
		$this->debug[] = $msg;
	}
	
	function curly_replacer($content = '', $data = array(), $prefix = ''){
		foreach($data as $key => $value){
			$value = str_replace("\n", "\n<br />", $value);
			$formula = $key;
			if(!empty($prefix)){
				$formula = $prefix.".".$key;
			}
			if(is_array($value)){
				$content = $this->curly_replacer($content, $value, $formula);
			}else{
				$content = str_replace("{".$formula."}", $value, $content);
			}
		}
		return $content;
	}
	
	function _cleanName($formname){
		$formname = preg_replace('/[^A-Za-z0-9_-]/', '', trim($formname));
		return $formname;
	}
	
	function _camilize($class = ''){
		$class = preg_replace('/(?:^|_)(.?)/e', "strtoupper('$1')", $class);
		return $class;
	}
	
	function getSessionToken(){
		$session_key_param = $this->form_params->get('session_key_param', 'cf_sid');
		if(isset($this->session_token) && !empty($this->session_token)){
			//return $this->session_token;
		}else if(strlen(trim(JRequest::getVar($session_key_param, ''))) > 0){
			$this->session_token = trim(JRequest::getVar($session_key_param, ''));
		}else{
			$this->session_token = md5($this->form_name.rand(111111111, 999999999));
		}
		//add the field to the end of the shown form code/page
		$this->extra_content .= '<input type="hidden" alt="ghost" name="'.$session_key_param.'" value="'.$this->session_token.'" />';
		return $this->session_token;
	}
	
	function get_array_value($array, $indexes){
		if(count($indexes) == 1){
			if(isset($array[$indexes[0]])){
				return $array[$indexes[0]];
			}else{
				return NULL;
			}
		}
		$index = array_shift($indexes);
		if(isset($array[$index])){
			return $this->get_array_value($array[$index], $indexes);
		}else{
			return NULL;
		}
	}
	
	function set_array_value($array, $indexes, $value){
		eval('$array["'.implode('"]["', $indexes).'"] = $value;');
		return $array;
	}
}