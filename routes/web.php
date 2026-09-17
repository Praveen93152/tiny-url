<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\ShortUrlController;
use Illuminate\Support\Facades\Route;

Route::get('/login',[AuthController::class, 'showLogin'])->name('login');
Route::post('/login',[AuthController::class, 'login'])->name('login.submit');
Route::get('/s/{code}',[RedirectController::class, 'redirect'])->name('short.redirect');
Route::get('/invite/{token}',[InvitationController::class, 'accept'])->name('invitations.accept');
Route::post('/invite/{token}',[InvitationController::class, 'complete'])->name('invitations.complete');

//auth
Route::middleware('auth')->group(function () {

    Route::post('/logout',[AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');

    ///admim member
    Route::middleware('role:Admin,Member')->group(function () {

        Route::get('/short-urls/create',[ShortUrlController::class, 'create'])->name('short-urls.create');
        Route::post('/short-urls',[ShortUrlController::class, 'store'])->name('short-urls.store');
    });
    
    //superadmin

    Route::middleware('role:SuperAdmin')->group(function () {

        Route::get('/companies/create',[CompanyController::class, 'create'])->name('companies.create');
        Route::post('/companies',[CompanyController::class, 'store'])->name('companies.store');
    });
    //superadmin+admin
    Route::middleware('role:SuperAdmin,Admin')
        ->group(function () {

            Route::get('/invitations/create',[InvitationController::class, 'create'])->name('invitations.create');
            Route::post('/invitations',[InvitationController::class, 'store'])->name('invitations.store');
        });
});
