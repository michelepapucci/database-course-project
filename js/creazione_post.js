$(function(){
    $("#testo_post").bind('input propertychange', function(){
        $("#caratteri_rim").text(this.value.length + "/10000");
    });
});
