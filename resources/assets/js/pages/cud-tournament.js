let placeholder_image = window.location.protocol + "
function removeList(close)
{
    close.parentNode.parentNode.remove();
}
function selectTeam(input, name=null, result_output=null, team_id=null, result_image=null, image=null, list=null)
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
        column1.classList.add('col', 's12', 'm2');
        column2.classList.add('col', 's12', 'm10');
        let name_input = document.createElement('input');
        name_input.type = 'checkbox';
        name_input.name = 'teams[]';
        name_input.value = team_id;
        name_input.readOnly = true;
        name_input.checked = true;
        let team_name = document.createTextNode(name);   
        let remove_icon = document.createElement('i');
        remove_icon.classList.add('mdi', 'mdi-close-circle', 'close', 'clickable');
        remove_icon.addEventListener("mousedown", removeList.bind(null, remove_icon), false);
        let logo = document.createElement('img');
        logo.classList.add('px52');   
        logo.src = (image) ? image : placeholder_image;   
        column1.appendChild(logo);
        column2.appendChild(name_input);
        column2.appendChild(team_name);
        column2.appendChild(remove_icon);
        player_li.appendChild(column1);
        player_li.appendChild(column2);
        output.appendChild(player_li);  
    }
    else
    {
        input_element.value = name;
        input_element.classList.add("disabled");
        if(result_output)   output.value = team_id;
        if(result_image)    document.getElementById(result_image).src = (image)? image : placeholder_image;
    }
}
function fillList(list, input, teams, result_output=null, result_image=null)
{
    list.innerHTML = '';
    let a_team_exists;
    for(let i=0; i<teams.length; i++)
    {
        let name = teams[i].name;
        let inputs = document.getElementById(result_output).getElementsByTagName("input");  
        let this_team_exists = false;    
        for(var j=0; j<inputs.length; j++)
        {
            if(inputs[j].value == name)
            {
                a_team_exists = true;
                this_team_exists = true;
                break;
            }
        }
        if(this_team_exists) break;
        let team_li = document.createElement('li'); 
        team_li.classList.add('collection-item', 'search-result', 'clickable');  
        team_li.addEventListener("mousedown", selectTeam.bind(null, input, name, result_output, teams[i].id, result_image, teams[i].logo, list), false);
        let team_name = document.createTextNode(name);   
        let image = document.createElement('img');
        image.classList.add('vertical-centre-image');   
        image.src = (teams[i].logo) ? teams[i].logo : placeholder_image;   
        team_li.appendChild(image);  
        team_li.appendChild(team_name); 
        list.appendChild(team_li);  
    }
    if( teams.length == 0 || (teams.length == 1 && a_team_exists) )
    {
        let team_li = document.createElement('li'); 
        let text = document.createTextNode( "Geen teams gevonden." );   
        team_li.classList.add('collection-item', 'search-result');  
        team_li.appendChild(text); 
        list.appendChild(team_li);  
    }
}
function searchTeam(list, input, result_output=null, result_image=null, limit_id=null)
{
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function()
    {
        console.log(this.responseText);
        if(this.readyState == 4 && this.status == 200)
        {
            return fillList(list, input, JSON.parse(this.responseText), result_output, result_image);
        }
    }
    if(limit_id)
        xmlhttp.open("GET", "/teams/search?name=" + document.getElementById(input).value + '&id=' + limit_id, true);
    else
        xmlhttp.open("GET", "/teams/search?name=" + document.getElementById(input).value, true);
    xmlhttp.send();
}
function initRemoves()
{
    let removes = document.getElementsByClassName('close');
    for(let i=0; i < removes.length; i++)
    {
        removes[i].addEventListener("mousedown", removeList.bind(null, removes[i]), false);
    }
}
function init()
{
    console.log('Tournament form javascript loaded!');
    initRemoves();
    let search_results = document.querySelectorAll('.search-results'); 
    for(let i=0; i<search_results.length; i++)
    {
        console.log('found the search results :)');
        let input = document.getElementById( search_results[i].dataset.searchInput );    
        let search_image = search_results[i].dataset.searchImage;
        let search_output = search_results[i].dataset.searchOutput;
        console.log('input: ' + input);
        console.log('search_image: ' + search_image);
        console.log('search_output: ' + search_output);
        input.addEventListener("keyup", function(e)
        {
            if(input.value.length > 1)
            {
                searchTeam(search_results[i], search_results[i].dataset.searchInput, search_output, search_image, search_results[i].dataset.searchId );
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
