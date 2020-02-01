// 矢印キーとバックスペースキーとデリートキーとテンキー（数字）は入力可能
$(document).on('keydown', '.input-number', function(e){
    let k = e.keyCode;
    let str = String.fromCharCode(k);
    if(!(str.match(/[0-9]/) || (37 <= k && k <= 40) || k === 8 || k === 46 || (96 <= k && k <= 105))){
        return false;
    }
});

// 全角文字入力不可
$(document).on('keyup', '.input-number', function(){
    this.value =this.value.replace(/[^0-9]+/i,'');
});

$(document).on('blur', '.input-number', function(){
    this.value = this.value.replace(/[^0-9]+/i,'');
});

// 設定金額を入力時、入力された値が指定範囲外の場合
$(function(){
    $('.input-price').blur(function(){
        if(!($(this).val() >= 0 && $(this).val() <= 10000)){
            $(this).next().text('0～10000の値を入力してください');
        }else{
            $(this).next().text('');
        }
    });
});

// 最大試行回数を入力時、入力された値が指定範囲外の場合
$(function(){
    $('.input-count').blur(function(){
        if(!($(this).val() > 0 && $(this).val() <= 1000)){
            $(this).next().text('1～1000の値を入力してください');
        }else{
            $(this).next().text('');
        }
    });
});

// 排出率（シミュレーション）を入力時、入力された値が指定範囲外の場合
$(function(){
    $('.input-rate').blur(function(){
        if(!($(this).val() > 0 && $(this).val() <= 100)){
            $(this).next().text('1～100の値を入力してください');
        }else{
            $(this).next().text('');
        }
    });
});

// 排出率（ガチャの作成、編集）を入力時、入力された値が指定範囲外の場合
$(function(){
    $('.input-gacha-rate').blur(function(){
        if(!($(this).val() >= 0 && $(this).val() <= 100)){
            $(this).next().text('0～100の値を入力してください');
        }else{
            $(this).next().text('');
        }
    });
});

$(function(){
    $('.input-gacha-rate').blur(function(){
        if($('#jackpot').val() + $('#hit').val() + $('#miss').val() != 100){
            $('#rate-alert').text('排出率の合計は100ではありません');
        }else{
            $('#rate-alert').text('排出率の合計は100です');
        }
    });
});

// 入力フォームが空白でフォーカスが外れたらアラート発生
$(function(){
    $('.input-number').blur(function(){
        if($(this).val() == ''){
            $(this).next().text('入力が必要です');
        }else{
            $(this).next().text('');
        }
    });
});