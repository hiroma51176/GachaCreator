// ガチャを引いた結果画面をロード時に、カーテンが開くような効果をつける---------------------------------------------
$(window).on('load', function(){
    $('#curtainLeft').animate({width: '0', opacity: '0'}, 2000);
    $('#curtainRight').animate({width: '0', opacity: '0'}, 2000);
    setTimeout(function(){
        $('#curtainLeft').remove();
        $('#curtainRight').remove();
    }, 5000);
});

// -----------------------------------------------------------------------------------------------------------------