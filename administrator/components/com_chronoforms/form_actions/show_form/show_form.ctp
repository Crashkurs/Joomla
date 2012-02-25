<div class="dragable" id="cfaction_show_form">Show Form</div>
<!--start_element_code-->
<div class="element_code" id="cfaction_show_form_element">
	<label class="action_label">Show Form</label>
	<input type="hidden" name="chronoaction[{n}][action_show_form_{n}_action_taken]" id="action_show_form_{n}_action_taken" value="<?php echo $action_params['action_taken']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_show_form_{n}_form_name]" id="action_show_form_{n}_form_name" value="<?php echo $action_params['form_name']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_show_form_{n}_form_event]" id="action_show_form_{n}_form_event" value="<?php echo $action_params['form_event']; ?>" />
	<input type="hidden" id="chronoaction_id_{n}" name="chronoaction_id[{n}]" value="{n}" />
	<input type="hidden" name="chronoaction[{n}][type]" value="show_form" />
</div>
<!--end_element_code-->
<div class="element_config" id="cfaction_show_form_element_config">
	<?php echo $PluginTabsHelper->Header(array('settings' => 'Settings', 'help' => 'Help'), 'show_form_config_{n}'); ?>
	<?php echo $PluginTabsHelper->tabStart('settings'); ?>
		<?php echo $HtmlHelper->input('action_show_form_{n}_action_taken_config', array('type' => 'select', 'label' => 'Action', 'options' => array('load' => 'Load Form', 'redirect' => 'Redirect to Form'), 'smalldesc' => 'How the other form will be loaded ?<br />1- the form will just be loaded (shown) at the currect page.<br />2- the page will be redirected to the url of the other form.')); ?>
		<?php echo $HtmlHelper->input('action_show_form_{n}_form_name_config', array('type' => 'text', 'label' => "Form Name", 'class' => 'medium_input', 'smalldesc' => 'The name of the form to load.')); ?>
		<?php echo $HtmlHelper->input('action_show_form_{n}_form_event_config', array('type' => 'text', 'label' => "Form Event", 'class' => 'medium_input', 'smalldesc' => 'The loaded form event which will be executed.')); ?>
		
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('help'); ?>
		<p>
			<ul>
				<li>Select how the form will be shown.</li>
				<li>Write the name of the form to be loaded.</li>
				<li>Write the form event to be executed when the form is loaded, e.g: "load" OR "submit", if left empty then the "load" event will be used.</li>
			</ul>
		</p>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
</div>