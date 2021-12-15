<?php
Route::view('toernooi', 'pages/tournament')->name('tournament');
Route::view('profiel', 'pages/profile')->name('profile');
$router->post('login', 'Auth\LoginController@login');
Route::view('login', '/pages/auth/login')                   ->name('login');
$router->post('uitloggen', 'Auth\LoginController@logout');
Route::get('uitloggen', 'Auth\LoginController@logout')                                 ->name('logout');
$router->post('registreren', 'Auth\RegisterController@register');
Route::view('registreren', 'pages/auth/register')->name('register');
$router->post('wachtwoord/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
$router->post('wachtwoord/vergeten', 'Auth\ResetPasswordController@reset');
Route::get('wachtwoord/vergeten/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::get('wachtwoord/vergeten', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
Route::get('/', 'HomeController@index')->name('home');
