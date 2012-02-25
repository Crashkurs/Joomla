<div class="dragable" id="cfaction_session_to_data">Session To Data</div>
<!--start_element_code-->
<div class="element_code" id="cfaction_session_to_data_element">
	<label class="action_label" style="display: block; float:none!important;">Session To Data</label>
	<input type="hidden" name="chronoaction[{n}][action_session_to_data_{n}_namespace]" id="action_session_to_data_{n}_namespace" value="<?php echo $action_params['namespace']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_session_to_data_{n}_key]" id="action_session_to_data_{n}_key" value="<?php echo $action_params['key']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_session_to_data_{n}_clear]" id="action_session_to_data_{n}_clear" value="<?php echo $action_params['clear']; ?>" />
	
	<input type="hidden" id="chronoaction_id_{n}" name="chronoaction_id[{n}]" value="{n}" />
	<input type="hidden" name="chronoaction[{n}][type]" value="session_to_data" />
</div>
<!--end_element_code-->
<div class="element_config" id="cfaction_session_to_data_element_config">
	<?php echo $HtmlHelper->input('action_session_to_data_{n}_namespace_config', array('type' => 'text', 'label' => 'Session Namespace', 'class' => 'medium_input', 'smalldesc' => 'The name space to save this session data at, may be useful if you need to save multiple data instances of the same form without being overwritten, leave empty if you dont know what is this.')); ?>
	<?php echo $HtmlHelper->input('action_session_to_data_{n}_key_config', array('type' => 'text', 'label' => 'Session Key', 'class' => 'medium_input', 'smalldesc' => 'Load the data stored under this key, leave empty if you did not enter a key in the Data to Session action, it will use the form name by default.')); ?>
	<?php echo $HtmlHelper->input('action_session_to_data_{n}_clear_config', array('type' => 'select', 'label' => 'Clear after', 'options' => array(0 => 'No', 1 => 'Yes'), 'smalldesc' => "Should this session data get cleared after the load.")); ?>
	
</div>