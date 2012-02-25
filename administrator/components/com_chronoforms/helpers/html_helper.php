<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class HtmlHelper {
	var $data;
	
	function __construct(){
		
	}
	
	function url($link = array()){
		$output = '';
		if(is_array($link) && !empty($link)){
			$params = array();
			foreach($link as $param => $value){
				if($param == '#'){
					$params[] = $param.''.$value;
				}else{
					$params[] = $param.'='.$value;
				}
			}
			$output = implode("&amp;", $params);
			$output = "index.php?".$output;			
		}
		return $output;
	}
	
	function link($text = '', $link = array(), $html = array()){
		$output = '';
		if(is_array($link) && !empty($link)){
			$params = array();
			foreach($link as $param => $value){
				if($param == '#'){
					$params[] = $param.''.$value;
				}else{
					$params[] = $param.'='.$value;
				}
			}
			$output = implode("&amp;", $params);
			$output = "index.php?".$output;
			$output = '<a href="'.$output.'" ';
			foreach($html as $tag => $val){
				if($tag == '#'){
					$output .= $tag.''.$val.' ';
				}else{
					$output .= $tag.'="'.$val.'" ';
				}
			}
			$output .= '>'.$text.'</a>';
		}
		return $output;
	}
	
	function image($path = '', $html = array('border' => 0), $link = array()){
		$output = '';
		$output = '<img src="'.$path.'" ';
		if(!isset($html['border'])){
			$html['border'] = 0;
		}
		foreach($html as $tag => $val){
			$output .= $tag.'="'.$val.'" ';
		}
		$output .= ' />';
		if(is_array($link) && !empty($link)){
			$output = $this->link($output, $link);
		}
		return $output;
	}
	
	function input($fieldname = '', $fieldoptions = array(), $do_replacements = false){
		$output = '';
		$tag = array();
		if(!isset($fieldoptions['type'])){
			$fieldoptions['type'] = 'text';
			$fieldoptions['tag'] = 'input';			
		}
		$tag['type'] = $fieldoptions['type'];
		$tag['name'] = $fieldname;
		//fix the quotes in the values
		if(isset($fieldoptions['value'])){
			$fieldoptions['value'] = str_replace('"', "'", $fieldoptions['value']);
		}
		
		//prepare validation classes
    	if(isset($fieldoptions['validations']) && !empty($fieldoptions['validations'])){
    		$validation_classes = explode(",", $fieldoptions['validations']);
    		$validation_classes = array_map('trim', $validation_classes);
    		if($fieldoptions['type'] == 'checkbox_group'){
    			//$validation_classes = array('%checkSelection');
    		}
    		$field_class = array();
    		if(isset($fieldoptions['class'])){
    			$field_class = array($fieldoptions['class']);
    		}
    		$field_class[] = "validate['".implode("','", $validation_classes)."']";
			$fieldoptions['class'] = implode(' ', $field_class);
			unset($fieldoptions['validations']);
		}else{
			unset($fieldoptions['validations']);
		}
		//set id if not set
		if(!isset($fieldoptions['id'])){
			$fieldoptions['id'] = $this->slug($fieldname);
		}
		//reset id if empty
		if(isset($fieldoptions['id']) && !strlen(trim($fieldoptions['id']))){
			unset($fieldoptions['id']);
		}
		//apply the label class
		if(isset($fieldoptions['label']) && !is_array($fieldoptions['label']) && ($fieldoptions['label'] !== false)){
			$fieldoptions['label'] = array('text' => $fieldoptions['label']);
		}
		if(!isset($fieldoptions['label'])){
			$fieldoptions['label'] = false;
		}
		//check if radio to add the div
    	/*if(isset($fieldoptions['type']) && ($fieldoptions['type'] == 'radio') && isset($fieldoptions['label']['text']) && strlen($fieldoptions['label']['text'])){
			$fieldoptions['before'] = '<lable class="ccms_form_label">'.$fieldoptions['label']['text'].'</label>';
    		if(!isset($fieldoptions['legend'])){
    			$fieldoptions['legend'] = false;
    		}
		}*/
		//prepare the tooltips
    	if(isset($fieldoptions['tooltip'])){
    		if(strlen(trim($fieldoptions['tooltip']))){
	    		if(!isset($fieldoptions['after'])){
	    			$fieldoptions['after'] = '';
	    		}
	    		//$tiplink = '<a href="#" title="'.$fieldoptions['label']['text'].'::'.$fieldoptions['tooltip'].'">?</a>';
				$tiplink = '<a href="#">?</a>';
				$fieldoptions['after'] .= '<div title="'.$fieldoptions['label']['text'].'" rel="'.nl2br($fieldoptions['tooltip']).'" class="tooltipimg">'.$tiplink.'</div>';
    		}
			unset($fieldoptions['tooltip']);
		}
    	//prepare the descriptions
    	if(isset($fieldoptions['smalldesc'])){
    		if(strlen(trim($fieldoptions['smalldesc']))){
	    		if(!isset($fieldoptions['after'])){
	    			$fieldoptions['after'] = '';
	    		}
				$fieldoptions['after'] .= '<div class="small-message">'.nl2br($fieldoptions['smalldesc']).'</div>';
    		}
			unset($fieldoptions['smalldesc']);
		}
		//add clear div
		if(!isset($fieldoptions['after'])){
    		$fieldoptions['after'] = '';
    	}
		$fieldoptions['after'] .= '<div class="clear"></div>';
		$fieldoptions['after'] .= '<div id="error-message-'.str_replace('[]', '', $fieldname).'"></div>';
		//set container div options
    	if(!isset($fieldoptions['type'])){
			$fieldoptions['type'] = 'text';
		}
		$div_class = array();
		$div_class[] = 'ccms_form_element';
		$etype = $fieldoptions['type'];
		if(isset($fieldoptions['multiple']) && $fieldoptions['multiple'] == 'checkbox'){
			$etype = 'checkboxgroup';
		}
		$div_class[] = 'cfdiv_'.$etype;
		
		if(isset($fieldoptions['label_over']) && $fieldoptions['label_over'] == true){
			$div_class[] = 'label_over';
			unset($fieldoptions['label_over']);
		}
		if(isset($fieldoptions['label_over'])){
			unset($fieldoptions['label_over']);
		}
		
		$hide_label = false;
		if(isset($fieldoptions['hide_label'])){
			$hide_label = (bool)$fieldoptions['hide_label'];
			unset($fieldoptions['hide_label']);
		}
		
    	if(isset($fieldoptions['radios_over'])){
			if($fieldoptions['radios_over'] == true){
				$div_class[] = 'radios_over';
			}
			unset($fieldoptions['radios_over']);
		}
		
		if(isset($fieldoptions['multiline_start'])){
			if($fieldoptions['multiline_start'] == true){
				$div_class[] = 'multiline_start';
			}
			unset($fieldoptions['multiline_start']);
		}
		if(isset($fieldoptions['multiline_add'])){
			if($fieldoptions['multiline_add'] == true){
				$div_class[] = 'multiline_add';
			}
			unset($fieldoptions['multiline_add']);
		}
		
		if(!isset($fieldoptions['div'])){
			$fieldoptions['div'] = array();
		}
		$div_prefix = (isset($fieldoptions['id']) && strlen(trim($fieldoptions['id'])) > 0) ? $this->slug($fieldoptions['id']) : 'autoID-'.md5($fieldname.'-'.rand(11111, 99999));
		$divContainer = array_merge($fieldoptions['div'], array('id' => $div_prefix.'_container_div', 'class' => implode(' ', $div_class)));
		unset($fieldoptions['div']);
		//add before prefix
		$beforeOutput = '';
		if(isset($fieldoptions['before'])){
    		$beforeOutput = $fieldoptions['before'];
			unset($fieldoptions['before']);
    	}
		//add after prefix
		$afterOutput = '';
		if(isset($fieldoptions['after'])){
    		$afterOutput = $fieldoptions['after'];
			unset($fieldoptions['after']);
    	}
		
		if(isset($fieldoptions['default']) && (!isset($fieldoptions['value']) || (is_string($fieldoptions['value']) && strlen($fieldoptions['value']) == 0))){
			$field_value = $fieldoptions['default'];
			unset($fieldoptions['default']);
		}
		
		//check form data
		if(isset($this->data) && !empty($this->data)){
			if(is_array($this->data)){
				if(isset($this->data[$fieldname])){
					$field_value = htmlspecialchars($this->data[$fieldname]);
				}
			}else if(is_object($this->data)){
				if(isset($this->data->$fieldname)){
					$field_value = htmlspecialchars($this->data->$fieldname);
				}
			}
		}
		
		if(isset($field_value)){
			$fieldoptions['value'] = $field_value;
		}
		
		//merge tag with fieldoptions
		$tag = array_merge($fieldoptions, $tag);
		if(isset($tag['label'])){
			unset($tag['label']);
		}
		//print_r2($fieldoptions);
		switch($fieldoptions['type']){			
			case 'submit':
				unset($fieldoptions['value']);
				$output .= '<input';
				foreach($tag as $k => $v){
					if(in_array($k, array('reset_button', 'reset_button_value', 'back_button', 'back_button_value'))){
						continue;
					}
					$output .= ' '.$k.'="'.$v.'"';
				}
				$output .= ' />'."\n";
				if(isset($tag['reset_button']) && (bool)$tag['reset_button'] === true){
					$output .= "&nbsp;<input type='reset' name='reset' value='".$tag['reset_button_value']."' />";
				}
				if(isset($tag['back_button']) && (bool)$tag['back_button'] === true){
					$output .= "&nbsp;<input type='button' name='back' value='".$tag['back_button_value']."' onclick='history.back()' />";
				}
				unset($fieldoptions['label']);
				break;
			case 'textarea':
				$value = '';
				if(isset($tag['value'])){
					$value = $tag['value'];
					unset($tag['value']);
				}
				if(isset($tag['type'])){
					unset($tag['type']);
				}
				if(isset($tag['wysiwyg_editor']) && $tag['wysiwyg_editor'] == 1){					
					$output .= "<?php \$editor =& JFactory::getEditor(); echo \$editor->display('".$fieldname."', '".$value."', ".$fieldoptions['editor_width'].", ".$fieldoptions['editor_height'].", ".$fieldoptions['rows'].", ".$fieldoptions['cols'].", ".$fieldoptions['editor_buttons']."); ?>";
				} else {
					$output .= '<textarea';
					foreach($tag as $k => $v){
						if(in_array($k, array('wysiwyg_editor', 'editor_width', 'editor_height', 'editor_buttons'))){
							continue;
						}
						$output .= ' '.$k.'="'.$v.'"';
					}
					$output .= '>'.$value.'</textarea>'."\n";
				}
				break;
			case 'select':
				if(isset($fieldoptions['value'])){
					if(!empty($fieldoptions['value'])){
						$tag['selected'] = $fieldoptions['value'];
					}
					unset($fieldoptions['value']);
				}
				$output .= '<select';
				$options = array();
				if(isset($tag['options']) && is_array($tag['options'])){
					$options = $tag['options'];
					unset($tag['options']);
					$selected = '';
					if(isset($tag['selected'])){
						$selected = $tag['selected'];
						unset($tag['selected']);
					}
					if(!is_array($selected)){
						$selected = array($selected);
					}
				}
				$empty = false;
				if(isset($tag['empty'])){
					if(!empty($tag['empty']))
					$empty = '<option value="">'.$tag['empty'].'</option>'."\n";
					unset($tag['empty']);
				}
				if(isset($tag['multiple']) && $tag['multiple'] == 1){
					$tag['multiple'] = 'multiple';
					if(strpos($tag['name'], '[]') === false){
						$tag['name'] = $tag['name'].'[]';
					}
				}
				if(isset($tag['type'])){
					unset($tag['type']);
				}
				foreach($tag as $k => $v){
					$output .= ' '.$k.'="'.$v.'"';
				}
				$output .= '>'."\n";
				if($empty){
					$output .= $empty;
				}
				foreach($options as $k => $option){
					$output .= '<option value="'.$k.'"'.(in_array($k, $selected) ? ' selected="selected"' : '').'>'.$option.'</option>'."\n";
				}
				$output .= '</select>'."\n";
				break;
			case 'radio':
				$checked_value = null;
				if(isset($fieldoptions['value'])){
					$checked_value = $fieldoptions['value'];
				}
				unset($fieldoptions['value']);
				$options = array();
				if(isset($tag['options']) && is_array($tag['options'])){
					$options = $tag['options'];
					unset($tag['options']);
				}
				if(isset($tag['ghost'])){
					if((bool)$tag['ghost'] === true){
						$output .= '<input type="hidden" name="'.$fieldname.'" value="'.$tag['ghost_value'].'" alt="ghost" />'."\n";
					}
					unset($tag['ghost']);
					unset($tag['ghost_value']);
				}
				$output .= '<div style="float:left; clear:none;">';
				foreach($options as $k => $option){
					$output .= '<input type="'.$fieldoptions['type'].'" name="'.$fieldname.'" id="'.$this->slug($fieldname.'-'.$k).'" title="'.$tag['title'].'" value="'.$k.'"'.(($k == $checked_value) ? ' checked="checked"' : '').' class="'.$tag['class'].'" />'."\n";
					$output .= '<label for="'.$this->slug($fieldname.'-'.$k).'">'.$option.'</label>'."\n";
				}
				$output .= '</div>';
				break;
			case 'checkbox_group':
				unset($fieldoptions['value']);
				$fieldoptions['type'] = 'checkbox';
				$options = array();
				if(isset($tag['options']) && is_array($tag['options'])){
					$options = $tag['options'];
					unset($tag['options']);
					$checked = false;
					if(isset($tag['selected'])){
						$checked = explode(",", $tag['selected']);
						unset($tag['selected']);
					}
				}
				if(isset($tag['ghost'])){
					if((bool)$tag['ghost'] === true){
						$output .= '<input type="hidden" name="'.$fieldname.'" value="'.$tag['ghost_value'].'" alt="ghost" />'."\n";
					}
					unset($tag['ghost']);
					unset($tag['ghost_value']);
				}
				$output .= '<div style="float:left; clear:none;">';
				foreach($options as $k => $option){
					$output .= '<input type="'.$fieldoptions['type'].'" name="'.$fieldname.'[]" id="'.$this->slug($fieldname.'-'.$k).'" title="'.$tag['title'].'" value="'.$k.'"'.(in_array($k, $checked) ? ' checked="checked"' : '').' class="'.$tag['class'].'" />'."\n";
					$output .= '<label for="'.$this->slug($fieldname.'-'.$k).'">'.$option.'</label>'."\n";
				}
				$output .= '</div>';
				break;
			case 'checkbox':
				if(isset($tag['checked'])){
					if((bool)$tag['checked'] === true){
						$tag['checked'] = 'checked';
					}else{
						unset($tag['checked']);
					}
				}
				if(!isset($fieldoptions['id']) || empty($fieldoptions['id'])){
					$tag['id'] = $fieldoptions['id'] = $this->slug($fieldname);
				}
				if(isset($tag['ghost'])){
					if((bool)$tag['ghost'] === true){
						$output .= '<input type="hidden" name="'.$fieldname.'" value="'.$tag['ghost_value'].'" alt="ghost" />'."\n";
					}
					unset($tag['ghost']);
					unset($tag['ghost_value']);
				}
				$full_label = false;
				if(isset($tag['label_position']) && !empty($tag['label_position'])){
					if($tag['label_position'] == 'right'){
						$full_label = true;
					}
					$tag['class'] = strlen($tag['class']) ? $tag['class'].' label_'.$tag['label_position'] : 'label_'.$tag['label_position'];
				}
				unset($tag['label_position']);
				
				$output .= '<input';
				foreach($tag as $k => $v){
					$output .= ' '.$k.'="'.$v.'"';
				}
				$output .= ' />'."\n";
				if(isset($fieldoptions['label']) && $fieldoptions['label'] !== false){
					$class = '';
					if($full_label){
						$class = ' class="full_label"';
					}
					$afterOutput = '<label'.(isset($fieldoptions['id']) ? ' for="'.$fieldoptions['id'].'"' : '').$class.'>'.$fieldoptions['label']['text'].'</label>'.$afterOutput;
					unset($fieldoptions['label']);
				}
				break;
			case 'hidden':
				$output .= '<input';
				foreach($tag as $k => $v){
					$output .= ' '.$k.'="'.$v.'"';
				}
				$output .= ' />'."\n";
				$divContainer = '';
				break;
			case 'datetime':
				if(isset($tag['timeonly']) && (int)$tag['timeonly'] == 1){
					$tag['class'] = empty($tag['class']) ? 'cf_time_picker' : $tag['class'].' cf_time_picker';
				}
				if(isset($tag['addtime']) && (int)$tag['addtime'] == 1 && (int)$tag['timeonly'] == 0){
					$tag['class'] = empty($tag['class']) ? 'cf_datetime_picker' : $tag['class'].' cf_datetime_picker';
				}
				if((int)$tag['timeonly'] == 0 && (int)$tag['addtime'] == 0){
					$tag['class'] = empty($tag['class']) ? 'cf_date_picker' : $tag['class'].' cf_date_picker';
				}
				if(isset($tag['timeonly']))unset($tag['timeonly']);
				if(isset($tag['addtime']))unset($tag['addtime']);
				unset($tag['tag']);
				$tag['type'] = 'text';
				$output .= '<input';
				foreach($tag as $k => $v){
					$output .= ' '.$k.'="'.$v.'"';
				}
				$output .= ' />'."\n";
				break;
			case 'custom':
				$output = $tag['code'];
				if((int)$tag['clean'] == 1){
					$divContainer = '';
					$beforeOutput = '';
					$afterOutput = '';
				}
				break;
			case 'header':
				$output = $tag['code'];
				//$divContainer['id'] = md5($this->slug($tag['code'])).$divContainer['id'];
				$afterOutput = '<div class="clear"></div>';
				if((int)$tag['clean'] == 1){
					$divContainer = '';
					$beforeOutput = '';
					$afterOutput = '';
				}
				break;
			case 'page_break':
				$output = "<!--_CHRONOFORMS_PAGE_BREAK_-->";
				$divContainer = '';
				$beforeOutput = '';
				$afterOutput = '';
				break;
			case 'pane_start':
				if($tag['pane_type'] == 'sliders'){
					$start_s = "startTransition";
				}else{
					$start_s = "startOffset";
				}
				$output = "\n".'<div class="ccms_form_element">
							<?php
								jimport("joomla.html.pane");
								$pane =& JPane::getInstance("'.$tag['pane_type'].'", array("'.$start_s.'" => '.$tag['pane_start'].'));
								echo $pane->startPane("'.$tag['pane_id'].'");
							?>'."\n";
				$divContainer = '';
				$beforeOutput = '';
				$afterOutput = '';
				break;
			case 'panel_start':
				$output = "\n".'<?php echo $pane->startPanel("'.$tag['panel_label'].'", "'.$tag['panel_id'].'"); ?>'."\n";
				$divContainer = '';
				$beforeOutput = '';
				$afterOutput = '';
				break;
			case 'panel_end':
				$output = "\n".'<?php echo $pane->endPanel(); ?>'."\n";
				$divContainer = '';
				$beforeOutput = '';
				$afterOutput = '';
				break;
			case 'pane_end':
				$output = "\n".'<?php echo $pane->endPane(); ?>
							<div class="clear"></div>
						</div>'."\n";
				$divContainer = '';
				$beforeOutput = '';
				$afterOutput = '';
				break;
			case 'file':
				if(isset($tag['ghost'])){
					if((bool)$tag['ghost'] === true){
						$output .= '<input type="hidden" name="'.$fieldname.'" value="'.$tag['ghost_value'].'" alt="ghost" />'."\n";
					}
					unset($tag['ghost']);
					unset($tag['ghost_value']);
				}
				$output .= '<input';
				foreach($tag as $k => $v){
					$output .= ' '.$k.'="'.$v.'"';
				}
				$output .= ' />'."\n";
				break;
			case 'text':
			case 'password':
			default:
				$output .= '<input';
				foreach($tag as $k => $v){
					$output .= ' '.$k.'="'.$v.'"';
				}
				$output .= ' />'."\n";
				break;
		}
		
		if(isset($fieldoptions['label']) && $fieldoptions['label'] !== false){
			$beforeOutput .= '<label'.(isset($fieldoptions['id']) ? ' for="'.$fieldoptions['id'].'"' : '').(($hide_label) ? ' style="display:none;"' : '').'>'.$fieldoptions['label']['text'].'</label>';
			unset($fieldoptions['label']);
		}		
		
		if(!empty($divContainer)){
			$output = '<div class="'.$divContainer['class'].'" id="'.$divContainer['id'].'">'.$beforeOutput.$output.$afterOutput.'</div>';
		}
		
		if($do_replacements){
			//do replacements
			$output = str_replace('%field_name%', $tag['name'], $output);
		}
		
		return $output;
	}
	
	function slug($str, $replacer = "_"){
		$str = strtolower(trim($str));
		$str = preg_replace('/[^a-z0-9{}'.$replacer.']/', $replacer, $str);
		$str = preg_replace('/'.$replacer.'+/', $replacer, $str);
		return $str;
	}
}