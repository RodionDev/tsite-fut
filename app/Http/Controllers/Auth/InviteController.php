<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Mail\Invite;
class InviteController extends Controller
{
    use RegistersUsers;
    protected $redirectTo = '/uitnodigen';
    public function invite(Request $request)
    {
        $this->validator($request->all())->validate();  
        if(Auth::Check()) 
        {    
            $user = Auth::user();   
            $role = Role::find($user->role_id); 
            if($role->permission <= Role::find($request->role)->permission) abort(404);   
            $invited_user = User::where('email', $request->email)->get()->first();   
            if(!$invited_user)
                event(new Registered( $invited_user = $this->create($request->all() )));  
            elseif($invited_user->last_seen !== null)
                abort(404);
            else
            {
                $invited_user_object = User::find($invited_user->id);
                $invited_user_object->register_token = $this->generateRegisterToken();
                $invited_user_object->save();
            }
            Mail::to($invited_user->email)->send(new Invite(route('register', ['token' => $invited_user->register_token])));
            if (Mail::failures()) {
                abort(404);
            }
            return redirect($this->redirectPath()); 
        }
        abort(404);
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|string|email|max:199',
            'role' => 'required|int|max:4',
        ]);
    }
    protected function create(array $data)
    {
        return User::create([
            'email' => $data['email'],
            'role_id' => $data['role'],
            'register_token' => $this->generateRegisterToken(),
        ]);
    }
    protected function generateRegisterToken($length = 64)
    {
        $character_array = array_merge(range('a','z'), range('A', 'Z'), range('0','9'));
        $max = count($character_array)-1;
        $url = "";
        for ($i = 0; $i < $length; $i++)
        {
            $random_character = mt_rand(0, $max);
            $url .= $character_array[$random_character];
        }
        return $url;
    }
    public function index()
    {
        $user = Auth::user();   
        $user_role = Role::find($user->role_id);
        if( $user && $user_role->permission >= 30)   
        {
            $roles = Role::where('permission', '<', $user_role->permission)->get()->all();  
            return view('/pages/auth/invite')->with('roles', $roles);  
        }
        else    return redirect(route('home')); 
    }
}
