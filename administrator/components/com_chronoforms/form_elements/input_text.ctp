<div class="dragable" id="input_text">Text Box</div>
<div class="element_code" id="input_text_element">
	<label for="<?php echo $element_params['input_id']; ?>" id="input_text_{n}_label" class="text_label"><?php echo $element_params['label_text']; ?></label>
	<input type="text" name="text_{n}_input_name" id="text_{n}_input_id" value="<?php echo $element_params['input_value']; ?>" maxlength="<?php echo $element_params['input_maxlength']; ?>" size="<?php echo $element_params['input_size']; ?>" />
	<?php echo $HtmlHelper->input('chronofield[{n}][input_text_{n}_input_id]', array('type' => 'hidden', 'id' => 'input_text_{n}_input_id', 'value' => $element_params['input_id'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_text_{n}_label_text]', array('type' => 'hidden', 'id' => 'input_text_{n}_label_text', 'value' => $element_params['label_text'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_text_{n}_input_name]', array('type' => 'hidden', 'id' => 'input_text_{n}_input_name', 'value' => $element_params['input_name'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_text_{n}_input_value]', array('type' => 'hidden', 'id' => 'input_text_{n}_input_value', 'value' => $element_params['input_value'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_text_{n}_input_maxlength]', array('type' => 'hidden', 'id' => 'input_text_{n}_input_maxlength', 'value' => $element_params['input_maxlength'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_text_{n}_input_size]', array('type' => 'hidden', 'id' => 'input_text_{n}_input_size', 'value' => $element_params['input_size'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_text_{n}_input_class]', array('type' => 'hidden', 'id' => 'input_text_{n}_input_class', 'value' => $element_params['input_class'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_text_{n}_input_title]', array('type' => 'hidden', 'id' => 'input_text_{n}_input_title', 'value' => $element_params['input_title'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_text_{n}_label_over]', array('type' => 'hidden', 'id' => 'input_text_{n}_label_over', 'value' => $element_params['label_over'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_text_{n}_hide_label]', array('type' => 'hidden', 'id' => 'input_text_{n}_hide_label', 'value' => $element_params['hide_label'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_text_{n}_multiline_start]', array('type' => 'hidden', 'id' => 'input_text_{n}_multiline_start', 'value' => $element_params['multiline_start'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_text_{n}_multiline_add]', array('type' => 'hidden', 'id' => 'input_text_{n}_multiline_add', 'value' => $element_params['multiline_add'])); ?>
	
    <textarea name="chronofield[{n}][input_text_{n}_validations]" id="input_text_{n}_validations" style="display:none"><?php echo $element_params['validations']; ?></textarea>
    <textarea name="chronofield[{n}][input_text_{n}_instructions]" id="input_text_{n}_instructions" style="display:none"><?php echo $element_params['instructions']; ?></textarea>
    <textarea name="chronofield[{n}][input_text_{n}_tooltip]" id="input_text_{n}_tooltip" style="display:none"><?php echo $element_params['tooltip']; ?></textarea>
    <input type="hidden" id="chronofield_id_{n}" name="chronofield_id" value="{n}" />
    <input type="hidden" name="chronofield[{n}][tag]" value="input" />
    <input type="hidden" name="chronofield[{n}][type]" value="text" />
</div>
<div class="element_config" id="input_text_element_config">
	<?php echo $PluginTabsHelper->Header(array('general' => 'General', 'other' => 'Other', 'validation' => 'Validation'), 'input_text_element_config_{n}'); ?>
	<?php echo $PluginTabsHelper->tabStart('general'); ?>
		<?php echo $HtmlHelper->input('input_text_{n}_input_name_config', array('type' => 'text', 'label' => 'Field Name', 'class' => 'small_input', 'value' => '')); ?>
		<?php echo $HtmlHelper->input('input_text_{n}_input_id_config', array('type' => 'text', 'label' => 'Field ID', 'class' => 'small_input', 'value' => '')); ?>
		<?php echo $HtmlHelper->input('input_text_{n}_input_value_config', array('type' => 'text', 'label' => 'Field Default Value', 'class' => 'small_input', 'value' => '')); ?>
		<?php echo $HtmlHelper->input('input_text_{n}_input_maxlength_config', array('type' => 'text', 'label' => 'Field Max Length', 'class' => 'small_input', 'value' => '')); ?>
		<?php echo $HtmlHelper->input('input_text_{n}_input_size_config', array('type' => 'text', 'label' => 'Field Size', 'class' => 'small_input', 'value' => '')); ?>
		<?php echo $HtmlHelper->input('input_text_{n}_input_class_config', array('type' => 'text', 'label' => 'Field Class', 'class' => 'small_input', 'value' => '')); ?>
		<?php echo $HtmlHelper->input('input_text_{n}_input_title_config', array('type' => 'text', 'label' => 'Field Title', 'class' => 'small_input', 'value' => '')); ?>
		<?php echo $HtmlHelper->input('input_text_{n}_label_text_config', array('type' => 'text', 'label' => 'Label Text', 'class' => 'small_input', 'value' => '')); ?>
		
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('other'); ?>
		<?php echo $HtmlHelper->input('input_text_{n}_label_over_config', array('type' => 'checkbox', 'label' => 'Label Over', 'value' => '1', 'rule' => "bool")); ?>
		<?php echo $HtmlHelper->input('input_text_{n}_hide_label_config', array('type' => 'checkbox', 'label' => 'Hide Label', 'value' => '1', 'rule' => "bool")); ?>
		<?php echo $HtmlHelper->input('input_text_{n}_instructions_config', array('type' => 'textarea', 'label' => 'Instructions for users', 'rows' => 5, 'cols' => 50)); ?>
		<?php echo $HtmlHelper->input('input_text_{n}_tooltip_config', array('type' => 'textarea', 'label' => 'Tooltip', 'rows' => 5, 'cols' => 50)); ?>
		<?php echo $HtmlHelper->input('input_text_{n}_multiline_start_config', array('type' => 'checkbox', 'label' => 'Start a Multi field row', 'value' => '1', 'rule' => "bool")); ?>
		<?php echo $HtmlHelper->input('input_text_{n}_multiline_add_config', array('type' => 'checkbox', 'label' => 'Add to a Multi field row', 'value' => '1', 'rule' => "bool")); ?>
		
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('validation'); ?>
		<?php echo $HtmlHelper->input('input_text_{n}_validations_config', array('type' => 'checkbox', 'label' => 'Required', 'class' => 'small_input', 'value' => 'required', 'rule' => "split", 'splitter' => ",")); ?>
		<?php echo $HtmlHelper->input('input_text_{n}_validations_config', array('type' => 'checkbox', 'label' => 'Alpha', 'class' => 'small_input', 'value' => 'alpha', 'rule' => "split", 'splitter' => ",")); ?>
		<?php echo $HtmlHelper->input('input_text_{n}_validations_config', array('type' => 'checkbox', 'label' => 'AlphaNum', 'class' => 'small_input', 'value' => 'alphanum', 'rule' => "split", 'splitter' => ",")); ?>
		<?php echo $HtmlHelper->input('input_text_{n}_validations_config', array('type' => 'checkbox', 'label' => 'Digit', 'class' => 'small_input', 'value' => 'digit', 'rule' => "split", 'splitter' => ",")); ?>
		<?php echo $HtmlHelper->input('input_text_{n}_validations_config', array('type' => 'checkbox', 'label' => 'No Digit', 'class' => 'small_input', 'value' => 'nodigit', 'rule' => "split", 'splitter' => ",")); ?>
		<?php echo $HtmlHelper->input('input_text_{n}_validations_config', array('type' => 'checkbox', 'label' => 'Number', 'class' => 'small_input', 'value' => 'number', 'rule' => "split", 'splitter' => ",")); ?>
		<?php echo $HtmlHelper->input('input_text_{n}_validations_config', array('type' => 'checkbox', 'label' => 'Email', 'class' => 'small_input', 'value' => 'email', 'rule' => "split", 'splitter' => ",")); ?>
		<?php echo $HtmlHelper->input('input_text_{n}_validations_config', array('type' => 'checkbox', 'label' => 'Phone', 'class' => 'small_input', 'value' => 'phone', 'rule' => "split", 'splitter' => ",")); ?>
		<?php echo $HtmlHelper->input('input_text_{n}_validations_config', array('type' => 'checkbox', 'label' => 'International Phone', 'class' => 'small_input', 'value' => 'phone_inter', 'rule' => "split", 'splitter' => ",")); ?>
		<?php echo $HtmlHelper->input('input_text_{n}_validations_config', array('type' => 'checkbox', 'label' => 'URL', 'class' => 'small_input', 'value' => 'url', 'rule' => "split", 'splitter' => ",")); ?>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
</div>