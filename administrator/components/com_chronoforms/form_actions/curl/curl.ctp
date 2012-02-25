<div class="dragable" id="cfaction_curl">Curl</div>
<!--start_element_code-->
<div class="element_code" id="cfaction_curl_element">
	<label class="action_label" style="display: block; float:none!important;">Curl</label>
	
	<input type="hidden" name="chronoaction[{n}][action_curl_{n}_target_url]" id="action_curl_{n}_target_url" value="<?php echo htmlspecialchars($action_params['target_url']); ?>" />
	<input type="hidden" name="chronoaction[{n}][action_curl_{n}_header_in_response]" id="action_curl_{n}_header_in_response" value="<?php echo $action_params['header_in_response']; ?>" />
	<textarea name="chronoaction[{n}][action_curl_{n}_content1]" id="action_curl_{n}_content1" style="display:none"><?php echo $action_params['content1']; ?></textarea>
    
	<input type="hidden" id="chronoaction_id_{n}" name="chronoaction_id[{n}]" value="{n}" />
	<input type="hidden" name="chronoaction[{n}][type]" value="curl" />
</div>
<!--end_element_code-->
<div class="element_config" id="cfaction_curl_element_config">
	<?php echo $HtmlHelper->input('action_curl_{n}_target_url_config', array('type' => 'text', 'label' => "Target URL", 'class' => 'big_input', 'smalldesc' => "The target URL to send the data to.")); ?>
	<?php echo $HtmlHelper->input('action_curl_{n}_header_in_response_config', array('type' => 'select', 'label' => 'Header in response ?', 'options' => array(0 => 'No', 1 => 'Yes'), 'smalldesc' => "Include Header response from the gateway? default is No.")); ?>
	
    <?php echo $HtmlHelper->input('action_curl_{n}_content1_config', array('type' => 'textarea', 'label' => 'Params/Fields map', 'rows' => 15, 'cols' => 50, 'smalldesc' => 'Multi line format of the fields names: <br />e.g:curl_param_name=form_field_name')); ?>
</div>