<?php
namespace App\Http\Controllers\Pages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ImageController;
use App\Models\Team;
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
    public function create(Request $request)
    {
        $this->validator($request->all())->validate();  
        if(Auth::Check()) 
        {
            $user = Auth::user();   
            $role = Role::Find($user->role_id); 
            if($role->permission >= 2)  
            {
                $team = new Team();
                $team->name = $request->name;
                $team->leader_id = $request->leader_id;
                $team->save();
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
                return redirect(route('create.team'));
            }
            abort(404); 
        }
    }
    protected function validator(array $data)
    {
        return Validator::make($data,
        [
            'name' => 'required|string|max:199',
            'logo' => 'image',
            'leader' => 'required|string',
            'leader_id' => 'int',
        ]);
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
