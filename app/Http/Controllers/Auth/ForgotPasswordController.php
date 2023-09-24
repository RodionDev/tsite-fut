<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use App\Models\User;
use App\Mail\Forgot;
class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;
    public function forgotPassword(Request $request)
    {
        $user = User::where('email', $request->email)->get()->first();  
        if($user && $user->last_seen)   
        {
            $token = $this->generateForgotPasswordToken();  
            $password_reset = PasswordReset::where('email', $user->email)->first(); 
            if(!$password_reset)
            {
                $password_reset = new PasswordReset();
                $password_reset->email = $user->email;
            }
            $password_reset->token = $token;
            $password_reset->created_at = time();
            $password_reset->save();
            Mail::to($user->email)->send(new Forgot( route('reset.password.token', $token) ));
            return redirect(route('forgot.password.route'));
        }
        abort(404); 
    }
    protected function generateForgotPasswordToken($length = 64)
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
}
