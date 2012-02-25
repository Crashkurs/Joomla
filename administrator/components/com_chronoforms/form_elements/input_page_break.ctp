<div class="dragable" id="input_page_break">Page Break</div>
<div class="element_code" id="input_page_break_element">
	<label id="input_page_break_{n}_label" class="page_break_label">Page Break</label>
	<input type="hidden" id="chronofield_id_{n}" name="chronofield_id" value="{n}" />
    <input type="hidden" name="chronofield[{n}][tag]" value="input" />
    <input type="hidden" name="chronofield[{n}][type]" value="page_break" />
</div>
<div class="element_config" id="input_page_break_element_config">
	<?php echo $PluginTabsHelper->Header(array('help' => 'Help'), 'input_page_break_element_config_{n}'); ?>
	<?php echo $PluginTabsHelper->tabStart('help'); ?>
		This element will start a new form page, you should configure the page shown under the "Show HTML" action settings, each form page can be inside its own Event.
		<br />
		<br />
		If you want to do the same inside a custom code then please use this formula: <?php echo htmlspecialchars('<!--_CHRONOFORMS_PAGE_BREAK_-->'); ?>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
</div>