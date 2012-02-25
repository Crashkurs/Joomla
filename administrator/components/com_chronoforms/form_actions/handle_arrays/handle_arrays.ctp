<div class="dragable" id="cfaction_handle_arrays">Handle Arrays</div>
<!--start_element_code-->
<div class="element_code" id="cfaction_handle_arrays_element">
	<label class="action_label" style="display: block; float:none!important;">Handle Arrays</label>
	<input type="hidden" name="chronoaction[{n}][action_handle_arrays_{n}_delimiter]" id="action_handle_arrays_{n}_delimiter" value="<?php echo $action_params['delimiter']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_handle_arrays_{n}_skipped]" id="action_handle_arrays_{n}_skipped" value="<?php echo $action_params['skipped']; ?>" />
	
	<input type="hidden" id="chronoaction_id_{n}" name="chronoaction_id[{n}]" value="{n}" />
	<input type="hidden" name="chronoaction[{n}][type]" value="handle_arrays" />
</div>
<!--end_element_code-->
<div class="element_config" id="cfaction_handle_arrays_element_config">
	<?php echo $HtmlHelper->input('action_handle_arrays_{n}_delimiter_config', array('type' => 'text', 'label' => "Delimiter", 'class' => 'small_input', 'smalldesc' => 'The delimiter which will be used to concatenate the array values.')); ?>
	<?php echo $HtmlHelper->input('action_handle_arrays_{n}_skipped_config', array('type' => 'text', 'label' => "Skipped fields names", 'class' => 'medium_input', 'smalldesc' => 'Any fields names to be skipped from the concatenation process ? use comma delimited list:<br />field1,field4')); ?>
</div>