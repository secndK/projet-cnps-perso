<?php

use App\Models\PosteTravail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\RolesController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PeripheriqueController;
use App\Http\Controllers\PosteTravailController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/', [AuthController::class, 'login'])->name('login.post');
});

Route::get('/registration',function(){
    return view('auth.register');

})->name('register');

Route::post('/registration',[AuthController::class, 'register'])->name('register');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {


    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect()->route('dashboard')->with('success', 'Email verified successfully!');
    })->middleware('signed')->name('verification.verify');


    Route::get('/dashboard', function () {
        return view ('dashboard');
    })->name('dashboard');



    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    })->middleware('throttle:6,1')->name('verification.send');


});

Route::resource('permissions', PermissionController::class)->middleware('superadmin');

Route::resource('roles', RolesController::class)->middleware('superadmin');


Route::resource('users', UserController::class)->middleware('superadmin');

Route::resource('poste_travail', PosteTravailController::class)->middleware('superadmin');

Route::resource('peripherique', PeripheriqueController::class)->middleware('superadmin');


Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::POST('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/permissions/export', [PermissionController::class, 'export'])->name('permissions.export');
Route::post('/permissions/import', [PermissionController::class, 'import'])->name('permissions.import');