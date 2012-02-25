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
	require_once(JPATH_SITE.DS."administrator".DS."components".DS."com_chronoforms".DS."helpers".DS."html_helper.php");
	$HtmlHelper = new HtmlHelper();
	$HtmlHelper->data = $form;
	$params = new JParameter('');
	if(!empty($form)){
		$params = new JParameter($form->params);
	}
	$mainframe =& JFactory::getApplication();
	$database =& JFactory::getDBO();
	require_once(JPATH_SITE.DS."administrator".DS."components".DS."com_chronoforms".DS."helpers".DS."tabs_helper.php");
	$TabsHelper = new TabsHelper();
	$jversion = new JVersion();
?>
<script type="text/javascript" src="<?php echo JURI::Base(); ?>components/com_chronoforms/js/tabs.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo JURI::Base(); ?>components/com_chronoforms/css/frontforms.css">
<link rel="stylesheet" type="text/css" href="<?php echo JURI::Base(); ?>components/com_chronoforms/css/tabs_style.css">
<script language="javascript" type="text/javascript">
	<?php if($jversion->RELEASE > 1.5): ?>
	Joomla.submitbutton = function(pressbutton) {
		var form = document.adminForm;
		if(pressbutton == "cancel"){
			submitform(pressbutton);
			return;
		}
		var patt1 = new RegExp(/^[a-zA-Z0-9_-]+$/);
		if(!patt1.test($('chronoform_name').get('value').trim())){
			alert("Please enter a valid form name with alphanumeric characters, underscore_ or a dash -.");
			return false;
		}else{
			submitform(pressbutton);
		}
	}
	<?php else: ?>
	function submitbutton(pressbutton) {
		var form = document.adminForm;
		if(pressbutton == "cancel"){
			submitform(pressbutton);
			return;
		}
		var patt1 = new RegExp(/^[a-zA-Z0-9_-]+$/);
		if(!patt1.test($('chronoform_name').get('value').trim())){
			alert("Please enter a valid form name with alphanumeric characters, underscore_ or a dash -.");
			return false;
		}else{
			submitform(pressbutton);
		}
	}
	<?php endif; ?>
</script>
<form action="index.php?option=com_chronoforms" method="post" name="adminForm" id="adminForm">
<h2 style='margin: 3px 0;'>
<?php
if(!empty($form)){
	echo $form->name;
}else{
	echo 'New Form...';
}
?>
</h2>
<?php echo $TabsHelper->Header(array('general' => 'General', 'code' => 'Code', 'jsval' => 'JS Validation', 'admin_actions' => 'Admin actions', 'data_view' => 'Data View')); ?>
	<?php echo $TabsHelper->tabStart('general'); ?>
		<?php echo $HtmlHelper->input('name', array('type' => 'text', 'id' => 'chronoform_name', 'label' => 'Form name', 'class' => 'medium_input', 'smalldesc' => 'Unique form name without spaces or any special characters, underscores _ or dashes -')); ?>
		<?php echo $HtmlHelper->input('published', array('type' => 'select', 'label' => 'Published', 'options' => array(0 => 'No', 1 => 'Yes'), 'default' => 1)); ?>
		<?php echo $HtmlHelper->input('params[form_mode]', array('type' => 'select', 'label' => 'Form Wizard Mode', 'value' => $params->get('form_mode', 'advanced'), 'options' => array('advanced' => 'Advanced (Default)', 'easy' => 'Easy'), 'default' => 'advanced', 'smalldesc' => 'Choose your form wizard mode, the advanced mode is the default one, you will have all the Chronoforms V4 tools enabled in the wizard, the Easy mode is easier to use though and is enough to build strong simple forms.')); ?>
		<?php echo $HtmlHelper->input('params[form_method]', array('type' => 'select', 'label' => 'Form method', 'value' => $params->get('form_method', 'post'), 'options' => array('post' => 'Post', 'get' => 'Get', 'file' => 'File'), 'default' => 'post', 'smalldesc' => 'Choose your form method, File is ncessary to get file uploads working.')); ?>
		<?php echo $HtmlHelper->input('params[auto_detect_settings]', array('type' => 'select', 'label' => 'Auto Detect Settings', 'value' => $params->get('auto_detect_settings', 1), 'options' => array(0 => 'No', 1 => 'Yes (Advised)'), 'default' => 1, 'smalldesc' => 'Should the form detect some settings and apply them automatically ? settings like validtaion and files uploading will be detected based on your form code.')); ?>
		<?php echo $HtmlHelper->input('params[load_files]', array('type' => 'select', 'label' => 'Load Chronoforms files', 'value' => $params->get('load_files', 1), 'options' => array(0 => 'Disable completely', 1 => 'Load necessary files', 2 => 'Load ALL files!'), 'default' => 1)); ?>
		<?php echo $HtmlHelper->input('params[tight_layout]', array('type' => 'select', 'label' => 'Tight Layout', 'value' => $params->get('tight_layout', 0), 'options' => array(0 => 'Normal', 1 => 'Tight'), 'default' => 0, 'smalldesc' => 'Should the form load the regular CSS or load a tight CSS (less spaced out, smaller fields and less padding..etc) ?')); ?>
		<?php echo $HtmlHelper->input('params[action_url]', array('type' => 'text', 'label' => 'Submit URL', 'class' => 'big_input', 'value' => $params->get('action_url', ''), 'smalldesc' => 'Adding a submit URL will disable all the form "on submit" event functions.')); ?>
		<?php echo $HtmlHelper->input('params[form_tag_attach]', array('type' => 'text', 'label' => 'Form tag attachment', 'class' => 'big_input', 'value' => htmlspecialchars($params->get('form_tag_attach', '')), 'smalldesc' => 'Some data you may like to include into the < form .... > tag, e.g: onsubmit="someJSFunction();".')); ?>
		<?php //echo $HtmlHelper->input('params[submit_action]', array('type' => 'select', 'label' => 'Submit action', 'value' => $params->get('submit_action', 'submit'), 'options' => array('submit' => 'Submit', 'self' => 'Self'), 'default' => 'submit', 'smalldesc' => 'Select wheather the form should be submitted to usual onSubmit event or to the same loading event.')); ?>
		<?php echo $HtmlHelper->input('params[add_form_tags]', array('type' => 'select', 'label' => 'Add form tags', 'value' => $params->get('add_form_tags', 1), 'options' => array(0 => 'No', 1 => 'Yes'), 'default' => 1, 'smalldesc' => 'You may have a good reason to disable the form tags, but in this case your form will not be submittable.')); ?>
		<?php echo $HtmlHelper->input('params[relative_url]', array('type' => 'select', 'label' => 'Relative URL', 'value' => $params->get('relative_url', 1), 'options' => array(0 => 'No', 1 => 'Yes'), 'default' => 1, 'smalldesc' => 'do you want the action url to be relative to the current loaded form url ? useful to make your form submit to the same page its currently loaded at, when its inside a content page or a module.')); ?>
		<?php echo $HtmlHelper->input('params[dynamic_files]', array('type' => 'select', 'label' => 'Dynamic Files', 'value' => $params->get('dynamic_files', 0), 'options' => array(0 => 'No', 1 => 'Yes'), 'default' => 0, 'smalldesc' => 'Load the form JS/CSS code inside a dynamic file instead of the page head, useful in few situations and to tidy up the page header.')); ?>
		<?php //echo $HtmlHelper->input('params[handle_arrays]', array('type' => 'select', 'label' => 'Handle arrays', 'value' => $params->get('handle_arrays', 1), 'options' => array(0 => 'No', 1 => 'Yes'), 'default' => 1, 'smalldesc' => 'Submitted values of type arrays (like checkboxes groups) will be concatenated into 1 string.')); ?>
		<?php //echo $HtmlHelper->input('params[handle_arrays_skipped]', array('type' => 'text', 'label' => 'Skipped array fields', 'class' => 'big_input', 'smalldesc' => 'List of fields names which may hold arrays and should be skipped of being handled, e.g: field1,field2,..etc')); ?>
		<?php //echo $HtmlHelper->input('params[debug]', array('type' => 'select', 'label' => 'Debug', 'value' => $params->get('debug', 0), 'options' => array(0 => 'No', 1 => 'Yes'), 'default' => 0, 'smalldesc' => 'The debug should show some useful info about the form data and flow when loaded and/or submitted.')); ?>
		<?php echo $HtmlHelper->input('params[enable_plugins]', array('type' => 'select', 'label' => 'Enable Joomla plugins', 'value' => $params->get('enable_plugins', 0), 'options' => array(0 => 'No', 1 => 'Yes'), 'default' => 0, 'smalldesc' => 'You can enable Joomla plugins inside your form, may cause unexpected results sometimes.')); ?>
		<?php echo $HtmlHelper->input('params[show_top_errors]', array('type' => 'select', 'label' => 'Show Top Errors', 'value' => $params->get('show_top_errors', 1), 'options' => array(0 => 'No', 1 => 'Yes'), 'default' => 1, 'smalldesc' => 'Do you want any form errors to be listed above the form ?')); ?>
		
		<?php echo $HtmlHelper->input('params[datepicker_config]', array('type' => 'text', 'label' => 'DateTime Picker config', 'class' => 'big_input', 'style' => 'width:700px;', 'maxlength' => 500, 'value' => $params->get('datepicker_config', ''), 'smalldesc' => "Enter any extension config to the default datepicker classes loaded, this will affect all the default date fields in the form, custom ones will not be affected, e.g:<br />days: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'], startView: 'decades'")); ?>
		
	<?php echo $TabsHelper->tabEnd(); ?>
	<?php echo $TabsHelper->tabStart('code'); ?>
		<?php echo $HtmlHelper->input('form_type', array('type' => 'select', 'label' => 'Form type', 'options' => array(0 => 'Custom', 1 => 'Wizard'), 'default' => 0, 'smalldesc' => 'Custom forms HTML code will not be affected when using it in the wizard, Wizard forms code will be overwritten though.')); ?>
		<?php echo $HtmlHelper->input('content', array('type' => 'textarea', 'label' => 'HTML code', 'rows' => 30, 'cols' => 100, 'smalldesc' => 'May contain PHP code with tags', 'value' => ($form ? htmlspecialchars($form->content) : ''))); ?>
	<?php echo $TabsHelper->tabEnd(); ?>
	<?php echo $TabsHelper->tabStart('jsval'); ?>
		<?php echo $HtmlHelper->input('params[enable_jsvalidation]', array('type' => 'select', 'label' => 'Enable JS Validation', 'value' => $params->get('enable_jsvalidation', 0), 'options' => array(0 => 'No', 1 => 'Yes'), 'default' => 0)); ?>
		<?php echo $HtmlHelper->input('params[jsvalidation_errors]', array('type' => 'select', 'label' => 'Validation Errors', 'value' => $params->get('jsvalidation_errors', 1), 'options' => array(0 => 'Default', 1 => 'Fields Titles'), 'default' => 1, 'smalldesc' => 'Should the library use the field title as the error message if exists ? the Default option will ignore the fields titles and use the error messages in the language files.')); ?>
		<?php echo $HtmlHelper->input('params[jsvalidation_theme]', array('type' => 'select', 'label' => 'JS Validation Theme', 'value' => $params->get('jsvalidation_theme', 'classic'), 'options' => array('classic' => 'Classic', 'blue' => 'Blue', 'green' => 'Green', 'red' => 'Red', 'grey' => 'Grey', 'white' => 'White'), 'default' => 'classic')); ?>
		<?php echo $HtmlHelper->input('params[jsvalidation_lang]', array('type' => 'select', 'label' => 'JS Validation Language', 'value' => $params->get('jsvalidation_lang', 'en'), 'options' => array('en' => 'English', 'fr' => 'French', 'de' => 'Deutsch', 'nl' => 'Dutch', 'es' => 'Spanish', 'da' => 'Danish', 'it' => 'Italian', 'jp' => 'Japanese', 'cn' => 'Chinese', 'ru' => 'Russain', 'pt' => 'Portugese', 'gr' => 'Greek', 'tr' => 'Turkish', 'pl' => 'Polish', 'ro' => 'Romanian', 'fa' => 'Farsi', 'lv' => 'Latvian'), 'default' => 'en')); ?>
		<?php echo $HtmlHelper->input('params[jsvalidation_showErrors]', array('type' => 'select', 'label' => 'Errors event', 'value' => $params->get('jsvalidation_showErrors', 0), 'options' => array(0 => 'onSubmit', 1 => 'onSubmit & onBlur'), 'default' => 0)); ?>
		<?php echo $HtmlHelper->input('params[jsvalidation_errorsLocation]', array('type' => 'select', 'label' => 'Errors location', 'value' => $params->get('jsvalidation_errorsLocation', 1), 'options' => array(1 => 'Tips (default)', 3 => 'After element'), 'default' => 1, 'smalldesc' => 'Requires the fields titles errors setting enabled!')); ?>
		
	<?php echo $TabsHelper->tabEnd(); ?>
	<?php echo $TabsHelper->tabStart('admin_actions'); ?>
		<?php echo $HtmlHelper->input('params[adminview_actions]', array('type' => 'text', 'label' => 'Admin View Functions', 'class' => 'big_input', 'value' => $params->get('adminview_actions', ''), 'smalldesc' => 'list of form events to be listed in the index page for this form, please use this format:<br />form_event:Function Title')); ?>
		<?php echo $HtmlHelper->input('params[dataview_actions]', array('type' => 'text', 'label' => 'Data View Functions', 'class' => 'big_input', 'value' => $params->get('dataview_actions', ''), 'smalldesc' => 'list of form events to be listed in the data view page for this form, please use this format:<br />form_event:Function Title')); ?>
		<?php echo $HtmlHelper->input('app', array('type' => 'text', 'id' => 'app', 'label' => 'Form App', 'class' => 'medium_input', 'smalldesc' => 'The app name under which this form will be listed, leave empty to list under "Default" app.')); ?>
		
	<?php echo $TabsHelper->tabEnd(); ?>
	<?php echo $TabsHelper->tabStart('data_view'); ?>
		<?php
			$tables = array();
			if(!empty($form->form_actions)){
				foreach($form->form_actions as $action){
					if($action->type == 'db_save' || $action->type == 'db_record_loader' || $action->type == 'db_multi_record_loader'){
						$action_params = new JParameter($action->params);
						$table_name = $action_params->get('table_name', '');
						if(!empty($table_name)){
							$tables[] = $table_name;
						}
					}
				}
			}
			$tables = array_unique($tables);
			$tables_data = $database->getTableFields($tables, false);
			foreach($tables as $table){				
				$table_fields = array_keys($tables_data[$table]);
				foreach($table_fields as $k => $v){
					unset($table_fields[$k]);
					$table_fields[$v] = $v;
				}
				echo $HtmlHelper->input('params[dataview_fields_'.$table.']', array('type' => 'select', 'multiple' => true, 'size' => 8, 'label' => 'Data View ('.$table.')', 'value' => explode(",", $params->get('dataview_fields_'.$table, '')), 'options' => $table_fields, 'smalldesc' => 'Select the table fields to appear in the data view for this table.'));
			}
			if(empty($tables)){
				echo "There are no DB tables connected to this form to configure.";
			}
		?>
		
	<?php echo $TabsHelper->tabEnd(); ?>
<?php echo $HtmlHelper->input('id', array('type' => 'hidden')); ?>
<input type="hidden" name="task" value="" />
<input type="hidden" name="option" value="com_chronoforms" />
</form>