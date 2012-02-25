<div class="dragable" id="cfaction_redirect_user">
ReDirect User
<?php 
echo JHTML::tooltip('Will redirect the user to another url.', 'ReDirect User'); 
?>
</div>
<!--start_element_code-->
<div class="element_code" id="cfaction_redirect_user_element">
	<label class="action_label" style="display: block; float:none!important;">Redirect User</label>
	<input type="hidden" name="chronoaction[{n}][action_redirect_user_{n}_target_url]" 
    	id="action_redirect_user_{n}_target_url" value="<?php echo htmlspecialchars($action_params['target_url']); ?>" />
	<input type="hidden" id="chronoaction_id_{n}" name="chronoaction_id[{n}]" value="{n}" />
	<input type="hidden" name="chronoaction[{n}][type]" value="redirect_user" />
</div>
<!--end_element_code-->
<div class="element_config" id="cfaction_redirect_user_element_config">
<?php 
echo $PluginTabsHelper->Header(array('settings' => 'Settings', 'help' => 'Help'), 'show_thanks_message_config_{n}');
echo $PluginTabsHelper->tabStart('settings');
echo $HtmlHelper->input('action_redirect_user_{n}_target_url_config', 
	array(
		'type' => 'text', 
		'label' => "Target URL", 
		'class' => 'big_input', 
		'smalldesc' => "The target URL to send the user to."
));
echo $PluginTabsHelper->tabEnd();
echo $PluginTabsHelper->tabStart('help');
?>
<div>
    <ul>
        <li>Enter a URL here if you want to Redirect the User after the form is submitted and processed.</li> 
        <li>To set parameters in the Redirect URL, use the Configure Redirect action before this action and leave the URL here empty.</li>
        <li>This should be the last action in the OnSubmit Event.</li>
    </ul>
</div>
<?php 
echo $PluginTabsHelper->tabEnd();
?>
</div>