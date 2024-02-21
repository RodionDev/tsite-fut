<?php
Route::middleware(['auth'])->group(function ($router)
{
    Route::view('motm', 'pages/motm')   ->name('motm');
    $router->get('teams', 'pages\TeamController@teamsList')                     ->name('teams');
    $router->get('teams/toevoegen', 'pages\TeamController@showNewForm')         ->name('create.team.route');
    $router->get('teams/aanpassen/{id}', 'pages\TeamController@showEditForm')   ->name('edit.team.route');
    $router->get('teams/verwijderen/{id}', 'pages\TeamController@remove')       ->name('delete.team.route');
    $router->post('teams/toevoegen', 'pages\TeamController@create')             ->name('create.team');
    $router->post('teams/aanpassen', 'pages\TeamController@edit')               ->name('edit.team');
    $router->post('teams/verwijderen', 'pages\TeamController@remove')           ->name('delete.team');
    $router->get('toernooien', 'pages\TournamentController@tournamentsList')                ->name('tournaments');
    $router->get('toernooien/toevoegen', 'pages\TournamentController@showNewForm')          ->name('create.tournament.route');
    $router->get('toernooien/aanpassen/{id}', 'pages\TournamentController@showEditForm')    ->name('edit.tournament.route');
    $router->get('toernooien/verwijderen/{id}', 'pages\TournamentController@remove')        ->name('delete.tournament.route');
    $router->get('toernooi/scoreboard/{id}', 'pages\MatchController@showScoreboard')        ->name('scoreboard');   
    $router->post('toernooien/toevoegen', 'pages\TournamentController@create')              ->name('create.tournament');
    $router->post('toernooien/aanpassen', 'pages\TournamentController@edit')                ->name('edit.tournament');
    $router->post('toernooien/verwijderen', 'pages\TournamentController@remove')            ->name('delete.tournament');
    $router->get('toernooien/{id}', 'pages\TournamentController@viewTournament')            ->name('tournament');
    $router->get('wedstrijden/aanpassen/{id}', 'pages\MatchController@showEditForm')    ->name('match.edit.route');
    $router->post('wedstrijden/aanpassen', 'pages\MatchController@editByRequest')       ->name('match.edit');
    $router->get('wedstrijden/toevoegen/{tournament_id}', 'pages\MatchController@showCreateForm')  ->name('match.create.route');
    $router->post('wedstrijden/toevoegen', 'pages\MatchController@create')              ->name('match.create');
    $router->get('wedstrijden/verwijderen/{id}', 'pages\MatchController@remove')        ->name('match.delete.route');
    Route::get('profiel', 'Pages\ProfileController@index')                          ->name('profile');
    $router->post('profiel/aanpassen', 'Auth\UpdateUserController@updateUser')      ->name('profile.edit');
    Route::get('profiel/aanpassen', 'Auth\UpdateUserController@editProfilePage')    ->name('profile.edit.route');
    $router->post('uitnodigen', 'Auth\InviteController@invite');
    $router->get('uitnodigen', 'Auth\InviteController@index')   ->name('invite');
    $router->get('uitnodigen/{url}', 'Auth\InviteController@index')   ->name('invite.with.url');
    $router->post('uitloggen', 'Auth\LoginController@logout');
    Route::get('uitloggen', 'Auth\LoginController@logout')      ->name('logout');
    Route::get('users/search/{data?}', 'UserController@search');
    Route::get('teams/search/{data?}', 'Pages\TeamController@search');
});
Route::get('/', 'HomeController@index')->name('home');
$router->post('login', 'Auth\LoginController@login');
$router->get('login', 'Auth\LoginController@index') ->name('login');
$router->post('registreren', 'Auth\UpdateUserController@register');
$router->get('registreren/{token}', 'Auth\UpdateUserController@registerPage')   ->name('register');
$router->post('wachtwoord/vergeten', 'Auth\ForgotPasswordController@forgotPassword')        ->name('forgot.password');
Route::view('wachtwoord/vergeten', 'pages/auth/forgot-password')                            ->name('forgot.password.route');
$router->post('wachtwoord/aanpassen', 'Auth\ResetPasswordController@ResetPassword');
$router->get('wachtwoord/aanpassen/{token}', 'Auth\ResetPasswordController@showResetForm')        ->name('reset.password.token');
$router->get('wachtwoord/aanpassen', 'Auth\ResetPasswordController@showResetForm')                ->name('reset.password');
Route::view('algemene-voorwaarden', 'pages/terms-of-service') ->name('terms.of.service');
Route::view('privacy-statement', 'pages/privacy-statement') ->name('privacy.statement');
