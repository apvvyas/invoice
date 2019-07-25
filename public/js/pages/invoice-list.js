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
/******/ 	return __webpack_require__(__webpack_require__.s = 3);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/pages/invoice/index.js":
/*!*********************************************!*\
  !*** ./resources/js/pages/invoice/index.js ***!
  \*********************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _send__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./send */ "./resources/js/pages/invoice/send.js");
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }


$(function () {
  var ListInvoice = new listInvoice();
});

var listInvoice = function listInvoice() {
  _classCallCheck(this, listInvoice);

  var SendInvoice = new _send__WEBPACK_IMPORTED_MODULE_0__["default"]();
  this.dtable = dtable('#export-table', {
    fnDrawCallback: function fnDrawCallback() {
      initConfirmationOnDelete();
      SendInvoice.initSendInvoiceEvent();
    },
    ajax: {
      url: $('table#export-table').data('url'),
      method: 'get'
    },
    columns: [{
      data: 'title',
      title: 'Invoice Title',
      name: 'title'
    }, {
      data: 'recipient',
      title: "Recipient",
      name: 'recipient'
    }, {
      data: 'status',
      title: "Status",
      name: 'status',
      render: function render(data, row) {
        var status = $('<span/>', {
          id: 'status' + row.id,
          "class": 'text text-' + data.color,
          title: data.text
        }).html(data.text);
        var div = $('<div/>').html(status);
        return div.html();
      }
    }, {
      data: 'due_at',
      title: 'Due Date',
      name: 'due_at'
    }, {
      data: 'id',
      title: 'Action',
      searchable: false,
      sortable: false,
      className: 'text-center text-nowrap',
      render: function render(data, type, row) {
        var tableaction = "";
        if (row.permissions.view !== false) tableaction += buildViewAction(route('invoice.show', {
          invoice: data
        }));
        if (row.permissions["delete"] !== false) tableaction += buildStatusUpdateAction(route('invoice.status', {
          invoice: data
        }));
        if (row.permissions["delete"] !== false) tableaction += SendInvoice.buildSendInvoice(data, row['recipient']);
        if (row.permissions["delete"] !== false) tableaction += buildDeleteAction(route('invoice.destroy', {
          invoice: data
        }));
        return tableaction;
      }
    }]
  });
};

/***/ }),

/***/ "./resources/js/pages/invoice/send.js":
/*!********************************************!*\
  !*** ./resources/js/pages/invoice/send.js ***!
  \********************************************/
/*! exports provided: sendInvoice, default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "sendInvoice", function() { return sendInvoice; });
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var sendInvoice =
/*#__PURE__*/
function () {
  function sendInvoice() {
    _classCallCheck(this, sendInvoice);

    this.sendMail();
    this.successNotifySendMail = new Noty({
      type: 'success',
      layout: 'topRight',
      text: 'Mail sent succesfully',
      progressBar: true,
      timeout: 2500,
      animation: {
        open: 'animated bounceInRight',
        // Animate.css class names
        close: 'animated bounceOutRight' // Animate.css class names

      }
    });
    this.erroNotifySendMail = new Noty({
      type: 'error',
      layout: 'topRight',
      text: 'Some error occured ..please try again later!!',
      progressBar: true,
      timeout: 2500,
      animation: {
        open: 'animated bounceInRight',
        // Animate.css class names
        close: 'animated bounceOutRight' // Animate.css class names

      }
    });
    $('select[name="to"]').selectpicker();
  }

  _createClass(sendInvoice, [{
    key: "buildSendInvoice",
    value: function buildSendInvoice(id, recipient) {
      return $("<div />").append($('<a />', {
        html: '<i class="la la-1-5x la-envelope"></i>',
        href: 'javascript:void(0)',
        title: 'View',
        "class": 'ml-1 mr-1 invoice_send',
        'data-id': id || '',
        'data-recipient': recipient || ''
      })).html();
    }
  }, {
    key: "initSendInvoiceEvent",
    value: function initSendInvoiceEvent(isbutton) {
      var Self = this;
      var not_button = isbutton;
      $('#send-invoice-modal').on('shown.bs.modal', function () {
        Self.initToggleSendTo();
      });

      if (typeof not_button == 'undefined') {
        $('.invoice_send').on('click', function () {
          Self.openModal($(this));
        });
      } else {
        Self.openModal(not_button);
      }

      $('#send-invoice-modal').on('hidden.bs.modal', function () {
        $('#send_invoice')[0].reset();
        Self.setForm('', '');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
        if (typeof not_button != 'undefined') window.location.href = route('invoices');
      });
    }
  }, {
    key: "openModal",
    value: function openModal(obj) {
      this.setForm(obj.data('id'), obj.data('recipient'));
      $('#send-invoice-modal').modal('show');
    }
  }, {
    key: "setForm",
    value: function setForm(id, subtext) {
      $('#send_invoice_id').val(id);
      $('select[name="to"]').find('option[value="recipient"]').data('subtext', subtext);
      $('select[name="to"]').selectpicker('refresh');
    }
  }, {
    key: "initToggleSendTo",
    value: function initToggleSendTo() {
      var Self = this;
      $('select[name="to"]').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
        $('#send_section').collapse('hide');
        Self.switchToggleRequiredProp(false);
        $('#send_to_self_section').collapse('show');

        if (clickedIndex == 2) {
          Self.switchToggleRequiredProp(true);
          $('#send_section').collapse('show');
        } else if (clickedIndex == 0) {
          $('#send_to_self_section').collapse('hide');
        }
      });
    }
  }, {
    key: "switchToggleRequiredProp",
    value: function switchToggleRequiredProp(prop) {
      $('input[name="recipient[name]"]').prop('required', prop);
      $('input[name="recipient[email]"]').prop('required', prop);
    }
  }, {
    key: "sendMail",
    value: function sendMail() {
      var Self = this;
      $('#send_invoice').on('submit', function (e) {
        e.preventDefault();
        axios.post(route('invoice.send', $('#send_invoice_id').val()), new FormData($(this)[0])).then(function (response) {
          // handle success
          Self.successNotifySendMail.setText(response.data.message, true);
          Self.successNotifySendMail.show();
          $('#send-invoice-modal').modal('hide');
        })["catch"](function (error) {
          // handle error
          Self.erroNotifySendMail.show();
          console.log(error);
        })["finally"](function () {// always executed
        });
      });
    }
  }]);

  return sendInvoice;
}();
/* harmony default export */ __webpack_exports__["default"] = (sendInvoice);

/***/ }),

/***/ 3:
/*!***************************************************!*\
  !*** multi ./resources/js/pages/invoice/index.js ***!
  \***************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /var/www/html/invoice/resources/js/pages/invoice/index.js */"./resources/js/pages/invoice/index.js");


/***/ })

/******/ });