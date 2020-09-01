$(function(){
    $("#gotoBlog").on('click', function() {
        window.location.href = $("#miei_blog").children("option:selected").val();
    });
});