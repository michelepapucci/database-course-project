$(function(){
    let immagini = $(".immagine");
    immagini.hide()

    function slideshow(i) {
        immagini.hide();
        immagini.eq(i).show();
        console.log(immagini[i]);
        if(i+1 == immagini.length)
        {
            i = 0;
        } else {
            i++;
        }
        setTimeout(slideshow, 5000, i);

    }
    slideshow(0);
});