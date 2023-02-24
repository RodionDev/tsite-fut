<?php
namespace App\Http\Controllers\Pages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Match;
use App\Models\Role;
use App\Models\Result;
use App\Http\Controllers\Pages\TeamController;
use Validator;
class MatchController extends Controller
{
    public function editByRequest(Request $request)
    {
        return $this->edit($request, true);
    }
    public function remove($id)
    {
        $match = Match::find($id);
        $match->delete();
        return redirect( route('tournaments') );
    }
    public function create(Request $request)
    {
        return $this->edit($request, false);
    }
    public function edit(Request $request, $updating=true)
    {
        $this->validator($request->all())->validate();  
        if(Auth::Check()) 
        {
            $user = Auth::user();   
            $role = Role::Find($user->role_id); 
            if($role->permission >= 50 || $role->permission == 20)  
            {
                if($updating)   
                {
                    $match = Match::find($request->id);
                    $result1 = Result::find($match->result1->id);
                    $result2 = Result::find($match->result2->id);
                }
                else    
                {
                    $team_controller = new TeamController;
                    $match = new Match();
                    $result1 = new Result();
                    $result2 = new Result();
                    $match->has_ended = 0;
                    if($request->team1_id)
                        $result1->team_id = $request->team1_id;
                    else
                    {
                        $team = $team_controller->search($request->team1);
                        $team_id = json_decode(json_encode($team))->original[0]->id;
                        if($team) $result1->team_id = $team_id;
                        else        abort(404); 
                    }
                    if($request->team2_id)
                        $result2->team_id = $request->team2_id;
                    else
                    {
                        $team = $team_controller->search($request->team2);
                        $team_id = json_decode(json_encode($team))->original[0]->id;
                        if($team) $result2->team_id = $team_id;
                        else        abort(404); 
                    }
                    $result1->save();
                    $result2->save();
                    $match->result1_id = $result1->id;
                    $match->result2_id = $result2->id;
                    $match->save();
                }
                if($request->date)
                {
                    $time = ($request->time) ? $request->time : '';
                    $start = date('Y-m-d H:i:s', strtotime("$request->date $request->time"));
                    $match->start = $start;
                }
                if($request->field) $match->field = $request->field;
                if($request->tournament_id) $match->tournament_id = $request->tournament_id;
                if($request->score1 && $request->score2)
                {
                    $result1->score = $request->score1;
                    $result2->score = $request->score2;
                    $match->has_ended = 1;
                }
                $result1->save();
                $result2->save();
                $match->save();
                return redirect(route('match.edit.route', $match->id));
            }
        }
    }
    protected function validator(array $data)
    {
        return Validator::make($data,
        [
            'field' => 'integer|nullable',
            'time' => 'date_format:H:i|nullable',
            'date' => 'required_with:time|date|nullable',
            'score1' => 'required_with:score2|integer|nullable',
            'score2' => 'required_with:score1|integer|nullable',
        ]);
    }
    public function showCreateForm($tournament_id)
    {
        $user = Auth::user();
        $permission = $user->role()->first()->permission;
        return view("/pages/ud-match", 
        [
            'updating' => false,
            'permission' => $permission,
            'tournament_id' => $tournament_id,
        ]);  
    }
    public function showEditForm($id)
    {
        $user = Auth::user();
        $permission = $user->role()->first()->permission;
        $match = Match::find($id);
        $start_time=null;
        $start_date=null;
        if($match->start)
        {
            $start_time = date_format(date_create($match->start), "H:i");
            $start_date = date_format(date_create($match->start), "Y-m-d");
        }
        return view("/pages/ud-match", 
        [
            'updating' => true,
            'match' => $match,
            'permission' => $permission,
            'start_time' => $start_time,
            'start_date' => $start_date
        ]);  
    }
}
