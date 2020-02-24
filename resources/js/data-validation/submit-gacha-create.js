// ガチャの作成画面で入力に不備があるときは作成ボタン押せないようにしたい-------------------------------
$(function(){
    $('.input-gacha-name, .input-gacha-description, .image-file, .input-gacha-price, .input-gacha-rate, [name="templete"]').on('blur change', function(){
        
        var price = $('.input-gacha-price').val();
        
        // 排出率の合計算出
        var sum = window.myLib.sumRate();
        // var jackpot = $('#jackpot').val() | 0;
        // var hit = $('#hit').val() | 0;
        // var miss = $('#miss').val() | 0;
        // var sum = parseInt(jackpot, 10) + parseInt(hit, 10) + parseInt(miss, 10);
        
        // ガチャの名前の文字数をカウント
        var char_name = $('.input-gacha-name').val();
        var count_name = window.myLib.charCount(char_name);
        
        // ガチャの説明の文字数をカウント
        var char_desc = $('.input-gacha-description').val();
        var count_desc = window.myLib.charCount(char_desc);
        
        // 画像ファイルのサイズを確認
        var file_size = window.myLib.checkImageSize();
        // if($('.image-file').prop('files')[0] != null){
        //     var file = $('.image-file').prop('files')[0];
        //     var file_size = file.size;
        // }else{
        //     var file_size = null;
        // }
        
        // テンプレートに使用について確認
        var temp = $('[name="templete"]:checked').val();
        if(temp == ''){
            temp = $('[name="templete"] option:selected').val();
        }
        
        // 入力に問題ないならボタンを押せるようにする
        if(0 < count_name && count_name <= 30 
            && count_desc <= 60
            && file_size < 2048000
            && $('.input-gacha-price').val() <= 10000
            && $('#jackpot').val() <= 100
            && $('#hit').val() <= 100
            && $('#miss').val() <= 100
            && sum == 100
            && $('#jackpot').val() != '' && $('#hit').val() != '' && $('#miss').val() != ''
            && temp != ''
        ){
            window.myLib.btnAbled();
            // $('.submit-btn').prop('disabled', false);
            // $('#check_val').text('問題ありません。');
        }else{
            window.myLib.btnDisabled();
            // $('.submit-btn').prop('disabled', true);
            // $('#check_val').text('入力欄に不備があります。ご確認ください。');
        }
    });
});


//-------------------------------------------------------------------------------------------------------------------------------------

// 半角を１、全角を２でカウントする関数---------------------------------------------------

function char_count(char_length){
    var count = 0;
    for(var i=0; i < char_length.length; i++){
        // 入力された文字を文字コードに変換
        var char = char_length.charCodeAt(i);
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
    return count;
}

// ---------------------------------------------------------------------------------------