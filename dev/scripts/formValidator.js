"use strict";

try {
	var Helper = require('./helper');
	var _ajax = require('./ajax');
} catch (err) {
	console.warn(err);
}

function FormValidator(options) {
	options.name = options.name || 'FormValidator';
	Helper.call(this, options);

	this._elem = options.elem;

	this._onSubmit = this._onSubmit.bind(this);
	this._onReqEnd = this._onReqEnd.bind(this);

	this._init();
}

FormValidator.prototype = Object.create(Helper.prototype);
FormValidator.prototype.constructor = FormValidator;

FormValidator.prototype._init = function() {
	this._addListener(this._elem, 'submit', this._onSubmit);
};

FormValidator.prototype._onSubmit = function(e) {
	e.preventDefault();

	this._checkPhoneNum();
};

FormValidator.prototype._checkPhoneNum = function() {
	var codeNum = this._elem.codeNum.value;
	var formInputTel = this._elem.formInputTel.value;

	var fullNum = codeNum + formInputTel;
	var apiKey = '369cf28d46cc04fb6b3219b039c7c58f';

	_ajax.ajax('get', 'https://apilayer.net/api/validate?access_key=' + apiKey + '&number=' + fullNum, this._onReqEnd.bind(this));
};

FormValidator.prototype._onReqEnd = function(xhr) {
	var res = false;

	try {
		res = JSON.parse(xhr.responseText);
	} catch(e) {
		res = false;
	}

	if (res.valid) {
		this._onFormValid();
	} else {
		this._phoneNumInvalid();
	}
};

FormValidator.prototype._onFormValid = function() {
	window.beforeSubmit();

	this._elem.submit();
};

FormValidator.prototype._phoneNumInvalid = function() {
	this._elem.formInputTel.setCustomValidity('Введите реальный номер телефона');

	this._elem.reportValidity();
};

try {
	module.exports = FormValidator;
} catch (err) {
	console.warn(err);
}
