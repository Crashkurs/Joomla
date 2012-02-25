<div class="dragable" id="cfaction_load_captcha">Load Captcha</div>
<!--start_element_code-->
<div class="element_code" id="cfaction_load_captcha_element">
	<label class="action_label">Load Captcha</label>
	<input type="hidden" name="chronoaction[{n}][action_load_captcha_{n}_fonts]" id="action_load_captcha_{n}_fonts" value="<?php echo $action_params['fonts']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_load_captcha_{n}_encoded_image]" id="action_load_captcha_{n}_encoded_image" value="<?php echo $action_params['encoded_image']; ?>" />
	<input type="hidden" id="chronoaction_id_{n}" name="chronoaction_id[{n}]" value="{n}" />
	<input type="hidden" name="chronoaction[{n}][type]" value="load_captcha" />
</div>
<!--end_element_code-->
<div class="element_config" id="cfaction_load_captcha_element_config">
	<?php echo $HtmlHelper->input('action_load_captcha_{n}_fonts_config', array('type' => 'select', 'label' => "True Type Fonts Support", 'options' => array(0 => 'Without fonts support', 1 => 'With fonts support'), 'smalldesc' => 'With fonts support is nicer but it depends on the GD library config at your server.')); ?>
	<?php echo $HtmlHelper->input('action_load_captcha_{n}_encoded_image_config', array('type' => 'select', 'label' => "Load encoded image", 'options' => array(0 => 'No', 1 => 'Yes'), 'smalldesc' => 'With this setting enabled, the image data will be encoded and will be sent with the other page HTML code in the same request.')); ?>
</div>