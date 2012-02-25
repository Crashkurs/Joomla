<div class="dragable" id="cfaction_check_recaptcha">Check ReCaptcha</div>
<!--start_element_code-->
<div class="element_code" id="cfaction_check_recaptcha_element">
	<label class="action_label">Check ReCaptcha</label>
	<div id="cfactionevent_check_recaptcha_{n}_success" class="form_event good_event">
		<label class="form_event_label">OnSuccess</label>
	</div>
	<div id="cfactionevent_check_recaptcha_{n}_fail" class="form_event bad_event">
		<label class="form_event_label">OnFail</label>
	</div>
	<input type="hidden" name="chronoaction[{n}][action_check_recaptcha_{n}_error]" id="action_check_recaptcha_{n}_error" value="<?php echo $action_params['error']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_check_recaptcha_{n}_private_key]" id="action_check_recaptcha_{n}_private_key" value="<?php echo $action_params['private_key']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_check_recaptcha_{n}_verify_server]" id="action_check_recaptcha_{n}_verify_server" value="<?php echo $action_params['verify_server']; ?>" />
	<input type="hidden" id="chronoaction_id_{n}" name="chronoaction_id[{n}]" value="{n}" />
	<input type="hidden" name="chronoaction[{n}][type]" value="check_recaptcha" />
</div>
<!--end_element_code-->
<div class="element_config" id="cfaction_check_recaptcha_element_config">
	<?php echo $PluginTabsHelper->Header(array('settings' => 'Settings', 'advanced' => 'Advanced'), 'cfaction_check_recaptcha_element_config_{n}'); ?>
	<?php echo $PluginTabsHelper->tabStart('settings'); ?>
		<?php echo $HtmlHelper->input('action_check_recaptcha_{n}_private_key_config', array('type' => 'text', 'label' => 'ReCaptcha private key', 'class' => 'medium_input', 'value' => '')); ?>
		<?php echo $HtmlHelper->input('action_check_recaptcha_{n}_error_config', array('type' => 'text', 'label' => 'Error Message', 'class' => 'medium_input', 'value' => '')); ?>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('advanced'); ?>
		<?php echo $HtmlHelper->input('action_check_recaptcha_{n}_verify_server_config', array('type' => 'text', 'label' => 'ReCaptcha verify server', 'class' => 'medium_input', 'value' => '')); ?>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
</div>