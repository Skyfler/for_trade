"use strict";

(function ready() {

	var _polyfills = require('./polyfills');
	var _extendStandartPrototypes = require('./extendStandartPrototypes');
	var Menu = require('./dropdown-menu');
	var MarketTrendsWidget = require('./marketTrendsWidget');
	var ChartWidget = require('./chartWidget');

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
			breakPonit: analyticsPage ? 0 : 768
		});
	}

})();
