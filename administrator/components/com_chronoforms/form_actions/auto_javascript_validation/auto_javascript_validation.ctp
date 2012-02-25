<div class="dragable" id="cfaction_auto_javascript_validation">Auto JavaScript Validation</div>
<!--start_element_code-->
<div class="element_code" id="cfaction_auto_javascript_validation_element">
	<label class="action_label" style="display: block; float:none!important;">Auto JavaScript Validation</label>
	
	<input type="hidden" name="chronoaction[{n}][action_auto_javascript_validation_{n}_required]" id="action_auto_javascript_validation_{n}_required" value="<?php echo $action_params['required']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_auto_javascript_validation_{n}_alpha]" id="action_auto_javascript_validation_{n}_alpha" value="<?php echo $action_params['alpha']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_auto_javascript_validation_{n}_alphanum]" id="action_auto_javascript_validation_{n}_alphanum" value="<?php echo $action_params['alphanum']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_auto_javascript_validation_{n}_digit]" id="action_auto_javascript_validation_{n}_digit" value="<?php echo $action_params['digit']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_auto_javascript_validation_{n}_nodigit]" id="action_auto_javascript_validation_{n}_nodigit" value="<?php echo $action_params['nodigit']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_auto_javascript_validation_{n}_number]" id="action_auto_javascript_validation_{n}_number" value="<?php echo $action_params['number']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_auto_javascript_validation_{n}_email]" id="action_auto_javascript_validation_{n}_email" value="<?php echo $action_params['email']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_auto_javascript_validation_{n}_phone]" id="action_auto_javascript_validation_{n}_phone" value="<?php echo $action_params['phone']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_auto_javascript_validation_{n}_phone_inter]" id="action_auto_javascript_validation_{n}_phone_inter" value="<?php echo $action_params['phone_inter']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_auto_javascript_validation_{n}_url]" id="action_auto_javascript_validation_{n}_url" value="<?php echo $action_params['url']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_auto_javascript_validation_{n}_image]" id="action_auto_javascript_validation_{n}_image" value="<?php echo $action_params['image']; ?>" />
	
	<input type="hidden" id="chronoaction_id_{n}" name="chronoaction_id[{n}]" value="{n}" />
	<input type="hidden" name="chronoaction[{n}][type]" value="auto_javascript_validation" />
</div>
<!--end_element_code-->
<div class="element_config" id="cfaction_auto_javascript_validation_element_config">
    <?php echo $PluginTabsHelper->Header(array('fields' => 'Fields', 'help' => 'Help'), 'auto_javascript_validation_config_{n}'); ?>
	<?php echo $PluginTabsHelper->tabStart('fields'); ?>
		<?php echo $HtmlHelper->input('action_auto_javascript_validation_{n}_required_config', array('type' => 'text', 'label' => "Required", 'class' => 'medium_input', 'value' => '', 'smalldesc' => "Comma delimited list of required fields names, these fields should exist in the data array in order to pass this check.")); ?>
		<?php echo $HtmlHelper->input('action_auto_javascript_validation_{n}_alpha_config', array('type' => 'text', 'label' => "Alpha", 'class' => 'medium_input', 'value' => '', 'smalldesc' => "Comma delimited list of fields names which should only contain an alpha value.")); ?>
		<?php echo $HtmlHelper->input('action_auto_javascript_validation_{n}_alphanum_config', array('type' => 'text', 'label' => "Alpha Numeric", 'class' => 'medium_input', 'value' => '', 'smalldesc' => "Comma delimited list of fields names which should only contain an alpha numeric value.")); ?>
		<?php echo $HtmlHelper->input('action_auto_javascript_validation_{n}_digit_config', array('type' => 'text', 'label' => "Digit", 'class' => 'medium_input', 'value' => '', 'smalldesc' => "Comma delimited list of fields names which should only contain a digit value.")); ?>
		<?php echo $HtmlHelper->input('action_auto_javascript_validation_{n}_nodigit_config', array('type' => 'text', 'label' => "No Digit", 'class' => 'medium_input', 'value' => '', 'smalldesc' => "Comma delimited list of fields names which should only contain a non digit value.")); ?>
		<?php echo $HtmlHelper->input('action_auto_javascript_validation_{n}_number_config', array('type' => 'text', 'label' => "Number", 'class' => 'medium_input', 'value' => '', 'smalldesc' => "Comma delimited list of fields names which should only contain a number value.")); ?>
		<?php echo $HtmlHelper->input('action_auto_javascript_validation_{n}_email_config', array('type' => 'text', 'label' => "Email", 'class' => 'medium_input', 'value' => '', 'smalldesc' => "Comma delimited list of fields names which should only contain an email value.")); ?>
		<?php echo $HtmlHelper->input('action_auto_javascript_validation_{n}_phone_config', array('type' => 'text', 'label' => "Phone", 'class' => 'medium_input', 'value' => '', 'smalldesc' => "Comma delimited list of fields names which should only contain a phone value.")); ?>
		<?php echo $HtmlHelper->input('action_auto_javascript_validation_{n}_phone_inter_config', array('type' => 'text', 'label' => "International Phone", 'class' => 'medium_input', 'value' => '', 'smalldesc' => "Comma delimited list of fields names which should only contain an international phone value.")); ?>
		<?php echo $HtmlHelper->input('action_auto_javascript_validation_{n}_url_config', array('type' => 'text', 'label' => "URL", 'class' => 'medium_input', 'value' => '', 'smalldesc' => "Comma delimited list of fields names which should only contain URLs.")); ?>
		<?php echo $HtmlHelper->input('action_auto_javascript_validation_{n}_image_config', array('type' => 'text', 'label' => "Image", 'class' => 'medium_input', 'value' => '', 'smalldesc' => "Comma delimited list of fields names which should only contain images (jpg, jpeg, png, gif, bmp).")); ?>
		
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	
	<?php echo $PluginTabsHelper->tabStart('help'); ?>
		<p>
			<ul>
				<li>Enter the fields names you want to check in the text field for the rule you want them to be checked against.</li>
			</ul>
		</p>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
</div>