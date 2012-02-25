<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionShowThanksMessageHelper{
	function show($form, $actiondata){
		$params = new JParameter($actiondata->params);
		$message = $actiondata->content1;
		//build template from defined fields and posted fields
		return $form->curly_replacer($message, $form->data);
    }
}
?>