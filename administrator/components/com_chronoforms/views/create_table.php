<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
?>
<?php
	$mainframe =& JFactory::getApplication();
	require_once(JPATH_SITE.DS."administrator".DS."components".DS."com_chronoforms".DS."helpers".DS."html_helper.php");
	$HtmlHelper = new HtmlHelper();
?>
<script type="text/javascript"> 
//<![CDATA[
function select_one(id){
	$$('input[id^=field_key_]').each(function(check){
		check.set('checked', false);
	});
	$('field_key_'+id).checked = true;
}
//]]>
</script>
<link rel="stylesheet" type="text/css" href="<?php echo JURI::Base(); ?>components/com_chronoforms/css/frontforms.css">
<?php
$wrong_inputs = array();
foreach($defaults as $default => $default_data){
	if((int)preg_match("/^[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*$/", $default) == 0){
		$wrong_inputs[] = $default;
		JError::raiseWarning(200, 'Field name "'.$default.'" is invalid, please fix the field name in the wizard (or the form code) then retry again.');
	}
}
if(!empty($wrong_inputs)){
	JError::raiseNotice(200, 'A valid variable name starts with a letter or underscore, followed by any number of letters, numbers, or underscores.');
}
?>

<form action="index.php?option=com_chronoforms" method="post" name="adminForm" id="adminForm">
<?php echo $HtmlHelper->input('_cf_table_name', array('label' => 'Table Name', 'value' => '#__chronoforms_data_'.str_replace("-", "_", $row->name), 'class' => 'medium_input', 'smalldesc' => 'Enter the table name here, no spaces or any special characters, underscores allowed.')); ?>
<table class="adminlist">
<thead>
	<th width="1%" class='title'>#</th>
	<th width="5%" class='title' style="text-align: left;">Field name</th>
	<th width="1%" class='title' style="text-align: left;">Enabled<input type="checkbox" checked name="toggle" value="" onclick="checkAll(<?php echo count($defaults); ?>, 'enabled');" /></th>
	<th width="10%" align="left" class='title' style="text-align: left;">Type</th>
	<th width="10%" align="left" class='title' style="text-align: left;">Length</th>
	<th width="2%" align="left" class='title' style="text-align: left;">Primary key</th>
	<th width="10%" align="left" class='title' style="text-align: left;">Default</th>
	<th width="10%" align="left" class='title' style="text-align: left;">Extra</th>
</thead>
<?php if(!empty($defaults)): ?>
	<?php $i = 0; ?>
	<?php foreach($defaults as $default => $default_data): ?>
		<?php if(!in_array($default, $wrong_inputs)): ?>
		<tr>
		<?php else: ?>
		<?php $default_data['enabled'] = 0; ?>
		<tr style="color:#ff0000;">
		<?php endif; ?>
			<td width="1%" class='title'><?php echo $i + 1;?></td>
			<td width="5%" class='title'><?php echo $default; ?></td>
			<td width="1%" class='title'>
				<input type="checkbox" id="enabled<?php echo $i;?>" name="enabled[<?php echo $i;?>]" value="1"<?php if($default_data['enabled'] == 1)echo ' checked'; ?> onclick="isChecked(this.checked);" />
			</td>
			<td width="10%" align="left" class='title'>
				<select name="field_type[<?php echo $i;?>]" id="field_type_<?php echo $i; ?>">
					<option value="VARCHAR"<?php if($default_data['type'] == 'VARCHAR')echo ' selected'; ?>>VARCHAR</option>
					<option value="TINYINT">TINYINT</option>
					<option value="TEXT">TEXT</option>
					<option value="DATE">DATE</option>
					<option value="SMALLINT">SMALLINT</option>
					<option value="MEDIUMINT">MEDIUMINT</option>
					<option value="INT"<?php if($default_data['type'] == 'INT')echo ' selected'; ?>>INT</option>
					<option value="BIGINT">BIGINT</option>
					<option value="FLOAT">FLOAT</option>
					<option value="DOUBLE">DOUBLE</option>
					<option value="DECIMAL">DECIMAL</option>
					<option value="DATETIME"<?php if($default_data['type'] == 'DATETIME')echo ' selected'; ?>>DATETIME</option>
					<option value="TIMESTAMP">TIMESTAMP</option>
					<option value="TIME">TIME</option>
					<option value="YEAR">YEAR</option>
					<option value="CHAR">CHAR</option>
					<option value="TINYBLOB">TINYBLOB</option>
					<option value="TINYTEXT">TINYTEXT</option>
					<option value="BLOB">BLOB</option>
					<option value="MEDIUMBLOB">MEDIUMBLOB</option>
					<option value="MEDIUMTEXT">MEDIUMTEXT</option>
					<option value="LONGBLOB">LONGBLOB</option>
					<option value="LONGTEXT">LONGTEXT</option>
					<option value="ENUM">ENUM</option>
					<option value="SET">SET</option>
					<option value="BIT">BIT</option>
					<option value="BOOL">BOOL</option>
					<option value="BINARY">BINARY</option>
					<option value="VARBINARY">VARBINARY</option>
				</select>
			</td>
			<td width="10%" align="left" class='title'><input type="text" name="field_length[<?php echo $i; ?>]" value="<?php echo $default_data['length']; ?>" /></td>
			<td width="2%" align="left" class='title'><input type="checkbox" onclick="select_one(<?php echo $i; ?>)" id="field_key_<?php echo $i; ?>" value="1" name="field_key[<?php echo $i; ?>]"<?php if($default_data['key'] == 'PRI')echo ' checked'; ?> /></td>
			<td width="10%" align="left" class='title'><input type="text" name="field_default[<?php echo $i; ?>]" value="<?php echo $default_data['default']; ?>" /></td>
			<td width="10%" align="left" class='title'>
				<select name="field_extra[<?php echo $i;?>]">
					<option value=""></option>
					<option value="auto_increment"<?php if($default_data['extra'] == 'auto_increment')echo ' selected'; ?>>auto_increment</option>
				</select>
			</td>
			<input type="hidden" name="field_name[<?php echo $i; ?>]" value="<?php echo $default; ?>" />
		</tr>
	<?php $i++; ?>
	<?php endforeach; ?>
<?php endif; ?>
<?php $i = count($defaults); ?>
<?php for($x = 0; $x <= 30; $x++): ?>
	<tr>
		<td width="1%" class='title'><?php echo $i + 1;?></td>
		<td width="5%" class='title'><input type="text" name="field_name[<?php echo $i; ?>]" value="" /></td>
		<td width="1%" class='title'>
			<input type="checkbox" id="enabled<?php echo $i;?>" name="enabled[<?php echo $i;?>]" value="1" onclick="isChecked(this.checked);" />
		</td>
		<td width="10%" align="left" class='title'>
			<select name="field_type[<?php echo $i;?>]" id="field_type_<?php echo $i; ?>">
				<option value="VARCHAR">VARCHAR</option>
				<option value="TINYINT">TINYINT</option>
				<option value="TEXT">TEXT</option>
				<option value="DATE">DATE</option>
				<option value="SMALLINT">SMALLINT</option>
				<option value="MEDIUMINT">MEDIUMINT</option>
				<option value="INT">INT</option>
				<option value="BIGINT">BIGINT</option>
				<option value="FLOAT">FLOAT</option>
				<option value="DOUBLE">DOUBLE</option>
				<option value="DECIMAL">DECIMAL</option>
				<option value="DATETIME">DATETIME</option>
				<option value="TIMESTAMP">TIMESTAMP</option>
				<option value="TIME">TIME</option>
				<option value="YEAR">YEAR</option>
				<option value="CHAR">CHAR</option>
				<option value="TINYBLOB">TINYBLOB</option>
				<option value="TINYTEXT">TINYTEXT</option>
				<option value="BLOB">BLOB</option>
				<option value="MEDIUMBLOB">MEDIUMBLOB</option>
				<option value="MEDIUMTEXT">MEDIUMTEXT</option>
				<option value="LONGBLOB">LONGBLOB</option>
				<option value="LONGTEXT">LONGTEXT</option>
				<option value="ENUM">ENUM</option>
				<option value="SET">SET</option>
				<option value="BIT">BIT</option>
				<option value="BOOL">BOOL</option>
				<option value="BINARY">BINARY</option>
				<option value="VARBINARY">VARBINARY</option>
			</select>
		</td>
		<td width="10%" align="left" class='title'><input type="text" name="field_length[<?php echo $i; ?>]" value="" /></td>
		<td width="2%" align="left" class='title'><input type="checkbox" onclick="select_one(<?php echo $i; ?>)" id="field_key_<?php echo $i; ?>" value="1" name="field_key[<?php echo $i; ?>]" /></td>
		<td width="10%" align="left" class='title'><input type="text" name="field_default[<?php echo $i; ?>]" value="" /></td>
		<td width="10%" align="left" class='title'>
			<select name="field_extra[<?php echo $i;?>]">
				<option value=""></option>
				<option value="auto_increment">auto_increment</option>
			</select>
		</td>
		
	</tr>
<?php $i++; ?>
<?php endfor; ?>
</table>
<input type="hidden" name="boxchecked" value="" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="option" value="com_chronoforms" />
</form>