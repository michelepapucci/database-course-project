$(function() {
    $('#cancella_post').on('click', function() {
        if(confirm("ATTENZIONE! Eliminando il post perderai il testo, le immagini e i commenti")) {
            $.ajax({
                url: "delete_post.php",
                success(data) {
                    console.log(data);
                    if(data === 'ok') {
                        alert("Post eliminato correttamente!");
                        document.location.href = "index.php";
                    } else {
                        alert("Errore durante l'eliminazione del blog!");
                    }
                }
            });
        }
    });
});