
// プライズの作成画面で入力に不備があるときは作成ボタン押せないようにしたい-------------------------------
$(function(){
    $('.input-prize-name, .image-file, [name="rarity_name"]').on('blur change', function(){
        
        // プライズの名前の文字数をカウント
        var char_name = $('.input-prize-name').val();
        var count_name = window.myLib.charCount(char_name);
        
        // 画像ファイルのサイズを確認
        var file_size = window.myLib.checkImageSize();
        
        var rarity = $('[name="rarity_name"] option:selected').val(); 
        
        // 入力に問題ないならボタンを押せるようにする
        if(0 < count_name && count_name <= 30 
            && file_size < 2048000
            && rarity != ''
        ){
            window.myLib.btnAbled();
            
        }else{
            window.myLib.btnDisabled();
        }
    });
});


//-------------------------------------------------------------------------------------------------------------------------------------