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
/******/ 	return __webpack_require__(__webpack_require__.s = 5);
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
  window.userEdit = new editUser();
  $('#rootwizard .finish').click(function () {
    userEdit.saveUser();
  });
});

var editUser =
/*#__PURE__*/
function () {
  function editUser() {
    _classCallCheck(this, editUser);

    this.triggered = 0;
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
        if (!profile) return false;
      },
      onNext: function onNext(tab, navigation, index) {
        if (index == 1) {
          return self.step1();
        }
      },
      onShow: function onShow() {}
    });
    this.validate = false;
    this.validation = {
      personal: [],
      business: []
    };
    this.user = new FormData();
    this.initPersonalValidate();
    this.initBusinessValidate();
    if (profile) this.initMediaUpload();
    this.initDefaultStep();
  }

  _createClass(editUser, [{
    key: "initDefaultStep",
    value: function initDefaultStep() {
      $('#rootwizard').bootstrapWizard('show', parseInt(step) - 1);
    }
  }, {
    key: "initPersonalValidate",
    value: function initPersonalValidate() {
      var self = this;
      $('#personal-details').validator().on('invalid.bs.validator', function (e) {
        self.validation['personal'].push(e.relatedTarget.name);
        self.validate = false;
      }).on('valid.bs.validator', function (e) {
        var index = self.validation['personal'].indexOf(e.relatedTarget.name);

        if (index > -1) {
          self.validation['personal'].splice(index, 1);
        }
      }).on('validated.bs.validator', function () {
        if (self.validation['personal'].length == 0) self.validate = true;
      });
    }
  }, {
    key: "initBusinessValidate",
    value: function initBusinessValidate() {
      var self = this;
      $('#business-details').validator().on('invalid.bs.validator', function (e) {
        self.validation['business'].push(e.relatedTarget.name);
        self.validate = false;
      }).on('valid.bs.validator', function (e) {
        var index = self.validation['personal'].indexOf(e.relatedTarget.name);

        if (index > -1) {
          self.validation['personal'].splice(index, 1);
        }
      }).on('validated.bs.validator', function () {
        if (self.validation['business'].length == 0) self.validate = true;
      });
    }
  }, {
    key: "initMediaUpload",
    value: function initMediaUpload() {
      $('#file_upload').on('click', function () {
        $('input[name="logo"]').trigger('click');
      });
      $('input[name="logo"]').on('change', this.handleFileSelect);
    }
  }, {
    key: "handleFileSelect",
    value: function handleFileSelect(evt) {
      var files = evt.target.files; // FileList object
      // Loop through the FileList and render image files as thumbnails.

      var f = files[0];
      console.log(f); // Only process image files.

      if (f.type.match('image.*')) {
        var reader = new FileReader(); // Closure to capture the file information.

        reader.onload = function (theFile) {
          return function (e) {
            console.log(e.target.result); // Render thumbnail.

            $('.img-company-logo').css('background-image', 'url(' + e.target.result + ')');
          };
        }(f); // Read in the image file as a data URL.


        reader.readAsDataURL(f);
      }

      userEdit.captureDetails('#media-details');
    }
  }, {
    key: "step1",
    value: function step1() {
      var own = this;
      $('#personal-details').validator('validate');

      if (this.validate) {
        //this.captureDetails('#personal-details');
        return true;
      }

      return false;
    }
  }, {
    key: "saveUser",
    value: function saveUser() {
      var validate = true;
      $('#personal-details').validator('validate');
      $('#business-details').validator('validate');

      if (this.validate) {
        this.captureDetails('#personal-details');
        this.captureDetails('#business-details');
        var data = this.user;
        var ajaxRoute = route('user.update', {
          user: user_id
        });
        if (route().current("user.profile")) ajaxRoute = route('user.profile.save');
        axios.post(ajaxRoute, data, {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        }).then(function (response) {
          if (route().current("user.profile")) {
            new Noty({
              type: 'success',
              layout: 'topRight',
              text: 'Profile Updated Successfully',
              progressBar: true,
              timeout: 2500,
              animation: {
                open: 'animated bounceInRight',
                // Animate.css class names
                close: 'animated bounceOutRight' // Animate.css class names

              }
            }).show();
          } else {
            window.location.href = route('users');
          } //

        })["catch"](function (error) {
          // handle error
          if (error.response.data.errors['business.address_1'] || error.response.data.errors['business.address_2'] || error.response.data.errors['business.name']) {
            $('#rootwizard').bootstrapWizard('show', 1);
          }
        })["finally"](function () {// always executed
        });
        return true;
      }

      return false;
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

/***/ 5:
/*!************************************************!*\
  !*** multi ./resources/js/pages/users/edit.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\laragon\www\invoice-backend\resources\js\pages\users\edit.js */"./resources/js/pages/users/edit.js");


/***/ })

/******/ });