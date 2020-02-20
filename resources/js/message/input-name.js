// 半角を１、全角を２でカウントする関数---------------------------------------------------

// function char_count(char_length){
//     var count = 0;
//     for(var i=0; i < char_length.length; i++){
//         // 入力された文字を文字コードに変換
//         var char = char_length.charCodeAt(i);
//         if((char >= 0x00 && char < 0x81) ||
//             (char === 0xf8f0) ||
//             (char >= 0xff61 && char < 0xffa0) ||
//             (char >= 0xf8f1 && char < 0xf8f4)){
//             // 半角文字の場合は1を加算
//             count += 1;
//         }else{
//             // それ以外の文字の場合は2を加算
//             count += 2;
//         }
//     }
//     return count;
// }

// ---------------------------------------------------------------------------------------

// require('../my-function');

// ガチャとプライズの名前（作成、編集）入力時のイベント--------------------------------------
$(function(){
    // 入力フォームが空白の時のイベント
    $(function(){
        $('.input-gacha-name, .input-prize-name').blur(function(){
        // $('.input-gacha-name, .input-prize-name').blur(function(){
            if($(this).val() == ''){
                $('#name-alert-ng').text('入力が必要です');
            }
        });
    });
    // 入力時のイベント
    $('.input-gacha-name, .input-prize-name').on('input', function(){
        var char_name = $(this).val();
        var count_name = char_count(char_name);
        
        // 現在の文字数を表示
        $('.now-count').text(count_name);
        if(0 < count_name && count_name <= 30){
            // 1文字以上かつ30字以内の場合はＯＫ表示
            $('#name-alert-ok').text('現在' + count_name + '文字です。問題ありません');
            $('#name-alert-ng').text('');
            
        }else{
            // 0文字または30文字を超える場合はＮＧ表示
            $('#name-alert-ng').text('現在' + count_name + '文字です。1～30文字以内にしてください');
            $('#name-alert-ok').text('');
        }
    });
});
// ----------------------------------------------------------------------------------------------

// ガチャの説明（ガチャの作成、編集）入力時のイベント--------------------------------------------
$(function(){
    // 入力時のイベント
    $('.input-gacha-description').on('input', function(){
        
        var char_desc = $(this).val();
        var count_desc = char_count(char_desc);
        
        // 現在の文字数を表示
        $('.now-count').text(count_desc);
        if(0 <= count_desc && count_desc <= 60){
            // 1文字以上かつ60字以内の場合はＯＫ表示
            $('#description-alert-ok').text('現在' + count_desc + '文字です。問題ありません');
            $('#description-alert-ng').text('');
        }else{
            // 0文字または60文字を超える場合はＮＧ表示
            $('#description-alert-ng').text('現在' + count_desc + '文字です。60文字以下にしてください');
            $('#description-alert-ok').text('');
        }
    });
});
//---------------------------------------------------------------------------------------------------