/**
 * drag.ghost.js - Ghosting draggable extension for Drag.Move
 * @version 1.01
 * 
 * by MonkeyPhysics.com
 *
 * Source/Documentation available at:
 * http://www.monkeyphysics.com/mootools/script/1/dragghost
 * 
 * Some Rights Reserved
 * http://creativecommons.org/licenses/by-sa/3.0/
 * 
 */

Drag.Ghost = new Class({
	
	Extends: Drag.Move,
	
	options: { opacity: 0.65 },
	
	start: function(event) {
		this.ghost();
		this.parent(event);
	},
	
	cancel: function(event) {
		if (event) this.deghost();
		this.parent(event);
	},
	
	stop: function(event) {
		this.deghost();
		this.parent(event);
	},
	
	ghost: function() {
		this.element = this.element.clone()
			.setStyles({
				'opacity': this.options.opacity,
				'position': 'absolute',
				'top': this.element.getCoordinates()['top'],
				'left': this.element.getCoordinates()['left']
			})
			.inject(document.body)
			.store('parent', this.element);
	},
	
	deghost: function() {
		var e = this.element.retrieve('parent');
		this.element.destroy();
		this.element = e;
	}
});

Element.implement({
	makeGhostDraggable: function(options) {
		return new Drag.Ghost(this, options);
	}
});