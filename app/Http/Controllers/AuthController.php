<?php
namespace App\Http\Controllers;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Request;
class AuthController extends Controller
{
    public function login(Request $request)
	{
	    $credentials = $request->only('email', 'password');
	    if ( ! $token = JWTAuth::attempt($credentials)) {
	            return response([
	                'status' => 'error',
	                'error' => 'invalid.credentials',
	                'msg' => 'Invalid Credentials.'
	            ], 400);
	    }
	    return response([
	            'status' => 'success',
				'token' => $token
	        ]);
	}
	public function decode(Token $token) {
		$payload = $this->payloadFactory>setRefreshFlow($this->refreshFlow)->make($payloadArray);
		return $payload;
	  }
}
