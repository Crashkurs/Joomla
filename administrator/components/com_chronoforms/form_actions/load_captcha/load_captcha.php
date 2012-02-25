<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionLoadCaptcha{
	var $formname;
	var $formid;
	var $group = array('id' => 'core_captcha', 'title' => 'Core Captcha');
	var $details = array('title' => 'Load Recaptcha', 'tooltip' => 'Load the Recaptcha image');
	function run($form, $actiondata){
		$mainframe =& JFactory::getApplication();
		$uri =& JFactory::getURI();
		$params = new JParameter($actiondata->params);
		$CF_PATH = $uri->root();
		$uri =& JFactory::getURI();
		if($uri->isSSL()){
			$CF_PATH = str_replace('http:', 'https:', $CF_PATH);
		}
		//check IE 5,6,7
		$old_ie = false;
		$ua = $_SERVER['HTTP_USER_AGENT'];
		if(preg_match('/\bmsie [567]/i', $ua) && !preg_match('/\bopera/i', $ua)){
			$old_ie = true;
		}
		if($old_ie || ((bool)$params->get('encoded_image', 0) === false)){
			$form->form_details->content = str_replace('{chronocaptcha_img}', '  <img src="'.$CF_PATH.'components/com_chronoforms/chrono_verification.php?imtype='.$params->get('fonts', 0).'" alt="" />', $form->form_details->content);
		}else{
			ob_start();
			$this->generate_encoded((int)$params->get('fonts', 0));
			$imgbinary = ob_get_clean();
			$form->form_details->content = str_replace('{chronocaptcha_img}', '  <img src="data:image/png;base64,'.base64_encode($imgbinary).'" alt="" />', $form->form_details->content);
		}
	}
	
	function generate_encoded($fonts = 0){
		$mainframe =& JFactory::getApplication('site');
		$session =& JFactory::getSession();
		//generate code string
		$alphanum  = "ABCDEFGHJKLMNPQRSTUVWXYZ23456789abcdefghijkmnpqrstuvwxyz";
		$rand = substr(str_shuffle($alphanum), 0, 5);
		$alphanum2  = "ABCDEFGHIJKLMNPQRSTUVWXYZ23456789abcdefghijkmnpqrstuvwxyz?><,.|\"'[{]}_=+*&^%$#@!~";
		$rand2 = substr(str_shuffle($alphanum), 0, 7);
		$session->set("chrono_verification", md5(strtolower($rand)), md5('chrono'));
		//generate the image itself
		if($fonts){
			$font = dirname(__FILE__).'/default.ttf';
			$image_size = imagettfbbox(20, 0, $font, 'X');
			$image_size = 5*(abs($image_size[2] - $image_size[0])+7);
			$im = imagecreatetruecolor($image_size, 40);
			
			// Create some colors
			$white = imagecolorallocate($im, 255, 255, 255);
			$grey = imagecolorallocate($im, 128, 128, 128);
			$greylight = imagecolorallocate($im, 199, 199, 199);
			$black = imagecolorallocate($im, 0, 0, 0);
			imagefilledrectangle($im, 0, 0, $image_size -1, 39, $white);
			
			// The text to draw
			$text = $rand;
			// Replace path by your own font path
			$font = dirname(__FILE__).'/default.ttf';
			$chars = array();
			$chars2 = array();
			for ($i = 0; $i < strlen($text); $i++) { $chars[] = $text[$i]; }
			for ($i = 0; $i < strlen($rand2); $i++) { $chars2[] = $rand2[$i]; }
			//$chars = str_split($text);
			//$chars2 = str_split($rand2);
			// Add some shadow to the text
			//imagettftext($im, 20, 0, 11, 21, $grey, $font, $text);
			
			$size2 = 20;
			$angle2 = 0;
			$x2 = 10;
			$y2 = 25;
			$bbox2 = array();
			$bbox2[0] = 0;
			$bbox2[2] = 0;
			foreach($chars2 as $char2){
				$angle2 = rand(-20, 20);
				$size2 = rand(15, 20);
				$y2 = rand(0, 40);
				imagettftext($im, $size2, $angle2, $x2, $y2, $greylight, $font, $char2);
				$bbox2 = imagettfbbox($size2, $angle2, $font, $char2);
				$x2 = $x2 + abs($bbox2[2] - $bbox2[0]) + 3;
			}
			
			$size = 20;
			$angle = 0;
			$x = 10;
			$y = 25;
			$bbox = array();
			$bbox[0] = 0;
			$bbox[2] = 0;
			// Add the text
			foreach($chars as $char){
				$angle = rand(-20, 20);
				//$size = rand(15, 20);
				imagettftext($im, $size, $angle, $x, $y, $black, $font, $char);
				$bbox = imagettfbbox($size, $angle, $font, $char);
				$x = $x + abs($bbox[2] - $bbox[0]) + 3;
			}
			
			// Using imagepng() results in clearer text compared with imagejpeg()
			imagepng($im);
			imagedestroy($im);
		}else{
			$image = imagecreatefrompng(dirname(__FILE__).'/background.png');
			$greylight = imagecolorallocate($image, 199, 199, 199);
			$black = imagecolorallocate($image, 0, 0, 0); 
			imagestring ($image, 5, 8, 14,  $rand2, $greylight); 
			imagestring ($image, 5, 5, 11,  $rand, $black);
			imagepng($image);
			imagedestroy($image);
		}
	}
	
	function load($clear){
		if($clear){
			$action_params = array(
				'fonts' => 0,
				'encoded_image' => 0
			);
		}
		return array('action_params' => $action_params);
	}
}
?>