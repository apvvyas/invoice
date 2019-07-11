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
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/pages/invoice/add.js":
/*!*******************************************!*\
  !*** ./resources/js/pages/invoice/add.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

$(function () {
  var invoiceNew = new addInvoice(invoice_id);
  invoiceNew.fetchRecipientList();
  $('#add-recipient-modal').on('shown.bs.modal', function () {
    $('#add_recipient').submit(function (e) {
      e.preventDefault();
      invoiceNew.saveRecipientDetails();
    });
  });
  $('#add-recipient-modal').on('hidden.bs.modal', function () {
    $('#add_recipient')[0].reset();
    $('body').removeClass('modal-open');
    $('.modal-backdrop').remove();
  });
  $('#add_product').submit(function (e) {
    e.preventDefault();
    invoiceNew.saveProductDetails();
  });
  $('#add-product-modal').on('hidden.bs.modal', function () {
    $('#add_product')[0].reset();
    $('body').removeClass('modal-open');
    $('.modal-backdrop').remove();
  });
  $('input[name="company_name"] , input[name="gst_number"]').on('keyup', function (e) {
    if (e.keyCode == 13) {
      invoiceNew.fetchRecipientList();
    }
  });
  $('input[name="item_name[]"]').on('keyup', function (e) {
    if (e.keyCode != 13) {
      invoiceNew.resetProductHidden(false);
    }
  });
  $('#createItem').on('submit', function (e) {
    e.preventDefault();
    invoiceNew.createItem($(this).serializeArray());
    $('#no-item').addClass('d-none');
    $(this)[0].reset();
  });
  $('#createTax').on('submit', function (e) {
    e.preventDefault();
    invoiceNew.createTax($(this).serializeArray());
    $(this)[0].reset();
  });
  $('#rootwizard .finish').click(function () {
    invoiceNew.saveInvoice();
  });
  $('#due_date').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
    invoiceNew.enableCustomDate($(this).selectpicker('val'));
  });
  $(document).on('click', '.remove_item', function () {
    invoiceNew.removeItem($(this).data('id'), 'line');
  }).on('click', '.remove_tax', function () {
    invoiceNew.removeItem($(this).data('id'), 'tax');
  });
});

var addInvoice =
/*#__PURE__*/
function () {
  function addInvoice(id) {
    _classCallCheck(this, addInvoice);

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
        } else if (index == 2) {
          return self.step2();
        } else if (index == 3) {
          return self.step3();
        }
      }
    });
    this.invoice = new Invoice(id);
    this.itemCount = 0;
    this.taxCount = 0;
    this.selectedItem = {};
    this.initDatePicker();
  }

  _createClass(addInvoice, [{
    key: "initDatePicker",
    value: function initDatePicker() {
      $('#invoice_date').daterangepicker({
        singleDatePicker: true,
        minDate: moment(),
        locale: {
          format: 'DD-MM-YYYY'
        }
      });
    }
  }, {
    key: "step1",
    value: function step1() {
      var validate = true;
      if ($('input[name="recipient_id"]:checked').val() == undefined) validate = false;

      if (!validate) {
        var notifyOfRecipient = new Noty({
          type: 'error',
          layout: 'topRight',
          text: 'Select atleast one recipient',
          progressBar: true,
          timeout: 2500,
          animation: {
            open: 'animated bounceInRight',
            // Animate.css class names
            close: 'animated bounceOutRight' // Animate.css class names

          }
        }).show();
        return false;
      }

      this.initProductSearch();
      this.setTotal();
    }
  }, {
    key: "step2",
    value: function step2() {
      if (this.invoice.total_amount == 0) {
        new Noty({
          type: 'error',
          layout: 'topRight',
          text: 'Add atleast one item',
          progressBar: true,
          timeout: 2500,
          animation: {
            open: 'animated bounceInRight',
            // Animate.css class names
            close: 'animated bounceOutRight' // Animate.css class names

          }
        }).show();
        return false;
      }

      this.setTotal();
    }
  }, {
    key: "step3",
    value: function step3() {
      this.enableCustomDate(2);
    }
  }, {
    key: "saveInvoice",
    value: function saveInvoice() {
      var data = this.invoice;
      axios.post(route('invoice.save'), data).then(function (response) {
        window.location.href = route('invoices');
      })["catch"](function (error) {
        // handle error
        console.log(error);
      })["finally"](function () {// always executed
      });
    }
  }, {
    key: "saveRecipientDetails",
    value: function saveRecipientDetails() {
      var self = this;
      axios.post(route('user.recipient.add'), new FormData($('#add_recipient')[0])).then(function (response) {
        // handle success
        self.fetchRecipientList();
        $('#add-recipient-modal').modal('hide');
      })["catch"](function (error) {
        // handle error
        console.log(error);
      })["finally"](function () {// always executed
      });
      return false;
    }
  }, {
    key: "saveProductDetails",
    value: function saveProductDetails() {
      var self = this;
      axios.post(route('product.save'), new FormData($('#add_product')[0])).then(function (response) {
        // handle success
        self.selectItem(response.data.product, true);
        $('#createItem').submit();
        $('#display_tax').html('0');
        $('#add-product-modal').modal('hide');
      })["catch"](function (error) {
        // handle error
        console.log(error);
      })["finally"](function () {// always executed
      });
      return false;
    }
  }, {
    key: "fetchRecipientList",
    value: function fetchRecipientList() {
      var self = this;
      axios.get(route('user.recipient.list'), {
        params: {
          company_name: $('input[name="company_name"]').val(),
          gst_number: $('input[name="gst_number"]').val(),
          page: 0,
          limit: 10
        }
      }).then(function (response) {
        // handle success
        $('#recipient_list').html(response.data.html);
        $('.checkbox').click(function () {
          var current_id = $(this).attr('id');
          $('.checkbox').each(function () {
            if ($(this).attr('id') == current_id) {
              $(this).addClass('is-checked');
              $('#check_' + current_id).prop('checked', true);
              self.invoice.recipient = current_id;
            } else {
              $(this).removeClass('is-checked');
            }
          });
        });
      })["catch"](function (error) {
        // handle error
        console.log(error);
      })["finally"](function () {// always executed
      });
    }
  }, {
    key: "initProductSearch",
    value: function initProductSearch() {
      var Self = this;
      var searchObjs = {};
      $('#item').autocomplete({
        source: function source(request, response) {
          $.ajax({
            url: route('product.dropdown'),
            data: {
              search: request.term
            },
            success: function success(data) {
              console.log(data);
              response(data);
            }
          });
        },
        select: function select(event, ui) {
          Self.selectItem(ui.item);
        }
      });
    }
  }, {
    key: "selectItem",
    value: function selectItem(obj, considerQuantity) {
      this.selectedItem = obj;
      $('input[name="item_name[]"]').val(obj.name);
      $('input[name="item_price[]"]').val(obj.price);

      if (typeof considerQuantity != 'undefined' && considerQuantity) {
        $('input[name="item_quantity[]"]').val(obj.quantity);
      }

      $('input[name="item_id[]"]').val(obj.id);

      if (typeof obj.tax[0] != 'undefined') {
        $('input[name="item_tax_id[]"]').val(obj.tax[0].id);
        $('input[name="item_tax_name[]"]').val(obj.tax[0].name);
        $('input[name="item_tax_percent_value[]"]').val(obj.tax[0].rate);
        $('#display_tax').html(obj.tax[0].rate);
      } else {
        this.resetProductHidden(true);
        $('#display_tax').html('0');
      }
    }
  }, {
    key: "resetProductHidden",
    value: function resetProductHidden(onlyTax) {
      if (typeof onlyTax != 'undefined' && onlyTax == true) {
        $('input[name="item_id[]"]').val('');
        $('input[name="item_tax_id[]"]').val('');
      }

      $('input[name="item_tax_id[]"]').val("");
      $('input[name="item_tax_name[]"]').val("");
      $('input[name="item_tax_percent_value[]"]').val("");
    }
  }, {
    key: "createItem",
    value: function createItem(formData) {
      var title = formData[4].value;
      var product_total = this.invoice.product_total_amount(formData[5].value, formData[6].value);
      var tax_value = this.invoice.product_tax_amount(product_total, formData[3].value);

      if (tax_value > 0) {
        title += "( +" + formData[3].value + "% of " + formData[2].value + ")";
      }

      this.invoice.lineItems = {
        'id': formData[0].value,
        'tax_id': formData[1].value,
        'tax_name': formData[2].value,
        'tax_percent_value': formData[3].value,
        'name': formData[4].value,
        "title": title,
        'quantity': formData[5].value,
        'price': formData[6].value,
        'tax_value': tax_value
      };
      this.prepareItem(this.invoice.lineItems[this.invoice.lineItems.length - 1], 'item');
      this.setTotal();
    }
  }, {
    key: "refreshItemList",
    value: function refreshItemList() {
      var lineItems = this.invoice.lineItems;
      var selfObj = this;
      $('#item_list').html('');
      this.itemCount = 0;
      $.each(lineItems, function (i, obj) {
        selfObj.prepareItem(obj, 'item');
      });
    }
  }, {
    key: "prepareItem",
    value: function prepareItem(data, type) {
      var fill_data = {
        item: {
          container: $('#item_list'),
          clone_item: $('.clone'),
          itemCount: this.itemCount,
          parent_id: 'item_' + this.itemCount,
          replace_elem: [{
            elem: '#sr',
            value: this.itemCount + 1
          }, {
            elem: '#item',
            value: data.title
          }, {
            elem: '#quantity',
            value: data.quantity
          }, {
            elem: '#per_item_cost',
            value: data.price
          }],
          remove: {
            elem: '#remove_item',
            attr_val: this.itemCount
          }
        },
        tax: {
          container: $('#tax_list'),
          clone_item: $('.tax-clone'),
          itemCount: this.taxCount,
          parent_id: 'tax_' + this.taxCount,
          replace_elem: [{
            elem: '#sr',
            value: this.taxCount + 1
          }, {
            elem: '#name',
            value: data.name
          }, {
            elem: '#percent',
            value: data.amount
          }, {
            elem: '#amount',
            value: data.tax_in_amount
          }],
          remove: {
            elem: '#remove_tax',
            attr_val: this.taxCount
          }
        }
      };
      var set = fill_data[type];
      var cloneItem = set['clone_item'].clone();
      var itemCount = set.itemCount;
      cloneItem.find('li').attr('id', set.parent_id);
      $.each(set.replace_elem, function (i, d) {
        cloneItem.find(d.elem).html(d.value);
      });
      cloneItem.find(set.remove.elem).attr('data-id', set.remove.attr_val);
      set['container'].append(cloneItem.html());
      this[type + 'Count'] = this[type + 'Count'] + 1;
    }
  }, {
    key: "createTax",
    value: function createTax(formData) {
      var tax_in_amount = this.invoice.tax_amount(parseFloat(formData[2].value));
      this.invoice.tax = {
        'id': formData[0].value,
        'name': formData[1].value,
        'amount': parseFloat(formData[2].value),
        'tax_in_amount': tax_in_amount
      };
      this.prepareItem(this.invoice.taxItems[this.invoice.taxItems.length - 1], 'tax');
      this.setTotal();
    }
  }, {
    key: "refreshTaxList",
    value: function refreshTaxList() {
      var taxItems = this.invoice.taxItems;
      var selfObj = this;
      $('#tax_list').html('');
      this.taxCount = 0;
      $.each(taxItems, function (i, obj) {
        selfObj.prepareItem(obj, 'tax');
      });
    }
  }, {
    key: "removeItem",
    value: function removeItem(id, type) {
      this.invoice.removeItem(parseInt(id), type);
      var contain = '#item_list';
      var contain_elem = '#item_' + id;

      if (type == 'tax') {
        contain = '#tax_list';
        contain_elem = '#tax_' + id;
      }

      this.refreshItemList();
      this.refreshTaxList();
      this.setTotal();
    }
  }, {
    key: "enableCustomDate",
    value: function enableCustomDate(dur) {
      if (dur == 3) {
        $('#invoice_date').attr('disabled', false);
      } else {
        $('#invoice_date').attr('disabled', true);
      }

      this.invoice.due_date = {
        val: dur,
        date: moment().format('DD-MM-YYYY')
      };
      $('#invoice_date').data('daterangepicker').setStartDate(this.invoice.due_date);
    }
  }, {
    key: "setTotal",
    value: function setTotal() {
      $('#amount_total').html(this.invoice.total_amount);
      $('#before_total').html(this.invoice.total_amount); //$('#tax_total').html(this.invoice.total_tax);

      $('#final_total').html(this.invoice.total_after_tax);
    }
  }]);

  return addInvoice;
}();

var Invoice =
/*#__PURE__*/
function () {
  function Invoice(id) {
    _classCallCheck(this, Invoice);

    this.invoice_id = id;
    this.lineItemSet = [];
    this.taxItemSet = [];
    this.due_date_set = {};
    this.recipient_id = 0;
  }

  _createClass(Invoice, [{
    key: "tax_amount",
    value: function tax_amount(t) {
      return parseFloat(this.total_amount * t / 100).toFixed(2);
    }
  }, {
    key: "product_total_amount",
    value: function product_total_amount(price, quantity) {
      return parseFloat(quantity).toFixed(2) * parseFloat(price).toFixed(2);
    }
  }, {
    key: "product_tax_amount",
    value: function product_tax_amount(total, t) {
      return parseFloat(total * t / 100).toFixed(2);
    }
  }, {
    key: "removeItem",
    value: function removeItem(index, type) {
      if (type == 'line') this.lineItemSet.splice(index, 1);else this.taxItemSet.splice(index, 1);
    }
  }, {
    key: "recipient",
    set: function set(recipient) {
      this.recipient_id = recipient;
    }
  }, {
    key: "tax",
    set: function set(tax) {
      this.taxItemSet.push(tax);
    }
  }, {
    key: "lineItems",
    set: function set(lineItem) {
      this.lineItemSet.push(lineItem);
    },
    get: function get() {
      return this.lineItemSet;
    }
  }, {
    key: "due_date",
    set: function set(dur) {
      if (dur.val == -1) {
        this.due_date_set = {};
      } else if (dur.val == 1) {
        this.due_date_set['date'] = moment().add(30, 'days');
      } else if (dur.val == 2) {
        this.due_date_set['date'] = moment();
      } else if (dur.val == 3 && typeof dur.date != 'undefined') {
        this.due_date_set['date'] = moment(dur.date, 'DD-MM-YYYY');
      }
    },
    get: function get() {
      return this.due_date_set['date'];
    }
  }, {
    key: "taxItems",
    get: function get() {
      return this.taxItemSet;
    }
  }, {
    key: "total_tax",
    get: function get() {
      var taxes = extractColumn(this.taxItemSet, 'amount');

      var numOr0 = function numOr0(n) {
        return isNaN(n) ? 0 : n;
      };

      return taxes.reduce(function (a, b) {
        return numOr0(a) + numOr0(b);
      }, 0);
    }
  }, {
    key: "total_amount",
    get: function get() {
      var Self = this;

      var numOr0 = function numOr0(n) {
        return isNaN(n) ? 0 : n;
      };

      var total = this.lineItemSet.reduce(function (a, b) {
        var current_total = numOr0(parseInt(b.quantity)) * numOr0(parseFloat(b.price));

        if (b.tax_value != "") {
          current_total = parseFloat(b.tax_value) + parseFloat(current_total);
        }

        return numOr0(a) + current_total;
      }, 0);
      return total;
    }
  }, {
    key: "total_after_tax",
    get: function get() {
      var total_before_tax = this.total_amount;
      var total_tax = this.total_tax;
      var total_tax_amount = parseFloat(total_before_tax * total_tax / 100).toFixed(2);
      var total_after_tax = parseFloat(total_before_tax + parseFloat(total_tax_amount)).toFixed(2);
      return total_after_tax;
    }
  }]);

  return Invoice;
}();

/***/ }),

/***/ 2:
/*!*************************************************!*\
  !*** multi ./resources/js/pages/invoice/add.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /var/www/html/invoice/resources/js/pages/invoice/add.js */"./resources/js/pages/invoice/add.js");


/***/ })

/******/ });