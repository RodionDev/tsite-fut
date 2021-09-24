let element = document.getElementById("sponsors-carousel");
let options = {
    "fullWidth": true,
    "padding": -1
}
let carousel = M.Carousel.init(element, options);
autoplay();
function autoplay()
{
    carousel.next();
    setTimeout(autoplay, 2000);
}
