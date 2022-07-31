<?php
namespace App\Http\Controllers\Pages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Tournament;
use App\Models\Pool;
use Validator;
use DateTime;
class TournamentController extends Controller
{
    public function tournamentsList()
    {
        $user = Auth::User();
        $current_date = date('Y-m-d');  
        if($user->role->permission >= 50)
        {
            $current = Tournament::where('mott_id', null)->whereDate('start_date', '<=', $current_date)->get(); 
            $upcoming = Tournament::whereDate('start_date', '>', $current_date)->get(); 
            $finished = Tournament::whereNotNull('mott_id')->whereDate('start_date', '<', $current_date)->get();    
            $can_edit = true;
        }
        else
        {
            $tournaments = $user->tournaments();
            $current = $tournaments->where('mott_id', null)->whereDate('start_date', '<=', $current_date)->get(); 
            $upcoming = $tournaments->whereDate('start_date', '>', $current_date)->get(); 
            $finished = $tournaments->whereNotNull('mott_id')->whereDate('start_date', '<', $current_date)->get();    
            $can_edit = false;
        }
        return view('pages/tournaments',
        [
            'current_tournaments' => $current,
            'upcoming_tournaments' => $upcoming,
            'finished_tournaments' => $finished,
            'can_edit' => $can_edit
        ]
        );
    }
    public function create(Request $request, $update=false)
    {
        $this->validator($request->all())->validate();  
        if(Auth::Check()) 
        {
            $user = Auth::user();   
            $role = Role::Find($user->role_id); 
            if($update)
                $tournament = Tournament::find($request->id);
            else
                $tournament = new Tournament();
            if($role->permission >= 50)  
            {                
                $tournament->name = $request->name;
                $tournament->start_date = $request->start_date;
                $tournament->end_date = $request->end_date;
                $tournament->save();
                $tournament->pools()->detach();
                if($request->pools)
                {
                    $number = 1;    
                    foreach($request->pools as $pool)   
                    {
                        $new_pool = new Pool();
                        $new_pool->finished = 0;
                        $new_pool->tournament_id = $tournament->id;
                        $new_pool->number = $number;
                        $number++;
                        foreach($pool->teams as $team)
                            $new_pool->teams()->attach($team);
                    }
                }
                return redirect(route('tournaments'));    
            }
            abort(404); 
        }
    }
    public function edit(Request $request)
    {
        return $this->create($request, true);
    }
    public function remove(int $id)
    {
        if(Auth::Check())
        {
            $user = Auth::User();
            $tournament = Tournament::find($id);
            if($user->role->permission >= 50)
            {
                $tournament->delete();
                return redirect(route('tournaments'));
            }
        }
    }
    public function removeByRequest(Request $request)
    {
        return $this->remove($request->id);
    }
    protected function validator(array $data)
    {
        return Validator::make($data,
        [
            'name' => 'required|string|max:199',
            'start_date' => 'date|required',
            'end_date' => 'date|nullable',
            'mott_id' => 'integer|nullable',
        ]);
    }
    public function showNewForm()
    {
        if(Auth::Check())
        {
            $user = Auth::User();
            if($user->role->permission >= 50)
            {
                return view('/pages/cud-tournament')->with('creating', true);
            }
        }
        return redirect(route('home'));
    }
    public function showEditForm(int $id)
    {
        if(Auth::Check())
        {
            $user = Auth::User();
            $tournament = Tournament::find($id);
            if($user->role->permission >= 50)
            {
                $team = Team::find($id);
                return view('/pages/cud-tournament')
                    ->with('creating', false)
                    ->with('tournament', $tournament);
            }
            else    abort(404);     
        }
        return redirect(route('home'));
    }
}
