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
class HTMLFormPostDisplayErrors extends JObject {
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
		
		if(!empty($this->validation_errors)){
			foreach($this->validation_errors as $fname => $error){
				$pattern_error_div = '/<div([^>]*?)id=("|\')error-message-'.$fname.'("|\')([^>]*?)>([^<\/div>]*?)<\/div>/is';
				if(is_array($error)){
					$error = "<ol><li>".implode("</li><li>", $error)."</li></ol>";
				}
				$html_code = preg_replace($pattern_error_div, '<div class="error-message">'.$error.'</div>', $html_code);
			}
		}

		return $html_code;
	}
	
	function _cfskipregex($regex){
		$reserved = array('[', ']');
		$replace = array('\[', '\]');
		return str_replace($reserved, $replace, $regex);
	}
}
?>