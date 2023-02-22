<?php
use Illuminate\Http\Request;
Route::post('user/register', 'Auth\Api\APIRegisterController@register');
Route::post('user/login', 'Auth\Api\APILoginController@login');
Route::get('teams',  'Auth\Api\APITeamController@index');
Route::get('matchs', 'Auth\Api\APIMatchController@index');
Route::get('tournament', 'Auth\Api\APITournamentController@index' );
Route::get('poule', 'Auth\Api\APITournamentController@index');
Route::middleware('jwt.auth')->get('users', function(Request $request) {
    $user = JWTAuth::parseToken()->toUser();
    return $user;
});
