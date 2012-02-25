<div class="dragable" id="cfaction_joomla_registration">Joomla User Registration</div>
<!--start_element_code-->
<div class="element_code" id="cfaction_joomla_registration_element">
	<label class="action_label" style="display: block; float:none!important;">Joomla User Registration</label>
	<div id="cfactionevent_joomla_registration_{n}_success" class="form_event good_event">
		<label class="form_event_label">OnSuccess</label>
	</div>
	<div id="cfactionevent_joomla_registration_{n}_fail" class="form_event bad_event">
		<label class="form_event_label">OnFail</label>
	</div>
	<input type="hidden" name="chronoaction[{n}][action_joomla_registration_{n}_name]" id="action_joomla_registration_{n}_name" value="<?php echo $action_params['name']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_joomla_registration_{n}_username]" id="action_joomla_registration_{n}_username" value="<?php echo $action_params['username']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_joomla_registration_{n}_email]" id="action_joomla_registration_{n}_email" value="<?php echo $action_params['email']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_joomla_registration_{n}_password]" id="action_joomla_registration_{n}_password" value="<?php echo $action_params['password']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_joomla_registration_{n}_password2]" id="action_joomla_registration_{n}_password2" value="<?php echo $action_params['password2']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_joomla_registration_{n}_override_allow_user_registration]" id="action_joomla_registration_{n}_override_allow_user_registration" value="<?php echo $action_params['override_allow_user_registration']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_joomla_registration_{n}_new_usertype]" id="action_joomla_registration_{n}_new_usertype" value="<?php echo $action_params['new_usertype']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_joomla_registration_{n}_useractivation]" id="action_joomla_registration_{n}_useractivation" value="<?php echo $action_params['useractivation']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_joomla_registration_{n}_random_password]" id="action_joomla_registration_{n}_random_password" value="<?php echo $action_params['random_password']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_joomla_registration_{n}_auto_login]" id="action_joomla_registration_{n}_auto_login" value="<?php echo $action_params['auto_login']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_joomla_registration_{n}_display_reg_complete]" id="action_joomla_registration_{n}_display_reg_complete" value="<?php echo $action_params['display_reg_complete']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_joomla_registration_{n}_send_joo_activation]" id="action_joomla_registration_{n}_send_joo_activation" value="<?php echo $action_params['send_joo_activation']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_joomla_registration_{n}_enable_cb_support]" id="action_joomla_registration_{n}_enable_cb_support" value="<?php echo $action_params['enable_cb_support']; ?>" />
	
	<input type="hidden" id="chronoaction_id_{n}" name="chronoaction_id[{n}]" value="{n}" />
	<input type="hidden" name="chronoaction[{n}][type]" value="joomla_registration" />
</div>
<!--end_element_code-->
<div class="element_config" id="cfaction_joomla_registration_element_config">
	<?php echo $PluginTabsHelper->Header(array('fields' => 'Fields', 'settings' => 'Settings', 'cb' => 'CB', 'help' => 'Help'), 'joomla_registration_config_{n}'); ?>
	<?php echo $PluginTabsHelper->tabStart('fields'); ?>
		<?php echo $HtmlHelper->input('action_joomla_registration_{n}_name_config', array('type' => 'text', 'label' => 'Name field name', 'class' => 'medium_input', 'smalldesc' => 'The name of the field which is going to hold the Name data')); ?>
		<?php echo $HtmlHelper->input('action_joomla_registration_{n}_username_config', array('type' => 'text', 'label' => 'Username field name', 'class' => 'medium_input', 'smalldesc' => 'The name of the field which is going to hold the Username data')); ?>
		<?php echo $HtmlHelper->input('action_joomla_registration_{n}_email_config', array('type' => 'text', 'label' => 'Email field name', 'class' => 'medium_input', 'smalldesc' => 'The name of the field which is going to hold the Email data')); ?>
		<?php echo $HtmlHelper->input('action_joomla_registration_{n}_password_config', array('type' => 'text', 'label' => 'Password field name', 'class' => 'medium_input', 'smalldesc' => 'The name of the field which is going to hold the Password data')); ?>
		<?php echo $HtmlHelper->input('action_joomla_registration_{n}_password2_config', array('type' => 'text', 'label' => 'Verify Password field name', 'class' => 'medium_input', 'smalldesc' => 'The name of the field which is going to hold the Verify Password data')); ?>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('settings'); ?>
		<?php echo $HtmlHelper->input('action_joomla_registration_{n}_override_allow_user_registration_config', array('type' => 'select', 'label' => 'Override the Joomla Allow user registration', 'label_over' => true, 'options' => array(0 => 'No', 1 => 'Yes'), 'smalldesc' => 'Its advised that you disable the Joomla allow user registration setting and enable this one so that users are forced to register here.')); ?>
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
		<?php echo $HtmlHelper->input('action_joomla_registration_{n}_new_usertype_config',  array('type' => 'select', 'label' => 'Usertype', 'options' => $options, 'size' => 6, 'multiple' => 'multiple', 'rule' => "split", 'splitter' => ",", 'smalldesc' => 'The new user type/group.')); ?>
		<?php echo $HtmlHelper->input('action_joomla_registration_{n}_useractivation_config', array('type' => 'select', 'label' => 'User activation', 'options' => array(0 => 'No', 1 => 'Yes'), 'smalldesc' => 'Should the user require activation ?')); ?>
		<?php echo $HtmlHelper->input('action_joomla_registration_{n}_send_joo_activation_config', array('type' => 'select', 'label' => 'Send activation', 'options' => array(0 => 'No', 1 => 'Yes'), 'smalldesc' => "Send Joomla's activation email after registration ?")); ?>
		<?php echo $HtmlHelper->input('action_joomla_registration_{n}_random_password_config', array('type' => 'select', 'label' => 'Random Password', 'options' => array(0 => 'No', 1 => 'Yes'), 'smalldesc' => 'Generate Random password for the user ? if yes then you do not have to supply password/verify password fields.')); ?>
		<?php echo $HtmlHelper->input('action_joomla_registration_{n}_auto_login_config', array('type' => 'select', 'label' => 'Auto Login', 'options' => array(0 => 'No', 1 => 'Yes'), 'smalldesc' => 'Auto Login the user after registration ?')); ?>
		<?php echo $HtmlHelper->input('action_joomla_registration_{n}_display_reg_complete_config', array('type' => 'select', 'label' => 'Display status', 'options' => array(0 => 'No', 1 => 'Yes'), 'smalldesc' => 'Display the Joomla registration status message after successfull one ?')); ?>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('cb'); ?>
		<?php echo $HtmlHelper->input('action_joomla_registration_{n}_enable_cb_support_config',  array('type' => 'select', 'label' => 'Enable CB Support', 'options' => array(0 => 'No', 1 => 'Yes'), 'smalldesc' => 'Enable Community Builder support, this will save the data to community builder table, your form fields names should match the CB fields names definded for registration.')); ?>
		
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('help'); ?>
		<p>
			<ul>
				<li>Assign your form field's names to the required fields names under the "Fields" tab.</li>
				<li>Configure the settings under the "Settings" tab.</li>
			</ul>
		</p>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
</div>