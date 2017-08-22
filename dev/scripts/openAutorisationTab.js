"use strict";

try {
	var Helper = require('./helper');
} catch (err) {
	console.warn(err);
}

function OpenAutorisationTab(options) {
	options.name = options.name || 'openAutorisationTab';
	Helper.call(this, options);

	this._elem = options.elem;
	this._tabsElem = options.tabsElem;

	this._onClick = this._onClick.bind(this);

	this._init();
}

OpenAutorisationTab.prototype = Object.create(Helper.prototype);
OpenAutorisationTab.prototype.constructor = OpenAutorisationTab;

OpenAutorisationTab.prototype._init = function() {
	this._addListener(this._elem, 'click', this._onClick);
};

OpenAutorisationTab.prototype._onClick = function() {
	this._sendCustomEvent(document, 'setActiveTab', { bubbles: true, detail: { targetTabsElem: this._tabsElem, targetTabIndex: 1 } });
};

try {
	module.exports = OpenAutorisationTab;
} catch (err) {
	console.warn(err);
}
