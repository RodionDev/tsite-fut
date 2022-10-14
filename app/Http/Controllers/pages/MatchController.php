<?php
namespace App\Http\Controllers\Pages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Match;
use App\Models\Role;
use App\Models\Result;
use Validator;
class MatchController extends Controller
{
    public function edit(Request $request)
    {
        $this->validator($request->all())->validate();  
        if(Auth::Check()) 
        {
            $user = Auth::user();   
            $role = Role::Find($user->role_id); 
            $match = Match::find($request->id);
            if($role->permission >= 50 || $role->permission == 20)  
            {
                $start = date('Y-m-d H:i:s', strtotime("$request->date $request->time"));
                $match->start = $start;
                if($request->field) $match->field = $request->field;
                if($request->score1 !== null && $request->score2 !== null)
                {
                    $result1 = Result::find($match->result1->id);
                    $result1->score = $request->score1;
                    $result1->save();
                    $result2 = Result::find($match->result2->id);
                    $result2->score = $request->score2;
                    $result2->save();
                    $match->has_ended = 1;
                }
                $match->save();
                return redirect(route('home'));
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
            'score1' => 'integer|nullable',
            'score2' => 'required_with:score1|integer',
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
            'match' => $match,
            'permission' => $permission,
            'start_time' => $start_time,
            'start_date' => $start_date
        ]);  
    }
}
