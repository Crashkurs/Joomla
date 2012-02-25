<div class="dragable" id="cfaction_load_recaptcha">Load ReCaptcha</div>
<!--start_element_code-->
<div class="element_code" id="cfaction_load_recaptcha_element">
	<label class="action_label">Load ReCaptcha</label>
	<input type="hidden" name="chronoaction[{n}][action_load_recaptcha_{n}_theme]" id="action_load_recaptcha_{n}_theme" value="<?php echo $action_params['theme']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_load_recaptcha_{n}_lang]" id="action_load_recaptcha_{n}_lang" value="<?php echo $action_params['lang']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_load_recaptcha_{n}_public_key]" id="action_load_recaptcha_{n}_public_key" value="<?php echo $action_params['public_key']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_load_recaptcha_{n}_api_server]" id="action_load_recaptcha_{n}_api_server" value="<?php echo $action_params['api_server']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_load_recaptcha_{n}_api_secure_server]" id="action_load_recaptcha_{n}_api_secure_server" value="<?php echo $action_params['api_secure_server']; ?>" />
	<input type="hidden" id="chronoaction_id_{n}" name="chronoaction_id[{n}]" value="{n}" />
	<input type="hidden" name="chronoaction[{n}][type]" value="load_recaptcha" />
</div>
<!--end_element_code-->
<div class="element_config" id="cfaction_load_recaptcha_element_config">
	<?php echo $PluginTabsHelper->Header(array('settings' => 'Settings', 'advanced' => 'Advanced'), 'load_recaptcha_config_{n}'); ?>
	<?php echo $PluginTabsHelper->tabStart('settings'); ?>
		<?php echo $HtmlHelper->input('action_load_recaptcha_{n}_theme_config', array(
				'type' => 'select', 
				'label' => 'Theme', 
				'options' => array(
					'clean' => 'Clean', 
					'red' => 'Red',
					'white' => 'White',
					'blackglass' => 'Blackglass',
					'custom' => 'Custom'
				)
			)
		);
		?>
		<?php echo $HtmlHelper->input('action_load_recaptcha_{n}_lang_config', array(
				'type' => 'select', 
				'label' => 'Language', 
				'options' => array(
					'en' => 'English', 
					'nt' => 'Dutch',
					'fr' => 'French',
					'de' => 'German',
					'pt' => 'Portuguese',
					'ru' => 'Russian',
					'es' => 'Spanish',
					'tr' => 'Turkish'
				)
			)
		);
		?>
		<?php echo $HtmlHelper->input('action_load_recaptcha_{n}_public_key_config', array('type' => 'text', 'label' => "ReCaptcha public key", 'class' => 'big_input', 'value' => '')); ?>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('advanced'); ?>
		<?php echo $HtmlHelper->input('action_load_recaptcha_{n}_api_server_config', array('type' => 'text', 'label' => "ReCaptcha server", 'class' => 'big_input', 'value' => '')); ?>
		<?php echo $HtmlHelper->input('action_load_recaptcha_{n}_api_secure_server_config', array('type' => 'text', 'label' => "ReCaptcha secure server", 'class' => 'big_input', 'value' => '')); ?>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
</div>