"use strict";

try {
	var Helper = require('./helper');
} catch (err) {
	console.warn(err);
}

function MarketTrendsWidget(options) {
	options.name = options.name || 'MarketTrendsWidget';
	Helper.call(this, options);

	this._elem = options.elem;

	this._onResize = this._onResize.bind(this);

	this._init();
}

MarketTrendsWidget.prototype = Object.create(Helper.prototype);
MarketTrendsWidget.prototype.constructor = MarketTrendsWidget;

MarketTrendsWidget.prototype._init = function() {
	this._onResize();
	this._addListener(window, 'resize', this._onResize);
};

MarketTrendsWidget.prototype._onResize = function() {
	if (this._width === this._elem.parentElement.offsetWidth) {
		return;
	}

	this._width = this._elem.parentElement.offsetWidth;

	this._elem.setAttribute('width', this._width);
};

try {
	module.exports = MarketTrendsWidget;
} catch (err) {
	console.warn(err);
}
