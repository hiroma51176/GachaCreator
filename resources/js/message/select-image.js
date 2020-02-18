// 画像ファイル選択時（ガチャ作成、編集、プライズ作成、編集）のイベント
$(function(){
    // inputタグから取得
    $('.image-file').on('change', function(){
        var image_size = this.files[0].size;
        var file = $(this).prop('files')[0];
        if(image_size < 2048000){
            $('#image-alert-ok').text('画像サイズは' + getFileSize(file.size) + 'です。問題ありません');
            $('#image-alert-ng').text('');
        }else{
            $('#image-alert-ng').text('画像サイズは' + getFileSize(file.size) + 'です。2MB以下の画像を選択してください');
            $('#image-alert-ok').text('');
        }
        
    });
});

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