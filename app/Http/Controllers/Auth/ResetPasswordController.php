<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use \Illuminate\Http\Request;
class ResetPasswordController extends Controller
{
    use ResetsPasswords;
    protected $redirectTo = '/';
    public function getReset($token = null)
    {
        if (is_null($token))
        {
            throw new NotFoundHttpException;    
        }
        return redirect(route('reset.password')->with('token', $token));
    }
    public function showResetForm(Request $request, $token)
    {
        return view('pages/auth/reset-password',
            ['token' => $token, 'email' => $request->email]
        );
    }
}
