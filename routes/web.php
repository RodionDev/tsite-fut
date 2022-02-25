<?php
Route::get('/', function () {
    return view('welcome');
});
Route::view('toernooi', 'pages/tournament');
