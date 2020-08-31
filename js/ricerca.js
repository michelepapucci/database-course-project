$(function () {
    $("#ricerca").bind('input propertychange', function () {
        let msg = {
            input: $("#ricerca").val(),
            tipo: $("#opzioni").val()
        };

        $.ajax({
            url: "select_ricerca.php",
            type: 'post',
            data: {data: JSON.stringify(msg)},
            success: function (data, status, xhr) {
                console.log(data);
                $("#ricerche").empty();
                let risultati_array = JSON.parse(data);
                for (let i = 0; i < risultati_array.length; i++) {
                    $("<option>" + risultati_array[i] + "</option>").appendTo($("#ricerche"));
                }
            },
            error: function (jqXhr, textStatus, errorMessage) {
                console.log(textStatus + ": " + errorMessage);
            }
        });
    });
});