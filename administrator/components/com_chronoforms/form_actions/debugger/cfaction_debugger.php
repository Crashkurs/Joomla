<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionDebuggerHelper{
	function display_debug_block($debug = array(), $title = "Debug Data"){
		if(!empty($debug)){
		?>
			<fieldset>
			<legend><?php echo $title; ?></legend>
			<ol>
			<?php foreach($debug as $k => $data): ?>
			<li>
			<?php
				if(is_array($data)){
					$this->display_debug_block($data, $k);
				}else{
					echo $data;
				}
			?>
			</li>
			<?php endforeach; ?>
			</ol>
			</fieldset>
		<?php
		}
	}
}
?>