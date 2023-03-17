<?php
namespace App\Http\Controllers;
namespace App\Http\Controllers\Auth\Api;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Tournament;
use App\Models\Team;
use App\Models\Role;
use JWTFactory;
use JWTAuth;
use Validator;
use Response;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
class APITournamentController extends Controller
{
    public function index()
    {
        return Tournament::all();
    }
    public function create()
    {
    }
    public function store(Request $request)
    {
    }
    public function show(Tournament $tournament)
    {
        return $tournament;
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
