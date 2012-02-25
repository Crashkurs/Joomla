<div class="dragable" id="cfaction_load_css">Load CSS</div>
<!--start_element_code-->
<div class="element_code" id="cfaction_load_css_element">
	<label class="action_label" style="display: block; float:none!important;">Load CSS</label>
	<textarea name="chronoaction[{n}][action_load_css_{n}_content1]" id="action_load_css_{n}_content1" style="display:none"><?php echo $action_params['content1']; ?></textarea>
    
	<input type="hidden" id="chronoaction_id_{n}" name="chronoaction_id[{n}]" value="{n}" />
	<input type="hidden" name="chronoaction[{n}][type]" value="load_css" />
</div>
<!--end_element_code-->
<div class="element_config" id="cfaction_load_css_element_config">
	 <?php echo $PluginTabsHelper->Header(array('settings' => 'Settings', 'help' => 'Help'), 'load_css_config_{n}'); ?>
	<?php echo $PluginTabsHelper->tabStart('settings'); ?>
		<?php echo $HtmlHelper->input('action_load_css_{n}_content1_config', array('type' => 'textarea', 'label' => "CSS code", 'rows' => 20, 'cols' => 70, 'smalldesc' => 'CSS code withOUT syle tags.')); ?>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('help'); ?>
		<p>
			<ul>
				<li>Mainly should be used for CSS code, do NOT use style tags here.</li>
				<li>You may use PHP code with php tags.</li>
			</ul>
		</p>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
</div>