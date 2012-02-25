<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class Cfaction2coListener{
	var $formname;
	var $formid;
	var $group = array('id' => 'payments', 'title' => 'Payment Gateways/Processors');
	var $events = array('hack' => 0, 'new_order' => 0, 'fraud_status' => 0, 'refund' => 0, 'other' => 0);
	var $details = array('title' => '2CO Listener', 'tooltip' => 'Get the response from the 2CO payment processor.');
	
	function run($form, $actiondata){
		$params = new JParameter($actiondata->params);
		$mainframe =& JFactory::getApplication();
		
		$vendorid = $params->get('sid');
		$secretword = $params->get('secret');
		$md5hash = strtoupper(md5($form->data['sale_id'].$vendorid.$form->data['invoice_id'].$secretword));
		//if the hash is ok
		if($md5hash == $form->data['md5_hash']){
			//switch messages types
			switch($form->data['message_type']){
				case 'ORDER_CREATED':
					$this->events['new_order'] = 1;
					break;
				case 'FRAUD_STATUS_CHANGED':
					$this->events['fraud_status'] = 1;
					break;
				case 'REFUND_ISSUED':
					$this->events['refund'] = 1;
					break;
				default:
					$this->events['other'] = 1;
					break;
			}
		}else{
			//$this->events['hack'] = 1;
		}
		
	}
	
	function load($clear){
		if($clear){
			$action_params = array(
				'sid' => '',
				'secret' => ''
			);
		}
		return array('action_params' => $action_params);
	}
	
}
?>