//file che fa comparire aree di testo in cui inserire l'url delle foto
"use strict";

function gestoreCaricamentoImmagini () {
    try {
        if (c > 0) {
            $('<input>').attr({
                type: 'text',
                class: 'inserimento_url',
                name: "immagine" + (6 - c),
                id: "immagine" + (6 - c),
                placeholder: "Inserisci l'url della foto che vuoi aggiungere. Puoi aggiungere ancora " + (c - 1) + " foto",
            }).appendTo('.appendino');
            c--;
        }
    } catch (e) {
        alert("gestoreLoad " + e);
        return false;
    }
}

let nodoBottone;
let c = 5;

function gestoreLoad () {
    try {
        $("#bottone_foto").on('click' , gestoreCaricamentoImmagini);
    } catch (e) {
        alert("gestoreLoad " + e);
    }
}


$(gestoreLoad);
