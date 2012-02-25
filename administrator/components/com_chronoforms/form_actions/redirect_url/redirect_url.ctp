<div class="dragable" id="cfaction_redirect_url">ReDirect URL</div>
<!--start_element_code-->
<div class="element_code" id="cfaction_redirect_url_element">
	<label class="action_label" style="display: block; float:none!important;">ReDirect URL</label>
	<input type="hidden" name="chronoaction[{n}][action_redirect_url_{n}_target_url]" 
    	id="action_redirect_url_{n}_target_url" value="<?php echo htmlspecialchars($action_params['target_url']); ?>" />
	<textarea name="chronoaction[{n}][action_redirect_url_{n}_content1]" 
    	id="action_redirect_url_{n}_content1" style="display:none"><?php echo $action_params['content1']; ?></textarea>
	<input type="hidden" id="chronoaction_id_{n}" name="chronoaction_id[{n}]" value="{n}" />
	<input type="hidden" name="chronoaction[{n}][type]" value="redirect_url" />
</div>
<!--end_element_code-->
<div class="element_config" id="cfaction_redirect_url_element_config">
<?php 
echo $HtmlHelper->input('action_redirect_url_{n}_target_url_config', 
	array(
		'type' => 'text', 
		'label' => "Target URL", 
		'class' => 'big_input', 
		'smalldesc' => "The target URL without the query string."
));
echo $HtmlHelper->input('action_redirect_url_{n}_content1_config', 
	array(
		'type' => 'textarea', 
		'label' => 'Params/Fields map', 
		'rows' => 15, 
		'cols' => 50, 
		'smalldesc' => 'Multi line format of the fields names: <br />e.g:redirect_param_name=form_field_name')); 
?>
</div>