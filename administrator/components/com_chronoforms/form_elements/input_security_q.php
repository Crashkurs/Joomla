<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class ChronoFormsInputSecurityQ{
	var $advanced = true;
	function load($clear){
		if($clear){
			$element_params = array(
								'label_for' => 'input_security_q_{n}',
								'label_id' => 'input_security_q_{n}_label',
								'label_text' => '{chrono_security_question}',
								'hide_label' => '0',
								'input_name' => 'chrono_security_answer',
								'input_id' => '',
								'input_title' => '',
								'input_value' => '',
								'input_maxlength' => '150',
								'input_class' => '',
								'label_over' => '0',
								'validations' => '',
								'instructions' => '',
								'tooltip' => '',
								'input_size' => '30');
		}
		return array('element_params' => $element_params);
	}
}
?>