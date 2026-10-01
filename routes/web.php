<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\Beheer\PermissionController;
use App\Http\Controllers\Beheer\RoleController;
use App\Http\Controllers\Beheer\RolePermissionController;
use App\Http\Controllers\Beheer\UserRoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/geheim', function () {
    return view('geheim');
})->middleware('auth');

// Iedereen mag het overzicht zien
Route::get('/games', [GameController::class, 'index']);

// Alleen admins mogen de rest
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/games/create', [GameController::class, 'create']);
    Route::post('/games/store', [GameController::class, 'store']);
    Route::get('/games/edit/{id}', [GameController::class, 'edit']);
    Route::post('/games/update/{id}', [GameController::class, 'update']);
    Route::post('/games/destroy/{id}', [GameController::class, 'destroy']);
});

// Deze moet onderaan staan, anders vangt {id} ook "create" en "edit" op
Route::get('/games/{id}', [GameController::class, 'show']);

// Beheeromgeving: alleen admins
Route::middleware(['auth', 'role:admin'])->prefix('beheer')->name('beheer.')->group(function () {

    // 1. Permissies
    Route::resource('permissions', PermissionController::class)->except('show');

    // 2. Rollen
    Route::resource('roles', RoleController::class)->except('show');

    // 3. Permissie koppelen aan rol
    Route::get('/role-permissions', [RolePermissionController::class, 'index'])->name('role-permissions.index');
    Route::get('/role-permissions/create', [RolePermissionController::class, 'create'])->name('role-permissions.create');
    Route::post('/role-permissions', [RolePermissionController::class, 'store'])->name('role-permissions.store');
    Route::delete('/role-permissions/{role}/{permission}', [RolePermissionController::class, 'destroy'])->name('role-permissions.destroy');

    // 4. Rol koppelen aan gebruiker
    Route::get('/user-roles', [UserRoleController::class, 'index'])->name('user-roles.index');
    Route::get('/user-roles/create', [UserRoleController::class, 'create'])->name('user-roles.create');
    Route::post('/user-roles', [UserRoleController::class, 'store'])->name('user-roles.store');
    Route::delete('/user-roles/{user}/{role}', [UserRoleController::class, 'destroy'])->name('user-roles.destroy');
});

require __DIR__.'/auth.php';