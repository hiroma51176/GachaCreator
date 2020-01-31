// 作成したガチャのリストおよびプライズで、チェックボックスにチェックした場合のみ削除ボタンを押せるようにする
$(function() {
    deleteCheck();
    
    //$("*[name=prize_id]").change(function(){
    $(':checkbox').change(function(){
        deleteCheck();
    });
});

function deleteCheck() {
    if($(':checkbox').is(':checked')) {
    //if($("*[name=prize_id]").is(':checked')) {
        $('#submit-btn').prop('disabled', false);
    } else {
        $('#submit-btn').prop('disabled', true);
    }
}

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

// ガチャを引いた結果画面をロード時に、カーテンが開くような効果をつける
$(window).on('load', function(){
    $('#curtainLeft').animate({width: '0', opacity: '0'}, 2000);
    $('#curtainRight').animate({width: '0', opacity: '0'}, 2000);
    setTimeout(function(){
        $('#curtainLeft').remove();
        $('#curtainRight').remove();
    }, 5000);
});
