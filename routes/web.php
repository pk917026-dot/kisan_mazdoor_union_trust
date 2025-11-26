<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\MemberRegistrationController;
use App\Http\Controllers\PublicFormController;

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ClaimController;

/*
|--------------------------------------------------------------------------
| PUBLIC WEBSITE
|--------------------------------------------------------------------------
*/

// Home Page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Member Registration Page
Route::get('/member/register', [MemberRegistrationController::class, 'showForm'])->name('member.register');
Route::post('/member/register', [MemberRegistrationController::class, 'store'])->name('member.register.store');

// Dynamic Public Forms
Route::get('/forms/{slug}', [PublicFormController::class, 'show'])->name('forms.show');
Route::post('/forms/{slug}', [PublicFormController::class, 'submit'])->name('forms.submit');


/*
|--------------------------------------------------------------------------
| ADMIN LOGIN
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');


/*
|--------------------------------------------------------------------------
| ADMIN PANEL (Protected)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware(['auth:admin'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Claims Management
    Route::get('/claims', [ClaimController::class, 'index'])->name('admin.claims');
    Route::get('/claims/view/{id}', [ClaimController::class, 'view'])->name('admin.claims.view');
    Route::post('/claims/update/{id}', [ClaimController::class, 'updateStatus'])->name('admin.claims.update');
});
