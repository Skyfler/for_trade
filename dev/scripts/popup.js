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
	this._popupOpenBtnSelector = options.popupOpenBtnSelector || '[data-popup-action="open"]';
	this._popupCloseBtnSelector = options.popupCloseBtnSelector || '[data-popup-action="close"]';

	this._onClick = this._onClick.bind(this);
	this._onFormSubmitted = this._onFormSubmitted.bind(this);
	this._onOpenPopup = this._onOpenPopup.bind(this);

	this._init();
}

Popup.prototype = Object.create(Helper.prototype);
Popup.prototype.constructor = Popup;

Popup.prototype._init = function() {
	this._href = '';

	this._addListener(document, 'click', this._onClick);
	this._addListener(document, 'openPopup', this._onOpenPopup);
};

Popup.prototype._onClick = function(e) {
	var target = e.target;
	if (!target) return;

	var openBtn = target.closest(this._popupOpenBtnSelector);
	var closeBtn = target.closest(this._popupCloseBtnSelector);

	if (openBtn && openBtn.dataset.popupTarget && openBtn.dataset.popupTarget === this._elem.id) {
		e.preventDefault();
		this._href = target.href;
		this._openPopup();

	} else if (closeBtn && closeBtn.dataset.popupTarget && closeBtn.dataset.popupTarget === this._elem.id) {
		e.preventDefault();
		this._href = '';
		this._closePopup();

	}
};

Popup.prototype._openPopup = function() {
	this._elem.style.display = 'block';
	this._sendCustomEvent(this._elem, 'popupOpen', { bubbles: true, detail: { popupElem: this._elem } });

	this._addListener(this._elem, 'formSubmitted', this._onFormSubmitted);
};

Popup.prototype._closePopup = function() {
	this._elem.style.display = 'none';
	this._sendCustomEvent(this._elem, 'popupClosed', { bubbles: true, detail: { popupElem: this._elem } });

	this._removeListener(this._elem, 'formSubmitted', this._onFormSubmitted);
};

Popup.prototype._onFormSubmitted = function(e) {
	this._closePopup();

	window.location = this._href;
};

Popup.prototype._onOpenPopup = function(e) {
	var targetPopupElem = e.detail.targetPopupElem;
	if (targetPopupElem !== this._elem) return;

	this._openPopup();
};

try {
	module.exports = Popup;
} catch (err) {
	console.warn(err);
}
