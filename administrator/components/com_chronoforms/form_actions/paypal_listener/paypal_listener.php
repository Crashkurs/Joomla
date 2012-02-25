<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionPaypalListener{
	var $formname;
	var $formid;
	var $group = array('id' => 'payments', 'title' => 'Payment Gateways/Processors');
	var $events = array('verified' => 0, 'invalid' => 0, 'error' => 0);
	var $details = array('title' => 'PayPal Listener', 'tooltip' => 'Process the PayPal IPN response.');
	
	function run($form, $actiondata){
		$params = new JParameter($actiondata->params);
		$mainframe =& JFactory::getApplication();
		
		// read the post from PayPal system and add 'cmd'
		$req = 'cmd=_notify-validate';

		foreach ($_POST as $key => $value) {
			$value = urlencode(stripslashes($value));
			$req .= "&$key=$value";
		}

		$header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
		// If testing on Sandbox use:
		if((bool)$params->get('sandbox') === true){
			$header .= "Host: www.sandbox.paypal.com:443\r\n";
		}else{
			$header .= "Host: www.paypal.com:443\r\n";
		}
		$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
		if((bool)$params->get('sandbox') === true){
			$fp = fsockopen('ssl://www.sandbox.paypal.com', 443, $errno, $errstr, 30);
		}else{
			$fp = fsockopen('ssl://www.paypal.com', 443, $errno, $errstr, 30);
		}

		// assign posted variables to local variables
		/*$item_name = $_POST['item_name'];
		$item_number = $_POST['item_number'];
		$payment_status = $_POST['payment_status'];
		$payment_amount = $_POST['mc_gross'];
		$payment_currency = $_POST['mc_currency'];
		$txn_id = $_POST['txn_id'];
		$receiver_email = $_POST['receiver_email'];
		$payer_email = $_POST['payer_email'];*/

		if(!$fp){
			// HTTP ERROR
			//user CURL
			$curl_result = $curl_err = '';
			$ch = curl_init();
			if((bool)$params->get('sandbox') === true){
				curl_setopt($ch, CURLOPT_URL, 'www.sandbox.paypal.com');
			}else{
				curl_setopt($ch, CURLOPT_URL, 'www.paypal.com');
			}
			
			curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
			curl_setopt($ch, CURLOPT_HTTPHEADER,  array("Content-Type: application/x-www-form-urlencoded",  "Content-Length: " . strlen($req)));
			curl_setopt($ch, CURLOPT_HEADER , 0);   
			curl_setopt($ch, CURLOPT_VERBOSE, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
			curl_setopt($ch, CURLOPT_TIMEOUT, 30);
			$curl_result = @curl_exec($ch);
			$curl_err = curl_error($ch);
			curl_close($ch);
			//Set validation flag
			if(!$curl_result){
				//both fsock and curl failed!
				$this->events['error'] = 1;
			}else{
				if(strpos($curl_result, "VERIFIED") !== false){
					$valid = true;
					$this->set_events($valid, $form);
				}else{
					$valid = false;
					$this->set_events($valid, $form);
				}
			}
		}else{
			fputs ($fp, $header . $req);
			while(!feof($fp)){
				$res = fgets ($fp, 1024);
				if(strcmp($res, "VERIFIED") == 0){
					// check the payment_status is Completed
					// check that txn_id has not been previously processed
					// check that receiver_email is your Primary PayPal email
					// check that payment_amount/payment_currency are correct
					// process payment
					$valid = true;
					$this->set_events($valid, $form);
				}else if(strcmp ($res, "INVALID") == 0){
					// log for manual investigation
					$valid = false;
					$this->set_events($valid, $form);
				}else{
					//$this->events['invalid'] = 1;//delete
				}
			}
			fclose($fp);
		}
		
	}
	
	function set_events($valid = false, $form){
		if($valid){
			if($form->data['payment_status'] == 'Completed'){
				$this->events['verified'] = 1;
			}
			//$this->events['invalid'] = 1;//delete
		}else{
			$this->events['invalid'] = 1;
		}
	}
	
	function load($clear){
		if($clear){
			$action_params = array(
				'content1' => '',
				'sandbox' => 0
			);
		}
		return array('action_params' => $action_params);
	}
	
}
?>