<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Http\Response;
class UserController extends Controller
{
    public function search()
    {
        return response()->json(
            User::searchName(request()->name, 3)    ->distinct()->get()
        );
    }
}
