<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionCheckCaptcha{
	var $formname;
	var $formid;
	var $group = array('id' => 'core_captcha', 'title' => 'Core Captcha');
	var $events = array('success' => 0, 'fail' => 0);
	var $fail = array('actions' => array('show_HTML'));
	var $details = array('title' => 'Check Captcha', 'tooltip' => 'Check the Recaptcha results');
	
	function run($form, $actiondata){
		$params = new JParameter($actiondata->params);
		if(isset($_POST['chrono_verification'])){
			$mainframe =& JFactory::getApplication();
			$session =& JFactory::getSession();
			$sessionvar = $session->get('chrono_verification', '', md5('chrono'));
			$chrono_verification = strtolower(JRequest::getVar('chrono_verification'));
			if(md5($chrono_verification) != $sessionvar){				
				$this->events['fail'] = 1;
				$form->validation_errors['chrono_verification'] = $params->get('error', 'You have entered a wrong verification code!');
				$form->data['chrono_verification'] = '';
				$form->debug['Core Captcha'][] = "Failed the core captcha check!";
			}else{
				$this->events['success'] = 1;
				$session->clear('chrono_verification', md5('chrono'));
				$form->debug['Core Captcha'][] = "Passed the core captcha check!";
			}
		}else{
			$this->events['fail'] = 1;
			$form->validation_errors['chrono_verification'] = $params->get('error', 'You have entered a wrong verification code.');
			$form->debug['Core Captcha'][] = "Couldn't find the captcha field value in the \$_POST array!";
		}
	}
	
	function load($clear){
		if($clear){
			$action_params = array(
				'enabled' => 1,
				'error' => 'You have entered a wrong verification code!'
			);
		}
		return array('action_params' => $action_params);
	}
}
?>