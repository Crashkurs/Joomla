<div class="dragable" id="cfaction_email_verification_response">Email Verification Response</div>
<!--start_element_code-->
<div class="element_code" id="cfaction_email_verification_response_element">
	<label class="action_label" style="display: block; float:none!important;">Email Verification Response</label>
	<div id="cfactionevent_email_verification_response_{n}_success" class="form_event good_event">
		<label class="form_event_label">OnSuccess</label>
	</div>
	<div id="cfactionevent_email_verification_response_{n}_fail" class="form_event bad_event">
		<label class="form_event_label">OnFail</label>
	</div>
	<input type="hidden" name="chronoaction[{n}][action_email_verification_response_{n}_table_name]" id="action_email_verification_response_{n}_table_name" value="<?php echo $action_params['table_name']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_email_verification_response_{n}_verify_field]" id="action_email_verification_response_{n}_verify_field" value="<?php echo $action_params['verify_field']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_email_verification_response_{n}_verification_status_field]" id="action_email_verification_response_{n}_verification_status_field" value="<?php echo $action_params['verification_status_field']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_email_verification_response_{n}_files_array_field]" id="action_email_verification_response_{n}_files_array_field" value="<?php echo $action_params['files_array_field']; ?>" />
		
	<input type="hidden" id="chronoaction_id_{n}" name="chronoaction_id[{n}]" value="{n}" />
	<input type="hidden" name="chronoaction[{n}][type]" value="email_verification_response" />
</div>
<!--end_element_code-->
<div class="element_config" id="cfaction_email_verification_response_element_config">
	<?php echo $PluginTabsHelper->Header(array('settings' => 'Settings', 'help' => 'Help'), 'email_verification_response_config_{n}'); ?>
		<?php echo $PluginTabsHelper->tabStart('settings'); ?>
			<?php
			$database =& JFactory::getDBO();
			$tables = $database->getTableList();
			$options = array();
			foreach($tables as $table){
				$options[$table] = $table;
			}
		?>
		<?php echo $HtmlHelper->input('action_email_verification_response_{n}_table_name_config', array('type' => 'select', 'label' => 'Table', 'options' => $options, 'empty' => " - ", 'class' => 'medium_input', 'smalldesc' => 'The table at which the form data is saved.')); ?>
		
		<?php echo $HtmlHelper->input('action_email_verification_response_{n}_verify_field_config', array('type' => 'text', 'label' => "Verification code field name", 'class' => 'medium_input', 'smalldesc' => 'The field name at which the verification code is saved.')); ?>
		<?php echo $HtmlHelper->input('action_email_verification_response_{n}_verification_status_field_config', array('type' => 'text', 'label' => "Verification status field name", 'class' => 'medium_input', 'smalldesc' => 'The field name at which the verification status is saved.')); ?>
		<?php echo $HtmlHelper->input('action_email_verification_response_{n}_files_array_field_config', array('type' => 'text', 'label' => "Files array field name", 'class' => 'medium_input', 'smalldesc' => 'The field name at which the files array is saved.')); ?>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('help'); ?>
		<p>
			<ul>
				<li>Select the db table where you want your form data to be loaded from.</li>
				<li>Enter the name of your verification code field without any spaces.(e.g: verify)</li>
				<li>Enter the name of your verification status field without any spaces.(e.g: verified)</li>
				<li>You can use the success (or fail) events to do whatever you need after the response is processed.</li>
			</ul>
		</p>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
</div>