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
Route::middleware(['check.status'])->group(function () {
    Route::get('permissions', [PermissionController::class, 'index'])
        ->middleware('can:view-permission')->name('permissions.index');

    Route::get('permissions/create', [PermissionController::class, 'create'])
        ->middleware('can:create-permission')->name('permissions.create');

    Route::post('permissions', [PermissionController::class, 'store'])
        ->middleware('can:create-permission')->name('permissions.store');

    Route::get('permissions/{permission}', [PermissionController::class, 'show'])
        ->middleware('can:view-permission')->name('permissions.show');

    Route::get('permissions/{permission}/edit', [PermissionController::class, 'edit'])
        ->middleware('can:edit-permission')->name('permissions.edit');

    Route::put('permissions/{permission}', [PermissionController::class, 'update'])
        ->middleware('can:edit-permission')->name('permissions.update');

    Route::delete('permissions/{permission}', [PermissionController::class, 'destroy'])
        ->middleware('can:delete-permission')->name('permissions.destroy');
});

// Rôles
Route::middleware(['check.status'])->group(function () {
    Route::get('roles', [RolesController::class, 'index'])
        ->middleware('can:view-role')->name('roles.index');

    Route::get('roles/create', [RolesController::class, 'create'])
        ->middleware('can:create-role')->name('roles.create');

    Route::post('roles', [RolesController::class, 'store'])
        ->middleware('can:create-role')->name('roles.store');

    Route::get('roles/{role}', [RolesController::class, 'show'])
        ->middleware('can:view-role')->name('roles.show');

    Route::get('roles/{role}/edit', [RolesController::class, 'edit'])
        ->middleware('can:edit-role')->name('roles.edit');

    Route::put('roles/{role}', [RolesController::class, 'update'])
        ->middleware('can:edit-role')->name('roles.update');

    Route::delete('roles/{role}', [RolesController::class, 'destroy'])
        ->middleware('can:delete-role')->name('roles.destroy');
});


// Utilisateurs
Route::middleware(['check.status'])->group(function () {
    Route::get('users', [UserController::class, 'index'])
        ->middleware('can:view-user')->name('users.index');

    Route::get('users/create', [UserController::class, 'create'])
        ->middleware('can:create-user')->name('users.create');

    Route::post('users', [UserController::class, 'store'])
        ->middleware('can:create-user')->name('users.store');

    Route::get('users/{user}', [UserController::class, 'show'])
        ->middleware('can:view-user')->name('users.show');

    Route::get('users/{user}/edit', [UserController::class, 'edit'])
        ->middleware('can:edit-user')->name('users.edit');

    Route::put('users/{user}', [UserController::class, 'update'])
        ->middleware('can:edit-user')->name('users.update');

    Route::delete('users/{user}', [UserController::class, 'destroy'])
        ->middleware('can:delete-user')->name('users.destroy');
});


Route::middleware(['check.status'])->group(function () {
    Route::get('types-peripheriques', [TypesPeripheriquesController::class, 'index'])
        ->middleware('can:view-type-peripherique')->name('types-peripheriques.index');

    Route::get('types-peripheriques/create', [TypesPeripheriquesController::class, 'create'])
        ->middleware('can:create-type-peripherique')->name('types-peripheriques.create');

    Route::post('types-peripheriques', [TypesPeripheriquesController::class, 'store'])
        ->middleware('can:create-type-peripherique')->name('types-peripheriques.store');

    Route::get('types-peripheriques/{type}', [TypesPeripheriquesController::class, 'show'])
        ->middleware('can:view-type-peripherique')->name('types-peripheriques.show');

    Route::get('types-peripheriques/{type}/edit', [TypesPeripheriquesController::class, 'edit'])
        ->middleware('can:edit-type-peripherique')->name('types-peripheriques.edit');

    Route::put('types-peripheriques/{type}', [TypesPeripheriquesController::class, 'update'])
        ->middleware('can:edit-type-peripherique')->name('types-peripheriques.update');

    Route::delete('types-peripheriques/{type}', [TypesPeripheriquesController::class, 'destroy'])
        ->middleware('can:delete-type-peripherique')->name('types-peripheriques.destroy');
});


Route::middleware(['check.status'])->group(function () {
    Route::get('peripheriques', [PeripheriqueController::class, 'index'])
        ->middleware('can:view-peripherique')->name('peripheriques.index');

    Route::get('peripheriques/create', [PeripheriqueController::class, 'create'])
        ->middleware('can:create-peripherique')->name('peripheriques.create');

    Route::post('peripheriques', [PeripheriqueController::class, 'store'])
        ->middleware('can:create-peripherique')->name('peripheriques.store');

    Route::get('peripheriques/{peripherique}', [PeripheriqueController::class, 'show'])
        ->middleware('can:view-peripherique')->name('peripheriques.show');

    Route::get('peripheriques/{peripherique}/edit', [PeripheriqueController::class, 'edit'])
        ->middleware('can:edit-peripherique')->name('peripheriques.edit');

    Route::put('peripheriques/{peripherique}', [PeripheriqueController::class, 'update'])
        ->middleware('can:edit-peripherique')->name('peripheriques.update');

    Route::delete('peripheriques/{peripherique}', [PeripheriqueController::class, 'destroy'])
        ->middleware('can:delete-peripherique')->name('peripheriques.destroy');
});



Route::middleware(['check.status'])->group(function () {
    Route::get('types-postes', [TypesPostesController::class, 'index'])
        ->middleware('can:view-type-poste')->name('types-postes.index');

    Route::get('types-postes/create', [TypesPostesController::class, 'create'])
        ->middleware('can:create-type-poste')->name('types-postes.create');

    Route::post('types-postes', [TypesPostesController::class, 'store'])
        ->middleware('can:create-type-poste')->name('types-postes.store');

    Route::get('types-postes/{type}', [TypesPostesController::class, 'show'])
        ->middleware('can:view-type-poste')->name('types-postes.show');

    Route::get('types-postes/{id}/edit', [TypesPostesController::class, 'edit'])
        ->middleware('can:edit-type-poste')->name('types-postes.edit');

    Route::put('types-postes/{id}', [TypesPostesController::class, 'update'])
        ->middleware('can:edit-type-poste')->name('types-postes.update');

    Route::delete('types-postes/{id}', [TypesPostesController::class, 'destroy'])
        ->middleware('can:delete-type-poste')->name('types-postes.destroy');
});



Route::middleware(['check.status'])->group(function () {
    Route::get('postes', [PosteController::class, 'index'])
        ->middleware('can:view-poste')->name('postes.index');

    Route::get('postes/create', [PosteController::class, 'create'])
        ->middleware('can:create-poste')->name('postes.create');

    Route::post('postes', [PosteController::class, 'store'])
        ->middleware('can:create-poste')->name('postes.store');

    Route::get('postes/historique', [PosteController::class, 'historique'])
        ->middleware('can:view-poste')->name('postes.historique');

    Route::get('postes/{poste}', [PosteController::class, 'show'])
        ->middleware('can:view-poste')->name('postes.show');

    Route::get('postes/{poste}/edit', [PosteController::class, 'edit'])
        ->middleware('can:edit-poste')->name('postes.edit');

    Route::put('postes/{poste}', [PosteController::class, 'update'])
        ->middleware('can:edit-poste')->name('postes.update');

    Route::delete('postes/{poste}', [PosteController::class, 'destroy'])
        ->middleware('can:delete-poste')->name('postes.destroy');
});



Route::middleware([ 'check.status'])->group(function () {
    // users
});


// Logs
Route::middleware( 'check.status')->group(function () {
    Route::get('logs', [LogsController::class, 'index'])->name('logs.index');
    Route::get('logs/create', [LogsController::class, 'create'])->name('logs.create');
    Route::post('logs', [LogsController::class, 'store'])->name('logs.store');
    Route::get('logs/{log}', [LogsController::class, 'show'])->name('logs.show');
    Route::get('logs/{log}/edit', [LogsController::class, 'edit'])->name('logs.edit');
    Route::put('logs/{log}', [LogsController::class, 'update'])->name('logs.update');
    Route::delete('logs/{log}', [LogsController::class, 'destroy'])->name('logs.destroy');
});

Route::middleware(['check.status'])->group(function () {
    Route::get('/attributions/logs', [AttributionController::class, 'logs'])
        ->middleware('can:view-attribution')->name('attributions.logs');

    Route::get('attributions', [AttributionController::class, 'index'])
        ->middleware('can:view-attribution')->name('attributions.index');

    Route::get('attributions/create', [AttributionController::class, 'create'])
        ->middleware('can:create-attribution')->name('attributions.create');

    Route::post('attributions', [AttributionController::class, 'store'])
        ->middleware('can:create-attribution')->name('attributions.store');

    Route::get('attributions/{attribution}', [AttributionController::class, 'show'])
        ->middleware('can:view-attribution')->name('attributions.show');

    Route::get('attributions/{attribution}/edit', [AttributionController::class, 'edit'])
        ->middleware('can:edit-attribution')->name('attributions.edit');

    Route::put('attributions/{attribution}', [AttributionController::class, 'update'])
        ->middleware('can:edit-attribution')->name('attributions.update');

    Route::delete('attributions/{attribution}', [AttributionController::class, 'destroy'])
        ->middleware('can:delete-attribution')->name('attributions.destroy');
});




// Authentification
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');