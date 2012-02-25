<?php
require_once(JPATH_SITE.DS."administrator".DS."components".DS."com_chronoforms".DS."helpers".DS."tabs_helper.php");
$PluginTabsHelper = new TabsHelper();
?>
<div class="dragable" id="cfaction_authorize_net">Authorize.net - Trial</div>
<!--start_element_code-->
<div class="element_code" id="cfaction_authorize_net_element">
	<label class="action_label">Authorize.net - Trial</label>
	<div id="cfactionevent_authorize_net_{n}_approved" class="form_event good_event">
		<label class="form_event_label">OnApproved</label>
	</div>
	<div id="cfactionevent_authorize_net_{n}_declined" class="form_event bad_event">
		<label class="form_event_label">OnDeclined</label>
	</div>
	<div id="cfactionevent_authorize_net_{n}_error" class="form_event bad_event">
		<label class="form_event_label">OnError</label>
	</div>
	<div id="cfactionevent_authorize_net_{n}_held" class="form_event bad_event">
		<label class="form_event_label">OnHold</label>
	</div>
	<input type="hidden" name="chronoaction[{n}][action_authorize_net_{n}_x_card_num]" id="action_authorize_net_{n}_x_card_num" value="<?php echo $action_params['x_card_num']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_authorize_net_{n}_x_exp_date_m]" id="action_authorize_net_{n}_x_exp_date_m" value="<?php echo $action_params['x_exp_date_m']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_authorize_net_{n}_x_exp_date_y]" id="action_authorize_net_{n}_x_exp_date_y" value="<?php echo $action_params['x_exp_date_y']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_authorize_net_{n}_x_description]" id="action_authorize_net_{n}_x_description" value="<?php echo $action_params['x_description']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_authorize_net_{n}_x_amount]" id="action_authorize_net_{n}_x_amount" value="<?php echo $action_params['x_amount']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_authorize_net_{n}_x_first_name]" id="action_authorize_net_{n}_x_first_name" value="<?php echo $action_params['x_first_name']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_authorize_net_{n}_x_last_name]" id="action_authorize_net_{n}_x_last_name" value="<?php echo $action_params['x_last_name']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_authorize_net_{n}_x_address]" id="action_authorize_net_{n}_x_address" value="<?php echo $action_params['x_address']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_authorize_net_{n}_x_city]" id="action_authorize_net_{n}_x_city" value="<?php echo $action_params['x_city']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_authorize_net_{n}_x_state]" id="action_authorize_net_{n}_x_state" value="<?php echo $action_params['x_state']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_authorize_net_{n}_x_zip]" id="action_authorize_net_{n}_x_zip" value="<?php echo $action_params['x_zip']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_authorize_net_{n}_x_invoice_num]" id="action_authorize_net_{n}_x_invoice_num" value="<?php echo $action_params['x_invoice_num']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_authorize_net_{n}_x_country]" id="action_authorize_net_{n}_x_country" value="<?php echo $action_params['x_country']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_authorize_net_{n}_x_phone]" id="action_authorize_net_{n}_x_phone" value="<?php echo $action_params['x_phone']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_authorize_net_{n}_x_email]" id="action_authorize_net_{n}_x_email" value="<?php echo $action_params['x_email']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_authorize_net_{n}_error_retires]" id="action_authorize_net_{n}_error_retires" value="<?php echo $action_params['error_retires']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_authorize_net_{n}_testing]" id="action_authorize_net_{n}_testing" value="<?php echo $action_params['testing']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_authorize_net_{n}_debugging]" id="action_authorize_net_{n}_debugging" value="<?php echo $action_params['debugging']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_authorize_net_{n}_transkey]" id="action_authorize_net_{n}_transkey" value="<?php echo $action_params['transkey']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_authorize_net_{n}_loginid]" id="action_authorize_net_{n}_loginid" value="<?php echo $action_params['loginid']; ?>" />
	<textarea name="chronoaction[{n}][action_authorize_net_{n}_content1]" id="action_authorize_net_{n}_content1" style="display:none"><?php echo $action_params['content1']; ?></textarea>
    <input type="hidden" id="chronoaction_id_{n}" name="chronoaction_id[{n}]" value="{n}" />
	<input type="hidden" name="chronoaction[{n}][type]" value="authorize_net" />
</div>
<!--end_element_code-->
<div class="element_config" id="cfaction_authorize_net_element_config">
	<?php echo $PluginTabsHelper->Header(array('fields' => 'Fields', 'settings' => 'Settings', 'help' => 'Help'), 'authorize_net_config_{n}'); ?>
	<?php echo $PluginTabsHelper->tabStart('fields'); ?>
		<?php echo $HtmlHelper->input('action_authorize_net_{n}_x_card_num_config', array('type' => 'text', 'label' => "Card's number field", 'class' => 'medium_input', 'value' => '')); ?>
		<?php echo $HtmlHelper->input('action_authorize_net_{n}_x_exp_date_m_config', array('type' => 'text', 'label' => "Card's expiry month field", 'class' => 'medium_input', 'value' => '')); ?>
		<?php echo $HtmlHelper->input('action_authorize_net_{n}_x_exp_date_y_config', array('type' => 'text', 'label' => "Card's expiry year field", 'class' => 'medium_input', 'value' => '')); ?>
		<?php echo $HtmlHelper->input('action_authorize_net_{n}_x_description_config', array('type' => 'text', 'label' => "Transaction description field", 'class' => 'medium_input', 'value' => '')); ?>
		<?php echo $HtmlHelper->input('action_authorize_net_{n}_x_amount_config', array('type' => 'text', 'label' => "Customer's amount field", 'class' => 'medium_input', 'value' => '')); ?>
		<?php echo $HtmlHelper->input('action_authorize_net_{n}_x_first_name_config', array('type' => 'text', 'label' => "Customer's first name field", 'class' => 'medium_input', 'value' => '')); ?>
		<?php echo $HtmlHelper->input('action_authorize_net_{n}_x_last_name_config', array('type' => 'text', 'label' => "Customer's last name field", 'class' => 'medium_input', 'value' => '')); ?>
		<?php echo $HtmlHelper->input('action_authorize_net_{n}_x_address_config', array('type' => 'text', 'label' => "Customer's address field", 'class' => 'medium_input', 'value' => '')); ?>
		<?php echo $HtmlHelper->input('action_authorize_net_{n}_x_city_config', array('type' => 'text', 'label' => "Customer's city field", 'class' => 'medium_input', 'value' => '')); ?>
		<?php echo $HtmlHelper->input('action_authorize_net_{n}_x_state_config', array('type' => 'text', 'label' => "Customer's state field", 'class' => 'medium_input', 'value' => '')); ?>
		<?php echo $HtmlHelper->input('action_authorize_net_{n}_x_zip_config', array('type' => 'text', 'label' => "Customer's zip code field", 'class' => 'medium_input', 'value' => '')); ?>
				
		<?php echo $HtmlHelper->input('action_authorize_net_{n}_x_country_config', array('type' => 'text', 'label' => "Customer's country field", 'class' => 'medium_input', 'value' => '')); ?>
		<?php echo $HtmlHelper->input('action_authorize_net_{n}_x_phone_config', array('type' => 'text', 'label' => "Customer's phone field", 'class' => 'medium_input', 'value' => '')); ?>
		<?php echo $HtmlHelper->input('action_authorize_net_{n}_x_email_config', array('type' => 'text', 'label' => "Customer's email field", 'class' => 'medium_input', 'value' => '')); ?>
		<?php echo $HtmlHelper->input('action_authorize_net_{n}_x_invoice_num_config', array('type' => 'text', 'label' => 'Invoice # field', 'class' => 'medium_input', 'value' => '')); ?>
		<?php echo $HtmlHelper->input('action_authorize_net_{n}_content1_config', array('type' => 'textarea', 'label' => 'Extra fields', 'rows' => 5, 'cols' => 50)); ?>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('settings'); ?>
		<?php echo $HtmlHelper->input('action_authorize_net_{n}_loginid_config', array('type' => 'text', 'label' => "API Login ID", 'class' => 'medium_input', 'value' => '')); ?>
		<?php echo $HtmlHelper->input('action_authorize_net_{n}_transkey_config', array('type' => 'text', 'label' => "Transaction Key", 'class' => 'medium_input', 'value' => '')); ?>
		<?php echo $HtmlHelper->input('action_authorize_net_{n}_debugging_config', array('type' => 'select', 'label' => 'Debugging', 'options' => array(0 => 'No', 1 => 'Yes'))); ?>
		<?php echo $HtmlHelper->input('action_authorize_net_{n}_testing_config', array('type' => 'select', 'label' => 'Testing', 'options' => array(0 => 'No', 1 => 'Yes'))); ?>
		<?php echo $HtmlHelper->input('action_authorize_net_{n}_error_retires_config', array('type' => 'text', 'label' => "Error Retires", 'class' => 'small_input', 'value' => '')); ?>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('help'); ?>
		<p>
			<ul>
				<li>Map your form fields names to the fields required by Authorize.net, no spaces should be in the fields name.</li>
				<li>You may map extra fields through the "Extra fields" box, use multi line format, each line should be in this form: authorize.net_field_name=form_field_name</li>
				<li>Enter your authorize.net account settings.</li>
				<li>If you enable the debugging then you will see the Authorize.net response in the same event page.</li>
				<li>Map your form fields names to the fields required by Authorize.net, no spaces should be in the fields name.</li>
				<li>Some response data will be stored after the response is received under the $form->data['_PLUGINS_']['authorize_net'].</li>
				<li>You can add a "Custom code" action after this one and use this code to check/user the response data stored : print_r2($form->data['_PLUGINS_']['authorize_net']);</li>
			</ul>
		</p>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
</div>