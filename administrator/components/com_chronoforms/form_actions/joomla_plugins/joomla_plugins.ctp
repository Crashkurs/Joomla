<div class="dragable" id="cfaction_joomla_plugins">Joomla Plugins</div>
<!--start_element_code-->
<div class="element_code" id="cfaction_joomla_plugins_element">
	<label class="action_label" style="display: block; float:none!important;">Joomla Plugins</label>
	
	<input type="hidden" id="chronoaction_id_{n}" name="chronoaction_id[{n}]" value="{n}" />
	<input type="hidden" name="chronoaction[{n}][type]" value="joomla_plugins" />
</div>
<!--end_element_code-->
<div class="element_config" id="cfaction_joomla_plugins_element_config">
	<?php echo $PluginTabsHelper->Header(array('settings' => 'Settings', 'help' => 'Help'), 'joomla_plugins_config_{n}'); ?>
	<?php echo $PluginTabsHelper->tabStart('settings'); ?>
		
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('help'); ?>
		<p>
			<ul>
				<li>This plugin will run the Joomla plugins in the form "output" in the buffer.</li>
			</ul>
		</p>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
</div>