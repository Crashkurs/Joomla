<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class ChronoFormsInputTextarea{
	function load($clear){
		if($clear){
			$element_params = array(
								'label_for' => 'input_textarea_{n}',
								'label_id' => 'input_textarea_{n}_label',
								'label_text' => 'Label Text',
								'hide_label' => '0',
								'label_over' => '0',
								'multiline_start' => '0',
								'multiline_add' => '0',
								'wysiwyg_editor' => '0',
								'editor_buttons' => '1',
								'editor_width' => '400',
								'editor_height' => '200',
								'input_name' => 'input_textarea_{n}',
								'input_id' => '',
								'input_value' => '',
								'input_class' => '',
								'input_title' => '',
								'validations' => '',
								'instructions' => '',
								'input_rows' => '12',
								'tooltip' => '',
								'input_cols' => '45');
		}
		return array('element_params' => $element_params);
	}
	
	function save($formdata_element = array(), $field_header = '', $formcontent_item_array = array()){
		$formcontent_item_array['id'] = $formdata_element[$field_header.'_input_id'];
		$formcontent_item_array['default'] = $formdata_element[$field_header.'_input_value'];
		$formcontent_item_array['cols'] = $formdata_element[$field_header.'_input_cols'];
		$formcontent_item_array['rows'] = $formdata_element[$field_header.'_input_rows'];
		$formcontent_item_array['class'] = $formdata_element[$field_header.'_input_class'];
		$formcontent_item_array['title'] = $formdata_element[$field_header.'_input_title'];
		$formcontent_item_array['label_over'] = $formdata_element[$field_header.'_label_over'];
		$formcontent_item_array['hide_label'] = $formdata_element[$field_header.'_hide_label'];
		$formcontent_item_array['multiline_start'] = $formdata_element[$field_header.'_multiline_start'];
		$formcontent_item_array['multiline_add'] = $formdata_element[$field_header.'_multiline_add'];
		$formcontent_item_array['validations'] = $formdata_element[$field_header.'_validations'];
		$formcontent_item_array['smalldesc'] = $formdata_element[$field_header.'_instructions'];
		$formcontent_item_array['tooltip'] = $formdata_element[$field_header.'_tooltip'];
		$formcontent_item_array['wysiwyg_editor'] = $formdata_element[$field_header.'_wysiwyg_editor'];
		$formcontent_item_array['editor_buttons'] = $formdata_element[$field_header.'_editor_buttons'];
		$formcontent_item_array['editor_width'] = $formdata_element[$field_header.'_editor_width'];
		$formcontent_item_array['editor_height'] = $formdata_element[$field_header.'_editor_height'];
		$formcontent_item_array['type'] = $formdata_element['type'];
		return $formcontent_item_array;
	}
}
?>