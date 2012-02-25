<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class ChronoFormsInputRadio{
	function load($clear){
		if($clear){
			$element_params = array(
								'label_for' => 'input_radio_{n}',
								'label_id' => 'input_radio_{n}_label',
								'label_text' => 'Label Text',
								'hide_label' => '0',
								'label_over' => '0',
								'multiline_start' => '0',
								'multiline_add' => '0',
								'radios_over' => '0',
								'input_name' => 'input_radio_{n}',
								'input_id' => '',
								'ghost' => '1',
								'ghost_value' => '',
								'input_title' => '',
								'input_value' => '',
								'options' => 'No=No'."\n".'Yes=Yes',
								'legend' => '',
								'validations' => '',
								'tooltip' => '',
								'instructions' => '');
		}
		return array('element_params' => $element_params);
	}
	
	function save($formdata_element = array(), $field_header = '', $formcontent_item_array = array()){
		if(!empty($formdata_element[$field_header.'_input_value'])){
			$formcontent_item_array['value'] = $formdata_element[$field_header.'_input_value'];
		}
		$temp_options = explode("\n", $formdata_element[$field_header.'_options']);
		foreach($temp_options as $temp_option){
			$temp_option_details = explode('=', $temp_option);
			$formcontent_item_array['options'][strval($temp_option_details[0])] = trim($temp_option_details[1]);
		}
		$formcontent_item_array['legend'] = $formdata_element[$field_header.'_legend'];
		$formcontent_item_array['id'] = $formdata_element[$field_header.'_input_id'];
		$formcontent_item_array['ghost'] = $formdata_element[$field_header.'_ghost'];
		$formcontent_item_array['ghost_value'] = $formdata_element[$field_header.'_ghost_value'];
		$formcontent_item_array['label_over'] = $formdata_element[$field_header.'_label_over'];
		$formcontent_item_array['hide_label'] = $formdata_element[$field_header.'_hide_label'];
		$formcontent_item_array['multiline_start'] = $formdata_element[$field_header.'_multiline_start'];
		$formcontent_item_array['multiline_add'] = $formdata_element[$field_header.'_multiline_add'];
		$formcontent_item_array['radios_over'] = $formdata_element[$field_header.'_radios_over'];
		$formcontent_item_array['title'] = $formdata_element[$field_header.'_input_title'];
		$formcontent_item_array['validations'] = $formdata_element[$field_header.'_validations'];
		$formcontent_item_array['smalldesc'] = $formdata_element[$field_header.'_instructions'];
		$formcontent_item_array['tooltip'] = $formdata_element[$field_header.'_tooltip'];
		$formcontent_item_array['type'] = $formdata_element['type'];
		return $formcontent_item_array;
	}
}
?>