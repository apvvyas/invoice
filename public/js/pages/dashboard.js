/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 14);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/pages/dashboard.js":
/*!*****************************************!*\
  !*** ./resources/js/pages/dashboard.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var randomScalingFactor = function randomScalingFactor() {
  return (Math.random() > 0.5 ? 1.0 : 1.0) * Math.round(Math.random() * 100);
};

Chart.helpers.drawRoundedTopRectangle = function (ctx, x, y, width, height, radius) {
  ctx.beginPath();
  ctx.moveTo(x + radius, y);
  ctx.lineTo(x + width - radius, y);
  ctx.quadraticCurveTo(x + width, y, x + width, y + radius);
  ctx.lineTo(x + width, y + height);
  ctx.lineTo(x, y + height);
  ctx.lineTo(x, y + radius);
  ctx.quadraticCurveTo(x, y, x + radius, y);
  ctx.closePath();
};

Chart.elements.RoundedTopRectangle = Chart.elements.Rectangle.extend({
  draw: function draw() {
    var ctx = this._chart.ctx;
    var vm = this._view;
    var left, right, top, bottom, signX, signY, borderSkipped;
    var borderWidth = vm.borderWidth;

    if (!vm.horizontal) {
      left = vm.x - vm.width / 2;
      right = vm.x + vm.width / 2;
      top = vm.y;
      bottom = vm.base;
      signX = 1;
      signY = bottom > top ? 1 : -1;
      borderSkipped = vm.borderSkipped || 'bottom';
    } else {
      left = vm.base;
      right = vm.x;
      top = vm.y - vm.height / 2;
      bottom = vm.y + vm.height / 2;
      signX = right > left ? 1 : -1;
      signY = 1;
      borderSkipped = vm.borderSkipped || 'left';
    }

    if (borderWidth) {
      var barSize = Math.min(Math.abs(left - right), Math.abs(top - bottom));
      borderWidth = borderWidth > barSize ? barSize : borderWidth;
      var halfStroke = borderWidth / 2;
      var borderLeft = left + (borderSkipped !== 'left' ? halfStroke * signX : 0);
      var borderRight = right + (borderSkipped !== 'right' ? -halfStroke * signX : 0);
      var borderTop = top + (borderSkipped !== 'top' ? halfStroke * signY : 0);
      var borderBottom = bottom + (borderSkipped !== 'bottom' ? -halfStroke * signY : 0);

      if (borderLeft !== borderRight) {
        top = borderTop;
        bottom = borderBottom;
      }

      if (borderTop !== borderBottom) {
        left = borderLeft;
        right = borderRight;
      }
    }

    var barWidth = Math.abs(left - right);
    var roundness = this._chart.config.options.barRoundness || 0.2;
    var radius = barWidth * roundness * 0.2;
    var prevTop = top;
    top = prevTop + radius;
    var barRadius = top - prevTop;
    ctx.beginPath();
    ctx.fillStyle = vm.backgroundColor;
    ctx.strokeStyle = vm.borderColor;
    ctx.lineWidth = borderWidth;
    Chart.helpers.drawRoundedTopRectangle(ctx, left, top - barRadius + 1, barWidth, bottom - prevTop, barRadius);
    ctx.fill();

    if (borderWidth) {
      ctx.stroke();
    }

    top = prevTop;
  }
});
Chart.defaults.roundedBar = Chart.helpers.clone(Chart.defaults.bar);
Chart.controllers.roundedBar = Chart.controllers.bar.extend({
  dataElementType: Chart.elements.RoundedTopRectangle
});
var ctx = document.getElementById("orders").getContext('2d');
var myChart = new Chart(ctx, {
  type: 'roundedBar',
  data: {
    labels: months,
    datasets: [{
      label: 'Paid',
      data: chart_paid,
      borderColor: "#fff",
      backgroundColor: "#5d5386",
      hoverBackgroundColor: "#483d77"
    }, {
      label: 'Pending',
      data: chart_pending,
      borderColor: "#fff",
      backgroundColor: "#e4e8f0",
      hoverBackgroundColor: "#dde1e9"
    }]
  },
  options: {
    responsive: true,
    barRoundness: 1,
    tooltips: {
      backgroundColor: 'rgba(47, 49, 66, 0.8)',
      titleFontSize: 13,
      titleFontColor: '#fff',
      caretSize: 0,
      cornerRadius: 4,
      xPadding: 5,
      displayColors: false,
      yPadding: 5
    },
    legend: {
      display: true,
      position: 'bottom',
      labels: {
        fontColor: "#2e3451",
        usePointStyle: true,
        padding: 50,
        fontSize: 13
      }
    },
    scales: {
      xAxes: [{
        barThickness: 25,
        stacked: false,
        gridLines: {
          drawBorder: false,
          display: false
        },
        ticks: {
          display: true
        }
      }],
      yAxes: [{
        stacked: false,
        gridLines: {
          drawBorder: false,
          display: false
        },
        ticks: {
          display: false
        }
      }]
    }
  }
});
$('.circle-orders').circleProgress({
  value: new_invoice_percent / 100,
  size: 120,
  startAngle: -Math.PI / 2,
  thickness: 6,
  lineCap: 'round',
  emptyFill: '#e4e8f0',
  fill: {
    gradient: ['#0087a4', '#08a6c3']
  }
}).on('circle-animation-progress', function (event, progress) {
  $(this).find('.percent-orders').html(Math.round(new_invoice_percent * progress) + '<i>%</i>');
}); // ------------------------------------------------------- //
// Widget 16 (Pages Views)
// ------------------------------------------------------ //

$('.pages-views').circleProgress({
  value: 0.54,
  size: 120,
  startAngle: -Math.PI / 2,
  thickness: 10,
  lineCap: 'round',
  emptyFill: '#f0eff4',
  fill: {
    gradient: ['#f9a58d', '#e76c90']
  }
}).on('circle-animation-progress', function (event, progress) {
  $(this).find('.percent').html('<i>+</i>' + Math.round(54 * progress) + '<i>%</i>');
}); // ------------------------------------------------------- //
// Widget 17 (Visitors Online)
// ------------------------------------------------------ //	

$('.visitors').circleProgress({
  value: 0.37,
  size: 120,
  startAngle: -Math.PI / 2,
  thickness: 10,
  lineCap: 'round',
  emptyFill: '#f0eff4',
  fill: {
    gradient: ['#0087a4', '#08a6c3']
  }
}).on('circle-animation-progress', function (event, progress) {
  $(this).find('.percent').html('<i>+</i>' + Math.round(37 * progress) + '<i>%</i>');
});
window.initConfirmationOnDelete();

/***/ }),

/***/ 14:
/*!***********************************************!*\
  !*** multi ./resources/js/pages/dashboard.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /var/www/html/invoice/resources/js/pages/dashboard.js */"./resources/js/pages/dashboard.js");


/***/ })

/******/ });