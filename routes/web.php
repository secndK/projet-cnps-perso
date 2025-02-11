<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PosteController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PeripheriqueController;
use App\Http\Controllers\TypesPeripheriquesController;
use App\Http\Controllers\TypesPostesController;
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

// gestion des permissions
Route::resource('permissions', PermissionController::class)->middleware('superadmin');
//gestion des roles
Route::resource('roles', RolesController::class)->middleware('superadmin');
//gestion des utilisateurs
Route::resource('users', UserController::class)->middleware('superadmin');
// gestion des types de périphériques
Route::resource('types-peripheriques', TypesPeripheriquesController::class)->middleware('superadmin');
// gestion des périphériques
Route::resource('peripheriques', PeripheriqueController::class)->middleware('superadmin');
//gestion des types de postes de travail
Route::resource('types-postes', TypesPostesController::class)->middleware('superadmin');
//gestion des postes de travail
Route::resource('postes', PosteController::class)->middleware('superadmin');
//deconnexion
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');








