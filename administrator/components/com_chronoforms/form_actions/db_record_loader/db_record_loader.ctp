<div class="dragable" id="cfaction_db_record_loader">DB Record Loader</div>
<!--start_element_code-->
<div class="element_code" id="cfaction_db_record_loader_element">
	<label class="action_label" style="display: block; float:none!important;">DB Record Loader</label>
	<div id="cfactionevent_db_record_loader_{n}_found" class="form_event good_event">
		<label class="form_event_label">On Record Found</label>
	</div>
	<div id="cfactionevent_db_record_loader_{n}_notfound" class="form_event bad_event">
		<label class="form_event_label">On Empty Result</label>
	</div>
	<div id="cfactionevent_db_record_loader_{n}_nodata" class="form_event bad_event">
		<label class="form_event_label">On No/Empty Param Passed</label>
	</div>
	<input type="hidden" name="chronoaction[{n}][action_db_record_loader_{n}_dbfield]" id="action_db_record_loader_{n}_dbfield" value="<?php echo $action_params['dbfield']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_db_record_loader_{n}_table_name]" id="action_db_record_loader_{n}_table_name" value="<?php echo $action_params['table_name']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_db_record_loader_{n}_request_param]" id="action_db_record_loader_{n}_request_param" value="<?php echo $action_params['request_param']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_db_record_loader_{n}_load_fields]" id="action_db_record_loader_{n}_load_fields" value="<?php echo $action_params['load_fields']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_db_record_loader_{n}_curly_replacer]" id="action_db_record_loader_{n}_curly_replacer" value="<?php echo $action_params['curly_replacer']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_db_record_loader_{n}_model_id]" id="action_db_record_loader_{n}_model_id" value="<?php echo $action_params['model_id']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_db_record_loader_{n}_load_under_modelid]" id="action_db_record_loader_{n}_load_under_modelid" value="<?php echo $action_params['load_under_modelid']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_db_record_loader_{n}_array_fields_sets]" id="action_db_record_loader_{n}_array_fields_sets" value="<?php echo $action_params['array_fields_sets']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_db_record_loader_{n}_array_separators]" id="action_db_record_loader_{n}_array_separators" value="<?php echo $action_params['array_separators']; ?>" />
	<textarea name="chronoaction[{n}][action_db_record_loader_{n}_content1]" id="action_db_record_loader_{n}_content1" style="display:none"><?php echo $action_params['content1']; ?></textarea>
    
	<input type="hidden" id="chronoaction_id_{n}" name="chronoaction_id[{n}]" value="{n}" />
	<input type="hidden" name="chronoaction[{n}][type]" value="db_record_loader" />
</div>
<!--end_element_code-->
<div class="element_config" id="cfaction_db_record_loader_element_config">
	<?php echo $HtmlHelper->input('action_db_record_loader_{n}_dbfield_config', array('type' => 'text', 'label' => "DB Field", 'class' => 'medium_input', 'value' => '', 'smalldesc' => "The field name which will be used to query the table record.")); ?>
	<?php
		$database =& JFactory::getDBO();
		$tables = $database->getTableList();
		$options = array();
		foreach($tables as $table){
			$options[$table] = $table;
		}
	?>
	<?php echo $HtmlHelper->input('action_db_record_loader_{n}_table_name_config', array('type' => 'select', 'label' => 'Table', 'options' => $options, 'empty' => " - ", 'class' => 'medium_input', 'smalldesc' => "The table name to load the data from.")); ?>
	<?php echo $HtmlHelper->input('action_db_record_loader_{n}_request_param_config', array('type' => 'text', 'label' => "Request Param", 'class' => 'medium_input', 'value' => '', 'smalldesc' => "The param name which will exist in the request url to the form, its value will be used to load the target db record.")); ?>
	<?php echo $HtmlHelper->input('action_db_record_loader_{n}_load_fields_config', array('type' => 'select', 'label' => 'Load Fields', 'options' => array(0 => 'No', 1 => 'Yes'), 'class' => 'medium_input', 'smalldesc' => "Should any form fields be loaded with data ? your field name should match the table's column name.")); ?>
	<?php echo $HtmlHelper->input('action_db_record_loader_{n}_curly_replacer_config', array('type' => 'select', 'label' => 'Curly Replacer', 'options' => array(0 => 'No', 1 => 'Yes'), 'class' => 'medium_input', 'smalldesc' => "Should curly brackets fields names be replaced with data from the form data array ?")); ?>
	<?php echo $HtmlHelper->input('action_db_record_loader_{n}_model_id_config', array('type' => 'text', 'label' => "Model ID", 'class' => 'medium_input', 'value' => '', 'smalldesc' => "The key under which the loaded record data will be stored in the form->data array.")); ?>
	<?php echo $HtmlHelper->input('action_db_record_loader_{n}_load_under_modelid_config', array('type' => 'select', 'label' => 'Load Under Model ID', 'options' => array(0 => 'No', 1 => 'Yes'), 'class' => 'medium_input', 'smalldesc' => "Should the data get loaded under the model id inside the data array ? this will affect your form fields names, if this is set to yes then your fields names should be in this format : name='MODEL_ID[field_name]'<br />and your curly brackets strings: {MODEL_ID.field_name}")); ?>
	<?php echo $HtmlHelper->input('action_db_record_loader_{n}_content1_config', array('type' => 'textarea', 'label' => 'WHERE statement', 'rows' => 10, 'cols' => 50, 'smalldesc' => "The code used for the WHERE statement, some notes: <br />
		1 - leave empty to use the default request param with column name formula OR use it to load whatever record you need.<br />
		2 - don't use the WHERE word.<br />
		3 - You can use PHP code with tags.
	")); ?>
	<?php echo $HtmlHelper->input('action_db_record_loader_{n}_array_fields_sets_config', array('type' => 'text', 'label' => "Array Fields Sets", 'class' => 'big_input', 'value' => '', 'smalldesc' => "list of fields of types array stored in the table, fields values will be extracted, you can use single or multiple sets, e.g:<br />field1,field2 OR field1,field2-field3,field4.")); ?>
	<?php echo $HtmlHelper->input('action_db_record_loader_{n}_array_separators_config', array('type' => 'text', 'label' => "Array Separators", 'class' => 'big_input', 'value' => '', 'smalldesc' => "The separators used to explode the array fields values, multiple sets supported, should match the number of sets for the array fields.")); ?>
	
</div>