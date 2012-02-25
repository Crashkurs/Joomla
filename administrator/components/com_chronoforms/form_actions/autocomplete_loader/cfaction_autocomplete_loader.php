<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionAutocompleteLoaderHelper{
	function load($form = null, $actiondata = null){
		$mainframe =& JFactory::getApplication();
		$params = new JParameter($actiondata->params);
		$output = '';
		$document =& JFactory::getDocument();
		//load some files
		//mootools
		JHTML::_('behavior.mootools');
		//load form css files
		$uri =& JFactory::getURI();
		//$document->addStyleSheet($uri->root().'administrator/components/com_chronoforms/form_actions/autocomplete_loader/assets/Autocompleter.css');
		$document->addScript($uri->root().'administrator/components/com_chronoforms/form_actions/autocomplete_loader/assets/Autocompleter.js');
		$document->addScript($uri->root().'administrator/components/com_chronoforms/form_actions/autocomplete_loader/assets/Autocompleter.Local.js');
		$document->addScript($uri->root().'administrator/components/com_chronoforms/form_actions/autocomplete_loader/assets/Autocompleter.Request.js');
		$document->addScript($uri->root().'administrator/components/com_chronoforms/form_actions/autocomplete_loader/assets/Observer.js');
		//load the CSS
		ob_start();
		?>
		ul.autocompleter-choices { margin:0; position:absolute; width:339px; padding:0; list-style:none; z-index:50; background:#3b5998; border:1px solid #3b5998; top:0;}
		ul.autocompleter-choices li { margin:0; list-style:none; padding:0px 10px; cursor:pointer; font-weight:normal; white-space:nowrap; color:#fff; font-size:11px; }
		ul.autocompleter-choices li:hover { background:#eceff5; color:#3b5998; }
		.search-working { background:url(/administrator/components/com_chronoforms/form_actions/autocomplete_loader/assets/indicator_blue_small.gif) 200px 7px no-repeat; }
		<?php
		$script = ob_get_clean();
		$document->addStyleDeclaration($script);
		//load the JS
		ob_start();
		?>
		window.addEvent('domready', function() {
			new Autocompleter.Request.JSON('<?php echo $params->get('field_id', ''); ?>', 'index.php?option=com_chronoforms&chronoform=<?php echo $form->form_details->name; ?>&event=<?php echo $params->get('ajax_event', ''); ?>', {
				'postVar': '<?php echo $params->get('field_name', ''); ?>',
				minLength: <?php echo $params->get('minLength', 3); ?>,
				maxChoices: <?php echo $params->get('maxChoices', 10); ?>,
				autoSubmit: false,
				cache: <?php echo $params->get('results_cache', 'true'); ?>,
				delay: <?php echo $params->get('ajax_delay', 300); ?>,
				onRequest: function() {
					$('<?php echo $params->get('field_id', ''); ?>').setStyles({
						'background-image':'url(<?php echo $uri->root(); ?>administrator/components/com_chronoforms/form_actions/autocomplete_loader/assets/indicator_blue_small.gif)',
						'background-position':'350px 7px',
						'background-repeat':'no-repeat'
					});
				},
				onComplete: function() {
					$('<?php echo $params->get('field_id', ''); ?>').setStyle('background','');
				}
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