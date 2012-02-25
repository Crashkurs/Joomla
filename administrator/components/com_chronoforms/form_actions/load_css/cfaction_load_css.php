<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionLoadCssHelper{
	function load($form = null, $actiondata = null){
		$output = '';
		$document =& JFactory::getDocument();
		ob_start();
		eval('?>'.$actiondata->content1);
		$output .= ob_get_clean();
		ob_start();
		?>
		<?php echo trim($output); ?>
		<?php
		$script = ob_get_clean();
		$document->addStyleDeclaration($script);
	}
}
?>