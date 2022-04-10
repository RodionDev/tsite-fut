<?php
namespace App\Http\Controllers\Pages;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Team;
class TeamController extends Controller
{
    public function teamsList()
    {
        $teams = Team::all();
        return view('pages/teams',
            ['teams' => $teams]
        );
    }
    public function create()
    {
    }
    public function showNewForm()
    {
        if(Auth::Check())
        {
            $user = Auth::User();
            if($user->role->permission >= 3)
            {
                return view('/pages/new-team');
            }
        }
        return redirect(route('home'));
    }
}
