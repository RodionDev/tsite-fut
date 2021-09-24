let pool_button = document.getElementById("pool-button");   
let show_all = false;   
pool_button.onclick = function()
{
    let current_pool = document.getElementsByClassName('current-pool')[0];  
    let other_pools = document.getElementsByClassName('other-pool');    
    if(show_all)
    {
        current_pool.classList.remove("hide");
        for(let i=0; i<other_pools.length; i++)
        {
            other_pools[i].classList.add("hide");
        }
        pool_button.textContent = "Alle Poules";
        show_all = false;
    }
    else
    {
        current_pool.classList.add("hide");
        for(let i=0; i<other_pools.length; i++)
        {
            other_pools[i].classList.remove("hide");
        }
        pool_button.textContent = "Eigen Poule";
        show_all = true;
    }
};
