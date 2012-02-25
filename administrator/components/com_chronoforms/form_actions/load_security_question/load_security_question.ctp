<div class="dragable" id="cfaction_load_security_question">Load Security Question</div>
<!--start_element_code-->
<div class="element_code" id="cfaction_load_security_question_element">
	<label class="action_label">Load Security Question</label>
	<textarea name="chronoaction[{n}][action_load_security_question_{n}_content1]" id="action_load_security_question_{n}_content1" style="display:none"><?php echo $action_params['content1']; ?></textarea>
    <input type="hidden" name="chronoaction[{n}][action_load_security_question_{n}_session_key]" id="action_load_security_question_{n}_session_key" value="<?php echo $action_params['session_key']; ?>" />
	
	<input type="hidden" id="chronoaction_id_{n}" name="chronoaction_id[{n}]" value="{n}" />
	<input type="hidden" name="chronoaction[{n}][type]" value="load_security_question" />
</div>
<!--end_element_code-->
<div class="element_config" id="cfaction_load_security_question_element_config">
	<?php echo $PluginTabsHelper->Header(array('settings' => 'Settings', 'help' => 'Help'), 'load_security_question_config_{n}'); ?>
	<?php echo $PluginTabsHelper->tabStart('settings'); ?>
		<?php echo $HtmlHelper->input('action_load_security_question_{n}_content1_config', array('type' => 'textarea', 'label' => "Code", 'rows' => 20, 'cols' => 70, 'smalldesc' => 'Enter the questions and answers here, any PHP code should include the PHP tags.')); ?>
		<?php echo $HtmlHelper->input('action_load_security_question_{n}_session_key_config', array('type' => 'select', 'label' => 'Enable Session Key', 'options' => array(0 => 'No', 1 => 'Yes'), 'smalldesc' => 'Add a unique session key for every form instance, this is helpful if more than one form or more than one instance of the same form may be loaded together.')); ?>
	
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('help'); ?>
		<p>
			<ul>
				<li>You may use PHP code with php tags.</li>
				<li>You may use a "Security Question" element or enter this string in your form code or using a custom element to show the question: {chrono_security_question}</li>
				<li>the answer field should have the name "chrono_security_answer", again, you may simply use a "Security Question" element and that should add it for you.</li>
				<li>Enter the questions in multi line forma, example:<br />
				Question=Answer,Answer,Answer<br />
				Question=Answer<br />
				Question=Answer,Answer<br />
				</li>
			</ul>
		</p>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
</div>