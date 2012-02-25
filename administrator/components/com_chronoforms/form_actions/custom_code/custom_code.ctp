<div class="dragable" id="cfaction_custom_code">Custom Code</div>
<!--start_element_code-->
<div class="element_code" id="cfaction_custom_code_element">
	<label class="action_label" style="display: block; float:none!important;">Custom Code - <?php echo $action_params['action_label']; ?></label>
	<textarea name="chronoaction[{n}][action_custom_code_{n}_content1]" id="action_custom_code_{n}_content1" style="display:none"><?php echo htmlspecialchars($action_params['content1']); ?></textarea>
    <input type="hidden" name="chronoaction[{n}][action_custom_code_{n}_mode]" id="action_custom_code_{n}_mode" value="<?php echo $action_params['mode']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_custom_code_{n}_action_label]" id="action_custom_code_{n}_action_label" value="<?php echo $action_params['action_label']; ?>" />
	
	<input type="hidden" id="chronoaction_id_{n}" name="chronoaction_id[{n}]" value="{n}" />
	<input type="hidden" name="chronoaction[{n}][type]" value="custom_code" />
</div>
<!--end_element_code-->
<div class="element_config" id="cfaction_custom_code_element_config">
	<?php echo $PluginTabsHelper->Header(array('settings' => 'Settings', 'help' => 'Help'), 'custom_code_config_{n}'); ?>
	<?php echo $PluginTabsHelper->tabStart('settings'); ?>
		<?php echo $HtmlHelper->input('action_custom_code_{n}_mode_config', array('type' => 'select', 'label' => 'Mode', 'options' => array('controller' => 'Controller', 'view' => 'View'), 'smalldesc' => 'When should this code run ? during the controller code processing (early) or later when the ouput is viewed.')); ?>
		<?php echo $HtmlHelper->input('action_custom_code_{n}_action_label_config', array('type' => 'text', 'label' => "Action Label", 'class' => 'medium_input', 'smalldesc' => 'Label for your action in the wizard.')); ?>
		<?php echo $HtmlHelper->input('action_custom_code_{n}_content1_config', array('type' => 'textarea', 'label' => "Code", 'rows' => 20, 'cols' => 70, 'smalldesc' => 'any code can be placed here, any PHP code should include the PHP tags.')); ?>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('help'); ?>
		<p>
			<ul>
				<li>You may use PHP code with php tags.</li>
				<li>Running this as Controller is required if you want to do some data processing for some serverside stuff like sending emails, uploading files, saving data or even processing some payment gateway response.</li>
				<li>Running this as View is "advised" if you want to output some data, like any kind of HTML, it depends on when and where you want this data displayed and on which other actions do you have.</li>
				<li>the variable $form->form_output is available for use at both modes, it holds the form view output up to the moment of running this action.</li>
			</ul>
		</p>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
</div>