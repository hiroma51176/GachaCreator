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