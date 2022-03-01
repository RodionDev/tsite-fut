document.addEventListener('DOMContentLoaded', function()
{
    M.AutoInit();   
    let elements = document.getElementsByClassName('modal modal-default-open');
    for(let i=0; i<elements.length; i++)
    {
        M.Modal.getInstance(elements[i]).open();
    }
});
