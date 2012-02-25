<?php
$mainframe =& JFactory::getApplication();
$uri =& JFactory::getURI();
$attributes = array('class' => 'mceArea');
$options = array('theme' => 'advanced', 'theme_advanced_toolbar_location' => 'top', 'width' => '100%', 'height' => '200px');
$tinycode = '
tinyMCE.init({
	mode : "textareas",
	relative_urls: false,
	editor_selector : "'.$attributes['class'].'"';
foreach($options as $option => $opvalue){
	$tinycode .= ',
	'.$option.' : "'.$opvalue.'"';
}
$tinycode .= '
});
function toggleEditor(id){
	if (!tinyMCE.get(id)){
		tinyMCE.execCommand("mceAddControl", false, id);
		activateSaveButton();
	}else{
		tinyMCE.execCommand("mceRemoveControl", false, id);
		activateSaveButton();
	}
}
function toggleTemplate(id){
	if($(id).getStyle("display") != "none"){
		$(id).setStyle("display", "none");
	}else{
		$(id).setStyle("display", "block");
	}
}
';
?>
<script type="text/javascript" src="<?php echo $uri->root(); ?>media/editors/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript"> 
//<![CDATA[
<?php echo $tinycode; ?>
//]]>
</script>
<div class="dragable" id="cfaction_email">Email</div>
<!--start_element_code-->
<div class="element_code" id="cfaction_email_element">
	<label class="action_label" style="display: block; float:none!important;">Email - <?php echo $action_params['action_label']; ?></label>
	<!--<a onClick="toggleTemplate('action_email_{n}_content1_cont');return false;">Edit/Hide Template</a>-->
	<input type="hidden" name="chronoaction[{n}][action_email_{n}_to]" id="action_email_{n}_to" value="<?php echo $action_params['to']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_email_{n}_cc]" id="action_email_{n}_cc" value="<?php echo $action_params['cc']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_email_{n}_bcc]" id="action_email_{n}_bcc" value="<?php echo $action_params['bcc']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_email_{n}_subject]" id="action_email_{n}_subject" value="<?php echo $action_params['subject']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_email_{n}_fromname]" id="action_email_{n}_fromname" value="<?php echo $action_params['fromname']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_email_{n}_fromemail]" id="action_email_{n}_fromemail" value="<?php echo $action_params['fromemail']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_email_{n}_replytoname]" id="action_email_{n}_replytoname" value="<?php echo $action_params['replytoname']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_email_{n}_replytoemail]" id="action_email_{n}_replytoemail" value="<?php echo $action_params['replytoemail']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_email_{n}_dto]" id="action_email_{n}_dto" value="<?php echo $action_params['dto']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_email_{n}_dcc]" id="action_email_{n}_dcc" value="<?php echo $action_params['dcc']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_email_{n}_dbcc]" id="action_email_{n}_dbcc" value="<?php echo $action_params['dbcc']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_email_{n}_dsubject]" id="action_email_{n}_dsubject" value="<?php echo $action_params['dsubject']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_email_{n}_dfromname]" id="action_email_{n}_dfromname" value="<?php echo $action_params['dfromname']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_email_{n}_dfromemail]" id="action_email_{n}_dfromemail" value="<?php echo $action_params['dfromemail']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_email_{n}_dreplytoname]" id="action_email_{n}_dreplytoname" value="<?php echo $action_params['dreplytoname']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_email_{n}_dreplytoemail]" id="action_email_{n}_dreplytoemail" value="<?php echo $action_params['dreplytoemail']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_email_{n}_enabled]" id="action_email_{n}_enabled" value="<?php echo $action_params['enabled']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_email_{n}_recordip]" id="action_email_{n}_recordip" value="<?php echo $action_params['recordip']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_email_{n}_attachments]" id="action_email_{n}_attachments" value="<?php echo $action_params['attachments']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_email_{n}_sendas]" id="action_email_{n}_sendas" value="<?php echo $action_params['sendas']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_email_{n}_action_label]" id="action_email_{n}_action_label" value="<?php echo $action_params['action_label']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_email_{n}_encrypt_enabled]" id="action_email_{n}_encrypt_enabled" value="<?php echo $action_params['encrypt_enabled']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_email_{n}_gpg_sec_key]" id="action_email_{n}_gpg_sec_key" value="<?php echo $action_params['gpg_sec_key']; ?>" />
	
	<textarea name="chronoaction[{n}][action_email_{n}_content1]" id="action_email_{n}_content1" style="display:none"><?php echo htmlspecialchars($action_params['content1']); ?></textarea>
    
	
	<input type="hidden" id="chronoaction_id_{n}" name="chronoaction_id[{n}]" value="{n}" />
	<input type="hidden" name="chronoaction[{n}][type]" value="email" />
</div>
<!--end_element_code-->
<script type="text/javascript"> 
//<![CDATA[
function genAutoTemplate(ID){
	var Acturl = 'index.php?option=com_chronoforms&task=action_task&action_name=email&fn=generate_auto_template';
	var a = new Request.HTML({
				url: Acturl,
				method: 'get',
				onRequest: function(){
					$('action_email_'+ID+'_content1_config').empty();
					$('action_email_'+ID+'_content1_config').set('value', 'Working....Please wait!');
				},
				onSuccess: function(responseTree, responseElements, responseHTML, responseJavaScript){
					if(responseHTML != ''){
						$('action_email_'+ID+'_content1_config').empty();
						$('action_email_'+ID+'_content1_config').set('value', responseHTML);
					}
				}
			});
	a.send('form_id='+$('ChronoformId').get('value'));
}
//]]>
</script>
<div class="element_config" id="cfaction_email_element_config">
	<?php echo $PluginTabsHelper->Header(array('general' => 'General', 'template' => 'Template', 'static' => 'Static', 'dynamic' => 'Dynamic', 'encrypt' => 'Encryption'), 'email_config_{n}'); ?>
	<?php echo $PluginTabsHelper->tabStart('general'); ?>
		<?php echo $HtmlHelper->input('action_email_{n}_enabled_config', array('type' => 'select', 'label' => 'Enabled', 'options' => array(0 => 'No', 1 => 'Yes'))); ?>
		<?php echo $HtmlHelper->input('action_email_{n}_action_label_config', array('type' => 'text', 'label' => "Action Label", 'class' => 'medium_input', 'smalldesc' => 'Label for your action in the wizard.')); ?>
		<?php echo $HtmlHelper->input('action_email_{n}_sendas_config', array('type' => 'select', 'label' => 'Send As', 'options' => array('html' => 'HTML', 'text' => 'Text', 'both' => 'Both'))); ?>
		<?php echo $HtmlHelper->input('action_email_{n}_attachments_config', array('type' => 'text', 'label' => "Attachments fields name", 'class' => 'big_input', 'value' => '', 'smalldesc' => 'Any files fields should be attached to this email ? comma concatenated list!'."\n".'e.g:field1,field2')); ?>
		<?php echo $HtmlHelper->input('action_email_{n}_recordip_config', array('type' => 'select', 'label' => "Get Submitter's IP", 'options' => array(0 => 'No', 1 => 'Yes'), 'smalldesc' => 'Will append the IP addrress to the end of the email body or replace any {IPADDRESS} string.')); ?>
		
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('template'); ?>
		<input type="button" name="action_email_refresh_button" id="action_email_refresh_button" value="Generate Auto Template" onClick="genAutoTemplate('{n}')" />
		<br />
		<a class="editor_toggler_link" onclick="toggleEditor('action_email_{n}_content1_config');return false;">Add/Remove editor</a>
		<?php echo $HtmlHelper->input('action_email_{n}_content1_config', array('type' => 'textarea', 'label' => "Template", 'class' => 'text_editor', 'label_over' => true, 'rows' => 20, 'cols' => 70, 'smalldesc' => 'You may use the curly brackets formula to get fields data from the form data array, e.g: {field_name}.<br /><br /> You may also use PHP but if you enable the editor your PHP code will be stripped.<br /><br />Auto template generation will work on the latest form code saved, make sure you save your form before trying this feature.')); ?>
		
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('static'); ?>
		<?php echo $HtmlHelper->input('action_email_{n}_to_config', array('type' => 'text', 'label' => "To (Required)", 'class' => 'medium_input', 'smalldesc' => 'List of recipient(s) email address(es) separated by comma.<br />e.g: me@domain.com OR he@dom.com,she@dom.com')); ?>
		<?php echo $HtmlHelper->input('action_email_{n}_subject_config', array('type' => 'text', 'label' => "Subject (Required)", 'class' => 'medium_input', 'smalldesc' => 'Subject string.<br />e.g: My Email Subject.')); ?>
		<?php echo $HtmlHelper->input('action_email_{n}_fromname_config', array('type' => 'text', 'label' => "From name (Required)", 'class' => 'medium_input', 'smalldesc' => 'The name of sender.<br />e.g: Admin')); ?>
		<?php echo $HtmlHelper->input('action_email_{n}_fromemail_config', array('type' => 'text', 'label' => "From email (Required)", 'class' => 'medium_input', 'smalldesc' => 'The email address of the sender.<br />e.g: admin@admin.com')); ?>
		<?php echo $HtmlHelper->input('action_email_{n}_cc_config', array('type' => 'text', 'label' => "CC", 'class' => 'medium_input', 'smalldesc' => 'List of CC email address(es) separated by comma.<br />e.g: me@domain.com OR he@dom.com,she@dom.com')); ?>
		<?php echo $HtmlHelper->input('action_email_{n}_bcc_config', array('type' => 'text', 'label' => "BCC", 'class' => 'medium_input', 'smalldesc' => 'List of BCC email address(es) separated by comma.<br />e.g: me@domain.com OR he@dom.com,she@dom.com')); ?>
		<?php echo $HtmlHelper->input('action_email_{n}_replytoname_config', array('type' => 'text', 'label' => "Reply to name", 'class' => 'medium_input', 'smalldesc' => 'The name to reply to when you hit reply in your mail client.<br />e.g: Admin')); ?>
		<?php echo $HtmlHelper->input('action_email_{n}_replytoemail_config', array('type' => 'text', 'label' => "Reply to email", 'class' => 'medium_input', 'smalldesc' => 'The email to reply to when you hit reply in your mail client.<br />e.g: somebody@domain.com')); ?>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('dynamic'); ?>
		<?php echo $HtmlHelper->input('action_email_{n}_dto_config', array('type' => 'text', 'label' => "Dynamic To", 'class' => 'medium_input', 'smalldesc' => 'The field name which is going to hold the email address of some recipient.<br />e.g: email (should be a valid form field name, check your form fields names under the field settings)')); ?>
		<?php echo $HtmlHelper->input('action_email_{n}_dsubject_config', array('type' => 'text', 'label' => "Dynamic Subject", 'class' => 'medium_input', 'smalldesc' => 'The field name which is going to hold the message subject.<br />e.g: subject (should be a valid form field name, check your form fields names under the field settings)')); ?>
		<?php echo $HtmlHelper->input('action_email_{n}_dfromname_config', array('type' => 'text', 'label' => "Dynamic From name", 'class' => 'medium_input', 'smalldesc' => 'The field name which is going to hold the sender\'s name.<br />e.g: name (should be a valid form field name, check your form fields names under the field settings)')); ?>
		<?php echo $HtmlHelper->input('action_email_{n}_dfromemail_config', array('type' => 'text', 'label' => "Dynamic From email", 'class' => 'medium_input', 'smalldesc' => 'The field name which is going to hold the sender\'s email address.<br />e.g: email (should be a valid form field name, check your form fields names under the field settings)')); ?>
		<?php echo $HtmlHelper->input('action_email_{n}_dreplytoname_config', array('type' => 'text', 'label' => "Dynamic Reply to name", 'class' => 'medium_input', 'smalldesc' => 'The field name which is going to hold the reply to name.<br />e.g: name (should be a valid form field name, check your form fields names under the field settings)')); ?>
		<?php echo $HtmlHelper->input('action_email_{n}_dreplytoemail_config', array('type' => 'text', 'label' => "Dynamic Reply to email", 'class' => 'medium_input', 'smalldesc' => 'The field name which is going to hold the reply to email address.<br />e.g: email (should be a valid form field name, check your form fields names under the field settings)')); ?>
		<?php echo $HtmlHelper->input('action_email_{n}_dcc_config', array('type' => 'text', 'label' => "Dynamic CC", 'class' => 'medium_input', 'smalldesc' => 'The field name which is going to hold the email address of CC recipient.<br />e.g: email (should be a valid form field name, check your form fields names under the field settings)')); ?>
		<?php echo $HtmlHelper->input('action_email_{n}_dbcc_config', array('type' => 'text', 'label' => "Dynamic BCC", 'class' => 'medium_input', 'smalldesc' => 'The field name which is going to hold the email address of BCC recipient.<br />e.g: email (should be a valid form field name, check your form fields names under the field settings)')); ?>
		
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('encrypt'); ?>
		<?php echo $HtmlHelper->input('action_email_{n}_encrypt_enabled_config', array('type' => 'select', 'label' => 'Enable GPG Encryption', 'options' => array(0 => 'No', 1 => 'Yes'), 'smalldesc' => 'This will have no effect if the GPG class is not loaded with your PHP.')); ?>
		<?php echo $HtmlHelper->input('action_email_{n}_gpg_sec_key_config', array('type' => 'text', 'label' => "GPG Secret Key", 'class' => 'big_input')); ?>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
</div>