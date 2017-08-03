"use strict";

try {
	var Helper = require('./helper');
} catch (err) {
	console.warn(err);
}

function Popup(options) {
	options.name = options.name || 'Popup';
	Helper.call(this, options);

	this._elem = options.elem;
	this._popupOpenBtnSelector = options.popupOpenBtnSelector || '[data-popup="open"]';
	this._popupCloseBtnSelector = options.popupCloseBtnSelector || '[data-popup="close"]';

	this._onClick = this._onClick.bind(this);
	this._onFormSubmitted = this._onFormSubmitted.bind(this);

	this._init();
}

Popup.prototype = Object.create(Helper.prototype);
Popup.prototype.constructor = Popup;

Popup.prototype._init = function() {
	this._href = '';

	this._addListener(document, 'click', this._onClick);
};

Popup.prototype._onClick = function(e) {
	var target = e.target;
	if (!target) return;

	var openBtn = target.closest(this._popupOpenBtnSelector);
	var closeBtn = target.closest(this._popupCloseBtnSelector);

	if (openBtn) {
		e.preventDefault();
		this._href = target.href;
		this._openPopup();

	} else if (closeBtn) {
		e.preventDefault();
		this._href = '';
		this._closePopup();

	}
};

Popup.prototype._openPopup = function(e) {
	this._elem.style.display = 'block';

	this._addListener(this._elem, 'formSubmitted', this._onFormSubmitted);
};

Popup.prototype._closePopup = function(e) {
	this._elem.style.display = 'none';

	this._removeListener(this._elem, 'formSubmitted', this._onFormSubmitted);
};

Popup.prototype._onFormSubmitted = function(e) {
	this._closePopup();

	window.location = this._href;
};

try {
	module.exports = Popup;
} catch (err) {
	console.warn(err);
}
