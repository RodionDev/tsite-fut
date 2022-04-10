function setUsers(list, users)
{
    var cNode = list.cloneNode(false);
    list.parentNode.replaceChild(cNode, list);
    for(let i=0; i<users.length; i++)
    {
        let user_li = document.createElement('li');
        let user_name = document.createTextNode("test");
        let user_a = document.createElement('a');
        user_li.classList.add('collection-item', 'search-result');
        user_li.appendChild(user_name);
        user_a.appendChild( user_li );
        list.appendChild(user_a);
        console.log(user_a);
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
    xmlhttp.open("GET", "/users/search/data?name=" + search, true);
    xmlhttp.send();
}
function init()
{
    let search_results = document.getElementsByClassName('search-results'); 
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
    }
}
init();
