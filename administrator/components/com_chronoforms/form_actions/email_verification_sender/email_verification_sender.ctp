<div class="dragable" id="cfaction_email_verification_sender">Email Verification Sender</div>
<!--start_element_code-->
<div class="element_code" id="cfaction_email_verification_sender_element">
	<label class="action_label" style="display: block; float:none!important;">Email Verification Sender</label>
	<input type="hidden" name="chronoaction[{n}][action_email_verification_sender_{n}_table_name]" id="action_email_verification_sender_{n}_table_name" value="<?php echo $action_params['table_name']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_email_verification_sender_{n}_verify_field]" id="action_email_verification_sender_{n}_verify_field" value="<?php echo $action_params['verify_field']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_email_verification_sender_{n}_verification_link_path]" id="action_email_verification_sender_{n}_verification_link_path" value="<?php echo $action_params['verification_link_path']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_email_verification_sender_{n}_verification_status_field]" id="action_email_verification_sender_{n}_verification_status_field" value="<?php echo $action_params['verification_status_field']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_email_verification_sender_{n}_files_array_field]" id="action_email_verification_sender_{n}_files_array_field" value="<?php echo $action_params['files_array_field']; ?>" />
	
	
	<input type="hidden" id="chronoaction_id_{n}" name="chronoaction_id[{n}]" value="{n}" />
	<input type="hidden" name="chronoaction[{n}][type]" value="email_verification_sender" />
</div>
<!--end_element_code-->
<div class="element_config" id="cfaction_email_verification_sender_element_config">
	<?php echo $PluginTabsHelper->Header(array('settings' => 'Settings', 'help' => 'Help'), 'email_verification_sender_config_{n}'); ?>
	<?php echo $PluginTabsHelper->tabStart('settings'); ?>
		<?php
			$database =& JFactory::getDBO();
			$tables = $database->getTableList();
			$options = array();
			foreach($tables as $table){
				$options[$table] = $table;
			}
		?>
		<?php echo $HtmlHelper->input('action_email_verification_sender_{n}_table_name_config', array('type' => 'select', 'label' => 'Table', 'options' => $options, 'empty' => " - ", 'class' => 'medium_input', 'smalldesc' => 'The table to which the form data will be stored, form fields names should match the table columns names.')); ?>
		
		<?php echo $HtmlHelper->input('action_email_verification_sender_{n}_verify_field_config', array('type' => 'text', 'label' => "Verification code field name", 'class' => 'medium_input', 'smalldesc' => 'The field name at which the verification code will be stored.')); ?>
		<?php echo $HtmlHelper->input('action_email_verification_sender_{n}_verification_status_field_config', array('type' => 'text', 'label' => "Verification status field name", 'class' => 'medium_input', 'smalldesc' => 'The field name at which the verification status (0 or 1) will be stored. (a TINYINT(1) field is perfect)')); ?>
		<?php echo $HtmlHelper->input('action_email_verification_sender_{n}_files_array_field_config', array('type' => 'text', 'label' => "Files array field name", 'class' => 'medium_input', 'smalldesc' => 'The field name at which the form files array is going to be saved, this is necessary only if your form is uploading some files, should be of type TEXT')); ?>
		<?php echo $HtmlHelper->input('action_email_verification_sender_{n}_verification_link_path_config', array('type' => 'text', 'label' => "Verification link path", 'class' => 'big_input', 'value' => '', 'smalldesc' => 'The verification link path, this is typically the link to your form event which has the "Email verification response" action.')); ?>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('help'); ?>
		<p>
			<ul>
				<li>Select the db table where you want your form data to be stored at along with the verification code.</li>
				<li>Your table should have some field to store the verification code.</li>
				<li>Enter the name of your verification code field without any spaces.(preferably a VARCHAR(255) field)(e.g: verify)</li>
				<li>Enter the name of your verification status field without any spaces.(preferably a TINYINT(1) field)()e.g: verified</li>
				<li>Enter the path to your "Email verification response" processor action, this is usually the link to your form in the frontend (you can add it to any other form you want).</li>
				<li>Add an Email action after this action to send the verification email, you can use {verification_link} to display the link in your email, you can use {verify} to display the verification code only.</li>
			</ul>
		</p>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
</div>