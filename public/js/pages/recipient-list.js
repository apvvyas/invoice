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
/******/ 	return __webpack_require__(__webpack_require__.s = 9);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/pages/recipients/index.js":
/*!************************************************!*\
  !*** ./resources/js/pages/recipients/index.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

$(function () {
  var ListRecipient = new listRecipient();
  $('#add-recipient-modal').on('show.bs.modal', function () {
    $('#add_recipient').submit(function (e) {
      e.preventDefault();
      ListRecipient.saveRecipientDetails();
    });
  });
  $('#add-recipient-modal').on('hidden.bs.modal', function () {
    $('#add_recipient')[0].reset();
    $('body').removeClass('modal-open');
    $('.modal-backdrop').remove();
  });
});

var listRecipient =
/*#__PURE__*/
function () {
  function listRecipient() {
    _classCallCheck(this, listRecipient);

    this.dtable = dtable('#export-table', {
      fnDrawCallback: function fnDrawCallback() {
        initConfirmationOnDelete();
      },
      ajax: {
        url: $('table#export-table').data('url'),
        method: 'get'
      },
      columns: [{
        data: 'company_name',
        title: "Company",
        name: 'company_name'
      }, {
        data: 'phone',
        title: "Phone",
        name: 'phone'
      }, {
        data: 'email',
        title: "Email",
        name: 'email'
      }, {
        data: 'id',
        title: 'Action',
        searchable: false,
        sortable: false,
        className: 'text-center text-nowrap',
        render: function render(data, type, row) {
          var tableaction = "";
          if (row.permissions.edit !== false) tableaction += buildEditAction(route('recipient.edit', {
            recipient: data
          }));
          if (row.permissions.view !== false) tableaction += buildViewAction(route('recipient.show', {
            recipient: data
          }));
          if (row.permissions["delete"] !== false) tableaction += buildDeleteAction(route('recipient.destroy', {
            recipient: data
          }));
          return tableaction;
        }
      }]
    });
  }

  _createClass(listRecipient, [{
    key: "saveRecipientDetails",
    value: function saveRecipientDetails() {
      var self = this;
      axios.post(route('user.recipient.add'), new FormData($('#add_recipient')[0])).then(function (response) {
        // handle success
        $('#add-recipient-modal').modal('hide');
      })["catch"](function (error) {
        // handle error
        console.log(error);
      })["finally"](function () {// always executed
      });
      return false;
    }
  }]);

  return listRecipient;
}();

/***/ }),

/***/ 9:
/*!******************************************************!*\
  !*** multi ./resources/js/pages/recipients/index.js ***!
  \******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /var/www/html/invoice/resources/js/pages/recipients/index.js */"./resources/js/pages/recipients/index.js");


/***/ })

/******/ });