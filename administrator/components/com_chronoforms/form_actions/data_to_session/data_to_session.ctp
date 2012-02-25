<div class="dragable" id="cfaction_data_to_session">Data To Session</div>
<!--start_element_code-->
<div class="element_code" id="cfaction_data_to_session_element">
	<label class="action_label" style="display: block; float:none!important;">Data To Session</label>
	<input type="hidden" name="chronoaction[{n}][action_data_to_session_{n}_namespace]" id="action_data_to_session_{n}_namespace" value="<?php echo $action_params['namespace']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_data_to_session_{n}_key]" id="action_data_to_session_{n}_key" value="<?php echo $action_params['key']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_data_to_session_{n}_merge]" id="action_data_to_session_{n}_merge" value="<?php echo $action_params['merge']; ?>" />
	
	<input type="hidden" id="chronoaction_id_{n}" name="chronoaction_id[{n}]" value="{n}" />
	<input type="hidden" name="chronoaction[{n}][type]" value="data_to_session" />
</div>
<!--end_element_code-->
<div class="element_config" id="cfaction_data_to_session_element_config">
	<?php echo $HtmlHelper->input('action_data_to_session_{n}_namespace_config', array('type' => 'text', 'label' => 'Session Namespace', 'class' => 'medium_input', 'smalldesc' => 'The name space to load this session data from, may be useful if you have multiple data instances of the same form loaded in different session namespaces, leave empty if you dont know what is this.')); ?>
	<?php echo $HtmlHelper->input('action_data_to_session_{n}_key_config', array('type' => 'text', 'label' => 'Session Key', 'class' => 'medium_input', 'smalldesc' => 'Leave empty to set the key using the form name, but if you want to exchange data between multiple forms then you will need to set this to some constant.')); ?>
	<?php echo $HtmlHelper->input('action_data_to_session_{n}_merge_config', array('type' => 'select', 'label' => 'Merge data', 'options' => array(0 => 'No', 1 => 'Yes'), 'smalldesc' => 'Merge similar key data if the same key was found at the session ? if no then data will be overwritten.')); ?>
</div>