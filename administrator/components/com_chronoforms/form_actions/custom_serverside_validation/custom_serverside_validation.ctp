<div class="dragable" id="cfaction_custom_serverside_validation">Custom Server Side Validation</div>
<!--start_element_code-->
<div class="element_code" id="cfaction_custom_serverside_validation_element">
	<label class="action_label" style="display: block; float:none!important;">Custom Server Side Validation</label>
	<div id="cfactionevent_custom_serverside_validation_{n}_success" class="form_event good_event">
		<label class="form_event_label">OnSuccess</label>
	</div>
	<div id="cfactionevent_custom_serverside_validation_{n}_fail" class="form_event bad_event">
		<label class="form_event_label">OnFail</label>
	</div>
	<textarea name="chronoaction[{n}][action_custom_serverside_validation_{n}_content1]" id="action_custom_serverside_validation_{n}_content1" style="display:none"><?php echo $action_params['content1']; ?></textarea>
    
	<input type="hidden" id="chronoaction_id_{n}" name="chronoaction_id[{n}]" value="{n}" />
	<input type="hidden" name="chronoaction[{n}][type]" value="custom_serverside_validation" />
</div>
<!--end_element_code-->
<div class="element_config" id="cfaction_custom_serverside_validation_element_config">
    <?php echo $PluginTabsHelper->Header(array('settings' => 'Settings', 'help' => 'Help'), 'custom_serverside_validation_config_{n}'); ?>
	<?php echo $PluginTabsHelper->tabStart('settings'); ?>
		<?php echo $HtmlHelper->input('action_custom_serverside_validation_{n}_content1_config', array('type' => 'textarea', 'label' => "Code", 'rows' => 20, 'cols' => 70, 'smalldesc' => 'Returning "boolean" false will fail, anything else or no return at all will lead to success.')); ?>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('help'); ?>
		<p>
			<ul>
				<li>You should use PHP code with php tags.</li>
				<li>Returning "boolean" false will fail, anything else or no return at all will lead to success.</li>
				<li>Set fields errors by adding a new key => value entry to the $form->validation_errors array, where "key" is the "field name" and "value" is the "Error message", for example, if you want to set an error to the "email" field you should use this code
				<br />$form->validation_errros['email'] = "Email error message is here.";.</li>
			</ul>
		</p>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
</div>