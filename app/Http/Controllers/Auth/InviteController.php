<?php
namespace App\Http\Controllers\Auth;
use App\Models\User;
use App\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
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
            event(new Registered($user = $this->create($request->all())));  
            return redirect($this->redirectPath()); 
        }
        abort(404);
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|string|email|max:199|unique:user',
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
        $role = Role::find($user->role_id);
        if( $user && $role->permission >= 2)   
        {
            return view('/pages/auth/invite');  
        }
        else    return redirect(route('home')); 
    }
}
