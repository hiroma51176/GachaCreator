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

/***/ "./resources/js/data-validation/gacha-edit.js":
/*!****************************************************!*\
  !*** ./resources/js/data-validation/gacha-edit.js ***!
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
// 設定金額（ガチャの作成・編集）を入力時、入力された値が指定範囲外の場合--------------------------------------

$(function () {
  $('.input-gacha-price').blur(function () {
    if ($(this).val() == '') {
      $(this).next().text('入力が必要です');
    } else if (!(0 <= $(this).val() && $(this).val() <= 10000)) {
      $(this).next().text('0～10000の値を入力してください');
    } else {
      $(this).next().text('');
    }
  });
}); // -------------------------------------------------------------------------------------------------
// 大当たりの排出率（ガチャの作成、編集）を入力時、入力された値が指定範囲外の場合------------------

$(function () {
  $('#jackpot').blur(function () {
    if ($(this).val() == '') {
      $(this).next().text('入力が必要です');
    } else if (!(0 <= $(this).val() && $(this).val() <= 100)) {
      $(this).next().text('0～100の値を入力してください');
    } else {
      $(this).next().text('');
    }
  });
}); // ------------------------------------------------------------------------------------
// 当たりの排出率（ガチャの作成、編集）を入力時、入力された値が指定範囲外の場合------------------

$(function () {
  $('#hit').blur(function () {
    if ($(this).val() == '') {
      $(this).next().text('入力が必要です');
    } else if (!(0 <= $(this).val() && $(this).val() <= 100)) {
      $(this).next().text('0～100の値を入力してください');
    } else {
      $(this).next().text('');
    }
  });
}); // ------------------------------------------------------------------------------------
// はずれの排出率（ガチャの作成、編集）を入力時、入力された値が指定範囲外の場合------------------

$(function () {
  $('#miss').blur(function () {
    if ($(this).val() == '') {
      $(this).next().text('入力が必要です');
    } else if (!(0 <= $(this).val() && $(this).val() <= 100)) {
      $(this).next().text('0～100の値を入力してください');
    } else {
      $(this).next().text('');
    }
  });
}); // ------------------------------------------------------------------------------------
// ガチャの作成、編集の排出率を入力時、3つの値の合計を出力する-------------------------

$(function () {
  $('.input-gacha-rate').blur(function () {
    var jackpot = $('#jackpot').val() | 0;
    var hit = $('#hit').val() | 0;
    var miss = $('#miss').val() | 0;
    sum = parseInt(jackpot) + parseInt(hit) + parseInt(miss);

    if (sum == 100) {
      $('#rate-alert-ok').text('排出率の合計は100です');
      $('#rate-alert-ng').text('');
    } else {
      $('#rate-alert-ng').text('排出率の合計は' + sum + 'です。合計100にしてください');
      $('#rate-alert-ok').text('');
    }
  });
}); // --------------------------------------------------------------------------------------
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
// ガチャの名前（ガチャの作成、編集）入力時のイベント--------------------------------------


$(function () {
  // 入力フォームが空白の時のイベント
  $(function () {
    $('.input-gacha-name').blur(function () {
      if ($(this).val() == '') {
        $('#name-alert-ng').text('入力が必要です');
        $('#name-alert-ng').val('error');
      } else {
        $('#name-alert-ng').val(0);
      }
    });
  }); // 入力時のイベント

  $('.input-gacha-name').on('input', function () {
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
  }); // リロード時に文字が入っていた時の対策
  //$('.input-gacha-name').trigger('input');
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
  }); // リロード時に文字が入っていた時の対策
  //$('.input-gacha-name').trigger('input');
}); //---------------------------------------------------------------------------------------------------
// 画像ファイル選択時（ガチャ作成、編集、プライズ作成、編集）のイベント

$(function () {
  // inputタグから取得
  $('.image-file').on('change', function () {
    var image_size = this.files[0].size;
    var file = $(this).prop('files')[0];

    if (image_size < 2048000) {
      $('#image-alert-ok').text('画像サイズは' + getFileSize(file.size) + 'です。問題ありません');
      $('#image-alert-ng').text('');
    } else {
      $('#image-alert-ng').text('画像サイズは' + getFileSize(file.size) + 'です。2MB以下の画像を選択してください');
      $('#image-alert-ok').text('');
    }
  });
}); // ファイルサイズの単位

function getFileSize(file_size) {
  // 単位を設定
  var unit = ['byte', 'KB', 'MB', 'GB', 'TB'];

  for (var i = 0; i < unit.length; i++) {
    if (file_size < 1024 || i == unit.length - 1) {
      if (i == 0) {
        // カンマ付与
        var integer = file_size.toString().replace(/([0-9]{1,3})(?=(?:[0-9]{3})+$)/g, '$1,');
        str = integer + unit[i];
      } else {
        // 小数点第2位は切り捨て
        file_size = Math.floor(file_size * 100) / 100; // 整数と少数に分割

        var num = file_size.toString().split('.'); // カンマ付与

        var integer = num[0].replace(/([0-9]{1,3})(?=(?:[0-9]{3})+$)/g, '$1,');

        if (num[1]) {
          file_size = integer + '.' + num[1];
        }

        str = file_size + unit[i];
      }

      break;
    }

    file_size = file_size / 1024;
  }

  return str;
} // ----------------------------------------------------------------------------------------------------
// ガチャの編集画面で入力に不備があるときは作成ボタン押せないようにしたい-------------------------------


$(function () {
  $('.input-gacha-name, .input-gacha-description, .image-file, .input-gacha-price, .input-gacha-rate').on('blur change', function () {
    var price = $('.input-gacha-price').val(); // 排出率の合計算出

    var jackpot = $('#jackpot').val() | 0;
    var hit = $('#hit').val() | 0;
    var miss = $('#miss').val() | 0;
    var sum = parseInt(jackpot, 10) + parseInt(hit, 10) + parseInt(miss, 10); // ガチャの名前の文字数をカウント

    var char_name = $('.input-gacha-name').val();
    var count_name = char_count(char_name); // ガチャの説明の文字数をカウント

    var char_desc = $('.input-gacha-description').val();
    var count_desc = char_count(char_desc); // 画像ファイルのサイズを確認

    if ($('.image-file').prop('files')[0] != null) {
      var file = $('.image-file').prop('files')[0];
      var file_size = file.size;
    } else {
      var file_size = null;
    } // 入力に問題ないならボタンを押せるようにする


    if (0 < count_name && count_name <= 30 && count_desc <= 60 && file_size < 2048000 && $('.input-gacha-price').val() <= 10000 && $('#jackpot').val() <= 100 && $('#hit').val() <= 100 && $('#miss').val() <= 100 && sum == 100 && $('#jackpot').val() != '' && $('#hit').val() != '' && $('#miss').val() != '') {
      $('#submit-edit').prop('disabled', false); // $('#check_val').text(count_name + 'name|' + count_desc + '|' + price + '|' + jackpot + '｜' + hit + '|' + miss + '|' + sum + 'file' + file_size + 'temp' + temp);

      $('#check_val').text('');
    } else {
      $('#submit-edit').prop('disabled', true); // $('#check_val').text(count_name + 'name|' + count_desc + '|' + price + '|' + jackpot + '｜' + hit + '|' + miss + '|' + sum + 'file' + file_size + 'temp' + temp);

      $('#check_val').text('入力欄に不備があります。ご確認ください。');
    }
  });
}); //-------------------------------------------------------------------------------------------------------------------------------------
// 画面ロード時に「この内容で上書きする」ボタンを有効にする------------------------------------------------------------------------------

$(window).on('load', function () {
  $('#submit-edit').prop('disabled', false);
}); // --------------------------------------------------------------------------------------------------------------------------------------

/***/ }),

/***/ 5:
/*!**********************************************************!*\
  !*** multi ./resources/js/data-validation/gacha-edit.js ***!
  \**********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/ec2-user/environment/GachaCreator/resources/js/data-validation/gacha-edit.js */"./resources/js/data-validation/gacha-edit.js");


/***/ })

/******/ });