$(function() {
    $("#elimina_commento").on('click', function() {
        if(confirm("Attenzione, una volta eliminato il commento, non sarà più possibile ripristinarlo. Continuare?")) {
            $.ajax({
                url: "delete_commento.php",
                type: 'post',
                data: {data: JSON.stringify({id: $(this).parent().attr("id") })},
                success(data) {
                    if(data == 'ok') {
                        location.reload();
                    } else {
                        console.log(data);
                        alert("Errore durante l'eliminazione del commento!");
                    }
                }
            });
        }
    });
});