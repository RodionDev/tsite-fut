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
            if(!$request->token)    return \Redirect::back()->withErrors(['Je moet ingelogd zijn of een token meegeven.']);
            $reset_password = PasswordReset::where('token', $request->token)->first();
            if(!$reset_password)    return \Redirect::back()->withErrors(['Token is niet correct of verlopen.']);
            $user = User::where('email', $reset_password->email)->first();
            if(!$user)  return \Redirect::back()->withErrors(['Token hoort bij geen gebruiker.', 'Neem contact op met een beheerder. ERROR:resetpassword01']);
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
        elseif($token)    
        {
            $email = PasswordReset::where('token', $token)->first()->email;
        }
        else    return \Redirect::back()->withErrors(['Je bent niet ingelogd en hebt geen email of token aangegeven.']);
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
