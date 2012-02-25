<div class="dragable" id="cfaction_authenticator">Authenticator</div>
<!--start_element_code-->
<div class="element_code" id="cfaction_authenticator_element">
	<label class="action_label" style="display: block; float:none!important;">Authenticator</label>
	<div id="cfactionevent_authenticator_{n}_allowed" class="form_event good_event">
		<label class="form_event_label">Allowed</label>
	</div>
	<div id="cfactionevent_authenticator_{n}_denied" class="form_event bad_event">
		<label class="form_event_label">Denied</label>
	</div>
	
	<input type="hidden" name="chronoaction[{n}][action_authenticator_{n}_groups]" id="action_authenticator_{n}_groups" value="<?php echo $action_params['groups']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_authenticator_{n}_guests]" id="action_authenticator_{n}_guests" value="<?php echo $action_params['guests']; ?>" />

	<input type="hidden" id="chronoaction_id_{n}" name="chronoaction_id[{n}]" value="{n}" />
	<input type="hidden" name="chronoaction[{n}][type]" value="authenticator" />
</div>
<!--end_element_code-->
<div class="element_config" id="cfaction_authenticator_element_config">
	<?php echo $PluginTabsHelper->Header(array('settings' => 'Settings', 'help' => 'Help'), 'authenticator_config_{n}'); ?>
	<?php echo $PluginTabsHelper->tabStart('settings'); ?>
		
		<?php
			$database =& JFactory::getDBO();
			$query = "SELECT * FROM `#__usergroups`";
			$database->setQuery($query);
			$options = array();
			$groups = $database->loadObjectList();
			foreach($groups as $group){
				$options[$group->id] = $group->title;
			}
		?>
		<?php echo $HtmlHelper->input('action_authenticator_{n}_groups_config',  array('type' => 'select', 'label' => 'Allowed groups', 'options' => $options, 'size' => 10, 'multiple' => 'multiple', 'rule' => "split", 'splitter' => ",", 'smalldesc' => 'Select the groups authorized.')); ?>
		
		<?php echo $HtmlHelper->input('action_authenticator_{n}_guests_config', array('type' => 'select', 'label' => 'Allow guests', 'options' => array(0 => 'No', 1 => 'Yes'), 'class' => 'medium_input', 'smalldesc' => "Guests are non logged in users, choose wheather you want to allow them access or not.")); ?>
	
		<?php //echo $HtmlHelper->input('action_authenticator_{n}_content1_config', array('type' => 'textarea', 'label' => "Code", 'rows' => 20, 'cols' => 70, 'smalldesc' => 'any code can be placed here, any PHP code should include the PHP tags.')); ?>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('help'); ?>
		<p>
			<ul>
				<li>Select which user groups should be allowed access.</li>
				<li>Insert next form events in the "Allowed" event or insert "Show stopper" in the "Denied" event to halt the form.</li>
			</ul>
		</p>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
</div>