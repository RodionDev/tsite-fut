<?php
namespace App\Http\Controllers;
namespace App\Http\Controllers\Auth\Api;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Match;
use App\Models\Role;
use JWTFactory;
use JWTAuth;
use Validator;
use Response;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
class APIMatchController extends Controller
{
    public function index()
    {
        return Match::all();
    }
    public function create()
    {
    }
    public function store(Request $request)
    {
    }
    public function show(Match $match)
    {
        return $match;
    }
    public function edit($id)
    {
    }
    public function update(Request $request, $id)
    {
    }
    public function destroy($id)
    {
    }
}
