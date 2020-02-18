// ガチャの作成画面で、「作成したガチャのプライズをコピーする」を選択した場合のみプルダウンを使えるようにする
$(function(){
    $('[name="templete"]:radio').change( function(){
        if($('#created').prop('checked')){
            $('#created_select').prop('disabled', false);
        }else{
            $('#created_select').prop('disabled', true);
        }
    });
});

// ---------------------------------------------------------------------------------------------------------------