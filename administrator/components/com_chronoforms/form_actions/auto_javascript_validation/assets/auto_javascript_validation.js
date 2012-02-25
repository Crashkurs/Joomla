var AutoJavascriptValidation = new Class({
	
	initialize: function(form_name, rules) {
		this.run(form_name, rules);
	},

	run: function(form_name, rules) {
		var check_group = 1;
		for(rule in rules){
			rules[rule].each(function(field){
				var k = 0;
				if($chk($$("input[name='"+field+"']")[k]) && $$("input[name='"+field+"']")[k].get('type') == 'hidden'){
					k = 1;
				}
				if($chk($$("input[name='"+field+"']")[k])){
					$$("input[name='"+field+"']")[k].addClass("validate['"+rule+"']");
				}
				if($chk($$("select[name='"+field+"']")[k])){
					$$("select[name='"+field+"']")[k].addClass("validate['"+rule+"']");
				}
				if($chk($$("textarea[name='"+field+"']")[k])){
					$$("textarea[name='"+field+"']")[k].addClass("validate['"+rule+"']");
				}
				if($chk($$("input[name='"+field+"[]']")[0])){
					$$("input[name='"+field+"[]']").each(function(check){
						check.addClass("validate['group["+check_group+"]']");
					});
					check_group = check_group + 1;
				}
			});
		};
	}

});