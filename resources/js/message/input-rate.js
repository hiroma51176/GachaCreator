
// function inputRate(obj, val){
//     if(val == ''){
//         obj.next().text('入力が必要です');
//     }else if(!(0 <= val && val <= 100)){
//         obj.next().text('0～100の値を入力してください');
//     }else{
//         obj.next().text('');
//     }
// }

// 大当たりの排出率（ガチャの作成、編集）を入力時、入力された値が指定範囲外の場合------------------
$(function(){
    $('#jackpot, #hit, #miss').blur(function(){
        // var obj = $(this);
        // var val = obj.val();
        // inputRate(obj, val);
        if($(this).val() == ''){
            $(this).next().text('入力が必要です');
        }else if(!(0 <= $(this).val() && $(this).val() <= 100)){
            $(this).next().text('0～100の値を入力してください');
        }else{
            $(this).next().text('');
        }
    });
});
// ------------------------------------------------------------------------------------


// 当たりの排出率（ガチャの作成、編集）を入力時、入力された値が指定範囲外の場合------------------
// $(function(){
//     $('#hit').blur(function(){
//         inputRate();
//         // if($(this).val() == ''){
//         //     $(this).next().text('入力が必要です');
//         // }else if(!(0 <= $(this).val() && $(this).val() <= 100)){
//         //     $(this).next().text('0～100の値を入力してください');
//         // }else{
//         //     $(this).next().text('');
//         // }
//     });
// });
// ------------------------------------------------------------------------------------


// はずれの排出率（ガチャの作成、編集）を入力時、入力された値が指定範囲外の場合------------------
// $(function(){
//     $('#miss').blur(function(){
//         inputRate();
//         // if($(this).val() == ''){
//         //     $(this).next().text('入力が必要です');
//         // }else if(!(0 <= $(this).val() && $(this).val() <= 100)){
//         //     $(this).next().text('0～100の値を入力してください');
//         // }else{
//         //     $(this).next().text('');
//         // }
//     });
// });
// ------------------------------------------------------------------------------------

// ガチャの作成、編集の排出率を入力時、3つの値の合計を出力する-------------------------
$(function(){
    $('.input-gacha-rate').blur(function(){
        var sum = window.myLib.sumRate();
        // var jackpot = $('#jackpot').val() | 0;
        // var hit = $('#hit').val() | 0;
        // var miss = $('#miss').val() | 0;
        // sum = parseInt(jackpot) + parseInt(hit) + parseInt(miss);
        
        if(sum == 100){
            $('#rate-alert-ok').text('排出率の合計は100です');
            $('#rate-alert-ng').text('');
        }else{
            $('#rate-alert-ng').text('排出率の合計は' + sum + 'です。合計100にしてください');
            $('#rate-alert-ok').text('');
        }
    });
});
// --------------------------------------------------------------------------------------