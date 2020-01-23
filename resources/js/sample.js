$(function() {
    deleteCheck();
 
    $('#delete-check').change(function(){
    //$(':checkbox').change(function(){
        deleteCheck();
    });
});

function deleteCheck() {
    if($('#delete-check').is(':checked')) {
        $('#submit-btn').prop('disabled', false);
    } else {
        $('#submit-btn').prop('disabled', true);
    }
}