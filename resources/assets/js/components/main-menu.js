let menu = document.getElementById("main-menu");
let hidden = false;
document.onscroll = function()
{
    let amount_scrolled = window.pageYOffset || (document.documentElement || document.body.parentNode || document.body).scrollTop;
    if(!hidden && amount_scrolled > 64)
    {
        menu.classList.add("main-menu-fixed");
        hidden = true;
    }
    else if(hidden && amount_scrolled == 0)
    {
        menu.classList.remove("main-menu-fixed");
        hidden = false;
    }
};
