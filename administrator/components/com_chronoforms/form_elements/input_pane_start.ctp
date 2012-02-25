<div class="dragable" id="input_pane_start">Pane Start</div>
<div class="element_code" id="input_pane_start_element">
	<label id="input_pane_start_{n}_label" class="pane_start_label">Pane Start</label>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_pane_start_{n}_pane_id]', array('type' => 'hidden', 'id' => 'input_pane_start_{n}_pane_id', 'value' => $element_params['pane_id'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_pane_start_{n}_pane_type]', array('type' => 'hidden', 'id' => 'input_pane_start_{n}_pane_type', 'value' => $element_params['pane_type'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_pane_start_{n}_pane_start]', array('type' => 'hidden', 'id' => 'input_pane_start_{n}_pane_start', 'value' => $element_params['pane_start'])); ?>
	
	<input type="hidden" id="chronofield_id_{n}" name="chronofield_id" value="{n}" />
    <input type="hidden" name="chronofield[{n}][tag]" value="input" />
    <input type="hidden" name="chronofield[{n}][type]" value="pane_start" />
</div>
<div class="element_config" id="input_pane_start_element_config">
	<?php echo $PluginTabsHelper->Header(array('settings' => 'Settings', 'help' => 'Help'), 'input_pane_start_element_config_{n}'); ?>
	<?php echo $PluginTabsHelper->tabStart('settings'); ?>
		<?php echo $HtmlHelper->input('input_pane_start_{n}_pane_id_config', array('type' => 'text', 'label' => 'Pane ID', 'class' => 'big_input', 'smalldesc' => 'The id of your pane, should be unique one in your form.')); ?>
		<?php echo $HtmlHelper->input('input_pane_start_{n}_pane_type_config', array('type' => 'select', 'label' => 'Pane Type', 'options' => array('tabs' => 'Tabs', 'sliders' => 'Sliders'), 'smalldesc' => 'Select the type of your Pane.')); ?>
		<?php echo $HtmlHelper->input('input_pane_start_{n}_pane_start_config', array('type' => 'text', 'label' => 'Pane Start Offset', 'class' => 'small_input', 'smalldesc' => 'The numeric key of the panel which will be active on start, for first panel use 0, for the 2nd use 1,...etc')); ?>
	
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	
	<?php echo $PluginTabsHelper->tabStart('help'); ?>
		This element will start a new pane, you will need to enter your panels inside this pane.
	<?php echo $PluginTabsHelper->tabEnd(); ?>
</div>