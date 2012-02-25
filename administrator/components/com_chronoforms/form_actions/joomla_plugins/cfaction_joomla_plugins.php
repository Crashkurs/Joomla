<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionJoomlaPluginsHelper{
	function show($form, $actiondata){
		$mainframe =& JFactory::getApplication();
		$params = new JParameter($actiondata->params);
		
		$contentParams =& $mainframe->getParams('com_content');
		$dispatcher =& JDispatcher::getInstance();
		$type = 'content';
		JPluginHelper::importPlugin($type);
		$context = '';
		$rowPlg = new stdClass();
		$rowPlg->text = $form->form_output;
		$results = $mainframe->triggerEvent('onContentPrepare', array($context, &$rowPlg, &$contentParams, 0));
		$form->form_output = $rowPlg->text;
    }
}
?>