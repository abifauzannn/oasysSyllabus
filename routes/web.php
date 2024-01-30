<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\GenerateController;
use Illuminate\Auth\Events\Login;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auths.login');
});

Route::get('/register', function () {
    return view('auths.register');
});

Route::get('/otp', function () {
    return view('auths.otp');
});

Route::get('/profile', function () {
    return view('auths.profile');
});

Route::get('/dashboard', function () {
    return view('syllabusPages.dashboard');
});

Route::get('/syllabus', function () {
    return view('syllabusPages.syllabus');
});


Route::get('/dashboard', function () {
    return view('syllabusPages.dashboard');
});

Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/login', [LoginController::class, 'showLoginForm']);
// routes/web.php

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::post('/generate-syllabus', [GenerateController::class, 'generateSyllabus'])->name('generate-syllabus');

Route::get('/login/google', [LoginController::class, 'redirectToGoogle']);
Route::get('/api/login/google/callback', [LoginController::class, 'handleGoogleCallback']);
