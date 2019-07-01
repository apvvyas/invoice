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
/******/ 	return __webpack_require__(__webpack_require__.s = 4);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/pages/users/edit.js":
/*!******************************************!*\
  !*** ./resources/js/pages/users/edit.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

$(function () {
  var userEdit = new editUser();
  $('#rootwizard .finish').click(function () {
    userEdit.saveUser();
  });
});

var editUser =
/*#__PURE__*/
function () {
  function editUser() {
    _classCallCheck(this, editUser);

    var self = this;
    this.wizard = $('#rootwizard').bootstrapWizard({
      onInit: function onInit(tab, navigation, index) {
        var $total = navigation.find('li').length;
        var width = 100 / $total + '%';
        navigation.find('li').each(function () {
          $(this).css({
            'width': width
          });
        });
      },
      onTabShow: function onTabShow(tab, navigation, index) {
        var $total = navigation.find('li').length;
        var $current = index + 1;
        var $percent = $current / $total * 100;
        $('#rootwizard .progressbar').css({
          width: $percent + '%'
        });
      },
      onTabClick: function onTabClick(tab, navigation, index) {
        return false;
      },
      onNext: function onNext(tab, navigation, index) {
        if (index == 1) {
          return self.step1();
        }
      }
    });
    this.user = new FormData();
  }

  _createClass(editUser, [{
    key: "step1",
    value: function step1() {
      if ($('#personal-details')[0].checkValidity() === false) {
        $('#personal-details')[0].classList.add('was-validated');
        return false;
      }

      $('#personal-details')[0].classList.add('was-validated');
      this.captureDetails('#personal-details');
      return true;
    }
  }, {
    key: "saveUser",
    value: function saveUser() {
      if ($('#personal-details')[0].checkValidity() === false) {
        $('#personal-details')[0].classList.add('was-validated');
        return false;
      }

      if ($('#business-details')[0].checkValidity() === false) {
        $('#business-details')[0].classList.add('was-validated');
        return false;
      }

      this.captureDetails('#business-details');
      var data = this.user;
      axios.post(route('user.update', {
        user: user_id
      }), data).then(function (response) {
        window.location.href = route('users');
      })["catch"](function (error) {
        // handle error
        console.log(error);
      })["finally"](function () {// always executed
      });
    }
  }, {
    key: "captureDetails",
    value: function captureDetails(id) {
      var data = new FormData($(id)[0]);
      var _iteratorNormalCompletion = true;
      var _didIteratorError = false;
      var _iteratorError = undefined;

      try {
        for (var _iterator = data.entries()[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
          var pair = _step.value;
          this.user.append(pair[0], pair[1]);
        }
      } catch (err) {
        _didIteratorError = true;
        _iteratorError = err;
      } finally {
        try {
          if (!_iteratorNormalCompletion && _iterator["return"] != null) {
            _iterator["return"]();
          }
        } finally {
          if (_didIteratorError) {
            throw _iteratorError;
          }
        }
      }
    }
  }]);

  return editUser;
}();

/***/ }),

/***/ 4:
/*!************************************************!*\
  !*** multi ./resources/js/pages/users/edit.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\laragon\www\invoice-backend\resources\js\pages\users\edit.js */"./resources/js/pages/users/edit.js");


/***/ })

/******/ });