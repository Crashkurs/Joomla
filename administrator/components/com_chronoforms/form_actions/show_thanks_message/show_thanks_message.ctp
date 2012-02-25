<div class="dragable" id="cfaction_show_thanks_message">Show Thanks Message</div>
<!--start_element_code-->
<div class="element_code" id="cfaction_show_thanks_message_element">
	<label class="action_label" style="display: block; float:none!important;">Show Thanks Message</label>
	<textarea name="chronoaction[{n}][action_show_thanks_message_{n}_content1]" id="action_show_thanks_message_{n}_content1" style="display:none"><?php echo htmlspecialchars($action_params['content1']); ?></textarea>
    
	<!--
	<a onClick="toggleTemplate('action_show_thanks_message_{n}_content1_cont');return false;">Edit/Hide Template</a>
	<div id="action_show_thanks_message_{n}_content1_cont" style="width:100%; display:none;">	
	<textarea style="display:block; width:95%; height:200px;" name="chronoaction[{n}][action_show_thanks_message_{n}_content1]" id="action_show_thanks_message_{n}_content1" id="action_show_thanks_message_{n}_content1"><?php echo htmlspecialchars($action_params['content1']); ?></textarea>
	<a class="editor_toggler_link" onclick="toggleEditor('action_show_thanks_message_{n}_content1');return false;">Add/Remove editor</a>
	</div>
	-->
	<input type="hidden" id="chronoaction_id_{n}" name="chronoaction_id[{n}]" value="{n}" />
	<input type="hidden" name="chronoaction[{n}][type]" value="show_thanks_message" />
</div>
<!--end_element_code-->
<div class="element_config" id="cfaction_show_thanks_message_element_config">
    <?php echo $PluginTabsHelper->Header(array('settings' => 'Settings', 'help' => 'Help'), 'show_thanks_message_config_{n}'); ?>
	<?php echo $PluginTabsHelper->tabStart('settings'); ?>
		<a class="editor_toggler_link" onclick="toggleEditor('action_show_thanks_message_{n}_content1_config');return false;">Add/Remove editor</a>
		<?php echo $HtmlHelper->input('action_show_thanks_message_{n}_content1_config', array('type' => 'textarea', 'label' => "Code", 'class' => 'text_editor', 'label_over' => true, 'rows' => 20, 'cols' => 70, 'smalldesc' => 'You may use the curly brackets formula to get fields data from the form data array, e.g: {field_name}.')); ?>
		
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('help'); ?>
		<p>
			<ul>
				<li>You may use the curly brackets formula to get fields data from the form data array, e.g: {field_name}.</li>
			</ul>
		</p>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
</div>