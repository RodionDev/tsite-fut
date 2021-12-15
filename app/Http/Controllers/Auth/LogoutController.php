<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
class LogoutController extends Controller
{
    protected $redirectTo = '/';
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
