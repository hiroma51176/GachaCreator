// プライズの作成画面で入力に不備があるときは作成ボタン押せないようにしたい-------------------------------
$(function(){
    $('.input-prize-name, .image-file, [name="rarity_name"]').on('blur change', function(){
        
        // プライズの名前の文字数をカウント
        var char_name = $('.input-prize-name').val();
        var count_name = char_count(char_name);
        
        // 画像ファイルのサイズを確認
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
            $('.submit-btn').prop('disabled', false);
            $('#check_val').text('');
        }else{
            $('.submit-btn').prop('disabled', true);
            $('#check_val').text('入力欄に不備があります。ご確認ください。');
        }
    });
});


//-------------------------------------------------------------------------------------------------------------------------------------