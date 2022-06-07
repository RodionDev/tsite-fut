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
    public function teamsList()
    {
        $teams = Team::all();
        return view('pages/teams',
            ['teams' => $teams]
        );
    }
    public function create(Request $request, $update=false)
    {
        $this->validator($request->all())->validate();  
        if(Auth::Check()) 
        {
            $user = Auth::user();   
            $role = Role::Find($user->role_id); 
            if($role->permission >= 2)  
            {
                if($update)
                {
                    $team = Team::find($request->id);
                }
                else        $team = new Team();
                $team->name = $request->name;
                if($request->leader_id)
                    $team->leader_id = $request->leader_id;
                else    
                {
                    $user_controller = new UserController;
                    $leader = $user_controller->search($request->leader);
                    $leader_id = json_decode(json_encode($leader))->original[0]->id;
                    if($leader) $team->leader_id = $leader_id;
                    else        abort(404); 
                }
                $team->save();
                $team->players()->detach();
                if($request->users)
                {
                    foreach($request->users as $player)
                        $team->players()->attach($player);
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
                return redirect(route('teams'));    
            }
            abort(404); 
            return;
        }
    }
    public function edit(Request $request)
    {
        return $this->create($request, true);
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
        if(Auth::Check())
        {
            $user = Auth::User();
            if($user->role->permission >= 3)
            {
                return view('/pages/new-team')->with('creating', true);
            }
        }
        return redirect(route('home'));
    }
    public function showEditForm(int $id)
    {
        if(Auth::Check())
        {
            $user = Auth::User();
            if($user->role->permission >= 3)
            {
                $team = Team::find($id);
                $leader = $team->leader;
                return view('/pages/new-team')
                    ->with('creating', false)
                    ->with('team', $team)
                    ->with('leader_name', $leader->getFullName())
                    ->with('players', $team->players);
            }
        }
        return redirect(route('home'));
    }
}
