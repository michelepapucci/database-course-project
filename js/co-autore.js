//file che fa l'area di testo in cui inserire la mail del co-autore
"use strict";

function gestoreCaricamentoEmail() {
    try {
        $('#co-autore-div').toggleClass("nascosto");
        if ($('#co-autore').val() == "Conferma") {
            $('#co-autore').val("Aggiungi un co-autore");
            let msg = JSON.stringify({email: $("#co-autore-email").val()});
            $.ajax({
                url: "insert_co-autore.php",
                type: 'post',
                data: {data: msg},
                success: function(data, status, xhr){
                    console.log(data);
                }
            })
        } else {
            $('#co-autore').val("Conferma");
        }
    } catch(e) {
        console.error("gestoreCaricamentoEmail " + e);
        return false;
    }
}

function gestoreLoad() {
    try {
        $("#co-autore").on('click', gestoreCaricamentoEmail);
    } catch(e) {
        console.error("gestoreLoad " + e);
    }
}

$(gestoreLoad);