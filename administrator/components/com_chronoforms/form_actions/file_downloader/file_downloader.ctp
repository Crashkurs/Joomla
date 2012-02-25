<?php
require_once(JPATH_SITE.DS."administrator".DS."components".DS."com_chronoforms".DS."helpers".DS."tabs_helper.php");
$PluginTabsHelper = new TabsHelper();
?>
<div class="dragable" id="cfaction_file_downloader">File Downloader</div>
<!--start_element_code-->
<div class="element_code" id="cfaction_file_downloader_element">
	<label class="action_label">File Downloader</label>
		
	<input type="hidden" name="chronoaction[{n}][action_file_downloader_{n}_type]" id="action_file_downloader_{n}_type" value="<?php echo $action_params['type']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_file_downloader_{n}_downloads_path]" id="action_file_downloader_{n}_downloads_path" value="<?php echo $action_params['downloads_path']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_file_downloader_{n}_file_name]" id="action_file_downloader_{n}_file_name" value="<?php echo $action_params['file_name']; ?>" />
	
	<input type="hidden" id="chronoaction_id_{n}" name="chronoaction_id[{n}]" value="{n}" />
	<input type="hidden" name="chronoaction[{n}][type]" value="file_downloader" />
</div>
<!--end_element_code-->
<div class="element_config" id="cfaction_file_downloader_element_config">
	<?php echo $PluginTabsHelper->Header(array('settings' => 'Settings', 'help' => 'Help'), 'file_downloader_config_{n}'); ?>
	<?php echo $PluginTabsHelper->tabStart('settings'); ?>
		<?php echo $HtmlHelper->input('action_file_downloader_{n}_type_config', array('type' => 'select', 'label' => "Download Type", 'options' => array('D' => 'Download', 'I' => 'Inline'), 'smalldesc' => "Select what the user is going to get.")); ?>
		<?php echo $HtmlHelper->input('action_file_downloader_{n}_downloads_path_config', array('type' => 'text', 'label' => "Downloads Path", 'class' => 'big_input', 'smalldesc' => "The absolute path to the downloads directory on the server.")); ?>
		<?php echo $HtmlHelper->input('action_file_downloader_{n}_file_name_config', array('type' => 'text', 'label' => "File name", 'class' => 'medium_input', 'smalldesc' => "The file name.")); ?>
		
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('help'); ?>
		<p>
			<ul>
				<li>This plugin will display a download dialogue for a specific file or will display it inline based on your configuration.</li>
				<li>If this doesn't work then please use a "Debugger" action to check for any problems.</li>
			</ul>
		</p>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
</div>