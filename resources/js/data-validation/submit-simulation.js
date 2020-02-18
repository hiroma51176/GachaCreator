// シミュレーションでエラーがあるときは実行するボタン押せないようにする----------------------------------------------
$(function(){
    $('.input-price, .input-count, .input-rate').blur(function(){
        if($('.input-price').val() <= 10000 
            && 0 < $('.input-count').val() && $('.input-count').val() <= 1000 
            && 0 < $('.input-rate').val() && $('.input-rate').val() <= 100 
        ){
            $('#submit-sim').prop('disabled', false);
        }else{
            $('#submit-sim').prop('disabled', true);
        }
    });
});
// ------------------------------------------------------------------------------------------------------------------