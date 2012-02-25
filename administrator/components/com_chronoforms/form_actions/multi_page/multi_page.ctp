<div class="dragable" id="cfaction_multi_page">Multi Page</div>
<!--start_element_code-->
<div class="element_code" id="cfaction_multi_page_element">
	<label class="action_label" style="display: block; float:none!important;">Multi Page</label>
	
	<input type="hidden" name="chronoaction[{n}][action_multi_page_{n}_session_key]" id="action_multi_page_{n}_session_key" value="<?php echo $action_params['session_key']; ?>" />
	
	<input type="hidden" id="chronoaction_id_{n}" name="chronoaction_id[{n}]" value="{n}" />
	<input type="hidden" name="chronoaction[{n}][type]" value="multi_page" />
</div>
<!--end_element_code-->
<div class="element_config" id="cfaction_multi_page_element_config">
	<?php echo $PluginTabsHelper->Header(array('settings' => 'Settings', 'help' => 'Help'), 'multi_page_config_{n}'); ?>
	<?php echo $PluginTabsHelper->tabStart('settings'); ?>
		<?php echo $HtmlHelper->input('action_multi_page_{n}_session_key_config', array('type' => 'select', 'label' => 'Unique Session Key', 'options' => array(0 => 'No', 1 => 'Yes'), 'smalldesc' => 'Add a unique session key for every form instance, this is helpful if more than one form or more than one instance of the same form may be loaded together.<br /><br /> *please note that if this parameter is enabled then you will have to include the session key in the form URL in case of a page navigation.')); ?>
		
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('help'); ?>
		<p>
			<ul>
				<li>This action should be added to the <strong>TOP</strong> of every event used in a different form page so that it can handle all the data transactions between the different pages.</li>
			</ul>
		</p>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
</div>