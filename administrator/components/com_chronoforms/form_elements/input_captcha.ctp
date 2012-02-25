<div class="dragable" id="input_captcha">Captcha Input</div>
<div class="element_code" id="input_captcha_element">
	<label for="<?php echo $element_params['input_id']; ?>" id="input_captcha_{n}_label" class="text_label"><?php echo $element_params['label_text']; ?></label>
	<input type="text" name="captcha_{n}_input_name" id="captcha_{n}_input_id" value="<?php echo $element_params['input_value']; ?>" maxlength="<?php echo $element_params['input_maxlength']; ?>" size="<?php echo $element_params['input_size']; ?>" />
	<?php echo $HtmlHelper->input('chronofield[{n}][input_captcha_{n}_input_id]', array('type' => 'hidden', 'id' => 'input_captcha_{n}_input_id', 'value' => $element_params['input_id'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_captcha_{n}_label_text]', array('type' => 'hidden', 'id' => 'input_captcha_{n}_label_text', 'value' => $element_params['label_text'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_captcha_{n}_input_name]', array('type' => 'hidden', 'id' => 'input_captcha_{n}_input_name', 'value' => $element_params['input_name'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_captcha_{n}_input_value]', array('type' => 'hidden', 'id' => 'input_captcha_{n}_input_value', 'value' => $element_params['input_value'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_captcha_{n}_input_maxlength]', array('type' => 'hidden', 'id' => 'input_captcha_{n}_input_maxlength', 'value' => $element_params['input_maxlength'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_captcha_{n}_input_size]', array('type' => 'hidden', 'id' => 'input_captcha_{n}_input_size', 'value' => $element_params['input_size'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_captcha_{n}_input_class]', array('type' => 'hidden', 'id' => 'input_captcha_{n}_input_class', 'value' => $element_params['input_class'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_captcha_{n}_input_title]', array('type' => 'hidden', 'id' => 'input_captcha_{n}_input_title', 'value' => $element_params['input_title'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_captcha_{n}_label_over]', array('type' => 'hidden', 'id' => 'input_captcha_{n}_label_over', 'value' => $element_params['label_over'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_captcha_{n}_hide_label]', array('type' => 'hidden', 'id' => 'input_captcha_{n}_hide_label', 'value' => $element_params['hide_label'])); ?>
	
	
	<textarea name="chronofield[{n}][input_captcha_{n}_validations]" id="input_captcha_{n}_validations" style="display:none"><?php echo $element_params['validations']; ?></textarea>
    <textarea name="chronofield[{n}][input_captcha_{n}_instructions]" id="input_captcha_{n}_instructions" style="display:none"><?php echo $element_params['instructions']; ?></textarea>
    <textarea name="chronofield[{n}][input_captcha_{n}_tooltip]" id="input_captcha_{n}_tooltip" style="display:none"><?php echo $element_params['tooltip']; ?></textarea>
    <input type="hidden" id="chronofield_id_{n}" name="chronofield_id" value="{n}" />
    <input type="hidden" name="chronofield[{n}][tag]" value="input" />
    <input type="hidden" name="chronofield[{n}][type]" value="captcha" />
	<input type="hidden" name="chronofield[{n}][real_type]" value="text" />
	<input type="hidden" name="chronofield[{n}][after]" value="{chronocaptcha_img}" />
</div>
<div class="element_config" id="input_captcha_element_config">
	<?php echo $PluginTabsHelper->Header(array('general' => 'General', 'other' => 'Other', 'validation' => 'Validation'), 'input_captcha_element_config_{n}'); ?>
	<?php echo $PluginTabsHelper->tabStart('general'); ?>
		<?php echo $HtmlHelper->input('input_captcha_{n}_input_name_config', array('type' => 'text', 'disabled' => 'true', 'label' => 'Field Name', 'class' => 'small_input', 'value' => '')); ?>
		<?php echo $HtmlHelper->input('input_captcha_{n}_input_id_config', array('type' => 'text', 'label' => 'Field ID', 'class' => 'small_input', 'value' => '')); ?>
		<?php echo $HtmlHelper->input('input_captcha_{n}_input_value_config', array('type' => 'text', 'label' => 'Field Default Value', 'class' => 'small_input', 'value' => '')); ?>
		<?php echo $HtmlHelper->input('input_captcha_{n}_input_maxlength_config', array('type' => 'text', 'label' => 'Field Max Length', 'class' => 'small_input', 'value' => '')); ?>
		<?php echo $HtmlHelper->input('input_captcha_{n}_input_size_config', array('type' => 'text', 'label' => 'Field Size', 'class' => 'small_input', 'value' => '')); ?>
		<?php echo $HtmlHelper->input('input_captcha_{n}_input_class_config', array('type' => 'text', 'label' => 'Field Class', 'class' => 'small_input', 'value' => '')); ?>
		<?php echo $HtmlHelper->input('input_captcha_{n}_input_title_config', array('type' => 'text', 'label' => 'Field title', 'class' => 'small_input', 'value' => '')); ?>
		<?php echo $HtmlHelper->input('input_captcha_{n}_label_text_config', array('type' => 'text', 'label' => 'Label Text', 'class' => 'small_input', 'value' => '')); ?>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('other'); ?>
		<?php echo $HtmlHelper->input('input_captcha_{n}_label_over_config', array('type' => 'checkbox', 'label' => 'Label Over', 'value' => '1', 'rule' => "bool")); ?>
		<?php echo $HtmlHelper->input('input_captcha_{n}_hide_label_config', array('type' => 'checkbox', 'label' => 'Hide Label', 'value' => '1', 'rule' => "bool")); ?>
		<?php echo $HtmlHelper->input('input_captcha_{n}_instructions_config', array('type' => 'textarea', 'label' => 'Instructions for users', 'rows' => 5, 'cols' => 50)); ?>
		<?php echo $HtmlHelper->input('input_captcha_{n}_tooltip_config', array('type' => 'textarea', 'label' => 'Tooltip', 'rows' => 5, 'cols' => 50)); ?>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('validation'); ?>
		<?php echo $HtmlHelper->input('input_captcha_{n}_validations_config', array('type' => 'checkbox', 'label' => 'Required', 'class' => 'small_input', 'value' => 'required', 'rule' => "split", 'splitter' => ",")); ?>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
</div>