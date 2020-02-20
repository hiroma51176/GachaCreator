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
/******/ 	return __webpack_require__(__webpack_require__.s = 6);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/data-validation/submit-gacha-create.js":
/*!*************************************************************!*\
  !*** ./resources/js/data-validation/submit-gacha-create.js ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// ガチャの作成画面で入力に不備があるときは作成ボタン押せないようにしたい-------------------------------
$(function () {
  $('.input-gacha-name, .input-gacha-description, .image-file, .input-gacha-price, .input-gacha-rate, [name="templete"]').on('blur change', function () {
    var price = $('.input-gacha-price').val(); // 排出率の合計算出

    var jackpot = $('#jackpot').val() | 0;
    var hit = $('#hit').val() | 0;
    var miss = $('#miss').val() | 0;
    var sum = parseInt(jackpot, 10) + parseInt(hit, 10) + parseInt(miss, 10); // ガチャの名前の文字数をカウント

    var char_name = $('.input-gacha-name').val();
    var count_name = char_count(char_name); // ガチャの説明の文字数をカウント

    var char_desc = $('.input-gacha-description').val();
    var count_desc = char_count(char_desc); // 画像ファイルのサイズを確認
    // var file_size = checkImageSize();

    if ($('.image-file').prop('files')[0] != null) {
      var file = $('.image-file').prop('files')[0];
      var file_size = file.size;
    } else {
      var file_size = null;
    } // テンプレートに使用について確認


    var temp = $('[name="templete"]:checked').val();

    if (temp == '') {
      temp = $('[name="templete"] option:selected').val();
    } // 入力に問題ないならボタンを押せるようにする


    if (0 < count_name && count_name <= 30 && count_desc <= 60 && file_size < 2048000 && $('.input-gacha-price').val() <= 10000 && $('#jackpot').val() <= 100 && $('#hit').val() <= 100 && $('#miss').val() <= 100 && sum == 100 && $('#jackpot').val() != '' && $('#hit').val() != '' && $('#miss').val() != '' && temp != '') {
      // btnAbled();
      $('.submit-btn').prop('disabled', false);
      $('#check_val').text('問題ありません。');
    } else {
      // btnDisabled();
      $('.submit-btn').prop('disabled', true);
      $('#check_val').text('入力欄に不備があります。ご確認ください。');
    }
  });
}); //-------------------------------------------------------------------------------------------------------------------------------------

/***/ }),

/***/ 6:
/*!*******************************************************************!*\
  !*** multi ./resources/js/data-validation/submit-gacha-create.js ***!
  \*******************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/ec2-user/environment/GachaCreator/resources/js/data-validation/submit-gacha-create.js */"./resources/js/data-validation/submit-gacha-create.js");


/***/ })

/******/ });