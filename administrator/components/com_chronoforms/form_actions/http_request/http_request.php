<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionHttpRequest{
	var $formname;
	var $formid;
	var $group = array('id' => 'form_utilities', 'title' => 'Utilities');
	var $details = array('title' => 'HTTP Request', 'tooltip' => 'Initiate an HTTP request call.');
	function load($clear){
		if($clear){
			$action_params = array(
				'enabled' => 0,
				'http_request_url' => '',
				'request_event' => 'submit',
				'response_element_id' => '',
				'event_element_id' => ''
			);
		}
		return array('action_params' => $action_params);
	}
	
	function run($form, $actiondata){
		ob_start();
		?>
		function(){
			$('chronoform_<?php echo $form->form_name; ?>').removeClass('hasValidation');
			request_caller_<?php echo $actiondata->id; ?>();
		}
		<?php
		$jsvalidation_onValidateSuccess = ob_get_clean();
		$form_params = new JParameter($form->form_details->params);
		$form_params->set('jsvalidation_onValidateSuccess', $jsvalidation_onValidateSuccess);
		$form->form_params->set('jsvalidation_onValidateSuccess', $jsvalidation_onValidateSuccess);
		$form->form_details->params = $form_params->toString();
	}	
}
?>