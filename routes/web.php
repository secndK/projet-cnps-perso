<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LogsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PosteController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\AttributionController;
use App\Http\Controllers\TypesPostesController;

use App\Http\Controllers\PeripheriqueController;
use App\Http\Controllers\TypesPeripheriquesController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


Route::middleware('guest', 'check.status')->group(function () {
    Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/', [AuthController::class, 'login'])->name('login.post');
});

Route::get('/registration',function(){
    return view('auth.register');

})->name('register');

Route::post('/registration',[AuthController::class, 'register'])->name('register');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth', 'check.status')->group(function () {

    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect()->route('dashboard')->with('success', 'Email verified successfully!');
    })->middleware('signed')->name('verification.verify');

    // Tableau de bord
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    })->middleware('throttle:6,1')->name('verification.send');

});

// Permissions
Route::middleware('superadmin', 'check.status')->group(function () {
    Route::get('permissions', [PermissionController::class, 'index'])->name('permissions.index');
    Route::get('permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
    Route::post('permissions', [PermissionController::class, 'store'])->name('permissions.store');
    Route::get('permissions/{permission}', [PermissionController::class, 'show'])->name('permissions.show');
    Route::get('permissions/{permission}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::put('permissions/{permission}', [PermissionController::class, 'update'])->name('permissions.update');
    Route::delete('permissions/{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy');
});

// Rôles
Route::middleware('superadmin', 'check.status')->group(function () {
    Route::get('roles', [RolesController::class, 'index'])->name('roles.index');
    Route::get('roles/create', [RolesController::class, 'create'])->name('roles.create');
    Route::post('roles', [RolesController::class, 'store'])->name('roles.store');
    Route::get('roles/{role}', [RolesController::class, 'show'])->name('roles.show');
    Route::get('roles/{role}/edit', [RolesController::class, 'edit'])->name('roles.edit');
    Route::put('roles/{role}', [RolesController::class, 'update'])->name('roles.update');
    Route::delete('roles/{role}', [RolesController::class, 'destroy'])->name('roles.destroy');
});

// Utilisateurs
Route::middleware('superadmin', 'check.status')->group(function () {
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('users', [UserController::class, 'store'])->name('users.store');
    Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});

// Types de périphériques
Route::middleware('superadmin', 'check.status')->group(function () {
    Route::get('types-peripheriques', [TypesPeripheriquesController::class, 'index'])->name('types-peripheriques.index');
    Route::get('types-peripheriques/create', [TypesPeripheriquesController::class, 'create'])->name('types-peripheriques.create');
    Route::post('types-peripheriques', [TypesPeripheriquesController::class, 'store'])->name('types-peripheriques.store');
    Route::get('types-peripheriques/{type}', [TypesPeripheriquesController::class, 'show'])->name('types-peripheriques.show');
    Route::get('types-peripheriques/{type}/edit', [TypesPeripheriquesController::class, 'edit'])->name('types-peripheriques.edit');
    Route::put('types-peripheriques/{type}', [TypesPeripheriquesController::class, 'update'])->name('types-peripheriques.update');
    Route::delete('types-peripheriques/{type}', [TypesPeripheriquesController::class, 'destroy'])->name('types-peripheriques.destroy');
});

Route::middleware(['superadmin', 'check.status'])->group(function () {

    Route::get('peripheriques', [PeripheriqueController::class, 'index'])->name('peripheriques.index');
    Route::get('peripheriques/create', [PeripheriqueController::class, 'create'])->name('peripheriques.create');
    Route::post('peripheriques', [PeripheriqueController::class, 'store'])->name('peripheriques.store');
    Route::get('peripheriques/{peripherique}', [PeripheriqueController::class, 'show'])->name('peripheriques.show');
    Route::get('peripheriques/{peripherique}/edit', [PeripheriqueController::class, 'edit'])->name('peripheriques.edit');
    Route::put('peripheriques/{peripherique}', [PeripheriqueController::class, 'update'])->name('peripheriques.update');
    Route::delete('peripheriques/{peripherique}', [PeripheriqueController::class, 'destroy'])->name('peripheriques.destroy');
});



// Types de postes
Route::middleware('superadmin', 'check.status')->group(function () {
    Route::get('types-postes', [TypesPostesController::class, 'index'])->name('types-postes.index');
    Route::get('types-postes/create', [TypesPostesController::class, 'create'])->name('types-postes.create');
    Route::post('types-postes', [TypesPostesController::class, 'store'])->name('types-postes.store');
    Route::get('types-postes/{type}', [TypesPostesController::class, 'show'])->name('types-postes.show');
    Route::get('types-postes/{id}/edit', [TypesPostesController::class, 'edit'])->name('types-postes.edit');
    Route::put('types-postes/{id}', [TypesPostesController::class, 'update'])->name('types-postes.update');
    Route::delete('types-postes/{id}', [TypesPostesController::class, 'destroy'])->name('types-postes.destroy');
});


Route::middleware(['superadmin', 'check.status'])->group(function () {
    // Postes de travail
    Route::get('postes', [PosteController::class, 'index'])->name('postes.index');
    Route::get('postes/create', [PosteController::class, 'create'])->name('postes.create');
    Route::post('postes', [PosteController::class, 'store'])->name('postes.store');
    Route::get('postes/historique', [PosteController::class, 'historique'])->name('postes.historique');
    Route::get('postes/{poste}', [PosteController::class, 'show'])->name('postes.show');
    Route::get('postes/{poste}/edit', [PosteController::class, 'edit'])->name('postes.edit');
    Route::put('postes/{poste}', [PosteController::class, 'update'])->name('postes.update');
    Route::delete('postes/{poste}', [PosteController::class, 'destroy'])->name('postes.destroy');
});



Route::middleware(['superadmin', 'check.status'])->group(function () {
    // users
});


// Logs
Route::middleware('superadmin', 'check.status')->group(function () {
    Route::get('logs', [LogsController::class, 'index'])->name('logs.index');
    Route::get('logs/create', [LogsController::class, 'create'])->name('logs.create');
    Route::post('logs', [LogsController::class, 'store'])->name('logs.store');
    Route::get('logs/{log}', [LogsController::class, 'show'])->name('logs.show');
    Route::get('logs/{log}/edit', [LogsController::class, 'edit'])->name('logs.edit');
    Route::put('logs/{log}', [LogsController::class, 'update'])->name('logs.update');
    Route::delete('logs/{log}', [LogsController::class, 'destroy'])->name('logs.destroy');
});

// Attributions
Route::middleware('superadmin', 'check.status')->group(function () {
    Route::get('/attributions/logs', [AttributionController::class, 'logs'])->name('attributions.logs');
    Route::get('attributions', [AttributionController::class, 'index'])->name('attributions.index');
    Route::get('attributions/create', [AttributionController::class, 'create'])->name('attributions.create');
    Route::post('attributions', [AttributionController::class, 'store'])->name('attributions.store');
    Route::get('attributions/{attribution}', [AttributionController::class, 'show'])->name('attributions.show');
    Route::get('attributions/{attribution}/edit', [AttributionController::class, 'edit'])->name('attributions.edit');
    Route::put('attributions/{attribution}', [AttributionController::class, 'update'])->name('attributions.update');
    Route::delete('attributions/{attribution}', [AttributionController::class, 'destroy'])->name('attributions.destroy');
});


// Authentification
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
