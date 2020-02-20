// シミュレーションでエラーがあるときは実行するボタン押せないようにする----------------------------------------------
$(function(){
    $('.input-price, .input-count, .input-rate').blur(function(){
        if($('.input-price').val() <= 10000 
            && 0 < $('.input-count').val() && $('.input-count').val() <= 1000 
            && 0 < $('.input-rate').val() && $('.input-rate').val() <= 100 
        ){
            btnAbled();
            // $('.submit-btn').prop('disabled', false);
            // $('#check_val').text('問題ありません。');
        }else{
            btnDisabled();
            // $('.submit-btn').prop('disabled', true);
            // $('#check_val').text('入力欄に不備があります。ご確認ください。');
        }
    });
});
// ------------------------------------------------------------------------------------------------------------------

// // 実行ボタンのOKの場合--------------------------------------------------------------------------------
// function btnAbled(){
//     $('.submit-btn').prop('disabled', false);
//     $('#check_val').text('問題ありません。');
// }
// // ----------------------------------------------------------------------------------------------------

// // 実行ボタンのNGの場合--------------------------------------------------------------------------------
// function btnDisabled(){
//     $('.submit-btn').prop('disabled', true);
//     $('#check_val').text('入力欄に不備があります。ご確認ください。');
// }
// // ----------------------------------------------------------------------------------------------------