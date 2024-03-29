<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    public function index()
    {
        if(Auth::check())
        {
            $user = Auth::user();
            $tournament = $user->tournaments(true)->first();
            if($tournament)
                return redirect(route('tournament', $tournament->id));
            else
            return redirect(route('tournaments'));
        }
        else                return redirect(route('login'));
    }
}
