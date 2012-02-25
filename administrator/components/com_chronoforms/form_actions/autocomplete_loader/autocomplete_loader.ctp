<div class="dragable" id="cfaction_autocomplete_loader">Autocomplete Loader</div>
<!--start_element_code-->
<div class="element_code" id="cfaction_autocomplete_loader_element">
	<label class="action_label" style="display: block; float:none!important;">Autocomplete Loader</label>
	<input type="hidden" name="chronoaction[{n}][action_autocomplete_loader_{n}_field_id]" id="action_autocomplete_loader_{n}_field_id" value="<?php echo $action_params['field_id']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_autocomplete_loader_{n}_field_name]" id="action_autocomplete_loader_{n}_field_name" value="<?php echo $action_params['field_name']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_autocomplete_loader_{n}_ajax_event]" id="action_autocomplete_loader_{n}_ajax_event" value="<?php echo $action_params['ajax_event']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_autocomplete_loader_{n}_minLength]" id="action_autocomplete_loader_{n}_minLength" value="<?php echo $action_params['minLength']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_autocomplete_loader_{n}_maxChoices]" id="action_autocomplete_loader_{n}_maxChoices" value="<?php echo $action_params['maxChoices']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_autocomplete_loader_{n}_ajax_delay]" id="action_autocomplete_loader_{n}_ajax_delay" value="<?php echo $action_params['ajax_delay']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_autocomplete_loader_{n}_results_cache]" id="action_autocomplete_loader_{n}_results_cache" value="<?php echo $action_params['results_cache']; ?>" />
	
	<input type="hidden" id="chronoaction_id_{n}" name="chronoaction_id[{n}]" value="{n}" />
	<input type="hidden" name="chronoaction[{n}][type]" value="autocomplete_loader" />
</div>
<!--end_element_code-->
<div class="element_config" id="cfaction_autocomplete_loader_element_config">
	 <?php echo $PluginTabsHelper->Header(array('settings' => 'Settings', 'other' => 'Other', 'help' => 'Help'), 'autocomplete_loader_config_{n}'); ?>
	<?php echo $PluginTabsHelper->tabStart('settings'); ?>
		<?php echo $HtmlHelper->input('action_autocomplete_loader_{n}_field_id_config', array('type' => 'text', 'label' => "Field ID", 'smalldesc' => 'The id of the field which will have the auto completer function assigned by this action.')); ?>
		<?php echo $HtmlHelper->input('action_autocomplete_loader_{n}_field_name_config', array('type' => 'text', 'label' => "Field Name", 'smalldesc' => 'The name of the field which will have the auto completer function assigned by this action.')); ?>
		<?php echo $HtmlHelper->input('action_autocomplete_loader_{n}_ajax_event_config', array('type' => 'text', 'label' => "AJAX event", 'class' => 'medium_input', 'smalldesc' => 'The event name which will have the Autocompleter processor action.')); ?>
		
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('other'); ?>
		<?php echo $HtmlHelper->input('action_autocomplete_loader_{n}_minLength_config', array('type' => 'text', 'label' => "Minimum length", 'smalldesc' => 'Minimum number of characters before a request is initiated.')); ?>
		<?php echo $HtmlHelper->input('action_autocomplete_loader_{n}_maxChoices_config', array('type' => 'text', 'label' => "Max choice", 'smalldesc' => 'Maximum number of choices to show.')); ?>
		<?php echo $HtmlHelper->input('action_autocomplete_loader_{n}_ajax_delay_config', array('type' => 'text', 'label' => "AJAX delay", 'smalldesc' => 'Time to wait in MS before a request is initiated.')); ?>
		<?php echo $HtmlHelper->input('action_autocomplete_loader_{n}_results_cache_config', array('type' => 'select', 'label' => 'Cache results', 'options' => array('false' => 'No', 'true' => 'Yes'), 'empty' => false, 'smalldesc' => "Cache the results ?")); ?>
		
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('help'); ?>
		<p>
			<ul>
				<li>Add your field name and id which is going to have the auto loader function then set the event name which will have the processor action.</li>
				<li>Your field should be of type text box or text area.</li>
				<li>You should use an event on the same form, e.g: create a new form event and call it "my_auto_complete".</li>
			</ul>
		</p>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
</div>