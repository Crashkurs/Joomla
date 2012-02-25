<div class="dragable" id="cfaction_check_token">Check Token</div>
<!--start_element_code-->
<div class="element_code" id="cfaction_check_token_element">
	<label class="action_label">Check Token</label>
	<div id="cfactionevent_check_token_{n}_success" class="form_event good_event">
		<label class="form_event_label">OnSuccess</label>
	</div>
	<div id="cfactionevent_check_token_{n}_fail" class="form_event bad_event">
		<label class="form_event_label">OnFail</label>
	</div>
	<input type="hidden" id="chronoaction_id_{n}" name="chronoaction_id[{n}]" value="{n}" />
	<input type="hidden" name="chronoaction[{n}][type]" value="check_token" />
</div>
<!--end_element_code-->
<div class="element_config" id="cfaction_check_token_element_config">
</div>