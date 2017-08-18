"use strict";

try {
	var Helper = require('./helper');
} catch (err) {
	console.warn(err);
}

function SimpleTabs(options) {
	options.name = options.name || 'SimpleTabs';
	Helper.call(this, options);

	this._elem = options.elem;

	this._onClick = this._onClick.bind(this);
	this._onSetActiveTab = this._onSetActiveTab.bind(this);
	this._init();
}

SimpleTabs.prototype = Object.create(Helper.prototype);
SimpleTabs.prototype.constructor = SimpleTabs;

SimpleTabs.prototype._init = function() {
	this._tabs = this._elem.querySelectorAll('.tab_label');
	this._tabsBlocks = this._elem.querySelectorAll('.tab_block');

	this._removeSelectedClass();
	this._selectTab(this._tabs[0]);

	this._addListener(this._elem, 'click', this._onClick);
	this._addListener(document, 'setActiveTab', this._onSetActiveTab);
};

SimpleTabs.prototype._onClick = function(e) {
	var target = e.target;

	this._selectTab(target, e);
};

SimpleTabs.prototype._selectTab = function(target, e) {
	var targetTab = target.closest('[data-tab-target]');
	if (!targetTab || targetTab.classList.contains('selected')) return;

	var targetTabBlockClass = targetTab.dataset.tabTarget;
	if (!targetTabBlockClass) return;

	if (e) e.preventDefault();

	var i = 0,
		targetTabBlock;

	do {
		if (this._tabsBlocks[i].classList.contains(targetTabBlockClass)) {
			targetTabBlock = this._tabsBlocks[i];
		}

		i++;
	} while (i < this._tabsBlocks.length && !targetTabBlock);

	if (!targetTabBlock) return;

	this._removeSelectedClass();
	targetTab.classList.add('selected');
	targetTabBlock.classList.add('selected');
};

SimpleTabs.prototype._removeSelectedClass = function() {
	for (var i = 0; i < this._tabs.length; i++) {
		this._tabs[i].classList.remove('selected');
	}
	for (var i = 0; i < this._tabsBlocks.length; i++) {
		this._tabsBlocks[i].classList.remove('selected');
	}
};

SimpleTabs.prototype._onSetActiveTab = function(e) {
	var targetTabsElem = e.detail.targetTabsElem;
	if (targetTabsElem !== this._elem) return;

	var targetTabIndex = e.detail.targetTabIndex;
	if (!this._tabs[targetTabIndex]) return;

	this._selectTab(this._tabs[targetTabIndex]);
};

try {
	module.exports = SimpleTabs;
} catch (err) {
	console.warn(err);
}
