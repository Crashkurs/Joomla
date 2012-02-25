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
<?php
	preg_match('/http(s)*:\/\/(.*?)\//i', $uri->root(), $matches);
	$domain = $matches[2];
?>
<form action="index.php?option=com_chronoforms" method="post" name="adminForm" id="adminForm">
<table class="adminlist">
<thead>
	<th width="20%" align="left" class='title' style="text-align: left;">Element</th>
	<th width="80%" align="left" class='title' style="text-align: left;">Value</th>
</thead>
<tr>
	<td width="20%" class='title'>Domain</td>
	<td width="80%" class='title'><?php echo $domain; ?></td>
</tr>
<tr>
	<td width="20%" class='title'>Product</td>
	<td width="80%" class='title'>
		<select name="pid">
			<option value="14">Chronoforms 3 domains subscription</option>
			<option value="4">Chronoforms 5 domains subscription</option>
			<option value="6">Chronoforms Ultimate subscription</option>
		</select>
	</td>
</tr>
<tr>
	<td width="20%" class='title'>Validation key</td>
	<td width="80%" class='title'>
		<input type="text" name="licensecode" size="60" />
		<?php
			if($params->get('licensecode', '')){
				echo $params->get('licensecode', '');
			}
		?>
	</td>
</tr>
<tr>
	<td width="20%" class='title'>Instant key</td>
	<td width="80%" class='title'>
		<input type="text" name="instantcode" size="200" />
		<br />
		(Usually not necessary)
	</td>
</tr>
<tr>
	<td width="20%" class='title'>Version</td>
	<?php
	$filename = JPATH_SITE.DS."administrator".DS."components".DS."com_chronoforms".DS."chronoforms.xml";
	$handle = fopen($filename, "r");
	$xml_content = fread($handle, filesize($filename));
	fclose($handle);
	preg_match('/<version>(.*?)<\/version>/i', $xml_content, $matches);
	if(isset($matches[1])){
		$version = $matches[1];
	}else{
		$version = 'NOT FOUND!';
	}
	?>
	<td width="80%" class='title'><?php echo $version; ?>
	</td>
</tr>
</table>
<input type="hidden" name="boxchecked" value="" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="option" value="com_chronoforms" />
</form>