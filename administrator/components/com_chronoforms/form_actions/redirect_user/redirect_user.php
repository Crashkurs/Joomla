<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionRedirectUser
{
	var $formname;
	var $formid;
	var $details = array('title' => 'ReDirect User', 'tooltip' => 'Will redirect the user to another url.');
	
	function run($form, $actiondata)
	{
		$mainframe =& JFactory::getApplication();
		$params = new JParameter($actiondata->params);
		if ( isset($form->data['redirect_url']) && $form->data['redirect_url'] ) {
			$redirect_url =  $form->data['redirect_url'];
		} else {
			$redirect_url = $params->get('target_url');
		}
		if ( !$redirect_url ) {
			$form->debug['redirect_user'][] = 'Error: No Redirect URL found';
			return false;
		}
		$form->debug['redirect_user'][] = 'redirect_user_target_url: '.$params->get('target_url');
		//$mainframe->enqueuemessage('$form: '.print_r($form, true).'<hr />');
		//if ( filter_var($redirect_url, FILTER_VALIDATE_URL) ) {
			$debug = false;
			foreach ( $form->form_actions as $a ) {
				if ( $a->type == 'debugger' && $a->enabled ) {
					$debug = true;
					break;
				}
			}
			if ( $debug ) {
				$form->debug['redirect_user'][] = "Redirect URL (click to continue):<br /><a href='{$redirect_url}'>{$redirect_url}</a>";
			} else {
				$mainframe->redirect($redirect_url);
			}
		/*} else {
			$form->debug['redirect_user'][] = 'Error: Invalid URL';
		}*/
	}
	
	function load($clear)
	{
		if ( $clear ) {
			$action_params = array(
				'target_url' => 'http://'
			);
		}
		return array('action_params' => $action_params);
	}
}
?>