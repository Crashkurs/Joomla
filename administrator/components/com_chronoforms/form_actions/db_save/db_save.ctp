<div class="dragable" id="cfaction_db_save">DB Save</div>
<!--start_element_code-->
<div class="element_code" id="cfaction_db_save_element">
	<label class="action_label" style="display: block; float:none!important;">DB Save</label>
	<input type="hidden" name="chronoaction[{n}][action_db_save_{n}_table_name]" id="action_db_save_{n}_table_name" value="<?php echo $action_params['table_name']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_db_save_{n}_model_id]" id="action_db_save_{n}_model_id" value="<?php echo $action_params['model_id']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_db_save_{n}_save_under_modelid]" id="action_db_save_{n}_save_under_modelid" value="<?php echo $action_params['save_under_modelid']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_db_save_{n}_enabled]" id="action_db_save_{n}_enabled" value="<?php echo $action_params['enabled']; ?>" />
	
	<input type="hidden" name="chronoaction[{n}][action_db_save_{n}_ndb_enable]" id="action_db_save_{n}_ndb_enable" value="<?php echo $action_params['ndb_enable']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_db_save_{n}_ndb_driver]" id="action_db_save_{n}_ndb_driver" value="<?php echo $action_params['ndb_driver']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_db_save_{n}_ndb_host]" id="action_db_save_{n}_ndb_host" value="<?php echo $action_params['ndb_host']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_db_save_{n}_ndb_user]" id="action_db_save_{n}_ndb_user" value="<?php echo $action_params['ndb_user']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_db_save_{n}_ndb_password]" id="action_db_save_{n}_ndb_password" value="<?php echo $action_params['ndb_password']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_db_save_{n}_ndb_database]" id="action_db_save_{n}_ndb_database" value="<?php echo $action_params['ndb_database']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_db_save_{n}_ndb_table_name]" id="action_db_save_{n}_ndb_table_name" value="<?php echo $action_params['ndb_table_name']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_db_save_{n}_ndb_prefix]" id="action_db_save_{n}_ndb_prefix" value="<?php echo $action_params['ndb_prefix']; ?>" />
	
	<input type="hidden" id="chronoaction_id_{n}" name="chronoaction_id[{n}]" value="{n}" />
	<input type="hidden" name="chronoaction[{n}][type]" value="db_save" />
</div>
<!--end_element_code-->
<script type="text/javascript"> 
//<![CDATA[
function cfaction_db_save_onload(ID){
	var table_name = $('action_db_save_'+ID+'_ndb_table_name').get('value');
	if(table_name != ''){
		var opt = new Element('option', {'value': table_name, 'text': table_name});
		$('action_db_save_'+ID+'_ndb_table_name_config').empty();
		opt.inject($('action_db_save_'+ID+'_ndb_table_name_config'));
	}
}
function refreshTablesList(ID){
	var url = 'index.php?option=com_chronoforms&task=action_task&action_name=db_save&fn=load_tables';
	var a = new Request({
				url: 'index.php?option=com_chronoforms&task=action_task&action_name=db_save&fn=load_tables',
				method: 'get',
				onRequest: function(){
					$('action_db_save_'+ID+'_ndb_table_name_config').empty();
					var opt = new Element('option', {'value': '', 'text': 'Loading Tables....Please wait!'});
					opt.inject($('action_db_save_'+ID+'_ndb_table_name_config'));
				},
				onComplete: function(response){
					if(response != ''){
						var tables = response.split(",");
						$('action_db_save_'+ID+'_ndb_table_name_config').empty();
						tables.each(function(table){
							var opt = new Element('option', {'value': table, 'text': table});
							opt.inject($('action_db_save_'+ID+'_ndb_table_name_config'));
						});
					}
				}
			});
	var dbname = $('action_db_save_'+ID+'_ndb_database_config').get('value');
	var dbdriver = $('action_db_save_'+ID+'_ndb_driver_config').get('value');
	var dbhost = $('action_db_save_'+ID+'_ndb_host_config').get('value');
	var dbuser = $('action_db_save_'+ID+'_ndb_user_config').get('value');
	var dbpass = $('action_db_save_'+ID+'_ndb_password_config').get('value');
	a.send('dbname='+dbname+'&'+'dbdriver='+dbdriver+'&'+'dbhost='+dbhost+'&'+'dbuser='+dbuser+'&'+'dbpass='+dbpass);
}
//]]>
</script>
<div class="element_config" id="cfaction_db_save_element_config">
	<?php echo $PluginTabsHelper->Header(array('basic' => 'Basic', 'advanced' => 'Advanced'), 'db_save_config_{n}'); ?>
	<?php echo $PluginTabsHelper->tabStart('basic'); ?>	
		<?php echo $HtmlHelper->input('action_db_save_{n}_enabled_config', array('type' => 'select', 'label' => 'Enabled', 'options' => array(0 => 'No', 1 => 'Yes'))); ?>
			
		<?php
			$database =& JFactory::getDBO();
			$tables = $database->getTableList();
			$options = array();
			foreach($tables as $table){
				$options[$table] = $table;
			}
		?>
		<?php echo $HtmlHelper->input('action_db_save_{n}_table_name_config', array('type' => 'select', 'label' => 'Table', 'options' => $options, 'empty' => " - ", 'class' => 'medium_input', 'smalldesc' => "The db table to which the data will be saved.")); ?>
		<?php echo $HtmlHelper->input('action_db_save_{n}_model_id_config', array('type' => 'text', 'label' => "Model ID", 'class' => 'medium_input', 'value' => '', 'smalldesc' => "1- The array key under which the data to be saved will be expected in the \$_POST array.<br />2- The array key under which the saved data array will exist after the save process. e.g:\$form->data[model_id]")); ?>
		<?php echo $HtmlHelper->input('action_db_save_{n}_save_under_modelid_config', array('type' => 'select', 'label' => 'Save Under Model ID', 'options' => array(0 => 'No', 1 => 'Yes'), 'class' => 'medium_input', 'smalldesc' => "Should we save the data coming under ths Model ID ONLY ? if yes then your data array should include some array of values under a key name equals your model_id value or no form data will be saved.<br /> If you don't know what to do then leave it as <strong>NO</strong>")); ?>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('advanced'); ?>
		<?php echo $HtmlHelper->input('action_db_save_{n}_ndb_enable_config', array('type' => 'select', 'label' => 'Save to Different Database', 'options' => array(0 => 'No', 1 => 'Yes'), 'class' => 'medium_input', 'smalldesc' => "This action saves to the default Joomla database by default, but you may choose to save the data to a different database.<br /> If you don't know what to do then leave it as <strong>NO</strong>")); ?>
		<?php echo $HtmlHelper->input('action_db_save_{n}_ndb_driver_config', array('type' => 'text', 'label' => "DB Driver", 'class' => 'medium_input', 'value' => '', 'smalldesc' => "mysql or mysqli")); ?>
		<?php echo $HtmlHelper->input('action_db_save_{n}_ndb_host_config', array('type' => 'text', 'label' => "DB Host", 'class' => 'medium_input', 'value' => '', 'smalldesc' => "usually: localhost")); ?>
		<?php echo $HtmlHelper->input('action_db_save_{n}_ndb_user_config', array('type' => 'text', 'label' => "DB User", 'class' => 'medium_input', 'value' => '', 'smalldesc' => "The user name which has access to the database")); ?>
		<?php echo $HtmlHelper->input('action_db_save_{n}_ndb_password_config', array('type' => 'text', 'label' => "DB User's Password", 'class' => 'medium_input', 'value' => '', 'smalldesc' => "the user's password")); ?>
		
		
		<input type="button" name="action_db_save_refresh_button" id="action_db_save_refresh_button" value="Refresh Tables List" onClick="refreshTablesList('{n}')" />
		<br />
		<?php echo $HtmlHelper->input('action_db_save_{n}_ndb_database_config', array('type' => 'text', 'label' => "DB Name", 'class' => 'medium_input', 'value' => '', 'smalldesc' => "the database name")); ?>
		<?php
			$options = array();
		?>
		<?php echo $HtmlHelper->input('action_db_save_{n}_ndb_table_name_config', array('type' => 'select', 'label' => 'Table', 'options' => $options, 'empty' => " - ", 'class' => 'medium_input', 'smalldesc' => "The db table to which the data will be saved.")); ?>
		
		<?php echo $HtmlHelper->input('action_db_save_{n}_ndb_prefix_config', array('type' => 'text', 'label' => "DB Table Prefix", 'class' => 'medium_input', 'value' => '', 'smalldesc' => "the tables' prefix, joomla uses the jos_ prefix usually, but your database may be using something different.")); ?>
		
	<?php echo $PluginTabsHelper->tabEnd(); ?>
</div>