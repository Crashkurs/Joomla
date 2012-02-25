<div class="dragable" id="cfaction_joomla_login">Joomla Login</div>
<!--start_element_code-->
<div class="element_code" id="cfaction_joomla_login_element">
	<label class="action_label" style="display: block; float:none!important;">Joomla Login</label>
	<div id="cfactionevent_joomla_login_{n}_success" class="form_event good_event">
		<label class="form_event_label">OnSuccess</label>
	</div>
	<div id="cfactionevent_joomla_login_{n}_fail" class="form_event bad_event">
		<label class="form_event_label">OnFail</label>
	</div>
	<input type="hidden" name="chronoaction[{n}][action_joomla_login_{n}_username]" id="action_joomla_login_{n}_username" value="<?php echo $action_params['username']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_joomla_login_{n}_password]" id="action_joomla_login_{n}_password" value="<?php echo $action_params['password']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_joomla_login_{n}_redirect_url]" id="action_joomla_login_{n}_redirect_url" value="<?php echo $action_params['redirect_url']; ?>" />
	
	<input type="hidden" id="chronoaction_id_{n}" name="chronoaction_id[{n}]" value="{n}" />
	<input type="hidden" name="chronoaction[{n}][type]" value="joomla_login" />
</div>
<!--end_element_code-->
<div class="element_config" id="cfaction_joomla_login_element_config">
	<?php echo $PluginTabsHelper->Header(array('fields' => 'Fields', 'settings' => 'Settings', 'help' => 'Help'), 'joomla_login_config_{n}'); ?>
	<?php echo $PluginTabsHelper->tabStart('fields'); ?>
		<?php echo $HtmlHelper->input('action_joomla_login_{n}_username_config', array('type' => 'text', 'label' => 'Username field name', 'class' => 'medium_input', 'smalldesc' => 'The name of the field which is going to hold the Username data')); ?>
		<?php echo $HtmlHelper->input('action_joomla_login_{n}_password_config', array('type' => 'text', 'label' => 'Password field name', 'class' => 'medium_input', 'smalldesc' => 'The name of the field which is going to hold the Password data')); ?>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('settings'); ?>
		<?php echo $HtmlHelper->input('action_joomla_login_{n}_redirect_url_config', array('type' => 'text', 'label' => 'Redirect URL', 'class' => 'big_input', 'smalldesc' => 'The URL to redirect to after login.')); ?>
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