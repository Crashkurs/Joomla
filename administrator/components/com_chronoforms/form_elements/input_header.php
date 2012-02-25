<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class ChronoFormsInputHeader{
	function load($clear){
		if($clear){
			$element_params = array(
								'code' => '',
								'clean' => 0,
								'multiline_start' => '0',
								'multiline_add' => '0',
								);
		}
		return array('element_params' => $element_params);
	}
}
?>