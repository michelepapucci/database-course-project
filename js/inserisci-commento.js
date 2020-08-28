$(function(){
    $("#submit-commento").on('click', function(){
        if($("#input-commento").val() != "") {
            msg = JSON.stringify({testo_commento: $("#input-commento").val()});
            $.ajax({
                url: "insert_commento.php",
                type: 'post',
                data: {data: msg},
                success: function(data, status, xhr){
                    if(data == "ok"){
                        location.reload();
                    } else {
                        alert("Impossibile inserire il commento!");
                    }
                }
            })
        }
    });
});