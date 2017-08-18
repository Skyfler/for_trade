"use strict";

(function ready() {

	var _polyfills = require('./polyfills');
	var _extendStandartPrototypes = require('./extendStandartPrototypes');
	var Menu = require('./dropdown-menu');
	var MarketTrendsWidget = require('./marketTrendsWidget');
	var ChartWidget = require('./chartWidget');
	var Slider = require('./slider');
//	var ContactFormController = require('./contactFormController');
	var FormValidator = require('./formValidator');
	var Popup = require('./popup');
	var SimpleTabs = require('./simpleTabs');
	var AutoPopupController = require('./autoPopupController');

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
		cancelDropdownOnGreaterThan: 899
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

//	var contactFormElem = document.querySelector('#contact_form');
//	if (contactFormElem) {
//		var contactForm = new ContactFormController({
//			elem: contactFormElem,
//			actionUrl: contactFormElem.action,
//			method: contactFormElem.method
//		});
//	}

	var contactFormElem = document.querySelector('#contact_form');
	if (contactFormElem) {
		var contactForm = new FormValidator({
			elem: contactFormElem
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
			delayDesktop: 60000
		});
	}

})();
