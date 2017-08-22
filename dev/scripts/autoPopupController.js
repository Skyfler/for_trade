"use strict";

try {
	var Helper = require('./helper');
} catch (err) {
	console.warn(err);
}

function AutoPopupController(options) {
	options.name = options.name || 'AutoPopupController';
	Helper.call(this, options);

	this._elem = options.elem;
	this._tabsElem = options.tabsElem;
	this._delayMobile = options.delayMobile || 300000;
	this._delayDesktop = options.delayDesktop || 300000;
	this._doNotShowCheckElem = options.doNotShowCheckElem;

	this._onPopupOpen = this._onPopupOpen.bind(this);
	this._onPopupClosed = this._onPopupClosed.bind(this);

	this._init();
}

AutoPopupController.prototype = Object.create(Helper.prototype);
AutoPopupController.prototype.constructor = AutoPopupController;

AutoPopupController.prototype._init = function() {
	this._openPopups = [];

	if (this._checkScreenWidth() === 'xs' && document.documentElement.classList.contains('page-index')) {
		this._autoOpenPopup();
	} else {
		this._startTimer();
	}

	this._addListener(document, 'popupOpen', this._onPopupOpen);
	this._addListener(document, 'popupClosed', this._onPopupClosed);
};

AutoPopupController.prototype._startTimer = function() {
	if (document.cookie.search('DoNotShowRegistrationPopup=true') !== -1 || this._doNotShowCheckElem.checked) return;

	if (this._timer) {
		clearTimeout(this._timer);
	}

	var delay;
	if (this._checkScreenWidth() === 'xs') {
		delay = this._delayMobile;
	} else {
		delay = this._delayDesktop;
	}

	this._timer = setTimeout(
		function() {
			delete this._timer;
			this._autoOpenPopup();
		}.bind(this),
		delay
	);
};

AutoPopupController.prototype._onPopupOpen = function(e) {
	var popupElem = e.detail.popupElem;
	if (!popupElem) return;

	if (popupElem === this._elem && this._timer) {
		clearTimeout(this._timer);
		delete this._timer;
	}

	var index = this._openPopups.indexOf(popupElem);
	if (index === -1) {
		this._openPopups.push(popupElem);
	}
};

AutoPopupController.prototype._onPopupClosed = function(e) {
	var popupElem = e.detail.popupElem;
	if (!popupElem) return;

	if (popupElem === this._elem) {
		this._startTimer();
	}

	var index = this._openPopups.indexOf(popupElem);
	if (index !== -1) {
		this._openPopups.splice(index, 1);
	}

	if (this._waitTillAllPopupsClosed) {
		delete this._waitTillAllPopupsClosed;
		this._autoOpenPopup();
	}
};

AutoPopupController.prototype._autoOpenPopup = function() {
	if (this._openPopups.length === 0) {
		this._sendCustomEvent(document, 'setActiveTab', { bubbles: true, detail: { targetTabsElem: this._tabsElem, targetTabIndex: 0 } });
		this._sendCustomEvent(document, 'openPopup', { bubbles: true, detail: { targetPopupElem: this._elem } });
	} else {
		this._waitTillAllPopupsClosed = true;
	}
};

try {
	module.exports = AutoPopupController;
} catch (err) {
	console.warn(err);
}
