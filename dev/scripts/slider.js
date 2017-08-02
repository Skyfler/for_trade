"use strict";

try {
	var Helper = require('./helper');
} catch (err) {
	console.warn(err);
}

function Slider(options) {
	options.name = options.name || 'Slider';
	Helper.call(this, options);

	this._elem = options.elem;
	this._overflowContainer = this._elem.querySelector('.overflow_hidden_container');
	this._overflowBlock = this._overflowContainer.querySelector('.overflow_block');
	this._moveDelay = options.delay || 0;
	this._breakPoint = options.breakPoint || 0;
	this._pauseOnHover = options.pauseOnHover || false;

	this._onClick = this._onClick.bind(this);
	this._onCornerTransitionEnd = this._onCornerTransitionEnd.bind(this);
	this._onMiddleTransitionEnd = this._onMiddleTransitionEnd.bind(this);
	this._onMouseOver = this._onMouseOver.bind(this);
	this._onMouseOut = this._onMouseOut.bind(this);
	this._onMouseDown = this._onMouseDown.bind(this);
	this._onMouseUp = this._onMouseUp.bind(this);
	this._onDragStart = this._onDragStart.bind(this);
	this._onMouseMoveDrag = this._onMouseMoveDrag.bind(this);
	this._onResize = this._onResize.bind(this);

	this._init();
}

Slider.prototype = Object.create(Helper.prototype);
Slider.prototype.constructor = Slider;

Slider.prototype._init = function() {
	var slidesArr = this._overflowBlock.querySelectorAll('[data-component="slide"]');
	if (0 === slidesArr.length) return;

	this._slidesCount = slidesArr.length;

	var firstSlide = slidesArr[0];
	var lastSlide = slidesArr[slidesArr.length - 1];

	this._overflowBlock.insertBefore(lastSlide.cloneNode(true), this._overflowBlock.firstChild);
	this._overflowBlock.appendChild(firstSlide.cloneNode(true));

	this._slidesArr = Array.prototype.slice.call(this._overflowBlock.querySelectorAll('[data-component="slide"]'));
	for (var i = 0; i < this._slidesArr.length; i++) {
		this._slidesArr[i].style.width = 100 / (this._slidesCount + 2) + '%';
		this._slidesArr[i].classList.remove('selected');
	}

	if (this._checkScreenWidth(this._breakPoint)) {
		this._active = true;

		this._initSlider();

	} else {
		this._active = false;
	}

	this._addListener(window, 'resize', this._onResize)
};

Slider.prototype._initSlider = function() {
	this._currSlide = 1;
	this._slidesArr[1].classList.add('selected');
	this._overflowBlock.style.width = 100 * (this._slidesCount + 2) + '%';
	this._overflowBlock.style.left = '-100%';

	this._addListener(this._elem, 'click', this._onClick);
	if (this._pauseOnHover) {
		this._addListener(this._elem, 'mouseover', this._onMouseOver);
		this._addListener(this._elem, 'mouseout', this._onMouseOut);
	}

	if (0 !== this._moveDelay) this._moveOverTime();

	this._moveOnSwipe();
};

Slider.prototype._onClick = function(e) {
	var target = e.target;
	this._controlSlider(target, e);
};

Slider.prototype._controlSlider = function(target, e) {
	var control = target.closest('[data-component="slider_control"]');
	if (control) {
		e.preventDefault();
		if (this._isMoving) return;

		if (this._moveTimer) {
			clearTimeout(this._moveTimer);
		}
		switch (control.dataset.action) {
			case 'forward':
				this._moveSlideForward();
				break;
			case 'back':
				this._moveSlideBack();
				break;
		}

		if (0 !== this._moveDelay) this._moveOverTime();
	}
};

Slider.prototype._onMouseOver = function() {
	if (this._moveTimer) {
		clearTimeout(this._moveTimer);
	}
};

Slider.prototype._onMouseOut = function() {
	if (0 !== this._moveDelay) this._moveOverTime();
};

Slider.prototype._moveSlideForward = function(increment) {
	increment = (increment === undefined) ? 1 : increment;
	this._overflowBlock.style.transitionDuration = '';
	this._isMoving = true;
	this._slidesArr[this._currSlide].classList.remove('selected');

	this._currSlide += increment;
	this._slidesArr[this._currSlide].classList.add('selected');

	this._overflowBlock.style.left = -100 * this._currSlide + '%';

	if (this._currSlide > this._slidesCount) {
		this._currSlide = 1;
		this._slidesArr[this._currSlide].classList.add('selected');
		this._addListener(this._elem, 'transitionend', this._onCornerTransitionEnd);
	} else {
		this._addListener(this._elem, 'transitionend', this._onMiddleTransitionEnd);
	}
};

Slider.prototype._moveSlideBack = function(decrement) {
	decrement = (decrement === undefined) ? 1 : decrement;
	this._overflowBlock.style.transitionDuration = '';
	this._isMoving = true;
	this._slidesArr[this._currSlide].classList.remove('selected');

	this._currSlide -= decrement;
	this._slidesArr[this._currSlide].classList.add('selected');

	this._overflowBlock.style.left = -100 * this._currSlide + '%';

	if (0 === this._currSlide) {
		this._currSlide = this._slidesCount;
		this._slidesArr[this._currSlide].classList.add('selected');
		this._addListener(this._elem, 'transitionend', this._onCornerTransitionEnd);
	} else {
		this._addListener(this._elem, 'transitionend', this._onMiddleTransitionEnd);
	}
};

Slider.prototype._onMiddleTransitionEnd = function(e) {
	if (e.target !== this._overflowBlock) return;

	this._removeListener(this._elem, 'transitionend', this._onMiddleTransitionEnd);
	this._isMoving = false;
};

Slider.prototype._onCornerTransitionEnd = function(e) {
	if (e.target !== this._overflowBlock) return;

	this._removeListener(this._elem, 'transitionend', this._onCornerTransitionEnd);

	this._overflowBlock.style.transitionDuration = '0s';
	this._overflowBlock.style.left = -100 * (this._currSlide) + '%';
	this._slidesArr[this._slidesCount+1].classList.remove('selected');
	this._slidesArr[0].classList.remove('selected');
	this._isMoving = false;
};

Slider.prototype._moveOnSwipe = function() {
	this._addListener(this._elem, 'mousedown', this._onMouseDown);
	this._addListener(this._elem, 'touchstart', this._onMouseDown);
	this._addListener(this._elem, 'dragstart', this._onDragStart);
};

Slider.prototype._onDragStart = function(e) {
	e.preventDefault();
};

Slider.prototype._onMouseDown = function(e) {
	var target = e.target;
	if (!target) {
		return;
	}
	var control = target.closest('[data-component="slider_control"]');
	if (!control) {
		this._startDrag(e);
	}
};

Slider.prototype._onMouseUp = function(e) {
	this._stopDrag(e);
};

Slider.prototype._startDrag = function(e) {
	this._removeListener(this._elem, 'transitionend', this._onCornerTransitionEnd);
	this._removeListener(this._elem, 'transitionend', this._onMiddleTransitionEnd);
	this._removeListener(this._elem, 'mousedown', this._onMouseDown);
	this._removeListener(this._elem, 'touchstart', this._onMouseDown);

	if (this._moveTimer) {
		clearTimeout(this._moveTimer);
	}

	this._isMoving = false;
	this._overflowBlock.style.transitionDuration = '0s';

	var clientX = (e.clientX === undefined) ? e.changedTouches[0].clientX : e.clientX;
	var clientY = (e.clientY === undefined) ? e.changedTouches[0].clientY : e.clientY;

	this._startCursorXPosition = clientX + (window.pageXOffset || document.documentElement.scrollLeft);
	this._startCursorYPosition = clientY + (window.pageYOffset || document.documentElement.scrollTop);

	this._overflowStartLeft = this._overflowBlock.offsetLeft;

	this._addListener(document, 'mousemove', this._onMouseMoveDrag);
	this._addListener(document, 'touchmove', this._onMouseMoveDrag);
	this._addListener(document, 'mouseup', this._onMouseUp);
	this._addListener(document, 'touchend', this._onMouseUp);
};

Slider.prototype._stopDrag = function(e) {
	this._removeListener(document, 'mousemove', this._onMouseMoveDrag);
	this._removeListener(document, 'touchmove', this._onMouseMoveDrag);
	this._removeListener(document, 'mouseup', this._onMouseUp);
	this._removeListener(document, 'touchend', this._onMouseUp);

	var pxLeft = getComputedStyle(this._overflowBlock).left;
	var pxIntLeft = parseInt(pxLeft);
	var percentLeft = this._pixelsToPercents(pxIntLeft);

	this._overflowBlock.style.left = percentLeft + '%';

	var clientX = (e.clientX === undefined) ? e.changedTouches[0].clientX : e.clientX;
	var clientY = (e.clientY === undefined) ? e.changedTouches[0].clientY : e.clientY;

	if (this._startCursorXPosition !== clientX || this._startCursorYPosition !== clientY) {
		e.preventDefault();
	}

	this._addListener(this._elem, 'mousedown', this._onMouseDown);
	this._addListener(this._elem, 'touchstart', this._onMouseDown);

	var newCenterSlide = this._getCenterListItem();
	var diff;
	if (!newCenterSlide) {
		console.warn(this.NAME + ': Center slide is not found!');
		diff = 0;

	} else {
		var newCenterSlideIndex = this._slidesArr.indexOf(newCenterSlide);

		if (newCenterSlideIndex === -1) {
			console.warn(this.NAME + ': Center slide is not in slides Array!');
			diff = 0;

		} else {
			diff = newCenterSlideIndex - this._currSlide;
		}
	}

	if (diff >= 0) {
		var overflowLeft = getComputedStyle(this._overflowBlock).left;
		var overflowLeftInt = parseInt(overflowLeft);
		var percentLeft = this._pixelsToPercents(overflowLeftInt);
		if ((diff === 0) && (parseInt(percentLeft * 10) % 100 === 0)) {

		} else {
			this._moveSlideForward(diff);
		}

	} else {
		this._moveSlideBack(-diff);
	}

	if (0 !== this._moveDelay) this._moveOverTime();
};

Slider.prototype._pixelsToPercents = function(left) {
	return left * (100 / this._overflowContainer.clientWidth);
};

Slider.prototype._onMouseMoveDrag = function(e) {
	var clientX = (e.clientX === undefined) ? e.changedTouches[0].clientX : e.clientX;

	var currentcursorXPosition = clientX + (window.pageXOffset || document.documentElement.scrollLeft);
	var xPositionDeleta = currentcursorXPosition - this._startCursorXPosition;

	var newLeft = this._overflowStartLeft + xPositionDeleta;

	this._overflowBlock.style.left = newLeft + 'px';

	var newCenterSlide = this._getCenterListItem();
	if (!newCenterSlide) {

	} else {
		var newCenterSlideIndex = this._slidesArr.indexOf(newCenterSlide);

		if (newCenterSlideIndex === -1) {

		} else {

			if (newCenterSlideIndex > this._slidesCount) {
				var percentLeft = this._pixelsToPercents(newLeft);
				newLeft = Math.abs(percentLeft) % 100;
				this._overflowBlock.style.left = -newLeft + '%';

				this._startCursorXPosition = currentcursorXPosition;
				this._overflowStartLeft = this._overflowBlock.offsetLeft;

			} else if (newCenterSlideIndex === 0) {
				var percentLeft = this._pixelsToPercents(newLeft);
				newLeft = Math.abs(percentLeft) + (this._slidesCount * 100);
				this._overflowBlock.style.left = -newLeft + '%';

				this._startCursorXPosition = currentcursorXPosition;
				this._overflowStartLeft = this._overflowBlock.offsetLeft;
			}
		}
	}
};

Slider.prototype._getCenterListItem = function() {
	var clientRect = this._overflowContainer.getBoundingClientRect();

	var overflowContainerCenter = {
		x: clientRect.left + this._overflowContainer.offsetWidth / 2,
		y: clientRect.top + this._overflowContainer.offsetHeight / 2
	}

	if (overflowContainerCenter.x < 0) {
		overflowContainerCenter.x = 0;
	} else if (overflowContainerCenter.x > window.innerWidth - 1) {
		overflowContainerCenter.x = window.innerWidth - 1;
	}

	if (overflowContainerCenter.y < 0) {
		overflowContainerCenter.y = 0;
	} else if (overflowContainerCenter.y > window.innerHeight - 1) {
		overflowContainerCenter.y = window.innerHeight - 1;
	}

	var centerElement = document.elementFromPoint(overflowContainerCenter.x, overflowContainerCenter.y);

	return centerElement.closest('[data-component="slide"]');
};

Slider.prototype._moveOverTime = function () {
	this._moveTimer = setTimeout(function() {
		if (!this._elem) return;
		if (!this._isMoving) {
			this._moveSlideForward();
		}
		this._moveOverTime();
	}.bind(this), this._moveDelay);
};

Slider.prototype._onResize = function () {
	if (this._checkScreenWidth(this._breakPoint) && !this._active) {
		this._active = true;
		this._initSlider();

	} else if (!this._checkScreenWidth(this._breakPoint) && this._active) {
		this._active = false;
		this._cancelInitSlider();
	}
};

Slider.prototype._cancelInitSlider = function () {
	if (this._moveTimer) {
		clearTimeout(this._moveTimer);
	}

	for (var i = 0; i < this._listenerArr.length; i++) {
		if (this._listenerArr[i].elem !== window
			|| this._listenerArr[i].event !== 'resize'
			|| this._listenerArr[i].handler !== this._onResize) {
			this._removeListener(this._listenerArr[i].elem, this._listenerArr[i].event, this._listenerArr[i].elem, this._listenerArr[i].phase);
		}
	}

	this._overflowBlock.style.left = '-100%';
	this._isMoving = false;
};

try {
	module.exports = Slider;
} catch (err) {
	console.warn(err);
}
