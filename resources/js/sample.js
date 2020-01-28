// リストでチェックボックスにチェックした場合のみ削除ボタンを押せるようになる
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