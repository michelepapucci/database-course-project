$(function() {
    $('#cancella_blog').on('click', function() {
        if(confirm("ATTENZIONE! Eliminando il blog perderai tutti i post, con le loro immagini e i loro commenti")) {
            $.ajax({
                url: "delete_blog.php",
                success(data){
                    console.log(data);
                    if(data == 'ok'){
                        alert("Blog eliminato correttamente!");
                        document.location.href="index.php";
                    } else {
                        alert("Errore durante l'eliminazione del blog!");
                    }
                }
            });
        }
    });
});