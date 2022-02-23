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
}
