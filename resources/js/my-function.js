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

// ファイルサイズの単位
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

// 実行ボタンのOKの場合--------------------------------------------------------------------------------
function btnAbled(){
    $('.submit-btn').prop('disabled', false);
    $('#check_val').text('問題ありません。');
}
// ----------------------------------------------------------------------------------------------------

// 実行ボタンのNGの場合--------------------------------------------------------------------------------

function btnDisabled(){
    $('.submit-btn').prop('disabled', true);
    $('#check_val').text('入力欄に不備があります。ご確認ください。');
}
// ----------------------------------------------------------------------------------------------------

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
// ----------------------------------------------------------------------------------------------------

// $(function(){
//     $('.input-price').blur(function(){
//         $('#check_val').text('読み込めています。');
//     });
// });