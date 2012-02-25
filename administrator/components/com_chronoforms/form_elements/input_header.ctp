<div class="dragable" id="input_header">Header Text</div>
<div class="element_code" id="input_header_element">
	<label id="input_header_{n}_label" class="header_label">Header</label>
	<p><?php echo $element_params['code']; ?></p>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_header_{n}_multiline_start]', array('type' => 'hidden', 'id' => 'input_header_{n}_multiline_start', 'value' => $element_params['multiline_start'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_header_{n}_multiline_add]', array('type' => 'hidden', 'id' => 'input_header_{n}_multiline_add', 'value' => $element_params['multiline_add'])); ?>
	
	<textarea name="chronofield[{n}][input_header_{n}_code]" id="input_header_{n}_code" style="display:none"><?php echo htmlspecialchars($element_params['code']); ?></textarea>
    <input type="hidden" name="chronofield[{n}][input_header_{n}_clean]" id="input_header_{n}_clean" value="<?php echo $element_params['clean']; ?>" />
	<input type="hidden" id="chronofield_id_{n}" name="chronofield_id" value="{n}" />
    <input type="hidden" name="chronofield[{n}][tag]" value="input" />
    <input type="hidden" name="chronofield[{n}][type]" value="header" />
</div>
<div class="element_config" id="input_header_element_config">
	<?php echo $PluginTabsHelper->Header(array('general' => 'General'), 'input_header_element_config_{n}'); ?>
	<?php echo $PluginTabsHelper->tabStart('general'); ?>
		<?php echo $HtmlHelper->input('input_header_{n}_clean_config', array('type' => 'checkbox', 'label' => 'Pure code', 'class' => 'small_input', 'value' => '1', 'rule' => "bool", 'smalldesc' => 'Should the code be outputed without being included inside any stuff ?')); ?>
		
		<a class="editor_toggler_link" onclick="toggleEditor('input_header_{n}_code_config');return false;">Add/Remove editor</a>
		<?php echo $HtmlHelper->input('input_header_{n}_code_config', array('type' => 'textarea', 'label' => 'Code', 'class' => 'text_editor', 'label_over' => true, 'rows' => 20, 'cols' => 70, 'style' => 'width:450px !important;')); ?>
		
		<?php echo $HtmlHelper->input('input_header_{n}_multiline_start_config', array('type' => 'checkbox', 'label' => 'Start a Multi field row', 'value' => '1', 'rule' => "bool")); ?>
		<?php echo $HtmlHelper->input('input_header_{n}_multiline_add_config', array('type' => 'checkbox', 'label' => 'Add to a Multi field row', 'value' => '1', 'rule' => "bool")); ?>
		
	<?php echo $PluginTabsHelper->tabEnd(); ?>
</div>