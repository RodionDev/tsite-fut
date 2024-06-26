<?php
namespace App\Http\Controllers\Pages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\UserController;
use App\Models\Team;
use App\Models\User;
use App\Models\Role;
use Validator;
class TeamController extends Controller
{
    public function search($name=null)
    {
        $name = ($name) ? $name : request()->name;
        return response()->json(
            Team::searchName($name)    ->distinct()->get()
        );
    }
    public function teamsList()
    {
        if(!Auth::check())  return \Redirect::back()->withErrors(['Je moet ingelogd zijn om teams te bekijken.']);
        $teams = Team::all();
        $user = Auth::User();
        $edit_all = ($user->role->permission >= 50);
        $leading_teams = Team::where('leader_id', $user->id)->get(['id']);
        $leading_teams_ids = [];
        foreach($leading_teams as $team)    $leading_teams_ids[] = $team->id;
        return view('pages/teams',
        [
            'teams' => $teams,
            'leading_teams' => $leading_teams_ids,
            'edit_all' => $edit_all
        ]
        );
    }
    private function isInTeam($player_id, $team_id)
    {
        $team = Team::find($team_id);
        $is_in_team = $team->players()->where('id', $player_id)->get()->first();
        if($is_in_team)    return true;
        else    return false;
    }
    public function create(Request $request, $update=false)
    {
        $this->validator($request->all())->validate();  
        if(!Auth::Check())  return \Redirect::back()->withErrors(['Je moet ingelogd zijn om een team aan te maken.']);
        $user = Auth::user();   
        $role = Role::Find($user->role_id); 
        if($update)
        {
            $team = Team::find($request->id);
            if(!$team)  return \Redirect::back()->withErrors(['Team niet gevonden.']);
        }
        else
            $team = new Team();
        if($role->permission < 50 && $team->leader_id !== $user->id)    return \Redirect::back()->withErrors(['Je hebt niet de juiste permissies om een team aan te maken.']);
        $team->name = $request->name;
        if($request->leader_id)
            $team->leader_id = $request->leader_id;
        elseif($request->leader)    
        {
            $user_controller = new UserController;
            $leader = $user_controller->search($request->leader);
            $leader_id = json_decode(json_encode($leader))->original[0]->id;
            if($leader) $team->leader_id = $leader_id;
            else        abort(404); 
        }
        else    return \Redirect::back()->withErrors(['Je hebt geen team leider ingesteld.']);
        $team->save();
        $team->players()->detach();
        if($request->users)
        {
            foreach($request->users as $player)
            {
                if(!$this->isInTeam($player, $team->id))
                    $team->players()->attach($player);
            }
        }
        if($request->hasFile('logo'))
        {
            $image_controller = new ImageController;
            $image_path = $image_controller->uploadImage($request->file('logo'), 'teams', $team->id);
            if($image_path)
            {
                $team->logo = $image_path;
                $team->save();
            }
        }
        return redirect(route('edit.team.route', $team->id));    
    }
    public function edit(Request $request)
    {
        return $this->create($request, true);
    }
    public function remove(int $id)
    {
        if(!Auth::Check())  return \Redirect::back()->withErrors(['Je moet ingelogd zijn om een team te verwijderen.']);
        $user = Auth::User();
        $team = Team::find($id);
        if(!$team)   return \Redirect::back()->withErrors(['Team niet gevonden.']);
        if($team->leader_id == $user->id || $user->role->permission >= 50)
        {
            $team->delete();
            return redirect(route('teams'));
        }
        else    return \Redirect::back()->withErrors(['Je hebt niet de juiste permissies om dit team te verwijderen.']);
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
            'logo' => 'image|nullable',
            'leader' => 'required|string',
            'leader_id' => 'integer|nullable',
        ]);
    }
    public function showNewForm()
    {
        if(!Auth::Check())  return \Redirect::back()->withErrors(['Je moet ingelogd zijn om een nieuw team aan te maken.']);
        $user = Auth::User();
        if($user->role->permission >= 30)
        {
            return view('/pages/new-team')->with('creating', true)->with('user', $user);
        }
        else    return \Redirect::back()->withErrors(['Je hebt niet de juiste permissies om een team aan te maken.']);
        return redirect(route('home'));
    }
    public function showEditForm(int $id)
    {
        if(!Auth::Check())  return \Redirect::back()->withErrors(['Je moet ingelogd zijn om een team aan te passen.']);
        $user = Auth::User();
        $team = Team::find($id);
        if(!$team)  return \Redirect::back()->withErrors(['Team niet gevonden.']);
        if($user->id == $team->leader_id || $user->role->permission >= 50)
        {
            $leader = $team->leader;
            return view('/pages/new-team')
                ->with('creating', false)
                ->with('team', $team)
                ->with('leader_name', $leader->getFullName())
                ->with('players', $team->players)
                ->with('user', $user);
        }
        else    return \Redirect::back()->withErrors(['Je hebt niet de juiste permissies om dit team aan te passen.']);
        return redirect(route('home'));
    }
}
