<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
?>
<?php
class HTMLFormPostDataLoad extends JObject {
	var $validation_errors = array();
	
	
	function load($html_code, $data = array(), $params = array()){
		if(empty($data)){
			//return $html_code;
		}
		if(!is_object($params)){
			$params = new JParameter('');
		}
		$skippedarray = explode(",", $params->get('dataload_skip', ''));
		ob_start();
		eval( "?>".$html_code);
		$html_code = ob_get_clean();
		//get all fields names
		preg_match_all('/name=("|\')([^(>|"|\')]*?)("|\')/i', $html_code, $fieldsnamesmatches);
		$all_fields_names = array();
		foreach($fieldsnamesmatches[2] as $fieldsnamesmatche){
			if(strpos($fieldsnamesmatche, '[]')){
				$fieldsnamesmatche = str_replace('[]', '', $fieldsnamesmatche);
			}
			$all_fields_names[] = trim($fieldsnamesmatche);
		}
		$all_fields_names = array_unique($all_fields_names);
		//print_r($all_fields_names );
		/*
		foreach($all_fields_names as $field_name){
			if(!isset($data[$field_name])){
				//check if its an array
				if(strpos($field_name, '[') !== false){
					$data = $this->processArrayField($field_name, $data);
				}
			}else{
				if(is_array($data[$field_name])){
					$data[$field_name] = implode(', ', $data[$field_name]);
				}
				$data[$field_name] = htmlentities($data[$field_name], ENT_QUOTES, 'UTF-8');
			}
		}
		*/
		//end fields names
		//text/password fields
		$pattern_input = '/<input([^>]*?)type=("|\')(text|password)("|\')([^>]*?)>/is';
		$matches = array();
		preg_match_all($pattern_input, $html_code, $matches);
		foreach ( $matches[0] as $match ) {
			$pattern_value = '/value=("|\')(.*?)("|\')/i';
			$pattern_name = '/name=("|\')(.*?)("|\')/i';
			preg_match($pattern_name, $match, $matches_name);
			$field_value = $this->fieldValue($matches_name[2], $data);
			//check for multiple fields array
			if(is_array($field_value)){
				$single_value = array_shift($field_value);
				$data[str_replace("[]", '', $matches_name[2])] = $field_value;
				$field_value = $single_value;
				if(strlen($field_value) == 0){
					$field_value = "__CF_DEFAULT_VALUE_REMOVE__";
				}
			}
			$field_value_count = is_array($field_value) ? count($field_value) : strlen((string)$field_value);
			if(!in_array($matches_name[2], $skippedarray) && $field_value_count){
				$valuematch = preg_replace($pattern_value, '', $match);
				//fix if the value contains a dollar sign
				if(strpos($field_value, '$') !== false){
					$field_value = str_replace('$', '\\$', $field_value);
				}
				$namematch = preg_replace($pattern_name, 'name="${2}" value="'.htmlspecialchars($field_value).'"', $valuematch);
				$pos = strpos($html_code, $match);
				$html_code = substr_replace($html_code, $namematch, $pos, strlen($match));//('/'.preg_quote($match, '/').'/', $namematch, $html_code, 1);				
			}
		}
		$html_code = str_replace("__CF_DEFAULT_VALUE_REMOVE__", '', $html_code);
		//hidden fields
		$pattern_input = '/<input([^>]*?)type=("|\')hidden("|\')([^>]*?)>/is';
		$matches = array();
		preg_match_all($pattern_input, $html_code, $matches);
		foreach ($matches[0] as $match) {
			//make sure its not a ghost
			if(strpos($match, 'alt="ghost"') === false){
				$pattern_value = '/value=("|\')(.*?)("|\')/i';
				$pattern_name = '/name=("|\')(.*?)("|\')/i';
				preg_match($pattern_name, $match, $matches_name);
				$field_value = $this->fieldValue($matches_name[2], $data);
				$field_value_count = is_array($field_value) ? count($field_value) : strlen((string)$field_value);
				if(!in_array($matches_name[2], $skippedarray) && $field_value_count){
					$valuematch = preg_replace($pattern_value, '', $match);
					//fix if the value contains a dollar sign
					if(strpos($field_value, '$') !== false){
						$field_value = str_replace('$', '\\$', $field_value);
					}
					$namematch = preg_replace($pattern_name, 'name="${2}" value="'.htmlspecialchars($field_value).'"', $valuematch);
					$html_code = str_replace($match, $namematch, $html_code);
				}
			}
		}
		//checkboxes or radios fields
		$pattern_input = '/<input([^>]*?)type=("|\')(checkbox|radio)("|\')([^>]*?)>/is';
		$matches = array();
		preg_match_all($pattern_input, $html_code, $matches);
		foreach ($matches[0] as $match) {
			$pattern_value = '/value=("|\')(.*?)("|\')/i';
			$pattern_name = '/name=("|\')(.*?)("|\')/i';
			preg_match($pattern_name, $match, $matches_name);
			preg_match($pattern_value, $match, $matches_value);
			$field_name = str_replace('[]', '', $matches_name[2]);
			$field_value = $this->fieldValue($matches_name[2], $data);
			$field_value_count = is_array($field_value) ? count($field_value) : strlen((string)$field_value);
			if(!in_array($field_name, $skippedarray) && $field_value_count){
				$namematch = $match;
				//multi values
				if(is_array($field_value)){
					if(in_array($matches_value[2], $field_value)){
						$namematch = preg_replace($this->_cfskipregex($pattern_name), 'name="${2}" checked="checked"', $match);
					}else{
						//remove any default value set by default
						$pattern_checked = '/checked=("|\')checked("|\')/i';
						$namematch = preg_replace($pattern_checked, '', $match);
					}
				//single values
				}else{
					if($matches_value[2] == $field_value){
						$namematch = preg_replace($pattern_name, 'name="${2}" checked="checked"', $match);
					}else{
						//remove any default value set by default
						$pattern_checked = '/checked=("|\')checked("|\')/i';
						$namematch = preg_replace($pattern_checked, '', $match);
					}
				}
				$html_code = str_replace($match, $namematch, $html_code);
			}
		}
		//textarea fields
		$pattern_textarea = '/<textarea([^>]*?)>(.*?)<\/textarea>/is';
		$matches = array();
		preg_match_all($pattern_textarea, $html_code, $matches);
		$namematch = '';
		foreach ( $matches[0] as $match ) {
			$pattern_value = '/value=("|\')(.*?)("|\')/i';
			$pattern_name = '/name=("|\')(.*?)("|\')/i';
			preg_match($pattern_name, $match, $matches_name);
			$field_value = $this->fieldValue($matches_name[2], $data);
			$field_value_count = is_array($field_value) ? count($field_value) : strlen((string)$field_value);
			if(!in_array($matches_name[2], $skippedarray) && $field_value_count){
				$pattern_textarea2 = '/(<textarea(.*?)>)(.*?)(<\/textarea>)/is';
				//fix if the value contains a dollar sign
				if(strpos($field_value, '$') !== false){
					$field_value = str_replace('$', '\\$', $field_value);
				}
				$newtextarea_match = preg_replace($pattern_textarea2, '${1}'.htmlspecialchars($field_value).'${4}', $match);
				$html_code = str_replace($match, $newtextarea_match, $html_code);
			}
		}
		//select boxes
		$pattern_select = '/<select(.*?)select>/is';
		$matches = array();
		preg_match_all($pattern_select, $html_code, $matches);

		foreach ($matches[0] as $match) {
			$selectmatch = $match;
			$pattern_select2 = '/<select([^>]*?)>/is';
			preg_match_all($pattern_select2, $match, $matches2);
			$options = preg_replace(array('/'.$this->_cfskipregex($matches2[0][0]).'/is', '/<\/select>/i'), array('', ''), $match);

			$pattern_name = '/name=("|\')(.*?)("|\')/i';
			preg_match($pattern_name, $matches2[0][0], $matches_name);
			$field_name = str_replace('[]', '', $matches_name[2]);
			$field_value = $this->fieldValue($matches_name[2], $data);
			
			$field_value_count = is_array($field_value) ? count($field_value) : strlen((string)$field_value);
			if(!in_array($field_name, $skippedarray) && $field_value_count){
				//multi select
				if(strpos($matches2[0][0], 'multiple') !== false){
					$pattern_options = '/<option(.*?)<\/option>/is';
					preg_match_all($pattern_options, $options, $matches_options);
					foreach($matches_options[0] as $matches_option){
						$pattern_value = '/value=("|\')(.*?)("|\')/i';
						preg_match($pattern_value, $matches_option, $matches_value);
						$optionmatch = $matches_option;
						if(in_array($matches_value[2], $field_value)){
							$optionmatch = preg_replace('/<option/i', '<option selected="selected"', $matches_option);
						}else{
							$optionmatch = preg_replace('/<option(.*?)>/is', '<option value="'.$matches_value[2].'">', $matches_option);
						}
						$selectmatch = str_replace($matches_option, $optionmatch, $selectmatch);
					}
				//single select
				}else{
					//check for multiple selects
					if(is_array($field_value)){
						$single_value = array_shift($field_value);
						$data[str_replace("[]", '', $matches_name[2])] = $field_value;
						$field_value = $single_value;
					}
					$pattern_options = '/<option(.*?)<\/option>/is';
					preg_match_all($pattern_options, $options, $matches_options);
					foreach($matches_options[0] as $matches_option){
						$pattern_value = '/value=("|\')(.*?)("|\')/i';
						preg_match($pattern_value, $matches_option, $matches_value);
						$optionmatch = $matches_option;
						if(isset($matches_value[2]) && $matches_value[2] == $field_value){
							$optionmatch = preg_replace('/<option/i', '<option selected="selected"', $matches_option);
						}else{
							$optionmatch = preg_replace('/<option(.*?)>/is', '<option value="'.$matches_value[2].'">', $matches_option);
						}
						$selectmatch = str_replace($matches_option, $optionmatch, $selectmatch);
					}
				}
				//$html_code = str_replace($match, $selectmatch, $html_code);
				$pos = strpos($html_code, $match);
				$html_code = substr_replace($html_code, $selectmatch, $pos, strlen($match));
			}
		}
		
		ob_start();
		eval( "?>".$html_code);
		$html_code = ob_get_clean();
		return $html_code;
	}
	
	function fieldValue($field_name, $data = array()){
		$field_name = str_replace('[]', '', $field_name);
		$value = '';
		if(!isset($data[$field_name])){
			//check if its an array
			if(strpos($field_name, '[') !== false){
				$value = $this->_processArrayField($field_name, $data);
			}
		}else{
			/*if(is_array($data[$field_name])){
				$value = implode(', ', $data[$field_name]);
			}
			$value = htmlentities($data[$field_name], ENT_QUOTES, 'UTF-8');*/
			$value = $data[$field_name];
		}
		return $value;
	}
	
	function _processArrayField($field_name, $data = array()){
		$pieces = explode('[', $field_name);
		$value = '';
		if(isset($data[str_replace(']', '', $pieces[0])])){			
			$path = $data[str_replace(']', '', $pieces[0])];
			//remove the main field name
			unset($pieces[0]);
			foreach($pieces as $piece){
				if(isset($path[str_replace(']', '', $piece)])){
					$value = $path = $path[str_replace(']', '', $piece)];
				}else{
					$value = '';
				}
			}
		}
		return $value;
	}
	
	function _cfskipregex($regex){
		$reserved = array('[', ']');
		$replace = array('\[', '\]');
		return str_replace($reserved, $replace, $regex);
	}
}
?>