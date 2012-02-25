<?php
require_once(JPATH_SITE.DS."administrator".DS."components".DS."com_chronoforms".DS."helpers".DS."tabs_helper.php");
$PluginTabsHelper = new TabsHelper();
?>
<div class="dragable" id="cfaction_2co_listener">2CO Listener</div>
<!--start_element_code-->
<div class="element_code" id="cfaction_2co_listener_element">
	<label class="action_label">2CO Listener</label>
	<div id="cfactionevent_2co_listener_{n}_new_order" class="form_event good_event">
		<label class="form_event_label">On New Order</label>
	</div>
	<div id="cfactionevent_2co_listener_{n}_fraud_status" class="form_event good_event">
		<label class="form_event_label">On Fraud Status Changed</label>
	</div>
	<div id="cfactionevent_2co_listener_{n}_refund" class="form_event good_event">
		<label class="form_event_label">On Refund Issued</label>
	</div>
	<div id="cfactionevent_2co_listener_{n}_other" class="form_event good_event">
		<label class="form_event_label">On Other Response Types</label>
	</div>
	
	<input type="hidden" name="chronoaction[{n}][action_2co_listener_{n}_sid]" id="action_2co_listener_{n}_sid" value="<?php echo $action_params['sid']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_2co_listener_{n}_secret]" id="action_2co_listener_{n}_secret" value="<?php echo $action_params['secret']; ?>" />
	<input type="hidden" id="chronoaction_id_{n}" name="chronoaction_id[{n}]" value="{n}" />
	<input type="hidden" name="chronoaction[{n}][type]" value="2co_listener" />
</div>
<!--end_element_code-->
<div class="element_config" id="cfaction_2co_listener_element_config">
	<?php echo $PluginTabsHelper->Header(array('settings' => 'Settings', 'help' => 'Help'), '2co_listener_config_{n}'); ?>
	<?php echo $PluginTabsHelper->tabStart('settings'); ?>
		<?php echo $HtmlHelper->input('action_2co_listener_{n}_sid_config', array('type' => 'text', 'label' => "Vendor/Seller ID", 'class' => 'medium_input', 'smalldesc' => 'Enter your 2CO Vendor ID here')); ?>
		<?php echo $HtmlHelper->input('action_2co_listener_{n}_secret_config', array('type' => 'text', 'label' => "Secret Word", 'class' => 'medium_input', 'smalldesc' => 'The secret word choosen by the vendor in their 2CO account, used to verify that the response is coming from 2CO')); ?>
		
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('help'); ?>
		<p>
			<ul>
				<li>This plugin will process the INS response coming from the 2CO server, you must be a registered 2CO vendor in order to be able to use this one.</li>
				<li>enter your Vendor id and the secret word choosen by the vendor at the 2CO account area.</li>
				<li>All the data returned will be stored in the $form->data array</li>
				<li>For more documentation about the 2CO parameters, please search the 2CO website for "INS".</li>
			</ul>
		</p>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
</div>