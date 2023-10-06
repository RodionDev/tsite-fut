<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class ResetPasswordController extends Controller
{
    use ResetsPasswords;
    protected $redirectTo = '/';
    public function ResetPassword(Request $request)
    {
        if(Auth::Check())
        {
            $user = Auth::User();
            $user->password = Hash::make($request->password);   
            $user->save();  
        }
        else    $this->reset($request);
        return $this->showResetForm($request, null, true);
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
        $email = (Auth::Check()) ? Auth::User()->email : $request->email;
        return view('pages/auth/reset-password',
            ['token' => $token, 'email' => $email, 'success' => $success]
        );
    }
}
