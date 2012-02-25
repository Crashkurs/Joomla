<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionConfirmationPageHelper{
	function loadAction($form, $actiondata){
		$params = new JParameter($actiondata->params);
		$output = '<form action="'.$this->selfURL().'" method="post">';
		$output .= $actiondata->content1;
		if(!isset($_POST['confirmation_page'])){
			$buttons_code = '
			<button type="submit" name="confirmation_page" value="_confirm">Submit</button>
			<button type="submit" name="confirmation_page" value="_back">Cancel</button>
			';
			if((int)$params->get('buttons', 1) == 1){
				$output .= $buttons_code;
			}
			ob_start();
			eval("?>".$output);
			$output = ob_get_clean();
			$output .= '</form>';
			return $form->curly_replacer($output, $form->data);
		}
    }
	
	function selfURL(){
		$uri =& JURI::getInstance();
		$inbetween = '';
		if($uri->getQuery())$inbetween = '?';
		return $uri->current().$inbetween.$uri->getQuery();
	}
}
?>