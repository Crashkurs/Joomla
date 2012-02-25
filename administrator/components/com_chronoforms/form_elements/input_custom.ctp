<div class="dragable" id="input_custom">Custom Element</div>
<div class="element_code" id="input_custom_element">
	<label for="<?php echo $element_params['input_id']; ?>" id="input_custom_{n}_label" class="custom_label"><?php echo $element_params['label_text']; ?></label>
	<p>Custom Element Here</p>
	<input type="hidden" name="chronofield[{n}][input_custom_{n}_label_text]" id="input_custom_{n}_label_text" value="<?php echo $element_params['label_text']; ?>" />
    <input type="hidden" name="chronofield[{n}][input_custom_{n}_input_name]" id="input_custom_{n}_input_name" value="<?php echo $element_params['input_name']; ?>" />
    <input type="hidden" name="chronofield[{n}][input_custom_{n}_input_id]" id="input_custom_{n}_input_id" value="<?php echo $element_params['input_id']; ?>" />
	<input type="hidden" name="chronofield[{n}][input_custom_{n}_clean]" id="input_custom_{n}_clean" value="<?php echo $element_params['clean']; ?>" />
	<textarea name="chronofield[{n}][input_custom_{n}_code]" id="input_custom_{n}_code" style="display:none"><?php echo htmlspecialchars($element_params['code']); ?></textarea>
    <textarea name="chronofield[{n}][input_custom_{n}_instructions]" id="input_custom_{n}_instructions" style="display:none"><?php echo $element_params['instructions']; ?></textarea>
    <textarea name="chronofield[{n}][input_custom_{n}_tooltip]" id="input_custom_{n}_tooltip" style="display:none"><?php echo $element_params['tooltip']; ?></textarea>
    <input type="hidden" id="chronofield_id_{n}" name="chronofield_id" value="{n}" />
    <input type="hidden" name="chronofield[{n}][tag]" value="input" />
    <input type="hidden" name="chronofield[{n}][type]" value="custom" />
</div>
<div class="element_config" id="input_custom_element_config">
	<?php echo $PluginTabsHelper->Header(array('general' => 'General'), 'input_custom_element_config_{n}'); ?>
	<?php echo $PluginTabsHelper->tabStart('general'); ?>
		<?php echo $HtmlHelper->input('input_custom_{n}_input_name_config', array('type' => 'text', 'label' => 'Field Name', 'class' => 'small_input', 'value' => '', 'smalldesc' => 'can be used to show the server side error messages.')); ?>
		<?php echo $HtmlHelper->input('input_custom_{n}_input_id_config', array('type' => 'text', 'label' => 'Field ID', 'class' => 'small_input', 'value' => '')); ?>
		<?php echo $HtmlHelper->input('input_custom_{n}_label_text_config', array('type' => 'text', 'label' => 'Label Text', 'class' => 'small_input', 'value' => '')); ?>
		<?php echo $HtmlHelper->input('input_custom_{n}_clean_config', array('type' => 'checkbox', 'label' => 'Pure code', 'class' => 'small_input', 'value' => '1', 'rule' => "bool", 'smalldesc' => 'Should the code be outputed without being included inside any stuff ?')); ?>
		<?php echo $HtmlHelper->input('input_custom_{n}_code_config', array('type' => 'textarea', 'label' => 'Code', 'rows' => 15, 'cols' => 50, 'style' => 'width:450px !important;')); ?>
		<?php echo $HtmlHelper->input('input_custom_{n}_instructions_config', array('type' => 'textarea', 'label' => 'Instructions for users', 'rows' => 5, 'cols' => 50)); ?>
		<?php echo $HtmlHelper->input('input_custom_{n}_tooltip_config', array('type' => 'textarea', 'label' => 'Tooltip', 'rows' => 5, 'cols' => 50)); ?>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
</div>