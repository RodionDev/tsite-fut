<?php
use Illuminate\Http\Request;
Route::post('user/register', 'Auth\Api\APIRegisterController@register');
Route::post('user/login', 'Auth\Api\APILoginController@login');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('jwt.auth')->get('users', function(Request $request) {
    return auth()->user();
});
Route::get('articles', 'ArticleController@index');
Route::get('article/{id}', 'ArticleController@show');
Route::post('articles', 'ArticleController@store');
Route::put('articles', 'ArticleController@store');
Route::delete('articles', 'ArticleController@destroy');
