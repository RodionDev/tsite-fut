<?php
namespace App\Http\Controllers\Pages;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
class ProfileController extends Controller
{
    public function index()
    {
        if(!Auth::check())  return \Redirect::back()->withErrors(['Je moet ingelogd zijn om je profiel te bekijken.']);
        $user = Auth::User();
        return view('/pages/profile')->with(['user' => $user, 'teams' => $user->teams]);
    }
}
