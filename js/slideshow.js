$(function(){
    let immagini = $(".immagine");
    let cursor = 0;

    function goRight(){
        if(cursor + 1 >= immagini.length){
            showSlide(0);
        } else {
            showSlide(++cursor);
        }
    }

    function goLeft(){
        if(cursor - 1 == -1){
            showSlide(immagini.length -1);
        } else {
            showSlide(--cursor);
        }
    }

    function showSlide(i) {
        cursor = i;
        $(".dot").removeClass("active");
        $("#"+cursor).addClass("active");
        immagini.hide();
        immagini.eq(i).show();
    }

    function dotHandler(){
        cursor = this.id;
        showSlide(this.id);
    }

    $(".next").on('click', goRight);
    $(".prev").on('click', goLeft);
    $(".dot").on('click', dotHandler);

    showSlide(cursor);

});