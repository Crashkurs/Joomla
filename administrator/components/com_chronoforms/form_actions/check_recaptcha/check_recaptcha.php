<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionCheckRecaptcha{
	var $formname;
	var $formid;
	var $group = array('id' => 'recaptcha', 'title' => 'ReCaptcha');
	var $events = array('success' => 0, 'fail' => 0);
	var $details = array('title' => 'Check Recaptcha', 'tooltip' => 'Check the Recaptcha results');
	
	function run($form, $actiondata)
	{
		$params = new JParameter($actiondata->params);
		
		if(!defined('RECAPTCHA_VERIFY_SERVER')){
			define('RECAPTCHA_VERIFY_SERVER', $params->get('verify_server'));
		}
        $resp = $this->recaptcha_check_answer(
            $params->get('private_key'),
            $_SERVER["REMOTE_ADDR"],
            JRequest::getVar("recaptcha_challenge_field"),
            JRequest::getVar("recaptcha_response_field")
		);

        if ( !$resp->is_valid ) {
			$form->validation_errors['recaptcha'] = $params->get('error', "The reCAPTCHA wasn't entered correctly. Please try it again.");
			$form->debug[] = "( reCAPTCHA said: ".$resp->error." )";
			$this->events['fail'] = 1;
        }else{
			$this->events['success'] = 1;
		}
	}
	
	/**
     * Calls an HTTP POST function to verify if the user's guess was correct
     * @param string $privkey
     * @param string $remoteip
     * @param string $challenge
     * @param string $response
     * @param array $extra_params an array of extra variables to post to the server
     * @return CFReCaptchaResponse
     */
    function recaptcha_check_answer ($privkey, $remoteip, $challenge, $response, $extra_params = array())
    {
        if ( $privkey == null || $privkey == '' ) {
            die ("To use reCAPTCHA you must get an API key from
                <a href='https://www.google.com/recaptcha/admin/create'>https://www.google.com/recaptcha/admin/create</a>");
        }

        if ( $remoteip == null || $remoteip == '' ) {
            die ("For security reasons, you must pass the remote ip to reCAPTCHA");
        }

        //discard spam submissions
        if ( $challenge == null || strlen($challenge) == 0
                || $response == null || strlen($response) == 0) {
            $recaptcha_response = new CFReCaptchaResponse();
            $recaptcha_response->is_valid = false;
            $recaptcha_response->error = 'incorrect-captcha-sol';
            return $recaptcha_response;
        }
        $response = $this->_recaptcha_http_post (RECAPTCHA_VERIFY_SERVER, "/recaptcha/api/verify",
            array ( 'privatekey' => $privkey,
                    'remoteip' => $remoteip,
                    'challenge' => $challenge,
                    'response' => $response ) + $extra_params
            );

        $answers = explode ("\n", $response [1]);
        $recaptcha_response = new CFReCaptchaResponse();

        if (trim ($answers [0]) == 'true') {
            $recaptcha_response->is_valid = true;
        } else {
            $recaptcha_response->is_valid = false;
            $recaptcha_response->error = $answers [1];
        }
        return $recaptcha_response;
    }
    function _recaptcha_http_post($host, $path, $data, $port = 80) {

        $req = $this->_recaptcha_qsencode ($data);

        $http_request  = "POST $path HTTP/1.0\r\n";
        $http_request .= "Host: $host\r\n";
        $http_request .= "Content-Type: application/x-www-form-urlencoded;\r\n";
        $http_request .= "Content-Length: " . strlen($req) . "\r\n";
        $http_request .= "User-Agent: reCAPTCHA/PHP\r\n";
        $http_request .= "\r\n";
        $http_request .= $req;

        $response = '';
        if ( false == ( $fs = @fsockopen($host, $port, $errno, $errstr, 10) ) ) {
            die ("Could not open socket: $errno - $errstr"); ;
        }

        fwrite($fs, $http_request);

        while ( !feof($fs) ) {
            $response .= fgets($fs, 1160); // One TCP-IP packet
        }
        fclose($fs);
        $response = explode("\r\n\r\n", $response, 2);

        return $response;
    }
    /**
     * Encodes the given data into a query string format
     * @param $data - array of string elements to be encoded
     * @return string - encoded request
     */
    function _recaptcha_qsencode ($data) {
        $req = "";
        foreach ( $data as $key => $value )
        $req .= $key . '=' . urlencode( stripslashes($value) ) . '&';

        // Cut the last '&'
        $req=substr($req, 0, strlen($req) - 1);
        return $req;
    }
	
	function load($clear){
		if($clear){
			$action_params = array(
				'private_key' => '6LfNoAUAAAAAABX7Dfw_9Pp4K4KVtKNCUHsIWG7O',
				'verify_server' => 'www.google.com',
				'error' => "The reCAPTCHA wasn't entered correctly. Please try it again."
			);
		}
		return array('action_params' => $action_params);
	}
}

/**
 * A CFReCaptchaResponse is returned from recaptcha_check_answer()
 */
class CFReCaptchaResponse {
    var $is_valid;
    var $error;
}
?>