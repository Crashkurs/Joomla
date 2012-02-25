<div class="dragable" id="input_checkbox">Checkbox</div>
<div class="element_code" id="input_checkbox_element">
	<label for="<?php echo $element_params['input_id']; ?>" id="input_checkbox_{n}_label" class="text_label"><?php echo $element_params['label_text']; ?></label>
	<input type="checkbox" name="checkbox_{n}_input_name" id="checkbox_{n}_input_id" value="<?php echo $element_params['input_value']; ?>" />
	
	<?php echo $HtmlHelper->input('chronofield[{n}][input_checkbox_{n}_input_id]', array('type' => 'hidden', 'id' => 'input_checkbox_{n}_input_id', 'value' => $element_params['input_id'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_checkbox_{n}_label_text]', array('type' => 'hidden', 'id' => 'input_checkbox_{n}_label_text', 'value' => $element_params['label_text'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_checkbox_{n}_input_name]', array('type' => 'hidden', 'id' => 'input_checkbox_{n}_input_name', 'value' => $element_params['input_name'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_checkbox_{n}_input_title]', array('type' => 'hidden', 'id' => 'input_checkbox_{n}_input_title', 'value' => $element_params['input_title'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_checkbox_{n}_input_value]', array('type' => 'hidden', 'id' => 'input_checkbox_{n}_input_value', 'value' => $element_params['input_value'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_checkbox_{n}_checked]', array('type' => 'hidden', 'id' => 'input_checkbox_{n}_checked', 'value' => $element_params['checked'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_checkbox_{n}_ghost]', array('type' => 'hidden', 'id' => 'input_checkbox_{n}_ghost', 'value' => $element_params['ghost'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_checkbox_{n}_ghost_value]', array('type' => 'hidden', 'id' => 'input_checkbox_{n}_ghost_value', 'value' => $element_params['ghost_value'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_checkbox_{n}_label_over]', array('type' => 'hidden', 'id' => 'input_checkbox_{n}_label_over', 'value' => $element_params['label_over'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_checkbox_{n}_hide_label]', array('type' => 'hidden', 'id' => 'input_checkbox_{n}_hide_label', 'value' => $element_params['hide_label'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_checkbox_{n}_label_position]', array('type' => 'hidden', 'id' => 'input_checkbox_{n}_label_position', 'value' => $element_params['label_position'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_checkbox_{n}_multiline_start]', array('type' => 'hidden', 'id' => 'input_checkbox_{n}_multiline_start', 'value' => $element_params['multiline_start'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_checkbox_{n}_multiline_add]', array('type' => 'hidden', 'id' => 'input_checkbox_{n}_multiline_add', 'value' => $element_params['multiline_add'])); ?>
	
    <textarea name="chronofield[{n}][input_checkbox_{n}_validations]" id="input_checkbox_{n}_validations" style="display:none"><?php echo $element_params['validations']; ?></textarea>
    <textarea name="chronofield[{n}][input_checkbox_{n}_instructions]" id="input_checkbox_{n}_instructions" style="display:none"><?php echo $element_params['instructions']; ?></textarea>
    <textarea name="chronofield[{n}][input_checkbox_{n}_tooltip]" id="input_checkbox_{n}_tooltip" style="display:none"><?php echo $element_params['tooltip']; ?></textarea>
    <input type="hidden" id="chronofield_id_{n}" name="chronofield_id" value="{n}" />
    <input type="hidden" name="chronofield[{n}][tag]" value="input" />
    <input type="hidden" name="chronofield[{n}][type]" value="checkbox" />
</div>
<div class="element_config" id="input_checkbox_element_config">    
	<?php echo $PluginTabsHelper->Header(array('general' => 'General', 'other' => 'Other', 'validation' => 'Validation', 'ghost' => 'Ghost'), 'input_checkbox_element_config_{n}'); ?>
	<?php echo $PluginTabsHelper->tabStart('general'); ?>
		<?php echo $HtmlHelper->input('input_checkbox_{n}_input_name_config', array('type' => 'text', 'label' => 'Field Name', 'class' => 'small_input', 'value' => '')); ?>
		<?php echo $HtmlHelper->input('input_checkbox_{n}_input_id_config', array('type' => 'text', 'label' => 'Field ID', 'class' => 'small_input', 'value' => '')); ?>
		<?php echo $HtmlHelper->input('input_checkbox_{n}_input_value_config', array('type' => 'text', 'label' => 'Field Default Value', 'class' => 'small_input', 'value' => '')); ?>
		<?php echo $HtmlHelper->input('input_checkbox_{n}_label_text_config', array('type' => 'text', 'label' => 'Label Text', 'class' => 'small_input', 'value' => '')); ?>
		<?php echo $HtmlHelper->input('input_checkbox_{n}_checked_config', array('type' => 'checkbox', 'label' => 'Checked', 'class' => 'small_input', 'value' => '1', 'rule' => "bool")); ?>
		<?php echo $HtmlHelper->input('input_checkbox_{n}_label_position_config', array('type' => 'select', 'label' => 'Label Position', 'options' => array('left' => 'Left', 'right' => 'Right'), 'smalldesc' => 'Right is more appropriate for things like "accept terms and conditions".')); ?>
		<?php echo $HtmlHelper->input('input_checkbox_{n}_input_title_config', array('type' => 'text', 'label' => 'Field title', 'class' => 'small_input', 'value' => '')); ?>
		
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('other'); ?>
		<?php echo $HtmlHelper->input('input_checkbox_{n}_label_over_config', array('type' => 'checkbox', 'label' => 'Label Over', 'value' => '1', 'rule' => "bool")); ?>
		<?php echo $HtmlHelper->input('input_checkbox_{n}_hide_label_config', array('type' => 'checkbox', 'label' => 'Hide Label', 'value' => '1', 'rule' => "bool")); ?>
		<?php echo $HtmlHelper->input('input_checkbox_{n}_instructions_config', array('type' => 'textarea', 'label' => 'Instructions for users', 'rows' => 5, 'cols' => 50)); ?>
		<?php echo $HtmlHelper->input('input_checkbox_{n}_tooltip_config', array('type' => 'textarea', 'label' => 'Tooltip', 'rows' => 5, 'cols' => 50)); ?>
		<?php echo $HtmlHelper->input('input_checkbox_{n}_multiline_start_config', array('type' => 'checkbox', 'label' => 'Start a Multi field row', 'value' => '1', 'rule' => "bool")); ?>
		<?php echo $HtmlHelper->input('input_checkbox_{n}_multiline_add_config', array('type' => 'checkbox', 'label' => 'Add to a Multi field row', 'value' => '1', 'rule' => "bool")); ?>
		
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('validation'); ?>
		<?php echo $HtmlHelper->input('input_checkbox_{n}_validations_config', array('type' => 'checkbox', 'label' => 'Required', 'class' => 'small_input', 'value' => 'required', 'rule' => "split", 'splitter' => ",")); ?>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('ghost'); ?>
		<?php echo $HtmlHelper->input('input_checkbox_{n}_ghost_config', array('type' => 'checkbox', 'label' => 'Enable Ghost', 'class' => 'small_input', 'value' => '1', 'rule' => "bool", 'smalldesc' => 'The ghost is a hidden field with the same name to assure that a key with this field name always exists in the POST array.')); ?>
		<?php echo $HtmlHelper->input('input_checkbox_{n}_ghost_value_config', array('type' => 'text', 'label' => 'Ghost Value', 'value' => '', 'class' => 'medium_input', 'smalldesc' => 'Value here will appear if no choice has been made.')); ?>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
</div>