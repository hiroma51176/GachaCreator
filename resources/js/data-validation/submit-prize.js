
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

// プライズの作成画面で入力に不備があるときは作成ボタン押せないようにしたい-------------------------------
$(function(){
    $('.input-prize-name, .image-file, [name="rarity_name"]').on('blur change', function(){
        
        // プライズの名前の文字数をカウント
        var char_name = $('.input-prize-name').val();
        var count_name = char_count(char_name);
        
        // 画像ファイルのサイズを確認
        // var file_size = checkImageSize();
        if($('.image-file').prop('files')[0] != null){
            var file = $('.image-file').prop('files')[0];
            var file_size = file.size;
        }else{
            var file_size = null;
        }
        
        var rarity = $('[name="rarity_name"] option:selected').val(); 
        
        // 入力に問題ないならボタンを押せるようにする
        if(0 < count_name && count_name <= 30 
            && file_size < 2048000
            && rarity != ''
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