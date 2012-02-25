<div class="dragable" id="cfaction_image_resize">Image Resize</div>
<!--start_element_code-->
<div class="element_code" id="cfaction_image_resize_element">
	<label class="action_label">Image Resize</label>
	<input type="hidden" name="chronoaction[{n}][action_image_resize_{n}_photo]" id="action_image_resize_{n}_photo" value="<?php echo $action_params['photo']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_image_resize_{n}_delete_original]" id="action_image_resize_{n}_delete_original" value="<?php echo $action_params['delete_original']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_image_resize_{n}_quality]" id="action_image_resize_{n}_quality" value="<?php echo $action_params['quality']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_image_resize_{n}_big_directory]" id="action_image_resize_{n}_big_directory" value="<?php echo $action_params['big_directory']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_image_resize_{n}_big_image_prefix]" id="action_image_resize_{n}_big_image_prefix" value="<?php echo $action_params['big_image_prefix']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_image_resize_{n}_big_image_suffix]" id="action_image_resize_{n}_big_image_suffix" value="<?php echo $action_params['big_image_suffix']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_image_resize_{n}_big_image_height]" id="action_image_resize_{n}_big_image_height" value="<?php echo $action_params['big_image_height']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_image_resize_{n}_big_image_width]" id="action_image_resize_{n}_big_image_width" value="<?php echo $action_params['big_image_width']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_image_resize_{n}_big_image_r]" id="action_image_resize_{n}_big_image_r" value="<?php echo $action_params['big_image_r']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_image_resize_{n}_big_image_g]" id="action_image_resize_{n}_big_image_g" value="<?php echo $action_params['big_image_g']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_image_resize_{n}_big_image_b]" id="action_image_resize_{n}_big_image_b" value="<?php echo $action_params['big_image_b']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_image_resize_{n}_big_image_method]" id="action_image_resize_{n}_big_image_method" value="<?php echo $action_params['big_image_method']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_image_resize_{n}_med_directory]" id="action_image_resize_{n}_med_directory" value="<?php echo $action_params['med_directory']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_image_resize_{n}_med_image_use]" id="action_image_resize_{n}_med_image_use" value="<?php echo $action_params['med_image_use']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_image_resize_{n}_med_image_prefix]" id="action_image_resize_{n}_med_image_prefix" value="<?php echo $action_params['med_image_prefix']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_image_resize_{n}_med_image_suffix]" id="action_image_resize_{n}_med_image_suffix" value="<?php echo $action_params['med_image_suffix']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_image_resize_{n}_med_image_height]" id="action_image_resize_{n}_med_image_height" value="<?php echo $action_params['med_image_height']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_image_resize_{n}_med_image_width]" id="action_image_resize_{n}_med_image_width" value="<?php echo $action_params['med_image_width']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_image_resize_{n}_med_image_r]" id="action_image_resize_{n}_med_image_r" value="<?php echo $action_params['med_image_r']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_image_resize_{n}_med_image_g]" id="action_image_resize_{n}_med_image_g" value="<?php echo $action_params['med_image_g']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_image_resize_{n}_med_image_b]" id="action_image_resize_{n}_med_image_b" value="<?php echo $action_params['med_image_b']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_image_resize_{n}_med_image_method]" id="action_image_resize_{n}_med_image_method" value="<?php echo $action_params['med_image_method']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_image_resize_{n}_small_image_use]" id="action_image_resize_{n}_small_image_use" value="<?php echo $action_params['small_image_use']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_image_resize_{n}_small_directory]" id="action_image_resize_{n}_small_directory" value="<?php echo $action_params['small_directory']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_image_resize_{n}_small_image_prefix]" id="action_image_resize_{n}_small_image_prefix" value="<?php echo $action_params['small_image_prefix']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_image_resize_{n}_small_image_suffix]" id="action_image_resize_{n}_small_image_suffix" value="<?php echo $action_params['small_image_suffix']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_image_resize_{n}_small_image_height]" id="action_image_resize_{n}_small_image_height" value="<?php echo $action_params['small_image_height']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_image_resize_{n}_small_image_width]" id="action_image_resize_{n}_small_image_width" value="<?php echo $action_params['small_image_width']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_image_resize_{n}_small_image_r]" id="action_image_resize_{n}_small_image_r" value="<?php echo $action_params['small_image_r']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_image_resize_{n}_small_image_g]" id="action_image_resize_{n}_small_image_g" value="<?php echo $action_params['small_image_g']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_image_resize_{n}_small_image_b]" id="action_image_resize_{n}_small_image_b" value="<?php echo $action_params['small_image_b']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_image_resize_{n}_small_image_method]" id="action_image_resize_{n}_small_image_method" value="<?php echo $action_params['small_image_method']; ?>" />
	<input type="hidden" id="chronoaction_id_{n}" name="chronoaction_id[{n}]" value="{n}" />
	<input type="hidden" name="chronoaction[{n}][type]" value="image_resize" />
</div>
<!--end_element_code-->
<div class="element_config" id="cfaction_image_resize_element_config">
	<?php echo $PluginTabsHelper->Header(array('settings' => 'General', 'medium_image' => 'Medium Image', 'small_image' => 'Small Image'), 'image_resize_config_{n}'); ?>
	<?php echo $PluginTabsHelper->tabStart('settings'); ?>
	<?php echo $HtmlHelper->input('action_image_resize_{n}_delete_original_config', array('type' => 'select', 'label' => 'Delete Original', 'options' => array(0 => 'No', 1 => 'Yes'), 'smalldesc' => 'Delete the original image from the upload directory')); ?>
	<?php echo $HtmlHelper->input('action_image_resize_{n}_photo_config', array('type' => 'text', 'label' => 'Image field name', 'class' => 'medium_input', 'value' => '')); ?>
	<?php echo $HtmlHelper->input('action_image_resize_{n}_quality_config', array('type' => 'text', 'label' => 'Output image(s) quality', 'class' => 'medium_input', 'smalldesc' => 'set the quality of ouput jpg images')); ?>
	<?php echo $HtmlHelper->input('action_image_resize_{n}_big_directory_config', array('type' => 'text', 'label' => 'Big image directory', 'class' => 'medium_input', 'smalldesc' => 'Directory where the file will be stored. Don\'t forget the slash at the end ;-) e.g. images/stories/<br />
        	If you leave this empty it will default to the Form file uploads folder.')); ?>
	<?php echo $HtmlHelper->input('action_image_resize_{n}_big_image_prefix_config', array('type' => 'text', 'label' => 'Big image name prefix', 'class' => 'medium_input', 'smalldesc' => 'The prefix for the created image name e.g. big_')); ?>
	<?php echo $HtmlHelper->input('action_image_resize_{n}_big_image_suffix_config', array('type' => 'text', 'label' => 'Big image name suffix', 'class' => 'medium_input', 'smalldesc' => 'The suffix for the created image name e.g. _big')); ?>
	<?php echo $HtmlHelper->input('action_image_resize_{n}_big_image_height_config', array('type' => 'text', 'label' => 'Big image height', 'class' => 'medium_input', 'value' => '')); ?>
	<?php echo $HtmlHelper->input('action_image_resize_{n}_big_image_width_config', array('type' => 'text', 'label' => 'Big image width', 'class' => 'medium_input', 'value' => '')); ?>
	<?php echo $HtmlHelper->input('action_image_resize_{n}_big_image_r_config', array('type' => 'text', 'label' => 'Big image R color', 'class' => 'medium_input', 'smalldesc' => 'Alpha channel for png transparency. RGB color of the background.')); ?>
	<?php echo $HtmlHelper->input('action_image_resize_{n}_big_image_g_config', array('type' => 'text', 'label' => 'Big image G color', 'class' => 'medium_input', 'smalldesc' => 'Alpha channel for png transparency. RGB color of the background.')); ?>
	<?php echo $HtmlHelper->input('action_image_resize_{n}_big_image_b_config', array('type' => 'text', 'label' => 'Big image B color', 'class' => 'medium_input', 'smalldesc' => 'Alpha channel for png transparency. RGB color of the background.')); ?>
	<?php echo $HtmlHelper->input('action_image_resize_{n}_big_image_method_config', array('type' => 'select', 'label' => 'Big image processing method', 'options' => array(0 => 'Resize', 1 => 'Resize & Crop'), 'smalldesc' => 'The way your images will be generated (either scale or crop)')); ?>
	
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('medium_image'); ?>
	
	<?php echo $HtmlHelper->input('action_image_resize_{n}_med_image_use_config', array('type' => 'select', 'label' => 'Enable Medium image', 'options' => array(0 => 'No', 1 => 'Yes'), 'smalldesc' => 'Should we generate a medium sized image ?')); ?>
	<?php echo $HtmlHelper->input('action_image_resize_{n}_med_directory_config', array('type' => 'text', 'label' => 'Medium image directory', 'class' => 'medium_input', 'smalldesc' => 'Directory where the file will be stored. Don\'t forget the slash at the end ;-) e.g. images/stories/<br />
        	If you leave this empty it will default to the Form file uploads folder.')); ?>
	<?php echo $HtmlHelper->input('action_image_resize_{n}_med_image_prefix_config', array('type' => 'text', 'label' => 'Medium image name prefix', 'class' => 'medium_input', 'smalldesc' => 'The prefix for the created image name e.g. med_')); ?>
	<?php echo $HtmlHelper->input('action_image_resize_{n}_med_image_suffix_config', array('type' => 'text', 'label' => 'Medium image name suffix', 'class' => 'medium_input', 'smalldesc' => 'The suffix for the created image name e.g. _med')); ?>
	<?php echo $HtmlHelper->input('action_image_resize_{n}_med_image_height_config', array('type' => 'text', 'label' => 'Medium image height', 'class' => 'medium_input', 'value' => '')); ?>
	<?php echo $HtmlHelper->input('action_image_resize_{n}_med_image_width_config', array('type' => 'text', 'label' => 'Medium image width', 'class' => 'medium_input', 'value' => '')); ?>
	<?php echo $HtmlHelper->input('action_image_resize_{n}_med_image_r_config', array('type' => 'text', 'label' => 'Medium image R color', 'class' => 'medium_input', 'smalldesc' => 'Alpha channel for png transparency. RGB color of the background.')); ?>
	<?php echo $HtmlHelper->input('action_image_resize_{n}_med_image_g_config', array('type' => 'text', 'label' => 'Medium image G color', 'class' => 'medium_input', 'smalldesc' => 'Alpha channel for png transparency. RGB color of the background.')); ?>
	<?php echo $HtmlHelper->input('action_image_resize_{n}_med_image_b_config', array('type' => 'text', 'label' => 'Medium image B color', 'class' => 'medium_input', 'smalldesc' => 'Alpha channel for png transparency. RGB color of the background.')); ?>
	<?php echo $HtmlHelper->input('action_image_resize_{n}_med_image_method_config', array('type' => 'select', 'label' => 'Medium image processing method', 'options' => array(0 => 'Resize', 1 => 'Resize & Crop'), 'smalldesc' => 'The way your images will be generated (either scale or crop)')); ?>
	
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('small_image'); ?>
	
	<?php echo $HtmlHelper->input('action_image_resize_{n}_small_image_use_config', array('type' => 'select', 'label' => 'Enable Small image', 'options' => array(0 => 'No', 1 => 'Yes'), 'smalldesc' => 'Should we generate a small sized image ?')); ?>
	<?php echo $HtmlHelper->input('action_image_resize_{n}_small_directory_config', array('type' => 'text', 'label' => 'Small image directory', 'class' => 'medium_input', 'smalldesc' => 'Directory where the file will be stored. Don\'t forget the slash at the end ;-) e.g. images/stories/<br />
        	If you leave this empty it will default to the Form file uploads folder.')); ?>
	<?php echo $HtmlHelper->input('action_image_resize_{n}_small_image_prefix_config', array('type' => 'text', 'label' => 'Small image name prefix', 'class' => 'medium_input', 'smalldesc' => 'The prefix for the created image name e.g. small_')); ?>
	<?php echo $HtmlHelper->input('action_image_resize_{n}_small_image_suffix_config', array('type' => 'text', 'label' => 'Small image name suffix', 'class' => 'medium_input', 'smalldesc' => 'The suffix for the created image name e.g. _small')); ?>
	<?php echo $HtmlHelper->input('action_image_resize_{n}_small_image_height_config', array('type' => 'text', 'label' => 'Small image height', 'class' => 'medium_input', 'value' => '')); ?>
	<?php echo $HtmlHelper->input('action_image_resize_{n}_small_image_width_config', array('type' => 'text', 'label' => 'Small image width', 'class' => 'medium_input', 'value' => '')); ?>
	<?php echo $HtmlHelper->input('action_image_resize_{n}_small_image_r_config', array('type' => 'text', 'label' => 'Small image R color', 'class' => 'medium_input', 'smalldesc' => 'Alpha channel for png transparency. RGB color of the background.')); ?>
	<?php echo $HtmlHelper->input('action_image_resize_{n}_small_image_g_config', array('type' => 'text', 'label' => 'Small image G color', 'class' => 'medium_input', 'smalldesc' => 'Alpha channel for png transparency. RGB color of the background.')); ?>
	<?php echo $HtmlHelper->input('action_image_resize_{n}_small_image_b_config', array('type' => 'text', 'label' => 'Small image B color', 'class' => 'medium_input', 'smalldesc' => 'Alpha channel for png transparency. RGB color of the background.')); ?>
	<?php echo $HtmlHelper->input('action_image_resize_{n}_small_image_method_config', array('type' => 'select', 'label' => 'Small image processing method', 'options' => array(0 => 'Resize', 1 => 'Resize & Crop'), 'smalldesc' => 'The way your images will be generated (either scale or crop)')); ?>
	
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	
</div>