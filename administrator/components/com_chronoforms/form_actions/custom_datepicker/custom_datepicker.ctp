<div class="dragable" id="cfaction_custom_datepicker">Custom Datepicker</div>
<!--start_element_code-->
<div class="element_code" id="cfaction_custom_datepicker_element">
	<label class="action_label" style="display: block; float:none!important;">Custom Datepicker</label>
	<textarea name="chronoaction[{n}][action_custom_datepicker_{n}_content1]" id="action_custom_datepicker_{n}_content1" style="display:none"><?php echo $action_params['content1']; ?></textarea>
    <input type="hidden" name="chronoaction[{n}][action_custom_datepicker_{n}_field_class]" id="action_custom_datepicker_{n}_field_class" value="<?php echo $action_params['field_class']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_custom_datepicker_{n}_pickerClass]" id="action_custom_datepicker_{n}_pickerClass" value="<?php echo $action_params['pickerClass']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_custom_datepicker_{n}_format]" id="action_custom_datepicker_{n}_format" value="<?php echo $action_params['format']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_custom_datepicker_{n}_inputOutputFormat]" id="action_custom_datepicker_{n}_inputOutputFormat" value="<?php echo $action_params['inputOutputFormat']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_custom_datepicker_{n}_allowEmpty]" id="action_custom_datepicker_{n}_allowEmpty" value="<?php echo $action_params['allowEmpty']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_custom_datepicker_{n}_timePicker]" id="action_custom_datepicker_{n}_timePicker" value="<?php echo $action_params['timePicker']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_custom_datepicker_{n}_timePickerOnly]" id="action_custom_datepicker_{n}_timePickerOnly" value="<?php echo $action_params['timePickerOnly']; ?>" />
	
	<input type="hidden" id="chronoaction_id_{n}" name="chronoaction_id[{n}]" value="{n}" />
	<input type="hidden" name="chronoaction[{n}][type]" value="custom_datepicker" />
</div>
<!--end_element_code-->
<div class="element_config" id="cfaction_custom_datepicker_element_config">
	<?php echo $PluginTabsHelper->Header(array('settings' => 'Settings', 'help' => 'Help'), 'custom_datepicker_config_{n}'); ?>
	<?php echo $PluginTabsHelper->tabStart('settings'); ?>
		<?php echo $HtmlHelper->input('action_custom_datepicker_{n}_field_class_config', array('type' => 'text', 'label' => "Field Class", 'class' => 'medium_input', 'smalldesc' => "The class name assigned to the field(s) which will be used as date field.")); ?>
		<?php echo $HtmlHelper->input('action_custom_datepicker_{n}_pickerClass_config', array('type' => 'text', 'label' => "Picker Class", 'class' => 'medium_input', 'smalldesc' => "The class for the picker itself, will control how the calendar looks like.")); ?>
		<?php echo $HtmlHelper->input('action_custom_datepicker_{n}_format_config', array('type' => 'text', 'label' => "Date format shown", 'class' => 'medium_input', 'smalldesc' => "The format shown inside the visible field for the user in the form.")); ?>
		<?php echo $HtmlHelper->input('action_custom_datepicker_{n}_inputOutputFormat_config', array('type' => 'text', 'label' => "Date format posted", 'class' => 'medium_input', 'smalldesc' => "The date format stored in the field and posted when the form is submitted.")); ?>
		<?php echo $HtmlHelper->input('action_custom_datepicker_{n}_allowEmpty_config', array('type' => 'select', 'label' => 'Allow Empty ?', 'options' => array(0 => 'No', 1 => 'Yes'), 'smalldesc' => 'Allow the field to be empty, will load the field with empty value.')); ?>
		<?php echo $HtmlHelper->input('action_custom_datepicker_{n}_timePicker_config', array('type' => 'select', 'label' => 'Load Time picker ?', 'options' => array(0 => 'No', 1 => 'Yes'), 'smalldesc' => 'Load the time picker after selecting a date ?')); ?>
		<?php echo $HtmlHelper->input('action_custom_datepicker_{n}_timePickerOnly_config', array('type' => 'select', 'label' => 'Time picker Only ?', 'options' => array(0 => 'No', 1 => 'Yes'), 'smalldesc' => 'Should this date field be a time picker only ? if yes then no date selection will be shown.')); ?>
		
		<?php echo $HtmlHelper->input('action_custom_datepicker_{n}_content1_config', array('type' => 'textarea', 'label' => "Extra options extension", 'rows' => 10, 'cols' => 50, 'smalldesc' => "Add extra picker options here, e.g:<br />days: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'], startView: 'decades'")); ?>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('help'); ?>
		<p>
			<ul>
				<li>Add your fields class then start configuring your picker.</li>
				<li>All picker options and config are available here: <br />http://www.monkeyphysics.com/mootools/script/2/datepicker.</li>
			</ul>
		</p>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
</div>