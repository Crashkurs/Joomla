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
	require_once(JPATH_SITE.DS."administrator".DS."components".DS."com_chronoforms".DS."helpers".DS."tabs_helper.php");
	$PluginTabsHelper = new TabsHelper(); // for all actions ane elements usage
	//check the easy mode
	if($form){
		$form_params = new JParameter($form->params);
	}
	if(isset($_GET['wizard_mode']) && $_GET['wizard_mode'] == 'easy'){
		$wizard_mode = 'easy';
	}else if(isset($_GET['wizard_mode']) && $_GET['wizard_mode'] == 'advanced'){
		$wizard_mode = 'advanced';
	}else if($form && $form_params->get('form_mode', 'advanced') == 'easy'){
		$wizard_mode = 'easy';
	}else{
		$wizard_mode = 'advanced';
	}
	$jversion = new JVersion();
?>
<script language="javascript" type="text/javascript">
	<?php if($wizard_mode == 'easy'){ ?>
	var EASY_MODE = true;
	var containers = ['emails', 'thanks', 'uploads', 'code', 'captcha', 'db'];
	<?php }else{ ?>
	var EASY_MODE = false;
	<?php } ?>
</script>
<script type="text/javascript" src="<?php echo JURI::Base(); ?>components/com_chronoforms/js/drag.ghost.js"></script>
<script type="text/javascript" src="<?php echo JURI::Base(); ?>components/com_chronoforms/js/SqueezeBox.js"></script>
<script type="text/javascript" src="<?php echo JURI::Base(); ?>components/com_chronoforms/js/formwizard.js"></script>
<script type="text/javascript" src="<?php echo JURI::Base(); ?>components/com_chronoforms/js/tabs.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo JURI::Base(); ?>components/com_chronoforms/css/frontforms_tight.css">
<link rel="stylesheet" type="text/css" href="<?php echo JURI::Base(); ?>components/com_chronoforms/css/ccms.css">
<link rel="stylesheet" type="text/css" href="<?php echo JURI::Base(); ?>components/com_chronoforms/css/formwizard.css">
<link rel="stylesheet" type="text/css" href="<?php echo JURI::Base(); ?>components/com_chronoforms/css/tabs_style.css">
<link rel="stylesheet" type="text/css" href="<?php echo JURI::Base(); ?>components/com_chronoforms/css/SqueezeBox/SqueezeBox.css">
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
			alert("Please enter a valid form name under the 'Form Settings' tab, with alphanumeric characters, underscore_ or dashes -.");
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
			alert("Please enter a valid form name under the 'Form Settings' tab, with alphanumeric characters, underscore_ or dashes -.");
			return false;
		}else{
			submitform(pressbutton);
		}
	}
	<?php endif; ?>
</script>
<?php JHTML::_('behavior.tooltip'); ?>
<style type="text/css">
.hasTip{float:right;}
.tool-tip{z-index:99999;}
</style>
<h2 style='margin: 3px 0;'>
<?php
if(!empty($form)){
	echo $form->name;
	if($wizard_mode != 'easy'){
		?>
		<a href="index.php?option=com_chronoforms&amp;task=form_wizard&amp;form_id=<?php echo $form->id; ?>&amp;wizard_mode=easy">(Edit in Easy Mode)</a>
		<br />
		<div class="small-message" style="margin: 4px 0 0 0 !important; color: #ff0000;">Warning, switching to easy mode from advanced mode will simply reset all your current form's events set.</div>
		<?php
	}else{
		?>
		<a href="index.php?option=com_chronoforms&amp;task=form_wizard&amp;form_id=<?php echo $form->id; ?>&amp;wizard_mode=advanced">(Edit in Advanced Mode)</a>
		<?php
	}
}else{
	echo 'New Form...';
}
?>
</h2>
<div class="ccms_box" id="drag_box" style="float:left; width:40%;">
  <div class="ccms_box_header">
    <h3 class="left">Drag</h3>
    <?php
		$DragTabsHelper = new TabsHelper();
		if($wizard_mode == 'easy'){
			echo $DragTabsHelper->Header(array('elements' => 'Elements'));
		}else{
			echo $DragTabsHelper->Header(array('elements' => 'Elements', 'actions' => 'Actions'));
		}
	?>
  </div>
<?php echo $DragTabsHelper->tabStart('elements'); ?>
      <div id="elements_accordion"> <a href="#" onClick="return false;" class="toggler element_toggler">Basic Elements</a>
        <div id="elements_accordion_pane" class="elements_list elements_accordion_pane">
          <div class="half first_half">
            <?php $counter = 0; ?>
			<?php
				$directory = JPATH_SITE.DS."administrator".DS."components".DS."com_chronoforms".DS.'form_elements'.DS;
				$form_elements = array();
				$adv_elements = array();
				$handler = opendir($directory);
				while($file = readdir($handler)){
					if($file != '.' && $file != '..' && substr($file, -4) == '.php'){
						$form_elements[] = str_replace(".php", "", $file);
					}
				}
				asort($form_elements);
			?>
			<?php
				//count advanced and basic elements
				foreach($form_elements as $k => $form_element){
					require_once(JPATH_SITE.DS."administrator".DS."components".DS."com_chronoforms".DS.'form_elements'.DS.$form_element.'.php');
					$elementclassname = preg_replace('/(?:^|_)(.?)/e', "strtoupper('$1')", 'chrono_forms_'.$form_element);
					if(class_exists($elementclassname)){
						$elementclass = new $elementclassname;
						if(isset($elementclass->advanced) && $elementclass->advanced === true){
							$adv_elements[] = $form_element;
						}
					}
				}
			?>
			<?php foreach($form_elements as $k => $form_element): ?>
			    <?php
					require_once(JPATH_SITE.DS."administrator".DS."components".DS."com_chronoforms".DS.'form_elements'.DS.$form_element.'.php');
					$elementclassname = preg_replace('/(?:^|_)(.?)/e', "strtoupper('$1')", 'chrono_forms_'.$form_element);
					if(class_exists($elementclassname)){
						$elementclass = new $elementclassname;
						$element_params = $elementclass->load(true);
					}else{
						$element_params = array();
					}
					
					if(!empty($element_params)){
						$element_params = $element_params['element_params'];
					}
					if(isset($elementclass->advanced) && $elementclass->advanced === true){
						//$adv_elements[] = $form_element;
						continue;
					}else{
						$counter++;
						//unset($form_elements[$k]);
					}
				?>    
			    <?php require_once(JPATH_SITE.DS."administrator".DS."components".DS."com_chronoforms".DS.'form_elements'.DS.$form_element.'.ctp'); ?>
			    <?php if($counter >= (count($form_elements) - count($adv_elements))/2): $counter = -(count($form_elements) - count($adv_elements)); ?>
			    	</div><div class="half">
			    <?php endif; ?>
		    <?php endforeach; ?>
          </div>
        </div>
        <a href="#" onClick="return false;" class="toggler element_toggler">Advanced Elements</a>
        <div class="elements_list elements_accordion_pane" id="advanced_elements">
			<div class="half first_half">
			<?php $counter = 0; ?>
			<?php foreach($adv_elements as $k => $form_element): ?>
			    <?php
					require_once(JPATH_SITE.DS."administrator".DS."components".DS."com_chronoforms".DS.'form_elements'.DS.$form_element.'.php');
					$elementclassname = preg_replace('/(?:^|_)(.?)/e', "strtoupper('$1')", 'chrono_forms_'.$form_element);
					if(class_exists($elementclassname)){
						$elementclass = new $elementclassname;
						$element_params = $elementclass->load(true);
					}else{
						$element_params = array();
					}
					$counter++;
					if(!empty($element_params)){
						$element_params = $element_params['element_params'];
					}
				?>    
			    <?php require_once(JPATH_SITE.DS."administrator".DS."components".DS."com_chronoforms".DS.'form_elements'.DS.$form_element.'.ctp'); ?>
			    <?php if($counter >= count($adv_elements)/2): $counter = -count($adv_elements); ?>
			    	</div><div class="half">
			    <?php endif; ?>
		    <?php endforeach; ?>
			</div>
		</div>
		<div class="settings elements_accordion_pane" id="field_settings_hidden" style="display:none;"></div>
      </div>
<?php echo $DragTabsHelper->tabEnd(); ?>
<?php echo $DragTabsHelper->tabStart('actions'); ?>
      <div id="actions_accordion">
		<a href="#" onClick="return false;" class="toggler action_toggler">Core Actions</a>
        <div id="actions_accordion_pane" class="elements_list actions_accordion_pane">
          <div class="half first_half">
            <?php $counter = 0; ?>
			<?php
				$directory = JPATH_SITE.DS."administrator".DS."components".DS."com_chronoforms".DS.'form_actions'.DS;
				$form_actions = array();
				$handler = opendir($directory);
				while($file = readdir($handler)){
					if($file != '.' && $file != '..' && strpos($file, '.') === false){
						$form_actions[] = $file;
					}
				}
				$actions_groups = array();
				$actions_titles = array();
				$actions_drag_outputs = array();
				$set = false;
				asort($form_actions);
			?>
		    <?php foreach($form_actions as $form_action): ?>
			    <?php
					$action_file1 = JPATH_SITE.DS."administrator".DS."components".DS."com_chronoforms".DS.'form_actions'.DS.$form_action.DS.$form_action.'.php';
					$action_file2 = JPATH_SITE.DS."administrator".DS."components".DS."com_chronoforms".DS.'form_actions'.DS.$form_action.DS.$form_action.'.ctp';
					if(!file_exists($action_file1) || !file_exists($action_file2)){
						continue;
					}
					require_once($action_file1);
					$actionclassname = preg_replace('/(?:^|_)(.?)/e', "strtoupper('$1')", 'cfaction_'.$form_action);
					if(class_exists($actionclassname)){
						$actionclass = new $actionclassname;
						$action_params = $actionclass->load(true);
						if(isset($actionclass->group) && !empty($actionclass->group)){
							$actions_groups[$actionclass->group['id']][$form_action] = $action_params;
							$actions_titles[$actionclass->group['id']] = $actionclass->group['title'];
							$counter++;
							continue;
						}
					}else{
						$action_params = array();
					}
					if(!empty($action_params)){
						$action_params = $action_params['action_params'];
					}
					$counter++;
				?>    
				<?php
				ob_start();
				require_once($action_file2);
				$actions_drag_outputs[] = ob_get_clean();				
				?>
			    
		    <?php endforeach; ?>
			<?php foreach($actions_drag_outputs as $k => $actions_drag_output): ?>
				<?php echo $actions_drag_output; ?>
				<?php if(!$set && $k + 1 >= count($actions_drag_outputs)/2): $set = true; ?>
					</div><div class="half">
				<?php endif; ?>
			<?php endforeach; ?>
			</div>
			
        </div>
		<?php ksort($actions_groups); ?>
		<?php foreach($actions_groups as $action_id => $form_actions): ?>
			<?php $counter = 0; ?>
			<a href="#" onClick="return false;" class="toggler action_toggler"><?php echo $actions_titles[$action_id]; ?></a>
			<div class="elements_list actions_accordion_pane">
			<!--<fieldset style="width:97%; padding: 5px;">
			<legend><?php echo $actions_titles[$action_id]; ?></legend>-->
			<div class="half first_half">
			<?php foreach($form_actions as $form_action => $action_params): ?>
				<?php
					$counter++;
					if(!empty($action_params)){
						$action_params = $action_params['action_params'];
					}
				?>
				<?php require_once(JPATH_SITE.DS."administrator".DS."components".DS."com_chronoforms".DS.'form_actions'.DS.$form_action.DS.$form_action.'.ctp'); ?>
				<?php if($counter >= count($form_actions)/2): $counter = -count($form_actions); ?>
					</div><div class="half">
				<?php endif; ?>
			<?php endforeach; ?>
			</div>
			</div>
			<!--</fieldset>-->
		<?php endforeach; ?>
        <!--<a href="#" class="toggler action_toggler">Action Settings</a>
        <div class="settings actions_accordion_pane" id="action_settings"></div>-->
		<div class="settings actions_accordion_pane" style="display:none;" id="action_settings_hidden"></div>
      </div>
<?php echo $DragTabsHelper->tabEnd(); ?>
  </div>
<div class="ccms_box" style="float:right; width:56%;">
  <form action="index.php" method="post" name="adminForm" id="adminForm" id="adminForm">
    <div class="ccms_box_header">
      <h3 class="left">Drop</h3>
	<?php
		$DropTabsHelper = new TabsHelper();
		if($wizard_mode == 'easy'){
			echo $DropTabsHelper->Header(array('preview' => 'Preview', 'emails' => 'Emails', 'thanks' => 'Thanks Message', 'uploads' => 'Files Uploads', 'code' => 'Code', 'captcha' => 'Anti Spam', 'db' => 'Store Data', 'settings' => 'Form Settings'));
		}else{
			echo $DropTabsHelper->Header(array('preview' => 'Preview', 'events' => 'Events', 'settings' => 'Form Settings', 'legend' => 'Legend'));
		}
	?>
    </div>
    <?php echo $DropTabsHelper->tabStart('preview'); ?>
        <div class="droppable" id="droppable_area_elements">
			<?php $max_field_index = -1; ?>
			<?php if(empty($form)): ?>
				
			<?php else: ?>
				<?php if($form->form_type == 1): ?>
					<?php if(!empty($form->wizardcode)): ?>				
						<?php
							eval('?>'.'<?php $wizardcode = '.$form->wizardcode.'; ?>');
							//print_r2($wizardcode);
						?>
						<?php foreach($wizardcode as $formdata_key => $formdata_element): ?>
							<?php
							//load elements files
							$field_header = $formdata_element['tag'].'_'.$formdata_element['type'].'_'.str_replace('field_', '', $formdata_key);
							$form_element = $formdata_element['tag'].'_'.$formdata_element['type'];
							if(!file_exists(JPATH_SITE.DS."administrator".DS."components".DS."com_chronoforms".DS.'form_elements'.DS.$form_element.'.php')){
								continue;
							}
							require_once(JPATH_SITE.DS."administrator".DS."components".DS."com_chronoforms".DS.'form_elements'.DS.$form_element.'.php');
							$elementclassname = preg_replace('/(?:^|_)(.?)/e', "strtoupper('$1')", 'chrono_forms_'.$form_element);
							if(class_exists($elementclassname)){
								$elementclass = new $elementclassname;
								$element_params = $elementclass->load(true);
							}else{
								$element_params = array();
							}
							$counter++;
							if(!empty($element_params)){
								$element_params = $element_params['element_params'];
							}
							foreach($formdata_element as $k => $v){
								$element_params[str_replace($field_header.'_', '', $k)] = $v;
							}
							$filename = JPATH_SITE.DS."administrator".DS."components".DS."com_chronoforms".DS.'form_elements'.DS.$form_element.'.ctp';
							$handle = fopen($filename, 'rb');
							$element_data = fread($handle, filesize($filename));
							fclose($handle);
							
							$pattern_input = '/<div class="element_code"([^>]*?)>(.*?)<\/div>/is';
							preg_match_all($pattern_input, $element_data, $matches);
							//find the field index
							$field_index = str_replace('field_', '', $formdata_key);
							if($field_index > $max_field_index){
								$max_field_index = $field_index;
							}
							//prepare the element code
							$element_code = $matches[0][0];
							$element_code = str_replace('element_code', $formdata_element['tag'].'_'.$formdata_element['type'].'_element_view wizard_element', $element_code);
							$element_code = preg_replace('/(\'|")'.$formdata_element['tag'].'_'.$formdata_element['type'].'_element(\'|")/', '"'.$formdata_element['tag'].'_'.$formdata_element['type'].'_element_'.$field_index.'"', $element_code);
							$element_code = str_replace('{n}', $field_index, $element_code);
							//prepare element params before the eval
							/*$element_params = array();
							foreach($field_data as $field_data_key => $field_data_value){
								$clean_key = str_replace($field_data['tag'].'_'.$field_data['type'].'_'.$field_index.'_', '', $field_data_key);
								$element_params[$clean_key] = (is_array($field_data_value) ? implode('', $field_data_value) : $field_data_value);
							}*/
							//render element
							ob_start();
							eval('?>'.$element_code);
							$output = ob_get_clean();
							echo $output;
							//echo $element_data;
							?>
						<?php endforeach; ?>
					<?php endif; ?>
				<?php else: ?>
					<p style="font-size: 15px; color: red; padding: 10px;">
						Your form type is "Custom" and so you can NOT add/edit the form fields (code) in the wizard, any fields you add here now <strong>will NOT be saved</strong>.
					</p>
				<?php endif; ?>
			<?php endif; ?>
		</div>
	<?php echo $DropTabsHelper->tabEnd(); ?>
	<?php echo $DropTabsHelper->tabStart('events'); ?>
        <div class="droppable" id="droppable_area_actions">
		<?php
    	$max_action_index = -1;
    	if(isset($form->events_actions_map) && !empty($form->events_actions_map)){
    		$eventscode = unserialize(base64_decode($form->events_actions_map));
    		$actionsarray = array();
    		if(isset($formactions) && !empty($formactions)){
    			foreach($formactions as $action_index => $action_data){
    				$actionsarray['cfaction_'.$action_data->type.'_'.$action_data->order] = $action_data;
    				if($action_data->order > $max_action_index){
    					$max_action_index = $action_data->order + 1;
    				}
    			}
    		}
    	}
    	?>
          <div id="FormOnLoadEvent" class="form_event main_event good_event">
            <label class="form_event_label">On Load</label>
            <input type="hidden" name="_form_actions_events_map[myform][events][load]" value="">
			<?php
			if(isset($form->events_actions_map) && !empty($eventscode['events']['load'])){
				echo _processActions($eventscode['events']['load']['actions'], $actionsarray);
			}
			?> 
          </div>
          <div id="FormOnSubmitEvent" class="form_event main_event good_event">
            <label class="form_event_label">On Submit</label>
            <input type="hidden" name="_form_actions_events_map[myform][events][submit]" value="">
			<?php
			if(isset($form->events_actions_map) && !empty($eventscode['events']['submit'])){
				echo _processActions($eventscode['events']['submit']['actions'], $actionsarray);
			}
			?>
          </div>
		  <?php
			if(isset($eventscode['events'])){
				unset($eventscode['events']['load']);
				unset($eventscode['events']['submit']);
			}
			if(!empty($eventscode['events'])):
				foreach($eventscode['events'] as $new_event => $new_event_val):
			  ?>
			  <div id="FormOn<?php echo $new_event; ?>Event" class="form_event main_event good_event">
				<label class="form_event_label">On <?php echo $new_event; ?></label>
				<input type="hidden" name="_form_actions_events_map[myform][events][<?php echo $new_event; ?>]" value="">
				<?php
				if(isset($form->events_actions_map) && !empty($eventscode['events'][$new_event])){
					echo _processActions($eventscode['events'][$new_event]['actions'], $actionsarray);
				}
				?>
			  </div>
			  <?php
				endforeach;
			endif;
		  ?>
		  <div id="EventsOperations" onClick="ShowAddEventDialogue()">
			<img src="<?php echo JURI::Base(); ?>components/com_chronoforms/images/add.png" alt="Add Event" width="22" height="22" class="add_event" id="add_event_icon">
			<label style="float:left; font-weight:bold;">Add Event</label>
		  </div>
        </div>
	<?php echo $DropTabsHelper->tabEnd(); ?>
	<?php echo $DropTabsHelper->tabStart('settings'); ?>
		<?php
			if(!empty($form)){
				$params = new JParameter($form->params);
			}else{
				$params = new JParameter('');
			}
		?>
		<?php echo $HtmlHelper->input('chronoform_name', array('type' => 'text', 'id' => 'chronoform_name', 'class' => 'medium_input', 'label' => 'Form name', 'smalldesc' => 'Unique form name without spaces or any special characters, underscores _ or dashes -', 'value' => (!empty($form)) ? $form->name : '')); ?>
		<?php echo $HtmlHelper->input('chronoform_published', array('type' => 'select', 'label' => 'Published', 'options' => array(0 => 'No', 1 => 'Yes'), 'default' => 1, 'value' => (!empty($form)) ? $form->published : 0)); ?>
		<?php echo $HtmlHelper->input('form_type', array('type' => 'hidden', 'value' => (!empty($form)) ? $form->form_type : 1)); ?>
		<?php echo $HtmlHelper->input('params[tight_layout]', array('type' => 'select', 'label' => 'Tight Layout', 'value' => $params->get('tight_layout', 0), 'options' => array(0 => 'Normal', 1 => 'Tight'), 'default' => 0, 'smalldesc' => 'Should the form load the regular CSS or load a tight CSS (less spaced out, smaller fields and less padding..etc) ?')); ?>
		
		<!--<textarea style="display:none;" name="params"><?php echo (!empty($form)) ? $form->params : ''; ?></textarea>-->
	<?php echo $DropTabsHelper->tabEnd(); ?>
	<?php echo $DropTabsHelper->tabStart('legend'); ?>
		<?php
			require_once(JPATH_SITE.DS."administrator".DS."components".DS."com_chronoforms".DS.'views'.DS.'legend.php');
		?>
	<?php echo $DropTabsHelper->tabEnd(); ?>
	<!-- FOR EASY MODE -->
	<?php if($wizard_mode == 'easy'): ?>
	<?php echo $DropTabsHelper->tabStart('emails'); ?>
		 <div class="easy_div droppable" id="easy_div_emails">
		 <?php $formactions = _loadActionsList(array('email', 'email', 'email'), $formactions, 0, array(10, 11, 12), array(array('action_label' => '#1'), array('action_label' => '#2'), array('action_label' => '#3'))); ?>
		 </div>
	<?php echo $DropTabsHelper->tabEnd(); ?>
	<?php echo $DropTabsHelper->tabStart('thanks'); ?>
		 <div class="easy_div droppable" id="easy_div_thanks">
		 <?php $formactions = _loadActionsList('show_thanks_message', $formactions, 3, array(14)); ?>
		 </div>
	<?php echo $DropTabsHelper->tabEnd(); ?>
	<?php echo $DropTabsHelper->tabStart('uploads'); ?>
		 <div class="easy_div droppable" id="easy_div_uploads">
		 <?php $formactions = _loadActionsList('upload_files', $formactions, 4, array(6), array(array('enabled' => 0))); ?>
		 </div>
	<?php echo $DropTabsHelper->tabEnd(); ?>
	<?php echo $DropTabsHelper->tabStart('code'); ?>
		 <div class="easy_div droppable" id="easy_div_code">
		 <?php $formactions = _loadActionsList(array('load_js', 'load_css', 'custom_code', 'custom_code'), $formactions, 5, array(0, 1, 8, 13), array(array(), array(), array('action_label' => 'Before Email(s)'), array('action_label' => 'After Email(s)'))); ?>
		 </div>
	<?php echo $DropTabsHelper->tabEnd(); ?>
	<?php echo $DropTabsHelper->tabStart('captcha'); ?>
		 <div class="easy_div droppable" id="easy_div_captcha">
		 <?php $formactions = _loadActionsList(array('load_captcha', 'check_captcha'), $formactions, 9, array(2, 4), array(array(), array('enabled' => 0))); ?>
		 </div>
	<?php echo $DropTabsHelper->tabEnd(); ?>
	<?php echo $DropTabsHelper->tabStart('db'); ?>
		 <div class="easy_div droppable" id="easy_div_db">
		 <?php $formactions = _loadActionsList(array('db_save'), $formactions, 11, array(9), array(array('enabled' => 0))); ?>
		 </div>
	<?php echo $DropTabsHelper->tabEnd(); ?>
	<?php endif; ?>
	<input type="hidden" name="wizard_mode" value="<?php echo $wizard_mode; ?>" />
	<!-- END EASY MODE -->
	<div id="hidden_div_add_event" style="display: none;">
		<div class="" id="add_event_box" style="display: none; ">
			<?php echo $HtmlHelper->input('event_name', array('type' => 'text', 'id' => 'event_name', 'label' => 'Event name', 'smalldesc' => 'Enter the event name, should be unique, use alphabetic characters or digits ONLY.')); ?>
			<input type="button" name="add_event_button" id="add_event_button" value="Add" />
		
		</div>
	</div>
    <input type="hidden" name="data[Chronoform][id]" id="ChronoformId" value="<?php if(!empty($form)) echo $form->id; ?>">
    <input type="hidden" name="data[Chronoform][name]" id="ChronoformName" value="<?php if(!empty($form)) echo $form->name; ?>">
    
    <input type="hidden" name="max_field_index" id="max_field_index" value="<?php echo $max_field_index + 1; ?>" />
    <input type="hidden" name="max_action_index" id="max_action_index" value="<?php echo $max_action_index + 1; ?>" />
	<input type="hidden" name="task" id="task" value="">
	<input type="hidden" name="option" id="option" value="com_chronoforms">
  </form>
</div>
<div class="element_tools" id="element_tools_{n}">
<img src="<?php echo JURI::Base(); ?>components/com_chronoforms/css/formwizard/delete.gif" alt="remove" width="15" height="15" class="delete_element" id="element_tools_{n}_delete">
<img src="<?php echo JURI::Base(); ?>components/com_chronoforms/css/formwizard/edit.png" alt="edit" width="15" height="15" class="edit_element" id="element_tools_{n}_edit">
<img src="<?php echo JURI::Base(); ?>components/com_chronoforms/css/formwizard/sort.png" alt="sort" width="15" height="15" class="sort_element" id="element_tools_{n}_sort">
</div>
<div id="loadingimg_div" class="loadingimg_div" style="display: none; width:100%; text-align: center; margin-top: 15px;">
<img src="<?php echo JURI::Base(); ?>components/com_chronoforms/css/formwizard/loading.gif" alt="Now loading..." width="126" height="22" class="loading_element" border="0">
</div>
<?php
function _processActions($actions, $actionsarray){
	$output = '';
	$actionEvents = array();
	foreach($actions as $loadAction => $loadActionData){
		$actionOutput = '';
		if(!empty($loadActionData) && is_array($loadActionData)){
			if(isset($loadActionData['events']) && !empty($loadActionData['events'])){
				foreach($loadActionData['events'] as $eventk => $eventv){
					if(!empty($eventv) && is_array($eventv) && isset($eventv['actions']) && !empty($eventv['actions'])){
						$eventOutput = _processActions($eventv['actions'], $actionsarray);
						$actionEvents[$eventk] = $eventOutput;						
					}else{
						continue;
					}
				}
			}
			$actionOutput = loadActionFile($actionsarray[$loadAction], $actionsarray[$loadAction]->order);
			foreach($actionEvents as $eventName => $eventOutput){
				$pattern_input = '/<div id="'.$eventName.'"([^>]*?)>(.*?)<\/div>/is';
	    		preg_match_all($pattern_input, $actionOutput, $matches);
				if(isset($matches[0][0])){
					$rawEventOutput = $matches[0][0];
					$newEventOutput = str_replace('</div>', $eventOutput.'</div>', $rawEventOutput);
					$actionOutput = str_replace($rawEventOutput, $newEventOutput, $actionOutput);
				}else{
					
				}
			}
	    	$output .= $actionOutput;
		}else{
    		$output .= loadActionFile($actionsarray[$loadAction], $actionsarray[$loadAction]->order);
		}
    }
    return $output;
}
function loadActionFile($action_data, $action_index){
	//load basic params
	$action_params = array();
	$action_file1 = JPATH_SITE.DS."administrator".DS."components".DS."com_chronoforms".DS.'form_actions'.DS.$action_data->type.DS.$action_data->type.'.php';
	if(file_exists($action_file1)){
		require_once($action_file1);
		$actionclassname = preg_replace('/(?:^|_)(.?)/e', "strtoupper('$1')", 'cfaction_'.$action_data->type);
		if(class_exists($actionclassname)){
			$actionclass = new $actionclassname;
			$action_params = $actionclass->load(true);
		}
	}
    //load elements files
	$filename = JPATH_SITE.DS."administrator".DS."components".DS."com_chronoforms".DS.'form_actions'.DS.$action_data->type.DS.$action_data->type.'.ctp';
	if(file_exists($filename)){
    	$handle = fopen($filename, 'rb');
		$element_data = fread($handle, filesize($filename));
		fclose($handle);
    	//$pattern_input = '/<div class="element_code"([^>]*?)>(.*?)<\/div>/is';
    	$pattern_input = '/<!--start_element_code-->(.*?)<!--end_element_code-->/is';
    	preg_match_all($pattern_input, $element_data, $matches);
    	
    	//prepare the lement code
    	$element_code = $matches[0][0];
    	$element_code = str_replace(array('<!--start_element_code-->', '<!--end_element_code-->'), '', $element_code);
    	$element_code = str_replace('element_code', 'cfaction_'.$action_data->type.'_element_view wizard_element', $element_code);
    	$element_code = preg_replace('/(\'|")'.'cfaction_'.$action_data->type.'_element(\'|")/', '"'.'cfaction_'.$action_data->type.'_element_'.$action_index.'"', $element_code);
		$element_code = str_replace('{n}', $action_index, $element_code);
		//prepare element params before the eval
		if(!is_array($action_data->params)){
			$aparams = new JParameter($action_data->params);
			$params = $aparams->toArray();
			$action_data->params = array();
			foreach($params as $kp => $param){
				$action_data->params[$kp] = $param;
			}
		}
    	$action_params = array_merge($action_params['action_params'], get_object_vars($action_data), $action_data->params);
    	//render element
    	ob_start();
		eval('?>'.$element_code);
		$output = ob_get_clean();
    	return $output;
	}
}

//functions for easy mode
function _loadActionsList($action_name, $formactions, $start = 0, $order = array(), $settings = array()){
	if(!is_array($action_name)){
		$action_name = array($action_name);
	}
	foreach($action_name as $k => $action){
		$i = $order[$k];//$k + $start;
		if(isset($formactions[$i]) && $formactions[$i]->type == $action){
			echo loadActionFile($formactions[$i], $formactions[$i]->order);
		}else{
			$object = new stdClass();
			$object->type = $action;
			$object->params = '';
			if(isset($settings[$k]) && !empty($settings[$k])){
				foreach($settings[$k] as $ks => $setting){
					$object->$ks = $setting;
				}
			}
			echo loadActionFile($object, $order[$k]);
		}
		unset($formactions[$i]);
	}
	return $formactions;// = array_values($formactions);
}
?>