<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\SetupController;
use App\Http\Controllers\Auth\RecoverPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\TimelineController;
use App\Http\Controllers\UserController; 
use App\Http\Controllers\AdminController; 
use App\Http\Controllers\PostController;
use App\Http\Controllers\FileController; 

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

Route::controller(RecoverPasswordController::class)->group(function () {
    Route::get('/recoverPassword', 'showRecoverPasswordForm')->name('recoverPassword');;
    Route::post('/recoverPassword', 'sendRecoverEmail')->name('recoverPassword.send');
});

Route::controller(ResetPasswordController::class)->group(function () {
    Route::get('/resetPassword/{token}', 'showPasswordResetForm')->middleware('guest')->name('password.reset');;
    Route::post('/resetPassword', 'resetPassword')->middleware('guest')->name('password.update');
});

// Admin
Route::controller(AdminController::class)->group(function () {
    Route::get('/admin', 'showAdminPage')->name('admin');
    Route::get('/admin/user', 'searchUser')->name('admin.user');
    Route::get('/admin/create', 'showCreateUserForm')->name('admin.create');
    Route::post('/admin/create', 'createUser')->name('admin.create.action');
    Route::delete('/admin/user/{id}', 'deleteUser')->name('admin.delete');
    Route::get('/admin/edit/{id}', 'showEditUserForm')->name('admin.edit');
    Route::put('/admin/user/{id}', 'editUser')->name('admin.edit.action');
});

Route::get('/home', [TimelineController::class, 'index'])->name('home');

Route::get('/api/post', [TimelineController::class, 'searchPost'])->name('search.posts');
Route::get('/api/user', [UserController::class, 'searchUser'])->name('search.users');

// Profile
Route::get('/profile/setup', [SetupController::class, 'show'])->name('profile.setup');
Route::post('/profile/setup', [SetupController::class, 'store'])->name('profile.setup.store');

// test route for user profile
Route::get('/profile/{id}', [UserController::class, 'show'])->name('profile.show');

Route::middleware(['auth'])->group(function () {

    Route::get('/profile/{id}/edit', [UserController::class, 'edit'])->name('profile.edit');
    
    Route::put('/profile/{id}', [UserController::class, 'update'])->name('profile.update');

    Route::get('/messages', function () {
        return view('pages.placeholder', ['title' => 'My Conversations']);
    })->name('messages.index');

    Route::get('/notifications', function () {
        return view('pages.placeholder', ['title' => 'Notifications']);
    })->name('notifications.index');

    Route::get('/saved', function () {
        return view('pages.placeholder', ['title' => 'Saved Posts']);
    })->name('saved.index');

    Route::get('/settings', function () {
        return view('pages.placeholder', ['title' => 'Settings']);
    })->name('settings.index');

    Route::get('/groups', function () {
        return view('pages.placeholder', ['title' => 'Groups']);
    })->name('groups.index');

    Route::get('/mygroups', function () {
        return view('pages.placeholder', ['title' => 'My Groups']);
    })->name('mygroups.index');

    // Post
    Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/post', [PostController::class, 'store'])->name('post.store');
    Route::get('/post/{id}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::put('/post/{id}', [PostController::class, 'update'])->name('post.update');
    Route::delete('/post/{id}', [PostController::class, 'destroy'])->name('post.destroy');
    
    // File upload
    Route::post('/file/upload', [FileController::class, 'upload'])->name('upload.img');
});
