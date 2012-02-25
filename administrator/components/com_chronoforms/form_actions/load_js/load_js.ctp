<div class="dragable" id="cfaction_load_js">Load JS</div>
<!--start_element_code-->
<div class="element_code" id="cfaction_load_js_element">
	<label class="action_label" style="display: block; float:none!important;">Load JS</label>
	<textarea name="chronoaction[{n}][action_load_js_{n}_content1]" id="action_load_js_{n}_content1" style="display:none"><?php echo $action_params['content1']; ?></textarea>
    <input type="hidden" name="chronoaction[{n}][action_load_js_{n}_dynamic_file]" id="action_load_js_{n}_dynamic_file" value="<?php echo $action_params['dynamic_file']; ?>" />
	
	<input type="hidden" id="chronoaction_id_{n}" name="chronoaction_id[{n}]" value="{n}" />
	<input type="hidden" name="chronoaction[{n}][type]" value="load_js" />
</div>
<!--end_element_code-->
<div class="element_config" id="cfaction_load_js_element_config">
	<?php echo $PluginTabsHelper->Header(array('settings' => 'Settings', 'help' => 'Help'), 'load_js_config_{n}'); ?>
	<?php echo $PluginTabsHelper->tabStart('settings'); ?>
		<?php echo $HtmlHelper->input('action_load_js_{n}_dynamic_file_config', array('type' => 'select', 'label' => 'Dynamic File', 'options' => array(0 => 'No', 1 => 'Yes'), 'smalldesc' => 'Load the code inside a dynamic file instead of the page head, useful in few situations.')); ?>
		<?php echo $HtmlHelper->input('action_load_js_{n}_content1_config', array('type' => 'textarea', 'label' => "Code", 'rows' => 20, 'cols' => 70, 'smalldesc' => 'JavaScript code withOUT script tags.')); ?>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('help'); ?>
		<p>
			<ul>
				<li>JavaScript code withOUT script tags.</li>
				<li>You may use PHP code with php tags.</li>
				<li>The dynamic files may be helpful if you want the page head source code to be cleaner, it should help with loading JS code in the correct order, because Joomla gives priority to files loading over header scripts loading.</li>
			</ul>
		</p>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
</div>