//file che fa comparire aree di testo in cui inserire l'url delle foto
"use strict";

let c = 5;

function gestoreCaricamentoImmagini() {
    try {
        if(c > 0) {
            $('<input>').attr({
                type: 'url',
                class: 'inserimento_url',
                name: "immagine" + (6 - c),
                id: "immagine" + (6 - c),
                placeholder: "Inserisci l'url della foto che vuoi aggiungere. Puoi aggiungere ancora " + (c - 1) + " foto",
            }).appendTo('.appendino');
            c--;
        }
    } catch(e) {
        console.error("gestoreCaricamentoImmagini " + e);
        return false;
    }
}

function gestoreLoad() {
    try {
        $("#bottone_foto").on('click', gestoreCaricamentoImmagini);
    } catch(e) {
        console.error("gestoreLoad " + e);
    }
}

$(gestoreLoad);
