<div class="dragable" id="cfaction_http_request">HTTP Request</div>
<!--start_element_code-->
<div class="element_code" id="cfaction_http_request_element">
	<label class="action_label" style="display: block; float:none!important;">HTTP Request</label>
	<input type="hidden" name="chronoaction[{n}][action_http_request_{n}_enabled]" id="action_http_request_{n}_enabled" value="<?php echo $action_params['enabled']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_http_request_{n}_http_request_url]" id="action_http_request_{n}_http_request_url" value="<?php echo $action_params['http_request_url']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_http_request_{n}_request_event]" id="action_http_request_{n}_request_event" value="<?php echo $action_params['request_event']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_http_request_{n}_event_element_id]" id="action_http_request_{n}_event_element_id" value="<?php echo $action_params['event_element_id']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_http_request_{n}_response_element_id]" id="action_http_request_{n}_response_element_id" value="<?php echo $action_params['response_element_id']; ?>" />
	<input type="hidden" id="chronoaction_id_{n}" name="chronoaction_id[{n}]" value="{n}" />
	<input type="hidden" name="chronoaction[{n}][type]" value="http_request" />
</div>
<!--end_element_code-->
<div class="element_config" id="cfaction_http_request_element_config">
	<?php echo $PluginTabsHelper->Header(array('settings' => 'Settings', 'help' => 'Help'), 'http_request_config_{n}'); ?>
	<?php echo $PluginTabsHelper->tabStart('settings'); ?>
		<?php echo $HtmlHelper->input('action_http_request_{n}_enabled_config', array('type' => 'select', 'label' => 'Enabel HTTP Request', 'options' => array(0 => 'No', 1 => 'Yes'), 'smalldesc' => 'Enable the form to initiate an HTTP request before its submitted, example, the form atcion may be set to PayPal but you want to run the submission routine before moving to PayPal.')); ?>
		<?php echo $HtmlHelper->input('action_http_request_{n}_http_request_url_config', array('type' => 'text', 'label' => "HTTP Request URL", 'class' => 'big_input', 'smalldesc' => "The url to which the HTTP request call will be made, usually the same form url but ends with &event=submit")); ?>
		<?php echo $HtmlHelper->input('action_http_request_{n}_request_event_config', array('type' => 'select', 'label' => 'Request Event', 'options' => array('submit' => "Form's onSubmit", 'click' => 'onClick', 'change' => 'onChange'), 'smalldesc' => 'The event at which the request will be triggered, this is a browser side event, please do not mix with server side forms events.')); ?>
		<?php echo $HtmlHelper->input('action_http_request_{n}_event_element_id_config', array('type' => 'text', 'label' => "Event Element ID", 'class' => 'medium_input', 'smalldesc' => "The id of the element which will have the event to be used, leave empty iof you select the onSubmit.")); ?>
		<?php echo $HtmlHelper->input('action_http_request_{n}_response_element_id_config', array('type' => 'text', 'label' => "Response Element ID", 'class' => 'medium_input', 'smalldesc' => "The id of the element which will be loaded with the response string when the request is completed with success.")); ?>
		
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('help'); ?>
		<p>
			<ul>
				<li>Sometimes we need to submit our form to 2 different URLs, this was hard to do, the only way to do this was to use the CURL library, however, this action should allow this to be done now.</li>
				<li>For example, set your form's action URL to PayPal, Moneybookers or SugarCRM..etc and use this HTTP Request to communicate with one of your form events, or vice versa.
			</ul>
		</p>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
</div>