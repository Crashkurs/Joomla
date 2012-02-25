<div class="dragable" id="cfaction_csv_export_gh">CSV Export [GH]</div>
<!--start_element_code-->
<div class="element_code" id="cfaction_csv_export_gh_element">
	<label class="action_label" style="display: block; float:none!important;">CSV Export [GH]</label>
	<div id="cfactionevent_csv_export_gh_{n}_success" class="form_event good_event">
		<label class="form_event_label">OnSuccess</label>
	</div>
	<div id="cfactionevent_csv_export_gh_{n}_fail" class="form_event bad_event">
		<label class="form_event_label">OnFail</label>
	</div>
	<input type="hidden" name="chronoaction[{n}][action_csv_export_gh_{n}_table_name]" 
		id="action_csv_export_gh_{n}_table_name" value="<?php echo $action_params['table_name']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_csv_export_gh_{n}_save_path]" 
    	id="action_csv_export_gh_{n}_save_path" value="<?php echo $action_params['save_path']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_csv_export_gh_{n}_file_name]" 
    	id="action_csv_export_gh_{n}_file_name" value="<?php echo $action_params['file_name']; ?>" />
    <input type="hidden" name="chronoaction[{n}][action_csv_export_gh_{n}_delimiter]" 
    	id="action_csv_export_gh_{n}_delimiter" value="<?php echo $action_params['delimiter']; ?>" />
    <input type="hidden" name="chronoaction[{n}][action_csv_export_gh_{n}_enclosure]" 
    	id="action_csv_export_gh_{n}_enclosure" value="<?php echo $action_params['enclosure']; ?>" />

    <input type="hidden" name="chronoaction[{n}][action_csv_export_gh_{n}_download_export]" 
    	id="action_csv_export_gh_{n}_download_export" value="<?php echo $action_params['download_export']; ?>" />
    <input type="hidden" name="chronoaction[{n}][action_csv_export_gh_{n}_download_mime_type]" 
    	id="action_csv_export_gh_{n}_download_mime_type" value="<?php echo $action_params['download_mime_type']; ?>" />
    <input type="hidden" name="chronoaction[{n}][action_csv_export_gh_{n}_download_nosave]" 
    	id="action_csv_export_gh_{n}_download_nosave" value="<?php echo $action_params['download_nosave']; ?>" />

	<input type="hidden" name="chronoaction[{n}][action_csv_export_gh_{n}_where]" 
    	id="action_csv_export_gh_{n}_where" value="<?php echo $action_params['where']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_csv_export_gh_{n}_order_by]" 
    	id="action_csv_export_gh_{n}_order_by" value="<?php echo $action_params['order_by']; ?>" />
    <input type="hidden" name="chronoaction[{n}][action_csv_export_gh_{n}_include]" 
    	id="action_csv_export_gh_{n}_include" value="<?php echo $action_params['include']; ?>" />
    <input type="hidden" name="chronoaction[{n}][action_csv_export_gh_{n}_exclude]" 
    	id="action_csv_export_gh_{n}_exclude" value="<?php echo $action_params['exclude']; ?>" />

    <textarea name="chronoaction[{n}][action_csv_export_gh_{n}_content1]" id="action_csv_export_gh_{n}_content1" 
    	style="display:none"><?php echo $action_params['content1']; ?></textarea>
    
	<input type="hidden" id="chronoaction_id_{n}" name="chronoaction_id[{n}]" value="{n}" />
	<input type="hidden" name="chronoaction[{n}][type]" value="csv_export_gh" />
</div>
<!--end_element_code-->
<div class="element_config" id="cfaction_csv_export_gh_element_config">
<?php 
echo $PluginTabsHelper->Header(array('settings' => 'Settings', 'download' => 'Download', 'mysql' => 'MySQL', 'columns' => 'Columns', 'help' => 'Help'), 'csv_export_gh_config_{n}'); 
echo $PluginTabsHelper->tabStart('settings'); 
$database = JFactory::getDBO();
$tables = $database->getTableList();
$options = array();
foreach($tables as $table){
	$options[$table] = $table;
}
echo $HtmlHelper->input('action_csv_export_gh_{n}_table_name_config', 
	array(
		'type' => 'select', 
		'label' => 'Table', 
		'options' => $options, 
		'empty' => " - ", 
		'class' => 'medium_input', 
		'smalldesc' => 'The table to be used for the export.'
	)
); 
echo $HtmlHelper->input('action_csv_export_gh_{n}_save_path_config', 
	array(
		'type' => 'text', 
		'label' => "Save path", 
		'class' => 'big_input', 
		'value' => '', 
		'smalldesc' => 'The path to the folder where the csv file will be saved 
			e.g. '.JPATH_SITE.DS.'components'.DS.'com_chronocontact'.DS.'exports'.DS
	)); 
echo $HtmlHelper->input('action_csv_export_gh_{n}_file_name_config', 
	array(
		'type' => 'text', 
		'label' => "File name", 
		'class' => 'big_input', 
		'value' => '', 
		'smalldesc' => 'The name of the csv file. 
			You may include valid input values as {input_name}'
	)); 
echo $HtmlHelper->input('action_csv_export_gh_{n}_delimiter_config', 
	array(
		'type' => 'text', 
		'label' => "Delimiter", 
		'class' => 'small_input', 
		'value' => '', 
		'smalldesc' => 'The delimiter to be used for the CSV file, 
			a single character only, defaults to comma ,. Use ##tab## for a tab character.'
	)); 
echo $HtmlHelper->input('action_csv_export_gh_{n}_enclosure_config', 
	array(
		'type' => 'text', 
		'label' => "Enclosure", 
		'class' => 'small_input', 
		'value' => '', 
		'smalldesc' => 'The enclosure to be used for the CSV file, 
			a single character only, defaults to double quote "'
	)); 
echo $PluginTabsHelper->tabEnd(); 
echo $PluginTabsHelper->tabStart('download'); 
echo $HtmlHelper->input('action_csv_export_gh_{n}_download_export_config', 
	array(
		'type' => 'checkbox', 
		'label' => 'Immediate download', 
		'class' => 'checkbox',
		'value' => '1',
		'rule' => 'bool',
		'smalldesc' => 'If you check this box then the file will be downloaded immediately and your form or thank you page will not be displayed.'
	)
);
echo $HtmlHelper->input('action_csv_export_gh_{n}_download_nosave_config', 
	array(
		'type' => 'checkbox', 
		'label' => 'Do not save the file on the server', 
		'class' => 'checkbox',
		'value' => '1', 
		'rule' => "bool",
		'smalldesc' => 'If you check this box then the file will be created in the server memory and downloaded immediately.'
	)
); 

echo $HtmlHelper->input('action_csv_export_gh_{n}_download_mime_type_config', 
	array(
		'type' => 'checkbox', 
		'label' => 'Set mime type to \'octet\'', 
		'class' => 'checkbox',
		'value' => '1',
		'rule' => 'bool',
		'smalldesc' => 'If you check this box then the file type will be set to \'application/octet-stream\' instead of \'text/csv\'.'
	)
); 
echo $PluginTabsHelper->tabEnd(); 
echo $PluginTabsHelper->tabStart('mysql'); 
echo $HtmlHelper->input('action_csv_export_gh_{n}_where_config', 
	array(
		'type' => 'text', 
		'label' => "MySQL WHERE clause", 
		'class' => 'big_input', 
		'value' => '', 
		'smalldesc' => 'A valid MySQL WHERE clause to filter the results.'
	)); 
echo $HtmlHelper->input('action_csv_export_gh_{n}_order_by_config', 
	array(
		'type' => 'text', 
		'label' => "MySQL ORDER BY clause", 
		'class' => 'big_input', 
		'value' => '', 
		'smalldesc' => 'A valid MySQL ORDER BY clause to sort the results.'
	)); 
echo $PluginTabsHelper->tabEnd(); 
echo $PluginTabsHelper->tabStart('columns'); 
echo $HtmlHelper->input('action_csv_export_gh_{n}_include_config', 
	array(
		'type' => 'text', 
		'label' => "Include columns", 
		'class' => 'big_input', 
		'value' => '', 
		'smalldesc' => 'You can enter a comma separated list of column names to be exported'
	)); 
echo $HtmlHelper->input('action_csv_export_gh_{n}_exclude_config', 
	array(
		'type' => 'text', 
		'label' => "Exclude columns", 
		'class' => 'big_input', 
		'value' => '', 
		'smalldesc' => 'You can enter a comma separated list of column names *not* to be exported'
	)); 
echo $HtmlHelper->input('action_csv_export_gh_{n}_content1_config', 
	array(
		'type' => 'textarea', 
		'label' => "Column details", 
		'rows' => 20, 
		'cols' => 70, 
		'smalldesc' => 'For each database column to be exported add a new row using Column Title=column_name e.g. ID=id or User Name=name or Visible From=created_date. If you make any entry here then only columns included here will be exported; any \included\' or \'excluded\' entries above will be ignored.'
	));
echo $PluginTabsHelper->tabEnd(); 
echo $PluginTabsHelper->tabStart('help'); 
$style = "
div.tabs-panel {
	font-size: 100%;
}
div.tabs-panel tt{
	font-size: 120%;
}
";
$doc =& JFactory::getDocument();
$doc->addStyleDeclaration($style);

?> 
<div>This action helps you export some or all of the entries from a database table into a CSV file 
that can be downloaded and used for other purposes.</div>
<h4>Settings</h4>
<ul>
    <li>Select the Database table that you want to export data from. This is the only <i>required</i> input in the configuration.</li>
    <li>Enter a valid full path to the folder where the csv file should be saved. 
    	You may use form inputs e.g. {input_name} in the path*. <br />Defaults to
        <tt><?php echo JPATH_SITE.DS.'components'.DS.'com_chronoforms'.DS.'exports'.DS.'{form_name}'; ?></tt></li>
    <li>Enter a name for the file to be saved. 
    	You may use form inputs e.g. <tt>{input_name}</tt> in the file name*.
        The file suffix will be .csv, if this isn't set here it will be added after any existing suffix.<br />
        Defaults to <tt>csv_export_{$table_name}_{datetime}.csv</tt></li>
    <li>You can set values for the path or file name by creating file inputs with appropriate values. 
    	If {form_path} or {file_name} are set before this action in the form data or in a Custom Code action those 
    	values will replace any entries here.</li>
    <li>You can set a delimiter that will be placed between each value in a row. The default is a comma <tt>value1,value2</tt>. Use <tt>##tab##</tt> for a tab delimited file.</li>
    <li>You can set an enclosure character that will be used to enclose individual values where necessary. The default is a double quote <tt>"value 1"</tt>.</li>
    </ul>
<h4>Downloads</h4>
<ul>
	<li>The checkboxes on this tab allow you to control the way your file is downloaded.</li>
    <li>If you leave them all un-checked then the file will be saved to the server and you can use the entries added to the $form_>data array to display or email a download link or to leave the file for future reference.</li>
    <li>If you check the 'Immediate download' then the form will be downloaded when the either the form (if the action is in the On Load event) or the Thank You page loads. The file is still saved to the server but the download will act as a 'Show stopper' and no further actions will run.</li>
    <li>If you check the 'No Save' checkbox then the form will be downloaded when the either the form (if the action is in the On Load event) or the Thank You page loads. The file is not saved to the server. In this case the file is created in memory if it is less than 5Mb,or in a temporary file if it is larger than this. This may be useful if you do not want to save the files, or if you have limited permission on the server.</li>
    <li>If you check the 'Set mimtype to 'octet'' checkbox then the form will be downloaded with a type of 'application/octet-stream' instead of 'text/csv'. This may be useful if you want to prevent the file diplaying in the browser.</li>
</ul>
<h4>MySQL</h4>
This tab allows you to specify the records to be exported and the order of the export. Both use standard MySQL syntax.
<ul>
     <li>The MySQL WHERE clause will take a valid WHERE clause to filter the result to be exported e.g. `id` < 25 
     The word WHERE is optional.</li>
     <li>The MySQL ORDER BY clause will take a valid ORDER BY clause to sort the results to be exported e.g. `id` DESC 
     The words ORDER BY are optional.</li>
</ul>
<div>Paths and file names can include the special <tt>{table_name}</tt>, <tt>{datetime}</tt> and <tt>{rand}</tt> values. 
The value <tt>{datetime}</tt> inserts string in the form 'YmdHi' e.g. 201105101543; 
<tt>{rand}</tt> inserts a six digit random number e.g. 857943.</div>
<h4>Columns</h4>
<div>This tab offers two different ways to specify the columns to be exported. You may leave all the boxes empty in which case all the columns will be exported in the order they appear in the table and the column names will be shown in the first row of the exported file.</div>
<ul>
	<li>In the Include Columns box you can enter a comma separated list of columns to be included. If there is an entry here only these columns will be exported, and the order of columns will be the order of this list.</li>
    <li>In the Exclude Columns box you can enter a comma separated list of columns to be excluded. If the Include Columns box is empty all columns except these will be exported. If there are entries in the Included Columns box then any columns shown here will be removed from that list.</li>
    <li>The column Details box overrides the Included and Excluded lists; if there are any entries here then they will be ignored.
    You can enter any number of rows here each of which specifies one column to be exported. Each row takes the form <tt>Column Title=column_name</tt>. The Column Title will be shown in the first row of the exported file and the columns will be exported in the order that they are shown here. You can also add valid MySQL clauses in the place of the column_name e.g. <tt>Column Title=`value` + 7</tt>. If a row has no <tt>=</tt> character then the entry will be used for both the Column Title and the Column Name e.g. <tt>Languages</tt>.<br />
    Note: take care with these entries, they are very flexible but are not verified and mistakes may break the export.</li>
</ul>
<h4>Results</h4>
<div>The Action generates several outputs: a file saved to the server in the specified folder; and three new form data items <tt>{csv_link}</tt>, <tt>{csv_count}</tt> and <tt>{csv_size}</tt>. These give you a full URL for the new file and the number of records exported. You can use these in later actions like Emails or Thank You messages to allow access to the file.</div>
<div>You can use the success (or fail) events to do whatever you need after the response is processed.</div>


<?php 
echo $PluginTabsHelper->tabEnd(); 
?>
</div>