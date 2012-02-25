<?php
require_once(JPATH_SITE.DS."administrator".DS."components".DS."com_chronoforms".DS."helpers".DS."tabs_helper.php");
$PluginTabsHelper = new TabsHelper();
?>
<div class="dragable" id="cfaction_submit_article">Submit Article</div>
<!--start_element_code-->
<div class="element_code" id="cfaction_submit_article_element">
	<label class="action_label">Submit Article</label>
		
	<input type="hidden" name="chronoaction[{n}][action_submit_article_{n}_title]" id="action_submit_article_{n}_title" value="<?php echo $action_params['title']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_submit_article_{n}_fulltext]" id="action_submit_article_{n}_fulltext" value="<?php echo $action_params['fulltext']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_submit_article_{n}_introtext]" id="action_submit_article_{n}_introtext" value="<?php echo $action_params['introtext']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_submit_article_{n}_created_by_alias]" id="action_submit_article_{n}_created_by_alias" value="<?php echo $action_params['created_by_alias']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_submit_article_{n}_state]" id="action_submit_article_{n}_state" value="<?php echo $action_params['state']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_submit_article_{n}_catid]" id="action_submit_article_{n}_catid" value="<?php echo $action_params['catid']; ?>" />
	<!--
	<input type="hidden" name="chronoaction[{n}][action_submit_article_{n}_sectionid]" id="action_submit_article_{n}_sectionid" value="<?php echo $action_params['sectionid']; ?>" />
	-->
	<input type="hidden" id="chronoaction_id_{n}" name="chronoaction_id[{n}]" value="{n}" />
	<input type="hidden" name="chronoaction[{n}][type]" value="submit_article" />
</div>
<!--end_element_code-->
<div class="element_config" id="cfaction_submit_article_element_config">
	<?php echo $PluginTabsHelper->Header(array('fields' => 'Fields', 'settings' => 'Settings', 'help' => 'Help'), 'submit_article_config_{n}'); ?>
	<?php echo $PluginTabsHelper->tabStart('fields'); ?>
		<?php echo $HtmlHelper->input('action_submit_article_{n}_title_config', array('type' => 'text', 'label' => "Article Title Field", 'class' => 'medium_input', 'smalldesc' => "The field name which will hold the article's title.")); ?>
		<?php echo $HtmlHelper->input('action_submit_article_{n}_fulltext_config', array('type' => 'text', 'label' => "Full Text Field", 'class' => 'medium_input', 'smalldesc' => "The field name which will hold the article's full text.")); ?>
		<?php echo $HtmlHelper->input('action_submit_article_{n}_introtext_config', array('type' => 'text', 'label' => "Intro Text Field", 'class' => 'medium_input', 'smalldesc' => "The field name which will hold the article's intro text.")); ?>
		<?php echo $HtmlHelper->input('action_submit_article_{n}_created_by_alias_config', array('type' => 'text', 'label' => "Author Alias Field", 'class' => 'medium_input', 'smalldesc' => "The field name which will hold the Author's alias name.")); ?>
		
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('settings'); ?>
		<?php echo $HtmlHelper->input('action_submit_article_{n}_state_config', array('type' => 'select', 'label' => 'Published ?', 'options' => array(0 => 'No', 1 => 'Yes'), 'smalldesc' => 'If enabled it will set the article status to published.')); ?>
		<?php
			$database =& JFactory::getDBO();
			$query = "SELECT * FROM `#__categories`";
			$database->setQuery($query);
			$options = array();
			$cats = $database->loadObjectList();
			foreach($cats as $cat){
				$options[$cat->id] = $cat->title;
			}
		?>
		<?php echo $HtmlHelper->input('action_submit_article_{n}_catid_config', array('type' => 'select', 'label' => 'Category', 'options' => $options, 'empty' => " - ", 'class' => 'medium_input', 'smalldesc' => "Select the article's category.")); ?>
		
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('help'); ?>
		<p>
			<ul>
				<li>This plugin will Save a new article to the content table in your Joomla database.</li>
			</ul>
		</p>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
</div>