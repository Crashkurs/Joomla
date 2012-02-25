<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class ChronoFormsInputCaptcha{
	function load($clear){
		if($clear){
			$element_params = array(
								'label_for' => 'input_captcha_{n}',
								'label_id' => 'input_captcha_{n}_label',
								'label_text' => 'Enter the code',
								'hide_label' => '0',
								'input_name' => 'chrono_verification',
								'input_id' => '',
								'input_title' => '',
								'input_value' => '',
								'input_maxlength' => '5',
								'input_class' => 'chrono_captcha_input',
								'label_over' => '0',
								'validations' => '',
								'instructions' => '',
								'tooltip' => '',
								'input_size' => '5');
		}
		return array('element_params' => $element_params);
	}
}
?>