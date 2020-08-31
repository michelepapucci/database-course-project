//file che fa l'area di testo in cui inserire la mail del co-autore
"use strict";

function gestoreCaricamentoEmail() {
    try {
        $('#co-autore-aggiungi-div').toggleClass("nascosto");
        if ($('#co-autore-aggiungi').text() == "Aggiungi") {
            $('#co-autore-aggiungi').text("Aggiungi un co-autore");
            let msg = JSON.stringify({email: $("#co-autore-aggiungi-email").val()});
            $.ajax({
                url: "insert_co-autore.php",
                type: 'post',
                data: {data: msg},
                success: function (data, status, xhr) {
                    if (data != "ok") {
                        alert("Impossibile aggiungere co-autore (la mail inserita potrebbe non esistere)");
                    }
                    location.reload();
                }
            })
        } else {
            $('#co-autore-aggiungi').text("Aggiungi");
        }
    } catch (e) {
        console.error("gestoreCaricamentoEmail " + e);
        return false;
    }
}

function gestoreRimozioneEmail() {
    try {
        $('#co-autore-rimuovi-div').toggleClass("nascosto");
        if ($('#co-autore-rimuovi').text() == "Rimuovi") {
            $('#co-autore-rimuovi').text("Rimuovi un co-autore");
            let msg = JSON.stringify({email: $("#co-autore-rimuovi-email").val()});
            $.ajax({
                url: "delete_co-autore.php",
                type: 'post',
                data: {data: msg},
                success: function (data, status, xhr) {
                    if (data != "ok") {
                        alert("Impossibile rimuovere co-autore (la mail inserita potrebbe non esistere)");
                    }
                    location.reload();
                }
            })
        } else {
            $('#co-autore-rimuovi').text("Rimuovi");
        }
    } catch (e) {
        console.error("gestoreRimozioneEmail " + e);
        return false;
    }
}

function gestoreLoad() {
    try {
        $("#co-autore-aggiungi").on('click', gestoreCaricamentoEmail);
        $("#co-autore-rimuovi").on('click', gestoreRimozioneEmail);
    } catch (e) {
        console.error("gestoreLoad " + e);
    }
}

$(gestoreLoad);