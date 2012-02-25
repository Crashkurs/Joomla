/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
function switchTab(id){
	$(id+'-panel-tab').getParent('ul').getChildren('li').each(function(tab){
		tab.set('class', '');
		$(tab.get('id').replace(/-panel-tab/, '-panel')).setStyle('display', 'none');
	});
	$(id+'-panel-tab').set('class', 'activetab');
	$(id+'-panel').setStyle('display', 'block');
	return false;
}