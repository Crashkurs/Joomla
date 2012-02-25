<?php
require_once(JPATH_SITE.DS."administrator".DS."components".DS."com_chronoforms".DS."helpers".DS."tabs_helper.php");
$PluginTabsHelper = new TabsHelper();
?>
<div class="dragable" id="cfaction_paypal_pro">Paypal Pro - Trial</div>
<!--start_element_code-->
<div class="element_code" id="cfaction_paypal_pro_element">
	<label class="action_label">Paypal Pro - Trial</label>
	<div id="cfactionevent_paypal_pro_{n}_success" class="form_event good_event">
		<label class="form_event_label">On Sucess</label>
	</div>
	<div id="cfactionevent_paypal_pro_{n}_fail" class="form_event bad_event">
		<label class="form_event_label">On Fail</label>
	</div>
	<input type="hidden" name="chronoaction[{n}][action_paypal_pro_{n}_PAYMENTACTION]" id="action_paypal_pro_{n}_PAYMENTACTION" value="<?php echo $action_params['PAYMENTACTION']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_paypal_pro_{n}_AMT]" id="action_paypal_pro_{n}_AMT" value="<?php echo $action_params['AMT']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_paypal_pro_{n}_CREDITCARDTYPE]" id="action_paypal_pro_{n}_CREDITCARDTYPE" value="<?php echo $action_params['CREDITCARDTYPE']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_paypal_pro_{n}_ACCT]" id="action_paypal_pro_{n}_ACCT" value="<?php echo $action_params['ACCT']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_paypal_pro_{n}_EXPDATE_m]" id="action_paypal_pro_{n}_EXPDATE_m" value="<?php echo $action_params['EXPDATE_m']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_paypal_pro_{n}_EXPDATE_y]" id="action_paypal_pro_{n}_EXPDATE_y" value="<?php echo $action_params['EXPDATE_y']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_paypal_pro_{n}_CVV2]" id="action_paypal_pro_{n}_CVV2" value="<?php echo $action_params['CVV2']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_paypal_pro_{n}_FIRSTNAME]" id="action_paypal_pro_{n}_FIRSTNAME" value="<?php echo $action_params['FIRSTNAME']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_paypal_pro_{n}_LASTNAME]" id="action_paypal_pro_{n}_LASTNAME" value="<?php echo $action_params['LASTNAME']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_paypal_pro_{n}_STREET]" id="action_paypal_pro_{n}_STREET" value="<?php echo $action_params['STREET']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_paypal_pro_{n}_CITY]" id="action_paypal_pro_{n}_CITY" value="<?php echo $action_params['CITY']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_paypal_pro_{n}_STATE]" id="action_paypal_pro_{n}_STATE" value="<?php echo $action_params['STATE']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_paypal_pro_{n}_ZIP]" id="action_paypal_pro_{n}_ZIP" value="<?php echo $action_params['ZIP']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_paypal_pro_{n}_COUNTRYCODE]" id="action_paypal_pro_{n}_COUNTRYCODE" value="<?php echo $action_params['COUNTRYCODE']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_paypal_pro_{n}_CURRENCYCODE]" id="action_paypal_pro_{n}_CURRENCYCODE" value="<?php echo $action_params['CURRENCYCODE']; ?>" />
	
	<input type="hidden" name="chronoaction[{n}][action_paypal_pro_{n}_API_USERNAME]" id="action_paypal_pro_{n}_API_USERNAME" value="<?php echo $action_params['API_USERNAME']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_paypal_pro_{n}_API_PASSWORD]" id="action_paypal_pro_{n}_API_PASSWORD" value="<?php echo $action_params['API_PASSWORD']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_paypal_pro_{n}_API_SIGNATURE]" id="action_paypal_pro_{n}_API_SIGNATURE" value="<?php echo $action_params['API_SIGNATURE']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_paypal_pro_{n}_USE_PROXY]" id="action_paypal_pro_{n}_USE_PROXY" value="<?php echo $action_params['USE_PROXY']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_paypal_pro_{n}_PROXY_HOST]" id="action_paypal_pro_{n}_PROXY_HOST" value="<?php echo $action_params['PROXY_HOST']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_paypal_pro_{n}_PROXY_PORT]" id="action_paypal_pro_{n}_PROXY_PORT" value="<?php echo $action_params['PROXY_PORT']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_paypal_pro_{n}_debugging]" id="action_paypal_pro_{n}_debugging" value="<?php echo $action_params['debugging']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_paypal_pro_{n}_testing]" id="action_paypal_pro_{n}_testing" value="<?php echo $action_params['testing']; ?>" />
	
	
	<textarea name="chronoaction[{n}][action_paypal_pro_{n}_content1]" id="action_paypal_pro_{n}_content1" style="display:none"><?php echo $action_params['content1']; ?></textarea>
    <input type="hidden" id="chronoaction_id_{n}" name="chronoaction_id[{n}]" value="{n}" />
	<input type="hidden" name="chronoaction[{n}][type]" value="paypal_pro" />
</div>
<!--end_element_code-->
<div class="element_config" id="cfaction_paypal_pro_element_config">
	<?php echo $PluginTabsHelper->Header(array('fields' => 'Fields', 'settings' => 'Settings', 'help' => 'Help'), 'paypal_pro_config_{n}'); ?>
	<?php echo $PluginTabsHelper->tabStart('fields'); ?>
		<?php echo $HtmlHelper->input('action_paypal_pro_{n}_PAYMENTACTION_config', array('type' => 'hidden')); ?>
		<?php echo $HtmlHelper->input('action_paypal_pro_{n}_AMT_config', array('type' => 'text', 'label' => "Amount Field", 'class' => 'medium_input')); ?>
		<?php echo $HtmlHelper->input('action_paypal_pro_{n}_CREDITCARDTYPE_config', array('type' => 'text', 'label' => "Credit Card type Field", 'class' => 'medium_input')); ?>
		<?php echo $HtmlHelper->input('action_paypal_pro_{n}_ACCT_config', array('type' => 'text', 'label' => "Credit Card Number Field", 'class' => 'medium_input')); ?>
		<?php echo $HtmlHelper->input('action_paypal_pro_{n}_EXPDATE_m_config', array('type' => 'text', 'label' => "Credit Card Expiry month field", 'class' => 'medium_input')); ?>
		<?php echo $HtmlHelper->input('action_paypal_pro_{n}_EXPDATE_y_config', array('type' => 'text', 'label' => "Credit Card Expiry year field", 'class' => 'medium_input')); ?>
		<?php echo $HtmlHelper->input('action_paypal_pro_{n}_CVV2_config', array('type' => 'text', 'label' => "CVV2 field", 'class' => 'medium_input')); ?>
		<?php echo $HtmlHelper->input('action_paypal_pro_{n}_FIRSTNAME_config', array('type' => 'text', 'label' => "First Name Field", 'class' => 'medium_input')); ?>
		<?php echo $HtmlHelper->input('action_paypal_pro_{n}_LASTNAME_config', array('type' => 'text', 'label' => "Last Name Field", 'class' => 'medium_input')); ?>
		<?php echo $HtmlHelper->input('action_paypal_pro_{n}_STREET_config', array('type' => 'text', 'label' => "Street Field", 'class' => 'medium_input')); ?>
		<?php echo $HtmlHelper->input('action_paypal_pro_{n}_CITY_config', array('type' => 'text', 'label' => "City Field", 'class' => 'medium_input')); ?>
		<?php echo $HtmlHelper->input('action_paypal_pro_{n}_STATE_config', array('type' => 'text', 'label' => "State Field", 'class' => 'medium_input')); ?>
				
		<?php echo $HtmlHelper->input('action_paypal_pro_{n}_ZIP_config', array('type' => 'text', 'label' => "Zip Field", 'class' => 'medium_input')); ?>
		<?php echo $HtmlHelper->input('action_paypal_pro_{n}_COUNTRYCODE_config', array('type' => 'text', 'label' => "Country Code Field", 'class' => 'medium_input', 'smalldesc' => "2 Characters value, e.g: US, CA, UK..etc")); ?>
		<?php echo $HtmlHelper->input('action_paypal_pro_{n}_CURRENCYCODE_config', array('type' => 'text', 'label' => "Currency Code Field", 'class' => 'medium_input', 'smalldesc' => 'e.g: USD, GBP, EUR..etc')); ?>
		
		<?php echo $HtmlHelper->input('action_paypal_pro_{n}_content1_config', array('type' => 'textarea', 'label' => 'Extra fields', 'rows' => 5, 'cols' => 50)); ?>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('settings'); ?>
		<?php echo $HtmlHelper->input('action_paypal_pro_{n}_API_USERNAME_config', array('type' => 'text', 'label' => "API Username", 'class' => 'medium_input', 'value' => '')); ?>
		<?php echo $HtmlHelper->input('action_paypal_pro_{n}_API_PASSWORD_config', array('type' => 'text', 'label' => "API Password", 'class' => 'medium_input', 'value' => '')); ?>
		<?php echo $HtmlHelper->input('action_paypal_pro_{n}_API_SIGNATURE_config', array('type' => 'text', 'label' => "API Signature", 'class' => 'medium_input', 'value' => '')); ?>
		<?php echo $HtmlHelper->input('action_paypal_pro_{n}_USE_PROXY_config', array('type' => 'select', 'label' => 'Use Proxy ?', 'options' => array(0 => 'No', 1 => 'Yes'))); ?>
		<?php echo $HtmlHelper->input('action_paypal_pro_{n}_PROXY_HOST_config', array('type' => 'text', 'label' => "Proxy host IP", 'class' => 'small_input', 'value' => '')); ?>
		<?php echo $HtmlHelper->input('action_paypal_pro_{n}_PROXY_PORT_config', array('type' => 'text', 'label' => "Proxy Port", 'class' => 'medium_input', 'value' => '')); ?>
		<?php echo $HtmlHelper->input('action_paypal_pro_{n}_debugging_config', array('type' => 'select', 'label' => 'Debugging', 'options' => array(0 => 'No', 1 => 'Yes'))); ?>
		<?php echo $HtmlHelper->input('action_paypal_pro_{n}_testing_config', array('type' => 'select', 'label' => 'Testing', 'options' => array(0 => 'No', 1 => 'Yes'))); ?>
		
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('help'); ?>
		<p>
			<ul>
				<li>This plugin will work only with web payments pro enabled Paypal account, this is available to Paypal users at the US, UK and Canada only at the moment according to Paypal.</li>
				<li>Map your form fields names to the fields required by Paypal Pro, no spaces should be in the fields name.</li>
				<li>You may map extra fields through the "Extra fields" box, use multi line format, each line should be in this form: paypal_field_name=form_field_name</li>
				<li>Enter your Paypal pro api account settings.</li>
				<li>If you enable the debugging then you will see the Paypal Pro response in the same event page.</li>
				<li>Some response data will be stored after the response is received under the $form->data['_PLUGINS_']['paypal_pro'].</li>
				<li>You can add a "Custom code" action after this one and use this code to check/user the response data stored : print_r2($form->data['_PLUGINS_']['paypal_pro']);</li>
			</ul>
		</p>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
</div>