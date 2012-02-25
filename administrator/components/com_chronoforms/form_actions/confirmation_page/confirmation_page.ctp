<div class="dragable" id="cfaction_confirmation_page">Confirmation Page</div>
<!--start_element_code-->
<div class="element_code" id="cfaction_confirmation_page_element">
	<label class="action_label">Confirmation Page</label>
	<div id="cfactionevent_confirmation_page_{n}_show" class="form_event good_event">
		<label class="form_event_label">On Show</label>
	</div>
	<div id="cfactionevent_confirmation_page_{n}_confirm" class="form_event good_event">
		<label class="form_event_label">On Confirm</label>
	</div>
	<div id="cfactionevent_confirmation_page_{n}_back" class="form_event bad_event">
		<label class="form_event_label">On Back</label>
	</div>
	<input type="hidden" name="chronoaction[{n}][action_confirmation_page_{n}_buttons]" id="action_confirmation_page_{n}_buttons" value="<?php echo $action_params['buttons']; ?>" />
	<textarea name="chronoaction[{n}][action_confirmation_page_{n}_content1]" id="action_confirmation_page_{n}_content1" style="display:none"><?php echo htmlspecialchars($action_params['content1']); ?></textarea>
    <input type="hidden" id="chronoaction_id_{n}" name="chronoaction_id[{n}]" value="{n}" />
	<input type="hidden" name="chronoaction[{n}][type]" value="confirmation_page" />
</div>
<!--end_element_code-->
<div class="element_config" id="cfaction_confirmation_page_element_config">
	<?php echo $PluginTabsHelper->Header(array('settings' => 'Settings', 'help' => 'Help'), 'confirmation_page_config_{n}'); ?>
	<?php echo $PluginTabsHelper->tabStart('settings'); ?>
		<?php echo $HtmlHelper->input('action_confirmation_page_{n}_buttons_config', array('type' => 'select', 'label' => 'Enable Buttons', 'options' => array(0 => 'No', 1 => 'Yes'), 'smalldesc' => 'Should the plugin add the 2 confirm and back buttons to the end of the page ?')); ?>
		
		<?php echo $HtmlHelper->input('action_confirmation_page_{n}_content1_config', array('type' => 'textarea', 'label' => "Page Code", 'rows' => 20, 'cols' => 70, 'smalldesc' => 'any code can be placed here, any PHP code should include the PHP tags, fields names inside curly brackets will be replaced by their values.')); ?>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('help'); ?>
		<p>
			<ul>
				<li>You may use PHP code with php tags.</li>
				<li>You may use any field name inside 2 curly brackets.</li>
				<li>You may add your own buttons code and disable the buttons option, both your button names should equal "confirmation_page", your back button value should = "_back" and your confirm/submit button value should = "_confirm".</li>
			</ul>
		</p>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
</div>