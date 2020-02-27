// ガチャの作成画面で入力に不備があるときは作成ボタン押せないようにしたい-------------------------------
$(function(){
    $('.input-gacha-name, .input-gacha-description, .image-file, .input-gacha-price, .input-gacha-rate, [name="templete"]').on('blur change', function(){
        
        var price = $('.input-gacha-price').val();
        
        // 排出率の合計算出
        var sum = window.myLib.sumRate();
        
        // ガチャの名前の文字数をカウント
        var char_name = $('.input-gacha-name').val();
        var count_name = window.myLib.charCount(char_name);
        
        // ガチャの説明の文字数をカウント
        var char_desc = $('.input-gacha-description').val();
        var count_desc = window.myLib.charCount(char_desc);
        
        // 画像ファイルのサイズを確認
        var file_size = window.myLib.checkImageSize();
        
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
            
        }else{
            window.myLib.btnDisabled();
        }
    });
});


//-------------------------------------------------------------------------------------------------------------------------------------

