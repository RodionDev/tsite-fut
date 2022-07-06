<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Http\Response;
class UserController extends Controller
{
    public function search($name=null, $id=null)
    {
        $name = ($name) ? $name : request()->name;
        if(request()->id || $id)
        {
            $id = ($id) ? $id : request()->id;
            return response()->json(
                User::searchName($name, $id)    ->distinct()->get()
            );
        }
        else
        {
            return response()->json(
                User::searchName($name)    ->distinct()->get()
            );
        }
    }
    public function generateNames(int $amount = 1, $region="England")
    {
        $json = json_decode(file_get_contents("https:
        return $json;
    }
    public function getRandomUserId($role=null)
    {
        $user = new User();
        return $user->getRandomUserId($role);
    }
    public function getUserWithToken($token)
    {
        $user = new User();
        return $user->getUserWithToken($token);
    }
}
