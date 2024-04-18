function scale_images()
{
    let images = document.getElementsByClassName('scale-image');    
    for(let i=0; i<images.length; i++)  
    {
        let requested_size = images[i].dataset.imageSize;   
        let width = images[i].naturalWidth;
        let height = images[i].naturalHeight;
        console.log(images[i]);
        console.log(width);
        console.log(height);
        if(width < height)  
        {
            images[i].style.height = requested_size + 'px';     
            images[i].style.width = 'auto';     
        }
        else    
        {
            images[i].style.height = 'auto';    
            images[i].style.width = requested_size + 'px';  
        }
    }
}
document.addEventListener('DOMContentLoaded', function()
{
    M.AutoInit();   
    let modals = document.getElementsByClassName('modal modal-default-open');
    for(let i=0; i<modals.length; i++)
    {
        M.Modal.getInstance(modals[i]).open();
    }
    scale_images();
});
