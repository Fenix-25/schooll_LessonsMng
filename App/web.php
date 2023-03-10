<?php

use App\Controllers\Auth\Login;
use App\Controllers\Auth\Register;
use App\Services\Route;
use App\Services\Session;

Route::page('/', 'pages/index');
Route::page('/login', 'auth/login');
Route::page('/register', 'auth/register');
if (Session::auth()) {
    Route::page('/dashboard', '/pages/dashboard');
   // Route::page('/student-dashboard', '/pages/student-dashboard');
}
Route::post('/auth/login', Login::class, 'login', true);
Route::post('/auth/register', Register::class, 'register', true, true);
Route::post('/auth/logout', Session::class, 'logout');

Route::run();