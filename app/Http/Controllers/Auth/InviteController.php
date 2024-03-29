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
        if(!Auth::Check())  return \Redirect::back()->withErrors(['Je moet ingelogd zijn om mensen uit te nodigen.']);
        $user = Auth::user();   
        $role = Role::find($user->role_id); 
        if($role->permission <= Role::find($request->role)->permission)     return \Redirect::back()->withErrors(['Je kan geen gebruikers uitnodigen met een rol hoger of gelijk aan jezelf.' ]);
        $invited_user = User::where('email', $request->email)->get()->first();   
        $invited_user_object = null;
        if(!$invited_user)
            event(new Registered( $invited_user = $this->create($request->all() )));  
        elseif($invited_user->last_seen !== null)
            abort(404);
        else
        {
            $invited_user_object = User::find($invited_user->id);
            if(!$invited_user_object)   return \Redirect::back()->withErrors(['Gebruiker bestaat, is nog niet geregistreerd, maar ook nog niet uitgenodigd.', 'Neem contact op met een beheerder! ERROR:invite01']);
            $invited_user_object->register_token = $this->generateRegisterToken();
            $invited_user_object->save();
        }
        if($invited_user_object)
            Mail::to($invited_user->email)->send(new Invite(route('register', ['token' => $invited_user_object->register_token])));
        else
            Mail::to($invited_user->email)->send(new Invite(route('register', ['token' => $invited_user->register_token])));
        if (Mail::failures()) {
            return \Redirect::back()->withErrors(['Er is iets verkeerd gegaan bij het versturen van een mail', 'Neem contact op met een beheerder! ERROR:invite02']);
        }
        if($request->request_url)
        {
            if($invited_user_object)
                $request_url = $invited_user_object->register_token;
            else
                $request_url = $invited_user->register_token;
            return redirect(route('invite.with.url', $request_url));    
        }
        return redirect($this->redirectPath()); 
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
    public function index($url = null)
    {
        if(!Auth::check())  return \Redirect::back()->withErrors(['Je moet ingelogd zijn om mensen uit te nodigen.']);
        $user = Auth::user();   
        $user_role = Role::find($user->role_id);
        if( $user && $user_role->permission >= 30)   
        {
            $roles = Role::where('permission', '<', $user_role->permission)->get()->all();  
            return view('/pages/auth/invite')->with('roles', $roles)->with('url', $url);  
        }
        else    return \Redirect::back()->withErrors(['Je hebt niet de juiste permissies om een gebruiker uit te nodigen.']);
    }
}
