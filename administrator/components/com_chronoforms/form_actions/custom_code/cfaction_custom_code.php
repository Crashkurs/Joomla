<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionCustomCodeHelper{
	function runCode($form, $actiondata){
		$params = new JParameter($actiondata->params);
		if($params->get('mode', 'controller') == 'view'){
			$message = $actiondata->content1;
			eval('?>'.$message);
		}
    }
}
?>