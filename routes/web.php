<?php
Route::middleware(['auth'])->group(function () {
    Route::view('toernooi', 'pages/tournament') ->name('tournament');
    Route::view('profiel', 'pages/profile')     ->name('profile');
});
Route::get('/', 'HomeController@index')->name('home');
Route::view('afbeelding-uploaden', 'file-upload');
Route::post('afbeelding-uploaden', ['as'=>'afbeelding-uploaden','uses'=>'HomeController@fileUpload']);
Route::post('fileUpload', ['as'=>'fileUpload','uses'=>'HomeController@fileUpload']);
$router->post('login', 'Auth\LoginController@login');
$router->get('login', 'Auth\LoginController@index')         ->name('login');
$router->post('uitloggen', 'Auth\LoginController@logout');
Route::get('uitloggen', 'Auth\LoginController@logout')      ->name('logout');
$router->post('registreren', 'Auth\RegisterController@register');
$router->get('registreren/{token}', 'Auth\RegisterController@index')           ->name('register');
$router->post('uitnodigen', 'Auth\InviteController@invite');
$router->get('uitnodigen', 'Auth\InviteController@index')   ->name('invite');
$router->post('wachtwoord/vergeten', 'Auth\ForgotPasswordController@sendResetLinkEmail')    ->name('forgot.password');
Route::view('wachtwoord/vergeten', 'pages/auth/forgot-password');
$router->post('reset/wachtwoord', 'Auth\ResetPasswordController@reset')                     ->name('reset.password');
Route::get('reset/wachtwoord', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::get('reset/wachtwoord/{token}', 'Auth\ResetPasswordController@showResetForm');
