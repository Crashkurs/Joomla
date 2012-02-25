<div class="dragable" id="cfaction_meta_tager">Meta Tager</div>
<!--start_element_code-->
<div class="element_code" id="cfaction_meta_tager_element">
	<label class="action_label" style="display: block; float:none!important;">Meta Tager</label>
	<input type="hidden" name="chronoaction[{n}][action_meta_tager_{n}_description]" id="action_meta_tager_{n}_description" value="<?php echo $action_params['description']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_meta_tager_{n}_robots]" id="action_meta_tager_{n}_robots" value="<?php echo $action_params['robots']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_meta_tager_{n}_generator]" id="action_meta_tager_{n}_generator" value="<?php echo $action_params['generator']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_meta_tager_{n}_keywords]" id="action_meta_tager_{n}_keywords" value="<?php echo $action_params['keywords']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_meta_tager_{n}_title]" id="action_meta_tager_{n}_title" value="<?php echo $action_params['title']; ?>" />
	<textarea name="chronoaction[{n}][action_meta_tager_{n}_content1]" id="action_meta_tager_{n}_content1" style="display:none"><?php echo htmlspecialchars($action_params['content1']); ?></textarea>
    
	<input type="hidden" id="chronoaction_id_{n}" name="chronoaction_id[{n}]" value="{n}" />
	<input type="hidden" name="chronoaction[{n}][type]" value="meta_tager" />
</div>
<!--end_element_code-->
<div class="element_config" id="cfaction_meta_tager_element_config">
	<?php echo $HtmlHelper->input('action_meta_tager_{n}_title_config', array('type' => 'text', 'class' => 'big_input', 'label' => "Page Title", 'smalldesc' => 'The page title, leave empty to abandon.')); ?>
	<?php echo $HtmlHelper->input('action_meta_tager_{n}_description_config', array('type' => 'text', 'class' => 'big_input', 'label' => "Description", 'smalldesc' => 'The description tag.')); ?>
	<?php echo $HtmlHelper->input('action_meta_tager_{n}_robots_config', array('type' => 'text', 'class' => 'big_input', 'label' => "Robots", 'smalldesc' => 'The robots tag.')); ?>
	<?php echo $HtmlHelper->input('action_meta_tager_{n}_generator_config', array('type' => 'text', 'class' => 'big_input', 'label' => "Generator", 'smalldesc' => 'The generator tag.')); ?>
	<?php echo $HtmlHelper->input('action_meta_tager_{n}_keywords_config', array('type' => 'text', 'class' => 'big_input', 'label' => "Keywords", 'smalldesc' => 'The keywords tag.')); ?>
	<?php echo $HtmlHelper->input('action_meta_tager_{n}_content1_config', array('type' => 'textarea', 'label' => "Extra tags", 'rows' => 20, 'cols' => 70, 'smalldesc' => 'Multi line tag title and tage value format, e.g: <br />tag name1=tag value1<br />tag name2=tag value2')); ?>
	
</div>