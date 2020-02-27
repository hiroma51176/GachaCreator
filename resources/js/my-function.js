
$(function(){

    // 排出率の合計を算出する----------------------------------------------------------------
    function sumRate(){
        var jackpot = $('#jackpot').val() | 0;
        var hit = $('#hit').val() | 0;
        var miss = $('#miss').val() | 0;
        var sum = parseInt(jackpot, 10) + parseInt(hit, 10) + parseInt(miss, 10);
        
        return sum;
    }

    // 半角を１、全角を２でカウントする関数---------------------------------------------------
    function charCount(char_length){
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


    // 実行ボタンのOKの場合--------------------------------------------------------------------------------
    function btnAbled(){
        $('.submit-btn').prop('disabled', false);
        $('#check_val').text('問題ありません。');
    }

    // 実行ボタンのNGの場合--------------------------------------------------------------------------------

    function btnDisabled(){
        $('.submit-btn').prop('disabled', true);
        $('#check_val').text('入力欄に不備があります。ご確認ください。');
    }
    
    // 画像ファイルのサイズを確認--------------------------------------------------------------------------
    function checkImageSize(){
        if($('.image-file').prop('files')[0] != null){
            var file = $('.image-file').prop('files')[0];
            var file_size = file.size;
        }else{
            var file_size = null;
        }
        return file_size;
    }


    // window.myLib = window.myLib|| {};
    window.myLib = {
        sumRate : sumRate,
        charCount : charCount,
        btnAbled : btnAbled,
        btnDisabled : btnDisabled,
        checkImageSize : checkImageSize,
        };
});
