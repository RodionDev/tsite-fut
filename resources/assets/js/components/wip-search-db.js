let placeholder_image = window.location.protocol + "
    window.location.host + '/images/image-missing.png';
function removeListItem(element)
{
    element.closest(li).remove();
}
function addEventListenersToRemoves()
{
    let remove_buttons = document.getElementsByClassName('close'); 
    for(let i=0; i < remove_buttons.length; i++)   
        remove_buttons[i].addEventListener( 
            "mousedown",
            removeListItem.bind(null, remove_buttons[i]),
            false
        );  
}
function selectItemList(table, item_id, item_name, image_path)
{
    list_store_location = document.getElementById(list_store_location_id);
    let list_item = document.createElement('li');
    let column1 = document.createElement('div');
    let column2 = document.createElement('div');
    list_item.classList.add('collection-item', 'row'); 
    column1.classList.add('col', 's12', 'm2');
    column2.classList.add('col', 's12', 'm10');
    let input = document.createElement('input');
    input.type = 'checkbox';
    input.name = table + '[]';
    input.value = item_id;
    input.readOnly = true;
    input.checked = true;
    let item_name_element = document.createTextNode(item_name);   
    let remove_icon = document.createElement('i');
    remove_icon.classList.add('mdi', 'mdi-close-circle', 'close', 'clickable');
    remove_icon.addEventListener("mousedown", removeListItem.bind(null, remove_icon), false);
    let item_image = document.createElement('img');
    item_image.classList.add('px52');   
    item_image.src = image_path;   
    column1.appendChild(avatar);
    column2.appendChild(input);
    column2.appendChild(item_name_element);
    column2.appendChild(remove_icon);
    list_item.appendChild(column1);
    list_item.appendChild(column2);
    list_store_location.appendChild(list_item);  
}
function selectItemInput(selected_store_location_id, input_id, item_id, item_name, image_id, image_path)
{
    let selected_store_location = document.getElementById(selected_store_location_id);
    let input = document.getElementById(input_id);
    let image = document.getElementById(image_id);
    input.value = item_name;    
    input.classList.add("disabled");    
    selected_store_location.value = item_id;    
    image.src = image_path;  
}
function fillResults(results, results_list_id, input_id, selected_store_location_id)
{
    let results_list = document.getElementById(results_list_id);
    let input = document.getElementById(input_id);
    let selected_store_location = document.getElementById(selected_store_location_id);
    results_list.innerHTML = "";
    input.value = "";
    for(let i=0; i<results.length; i++)
    {
        let name = (results[i].name) ? results[i].name :
        results[i].first_name + ' ' + results[i].sur_name;
        let inputs = document.getElementById(result_output).getElementsByTagName("input");  
    }
}
function searchDB(input_id)
{
    let input = document.getElementById(input_id);
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function()
    {
        if(this.readyState == 4 && this.status == 200)  
        {
            return ;
        }
    }
    xmlhttp.open("GET", "/" + table + "/search?name=" + input_id.value);
    xmlhttp.send();
}
function initSearchDB()
{
    console.log("Initialising SearchDB.");
    addEventListenersToRemoves();
    let results_lists = document.querySelectorAll('.search-results');  
    for(let i=0; i<results_lists.length; i++)  
    {
        let input = document.getElementById( results_lists[i].dataset.searchInput );    
        let selected_store_image_location = results_lists[i].dataset.selectedStoreImageLocation;   
        let selected_store_location = results_lists[i].dataset.selectedStoreLocation; 
        input.addEventListener("keyup", function(e)
        {
            if(input.value.length > 1)
                searchDB();
        });
        input.addEventListener("focus", function(e)
        {
            results_lists[i].classList.remove("hide");
            input.classList.remove("disabled");
            if(selected_store_image_location)
                document.getElementById(search_image).src = "";
            if(selected_store_location)
                document.getElementById(search_output).value = "";
        });
        input.addEventListener("blur", function(e)
        {
            results_lists[i].classList.add("hide");
        });
    }
}
