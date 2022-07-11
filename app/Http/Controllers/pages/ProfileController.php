<?php
namespace App\Http\Controllers\Pages;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::User();
        return view('/pages/profile')->with(['user' => $user, 'teams' => $user->teams]);
    }
}
