<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionLoadRecaptcha{
	var $formname;
	var $formid;
	var $group = array('id' => 'recaptcha', 'title' => 'ReCaptcha');
	var $details = array('title' => 'Load Recaptcha', 'tooltip' => 'Load the Recaptcha image');
	
	function run($form, $actiondata)
	{
		$mainframe =& JFactory::getApplication();
		$params = new JParameter($actiondata->params);
		
		if(!defined('RECAPTCHA_API_SERVER')){
			define('RECAPTCHA_API_SERVER', $params->get('api_server'));
		}
		if(!defined('RECAPTCHA_API_SECURE_SERVER')){
			define('RECAPTCHA_API_SECURE_SERVER', $params->get('api_secure_server'));
		}
		$recaptcha_load = "<div id='recaptcha'>".$this->recaptcha_get_html($params->get('public_key'))."</div>";
		$script = "
	var RecaptchaOptions = {
		theme : '".$params->get('theme', 'red')."',
		lang  : '".$params->get('lang', 'en')."'
	};
    		";
		$doc =& JFactory::getDocument();
        $doc->addScriptDeclaration($script);
		//add CSS fix to the recaptcha input field
		$doc->addStyleDeclaration('label.recaptcha_input_area_text{line-height: 12px !important;}');
		//replace the string
		$form->form_details->content = str_replace('{ReCaptcha}', $recaptcha_load, $form->form_details->content);
	}
	
	/**
     * Gets the challenge HTML (javascript and non-javascript version).
     * This is called from the browser, and the resulting reCAPTCHA HTML widget
     * is embedded within the HTML form it was called from.
     * @param string $pubkey A public key for reCAPTCHA
     * @param string $error The error given by reCAPTCHA (optional, default is null)
     * @param boolean $use_ssl Should the request be made over ssl? (optional, default is false)

     * @return string - The HTML to be embedded in the user's form.
     */
    function recaptcha_get_html($pubkey, $error = null, $use_ssl = false)
	{
        if ( $pubkey == null || $pubkey == '' ) {
            die ("To use reCAPTCHA you must get an API key from
            <a href='https://www.google.com/recaptcha/admin/create'>https://www.google.com/recaptcha/admin/create</a>");
        }

        if ( $use_ssl ) {
            $server = RECAPTCHA_API_SECURE_SERVER;
        } else {
            $server = RECAPTCHA_API_SERVER;
        }

        $errorpart = "";
        if ( $error ) {
            $errorpart = "&amp;error=" . $error;
        }
        return '<script type="text/javascript" src="'. $server . '/challenge?k=' . $pubkey . $errorpart . '"></script>
        <noscript>
            <iframe src="'. $server . '/noscript?k=' . $pubkey . $errorpart . '" height="300" width="500" frameborder="0"></iframe><br/>
            <textarea name="recaptcha_challenge_field" rows="3" cols="40"></textarea>
            <input type="hidden" name="recaptcha_response_field" value="manual_challenge"/>
        </noscript>';
    }
	
	function load($clear)
	{
		if ( $clear ) {
			$action_params = array(
				'public_key' => '6LfNoAUAAAAAAKi8QZmjv-QHOvlGtyh509SG3FzG',
				'ssl_server' => '0',
				'theme' => 'red',
				'lang' => 'en',
				'api_server' => 'http://www.google.com/recaptcha/api',
				'api_secure_server' => 'https://www.google.com/recaptcha/api'
			);
		}
		return array('action_params' => $action_params);
	}
}
?>