<?php
namespace App\Http\Controllers\Auth\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use JWTFactory;
use JWTAuth;
use Validator;
use Response;
use Illuminate\Auth\Events\Registered;
class APIRegisterController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:user',
            'first_name' => 'required',
            'sur_name' => 'required',
            'role' => 'required|int|max:4',
            'password'=> 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        event(new Registered($user = $this->create($request->all())));  
        return response('User created', 200);
    }
    public function create(array $request)
    {
        return User::create([
            'first_name' => $request['first_name'],
            'sur_name' => $request['sur_name'],
            'email' => $request['email'],
            'role_id' => $request['role'],
            'password' => bcrypt($request['password']),
            'register_token' => 'test',
        ]);
    }
}
