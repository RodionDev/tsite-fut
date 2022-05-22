function removeList(close)
{
    close.parentNode.parentNode.remove();
}
function selectUser(input, name=null, result_output=null, user_id=null, result_image=null, image=null, list=null)
{
    let input_element = document.getElementById(input);
    let output = document.getElementById(result_output);
    if(list)    list.innerHTML = "";
    input_element.value = "";
    if(output.nodeName == "UL")
    {
        let player_li = document.createElement('li');
        let column1 = document.createElement('div');
        let column2 = document.createElement('div');
        player_li.classList.add('collection-item', 'row'); 
        column1.classList.add('col', 's1');
        column2.classList.add('col', 's11');
        let name_input = document.createElement('input');
        name_input.type = 'checkbox';
        name_input.name = 'users[]';
        name_input.value = user_id;
        name_input.readOnly = true;
        name_input.checked = true;
        let user_name = document.createTextNode(name);   
        let remove_icon = document.createElement('i');
        remove_icon.classList.add('mdi', 'mdi-close-circle', 'close', 'clickable');
        remove_icon.addEventListener("mousedown", removeList.bind(null, remove_icon), false);
        let avatar = document.createElement('img');
        avatar.classList.add('px52');   
        avatar.src = (image) ? image : 'images/image-missing.png';   
        column1.appendChild(avatar);
        column2.appendChild(name_input);
        column2.appendChild(user_name);
        column2.appendChild(remove_icon);
        player_li.appendChild(column1);
        player_li.appendChild(column2);
        output.appendChild(player_li);  
    }
    else
    {
        input_element.value = name;
        input_element.classList.add("disabled");
        if(result_output)   output.value = user_id;
        if(result_image)    document.getElementById(result_image).src = (image)? image : 'images/image-missing.png';
    }
}
function fillList(list, input, users, result_output=null, result_image=null)
{
    list.innerHTML = '';
    let an_user_exists;
    for(let i=0; i<users.length; i++)
    {
        let name = users[i].first_name + ' ' + users[i].sur_name;
        let inputs = document.getElementById(result_output).getElementsByTagName("input");  
        let this_user_exists = false;    
        for(var j=0; j<inputs.length; j++)
        {
            if(inputs[j].value == name)
            {
                an_user_exists = true;
                this_user_exists = true;
                break;
            }
        }
        if(this_user_exists) break;
        let user_li = document.createElement('li'); 
        user_li.classList.add('collection-item', 'search-result', 'clickable');  
        user_li.addEventListener("mousedown", selectUser.bind(null, input, name, result_output, users[i].id, result_image, users[i].avatar, list), false);
        let user_name = document.createTextNode(name);   
        let image = document.createElement('img');
        image.classList.add('vertical-centre-image');   
        image.src = (users[i].avatar) ? users[i].avatar : 'images/image-missing.png';   
        user_li.appendChild(image);  
        user_li.appendChild(user_name); 
        list.appendChild(user_li);  
    }
    if( users.length == 0 || (users.length == 1 && an_user_exists) )
    {
        let user_li = document.createElement('li'); 
        let text = document.createTextNode( "Geen teamleiders gevonden." );   
        user_li.classList.add('collection-item', 'search-result');  
        user_li.appendChild(text); 
        list.appendChild(user_li);  
    }
}
function searchUser(list, input, result_output=null, result_image=null, limit_id=null)
{
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function()
    {
        if(this.readyState == 4 && this.status == 200)
        {
            return fillList(list, input, JSON.parse(this.responseText), result_output, result_image);
        }
    }
    if(limit_id)
        xmlhttp.open("GET", "/users/search?name=" + document.getElementById(input).value + '&id=' + limit_id, true);
    else
        xmlhttp.open("GET", "/users/search?name=" + document.getElementById(input).value, true);
    xmlhttp.send();
}
function init()
{
    console.log('Team form javascript loaded!');
    let search_results = document.querySelectorAll('.search-results'); 
    for(let i=0; i<search_results.length; i++)
    {
        let input = document.getElementById( search_results[i].dataset.searchInput );    
        let search_image = search_results[i].dataset.searchImage;
        let search_output = search_results[i].dataset.searchOutput;
        input.addEventListener("keyup", function(e)
        {
            if(input.value.length > 1)
            {
                searchUser(search_results[i], search_results[i].dataset.searchInput, search_output, search_image, search_results[i].dataset.searchId );
            }
        });
        input.addEventListener("blur", function(e)
        {
            search_results[i].classList.add("hide");
        });
        input.addEventListener("focus", function(e)
        {
            search_results[i].classList.remove("hide");
            input.classList.remove("disabled");
            if(search_image)    document.getElementById(search_image).src = "";
            if(search_output)   document.getElementById(search_output).value = "";
        });
    }
}
init();
