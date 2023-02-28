<?php
use Illuminate\Http\Request;
Route::post('user/register', 'Auth\Api\APIRegisterController@register');
Route::post('user/login', 'Auth\Api\APILoginController@login');
Route::get('teams', ['uses' => 'Auth\Api\APITeamController@createTeam', 'middleware' => 'jwt.auth' ]);
Route::get('matchs',['uses' => 'Auth\Api\APIMatchController@index', 'middleware' => 'jwt.auth' ]);
Route::get('tournament', 'Auth\Api\APITournamentController@index' );
Route::get('poule', 'Auth\Api\APITournamentController@index');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('api/users', ['before' => 'jwt-auth', function() {
    $user = JWTAuth::parseToken()->toUser();
    return Response::json(compact('user'));
}]);
