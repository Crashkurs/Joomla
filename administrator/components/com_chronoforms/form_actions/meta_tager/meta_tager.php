<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionMetaTager{
	var $formname;
	var $formid;
	var $details = array('title' => 'Meta Tager', 'tooltip' => 'Adds different meta tags to the form page.');
	var $group = array('id' => 'form_utilities', 'title' => 'Utilities');
	function load($clear){
		if($clear){
			$action_params = array(
				'description' => 'Our Contact Page.',
				'robots' => 'index, follow',
				'generator' => 'Joomla! - Chronoforms!',
				'keywords' => '',
				'title' => '',
				'content1' => ''
			);
		}
		return array('action_params' => $action_params);
	}
	
	function run($form, $actiondata){
		$params = new JParameter($actiondata->params);
		$mainframe =& JFactory::getApplication();
		//settings, vars
		$doc =& JFactory::getDocument();
		//description
		$doc->setDescription($params->get('description', 'Our Contact Page.'));
		//keywords
		$doc->setMetaData('keywords', $params->get('keywords', ''));
		//robots
		$doc->setMetaData('robots', $params->get('robots', 'index, follow'));
		//generator
		$doc->setMetaData('generator', $params->get('generator', 'Joomla! - Chronoforms!'));
		//title
		$title = $params->get('title', '');
		if(trim($title)){
			$doc->setTitle($title);
		}
		//custom
		if(!empty($actiondata->content1)){
			$list = explode("\n", trim($actiondata->content1));
			foreach($list as $item){
				$fields_data = explode("=", $item);
				$doc->setMetaData(trim($fields_data[0]), trim($fields_data[1]));
			}
		}
	}	
}
?>