<?php

use App\Controllers\Auth\Login;
use App\Controllers\Auth\Register;
use App\Controllers\Classes;
use App\Controllers\Index;
use App\Controllers\Subject;
use App\Controllers\Users\Director;
use App\Controllers\Users\Student;
use App\Services\Route;
use App\Services\Session;

$route = new Route();
$route->get('/', Index::class, 'index');
$route->get('/login', Login::class, 'index')->only('auth');
$route->get('/register', Register::class, 'index')->only('auth');
if (Session::auth()) {
	//student
	$route->get('/student-dashboard', Student::class, 'index')->only('student');
	$route->get('/my-class', Student::class, 'myClass')->only('student');
	$route->get('/subjects', Subject::class, 'index')->only('student');
	//director
	$route->get('/director-dashboard', Director::class, 'index')->only('director');
	$route->get('/classes', Classes::class, 'index')->only('director');
		//subject
	$route->get('/create-subject', Subject::class, 'create')->only('director');
	$route->post('/create-subject', Subject::class, 'store')->only('director');
	$route->post('/edit-subject', Subject::class, 'edit')->only('director');
	$route->post('/update-subject', Subject::class, 'update')->only('director');
		//classes
	$route->get('/create-class', Classes::class,'create')->only('director');
	$route->post('/create-class', Classes::class,'store')->only('director');
	$route->get('/edit-class', Classes::class,'edit')->only('director');
}
$route->post('/auth/login', Login::class, 'login');
$route->post('/auth/register', Register::class, 'register');
$route->files('/auth/register', Register::class, 'register');
$route->post('/auth/logout', Session::class, 'logout');

$route->run();