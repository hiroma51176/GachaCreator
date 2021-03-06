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
/******/ 	return __webpack_require__(__webpack_require__.s = 7);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/data-validation/submit-gacha-edit.js":
/*!***********************************************************!*\
  !*** ./resources/js/data-validation/submit-gacha-edit.js ***!
  \***********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// ガチャの編集画面で入力に不備があるときは作成ボタン押せないようにしたい-------------------------------
$(function () {
  $('.input-gacha-name, .input-gacha-description, .image-file, .input-gacha-price, .input-gacha-rate').on('blur change', function () {
    var price = $('.input-gacha-price').val(); // 排出率の合計算出

    var sum = window.myLib.sumRate(); // ガチャの名前の文字数をカウント

    var char_name = $('.input-gacha-name').val();
    var count_name = window.myLib.charCount(char_name); // ガチャの説明の文字数をカウント

    var char_desc = $('.input-gacha-description').val();
    var count_desc = window.myLib.charCount(char_desc); // 画像ファイルのサイズを確認

    var file_size = window.myLib.checkImageSize(); // 入力に問題ないならボタンを押せるようにする

    if (0 < count_name && count_name <= 30 && count_desc <= 60 && file_size < 2048000 && $('.input-gacha-price').val() <= 10000 && $('#jackpot').val() <= 100 && $('#hit').val() <= 100 && $('#miss').val() <= 100 && sum == 100 && $('#jackpot').val() != '' && $('#hit').val() != '' && $('#miss').val() != '') {
      window.myLib.btnAbled();
    } else {
      window.myLib.btnDisabled();
    }
  });
}); //-------------------------------------------------------------------------------------------------------------------------------------
// 画面ロード時に「この内容で上書きする」ボタンを有効にする------------------------------------------------------------------------------

$(window).on('load', function () {
  $('#submit-edit').prop('disabled', false);
}); // --------------------------------------------------------------------------------------------------------------------------------------

/***/ }),

/***/ 7:
/*!*****************************************************************!*\
  !*** multi ./resources/js/data-validation/submit-gacha-edit.js ***!
  \*****************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/ec2-user/environment/GachaCreator/resources/js/data-validation/submit-gacha-edit.js */"./resources/js/data-validation/submit-gacha-edit.js");


/***/ })

/******/ });