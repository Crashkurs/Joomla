<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
	$mainframe =& JFactory::getApplication();
	$primary = '';
	foreach($table_fields as $table_field => $field_data){
		if($field_data->Key == 'PRI'){
			$primary = $table_field;
		}
	}
?>
<h3>Listing data records for table: <?php echo $table_name; ?></h3>
<?php if(empty($primary)): ?>
<h3 style="color:red;">This table has no primary keys and its records can't be viewed!</h3>
<?php endif; ?>
<?php
	$extra_dataview_actions = array();
	$extra_table_fields = array();
	if(isset($_POST['form_id'])){
		$row =& JTable::getInstance('chronoforms', 'Table');
		$row->load($_POST['form_id']);
		$params = new JParameter($row->params);
		$dataview_actions = $params->get('dataview_actions', '');
		if(strlen(trim($params->get('dataview_fields_'.$table_name, ''))) > 0){
			$extra_table_fields = explode(",", $params->get('dataview_fields_'.$table_name, ''));
		}
		if(!empty($dataview_actions)){
			$dataview_actions = explode(",", $dataview_actions);
			foreach($dataview_actions as $dataview_action){
				$action_pieces = explode(":", $dataview_action);
				$extra_dataview_actions[$action_pieces[0]] = $action_pieces[1];
			}
		}
	}
?>
<form action="index.php?option=com_chronoforms" method="post" name="adminForm" id="adminForm">
<table class="adminlist">
<thead>
	<th width="1%" class='title'>#</th>
	<?php if(!empty($primary)): ?>
	<th width="2%" class='title' style="text-align: left;">ID</th>	
	<th width="1%" class='title' style="text-align: left;"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($table_data); ?>);" /></th>
	<?php endif; ?>
	<th width="10%" align="left" class='title' style="text-align: left;">Record</th>
	<?php foreach($extra_table_fields as $table_field): ?>
		<th width="10%" align="left" class='title' style="text-align: left;"><?php echo $table_field; ?></th>
	<?php endforeach; ?>
	<?php foreach($extra_dataview_actions as $action_k => $action_title): ?>
		<th width="10%" align="left" class='title' style="text-align: left;"><?php echo $action_title; ?></th>
	<?php endforeach; ?>
</thead>
<?php if(!empty($table_data)): ?>
	<?php $i = 0; ?>
	<?php foreach($table_data as $row): ?>
		<tr>
			<td width="1%" class='title'><?php echo $i + 1;?></td>
			<?php if(!empty($primary)): ?>
			<td width="2%" class='title'><?php echo $row->$primary; ?></td>			
			<td width="1%" class='title'>
				<input type="checkbox" id="cb<?php echo $i;?>" name="cb[]" value="<?php echo $row->$primary; ?>" onclick="isChecked(this.checked);" />
			</td>
			<?php endif; ?>
			<td width="10%" align="left" class='title'><a href="#show_data" onclick="return listItemTask('cb<?php echo $i;?>','show_data')">Record #<?php echo $i + 1 + $pageNav->limitstart; ?></a></td>
			<?php foreach($extra_table_fields as $table_field): ?>
				<th width="10%" align="left" class='title' style="text-align: left;"><?php echo $row->$table_field; ?></th>
			<?php endforeach; ?>
			<?php foreach($extra_dataview_actions as $action_k => $action_title): ?>
				<td width="10%" align="left" class='title'><a href="#admin_form:<?php echo $action_k; ?>" onclick="return listItemTask('cb<?php echo $i;?>','admin_form:<?php echo $action_k; ?>')"><?php echo $action_title; ?> #<?php echo $i + 1 + $pageNav->limitstart; ?></a></td>
			<?php endforeach; ?>
		</tr>
	<?php $i++; ?>
	<?php endforeach; ?>
<?php endif; ?>
<tr><td colspan="<?php echo (4 + count($extra_dataview_actions) + count($extra_table_fields)); ?>" style="white-space:nowrap;" height="20px"><?php echo $pageNav->getListFooter(); ?></td></tr>
</table>
<input type="hidden" name="table_name" value="<?php echo $table_name; ?>" />
<?php if(isset($_POST['form_id'])): ?>
<input type="hidden" name="form_id" value="<?php echo $_POST['form_id']; ?>" />
<?php endif; ?>
<input type="hidden" name="boxchecked" value="" />
<input type="hidden" name="task" value="list_data" />
<input type="hidden" name="option" value="com_chronoforms" />
</form>