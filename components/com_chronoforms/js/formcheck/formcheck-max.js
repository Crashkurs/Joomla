var FormCheckMax = new Class({
	Extends: FormCheck,
	Implements: Options,
	
	/*
	Function: addError
		Private method

		Add error message
	*/
	addError : function(obj) {
		//determine position
		var coord = obj.target ? $(obj.target).getCoordinates() : obj.getCoordinates();

		if(!obj.element && this.options.display.indicateErrors != 0) {
			if (this.options.display.errorsLocation == 1) {
				var pos = (this.options.display.tipsPosition == 'left') ? coord.left : coord.right;
				var options = {
					'opacity' : 0,
					'position' : 'absolute',
					'float' : 'left',
					'left' : pos + this.options.display.tipsOffsetX
				};
				obj.element = new Element('div', {'class' : this.options.tipsClass, 'styles' : options}).injectInside(document.body);
				this.addPositionEvent(obj);
			} else if (this.options.display.errorsLocation == 2){
				obj.element = new Element('div', {'class' : this.options.errorClass, 'styles' : {'opacity' : 0}}).injectBefore(obj);
			} else if (this.options.display.errorsLocation == 3){
				obj.element = new Element('div', {'class' : this.options.errorClass, 'styles' : {'opacity' : 0}});
				//hack for position
				if($chk($('error-message-'+obj.get('name').replace(/\[\]/, '')))){
					obj.element.inject($('error-message-'+obj.get('name').replace(/\[\]/, '')));
				}else{
					if ($type(obj.group) == 'object' || $type(obj.group) == 'collection')
						obj.element.injectAfter(obj.group[obj.group.length-1]);
					else
						obj.element.injectAfter(obj);
				}
				//end hack
			}
		}
		if (obj.element && obj.element != true) {
			obj.element.empty();
			//hack for title
			if($chk(obj.get('title'))){
				obj.errors = [obj.get('title')];
			}
			//end hack
			if (this.options.display.errorsLocation == 1) {
				var errors = [];
				obj.errors.each(function(error) {
					errors.push(new Element('p').set('html', error));
				});
				var tips = this.makeTips(errors).injectInside(obj.element);
				if(this.options.display.closeTipsButton) {
					tips.getElements('a.close').addEvent('mouseup', function(){
						this.removeError(obj, 'tip');
					}.bind(this));
				}
				obj.element.setStyle('top', coord.top - tips.getCoordinates().height + this.options.display.tipsOffsetY);
			} else {
				obj.errors.each(function(error) {
					new Element('p').set('html',error).injectInside(obj.element);
				});
			}

			if (!this.options.display.fadeDuration || Browser.Engine.trident && Browser.Engine.version == 5 && this.options.display.errorsLocation < 2) {
				obj.element.setStyle('opacity', 1);
			} else {
				obj.fx = new Fx.Tween(obj.element, {
					'duration' : this.options.display.fadeDuration,
					'ignore' : true,
					'onStart' : function(){
						this.fxRunning = true;
					}.bind(this),
					'onComplete' : function() {
						this.fxRunning = false;
						if (obj.element && obj.element.getStyle('opacity').toInt() == 0) {
							obj.element.destroy();
							obj.element = false;
						}
					}.bind(this)
				});
				if(obj.element.getStyle('opacity').toInt() != 1) obj.fx.start('opacity', 1);
			}
		}
		if (this.options.display.addClassErrorToField && !obj.isChild){
			obj.addClass(this.options.fieldErrorClass);
			obj.element = obj.element || true;
		}

	}
});