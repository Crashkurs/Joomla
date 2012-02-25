<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
/* ensure that this file is called from another file */
defined('_JEXEC') or die('Restricted access'); 
class menuChronoForms {

	function form_wizard_menu(){
		JToolBarHelper::title(JText::_('Form Wizard'));
		JToolBarHelper::save('form_wizard');
		JToolBarHelper::apply('apply_wizard_changes');
		JToolBarHelper::divider();
		JToolBarHelper::cancel();
	}
	
	function admin_form_menu(){
		JToolBarHelper::title(JText::_('Admin forms processor'));
		JToolBarHelper::back();
	}
	
	function index_menu(){
		JToolBarHelper::title(JText::_('Forms Manager'));
		JToolBarHelper::addNew();
		JToolBarHelper::custom($task = 'copy', $icon = 'copy_f2.png', $iconOver = 'copy_f2.png', $alt = 'Copy form', $listSelect = true);
		JToolBarHelper::editList();
		JToolBarHelper::divider();
		JToolBarHelper::deleteList();
		JToolBarHelper::divider();
		JToolBarHelper::custom($task = 'create_table', $icon = 'wizard.png', $iconOver = 'wizard.png', $alt = 'Create table', $listSelect = true);
		JToolBarHelper::custom($task = 'list_data', $icon = 'properties_f2.png', $iconOver = 'properties_f2.png', $alt = 'Show Data', $listSelect = true);
		JToolBarHelper::divider();
		JToolBarHelper::custom($task = 'backup_forms', $icon = 'backup.png', $iconOver = 'backup.png', $alt = 'Backup Forms', $listSelect = true);
		JToolBarHelper::custom($task = 'restore_forms', $icon = 'dbrestore.png', $iconOver = 'dbrestore.png', $alt = 'Restore Forms', $listSelect = false);
		JToolBarHelper::divider();
		JToolBarHelper::custom($task = 'install_action', $icon = 'extensions.png', $iconOver = 'extensions.png', $alt = 'Install Action', $listSelect = false);
	}
	
	function edit_menu(){
		JToolBarHelper::save();
		JToolBarHelper::apply();
		JToolBarHelper::spacer();
		JToolBarHelper::cancel();		
	}
	
	function create_table_menu(){
		JToolBarHelper::title(JText::_('Create Table'));
		JToolBarHelper::save('save_table', 'Save');
		JToolBarHelper::spacer();
		JToolBarHelper::cancel();		
	}
	
	function list_data_menu(){
		JToolBarHelper::title(JText::_('Table Data Viewer'));
		if(isset($_POST['form_id'])){
			$row =& JTable::getInstance('chronoforms', 'Table');
			$row->load($_POST['form_id']);
			$params = new JParameter($row->params);
			$dataview_actions = $params->get('dataview_actions', '');
			if(!empty($dataview_actions)){
				$dataview_actions = explode(",", $dataview_actions);
				foreach($dataview_actions as $dataview_action){
					$action_pieces = explode(":", $dataview_action);
					JToolBarHelper::custom($task = 'admin_form:'.$action_pieces[0], $icon = 'wizard.png', $iconOver = 'wizard.png', $alt = $action_pieces[1], $listSelect = true);
				}
			}
		}
		//add CSV export action
		JToolBarHelper::custom($task = 'admin_form:cf_csv_export', $icon = 'wizard.png', $iconOver = 'wizard.png', $alt = 'CSV Export', $listSelect = false);
		JToolBarHelper::divider();
		JToolBarHelper::deleteList('', 'delete_data', 'Delete');
		JToolBarHelper::spacer();
		JToolBarHelper::cancel();		
	}
	
	function show_data_menu(){
		JToolBarHelper::title(JText::_('Record View'));
		JToolBarHelper::cancel('list_data', 'Cancel');		
	}
	
	function cancel_menu(){
		$task = JRequest::getVar('task', '');
		if($task == 'install_action'){
			JToolBarHelper::title(JText::_('Actions Installer'));
		}else if($task == 'restore_forms'){
			JToolBarHelper::title(JText::_('Restore Forms'));
		}
		JToolBarHelper::cancel('index', 'Cancel');		
	}
	
	function validatelicense_menu(){
		JToolBarHelper::title(JText::_('Validate installation'));
		JToolBarHelper::custom($task = 'validatelicense', $icon = 'bKey.png', $iconOver = 'bKey.png', $alt = 'Validate', $listSelect = false);
		JToolBarHelper::spacer();
		JToolBarHelper::cancel();
	}
}
?>