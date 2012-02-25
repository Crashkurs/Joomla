<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionDbSave{
	var $formname;
	var $formid;
	var $group = array('id' => 'db_operations', 'title' => 'DB Operations');
	var $details = array('title' => 'DB Table save', 'tooltip' => 'Save some data to some database table name.');
	function run($form, $actiondata){
		$mainframe =& JFactory::getApplication();
		$database =& JFactory::getDBO();
		$params = new JParameter($actiondata->params);
		//check if a different database connection is needed
		if($params->get('ndb_enable', 0)){
			$option = array();
			$option['driver'] = $params->get('ndb_driver', 'mysql');// Database driver name
			$option['host'] = $params->get('ndb_host', 'localhost');// Database host name
			$option['user'] = $params->get('ndb_user', '');// User for database authentication
			$option['password'] = $params->get('ndb_password', '');// Password for database authentication
			$option['database'] = $params->get('ndb_database', '');// Database name
			$option['prefix'] = $params->get('ndb_prefix', 'jos_');// Database prefix (may be empty)
			 
			$database = & JDatabase::getInstance($option);
			$params->set('table_name', $params->get('ndb_table_name', ''));
		}
		//end new db connection
		
		$table_name = $params->get('table_name', '');
		if(!empty($table_name)){
			$model_id = $params->get('model_id', '');
			if(empty($model_id)){
				$model_id = 'chronoform_data';
			}
			//generate a dynamic model for the table
			$result = $database->getTableFields(array($table_name), false);
			$table_fields = $result[$table_name];
			$dynamic_model_code = array();
			$dynamic_model_code[] = "<?php";	
			$dynamic_model_code[] = "if (!class_exists('Table".str_replace($mainframe->getCfg('dbprefix'), '', $table_name)."')) {";
			$dynamic_model_code[] = "class Table".str_replace($mainframe->getCfg('dbprefix'), '', $table_name)." extends JTable {";	
			$primary = 'id';
			foreach($table_fields as $table_field => $field_data){
				$dynamic_model_code[] = "var \$".$table_field." = null;";
				if($field_data->Key == 'PRI')$primary = $table_field;
			}
			$dynamic_model_code[] = "function __construct(&\$database) {";
			if($params->get('ndb_enable', 0)){
				$dynamic_model_code[] = "\$db_inst = JDatabase::getInstance(".var_export($option, true).");";
				$dynamic_model_code[] = "parent::__construct('".$table_name."', '".$primary."', \$db_inst);";
			}else{
				$dynamic_model_code[] = "parent::__construct('".$table_name."', '".$primary."', \$database);";
			}
			$dynamic_model_code[] = "}";
			$dynamic_model_code[] = "}";
			$dynamic_model_code[] = "}";
			$dynamic_model_code[] = "?>";
			$dynamic_model = implode("\n", $dynamic_model_code);
			eval("?>".$dynamic_model);
			//load some variables
			$user =& JFactory::getUser();
			$defaults = array(
				'cf_uid' => md5(uniqid(rand(), true)),
				'cf_created' => date('Y-m-d H:i:s', time()),
				'cf_ipaddress' => $_SERVER["REMOTE_ADDR"],
				'cf_user_id' => $user->id
			);
			$row = JTable::getInstance(str_replace($mainframe->getCfg('dbprefix'), '', $table_name), 'Table');
			//get the data array under the model id if exists
			$form_data = $form->get_array_value($form->data, explode('.', $model_id));
			
			
			if((bool)$params->get('save_under_modelid', 0) === false){
				$form_data = $form->data;// = $form->set_array_value($form->data, explode('.', $model_id), $form->data);
			}else{
				//if it didn't exist then create an empty one
				if(!isset($form_data)){
					$form_data = array();
					//$form->data = $form->set_array_value($form->data, explode('.', $model_id), $form_data);
				}
			}
			
			//check if new record or updated one
			if(isset($form_data[$primary]) && !empty($form_data[$primary])){
				//don't merge, just set a modified date
				$form_data = array_merge(array('cf_modified' => date('Y-m-d H:i:s', time())), $form_data);
				$form->data = $form->set_array_value($form->data, explode('.', $model_id), $form_data);
			}else{
				$form_data = array_merge($defaults, $form_data);
				$form->data = $form->set_array_value($form->data, explode('.', $model_id), $form_data);
			}
			if(!$row->bind($form_data)){
				$form->debug[] = $row->getError();
			}
			if(!$row->store()){
				$form->debug[] = $row->getError();
			}
			$form->data[strtolower($model_id.'_'.$primary)] = $row->$primary;
			$form->data = $form->set_array_value($form->data, explode('.', $model_id.'.'.$primary), $row->$primary);
		}
	}
	
	function load_tables(){
		//print_r2($_GET);
		$option = array();
		$option['driver'] = JRequest::getVar('dbdriver', 'mysql');// Database driver name
		$option['host'] = JRequest::getVar('dbhost', 'localhost');// Database host name
		$option['user'] = JRequest::getVar('dbuser', '');// User for database authentication
		$option['password'] = JRequest::getVar('dbpass', '');// Password for database authentication
		$option['database'] = JRequest::getVar('dbname', '');// Database name
		$option['prefix'] = JRequest::getVar('dbprefix', 'jos_');// Database prefix (may be empty)
		//print_r2($option);
		$database = & JDatabase::getInstance($option);
		$tables = $database->getTableList();
		$options = array();
		foreach($tables as $table){
			$options[$table] = $table;
		}
		return implode(",", $options);
	}
	
	function load($clear){
		if($clear){
			$action_params = array(
				'table_name' => '',
				'enabled' => 1,
				'model_id' => 'chronoform_data',
				'save_under_modelid' => 0,
				'ndb_enable' => 0,
				'ndb_driver' => 'mysql',
				'ndb_host' => 'localhost',
				'ndb_user' => '',
				'ndb_password' => '',
				'ndb_database' => '',
				'ndb_table_name' => '',
				'ndb_prefix' => 'jos_'
			);
		}
		return array('action_params' => $action_params);
	}
}
?>