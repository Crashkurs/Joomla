<?php
require_once(JPATH_SITE.DS."administrator".DS."components".DS."com_chronoforms".DS."helpers".DS."tabs_helper.php");
$PluginTabsHelper = new TabsHelper();
?>
<div class="dragable" id="cfaction_2co_sender">2CO Sender - Trial</div>
<!--start_element_code-->
<div class="element_code" id="cfaction_2co_sender_element">
	<label class="action_label">2CO Sender - Trial</label>
	
	<input type="hidden" name="chronoaction[{n}][action_2co_sender_{n}_sid]" id="action_2co_sender_{n}_sid" value="<?php echo $action_params['sid']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_2co_sender_{n}_product_id]" id="action_2co_sender_{n}_product_id" value="<?php echo $action_params['product_id']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_2co_sender_{n}_quantity]" id="action_2co_sender_{n}_quantity" value="<?php echo $action_params['quantity']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_2co_sender_{n}_merchant_order_id]" id="action_2co_sender_{n}_merchant_order_id" value="<?php echo $action_params['merchant_order_id']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_2co_sender_{n}_pay_method]" id="action_2co_sender_{n}_pay_method" value="<?php echo $action_params['pay_method']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_2co_sender_{n}_coupon]" id="action_2co_sender_{n}_coupon" value="<?php echo $action_params['coupon']; ?>" />
	
	<input type="hidden" name="chronoaction[{n}][action_2co_sender_{n}_card_holder_name]" id="action_2co_sender_{n}_card_holder_name" value="<?php echo $action_params['card_holder_name']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_2co_sender_{n}_street_address]" id="action_2co_sender_{n}_street_address" value="<?php echo $action_params['street_address']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_2co_sender_{n}_street_address2]" id="action_2co_sender_{n}_street_address2" value="<?php echo $action_params['street_address2']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_2co_sender_{n}_city]" id="action_2co_sender_{n}_city" value="<?php echo $action_params['city']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_2co_sender_{n}_state]" id="action_2co_sender_{n}_state" value="<?php echo $action_params['state']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_2co_sender_{n}_zip]" id="action_2co_sender_{n}_zip" value="<?php echo $action_params['zip']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_2co_sender_{n}_country]" id="action_2co_sender_{n}_country" value="<?php echo $action_params['country']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_2co_sender_{n}_email]" id="action_2co_sender_{n}_email" value="<?php echo $action_params['email']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_2co_sender_{n}_phone]" id="action_2co_sender_{n}_phone" value="<?php echo $action_params['phone']; ?>" />
	
	<input type="hidden" name="chronoaction[{n}][action_2co_sender_{n}_demo]" id="action_2co_sender_{n}_demo" value="<?php echo $action_params['demo']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_2co_sender_{n}_routine]" id="action_2co_sender_{n}_routine" value="<?php echo $action_params['routine']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_2co_sender_{n}_debug_only]" id="action_2co_sender_{n}_debug_only" value="<?php echo $action_params['debug_only']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_2co_sender_{n}_fixed]" id="action_2co_sender_{n}_fixed" value="<?php echo $action_params['fixed']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_2co_sender_{n}_lang]" id="action_2co_sender_{n}_lang" value="<?php echo $action_params['lang']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_2co_sender_{n}_return_url]" id="action_2co_sender_{n}_return_url" value="<?php echo $action_params['return_url']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_2co_sender_{n}_skip_landing]" id="action_2co_sender_{n}_skip_landing" value="<?php echo $action_params['skip_landing']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_2co_sender_{n}_x_Receipt_Link_URL]" id="action_2co_sender_{n}_x_Receipt_Link_URL" value="<?php echo $action_params['x_Receipt_Link_URL']; ?>" />
		
	<textarea name="chronoaction[{n}][action_2co_sender_{n}_content1]" id="action_2co_sender_{n}_content1" style="display:none"><?php echo $action_params['content1']; ?></textarea>
    <input type="hidden" id="chronoaction_id_{n}" name="chronoaction_id[{n}]" value="{n}" />
	<input type="hidden" name="chronoaction[{n}][type]" value="2co_sender" />
</div>
<!--end_element_code-->
<div class="element_config" id="cfaction_2co_sender_element_config">
	<?php echo $PluginTabsHelper->Header(array('fields' => 'Fields', 'settings' => 'Settings', 'help' => 'Help'), '2co_sender_config_{n}'); ?>
	<?php echo $PluginTabsHelper->tabStart('fields'); ?>
		<?php echo $HtmlHelper->input('action_2co_sender_{n}_product_id_config', array('type' => 'text', 'label' => "Product ID Field", 'class' => 'medium_input', 'smalldesc' => 'Can pass an array.')); ?>
		<?php echo $HtmlHelper->input('action_2co_sender_{n}_quantity_config', array('type' => 'text', 'label' => "Quantity Field", 'class' => 'medium_input', 'smalldesc' => 'If Product id value is an array then this one should be an array as well, if its not then it will be converted to an array with values matching the single value of quantity, or 1 if there was no value set.')); ?>
		<?php echo $HtmlHelper->input('action_2co_sender_{n}_merchant_order_id_config', array('type' => 'text', 'label' => "Merchant Order Number Field", 'class' => 'medium_input')); ?>
		<?php echo $HtmlHelper->input('action_2co_sender_{n}_pay_method_config', array('type' => 'text', 'label' => "Payment Method Field", 'class' => 'medium_input', 'smalldesc' => 'Your field values are supposed to be: <br />CC for Credit Card, CK for check, AL for Acculynk PIN-debit, PPI for PayPal. This will set the default selection on the payment method step during the checkout process.')); ?>
		<?php echo $HtmlHelper->input('action_2co_sender_{n}_coupon_config', array('type' => 'text', 'label' => "Coupon Field", 'class' => 'medium_input')); ?>
		<?php echo $HtmlHelper->input('action_2co_sender_{n}_card_holder_name_config', array('type' => 'text', 'label' => "Card Holder Name field", 'class' => 'medium_input')); ?>
		<?php echo $HtmlHelper->input('action_2co_sender_{n}_street_address_config', array('type' => 'text', 'label' => "Billing Street Address Field", 'class' => 'medium_input')); ?>
		<?php echo $HtmlHelper->input('action_2co_sender_{n}_street_address2_config', array('type' => 'text', 'label' => "Billing Street Address 2 Field", 'class' => 'medium_input')); ?>
		<?php echo $HtmlHelper->input('action_2co_sender_{n}_city_config', array('type' => 'text', 'label' => "Billing City Field", 'class' => 'medium_input')); ?>
		<?php echo $HtmlHelper->input('action_2co_sender_{n}_state_config', array('type' => 'text', 'label' => "Billing State Field", 'class' => 'medium_input')); ?>
		<?php echo $HtmlHelper->input('action_2co_sender_{n}_zip_config', array('type' => 'text', 'label' => "Billing Zip Field", 'class' => 'medium_input')); ?>
		<?php echo $HtmlHelper->input('action_2co_sender_{n}_country_config', array('type' => 'text', 'label' => "Billing Country Field", 'class' => 'medium_input')); ?>
		<?php echo $HtmlHelper->input('action_2co_sender_{n}_email_config', array('type' => 'text', 'label' => "Email Field", 'class' => 'medium_input')); ?>
		<?php echo $HtmlHelper->input('action_2co_sender_{n}_phone_config', array('type' => 'text', 'label' => "Phone Field", 'class' => 'medium_input')); ?>
		
		<?php echo $HtmlHelper->input('action_2co_sender_{n}_lang_config', array('type' => 'text', 'label' => "Checkout Language Field", 'class' => 'medium_input', 'smalldesc' => 'Chinese - zh, Danish - da, Dutch - nl, French - fr, German - gr, Greek - el, Italian - it, Japanese - jp, Norwegian - no, Portuguese - pt, Slovenian - sl, Spanish - es_ib, Spanish - es_la, Swedish - sv, defaults to English if this is absent, but en may be used for English as well.')); ?>
		
		<?php echo $HtmlHelper->input('action_2co_sender_{n}_content1_config', array('type' => 'textarea', 'label' => 'Extra fields', 'rows' => 5, 'cols' => 50)); ?>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('settings'); ?>
		<?php echo $HtmlHelper->input('action_2co_sender_{n}_sid_config', array('type' => 'text', 'label' => "Vendor/Seller ID", 'class' => 'medium_input', 'smalldesc' => 'Enter your 2CO Vendor ID here')); ?>
		<?php echo $HtmlHelper->input('action_2co_sender_{n}_demo_config', array('type' => 'select', 'label' => 'Demo ?', 'options' => array('N' => 'No', 'Y' => 'Yes'), 'smalldesc' => 'Enable the demo mode, Cards will not be charged.')); ?>
		<?php echo $HtmlHelper->input('action_2co_sender_{n}_debug_only_config', array('type' => 'select', 'label' => 'Debug only', 'options' => array(0 => 'No', 1 => 'Yes'), 'smalldesc' => 'Will show a debug output for the data sent to the gateway but will not redirect.')); ?>
		<?php echo $HtmlHelper->input('action_2co_sender_{n}_fixed_config', array('type' => 'select', 'label' => 'Fixed ?', 'options' => array('N' => 'No', 'Y' => 'Yes'), 'smalldesc' => 'Will remove the Continue Shopping button and lock the quantity fields')); ?>
		<?php echo $HtmlHelper->input('action_2co_sender_{n}_skip_landing_config', array('type' => 'select', 'label' => 'Skip Landing', 'options' => array(0 => 'No', 1 => 'Yes'), 'smalldesc' => 'If enabled it will skip the order review page of the purchase routine. If there are options on the products it will cause an error and redirect the customer back to the order review page.')); ?>
		<?php echo $HtmlHelper->input('action_2co_sender_{n}_routine_config', array('type' => 'select', 'label' => 'Payment Routine', 'options' => array('M' => 'Multi Page (Default)', 'S' => 'Single Page'), 'smalldesc' => 'Choose weather you want to do a single or multi page checkout on 2co.com, single page checkout will allow CC payments only.')); ?>
		<?php echo $HtmlHelper->input('action_2co_sender_{n}_return_url_config', array('type' => 'text', 'label' => "Return URL", 'class' => 'medium_input', 'smalldesc' => 'Used to control where the Continue Shopping button will send the customer when clicked. (255 characters max)')); ?>
		<?php echo $HtmlHelper->input('action_2co_sender_{n}_x_Receipt_Link_URL_config', array('type' => 'text', 'label' => "Approved URL", 'class' => 'medium_input', 'smalldesc' => 'Used to specify an approved URL on-the-fly, but is limited to the same domain that is used for your 2Checkout account, otherwise it will fail.')); ?>
		
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('help'); ?>
		<p>
			<ul>
				<li>This plugin will communicate with the 2CO server, you must be a registered 2CO vendor in order to be able to use this one.</li>
				<li>Map your form fields names to the fields required by 2Checkout, no spaces should be in the fields name.</li>
				<li>You may map extra fields through the "Extra fields" box, use multi line format, each line should be in this form: 2co_field_name=form_field_name</li>
				<li>Enter your 2CO account settings.</li>
				<li>Once triggered, this action will redirect the user to the 2CO servers for payment.</li>
				<li>For more documentation about the 2CO parameters, please search the 2CO website for "Plugin n play parameters".</li>
			</ul>
		</p>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
</div>