<?php
use Illuminate\Http\Request;
Route::post('user/register', 'Auth\Api\APIRegisterController@register');
Route::post('user/login', 'Auth\Api\APILoginController@login');
Route::get('teams', ['uses' => 'Auth\Api\APITeamController@index', 'middleware' => 'jwt.auth' ]);
Route::get('matchs',['uses' => 'Auth\Api\APIMatchController@index', 'middleware' => 'jwt.auth' ]);
Route::get('tournament', 'Auth\Api\APITournamentController@index' );
Route::get('poule', 'Auth\Api\APIPoolController@index');
Route::get('matches/{id}', 'Auth\Api\APITournamentController@viewTournament');
Route::get('eerstmatch/{id}', 'Auth\Api\APITournamentController@viewFirstmatch');
Route::middleware('jwt.auth')->get('users', function(Request $request) {
    $user = [JWTAuth::parseToken()->toUser()];
    return $user;
});
