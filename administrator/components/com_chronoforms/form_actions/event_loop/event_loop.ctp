<div class="dragable" id="cfaction_event_loop">Event Loop</div>
<!--start_element_code-->
<div class="element_code" id="cfaction_event_loop_element">
	<label class="action_label">Event Loop</label>
	<input type="hidden" name="chronoaction[{n}][action_event_loop_{n}_target_event]" id="action_event_loop_{n}_target_event" value="<?php echo $action_params['target_event']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_event_loop_{n}_quit_next]" id="action_event_loop_{n}_quit_next" value="<?php echo $action_params['quit_next']; ?>" />
	<input type="hidden" id="chronoaction_id_{n}" name="chronoaction_id[{n}]" value="{n}" />
	<input type="hidden" name="chronoaction[{n}][type]" value="event_loop" />
</div>
<!--end_element_code-->
<script type="text/javascript"> 
//<![CDATA[
window.addEvent('domready', function() {
	refreshEventsList('{n}', 1);									
});
var counter = 0;
function refreshEventsList(SID, newCall, container, prefix){
	if(container == null || !container){
		var container = $('droppable_area_actions');
	}
	if(prefix == null || !prefix){
		var prefix = '';
	}
	if(counter == 0 || newCall == 1){
		$('action_event_loop_'+SID+'_target_event_config').empty();
	}
	container.getChildren('div.form_event').each(function(fevent){
		eprefix = prefix + ' > ' + fevent.getFirst('label').get('text');
		var nopt = new Element('option', {'value':fevent.getFirst('input[name^=_form_actions_events_map]').get('name'), 'text': eprefix}).inject($('action_event_loop_'+SID+'_target_event_config'));
		counter++;
		if(fevent.getChildren('div[id^=cfaction_]').length > 0){
			fevent.getChildren('div[id^=cfaction_]').each(function(fact){
				var aprefix = eprefix + ' > ' + fact.getFirst('label').get('text');
				refreshEventsList(SID, 0, fact, aprefix);				
			});
		}
	});
}
//]]>
</script>
<div class="element_config" id="cfaction_event_loop_element_config">
	<input type="button" name="action_event_loop_refresh_button" id="action_event_loop_refresh_button" value="Refresh Events List" onClick="refreshEventsList('{n}', 1)" />
    <br />
	<br />
	<?php echo $HtmlHelper->input('action_event_loop_{n}_target_event_config', array('type' => 'select', 'label' => 'Target Event', 'options' => array(), 'smalldesc' => 'Choose the event which will be executed, you may need to refresh the events list to have all the current form events available in the list.')); ?>
	<?php echo $HtmlHelper->input('action_event_loop_{n}_quit_next_config', array('type' => 'select', 'label' => 'Quit next actions', 'options' => array(0 => 'No', 1 => 'Yes'), 'smalldesc' => 'Should we quit all future events/actions after running that target event ?')); ?>
		
</div>