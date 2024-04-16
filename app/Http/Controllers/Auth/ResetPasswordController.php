<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use \Illuminate\Http\Request;
use App\Models\PasswordReset;
use App\Models\User;
class ResetPasswordController extends Controller
{
    use ResetsPasswords;
    protected $redirectTo = '/';
    public function ResetPassword(Request $request)
    {
        if(Auth::Check())
            $user = Auth::User();
        else
        {
            $reset_password = PasswordReset::where('token', $request->token)->first();
            $user = User::where('email', $reset_password->email)->first();
        }
        $user->password = Hash::make($request->password);   
        $user->save();  
        return redirect(route('home'));
    }
    public function getReset($token = null)
    {
        if (is_null($token))
        {
            throw new NotFoundHttpException;    
        }
        return redirect(route('reset.password')->with('token', $token));
    }
    public function showResetForm(Request $request, $token=null, $success=null)
    {
        if(Auth::check())   
            $email = Auth::user()->email;
        elseif($request->email) 
            $email = $request->email;
        else    
        {
            $email = PasswordReset::where('token', $token)->first()->email;
        }
        return view('pages/auth/reset-password',
            ['token' => $token, 'email' => $email, 'success' => $success]
        );
    }
    private function generateResetPasswordToken($length = 64)
    {
        $character_array = array_merge(range('a','z'), range('A', 'Z'), range('0','9'));
        $max = count($character_array)-1;
        $token = "";
        for ($i = 0; $i < $length; $i++)
        {
            $random_character = mt_rand(0, $max);
            $token .= $character_array[$random_character];
        }
        return $token;
    }
}
