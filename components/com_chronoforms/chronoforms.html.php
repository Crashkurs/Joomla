<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
/* ensuring that this file is called up from another file */
defined('_JEXEC') or die('Restricted access');
require_once ( JPATH_BASE .DS.'includes'.DS.'defines.php' );
require_once ( JPATH_BASE .DS.'includes'.DS.'framework.php' );
$mainframe =& JFactory::getApplication('site');

class HTML_ChronoForms {
	function processView($form){
		$form_output = $form->form_output;
		if(empty($form->form_name)){
			$form->form_output = 'There is no form with this name!';
		}else{
			if(!empty($form->main_event_actions)){
				foreach($form->main_event_actions as $action => $actiondata){
					if($actiondata->type == '_STOP_'){
						break;
					}
					$viewFile = JPATH_SITE.DS."administrator".DS."components".DS."com_chronoforms".DS.'form_actions'.DS.$actiondata->type.DS.'cfaction_'.$actiondata->type.'.ctp';
					if(file_exists($viewFile)){
						ob_start();
						require($viewFile);
						$form->form_output .= ob_get_clean();
					}else{
						if(isset($actiondata->required) && ($actiondata->required == 1)){
							die('Action file is missing.');
						}
					}
				}
			}
		}
		echo $form->form_output;
	}
}
?>