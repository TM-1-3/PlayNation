<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\SetupController;
use App\Http\Controllers\UserController; 
use App\Http\Controllers\AdminController; 

// Home
Route::redirect('/', '/login');

// Authentication
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'authenticate')->name('login.action');
});

Route::controller(LogoutController::class)->group(function () {
    Route::post('/logout', 'logout')->name('logout');
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'showRegistrationForm')->name('register');
    Route::post('/register', 'register')->name('register.action');
});

// Admin
Route::controller(AdminController::class)->group(function () {
    Route::get('/admin', 'showAdminPage')->name('admin');
    Route::get('/admin/user', 'searchUser')->name('admin.user');
    Route::get('/admin/create', 'showCreateUserForm')->name('admin.create');
    Route::post('/admin/create', 'createUser')->name('admin.create.action');
});

Route::get('/home', function () {
    return view('pages.home');
})->name('home');

// Groups 
Route::get('/groups', function () {
    return view('pages.groups');
})->name('groups');


// Profile
Route::get('/profile/setup', [SetupController::class, 'show'])->name('profile.setup');
Route::post('/profile/setup', [SetupController::class, 'store'])->name('profile.setup.store');

// test route for user profile
Route::get('/profile/{id}', [UserController::class, 'show'])->name('profile.show');

Route::middleware(['auth'])->group(function () {

    Route::get('/profile/{id}/edit', [UserController::class, 'edit'])->name('profile.edit');
    
    Route::put('/profile/{id}', [UserController::class, 'update'])->name('profile.update');
});
