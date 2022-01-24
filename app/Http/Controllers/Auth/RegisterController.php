<?php
namespace App\Http\Controllers\Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\ImageController;
class RegisterController extends Controller
{
    protected $redirectTo = '/';
    public function register(Request $request)
    {  
        $this->validator($request->all())->validate();  
        $user = DB::table('user')->where('register_token', $request->token)->first();   
        if($user !== null)  
        {
            $user = User::find($user->id);  
            $user->fill($request->all());   
            $user->password = Hash::make($request->password);   
            $user->register_token = null;   
            $user->last_seen = new \DateTime(); 
            if ($request->hasFile('avatar'))
            {
                $image_controller = new ImageController;
                $image_path = $image_controller->uploadImage($request->file('avatar'), 'avatars', (string)$user->id);
                if($image_path) $user->avatar = $image_path;
            }
            $user->save();  
            Auth::loginUsingId($user->id);  
            return redirect(route('home')); 
        }
        abort(404);
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|string|max:199',
            'sur_name' => 'required|string|max:199',
            'avatar' => 'image',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }
    public function index($token = null)
    {
        if($token)  
        {
            $user = DB::table('user')->where('register_token', $token)->first();    
            if($user)   
            {
                return view('/pages/auth/register', ['register_token' => $token]);  
            }
        }
        abort(404); 
    }
}
