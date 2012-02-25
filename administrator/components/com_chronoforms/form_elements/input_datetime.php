<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class ChronoFormsInputDatetime{
	function load($clear){
		if($clear){
			$element_params = array(
								'label_for' => 'input_datetime_{n}',
								'label_id' => 'input_datetime_{n}_label',
								'label_text' => 'Select date',
								'hide_label' => '0',
								'label_over' => '0',
								'multiline_start' => '0',
								'multiline_add' => '0',
								'input_name' => 'input_datetime_{n}',
								'input_id' => '',
								'input_value' => '',
								'input_class' => '',
								'input_title' => '',
								'input_maxlength' => '150',
								'validations' => '',
								'instructions' => '',
								'tooltip' => '',
								'addtime' => 0,
								'timeonly' => 0,
								'input_size' => '16');
		}
		return array('element_params' => $element_params);
	}
}
?>