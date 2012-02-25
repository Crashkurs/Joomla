<div class="dragable" id="input_textarea">Textarea</div>
<div class="element_code" id="input_textarea_element">
	<label for="<?php echo $element_params['input_id']; ?>" id="input_textarea_{n}_label" class="textarea_label"><?php echo $element_params['label_text']; ?></label>
	<textarea name="textarea_{n}_input_name" id="textarea_{n}_input_id"><?php echo $element_params['input_value']; ?></textarea>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_textarea_{n}_input_id]', array('type' => 'hidden', 'id' => 'input_textarea_{n}_input_id', 'value' => $element_params['input_id'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_textarea_{n}_label_text]', array('type' => 'hidden', 'id' => 'input_textarea_{n}_label_text', 'value' => $element_params['label_text'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_textarea_{n}_input_name]', array('type' => 'hidden', 'id' => 'input_textarea_{n}_input_name', 'value' => $element_params['input_name'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_textarea_{n}_input_value]', array('type' => 'hidden', 'id' => 'input_textarea_{n}_input_value', 'value' => $element_params['input_value'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_textarea_{n}_input_class]', array('type' => 'hidden', 'id' => 'input_textarea_{n}_input_class', 'value' => $element_params['input_class'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_textarea_{n}_input_title]', array('type' => 'hidden', 'id' => 'input_textarea_{n}_input_title', 'value' => $element_params['input_title'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_textarea_{n}_label_over]', array('type' => 'hidden', 'id' => 'input_textarea_{n}_label_over', 'value' => $element_params['label_over'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_textarea_{n}_hide_label]', array('type' => 'hidden', 'id' => 'input_textarea_{n}_hide_label', 'value' => $element_params['hide_label'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_textarea_{n}_input_cols]', array('type' => 'hidden', 'id' => 'input_textarea_{n}_input_cols', 'value' => $element_params['input_cols'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_textarea_{n}_input_rows]', array('type' => 'hidden', 'id' => 'input_textarea_{n}_input_rows', 'value' => $element_params['input_rows'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_textarea_{n}_wysiwyg_editor]', array('type' => 'hidden', 'id' => 'input_textarea_{n}_wysiwyg_editor', 'value' => $element_params['wysiwyg_editor'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_textarea_{n}_editor_buttons]', array('type' => 'hidden', 'id' => 'input_textarea_{n}_editor_buttons', 'value' => $element_params['editor_buttons'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_textarea_{n}_editor_width]', array('type' => 'hidden', 'id' => 'input_textarea_{n}_editor_width', 'value' => $element_params['editor_width'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_textarea_{n}_editor_height]', array('type' => 'hidden', 'id' => 'input_textarea_{n}_editor_height', 'value' => $element_params['editor_height'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_textarea_{n}_multiline_start]', array('type' => 'hidden', 'id' => 'input_textarea_{n}_multiline_start', 'value' => $element_params['multiline_start'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_textarea_{n}_multiline_add]', array('type' => 'hidden', 'id' => 'input_textarea_{n}_multiline_add', 'value' => $element_params['multiline_add'])); ?>
	
	<textarea name="chronofield[{n}][input_textarea_{n}_validations]" id="input_textarea_{n}_validations" style="display:none"><?php echo $element_params['validations']; ?></textarea>
    <textarea name="chronofield[{n}][input_textarea_{n}_instructions]" id="input_textarea_{n}_instructions" style="display:none"><?php echo $element_params['instructions']; ?></textarea>
    <textarea name="chronofield[{n}][input_textarea_{n}_tooltip]" id="input_textarea_{n}_tooltip" style="display:none"><?php echo $element_params['tooltip']; ?></textarea>
    <input type="hidden" id="chronofield_id_{n}" name="chronofield_id" value="{n}" />
    <input type="hidden" name="chronofield[{n}][tag]" value="input" />
    <input type="hidden" name="chronofield[{n}][type]" value="textarea" />
</div>
<div class="element_config" id="input_textarea_element_config">
	<?php echo $PluginTabsHelper->Header(array('general' => 'General', 'other' => 'Other', 'editors' => 'Editors', 'validation' => 'Validation'), 'input_textarea_element_config_{n}'); ?>
	<?php echo $PluginTabsHelper->tabStart('general'); ?>
		<?php echo $HtmlHelper->input('input_textarea_{n}_input_name_config', array('type' => 'text', 'label' => 'Field Name', 'class' => 'small_input', 'value' => '')); ?>
		<?php echo $HtmlHelper->input('input_textarea_{n}_input_id_config', array('type' => 'text', 'label' => 'Field ID', 'class' => 'small_input', 'value' => '')); ?>
		<?php echo $HtmlHelper->input('input_textarea_{n}_input_value_config', array('type' => 'text', 'label' => 'Field Default Value', 'class' => 'small_input', 'value' => '')); ?>
		<?php echo $HtmlHelper->input('input_textarea_{n}_input_cols_config', array('type' => 'text', 'label' => 'Field Columns', 'class' => 'small_input', 'value' => '')); ?>
		<?php echo $HtmlHelper->input('input_textarea_{n}_input_rows_config', array('type' => 'text', 'label' => 'Field Rows', 'class' => 'small_input', 'value' => '')); ?>
		<?php echo $HtmlHelper->input('input_textarea_{n}_input_class_config', array('type' => 'text', 'label' => 'Field Class', 'class' => 'small_input', 'value' => '')); ?>
		<?php echo $HtmlHelper->input('input_textarea_{n}_input_title_config', array('type' => 'text', 'label' => 'Field title', 'class' => 'small_input', 'value' => '')); ?>
		<?php echo $HtmlHelper->input('input_textarea_{n}_label_text_config', array('type' => 'text', 'label' => 'Label Text', 'class' => 'small_input', 'value' => '')); ?>
		
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('other'); ?>
		<?php echo $HtmlHelper->input('input_textarea_{n}_label_over_config', array('type' => 'checkbox', 'label' => 'Label Over', 'value' => '1', 'rule' => "bool")); ?>
		<?php echo $HtmlHelper->input('input_textarea_{n}_hide_label_config', array('type' => 'checkbox', 'label' => 'Hide Label', 'value' => '1', 'rule' => "bool")); ?>
		<?php echo $HtmlHelper->input('input_textarea_{n}_instructions_config', array('type' => 'textarea', 'label' => 'Instructions for users', 'rows' => 5, 'cols' => 50)); ?>
		<?php echo $HtmlHelper->input('input_textarea_{n}_tooltip_config', array('type' => 'textarea', 'label' => 'Tooltip', 'rows' => 5, 'cols' => 50)); ?>
		<?php echo $HtmlHelper->input('input_textarea_{n}_multiline_start_config', array('type' => 'checkbox', 'label' => 'Start a Multi field row', 'value' => '1', 'rule' => "bool")); ?>
		<?php echo $HtmlHelper->input('input_textarea_{n}_multiline_add_config', array('type' => 'checkbox', 'label' => 'Add to a Multi field row', 'value' => '1', 'rule' => "bool")); ?>
		
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('editors'); ?>
		<?php echo $HtmlHelper->input('input_textarea_{n}_wysiwyg_editor_config', array('type' => 'checkbox', 'label' => 'Enable WYSIWYG Editor', 'value' => '1', 'rule' => "bool", 'smalldesc' => 'Enable the WYSIWYG editor for this text area ?')); ?>
		<?php echo $HtmlHelper->input('input_textarea_{n}_editor_buttons_config', array('type' => 'checkbox', 'label' => 'Show editor buttons', 'value' => '1', 'rule' => "bool", 'smalldesc' => 'Enable the editor buttons ?')); ?>
		<?php echo $HtmlHelper->input('input_textarea_{n}_editor_width_config', array('type' => 'text', 'label' => 'Editor Width', 'class' => 'small_input', 'value' => '')); ?>
		<?php echo $HtmlHelper->input('input_textarea_{n}_editor_height_config', array('type' => 'text', 'label' => 'Wditor Height', 'class' => 'small_input', 'value' => '')); ?>
		
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('validation'); ?>
		<?php echo $HtmlHelper->input('input_textarea_{n}_validations_config', array('type' => 'checkbox', 'label' => 'Required', 'class' => 'small_input', 'value' => 'required', 'rule' => "split", 'splitter' => ",")); ?>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
</div>