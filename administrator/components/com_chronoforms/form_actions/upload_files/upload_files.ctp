<div class="dragable" id="cfaction_upload_files">Upload Files</div>
<!--start_element_code-->
<div class="element_code" id="cfaction_upload_files_element">
	<label class="action_label">Upload Files</label>
	<div id="cfactionevent_upload_files_{n}_success" class="form_event good_event">
		<label class="form_event_label">OnSuccess</label>
	</div>
	<div id="cfactionevent_upload_files_{n}_fail" class="form_event bad_event">
		<label class="form_event_label">OnFail</label>
	</div>
	<input type="hidden" name="chronoaction[{n}][action_upload_files_{n}_files]" id="action_upload_files_{n}_files" value="<?php echo $action_params['files']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_upload_files_{n}_upload_path]" id="action_upload_files_{n}_upload_path" value="<?php echo $action_params['upload_path']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_upload_files_{n}_enabled]" id="action_upload_files_{n}_enabled" value="<?php echo $action_params['enabled']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_upload_files_{n}_max_size]" id="action_upload_files_{n}_max_size" value="<?php echo $action_params['max_size']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_upload_files_{n}_min_size]" id="action_upload_files_{n}_min_size" value="<?php echo $action_params['min_size']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_upload_files_{n}_max_error]" id="action_upload_files_{n}_max_error" value="<?php echo $action_params['max_error']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_upload_files_{n}_min_error]" id="action_upload_files_{n}_min_error" value="<?php echo $action_params['min_error']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_upload_files_{n}_type_error]" id="action_upload_files_{n}_type_error" value="<?php echo $action_params['type_error']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_upload_files_{n}_safe_file_name]" id="action_upload_files_{n}_safe_file_name" value="<?php echo $action_params['safe_file_name']; ?>" />
	<input type="hidden" id="chronoaction_id_{n}" name="chronoaction_id[{n}]" value="{n}" />
	<input type="hidden" name="chronoaction[{n}][type]" value="upload_files" />
</div>
<!--end_element_code-->
<div class="element_config" id="cfaction_upload_files_element_config">
	<?php echo $PluginTabsHelper->Header(array('settings' => 'Settings', 'help' => 'Help'), 'upload_files_config_{n}'); ?>
	<?php echo $PluginTabsHelper->tabStart('settings'); ?>
		<?php echo $HtmlHelper->input('action_upload_files_{n}_enabled_config', array('type' => 'select', 'label' => 'Enabled', 'options' => array(0 => 'No', 1 => 'Yes'))); ?>
		<?php echo $HtmlHelper->input('action_upload_files_{n}_files_config', array('type' => 'text', 'label' => "Files", 'class' => 'big_input', 'value' => '', 'smalldesc' => 'Config string, e.g: field1:jpg-png-gif,field2:zip-rar,field3:doc-docx-pdf')); ?>
		<?php echo $HtmlHelper->input('action_upload_files_{n}_upload_path_config', array('type' => 'text', 'label' => "Upload Path", 'class' => 'big_input', 'smalldesc' => 'The files upload path, if left empty, files will be uploaded under this path:<br />JOOMLA_PATH/components/com_chronoforms/uploads/FORM_NAME/')); ?>
		<?php echo $HtmlHelper->input('action_upload_files_{n}_max_size_config', array('type' => 'text', 'label' => "Max Size in KB", 'class' => 'medium_input', 'value' => '')); ?>
		<?php echo $HtmlHelper->input('action_upload_files_{n}_min_size_config', array('type' => 'text', 'label' => "Min Size in KB", 'class' => 'medium_input', 'value' => '')); ?>
		<?php echo $HtmlHelper->input('action_upload_files_{n}_max_error_config', array('type' => 'text', 'label' => "Max Size Error Message", 'class' => 'medium_input', 'value' => '')); ?>
		<?php echo $HtmlHelper->input('action_upload_files_{n}_min_error_config', array('type' => 'text', 'label' => "Min Size Error Message", 'class' => 'medium_input', 'value' => '')); ?>
		<?php echo $HtmlHelper->input('action_upload_files_{n}_type_error_config', array('type' => 'text', 'label' => "File type Error Message", 'class' => 'medium_input', 'value' => '')); ?>
		<?php echo $HtmlHelper->input('action_upload_files_{n}_safe_file_name_config', array('type' => 'select', 'label' => 'Safe File name', 'options' => array(0 => 'No', 1 => 'Yes'), 'smalldesc' => 'This will remove any special characters from the file name.')); ?>
		
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('help'); ?>
		<p>
			<ul>
				<li>All configured fields share the same max and minimux size check, if you have different sizes then add another "Files upload" action.</li>
				<li>Files data will be stroed after processing under the $form->files AND $form->data['_PLUGINS_']['upload_files'].</li>
				<li>You can add a "Custom code" action after this one and use this code to check/user the response data stored : print_r2($form->data['_PLUGINS_']['upload_files']);</li>
			</ul>
		</p>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
</div>