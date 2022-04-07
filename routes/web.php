<?php
Route::middleware(['auth'])->group(function ($router) {
    Route::view('toernooi', 'pages/tournament')                     ->name('tournament');
    $router->get('teams', 'pages\TeamController@teamsList');
    $router->get('team-toevoegen', 'pages\TeamController@showNewForm');
    $router->post('team-toevoegen', 'pages\TeamController@create')   ->name('create.team');
    Route::get('profiel', 'Pages\ProfileController@index')     ->name('profile');
    $router->post('profiel-aanpassen', 'Auth\UpdateUserController@updateUser');
    Route::get('profiel-aanpassen', 'Auth\UpdateUserController@editProfilePage')     ->name('profile');
    $router->post('uitnodigen', 'Auth\InviteController@invite');
    $router->get('uitnodigen', 'Auth\InviteController@index')   ->name('invite');
    $router->post('uitloggen', 'Auth\LoginController@logout');
    Route::get('uitloggen', 'Auth\LoginController@logout')      ->name('logout');
    Route::get('users/search/{data?}', 'UserController@search');
});
Route::get('/', 'HomeController@index')->name('home');
$router->post('login', 'Auth\LoginController@login');
$router->get('login', 'Auth\LoginController@index')         ->name('login');
$router->post('registreren', 'Auth\UpdateUserController@register');
$router->get('registreren/{token}', 'Auth\UpdateUserController@registerPage')           ->name('register');
$router->post('wachtwoord-vergeten', 'Auth\ForgotPasswordController@sendResetLinkEmail')    ->name('forgot.password');
Route::view('wachtwoord-vergeten', 'pages/auth/forgot-password');
$router->post('reset-wachtwoord', 'Auth\ResetPasswordController@ResetPassword');
Route::get('reset-wachtwoord/{token}', 'Auth\ResetPasswordController@showResetForm')        ->name('reset.password.token');
Route::get('reset-wachtwoord', 'Auth\ResetPasswordController@showResetForm')->name('reset.password');
