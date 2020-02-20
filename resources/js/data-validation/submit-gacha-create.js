// ガチャの作成画面で入力に不備があるときは作成ボタン押せないようにしたい-------------------------------
$(function(){
    $('.input-gacha-name, .input-gacha-description, .image-file, .input-gacha-price, .input-gacha-rate, [name="templete"]').on('blur change', function(){
        
        var price = $('.input-gacha-price').val();
        
        // 排出率の合計算出
        var jackpot = $('#jackpot').val() | 0;
        var hit = $('#hit').val() | 0;
        var miss = $('#miss').val() | 0;
        var sum = parseInt(jackpot, 10) + parseInt(hit, 10) + parseInt(miss, 10);
        
        // ガチャの名前の文字数をカウント
        var char_name = $('.input-gacha-name').val();
        var count_name = char_count(char_name);
        
        // ガチャの説明の文字数をカウント
        var char_desc = $('.input-gacha-description').val();
        var count_desc = char_count(char_desc);
        
        // 画像ファイルのサイズを確認
        // var file_size = checkImageSize();
        if($('.image-file').prop('files')[0] != null){
            var file = $('.image-file').prop('files')[0];
            var file_size = file.size;
        }else{
            var file_size = null;
        }
        
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
            // btnAbled();
            $('.submit-btn').prop('disabled', false);
            $('#check_val').text('問題ありません。');
        }else{
            // btnDisabled();
            $('.submit-btn').prop('disabled', true);
            $('#check_val').text('入力欄に不備があります。ご確認ください。');
        }
    });
});


//-------------------------------------------------------------------------------------------------------------------------------------