<div class="dragable" id="cfaction_chrono_connectivity_return">Chrono Connectivity Return to App</div>
<!--start_element_code-->
<div class="element_code" id="cfaction_chrono_connectivity_return_element">
	<label class="action_label" style="display: block; float:none!important;">Chrono Connectivity Return to App</label>
	<input type="hidden" name="chronoaction[{n}][action_chrono_connectivity_return_{n}_purge_old_data]" id="action_chrono_connectivity_return_{n}_purge_old_data" value="<?php echo $action_params['purge_old_data']; ?>" />
	
	<input type="hidden" id="chronoaction_id_{n}" name="chronoaction_id[{n}]" value="{n}" />
	<input type="hidden" name="chronoaction[{n}][type]" value="chrono_connectivity_return" />
</div>
<!--end_element_code-->
<div class="element_config" id="cfaction_chrono_connectivity_return_element_config">
	<?php echo $PluginTabsHelper->Header(array('settings' => 'Settings', 'help' => 'Help'), 'chrono_connectivity_return_config_{n}'); ?>
	<?php echo $PluginTabsHelper->tabStart('settings'); ?>
		<?php echo $HtmlHelper->input('action_chrono_connectivity_return_{n}_purge_old_data_config', array('type' => 'select', 'label' => "Purge Old Data", 'options' => array(0 => 'No', 1 => 'Yes'), 'smalldesc' => 'Should the action remove the session data of the current last executed action before redirecting back to the main connection page ?')); ?>
		
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('help'); ?>
		<p>
			<ul>
				<li>This action will return the user to last page where they left the connection.</li>
			</ul>
		</p>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
</div>