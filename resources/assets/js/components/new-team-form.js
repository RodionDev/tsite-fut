function setUsers(list, users)
{
    console.log(users);
    list.innerHTML = '';
    for(let i=0; i<users.length; i++)
    {
        let user_li = document.createElement('li'); 
        let user_name = document.createTextNode( users[i].first_name + ' ' + users[i].sur_name );   
        user_li.classList.add('collection-item', 'search-result');  
        user_li.appendChild(user_name); 
        list.appendChild(user_li);
    }
}
function requestUsers(list, search)
{
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function()
    {
        if(this.readyState == 4 && this.status == 200)
        {
            return setUsers(list, JSON.parse(this.responseText));
        }
    }
    xmlhttp.open("GET", "/users/search?name=" + search, true);
    xmlhttp.send();
}
function init()
{
    let search_results = document.querySelectorAll('.search-results'); 
    for(let i=0; i<search_results.length; i++)
    {
        let input = document.getElementById( search_results[i].dataset.resultsFor );    
        input.addEventListener("keyup", function(e)
        {
            if(input.value.length > 1)
            {
                requestUsers(search_results[i], input.value);
            }
        });
        input.addEventListener("blur", function(e)
        {
            search_results[i].classList.add("hide");
        });
        input.addEventListener("focus", function(e)
        {
            search_results[i].classList.remove("hide");
        });
    }
}
init();
