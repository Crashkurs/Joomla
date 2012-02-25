<div class="dragable" id="input_panel_start">Panel Start</div>
<div class="element_code" id="input_panel_start_element">
	<label id="input_panel_start_{n}_label" class="panel_start_label">Panel Start</label>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_panel_start_{n}_panel_id]', array('type' => 'hidden', 'id' => 'input_panel_start_{n}_panel_id', 'value' => $element_params['panel_id'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_panel_start_{n}_panel_label]', array('type' => 'hidden', 'id' => 'input_panel_start_{n}_panel_label', 'value' => $element_params['panel_label'])); ?>
	
	<input type="hidden" id="chronofield_id_{n}" name="chronofield_id" value="{n}" />
    <input type="hidden" name="chronofield[{n}][tag]" value="input" />
    <input type="hidden" name="chronofield[{n}][type]" value="panel_start" />
</div>
<div class="element_config" id="input_panel_start_element_config">
	<?php echo $PluginTabsHelper->Header(array('settings' => 'Settings', 'help' => 'Help'), 'input_panel_start_element_config_{n}'); ?>
	<?php echo $PluginTabsHelper->tabStart('settings'); ?>
		<?php echo $HtmlHelper->input('input_panel_start_{n}_panel_id_config', array('type' => 'text', 'label' => 'Panel ID', 'class' => 'small_input', 'smalldesc' => 'Your panel id, make sure its unique in your Pane.')); ?>
		<?php echo $HtmlHelper->input('input_panel_start_{n}_panel_label_config', array('type' => 'text', 'label' => 'Panel Label', 'class' => 'small_input', 'smalldesc' => 'Your panel label text.')); ?>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	
	<?php echo $PluginTabsHelper->tabStart('help'); ?>
		This element will start a new panel, make sure that your panel is started inside an opened "Pane".
	<?php echo $PluginTabsHelper->tabEnd(); ?>
</div>