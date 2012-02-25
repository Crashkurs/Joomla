<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionDbMultiRecordLoader{
	var $formname;
	var $formid;
	var $events = array('found' => 0, 'notfound' => 0, 'nodata' => 0);
	var $group = array('id' => 'db_operations', 'title' => 'DB Operations');
	var $details = array('title' => 'DB Multi Record Loader', 'tooltip' => 'Load all records from a database table based on some request data.');
	function run($form, $actiondata){
		$params = new JParameter($actiondata->params);
		$table_name = $params->get('table_name', '');
		if(!empty($table_name) && (int)$params->get('load_data', 1) == 1){
			$mainframe =& JFactory::getApplication();
			$database =& JFactory::getDBO();
			
			$table_field = $params->get('dbfield', '');
			if(trim($actiondata->content1)){
				$where = " WHERE ".$this->_processWhere(trim($actiondata->content1), $form);
			}else if(!empty($table_field)){
				$where = " WHERE `".$params->get('dbfield', '')."` = '".$form->data[$params->get('request_param', '')]."'";
			}else{
				$where = "";
			}
			//load the model_id
			$model_id_sub = preg_replace('/(?:^|_)(.?)/e', "strtoupper('$1')", $table_name);
			$model_id = $params->get('model_id', '');
			if(empty($model_id)){
				$model_id = $model_id_sub;
			}
						
			//check fields
			$fields = array();
			if(trim($params->get('fields', ''))){
				$fields_list = explode(",", trim($params->get('fields', '')));
				foreach($fields_list as $field){
					$fields[] = "`".$field."`";
				}
			}else{
				$fields = array("`".$model_id."`.*");
			}
			
			//check the association
			$assoc = '';
			$assoc_models = array();
			$primaries = array();
			if($params->get('enable_association', 0) == 1 && $params->get('load_data', 1) == 1){
				if(trim($params->get('associated_models', ''))){
					//add primary key for the main table
					$fields_list = $database->getTableFields(array(trim($params->get('table_name', ''))), false);
					$table_fields = $fields_list[trim($params->get('table_name', ''))];
					foreach($table_fields as $table_field => $field_data){
						if($field_data->Key == 'PRI'){
							$primaries[$model_id] = $table_field;
						}
					}
					//find associated models list
					$assoc_models = explode(',', $params->get('associated_models'));
					foreach($assoc_models as $k => $assoc_model){
						$assoc_models[$k] = trim($assoc_model);
					}
					//find other multi record loaders
					$models_list = array();
					$wheres_list = array();
					foreach($form->form_actions as $form_action){
						if($form_action->type == 'db_multi_record_loader'){
							$action_params = new JParameter($form_action->params);
							if(trim($action_params->get('model_id', '')) && trim($action_params->get('table_name', ''))){
								$models_list[trim($action_params->get('model_id', ''))] = array('table' => trim($action_params->get('table_name', '')));
								$models_list[trim($action_params->get('model_id', ''))]['join_type'] = trim($action_params->get('join_type', 'INNER'));
								$models_list[trim($action_params->get('model_id', ''))]['join_rule'] = trim($action_params->get('join_rule', ''));
								
								if(in_array(trim($action_params->get('model_id', '')), $assoc_models)){
									//find some table info (primary key)
									$fields_list = $database->getTableFields(array(trim($action_params->get('table_name', ''))), false);
									$table_fields = $fields_list[trim($action_params->get('table_name', ''))];
									foreach($table_fields as $table_field => $field_data){
										if($field_data->Key == 'PRI'){
											$primaries[trim($action_params->get('model_id', ''))] = $table_field;
										}
									}
									//get table fields list
									if(trim($action_params->get('fields', ''))){
										$table_fields = explode(",", trim($action_params->get('fields', '')));
										foreach($table_fields as $table_field){
											$table_field = trim($table_field);
											$field_alias = "`".trim($action_params->get('model_id', '')).".".$table_field."`";
											$field_name = "`".trim($action_params->get('model_id', ''))."`.`".$table_field."`";
											$fields[] = $field_name." AS ".$field_alias;
										}
									}else{										
										foreach($table_fields as $table_field => $field_data){
											$fields[] = "`".trim($action_params->get('model_id', ''))."`.`".$table_field."` AS `".trim($action_params->get('model_id', '')).".".$table_field."`";
										}
										//$fields[] = "`".trim($action_params->get('model_id', ''))."`.*";
									}
									//append any WHERE data
									if(trim($form_action->content1)){
										if(!empty($where)){
											//$where .= " AND ".$this->_processWhere($form_action->content1, $form);
											$wheres_list[trim($action_params->get('model_id', ''))] = " ON ".$this->_processWhere($form_action->content1, $form);
										}else{
											$where = " WHERE ".$this->_processWhere($form_action->content1, $form);
										}
									}
								}
							}
						}
					}
					//build the JOIN statement
					foreach($assoc_models as $assoc_model){
						if(isset($models_list[$assoc_model])){
							$assoc .= " ".$models_list[$assoc_model]['join_type']." JOIN `".$models_list[$assoc_model]['table']."` AS `".$assoc_model."`";
							if(strlen(trim($models_list[$assoc_model]['join_rule'])) > 0){
								$assoc .= " ON ".$models_list[$assoc_model]['join_rule'];
							}
							if(isset($wheres_list[$assoc_model])){
								$assoc .= $wheres_list[$assoc_model];
							}
						}
					}
				}
			}
			//add the page navigation data
			if((bool)$params->get('enable_pagination', 0) === true && $params->get('load_type', 'all') == 'all'){
				$option = 'com_chronoforms.db_multi_record_loader.'.$actiondata->id;
				$session =& JFactory::getSession();
				if(isset($form->data['limit'])){
					$session->set($option.'.limit', (int)$form->data['limit'], md5('chrono'));
				}
				$limit = $mainframe->getUserStateFromRequest($option.'.limit', 'limit', $session->get($option.'.limit', (int)$params->get('pagination_limit', 50), md5('chrono')), 'int'); 
				$limitstart = $mainframe->getUserStateFromRequest($option.'.limitstart', 'limitstart', 0, 'int');
				
				$sql = "SELECT count(*) FROM `".$params->get('table_name', '')."` AS `".$model_id."`".$assoc.$where;
				$database->setQuery($sql);
				$total = $database->loadResult();
				
				jimport('joomla.html.pagination');
				$pageNav = new JPagination($total, $limitstart, $limit);
				//get current page url
				//load show_html action helper class
				$form->loadActionHelper('show_html');
				$url = CfactionShowHtmlHelper::selfURL();
				if($form->admin === false){
					$form->paginatior_footer = '<form action="'.$url.'" method="post" name="chronoform_pagination_'.$actiondata->id.'" id="chronoform_pagination_'.$actiondata->id.'">';
				}else{
					$form->paginatior_footer = '<form action="'.$url.'" method="post" name="adminForm" id="adminForm">';
				}
				$form->paginatior_footer .= $pageNav->getListFooter();
				$form->paginatior_footer .= '</form>';
				//check order data
				$order = '';
				if(isset($form->data['order'])){
					$order = ' ORDER BY `'.trim($form->data['order']).'`'.(isset($form->data['direction']) ? ' '.$form->data['direction']: ' ASC');
				}
				$fields = implode(", ", $fields);
				if((bool)$params->get('count', 0) === true){
					$fields = 'count(*)';
				}
				$sql = "SELECT ".$fields." FROM `".$params->get('table_name', '')."` AS `".$model_id."`".$assoc.$where.$order." LIMIT $pageNav->limitstart,$pageNav->limit";
			}else{
				$fields = implode(", ", $fields);
				if((bool)$params->get('count', 0) === true){
					$fields = 'count(*)';
				}
				$sql = "SELECT ".$fields." FROM `".$params->get('table_name', '')."` AS `".$model_id."`".$assoc.$where;
			}
			//echo $form->paginatior_footer;
			//add debug data
			$form->debug['db_multi_record_loader'][] = $sql;
			//run the sql and get the data
			$database->setQuery($sql);
			if($params->get('load_type', 'all') == 'first'){
				$data = $database->loadAssoc();
			}else{
				$data = $database->loadAssocList();
			}
			//process the data if association was enabled
			if(!empty($assoc_models) && !empty($data)){
				if($params->get('load_type', 'all') == 'first'){
					foreach($data as $k => $v){
						if(strpos($k, '.')){
							$details = explode('.', $k);
							$data[$details[0]][$details[1]] = $v;
							unset($data[$k]);
						}
					}
				}else{
					foreach($data as $datak => $datav){
						if(is_array($datav)){
							foreach($datav as $k => $v){
								if(strpos($k, '.')){
									$details = explode('.', $k);
									$data[$datak][$details[0]][$details[1]] = $v;
									unset($data[$datak][$k]);
								}
							}
						}
					}
					if((int)$params->get('group_model_data', 1) == 1){
						$data = $this->group_model_data($data, $model_id, $primaries);
					}
				}
			}
			//print_r2($data);
			//data must be loaded under some model id
			$form->data[$model_id] = $data;
			//check the result
			//$request_val = $form->data[$params->get('request_param', '')];
			if(empty($data)){
				$this->events['notfound'] = 1;
			}else{
				$this->events['found'] = 1;
			}			
			//print_r2($form->data);
		}
	}
	
	function group_model_data($data, $main_model_id, $primaries){
		if(!empty($primaries)){
			if(isset($primaries[$main_model_id])){
				$primary = $primaries[$main_model_id];
				unset($primaries[$main_model_id]);
			}else{
				return $data;
			}
			$unique_values = array();
			$new_data = array();
			foreach($data as $datak => $datav){
				if(is_array($datav)){
					if(isset($datav[$primary])){
						if(!isset($unique_values[$datav[$primary]])){
							$unique_values[$datav[$primary]] = $datak;
							//$new_data[] = $datav;
							foreach($primaries as $model => $pr){
								if(isset($datav[$model])){
									$temp_model_data = $datav[$model];
									unset($datav[$model]);
									$datav[$model][] = $temp_model_data;
								}
							}
							$new_data[$datak] = $datav;
						}else{
							foreach($primaries as $model => $pr){
								if(isset($datav[$model])){
									$temp_model_data = $datav[$model];
									unset($datav[$model]);
									$new_data[$unique_values[$datav[$primary]]][$model][] = $temp_model_data;
								}
							}
						}
						
					}					
				}
			}
			foreach($primaries as $model => $pr){
				foreach($new_data as $k => $v){
					if(is_array($v) && isset($v[$model])){
						$new_data[$k][$model] = $this->group_model_data($v[$model], $model, $primaries);
					}
				}
			}
			$data = $new_data;
		}
		return $data;
	}
	
	function _processWhere($code, $form){
		ob_start();
		eval("?>".$code);
		$code = ob_get_clean();
		return $code;
	}
	
	function load($clear){
		if($clear){
			$action_params = array(
				'dbfield' => '',
				'table_name' => '',
				'request_param' => '',
				'load_data' => 1,
				'model_id' => '',
				'fields' => '',
				'count' => 0,
				'join_type' => 'INNER',
				'join_rule' => '',
				'load_type' => 'all',
				'enable_association' => 0,
				'associated_models' => '',
				'group_model_data' => 1,
				'pagination_limit' => '50',
				'enable_pagination' => 0,
				'data_display_fields' => '',
				'enable_data_displayer' => 0,
				'data_order_fields' => '',
				'content1' => ''
			);
		}
		return array('action_params' => $action_params);
	}
}
?>