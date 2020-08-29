$(function(){
    $("#del-utente").on('click', function(){
        let ret = confirm("ATTENZIONE! Eliminando il tuo account perderai tutti i blog con i loro contenuti e tutti i post e i commenti che hai scritto. Sei sicuro di voler procedere?");
        if(ret) {
            $.ajax({
                url: "delete_utente.php",
                success(data){
                    if(data == 'ok'){
                        alert("Account eliminato correttamente!");
                        location.reload();
                    } else {
                        alert("Errore durante l'eliminazione dell'account!");
                    }
                }
            })
        }
    });
});