<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class ChronoFormsInputPanelStart{
	var $advanced = true;
	function load($clear){
		if($clear){
			$element_params = array(
								'panel_id' => 'panel_{n}',
								'panel_label' => 'Example Panel {n}'
								);
		}
		return array('element_params' => $element_params);
	}
}
?>