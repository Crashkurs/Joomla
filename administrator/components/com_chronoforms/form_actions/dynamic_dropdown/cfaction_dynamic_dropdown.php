<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionDynamicDropdownHelper{
	function load($form = null, $actiondata = null){
		$params = new JParameter($actiondata->params);
		$document =& JFactory::getDocument();
		JHTML::_('behavior.mootools');
		$mainframe =& JFactory::getApplication();
		$uri =& JFactory::getURI();
		
		$dynamic_values = array();
		if(!empty($actiondata->content1)){
			$config = trim($actiondata->content1);
			$values = explode("\n", $config);
			foreach($values as $line){
				$line_data = explode(":", trim($line));
				$source_value = $line_data[0];
				$target_data = $line_data[1];
				$target_options = explode(",", $target_data);
				foreach($target_options as $target_option){
					$target_option_data = explode("=", $target_option);
					$target_option_value = $target_option_data[0];
					$dynamic_values[$source_value][$target_option_value] = $target_option_title = trim($target_option_data[1]);
				}
			}
		}
		$source_id = $params->get('source_dropdown_id', '');
		$target_id = $params->get('target_dropdown_id', '');
		
		if(empty($dynamic_values) || empty($source_id) || empty($target_id)){
			return false;
		}		
		
		ob_start();
		?>
			window.addEvent('load', function() {
				$('<?php echo $source_id; ?>').addEvent('change', function(){
					<?php if((bool)$params->get('enable_ajax', 0) === false): ?>
						<?php foreach($dynamic_values as $k => $dynamic_value): ?>
							if($('<?php echo $source_id; ?>').get('value') == '<?php echo $k; ?>'){
								$('<?php echo $target_id; ?>').empty();
								<?php foreach($dynamic_value as $option_value => $option_title): ?>
									new Element('option', {'value': '<?php echo $option_value; ?>', 'text': '<?php echo $option_title; ?>'}).inject($('<?php echo $target_id; ?>'));
								<?php endforeach; ?>
								$('<?php echo $target_id; ?>').fireEvent('change');
							}
						<?php endforeach; ?>
					<?php else: ?>
						var load_req = new Request({
							url: 'index.php?option=com_chronoforms&chronoform=<?php echo $form->form_name; ?>&event=<?php echo $params->get('ajax_event_name', ''); ?>',
							method: 'get',
							onRequest: function(){
								$('<?php echo $target_id; ?>').empty();
								new Element('option', {'value': '', 'text': 'Loading...'}).inject($('<?php echo $target_id; ?>'));
							},
							onSuccess: function(responseText){
								$('<?php echo $target_id; ?>').empty();
								var response_data = responseText.trim().split("\n");
								response_data.each(function(line){
									var line_data = line.split("=");
									new Element('option', {'value': line_data[0], 'text': line_data[1]}).inject($('<?php echo $target_id; ?>'));
								});
								$('<?php echo $target_id; ?>').fireEvent('change');
							},
							onFailure: function(){
								$('<?php echo $target_id; ?>').empty();
								new Element('option', {'value': '', 'text': 'Loading failed.'}).inject($('<?php echo $target_id; ?>'));
							}
						});
						load_req.send($('<?php echo $source_id; ?>').get('name')+'='+$('<?php echo $source_id; ?>').get('value'));
					<?php endif; ?>
				});
			});
		<?php
		$script = ob_get_clean();
		if((bool)$form->form_params->get('dynamic_files', 0) === false){
			$document->addScriptDeclaration("//<![CDATA["."\n".$script."\n"."//]]>");
		}else{
			//load the action class
			$form->loadActionHelper('load_js');
			$CfactionLoadJsHelper = new CfactionLoadJsHelper();
			$JSactiondata = new stdClass();
			$JSactiondata->content1 = $script;
			$JSParams = new JParameter('');
			$JSParams->set('dynamic_file', $form->form_params->get('dynamic_files', 0));
			$JSactiondata->params = $JSParams->toString();
			$CfactionLoadJsHelper->load($form, $JSactiondata);
		}
	}
}
?>