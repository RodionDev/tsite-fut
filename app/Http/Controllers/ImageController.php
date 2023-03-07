<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
class ImageController extends Controller
{
    public function uploadImage($image, $folder=null, $image_name=null)
    {
        if($image->isValid())
        {
            if($image_name == null) $image_name = md5(microtime());
            $images_root = ($folder) ?
            '\images\\' . $folder . '\\' : 
            '\images\\';
            if($folder) $this->createFolder($folder);
            if(file_exists($images_root . $image_name))    removeImage($image_name, $folder);
            $image->move(public_path() . $images_root, $image_name . '.' . $image->getClientOriginalExtension());
            return $images_root . $image_name . '.' . $image->getClientOriginalExtension();
        }
        else    return false;
    }
    public function removeImage($image_name, $folder=null)
    {
        $image = ($folder) ?
            public_path() . '\images\\' . $folder . '\\' . $image_name : 
            public_path() . '\images\\' . $image_name;
        if($folder) $this->createFolder($folder);
        if(file_exists($image))
        {
            unlink($image);
            return true;
        }
        else    return false;
    }
    protected function createFolder($folder)
    {
        $folder_path = public_path() . '\images\\' . $folder;   
        if(!file_exists($folder_path))  mkdir($folder_path);    
    }
}
