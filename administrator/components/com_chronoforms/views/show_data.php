<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
	$mainframe =& JFactory::getApplication();
?>
<form action="index.php?option=com_chronoforms" method="post" name="adminForm" id="adminForm">
<table class="adminlist">
<thead>
	<th width="20%" class='title'>Field title</th>
	<th width="80%" class='title'>Field value</th>
</thead>
<?php if(!empty($row_data)): ?>
	<?php $i = 0; ?>
	<?php foreach($table_fields as $table_field => $field_data): ?>
		<tr>
			<td width="20%" class='title'><?php echo $table_field; ?></td>
			<td width="80%" class='title'><?php echo htmlspecialchars($row_data->$table_field); ?></td>
		</tr>
	<?php $i++; ?>
	<?php endforeach; ?>
<?php endif; ?>
</table>
<input type="hidden" name="table_name" value="<?php echo $table_name; ?>" />
<?php if(isset($_POST['form_id'])): ?>
<input type="hidden" name="form_id" value="<?php echo $_POST['form_id']; ?>" />
<?php endif; ?>
<input type="hidden" name="boxchecked" value="" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="option" value="com_chronoforms" />
</form>