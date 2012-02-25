<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class ChronoFormsInputCustom{
	function load($clear){
		if($clear){
			$element_params = array(
								'label_for' => 'input_custom_{n}',
								'label_id' => 'input_custom_{n}_label',
								'label_text' => 'Label Text',
								'hide_label' => '0',
								'input_name' => 'input_custom_{n}',
								'input_id' => 'input_id_{n}',
								'instructions' => '',
								'tooltip' => '',
								'code' => '',
								'clean' => '',
								);
		}
		return array('element_params' => $element_params);
	}
}
?>