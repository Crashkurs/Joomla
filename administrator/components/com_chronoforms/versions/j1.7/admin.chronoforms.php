<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
/* ensure that this file is not called from another file */
defined('_JEXEC') or die('Restricted access');
function __getValStatus(){
	$mainframe =& JFactory::getApplication();
	$database =& JFactory::getDBO();
	$database->setQuery("SELECT * FROM #__extensions WHERE `element` = 'com_chronoforms' AND `type` = 'component'");
	$result = $database->loadObject();
	if(!empty($result)){
		$params = new JParameter($result->params);
		return (bool)$params->get('licensevalid', 0);
	}else{
		return false;
	}
}

function validatelicense(){
	if(isset($_POST['instantcode'])){
		validatelicensedata();
	}else{
		$database =& JFactory::getDBO();
		$query = "SELECT * FROM `#__extensions` WHERE `element` = 'com_chronoforms' AND `type` = 'component'";
		$database->setQuery( $query );
		$result = $database->loadObject();
		$params = new JParameter($result->params);
		HTML_Admin_ChronoForms::validatelicense($params);
	}
}

function validatelicensedata(){
	$mainframe =& JFactory::getApplication();
	$uri =& JFactory::getURI();
	preg_match('/http(s)*:\/\/(.*?)\//i', $uri->root(), $matches);
	$database =& JFactory::getDBO();
	$query     = "SELECT * FROM `#__extensions` WHERE `element` = 'com_chronoforms' AND `type` = 'component'";
	$database->setQuery( $query );
	$result = $database->loadObject();
	//$configs = JComponentHelper::getParams('com_chronoforms');
	$configs = new JParameter($result->params);
	$postfields = array();
	if(isset($_POST['licensecode']) && !empty($_POST['licensecode'])){
		$configs->set('licensecode', $_POST['licensecode']);
	}
	$postfields['license_key'] = $configs->get('licensecode', '');
	$postfields['domain_name'] = $matches[2];
	$postfields['pid'] = $_POST['pid'];
	$validstatus = false;
	
	if(empty($postfields['license_key'])){
		$mainframe->redirect("index.php?option=com_chronoforms&task=validatelicense", 'You didn\'t enter your validation key.');
	}
	
	if(trim(JRequest::getVar('instantcode')) && $configs->get('licensecode', '')){
		$step1 = base64_decode(trim(JRequest::getVar('instantcode')));
		$step2 = str_replace(substr(md5(str_replace('www.', '', strtolower($matches[2]))), 0, 7), '', $step1);
		$step3 = str_replace(substr(md5(str_replace('www.', '', strtolower($matches[2]))), - strlen(md5(str_replace('www.', '', strtolower($matches[2])))) + 7), '', $step2);
		$step4 = str_replace(substr($configs->get('licensecode', ''), 0, 10), '', $step3);
		$step5 = str_replace(substr($configs->get('licensecode', ''), - strlen($configs->get('licensecode', '')) + 10), '', $step4);
		//echo (int)$step5;return;
		//if((((int)$step5 + (24 * 60 * 60)) > strtotime(date('d-m-Y H:i:s')))||(((int)$step5 - (24 * 60 * 60)) < strtotime(date('d-m-Y H:i:s')))){
		if(((int)$step5 < (strtotime("now") + (24 * 60 * 60)))&&((int)$step5 > (strtotime("now") - (24 * 60 * 60)))){
			$query = "SELECT * FROM `#__extensions` WHERE `element` = 'com_chronoforms' AND `type` = 'component'";
			$database->setQuery( $query );
			$result = $database->loadObject();
			$newline = "\n";
			if($result){
				//$newparams = 'showtipoftheday='.$configs->get('showtipoftheday', 1).$newline.'licensecode='.$configs->get('licensecode', '').$newline.'licensevalid=1';
				$newparams = new JParameter($result->params);
				$newparams->set('licensevalid', 1);
				$newparams->set('licensecode', $configs->get('licensecode', ''));
				$newparams = $newparams->toString();
				$database->setQuery( "UPDATE `#__extensions` SET params='".$newparams."' WHERE extension_id='".$result->extension_id."'");
				if (!$database->query()) {
					JError::raiseWarning(100, $database->getErrorMsg());
					$mainframe->redirect( "index.php?option=com_chronoforms" );
				}
			}
			$mainframe->redirect( "index.php?option=com_chronoforms", 'Your key was validated successfully' );
		}else{
			//$mainframe->redirect( "index.php?option=com_chronoforms", 'Invalid instant code' );
		}
	}
	
	if(function_exists('fsockopen')){	
		$validstatus = validationconnect('http', 'www.chronoengine.com', $port='80', $path='/index.php?option=com_chronocontact&task=extra&chronoformname=validateLicense', $postfields);
	}
	
	if((!$validstatus)||($validstatus == 'error')||!function_exists('fsockopen')){
		if (!function_exists('curl_init')){
			$validstatus = false;
		}else{
			$fields = ''; 
			$ch = curl_init();
			//$postfields = array();
			foreach( $postfields as $key => $value ) $fields .= "$key=" . urlencode( $value ) . "&";			
			curl_setopt($ch, CURLOPT_URL, 'http://www.chronoengine.com/index.php?option=com_chronocontact&task=extra&chronoformname=validateLicense');
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_TIMEOUT, 10);
			curl_setopt($ch, CURLOPT_POSTFIELDS, rtrim( $fields, "& " ));
			if($configs->get('curlproxy', '')){
				curl_setopt($ch, CURLOPT_PROXY, $configs->get('curlproxy'));
			}
			$output = curl_exec($ch);
			curl_close($ch);
			$validstatus = $output;
		}
	}
	//return $validstatus;
	if($validstatus == 'valid'){
		if($configs->get('licensecode', '')){
			//if(!$configs->get('licensevalid', '')){
				$query     = "SELECT * FROM `#__extensions` WHERE `element` = 'com_chronoforms' AND `type` = 'component'";
				$database->setQuery( $query );
				$result = $database->loadObject();
				$newline = "\n";
				if($result){
					//$newparams = 'showtipoftheday='.$configs->get('showtipoftheday', 1).$newline.'licensecode='.$configs->get('licensecode', '').$newline.'licensevalid=1';
					$newparams = new JParameter($result->params);
					$newparams->set('licensevalid', 1);
					$newparams->set('licensecode', $configs->get('licensecode', ''));
					$newparams = $newparams->toString();
					$database->setQuery( "UPDATE `#__extensions` SET params='".$newparams."' WHERE extension_id='".$result->extension_id."'");
					if (!$database->query()) {
						JError::raiseWarning(100, $database->getErrorMsg());
						$mainframe->redirect( "index.php?option=com_chronoforms" );
					}
				}
			//}
		}
		$mainframe->redirect( "index.php?option=com_chronoforms", 'Your Install was validated successfully' );
	}else if($validstatus == 'invalid'){
		$query     = "SELECT * FROM `#__extensions` WHERE `element` = 'com_chronoforms' AND `type` = 'component'";
		$database->setQuery( $query );
		$result = $database->loadObject();
		$newline = "\n";
		if($result){
			//$newparams = 'showtipoftheday='.$configs->get('showtipoftheday', 1).$newline.'licensecode='.$configs->get('licensecode', '').$newline.'licensevalid=0';
			$newparams = new JParameter($result->params);
			$newparams->set('licensevalid', 0);
			$newparams->set('licensecode', $configs->get('licensecode', ''));
			$newparams = $newparams->toString();
			$database->setQuery( "UPDATE `#__extensions` SET params='".$newparams."' WHERE extension_id='".$result->extension_id."'");
			if (!$database->query()) {
				JError::raiseWarning(100, $database->getErrorMsg());
				$mainframe->redirect( "index.php?option=com_chronoforms" );
			}
		}
		$mainframe->redirect( "index.php?option=com_chronoforms", 'We couldn\'t validate your key because of some wrong data used' );
	}else{
		if(trim(JRequest::getVar('instantcode'))){
			$step1 = base64_decode(trim(JRequest::getVar('instantcode')));
			$step2 = str_replace(substr(md5(str_replace('www.', '', strtolower($matches[2]))), 0, 7), '', $step1);
			$step3 = str_replace(substr(md5(str_replace('www.', '', strtolower($matches[2]))), - strlen(md5(str_replace('www.', '', strtolower($matches[2])))) + 7), '', $step2);
			$step4 = str_replace(substr($configs->get('licensecode', ''), 0, 10), '', $step3);
			$step5 = str_replace(substr($configs->get('licensecode', ''), - strlen($configs->get('licensecode', '')) + 10), '', $step4);
			//echo (int)$step5;return;
			//if((((int)$step5 + (24 * 60 * 60)) > strtotime(date('d-m-Y H:i:s')))||(((int)$step5 - (24 * 60 * 60)) < strtotime(date('d-m-Y H:i:s')))){
			if(((int)$step5 < (strtotime("now") + (24 * 60 * 60)))&&((int)$step5 > (strtotime("now") - (24 * 60 * 60)))){
				$query     = "SELECT * FROM `#__extensions` WHERE `element` = 'com_chronoforms' AND `type` = 'component'";
				$database->setQuery( $query );
				$result = $database->loadObject();
				$newline = "\n";
				if($result){
					//$newparams = 'showtipoftheday='.$configs->get('showtipoftheday', 1).$newline.'licensecode='.$configs->get('licensecode', '').$newline.'licensevalid=1';
					$newparams = new JParameter($result->params);
					$newparams->set('licensevalid', 1);
					$newparams->set('licensecode', $configs->get('licensecode', ''));
					$newparams = $newparams->toString();
					$database->setQuery( "UPDATE `#__extensions` SET params='".$newparams."' WHERE extension_id='".$result->extension_id."'");
					if (!$database->query()) {
						JError::raiseWarning(100, $database->getErrorMsg());
						$mainframe->redirect( "index.php?option=com_chronoforms" );
					}
				}
				$mainframe->redirect( "index.php?option=com_chronoforms", 'Your key was validated successfully' );
			}else{
				$mainframe->redirect( "index.php?option=com_chronoforms", 'Invalid instant code' );
			}
		}else{
			$query = "SELECT * FROM `#__extensions` WHERE `element` = 'com_chronoforms' AND `type` = 'component'";
			$database->setQuery( $query );
			$result = $database->loadObject();
			$newline = "\n";
			if($result){
				//$newparams = 'showtipoftheday='.$configs->get('showtipoftheday', 1).$newline.'licensecode='.$configs->get('licensecode', '').$newline.'licensevalid=0';
				$newparams = new JParameter($result->params);
				$newparams->set('licensevalid', 0);
				$newparams->set('licensecode', $configs->get('licensecode', ''));
				$newparams = $newparams->toString();
				$database->setQuery("UPDATE `#__extensions` SET params='".$newparams."' WHERE extension_id='".$result->extension_id."'");
				if (!$database->query()) {
					JError::raiseWarning(100, $database->getErrorMsg());
					$mainframe->redirect( "index.php?option=com_chronoforms" );
				}
			}
			$mainframe->redirect( "index.php?option=com_chronoforms", 'We couldn\'t validate your key because your hosting server doesn\'t have neither the CURL library nor the fsockopen functions or they may exist but don\'t function properly, please contact your host admin to fix them or contact us <a href="http://www.chronoengine.com/contactus.html">here</a> Or at this email address : webmaster@chronoengine.com' );
		}
	}
}
?>