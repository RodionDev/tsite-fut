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
use App\Http\Controllers\UserController;
class UpdateUserController extends Controller
{
    protected $redirectTo = '/';
    public function updateUser(Request $request)
    {
        if(Auth::Check())  
        {
            $this->updateValidator($request->all())->validate();  
            $user = Auth::User();   
            $user->fill($request->all());   
            if ($request->hasFile('avatar'))
            {
                $image_controller = new ImageController;
                $image_path = $image_controller->uploadImage($request->file('avatar'), 'avatars', (string)$user->id);
                if($image_path) $user->avatar = $image_path;
            }
            $user->save();  
            return redirect(route('profile')); 
        }
        abort(404);
    }
    public function register(Request $request)
    {  
        $this->registerValidator($request->all())->validate();  
        $user_controller = new UserController;
        $user = $user_controller->getUserWithToken($request->token);   
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
    protected function registerValidator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|string|max:199',
            'sur_name' => 'required|string|max:199',
            'avatar' => 'image',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }
    protected function updateValidator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'string|max:199',
            'sur_name' => 'string|max:199',
            'avatar' => 'image',
        ]);
    }
    public function editProfilePage()
    {
        if(Auth::Check())   return view("/pages/auth/update-user", ['registering' => 0, 'user' => Auth::User()]);
        abort(404); 
    }
    public function registerPage($token)
    {
        if($token)  
        {
            $user = DB::table('user')->where('register_token', $token)->first();    
            if($user)   
            {
                return view("/pages/auth/update-user", ['registering' => 1, 'register_token' => $token]);  
            }
        }
        abort(404); 
    }
}
