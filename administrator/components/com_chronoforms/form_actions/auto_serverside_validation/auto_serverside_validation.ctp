<div class="dragable" id="cfaction_auto_serverside_validation">Auto Server Side Validation</div>
<!--start_element_code-->
<div class="element_code" id="cfaction_auto_serverside_validation_element">
	<label class="action_label" style="display: block; float:none!important;">Auto Server Side Validation</label>
	<div id="cfactionevent_auto_serverside_validation_{n}_success" class="form_event good_event">
		<label class="form_event_label">OnSuccess</label>
	</div>
	<div id="cfactionevent_auto_serverside_validation_{n}_fail" class="form_event bad_event">
		<label class="form_event_label">OnFail</label>
	</div>
	<input type="hidden" name="chronoaction[{n}][action_auto_serverside_validation_{n}_required]" id="action_auto_serverside_validation_{n}_required" value="<?php echo $action_params['required']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_auto_serverside_validation_{n}_not_empty]" id="action_auto_serverside_validation_{n}_not_empty" value="<?php echo $action_params['not_empty']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_auto_serverside_validation_{n}_empty]" id="action_auto_serverside_validation_{n}_empty" value="<?php echo $action_params['empty']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_auto_serverside_validation_{n}_alpha]" id="action_auto_serverside_validation_{n}_alpha" value="<?php echo $action_params['alpha']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_auto_serverside_validation_{n}_alphanumeric]" id="action_auto_serverside_validation_{n}_alphanumeric" value="<?php echo $action_params['alphanumeric']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_auto_serverside_validation_{n}_digit]" id="action_auto_serverside_validation_{n}_digit" value="<?php echo $action_params['digit']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_auto_serverside_validation_{n}_nodigit]" id="action_auto_serverside_validation_{n}_nodigit" value="<?php echo $action_params['nodigit']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_auto_serverside_validation_{n}_number]" id="action_auto_serverside_validation_{n}_number" value="<?php echo $action_params['number']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_auto_serverside_validation_{n}_email]" id="action_auto_serverside_validation_{n}_email" value="<?php echo $action_params['email']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_auto_serverside_validation_{n}_phone]" id="action_auto_serverside_validation_{n}_phone" value="<?php echo $action_params['phone']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_auto_serverside_validation_{n}_phone_inter]" id="action_auto_serverside_validation_{n}_phone_inter" value="<?php echo $action_params['phone_inter']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_auto_serverside_validation_{n}_url]" id="action_auto_serverside_validation_{n}_url" value="<?php echo $action_params['url']; ?>" />
	
	<input type="hidden" name="chronoaction[{n}][action_auto_serverside_validation_{n}_required_error]" id="action_auto_serverside_validation_{n}_required_error" value="<?php echo $action_params['required_error']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_auto_serverside_validation_{n}_not_empty_error]" id="action_auto_serverside_validation_{n}_not_empty_error" value="<?php echo $action_params['not_empty_error']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_auto_serverside_validation_{n}_empty_error]" id="action_auto_serverside_validation_{n}_empty_error" value="<?php echo $action_params['empty_error']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_auto_serverside_validation_{n}_alpha_error]" id="action_auto_serverside_validation_{n}_alpha_error" value="<?php echo $action_params['alpha_error']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_auto_serverside_validation_{n}_alphanumeric_error]" id="action_auto_serverside_validation_{n}_alphanumeric_error" value="<?php echo $action_params['alphanumeric_error']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_auto_serverside_validation_{n}_digit_error]" id="action_auto_serverside_validation_{n}_digit_error" value="<?php echo $action_params['digit_error']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_auto_serverside_validation_{n}_nodigit_error]" id="action_auto_serverside_validation_{n}_nodigit_error" value="<?php echo $action_params['nodigit_error']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_auto_serverside_validation_{n}_number_error]" id="action_auto_serverside_validation_{n}_number_error" value="<?php echo $action_params['number_error']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_auto_serverside_validation_{n}_email_error]" id="action_auto_serverside_validation_{n}_email_error" value="<?php echo $action_params['email_error']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_auto_serverside_validation_{n}_phone_error]" id="action_auto_serverside_validation_{n}_phone_error" value="<?php echo $action_params['phone_error']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_auto_serverside_validation_{n}_phone_inter_error]" id="action_auto_serverside_validation_{n}_phone_inter_error" value="<?php echo $action_params['phone_inter_error']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_auto_serverside_validation_{n}_url_error]" id="action_auto_serverside_validation_{n}_url_error" value="<?php echo $action_params['url_error']; ?>" />
	
	
	<input type="hidden" id="chronoaction_id_{n}" name="chronoaction_id[{n}]" value="{n}" />
	<input type="hidden" name="chronoaction[{n}][type]" value="auto_serverside_validation" />
</div>
<!--end_element_code-->
<div class="element_config" id="cfaction_auto_serverside_validation_element_config">
    <?php echo $PluginTabsHelper->Header(array('fields' => 'Fields', 'errors' => 'Error Messages', 'help' => 'Help'), 'auto_serverside_validation_config_{n}'); ?>
	<?php echo $PluginTabsHelper->tabStart('fields'); ?>
		<?php echo $HtmlHelper->input('action_auto_serverside_validation_{n}_required_config', array('type' => 'text', 'label' => "Required", 'class' => 'medium_input', 'value' => '', 'smalldesc' => "Comma delimited list of required fields names, these fields should exist in the data array in order to pass this check.")); ?>
		<?php echo $HtmlHelper->input('action_auto_serverside_validation_{n}_not_empty_config', array('type' => 'text', 'label' => "Not Empty", 'class' => 'medium_input', 'value' => '', 'smalldesc' => "Comma delimited list of fields names which should not be empty.")); ?>
		<?php echo $HtmlHelper->input('action_auto_serverside_validation_{n}_empty_config', array('type' => 'text', 'label' => "Empty", 'class' => 'medium_input', 'value' => '', 'smalldesc' => "Comma delimited list of fields names which should be empty.")); ?>
		<?php echo $HtmlHelper->input('action_auto_serverside_validation_{n}_alpha_config', array('type' => 'text', 'label' => "Alpha", 'class' => 'medium_input', 'value' => '', 'smalldesc' => "Comma delimited list of fields names which should only contain an alpha value.")); ?>
		<?php echo $HtmlHelper->input('action_auto_serverside_validation_{n}_alphanumeric_config', array('type' => 'text', 'label' => "Alpha Numeric", 'class' => 'medium_input', 'value' => '', 'smalldesc' => "Comma delimited list of fields names which should only contain an alpha numeric value.")); ?>
		<?php echo $HtmlHelper->input('action_auto_serverside_validation_{n}_digit_config', array('type' => 'text', 'label' => "Digit", 'class' => 'medium_input', 'value' => '', 'smalldesc' => "Comma delimited list of fields names which should only contain a digit value.")); ?>
		<?php echo $HtmlHelper->input('action_auto_serverside_validation_{n}_nodigit_config', array('type' => 'text', 'label' => "No Digit", 'class' => 'medium_input', 'value' => '', 'smalldesc' => "Comma delimited list of fields names which should only contain a non digit value.")); ?>
		<?php echo $HtmlHelper->input('action_auto_serverside_validation_{n}_number_config', array('type' => 'text', 'label' => "Number", 'class' => 'medium_input', 'value' => '', 'smalldesc' => "Comma delimited list of fields names which should only contain a number value.")); ?>
		<?php echo $HtmlHelper->input('action_auto_serverside_validation_{n}_email_config', array('type' => 'text', 'label' => "Email", 'class' => 'medium_input', 'value' => '', 'smalldesc' => "Comma delimited list of fields names which should only contain an email value.")); ?>
		<?php echo $HtmlHelper->input('action_auto_serverside_validation_{n}_phone_config', array('type' => 'text', 'label' => "Phone", 'class' => 'medium_input', 'value' => '', 'smalldesc' => "Comma delimited list of fields names which should only contain a phone value.")); ?>
		<?php echo $HtmlHelper->input('action_auto_serverside_validation_{n}_phone_inter_config', array('type' => 'text', 'label' => "International Phone", 'class' => 'medium_input', 'value' => '', 'smalldesc' => "Comma delimited list of fields names which should only contain an international phone value.")); ?>
		<?php echo $HtmlHelper->input('action_auto_serverside_validation_{n}_url_config', array('type' => 'text', 'label' => "URL", 'class' => 'medium_input', 'value' => '', 'smalldesc' => "Comma delimited list of fields names which should only contain URLs.")); ?>
		
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	
	<?php echo $PluginTabsHelper->tabStart('errors'); ?>
		<?php echo $HtmlHelper->input('action_auto_serverside_validation_{n}_required_error_config', array('type' => 'text', 'label' => "Required", 'class' => 'medium_input', 'value' => '', 'smalldesc' => "Error message for required fields.")); ?>
		<?php echo $HtmlHelper->input('action_auto_serverside_validation_{n}_not_empty_error_config', array('type' => 'text', 'label' => "Not Empty", 'class' => 'medium_input', 'value' => '', 'smalldesc' => "Error message for not empty fields.")); ?>
		<?php echo $HtmlHelper->input('action_auto_serverside_validation_{n}_empty_error_config', array('type' => 'text', 'label' => "Empty", 'class' => 'medium_input', 'value' => '', 'smalldesc' => "Error message for empty fields.")); ?>
		<?php echo $HtmlHelper->input('action_auto_serverside_validation_{n}_alpha_error_config', array('type' => 'text', 'label' => "Alpha", 'class' => 'medium_input', 'value' => '', 'smalldesc' => "Error message for alpha fields.")); ?>
		<?php echo $HtmlHelper->input('action_auto_serverside_validation_{n}_alphanumeric_error_config', array('type' => 'text', 'label' => "Alpha Numeric", 'class' => 'medium_input', 'value' => '', 'smalldesc' => "Error message for alpha numeric fields.")); ?>
		<?php echo $HtmlHelper->input('action_auto_serverside_validation_{n}_digit_error_config', array('type' => 'text', 'label' => "Digit", 'class' => 'medium_input', 'value' => '', 'smalldesc' => "Error message for digit fields.")); ?>
		<?php echo $HtmlHelper->input('action_auto_serverside_validation_{n}_nodigit_error_config', array('type' => 'text', 'label' => "No Digit", 'class' => 'medium_input', 'value' => '', 'smalldesc' => "Error message for non digit fields.")); ?>
		<?php echo $HtmlHelper->input('action_auto_serverside_validation_{n}_number_error_config', array('type' => 'text', 'label' => "Number", 'class' => 'medium_input', 'value' => '', 'smalldesc' => "Error message for number fields.")); ?>
		<?php echo $HtmlHelper->input('action_auto_serverside_validation_{n}_email_error_config', array('type' => 'text', 'label' => "Email", 'class' => 'medium_input', 'value' => '', 'smalldesc' => "Error message for email fields.")); ?>
		<?php echo $HtmlHelper->input('action_auto_serverside_validation_{n}_phone_error_config', array('type' => 'text', 'label' => "Phone", 'class' => 'medium_input', 'value' => '', 'smalldesc' => "Error message for phone fields.")); ?>
		<?php echo $HtmlHelper->input('action_auto_serverside_validation_{n}_phone_inter_error_config', array('type' => 'text', 'label' => "International Phone", 'class' => 'medium_input', 'value' => '', 'smalldesc' => "Error message for international phone fields.")); ?>
		<?php echo $HtmlHelper->input('action_auto_serverside_validation_{n}_url_error_config', array('type' => 'text', 'label' => "URL", 'class' => 'medium_input', 'value' => '', 'smalldesc' => "Error message for URL fields.")); ?>
		
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	
	<?php echo $PluginTabsHelper->tabStart('help'); ?>
		<p>
			<ul>
				<li>Enter the fields names you want to check in the text field for the rule you want them to be checked against.</li>
				<li>If a field failed the check, the fail event will be fired and the error will be shown.</li>
			</ul>
		</p>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
</div>