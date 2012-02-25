<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionMultiLanguage{
	var $formname;
	var $formid;
	var $group = array('id' => 'form_utilities', 'title' => 'Utilities');
	var $details = array('title' => 'Multi Language', 'tooltip' => 'Different language simple string replacer.');
	function run($form, $actiondata){
		if(isset($form->form_actions) && !empty($form->form_actions)){
			$params = new JParameter($actiondata->params);
			$lang =& JFactory::getLanguage();
			if($lang->getTag() == $params->get('lang_tag', '')){
				$lang_strings = explode("\n", $actiondata->content1);
				usort($lang_strings, array('CfactionMultiLanguage', 'sortByLength'));
				foreach($lang_strings as $lang_string){
					if(!empty($lang_string) && strpos($lang_string, "=") !== false){
						$texts = explode("=", $lang_string);
						$original = trim($texts[0]);
						$new = trim($texts[1]);
						//do replacements in all loaded actions
						foreach($form->form_actions as $k => $action){
							if($action->type != 'multi_language'){
								//do replacements in params
								$form->form_actions[$k]->params = str_replace($original, $new, $form->form_actions[$k]->params);
								//do replacements in content1
								$form->form_actions[$k]->content1 = str_replace($original, $new, $form->form_actions[$k]->content1);
							}
						}
						//do replacements in main form code and params
						//do replacements in params
						$form->form_details->params = str_replace($original, $new, $form->form_details->params);
						//do replacements in content1
						$form->form_details->content = str_replace($original, $new, $form->form_details->content);
					}
					if((bool)$params->get('translate_output', 0) === true){
						$form->form_output = str_replace($original, $new, $form->form_output);
					}
				}
			}
		}
		//print_r2($form->form_actions);
	}
	
	function sortByLength($a,$b){
		return strlen($b)-strlen($a);
	}
	
	function load($clear){
		if($clear){
			$action_params = array(
				'content1' => '',
				'translate_output' => 0,
				'lang_tag' => 'en-GB'
			);
		}
		return array('action_params' => $action_params);
	}
}
?>