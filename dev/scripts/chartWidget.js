"use strict";

try {
	var Helper = require('./helper');
} catch (err) {
	console.warn(err);
}

function ChartWidget(options) {
	options.name = options.name || 'ChartWidget';
	Helper.call(this, options);

	this._elem = options.elem;
	this._maxheight = options.maxHeight || 750;
	this._breakPonit = options.breakPonit !== undefined ? options.breakPonit : 768;

	this._onResize = this._onResize.bind(this);

	this._init();
}

ChartWidget.prototype = Object.create(Helper.prototype);
ChartWidget.prototype.constructor = ChartWidget;

ChartWidget.prototype._init = function() {
	this._onResize();
	this._addListener(window, 'resize', this._onResize);
};

ChartWidget.prototype._widgetInitScript = function() {
	this._initalized = true;

	(function (d) {
		var s = d.createElement('script');
		s.setAttribute('type', 'text/javascript');
		s.setAttribute('async', true);
		s.setAttribute('charset', 'utf-8');
		s.setAttribute('src', 'https://trading4pro.com/js/init.widget.js');
		d.getElementsByTagName('head')[0].appendChild(s);
	})(document);
};

ChartWidget.prototype._onResize = function() {
	var height = window.innerHeight - 30;
	if (height > this._maxheight) {
		height = this._maxheight;
	}

	if (this._width === this._elem.parentElement.offsetWidth && this._elem.dataset.h === height) {
		return;
	}

	this._width = this._elem.parentElement.offsetWidth;

	this._elem.setAttribute('data-w', this._width);
	this._elem.setAttribute('data-h', height);
	this._elem.innerHTML = '';

	if (window.trading4proWidget) {
		if (this._timeout) {
			clearTimeout(this._timeout);
		}

		this._timeout = setTimeout(
			function() {
				delete this._timeout;

				if (window.innerWidth >= this._breakPonit) {
					window.trading4proWidget.init();
				}
			}.bind(this),
			500
		);

	} else if (window.innerWidth >= this._breakPonit) {
		this._widgetInitScript();
	}
};

try {
	module.exports = ChartWidget;
} catch (err) {
	console.warn(err);
}
