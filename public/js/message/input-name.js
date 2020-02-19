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
/******/ 	return __webpack_require__(__webpack_require__.s = 8);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/message/input-name.js":
/*!********************************************!*\
  !*** ./resources/js/message/input-name.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// 半角を１、全角を２でカウントする関数---------------------------------------------------
function char_count(char_length) {
  var count = 0;

  for (var i = 0; i < char_length.length; i++) {
    // 入力された文字を文字コードに変換
    var _char = char_length.charCodeAt(i);

    if (_char >= 0x00 && _char < 0x81 || _char === 0xf8f0 || _char >= 0xff61 && _char < 0xffa0 || _char >= 0xf8f1 && _char < 0xf8f4) {
      // 半角文字の場合は1を加算
      count += 1;
    } else {
      // それ以外の文字の場合は2を加算
      count += 2;
    }
  }

  return count;
} // ---------------------------------------------------------------------------------------
// ガチャとプライズの名前（作成、編集）入力時のイベント--------------------------------------


$(function () {
  // 入力フォームが空白の時のイベント
  $(function () {
    $('.input-gacha-name, .input-prize-name').blur(function () {
      // $('.input-gacha-name, .input-prize-name').blur(function(){
      if ($(this).val() == '') {
        $('#name-alert-ng').text('入力が必要です');
        $('#name-alert-ng').val('error');
      } else {
        $('#name-alert-ng').val(0);
      }
    });
  }); // 入力時のイベント

  $('.input-gacha-name, .input-prize-name').on('input', function () {
    var char_name = $(this).val();
    var count_name = char_count(char_name); // 現在の文字数を表示

    $('.now-count').text(count_name);

    if (0 < count_name && count_name <= 30) {
      // 1文字以上かつ30字以内の場合はＯＫ表示
      $('#name-alert-ok').text('現在' + count_name + '文字です。問題ありません');
      $('#name-alert-ng').text('');
    } else {
      // 0文字または30文字を超える場合はＮＧ表示
      $('#name-alert-ng').text('現在' + count_name + '文字です。1～30文字以内にしてください');
      $('#name-alert-ok').text('');
    }
  });
}); // ----------------------------------------------------------------------------------------------
// ガチャの説明（ガチャの作成、編集）入力時のイベント--------------------------------------------

$(function () {
  // 入力時のイベント
  $('.input-gacha-description').on('input', function () {
    var char_desc = $(this).val();
    var count_desc = char_count(char_desc); // 現在の文字数を表示

    $('.now-count').text(count_desc);

    if (0 <= count_desc && count_desc <= 60) {
      // 1文字以上かつ60字以内の場合はＯＫ表示
      $('#description-alert-ok').text('現在' + count_desc + '文字です。問題ありません');
      $('#description-alert-ng').text('');
    } else {
      // 0文字または60文字を超える場合はＮＧ表示
      $('#description-alert-ng').text('現在' + count_desc + '文字です。60文字以下にしてください');
      $('#description-alert-ok').text('');
    }
  });
}); //---------------------------------------------------------------------------------------------------

/***/ }),

/***/ 8:
/*!**************************************************!*\
  !*** multi ./resources/js/message/input-name.js ***!
  \**************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/ec2-user/environment/GachaCreator/resources/js/message/input-name.js */"./resources/js/message/input-name.js");


/***/ })

/******/ });