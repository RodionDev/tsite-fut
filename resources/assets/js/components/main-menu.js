let menu = document.getElementById("main-menu");
let topbar = document.getElementById("topbar");
let menu_items = menu.getElementsByClassName("tab");
for(let i=0; i < menu_items.length; i++)
{
    let target = menu_items[i];
    let target_location = target.children[0].getAttribute("href");
    if(target_location == window.location.pathname)
    {
        target.classList.add("active");
    }
}
let hidden = false;
document.onscroll = function()
{
    let amount_scrolled = window.pageYOffset || (document.documentElement || document.body.parentNode || document.body).scrollTop;
    if(amount_scrolled < 64)
    {
        topbar.setAttribute("style", "height: " + (64-amount_scrolled) + "px !important;");
    }
    else{ topbar.setAttribute("style", "height: " + 0 + "px !important;"); }
};
