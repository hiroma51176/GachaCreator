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