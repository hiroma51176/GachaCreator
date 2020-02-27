
// ガチャとプライズの名前（作成、編集）入力時のイベント--------------------------------------
$(function(){
    // 入力フォームが空白の時のイベント
    $(function(){
        $('.input-gacha-name, .input-prize-name').blur(function(){
            if($(this).val() == ''){
                $('#name-alert-ng').text('入力が必要です');
            }
        });
    });
    // 入力時のイベント
    $('.input-gacha-name, .input-prize-name').on('input', function(){
        var char_name = $(this).val();
        var count_name = window.myLib.charCount(char_name);
        
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
        var count_desc = window.myLib.charCount(char_desc);
        
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