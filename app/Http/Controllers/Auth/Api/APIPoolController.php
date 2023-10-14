<?php
namespace App\Http\Controllers;
namespace App\Http\Controllers\Auth\Api;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Pool;
use App\Models\Role;
use JWTFactory;
use JWTAuth;
use Validator;
use Response;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
class APIPoolController extends Controller
{
    public function index()
    {
        return Pool::all();
    }
    public function create()
    {
    }
    public function store(Request $request)
    {
    }
    public function show(Pool $pool)
    {
        return $pool;
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
