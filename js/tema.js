$(function(){
    $("#tema").bind('input propertychange', function(){
        let msg = {
            input: $("#tema").val(),
            categoria: $("#categoria").val()
        }

        $.ajax({
            url: "select_tema.php",
            type: 'post',
            data: {data: JSON.stringify(msg)},
            success: function(data, status, xhr){
                $("#temi").empty();
                let temi_array = JSON.parse(data);
                for(let i = 0; i < temi_array.length; i++) {
                    $("<option>" + temi_array[i] + "</option>").appendTo($("#temi"));
                }
            },
            error: function(){

            }
        });
    });
});