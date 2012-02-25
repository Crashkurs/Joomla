<div class="dragable" id="cfaction_add_system_message">Add System Message</div>
<!--start_element_code-->
<div class="element_code" id="cfaction_add_system_message_element">
	<label class="action_label" style="display: block; float:none!important;">Add System Message</label>
    <input type="hidden" name="chronoaction[{n}][action_add_system_message_{n}_type]" id="action_add_system_message_{n}_type" value="<?php echo $action_params['type']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_add_system_message_{n}_message]" id="action_add_system_message_{n}_message" value="<?php echo $action_params['message']; ?>" />
	
	<input type="hidden" id="chronoaction_id_{n}" name="chronoaction_id[{n}]" value="{n}" />
	<input type="hidden" name="chronoaction[{n}][type]" value="add_system_message" />
</div>
<!--end_element_code-->
<div class="element_config" id="cfaction_add_system_message_element_config">
	<?php echo $PluginTabsHelper->Header(array('settings' => 'Settings', 'help' => 'Help'), 'add_system_message_config_{n}'); ?>
	<?php echo $PluginTabsHelper->tabStart('settings'); ?>
		<?php echo $HtmlHelper->input('action_add_system_message_{n}_type_config', array('type' => 'select', 'label' => 'Message Type', 'options' => array('confirm' => 'Confirm', 'notice' => 'Notice', 'warning' => 'Warning', 'error' => 'Error'), 'smalldesc' => 'Select the message type.')); ?>
		<?php echo $HtmlHelper->input('action_add_system_message_{n}_message_config', array('type' => 'text', 'label' => "Message Text", 'class' => 'medium_input', 'smalldesc' => 'The contents of your message to be shown.')); ?>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('help'); ?>
		<p>
			<ul>
				<li>This action should help you display a system message (similar to the admin system messages displayed when you save a new user/article/form..etc).</li>
			</ul>
		</p>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
</div>