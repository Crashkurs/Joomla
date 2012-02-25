<div class="dragable" id="cfaction_debugger">Debugger</div>
<!--start_element_code-->
<div class="element_code" id="cfaction_debugger_element">
	<label class="action_label" style="display: block; float:none!important;">Debugger</label>
	<input type="hidden" name="chronoaction[{n}][action_debugger_{n}_reset_after_display]" id="action_debugger_{n}_reset_after_display" value="<?php echo $action_params['reset_after_display']; ?>" />
	
	<input type="hidden" id="chronoaction_id_{n}" name="chronoaction_id[{n}]" value="{n}" />
	<input type="hidden" name="chronoaction[{n}][type]" value="debugger" />
</div>
<!--end_element_code-->
<div class="element_config" id="cfaction_debugger_element_config">
	<?php echo $HtmlHelper->input('action_debugger_{n}_reset_after_display_config', array('type' => 'select', 'label' => 'Reset after display', 'options' => array(0 => 'No', 1 => 'Yes'), 'smalldesc' => 'Reset the debug data after they are displayed ?')); ?>
</div>