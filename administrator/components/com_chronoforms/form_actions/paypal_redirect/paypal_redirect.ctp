<?php
require_once(JPATH_SITE.DS."administrator".DS."components".DS."com_chronoforms".DS."helpers".DS."tabs_helper.php");
$PluginTabsHelper = new TabsHelper();
?>
<div class="dragable" id="cfaction_paypal_redirect">PayPal Redirect - Trial</div>
<!--start_element_code-->
<div class="element_code" id="cfaction_paypal_redirect_element">
	<label class="action_label">PayPal Redirect - Trial</label>
	
	<input type="hidden" name="chronoaction[{n}][action_paypal_redirect_{n}_cmd]" id="action_paypal_redirect_{n}_cmd" value="<?php echo $action_params['cmd']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_paypal_redirect_{n}_business]" id="action_paypal_redirect_{n}_business" value="<?php echo $action_params['business']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_paypal_redirect_{n}_item_name]" id="action_paypal_redirect_{n}_item_name" value="<?php echo $action_params['item_name']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_paypal_redirect_{n}_amount]" id="action_paypal_redirect_{n}_amount" value="<?php echo $action_params['amount']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_paypal_redirect_{n}_no_shipping]" id="action_paypal_redirect_{n}_no_shipping" value="<?php echo $action_params['no_shipping']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_paypal_redirect_{n}_no_note]" id="action_paypal_redirect_{n}_no_note" value="<?php echo $action_params['no_note']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_paypal_redirect_{n}_currency_code]" id="action_paypal_redirect_{n}_currency_code" value="<?php echo $action_params['currency_code']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_paypal_redirect_{n}_return]" id="action_paypal_redirect_{n}_return" value="<?php echo $action_params['return']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_paypal_redirect_{n}_debug_only]" id="action_paypal_redirect_{n}_debug_only" value="<?php echo $action_params['debug_only']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_paypal_redirect_{n}_sandbox]" id="action_paypal_redirect_{n}_sandbox" value="<?php echo $action_params['sandbox']; ?>" />
	
	<input type="hidden" name="chronoaction[{n}][action_paypal_redirect_{n}_first_name]" id="action_paypal_redirect_{n}_first_name" value="<?php echo $action_params['first_name']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_paypal_redirect_{n}_last_name]" id="action_paypal_redirect_{n}_last_name" value="<?php echo $action_params['last_name']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_paypal_redirect_{n}_address1]" id="action_paypal_redirect_{n}_address1" value="<?php echo $action_params['address1']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_paypal_redirect_{n}_address2]" id="action_paypal_redirect_{n}_address2" value="<?php echo $action_params['address2']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_paypal_redirect_{n}_city]" id="action_paypal_redirect_{n}_city" value="<?php echo $action_params['city']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_paypal_redirect_{n}_state]" id="action_paypal_redirect_{n}_state" value="<?php echo $action_params['state']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_paypal_redirect_{n}_zip]" id="action_paypal_redirect_{n}_zip" value="<?php echo $action_params['zip']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_paypal_redirect_{n}_country]" id="action_paypal_redirect_{n}_country" value="<?php echo $action_params['country']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_paypal_redirect_{n}_night_phone_a]" id="action_paypal_redirect_{n}_night_phone_a" value="<?php echo $action_params['night_phone_a']; ?>" />
	
	
	<textarea name="chronoaction[{n}][action_paypal_redirect_{n}_content1]" id="action_paypal_redirect_{n}_content1" style="display:none"><?php echo $action_params['content1']; ?></textarea>
    <input type="hidden" id="chronoaction_id_{n}" name="chronoaction_id[{n}]" value="{n}" />
	<input type="hidden" name="chronoaction[{n}][type]" value="paypal_redirect" />
</div>
<!--end_element_code-->
<div class="element_config" id="cfaction_paypal_redirect_element_config">
	<?php echo $PluginTabsHelper->Header(array('fields' => 'Fields', 'settings' => 'Settings', 'help' => 'Help'), 'paypal_redirect_config_{n}'); ?>
	<?php echo $PluginTabsHelper->tabStart('fields'); ?>
		<?php echo $HtmlHelper->input('action_paypal_redirect_{n}_item_name_config', array('type' => 'text', 'label' => "Item name field(*)", 'class' => 'medium_input', 'smalldesc' => 'The name of the field which holds the item name.')); ?>
		<?php echo $HtmlHelper->input('action_paypal_redirect_{n}_amount_config', array('type' => 'text', 'label' => "Amount field(*)", 'class' => 'medium_input', 'smalldesc' => 'The name of the field which holds the amount.')); ?>
		<?php echo $HtmlHelper->input('action_paypal_redirect_{n}_first_name_config', array('type' => 'text', 'label' => "Card Holder First name", 'class' => 'medium_input')); ?>
		<?php echo $HtmlHelper->input('action_paypal_redirect_{n}_last_name_config', array('type' => 'text', 'label' => "Card Holder Last name", 'class' => 'medium_input')); ?>
		<?php echo $HtmlHelper->input('action_paypal_redirect_{n}_address1_config', array('type' => 'text', 'label' => "Billing Street Address Field", 'class' => 'medium_input')); ?>
		<?php echo $HtmlHelper->input('action_paypal_redirect_{n}_address2_config', array('type' => 'text', 'label' => "Billing Street Address 2 Field", 'class' => 'medium_input')); ?>
		<?php echo $HtmlHelper->input('action_paypal_redirect_{n}_city_config', array('type' => 'text', 'label' => "Billing City Field", 'class' => 'medium_input')); ?>
		<?php echo $HtmlHelper->input('action_paypal_redirect_{n}_state_config', array('type' => 'text', 'label' => "Billing State Field", 'class' => 'medium_input')); ?>
		<?php echo $HtmlHelper->input('action_paypal_redirect_{n}_zip_config', array('type' => 'text', 'label' => "Billing Zip Field", 'class' => 'medium_input')); ?>
		<?php echo $HtmlHelper->input('action_paypal_redirect_{n}_country_config', array('type' => 'text', 'label' => "Billing Country Field", 'class' => 'medium_input')); ?>
		<?php echo $HtmlHelper->input('action_paypal_redirect_{n}_night_phone_a_config', array('type' => 'text', 'label' => "Phone Field", 'class' => 'medium_input')); ?>
					
		<?php echo $HtmlHelper->input('action_paypal_redirect_{n}_content1_config', array('type' => 'textarea', 'label' => 'Extra fields', 'rows' => 5, 'cols' => 50)); ?>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('settings'); ?>
		<?php echo $HtmlHelper->input('action_paypal_redirect_{n}_cmd_config', array('type' => 'text', 'label' => "Payment Command", 'class' => 'medium_input', 'smalldesc' => 'Changing this will affect the paypal page, you can check the possible values at the paypal docs.')); ?>
		<?php echo $HtmlHelper->input('action_paypal_redirect_{n}_business_config', array('type' => 'text', 'label' => "Paypal address", 'class' => 'medium_input', 'smalldesc' => 'Your PayPal business address.')); ?>
		<?php echo $HtmlHelper->input('action_paypal_redirect_{n}_no_shipping_config', array('type' => 'select', 'label' => 'No Shipping ?', 'options' => array(0 => 'No', 1 => 'Yes'), 'smalldesc' => 'Select the no shipping parameter value.')); ?>
		<?php echo $HtmlHelper->input('action_paypal_redirect_{n}_no_note_config', array('type' => 'select', 'label' => 'No Note ?', 'options' => array(0 => 'No', 1 => 'Yes'), 'smalldesc' => 'Will show a debug output for the data sent to the gateway but will not redirect.')); ?>
		<?php echo $HtmlHelper->input('action_paypal_redirect_{n}_currency_code_config', array('type' => 'text', 'label' => "Currency Code", 'class' => 'small_input', 'smalldesc' => 'Your 2 characters currency code.')); ?>
		<?php echo $HtmlHelper->input('action_paypal_redirect_{n}_return_config', array('type' => 'text', 'label' => "Return URL", 'class' => 'medium_input', 'smalldesc' => 'Set the url to which the payment page will be redirected after payment is completed or canceled.')); ?>
		<?php echo $HtmlHelper->input('action_paypal_redirect_{n}_debug_only_config', array('type' => 'select', 'label' => 'Debug only?', 'options' => array(0 => 'No', 1 => 'Yes'), 'smalldesc' => 'Will not redirect the page but will show the redirect URL instead.')); ?>
		<?php echo $HtmlHelper->input('action_paypal_redirect_{n}_sandbox_config', array('type' => 'select', 'label' => 'Use Sandbox', 'options' => array(0 => 'No', 1 => 'Yes'), 'smalldesc' => 'Do you need a testing redirection to the PayPal Sandbox ?')); ?>
		
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('help'); ?>
		<p>
			<ul>
				<li>This plugin will redirect your form to PayPal</li>
				<li>Map your form fields names to the fields required by Paypal, no spaces should be in the fields name.</li>
				<li>You may map extra fields through the "Extra fields" box, use multi line format, each line should be in this form: paypal_field_name=form_field_name</li>
				<li>Enter your PayPal account settings.</li>
				<li>Once triggered, this action will redirect the user to the Paypal payment for payment.</li>
			</ul>
		</p>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
</div>