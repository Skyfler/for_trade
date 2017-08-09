"use strict";

var FormTemplate = require('./formTemplate');
var ModalWindow = require('./modalWindow');
var _ajax = require('./ajax');

function ContactFormController(options) {
	options.name = options.name || 'ContactFormController';
	FormTemplate.call(this, options);

	this._loadImages('img/spinner.gif');

	this._onSubmit = this._onSubmit.bind(this);

	this._addListener(this._elem, 'submit', this._onSubmit);
}

ContactFormController.prototype = Object.create(FormTemplate.prototype);
ContactFormController.prototype.constructor = FormTemplate;

ContactFormController.prototype._onSubmit = function(e) {
	e.preventDefault();

	if (this._waitingForResponse) {
		// console.log(this.NAME + ': Already sent form!');
		return;
	}

	this._postForm();
};

ContactFormController.prototype._postForm = function() {
	var valuesObj = this._getUserInputValues();
	if (!valuesObj || valuesObj.__validationFailed) return;

	var formData = this._createFormData(valuesObj);

	this._waitingForResponse = true;
	this._elem.classList.add('waiting_for_response');

	_ajax.ajax(this._method, this._actionUrl, this._onReqEnd.bind(this), formData);
};

ContactFormController.prototype._onReqEnd = function(xhr) {
	if (!this._elem) return;

	this._waitingForResponse = false;
	this._elem.classList.remove('waiting_for_response');

	var res;

	try {
		res = JSON.parse(xhr.responseText);
	} catch(e) {
		res = false;
	}

	if (xhr.status === 200) {
		this._sendCustomEvent(this._elem, 'formSubmitted', { bubbles: true });
	} else {
//		new ModalWindow({
//			modalClass: 'error_notification',
//			modalInnerHTML: '<p>Произошла непредвиденная ошибка!</p>' +
//			'<p>Пожалуйста, повторите попытку позже.</p>'
//		});

		console.log({
			e: this.NAME + ': _onReqEnd',
			status: xhr.status,
			xhr: xhr,
			res: xhr.responseText
		});
	}
};

module.exports = ContactFormController;
