// 矢印キーとバックスペースキーとデリートキーとテンキー（数字）以外は入力不可----------------
$(document).on('keydown', '.input-number', function(e){
    let k = e.keyCode;
    let str = String.fromCharCode(k);
    if(!(str.match(/[0-9]/) || (37 <= k && k <= 40) || k === 8 || k === 46 || (96 <= k && k <= 105))){
        return false;
    }
});
// --------------------------------------------------------------------------------------

// 全角文字入力不可----------------------------------------------------------------------
$(document).on('keyup', '.input-number', function(){
    this.value =this.value.replace(/[^0-9]+/i,'');
});

$(document).on('blur', '.input-number', function(){
    this.value = this.value.replace(/[^0-9]+/i,'');
});
// --------------------------------------------------------------------------------------

// 設定金額を入力時、入力された値が指定範囲外の場合--------------------------------------
$(function(){
    $('.input-price').blur(function(){
        if($(this).val() == ''){
            $(this).next().text('入力が必要です');
            $('#price-alert-ng').val('error');
        }else if(!(0 <= $(this).val() && $(this).val() <= 10000)){
            $(this).next().text('1～10000の値を入力してください');
            $('#price-alert-ng').val('error');
        }else{
            $(this).next().text('');
            $('#price-alert-ng').val('');
        }
    });
});
// -----------------------------------------------------------------------------------

// シミュレーションで最大試行回数を入力時、入力された値が指定範囲外の場合-------------------------------
$(function(){
    $('.input-count').blur(function(){
        if($(this).val() == ''){
            $(this).next().text('入力が必要です');
        }else if(!(0 < $(this).val() && $(this).val() <= 1000)){
            $(this).next().text('1～1000の値を入力してください');
        }else{
            $(this).next().text('');
        }
    });
});
// -----------------------------------------------------------------------------------

// 排出率（シミュレーション）を入力時、入力された値が指定範囲外の場合-----------------
$(function(){
    $('.input-rate').blur(function(){
        if($(this).val() == ''){
            $(this).next().text('入力が必要です');
        }else if(!(0 < $(this).val() && $(this).val() <= 100)){
            $(this).next().text('1～100の値を入力してください');
        }else{
            $(this).next().text('');
        }
    });
});
// --------------------------------------------------------------------------------------

// 排出率（ガチャの作成、編集）を入力時、入力された値が指定範囲外の場合------------------
$(function(){
    $('.input-gacha-rate').blur(function(){
        if($(this).val() == ''){
            $(this).next().text('入力が必要です');
            $('#rate-alert-ng').val('error');
        }else if(!(0 <= $(this).val() && $(this).val() <= 100)){
            $(this).next().text('0～100の値を入力してください');
            $('#rate-alert-ng').val('error');
        }else{
            $(this).next().text('');
            $('#rate-alert-ng').val('');
        }
    });
});
// ------------------------------------------------------------------------------------

// ガチャの作成、編集の排出率を入力時、3つの値の合計を出力する-------------------------
$(function(){
    $('.input-gacha-rate').blur(function(){
        var jackpot = $('#jackpot').val() | 0;
        var hit = $('#hit').val() | 0;
        var miss = $('#miss').val() | 0;
        sum = parseInt(jackpot) + parseInt(hit) + parseInt(miss);
        
        if(sum == 100){
            $('#rate-alert-ok').text('排出率の合計は100です');
            $('#rate-alert-ng').text('');
            $('#rate-alert-ng').val('');
            // $('#submit-create').prop('disabled', false);
        }else{
            $('#rate-alert-ng').text('排出率の合計は' + sum + 'です。合計100にしてください');
            $('#rate-alert-ok').text('');
            $('#rate-alert-ng').val('error');
            // $('#submit-create').prop('disabled', true);
        }
    });
});
// --------------------------------------------------------------------------------------

// // 入力フォームが空白でフォーカスが外れたらアラート発生
// $(function(){
//     $('.input-gacha-name').blur(function(){
//         if($(this).val() == ''){
//             $(this).next().text('入力が必要です');
//         }else{
//             $(this).next().text('');
//         }
//     });
// });

// ----------------------------------------------------------------------------------------

// ガチャの名前（ガチャの作成、編集）入力時のイベント--------------------------------------
$(function(){
    // 入力フォームが空白の時のイベント
    $(function(){
        $('.input-gacha-name, .input-prize-name').blur(function(){
            if($(this).val() == ''){
                $('#name-alert-ng').text('入力が必要です');
                $('#name-alert-ng').val('error');
            }else{
                $('#name-alert-ng').val('');
            }
        });
    });
    // 入力時のイベント
    $('.input-gacha-name, .input-prize-name').on('input', function(){
        // 文字数を取得
        var count = 0;
        for(var i=0; i < $(this).val().length; i++){
            // 入力された文字を文字コードに変換
            var char = $(this).val().charCodeAt(i);
            if((char >= 0x00 && char < 0x81) ||
                (char === 0xf8f0) ||
                (char >= 0xff61 && char < 0xffa0) ||
                (char >= 0xf8f1 && char < 0xf8f4)){
                // 半角文字の場合は1を加算
                count += 1;
            }else{
                // それ以外の文字の場合は2を加算
                count += 2;
            }
        }
        
        // // 入力された文字が30以上の時は文字入力できない（全角除く）
        // $('.input-gacha-name').on('keydown', function(e){
        //     let k = e.keyCode;
        //     let str = String.fromCharCode(k);
        //     if(count >= 30){
        //         if(!(k === 8 || (37 <= k && k <= 40) || k === 46)){
        //             return false;
        //         }
        //     }
        // });
        
        //var count = $(this).val().length;
        // 現在の文字数を表示
        $('.now-count').text(count);
        if(0 < count && count <= 30){
            // 1文字以上かつ30字以内の場合はＯＫ表示
            $('#name-alert-ok').text('現在' + count + '文字です。問題ありません');
            $('#name-alert-ng').text('');
            $('#name-alert-ng').val('');
            
            // $('#submit-create').prop('disabled', false);
        }else{
            // 0文字または30文字を超える場合はＮＧ表示
            $('#name-alert-ng').text('現在' + count + '文字です。1～30文字以内にしてください');
            $('#name-alert-ok').text('');
            $('#name-alert-ng').val('error');
            // $('#submit-create').prop('disabled', true);
        }
    });
    
    // リロード時に文字が入っていた時の対策
    //$('.input-gacha-name').trigger('input');
});
// ----------------------------------------------------------------------------------------------

// ガチャの説明（ガチャの作成、編集）入力時のイベント--------------------------------------------
$(function(){
    // 入力時のイベント
    $('.input-gacha-description').on('input', function(){
        // 文字数を取得
        var count = 0;
        for(var i=0; i < $(this).val().length; i++){
            // 入力された文字を文字コードに変換
            var char = $(this).val().charCodeAt(i);
            if((char >= 0x00 && char < 0x81) ||
                (char === 0xf8f0) ||
                (char >= 0xff61 && char < 0xffa0) ||
                (char >= 0xf8f1 && char < 0xf8f4)){
                // 半角文字の場合は1を加算
                count += 1;
            }else{
                // それ以外の文字の場合は2を加算
                count += 2;
            }
        }
        //var count = $(this).val().length;
        // 現在の文字数を表示
        $('.now-count').text(count);
        if(0 <= count && count <= 60){
            // 1文字以上かつ60字以内の場合はＯＫ表示
            $('#description-alert-ok').text('現在' + count + '文字です。問題ありません');
            $('#description-alert-ng').text('');
            $('#description-alert-ng').val('');
            // $('#submit-create').prop('disabled', false);
        }else{
            // 0文字または60文字を超える場合はＮＧ表示
            $('#description-alert-ng').text('現在' + count + '文字です。60文字以下にしてください');
            $('#description-alert-ok').text('');
            $('#description-alert-ng').val('error');
            // $('#submit-create').prop('disabled', true);
        }
    });
    
    // リロード時に文字が入っていた時の対策
    //$('.input-gacha-name').trigger('input');
});
//---------------------------------------------------------------------------------------------------

// 画像ファイル選択時（ガチャ作成、編集、プライズ作成、編集）のイベント
$(function(){
    // inputタグから取得
    $('.image-file').bind('change', function(){
        var image_size = this.files[0].size;
        // $(this).next().text(image_size);
        var file = $(this).prop('files')[0];
        if(image_size < 2048000){
            $('#image-alert-ok').text('画像サイズは' + getFileSize(file.size) + 'です。問題ありません');
            $('#image-alert-ng').text('');
            $('#image-alert-ng').val('');
            // $('#submit-create').prop('disabled', false);
        }else{
            $('#image-alert-ng').text('画像サイズは' + getFileSize(file.size) + 'です。2MB以下の画像を選択してください');
            $('#image-alert-ok').text('');
            $('#image-alert-ng').val('error');
            // $('#submit-create').prop('disabled', true);
        }
        
    });
});

function getFileSize(file_size){
    // 単位を設定
    var unit = ['byte', 'KB', 'MB', 'GB', 'TB'];
    
    for(var i = 0; i < unit.length; i++){
        if(file_size < 1024 || i == unit.length - 1){
            if(i == 0){
                // カンマ付与
                var integer = file_size.toString().replace(/([0-9]{1,3})(?=(?:[0-9]{3})+$)/g, '$1,');
                str = integer + unit[i];
            }else{
                // 小数点第2位は切り捨て
                file_size = Math.floor(file_size * 100) / 100;
                // 整数と少数に分割
                var num = file_size.toString().split('.');
                // カンマ付与
                var integer = num[0].replace(/([0-9]{1,3})(?=(?:[0-9]{3})+$)/g, '$1,');
                if(num[1]){
                    file_size = integer + '.' + num[1];
                }
                str = file_size + unit[i];
            }
            break;
        }
        file_size = file_size / 1024;
    }
    return str;
}
// ----------------------------------------------------------------------------------------------------

// ガチャ作成・編集画面とプライズ作成・編集画面で、入力フォームに不備があるときはボタンを押せないようにしたい-------------
// 問題：ガチャ名について、エラーがあってもそのほかのフォームを入力するとなぜかエラーが消える
// 問題：設定金額について、undefined
// $(function(){
//     $('.input-gacha-name, .input-gacha-description, .image-file, .input-price, .input-gacha-rate').blur(function(){
//         var name = $('#name-alert-ng').val();
//         var des = $('#description-alert-ng').val();
//         var image = $('#image-alert-ng').val();
//         var price = $('#price-alert-ng').val();
//         var rate = $('#rate-alert-ng').val();
        
//         if(
//         $('#name-alert-ng').val() == '' &&
//         $('#description-alert-ng').val() == '' &&
//         $('#image-alert-ng').val() == '' &&
//         $('#price-alert-ng').val() == '' &&
//         $('#rate-alert-ng').val() == ''
//         ){
//             $('#submit-create').prop('disabled', false);
//             $('#error').text('name：' + name + '。des：' +  des + '。rate：' + rate + '。image：' + image + '。price：' + price + '。OK');
            
//         }else{
//             $('#submit-create').prop('disabled', true);
//             $('#error').text('name：' + name + '。des：' +  des + '。rate：' + rate + '。image：' + image + '。price：' + price + '。入力フォームにエラーが発生しています。修正してください');
//         }
//     });
    
// });
//-------------------------------------------------------------------------------------------------------------------------------------