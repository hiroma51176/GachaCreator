
// 排出率（ガチャの作成、編集）を入力時、入力された値が指定範囲外の場合------------------
$(function(){
    $('#jackpot, #hit, #miss').blur(function(){
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


// ガチャの作成、編集の排出率を入力時、3つの値の合計を出力する-------------------------
$(function(){
    $('.input-gacha-rate').blur(function(){
        var sum = window.myLib.sumRate();
        
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