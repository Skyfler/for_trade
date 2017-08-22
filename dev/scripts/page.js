"use strict";

(function ready() {

	var _polyfills = require('./polyfills');
	var _extendStandartPrototypes = require('./extendStandartPrototypes');
	var Menu = require('./dropdown-menu');
	var DropdownGroup = require('./dropdown-dropdownGroup');
	var MarketTrendsWidget = require('./marketTrendsWidget');
	var ChartWidget = require('./chartWidget');
	var Slider = require('./slider');
	var ContactFormController = require('./contactFormController');
	// var FormValidator = require('./formValidator');
	var Popup = require('./popup');
	var SimpleTabs = require('./simpleTabs');
	var AutoPopupController = require('./autoPopupController');
	var OpenAutorisationTab = require('./openAutorisationTab');

	_polyfills.init();
	_extendStandartPrototypes.init();

	var mainMenu = new Menu({
		elem: document.querySelector('#main_menu'),
		transitionDuration: 0.5,
		openBtnSelector: '[data-component="dropdown_toggle"]',
		dropdownContainerSelector: '.dropdown_container',
		dropdownBarSelector: '.dropdown_bar',
		closeOnResize: true,
		listenToCloseSignal: true,
		cancelDropdownOnGreaterThan: 991
	});

	var marketTrendsWidgetElem = document.querySelector('#market_trends_widget');
	if (marketTrendsWidgetElem) {
		var marketTrendsWidget = new MarketTrendsWidget({
			elem: marketTrendsWidgetElem
		});
	}

	var chartWidgetElem = document.querySelector('#t4p-chart-widget');
	if (chartWidgetElem) {
		var analyticsPage = document.documentElement.classList.contains('page-analytics');
		var chartWidget = new ChartWidget({
			elem: chartWidgetElem,
			breakPonit: analyticsPage ? 0 : 768,
			maxHeight: 750
		});
	}

	var mainSliderElem = document.querySelector('#main_slider');
	if (mainSliderElem) {
		var mainSlider = new Slider({
			elem: mainSliderElem,
			delay: 5000,
			breakPoint: 768
		});
	}

	var registrationFormElem = document.querySelector('#registration_from');
	if (registrationFormElem) {
		var registrationForm = new ContactFormController({
			elem: registrationFormElem,
			actionUrl: registrationFormElem.action,
			method: registrationFormElem.method,
			callback: function() {
				beforeRegistrationSubmit();
				var afterAjaxAction = registrationFormElem.dataset.afterAjaxAction;
				registrationFormElem.action = afterAjaxAction;
				registrationFormElem.submit();
			}
		});
	}

	var bannerRegistrationFormElem = document.querySelector('#banner_registration_from');
	if (bannerRegistrationFormElem) {
		var bannerRegistrationForm = new ContactFormController({
			elem: bannerRegistrationFormElem,
			actionUrl: bannerRegistrationFormElem.action,
			method: bannerRegistrationFormElem.method,
			callback: function() {
				beforeRegistrationSubmit();
				var afterAjaxAction = bannerRegistrationFormElem.dataset.afterAjaxAction;
				bannerRegistrationFormElem.action = afterAjaxAction;
				bannerRegistrationFormElem.submit();
			}
		});
	}

	var autoRegistrationFormElem = document.querySelector('#auto_registration_from');
	if (autoRegistrationFormElem) {
		var autoRegistrationForm = new ContactFormController({
			elem: autoRegistrationFormElem,
			actionUrl: autoRegistrationFormElem.action,
			method: autoRegistrationFormElem.method,
			callback: function() {
				beforeRegistrationSubmit();
				var afterAjaxAction = autoRegistrationFormElem.dataset.afterAjaxAction;
				autoRegistrationFormElem.action = afterAjaxAction;
				autoRegistrationFormElem.submit();
			}
		});
	}

	var autoAutorisationFormElem = document.querySelector('#auto_autorisation_from');
	if (autoAutorisationFormElem) {
		var autoAutorisationForm = new ContactFormController({
			elem: autoAutorisationFormElem,
			actionUrl: autoAutorisationFormElem.action,
			method: autoAutorisationFormElem.method,
			callback: function() {
				if (document.documentElement.classList.contains('page-thanks') ||
				   document.documentElement.classList.contains('page-password_reset')||
				   document.documentElement.classList.contains('page-reset_link_sent')) {
					window.location = '/';
				} else {
					window.location.reload();
				}
			}
		});
	}

	var autoForgotPasswordFormElem = document.querySelector('#auto_forgot_password_from');
	if (autoForgotPasswordFormElem) {
		var autoForgotPasswordForm = new ContactFormController({
			elem: autoForgotPasswordFormElem,
			actionUrl: autoForgotPasswordFormElem.action,
			method: autoForgotPasswordFormElem.method,
			callback: function() {
				window.location = '/reset-pwd-link-sent';
			}
		});
	}

	var logoutFormElem = document.querySelector('#logout_form');
	if (logoutFormElem) {
		var logoutForm = new ContactFormController({
			elem: logoutFormElem,
			actionUrl: logoutFormElem.action,
			method: logoutFormElem.method,
			callback: function() {
				if (document.documentElement.classList.contains('page-thanks') ||
				   document.documentElement.classList.contains('page-password_reset')||
				   document.documentElement.classList.contains('page-reset_link_sent')) {
					window.location = '/';
				} else {
					window.location.reload();
				}
			}
		});
	}

	var tabsElem = document.querySelector('.tabs');
	if (tabsElem) {
		var tabs = new SimpleTabs({
			elem: tabsElem
		});
	}

	var registrationFormPopupElem = document.querySelector('#registration_form_popup');
	if (registrationFormPopupElem) {
		var registrationFormPopup = new Popup({
			elem: registrationFormPopupElem,
			popupOpenBtnSelector: '[data-popup-action="open"]',
			popupCloseBtnSelector: '[data-popup-action="close"]'
		});
	}

	var autoRegistrationFormPopupElem = document.querySelector('#auto_registration_form_popup');
	if (autoRegistrationFormPopupElem) {
		var autoRegistrationFormPopup = new Popup({
			elem: autoRegistrationFormPopupElem,
			popupOpenBtnSelector: '[data-popup-action="open"]',
			popupCloseBtnSelector: '[data-popup-action="close"]'
		});

		var autoPopupController = new AutoPopupController({
			elem: autoRegistrationFormPopupElem,
			tabsElem: tabsElem || false,
			delayMobile: 180000,
			delayDesktop: 60000,
			doNotShowCheckElem: autoRegistrationFormPopupElem.querySelector('#do_not_show')
		});
	}

	var dropdownGroupElem = document.querySelector('.dropdown_group');
	if (dropdownGroupElem) {
		var dropdownGroup = new DropdownGroup({
			elem: dropdownGroupElem,
			dropdownSelector: '.droppownGroupItem',
			dropdownOptions: {
				transitionDuration: 0.5,
				openBtnSelector: '[data-component="dropdown_toggle"]',
				dropdownContainerSelector: '.dropdown_container',
				dropdownBarSelector: '.dropdown_bar',
				closeOnResize: true
			}
		});
	}

	var headerLoginBtnElem = document.querySelector('#header_login_btn');
	if (headerLoginBtnElem) {
		var headerLoginBtn = new OpenAutorisationTab({
			elem: headerLoginBtnElem,
			tabsElem: tabsElem || false
		});
	}

})();
