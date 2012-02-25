<div class="dragable" id="cfaction_dynamic_dropdown">Dynamic Dropdown</div>
<!--start_element_code-->
<div class="element_code" id="cfaction_dynamic_dropdown_element">
	<label class="action_label" style="display: block; float:none!important;">Dynamic Dropdown - <?php echo $action_params['action_label']; ?></label>
	<textarea name="chronoaction[{n}][action_dynamic_dropdown_{n}_content1]" id="action_dynamic_dropdown_{n}_content1" style="display:none"><?php echo $action_params['content1']; ?></textarea>
    <input type="hidden" name="chronoaction[{n}][action_dynamic_dropdown_{n}_source_dropdown_id]" id="action_dynamic_dropdown_{n}_source_dropdown_id" value="<?php echo $action_params['source_dropdown_id']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_dynamic_dropdown_{n}_target_dropdown_id]" id="action_dynamic_dropdown_{n}_target_dropdown_id" value="<?php echo $action_params['target_dropdown_id']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_dynamic_dropdown_{n}_enable_ajax]" id="action_dynamic_dropdown_{n}_enable_ajax" value="<?php echo $action_params['enable_ajax']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_dynamic_dropdown_{n}_ajax_event_name]" id="action_dynamic_dropdown_{n}_ajax_event_name" value="<?php echo $action_params['ajax_event_name']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_dynamic_dropdown_{n}_action_label]" id="action_dynamic_dropdown_{n}_action_label" value="<?php echo $action_params['action_label']; ?>" />
	
	<input type="hidden" id="chronoaction_id_{n}" name="chronoaction_id[{n}]" value="{n}" />
	<input type="hidden" name="chronoaction[{n}][type]" value="dynamic_dropdown" />
</div>
<!--end_element_code-->
<div class="element_config" id="cfaction_dynamic_dropdown_element_config">
	<?php echo $PluginTabsHelper->Header(array('settings' => 'Settings', 'help' => 'Help'), 'dynamic_dropdown_config_{n}'); ?>
	<?php echo $PluginTabsHelper->tabStart('settings'); ?>
		<?php echo $HtmlHelper->input('action_dynamic_dropdown_{n}_action_label_config', array('type' => 'text', 'label' => "Action Label", 'class' => 'medium_input', 'smalldesc' => 'Label for your action in the wizard.')); ?>
		<?php echo $HtmlHelper->input('action_dynamic_dropdown_{n}_source_dropdown_id_config', array('type' => 'text', 'label' => "Source Dropdown ID", 'class' => 'medium_input', 'smalldesc' => "The field id of the select box which will control the data in the target select box.")); ?>
		<?php echo $HtmlHelper->input('action_dynamic_dropdown_{n}_target_dropdown_id_config', array('type' => 'text', 'label' => "Target Dropdown ID", 'class' => 'medium_input', 'smalldesc' => "The field id of the select box which will have the dynamic content/options.")); ?>
		<?php echo $HtmlHelper->input('action_dynamic_dropdown_{n}_enable_ajax_config', array('type' => 'select', 'label' => 'Use AJAX ?', 'options' => array(0 => 'No', 1 => 'Yes'), 'smalldesc' => 'Use AJAX, enable this if your target dropdown details are stored on database or if you need to generate them using some PHP.')); ?>
		<?php echo $HtmlHelper->input('action_dynamic_dropdown_{n}_ajax_event_name_config', array('type' => 'text', 'label' => "AJAX Event name", 'class' => 'medium_input', 'smalldesc' => "The form event name which will be queried using the AJAX call.")); ?>
		
		<?php echo $HtmlHelper->input('action_dynamic_dropdown_{n}_content1_config', array('type' => 'textarea', 'label' => "Extra options extension", 'rows' => 20, 'cols' => 70, 'smalldesc' => "The static values of both the source and the target dropdowns, in multi line format, Please check the help tab for an example.")); ?>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('help'); ?>
		<p>
			<ul>
				<li>Enter the IDs of both the source and target dropdowns.</li>
				<li>Configure the static options string data.</li>
				<li>The options string should be in multi line format, each line will has 1 source value and multiple target values, example:<br />source_value_1:target_value_1=Target Title 1,target_value_2=Target Title 2<br />source_value_2:target_value_3=Target Title 3,target_value_4=Target Title 4</li>
				<li>You may enable the AJAX and enter a new event name, make sure this event is added to the form itself, example: ajax</li>
				<li>The new event output should be in multi line format, example:<br />value1=Title 1<br />value2=Title 2<br />value3=Title 3</li>
				<li>Make sure you add the PHP code below to the end of your output code in the AJAX event so that you may get a a clean response:<br />
				
$mainframe =& JFactory::getApplication();
$mainframe->close();

				</li>
			</ul>
		</p>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
</div>