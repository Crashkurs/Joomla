function rpSwitchTab(switchto) {
	$$('.rp_switchers').each(function(el){
		el.removeClass('active');
		if (el.get('id')) {
			document.id(el.get('id').replace('rp_switcher', 'rp_event')).setStyle('display','none');
		}
	});
	if (document.id('rp_event_' + switchto) && document.id('rp_switcher_' + switchto)) {
		document.id('rp_event_' + switchto).setStyle('display','');
		document.id('rp_switcher_' + switchto).addClass('active');
	}
	return false;
}

function rpShowTooltip(el) {
	document.id(el).removeEvents('mouseleave');
	if (document.id(el).title) {
		document.id(el).addEvent('mouseleave',function(){
			rpHideTooltip();
		});
		document.id('rpTipWrapper').set('text', document.id(el).title);
		pos = document.id(el).getPosition();
		document.id('rpTip').setStyles({
				'left': pos.x + 0,
				'top': pos.y + 20,
				'visibility': 'visible'
		});
		document.id('rpTip').setOpacity(0.8);
	}
}

function rpEditQueue(char_id) {
	document.id('att_char_queue_' + char_id).setStyle('display','none');
	document.id('att_char_edit_button_' + char_id).setStyle('display','none');
	document.id('att_char_edit_queue_' + char_id).setStyle('display', '');
}

function rpHideTooltip() {
	document.id('rpTip').setOpacity(0);
	document.id('rpTip').setStyle('visibility','hidden');
}

function setupTooltip() {
	if (!(document.id('rpTip'))) {
		(new Element('div', {
				'class': 'rp_tool-tip',
				'id' : 'rpTip',
				'styles': {
					'position': 'absolute',
					'top': '0',
					'left': '0',
					'visibility': 'hidden',
					'opacity' : 0,
					'z-index' : 70000
				}
		})).inject(document.body);
		(new Element('div',{'id':'rpTipWrapper'})).inject(document.id('rpTip'));
	}
}

window.addEvent('domready',function() {
	if ((MooTools.version >= '1.3') && (typeof(SqueezeBox)!='undefined')) {
		SqueezeBox.handlers.extend({
			ajax: function(url) {
				var options = this.options.ajaxOptions || {};
				this.asset = new Request.HTML($merge({
					method: 'get',
					evalScripts: false,
					onSuccess: function(responseTree, responseElements, responseHTML, responseJavaScript) {
						this.applyContent(responseHTML);
						if (options.evalScripts !== null && options.evalScripts) $exec(responseJavaScript);
						this.fireEvent('onAjax', [responseTree, responseElements, responseHTML, responseJavaScript]);
						this.asset = null;
					}.bind(this),
					onFailure: this.onError.bind(this)
				}, this.options.ajaxOptions));
				this.asset.send.delay(10, this.asset, [{url: url}]);
			}
		}); 
	}
	setupTooltip();
});