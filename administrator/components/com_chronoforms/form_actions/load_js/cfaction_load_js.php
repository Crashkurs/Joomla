<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionLoadJsHelper{
	function load($form = null, $actiondata = null){
		$params = new JParameter($actiondata->params);
		if((bool)$params->get('dynamic_file', 0) == 1){
			$this->loadDynamic($form, $actiondata);
		}else{
			$this->loadScript($form, $actiondata);
		}
	}
	
	function loadScript($form = null, $actiondata = null){
		$output = '';
		$document =& JFactory::getDocument();
		ob_start();
		eval('?>'.$actiondata->content1);
		$output .= ob_get_clean();
		ob_start();
		?>
		//<![CDATA[
			<?php echo $output; ?>
		//]]>
		<?php
		$script = ob_get_clean();
		$document->addScriptDeclaration($script);
	}
	
	function loadDynamic($form = null, $actiondata = null){
		$document =& JFactory::getDocument();
		$mainframe =& JFactory::getApplication();
		$uri =& JFactory::getURI();
		//eval teh code
		ob_start();
		eval('?>'.$actiondata->content1);
		$output = ob_get_clean();
		//encode and send it
		$code_encoded = $this->secure_serialize($output);
		$get_string = 'code='.$code_encoded;
		$full_url = $uri->root().'components/com_chronoforms/js/load_js.php?'.$get_string;
		//check the url length, IE has a 2083 limit
		if(strlen($full_url) < 2083){
			$document->addScript($uri->root().'components/com_chronoforms/js/load_js.php?'.$get_string);
		}else{
			$this->loadScript($form, $actiondata);
		}
	}
	
	function secure_serialize($data){
		$mainframe =& JFactory::getApplication();
		$secret = $mainframe->getCfg('secret');
		$sData = strtr(base64_encode(addslashes(gzcompress(serialize($data),9))), '+/=', '-_,');
		return sha1($sData.$secret).$sData;
	}
	
	function secure_unserialize($data){
		$mainframe =& JFactory::getApplication();
		$secret = $mainframe->getCfg('secret');
		$v = substr($data, 0, 40);
		$sData = substr($data, 40);
		if($v != sha1($sData.$secret)){
			die('Query altered!!');
		}
		return unserialize(gzuncompress(stripslashes(base64_decode(strtr($sData, '-_,', '+/=')))));
	}
}
?>