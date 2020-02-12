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

/***/ "./resources/js/data-validation/simulation.js":
/*!****************************************************!*\
  !*** ./resources/js/data-validation/simulation.js ***!
  \****************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// 矢印キーとバックスペースキーとデリートキーとテンキー（数字）以外は入力不可----------------
$(document).on('keydown', '.input-number', function (e) {
  var k = e.keyCode;
  var str = String.fromCharCode(k);

  if (!(str.match(/[0-9]/) || 37 <= k && k <= 40 || k === 8 || k === 46 || 96 <= k && k <= 105)) {
    return false;
  }
}); // --------------------------------------------------------------------------------------
// 全角文字入力不可----------------------------------------------------------------------

$(document).on('keyup', '.input-number', function () {
  this.value = this.value.replace(/[^0-9]+/i, '');
});
$(document).on('blur', '.input-number', function () {
  this.value = this.value.replace(/[^0-9]+/i, '');
}); // --------------------------------------------------------------------------------------
// シミュレーションで設定金額を入力時、入力された値が指定範囲外の場合--------------------------------------

$(function () {
  $('.input-price').blur(function () {
    if ($(this).val() == '') {
      $(this).next().text('入力が必要です');
    } else if (!(0 <= $(this).val() && $(this).val() <= 10000)) {
      $(this).next().text('0～10000の値を入力してください');
    } else {
      $(this).next().text('');
    }
  });
}); // -----------------------------------------------------------------------------------
// シミュレーションで最大試行回数を入力時、入力された値が指定範囲外の場合-------------------------------

$(function () {
  $('.input-count').blur(function () {
    if ($(this).val() == '') {
      $(this).next().text('入力が必要です');
    } else if (!(0 < $(this).val() && $(this).val() <= 1000)) {
      $(this).next().text('1～1000の値を入力してください');
    } else {
      $(this).next().text('');
    }
  });
}); // -----------------------------------------------------------------------------------
// シミュレーションで排出率を入力時、入力された値が指定範囲外の場合-----------------

$(function () {
  $('.input-rate').blur(function () {
    if ($(this).val() == '') {
      $(this).next().text('入力が必要です');
    } else if (!(0 < $(this).val() && $(this).val() <= 100)) {
      $(this).next().text('1～100の値を入力してください');
    } else {
      $(this).next().text('');
    }
  });
}); // --------------------------------------------------------------------------------------
// シミュレーションでエラーがあるときは実行するボタン押せないようにする----------------------------------------------

$(function () {
  $('.input-price, .input-count, .input-rate').blur(function () {
    // // 各数値が取得できているか確認の為
    // var pri = $('.input-price').val();
    // var cou = $('.input-count').val();
    // var ra = $('.input-rate').val();
    if ($('.input-price').val() <= 10000 && 0 < $('.input-count').val() && $('.input-count').val() <= 1000 && 0 < $('.input-rate').val() && $('.input-rate').val() <= 100) {
      $('#submit-sim').prop('disabled', false); // 各数値確認用
      // $('#check_val').text(pri + '｜' + cou + '|' + ra);
    } else {
      $('#submit-sim').prop('disabled', true); // 各数値確認用
      // $('#check_val').text(pri + '｜' + cou + '|' + ra);
    }
  });
}); // ------------------------------------------------------------------------------------------------------------------

/***/ }),

/***/ 3:
/*!**********************************************************!*\
  !*** multi ./resources/js/data-validation/simulation.js ***!
  \**********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/ec2-user/environment/GachaCreator/resources/js/data-validation/simulation.js */"./resources/js/data-validation/simulation.js");


/***/ })

/******/ });