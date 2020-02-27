// 矢印キーとバックスペースキーとデリートキーとテンキー（数字）以外は入力不可----------------
$(document).on('keydown', '.input-number', function(e){
    let k = e.keyCode;
    let str = String.fromCharCode(k);
    if(!(str.match(/[0-9]/) || (37 <= k && k <= 40) || k === 8 || k === 46 || (96 <= k && k <= 105))){
        return false;
    }
});
// --------------------------------------------------------------------------------------

// 全角文字入力不可----------------------------------------------------------------------
$(document).on('keyup', '.input-number', function(){
    this.value =this.value.replace(/[^0-9]+/i,'');
});

$(document).on('blur', '.input-number', function(){
    this.value = this.value.replace(/[^0-9]+/i,'');
});
// --------------------------------------------------------------------------------------

// シミュレーションで設定金額を入力時、入力された値が指定範囲外の場合--------------------------------------
$(function(){
    $('.input-price').blur(function(){
        if($(this).val() == ''){
            $(this).next().text('入力が必要です');
        }else if(!(0 <= $(this).val() && $(this).val() <= 10000)){
            $(this).next().text('0～10000の値を入力してください');
        }else{
            $(this).next().text('');
        }
    });
});
// -----------------------------------------------------------------------------------

// シミュレーションで最大試行回数を入力時、入力された値が指定範囲外の場合-------------------------------
$(function(){
    $('.input-count').blur(function(){
        if($(this).val() == ''){
            $(this).next().text('入力が必要です');
        }else if(!(0 < $(this).val() && $(this).val() <= 1000)){
            $(this).next().text('1～1000の値を入力してください');
        }else{
            $(this).next().text('');
        }
    });
});
// -----------------------------------------------------------------------------------

// シミュレーションで排出率を入力時、入力された値が指定範囲外の場合-----------------
$(function(){
    $('.input-rate').blur(function(){
        if($(this).val() == ''){
            $(this).next().text('入力が必要です');
        }else if(!(0 < $(this).val() && $(this).val() <= 100)){
            $(this).next().text('1～100の値を入力してください');
        }else{
            $(this).next().text('');
        }
    });
});
// --------------------------------------------------------------------------------------

// シミュレーションでエラーがあるときは実行するボタン押せないようにする----------------------------------------------
$(function(){
    $('.input-price, .input-count, .input-rate').blur(function(){
        // // 各数値が取得できているか確認の為
        // var pri = $('.input-price').val();
        // var cou = $('.input-count').val();
        // var ra = $('.input-rate').val();
        
        if($('.input-price').val() <= 10000 
            && 0 < $('.input-count').val() && $('.input-count').val() <= 1000 
            && 0 < $('.input-rate').val() && $('.input-rate').val() <= 100 
        ){
            $('#submit-sim').prop('disabled', false);
            // 各数値確認用
            // $('#check_val').text(pri + '｜' + cou + '|' + ra);
        }else{
            $('#submit-sim').prop('disabled', true);
            // 各数値確認用
            // $('#check_val').text(pri + '｜' + cou + '|' + ra);
        }
    });
});
// ------------------------------------------------------------------------------------------------------------------