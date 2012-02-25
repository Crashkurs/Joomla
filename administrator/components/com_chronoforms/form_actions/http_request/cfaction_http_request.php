<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionHttpRequestHelper{
	function loadAction($form, $actiondata){
		$params = new JParameter($actiondata->params);
		$document =& JFactory::getDocument();
		//create the JS function
		ob_start();
		?>
		//<![CDATA[
			var request_caller_<?php echo $actiondata->id; ?> = function(){
				var myForm = $('chronoform_<?php echo $form->form_name; ?>');
				if(myForm.hasClass('hasValidation') == <?php echo ($params->get('request_event', 'submit') == 'submit') ? "false" : "true"; ?>){
					myForm.set('send', {
						url: '<?php echo $params->get('http_request_url', ''); ?>', 
						method: 'post',
						async: false,
						onRequest: function(){
							
						},
						onSuccess: function(responseText, responseXML){
							<?php
								if(trim($params->get('response_element_id', ''))):
							?>
								$('<?php echo trim($params->get('response_element_id', '')); ?>').set('html', responseText);
							<?php
								endif;
							?>
						},
						onFailure: function(xhr){
							
						}
					});
					myForm.send('<?php echo $params->get('http_request_url', ''); ?>');
				}
			}
			window.addEvent('domready', function() {
				<?php
					if($params->get('request_event', 'submit') == 'submit'):
				?>
					if($('chronoform_<?php echo $form->form_name; ?>').hasClass('hasValidation') == false){
						$('chronoform_<?php echo $form->form_name; ?>').addEvent('submit', request_caller_<?php echo $actiondata->id; ?>);
					}
				<?php
					else:
				?>
					$('<?php echo $params->get('event_element_id', ''); ?>').addEvent('<?php echo $params->get('request_event', 'submit'); ?>', request_caller_<?php echo $actiondata->id; ?>);
				<?php
					endif;
				?>
			});
		//]]>
		<?php
		$script = ob_get_clean();
		$document->addScriptDeclaration($script);		
	}
}
?>