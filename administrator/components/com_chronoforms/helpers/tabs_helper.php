<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class TabsHelper {
	var $prefix = '';
	var $active = '';
	
	function __construct(){
		
	}
	
	function Header($tabs = array(), $prefix = ''){
		if(!empty($prefix)){
			$this->prefix = $prefix;
		}
		$output = '<div class="tabs">
			<ul>
				';
				$counter = 0;
				foreach($tabs as $id => $title){
					if(!empty($prefix)){
						$id = $prefix.'_'.$id;
					}
					$class = '';
					if($counter == 0){
						$class = ' class="activetab"';
						$this->active = $id;
					}
					$output .= '<li id="'.$id.'-panel-tab"'.$class.'><a href="#tabs" onClick="switchTab(\''.$id.'\'); return false;"><span>'.$title.'</span></a></li>';
					$output .= "\n";
					$counter++;
				}
			$output .= '
			</ul>
		</div>';
		return $output;
	}
	
	function tabStart($id = ''){
		if(!empty($this->prefix)){
			$id = $this->prefix.'_'.$id;
		}
		$style = ' style="display: none;"';
		if($id == $this->active){
			$style = ' style="display: block;"';
		}
		$output = '<div id="'.$id.'-panel" class="tabs-panel"'.$style.'>
			<div class="tabs-panel-inner">
				';
		return $output;
	}
	
	function tabEnd(){
		$output = '</div>
			</div>
				';
		return $output;
	}
}