<div class="dragable" id="cfaction_autocomplete_processor">Autocomplete Processor</div>
<!--start_element_code-->
<div class="element_code" id="cfaction_autocomplete_processor_element">
	<label class="action_label" style="display: block; float:none!important;">Autocomplete Processor</label>
	<input type="hidden" name="chronoaction[{n}][action_autocomplete_processor_{n}_table_name]" id="action_autocomplete_processor_{n}_table_name" value="<?php echo $action_params['table_name']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_autocomplete_processor_{n}_field_name]" id="action_autocomplete_processor_{n}_field_name" value="<?php echo $action_params['field_name']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_autocomplete_processor_{n}_column_name]" id="action_autocomplete_processor_{n}_column_name" value="<?php echo $action_params['column_name']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_autocomplete_processor_{n}_minLength]" id="action_autocomplete_processor_{n}_minLength" value="<?php echo $action_params['minLength']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_autocomplete_processor_{n}_maxChoices]" id="action_autocomplete_processor_{n}_maxChoices" value="<?php echo $action_params['maxChoices']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_autocomplete_processor_{n}_maxLength]" id="action_autocomplete_processor_{n}_maxLength" value="<?php echo $action_params['maxLength']; ?>" />
	<textarea name="chronoaction[{n}][action_autocomplete_processor_{n}_content1]" id="action_autocomplete_processor_{n}_content1" style="display:none"><?php echo htmlspecialchars($action_params['content1']); ?></textarea>
    
	<input type="hidden" id="chronoaction_id_{n}" name="chronoaction_id[{n}]" value="{n}" />
	<input type="hidden" name="chronoaction[{n}][type]" value="autocomplete_processor" />
</div>
<!--end_element_code-->
<div class="element_config" id="cfaction_autocomplete_processor_element_config">
	<?php echo $PluginTabsHelper->Header(array('settings' => 'Settings', 'other' => 'Other', 'help' => 'Help'), 'autocomplete_processor_config_{n}'); ?>
		<?php echo $PluginTabsHelper->tabStart('settings'); ?>
			<?php
			$database =& JFactory::getDBO();
			$tables = $database->getTableList();
			$options = array();
			foreach($tables as $table){
				$options[$table] = $table;
			}
		?>
		<?php echo $HtmlHelper->input('action_autocomplete_processor_{n}_table_name_config', array('type' => 'select', 'label' => 'Table', 'options' => $options, 'empty' => " - ", 'class' => 'medium_input', 'smalldesc' => "The table name to load the data from.")); ?>
		<?php echo $HtmlHelper->input('action_autocomplete_processor_{n}_field_name_config', array('type' => 'text', 'label' => "Field Name", 'smalldesc' => 'The name of the field which will be sent and its value will be queried against the table.')); ?>
		<?php echo $HtmlHelper->input('action_autocomplete_processor_{n}_column_name_config', array('type' => 'text', 'label' => "Column name(s)", 'class' => 'medium_input', 'smalldesc' => 'The column name which will be searched for the data (should exist in the table selected above), you may enter more than 1 separated by comma and all of them will be searched.')); ?>
		<?php echo $HtmlHelper->input('action_autocomplete_processor_{n}_content1_config', array('type' => 'textarea', 'label' => "Code", 'rows' => 20, 'cols' => 70, 'smalldesc' => 'You can place PHP code(with tags) here to override the results, check the help tab for how to.')); ?>
		
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('other'); ?>
		<?php echo $HtmlHelper->input('action_autocomplete_processor_{n}_minLength_config', array('type' => 'text', 'label' => "Minimum length", 'smalldesc' => 'Minimum number of characters before a request is initiated.')); ?>
		<?php echo $HtmlHelper->input('action_autocomplete_processor_{n}_maxChoices_config', array('type' => 'text', 'label' => "Max choice", 'smalldesc' => 'Maximum number of choices to load.')); ?>
		<?php echo $HtmlHelper->input('action_autocomplete_processor_{n}_maxLength_config', array('type' => 'text', 'label' => "Max Length", 'smalldesc' => 'Maximum number for the string length.')); ?>
		
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('help'); ?>
		<p>
			<ul>
				<li>Fill the necessary fields and select your table, make sure that the field name matches the same field on the Autocomplete loader action.</li>
				<li>The column name is one of your selected table's columns.</li>
				<li>The code box can override the results loaded:<br />
				$form->data['_PLUGINS_']['autocomplete_processor']['data'] will hold the whole data association loaded from the database.<br />
				$form->data['_PLUGINS_']['autocomplete_processor']['result'] will hold the final 1 dimension array results which will be sent to the view.<br />
				You can use both variables to filter and/or add your own results.
				</li>
				<li>This action requires PHP5.</li>
			</ul>
		</p>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
</div>