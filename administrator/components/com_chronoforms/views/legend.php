<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
$mainframe =& JFactory::getApplication();
$uri =& JFactory::getURI();
?>
<table class="adminlist">
	<thead>
		<th width="10%" class='title' style="text-align: center;">Symbol</th>
		<th width="90%" class='title' style="text-align: left;">Meaning</th>
	</thead>
	<tr>
		<td width="10%" class='title' style="text-align: center;">
			<img src="<?php echo JURI::Base(); ?>components/com_chronoforms/css/formwizard/delete.gif" alt="remove" width="15" height="15">
		</td>
		<td width="90%" class='title'>Delete the element.</td>
	</tr>
	<tr>
		<td width="10%" class='title' style="text-align: center;">
			<img src="<?php echo JURI::Base(); ?>components/com_chronoforms/css/formwizard/edit.png" alt="remove" width="15" height="15">
		</td>
		<td width="90%" class='title'>Show the element settings box.</td>
	</tr>
	<tr>
		<td width="10%" class='title' style="text-align: center;">
			<img src="<?php echo JURI::Base(); ?>components/com_chronoforms/css/formwizard/sort.png" alt="remove" width="15" height="15">
		</td>
		<td width="90%" class='title'>Drag to sort the element order.</td>
	</tr>
	<tr>
		<td width="10%" class='title' style="text-align: center;">
			<img src="<?php echo JURI::Base(); ?>components/com_chronoforms/css/formwizard/drag.png" alt="remove" width="22" height="22">
		</td>
		<td width="90%" class='title'>Draggable item.</td>
	</tr>
	<tr>
		<td width="10%" class='title' style="text-align: center;">
			<img src="<?php echo $uri->root(); ?>includes/js/ThemeOffice/tooltip.png" alt="remove" width="16" height="16">
		</td>
		<td width="90%" class='title'>Tooltip, hover to display some hints.</td>
	</tr>
</table>