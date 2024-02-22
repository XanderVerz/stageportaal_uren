<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\WorkhoursController;

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




Route::middleware('auth')->group(function () {
    // Gebruikers routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
   // Worked hours routes
    Route::get('/', [WorkhoursController::class, 'index'])->name('dashboard');
    Route::get('worked-hours/create', [WorkhoursController::class, 'create'])->name('worked-hours.create');
    Route::post('worked-hours', [WorkhoursController::class, 'store'])->name('worked-hours.store');
    Route::get('worked-hours/{workedHour}', [WorkhoursController::class, 'show'])->name('worked-hours.show');
    Route::get('worked-hours/{workedHour}/edit', [WorkhoursController::class, 'edit'])->name('worked-hours.edit');
    Route::put('worked-hours/{workedHour}', [WorkhoursController::class, 'update'])->name('worked-hours.update');
    Route::delete('worked-hours/{workedHour}', [WorkhoursController::class, 'destroy'])->name('worked-hours.destroy');
    Route::get('/generate-pdf', [WorkhoursController::class, 'generatePdf'])->name('generate.pdf');
    // Settings routes
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::get('/settings/create', [SettingsController::class, 'create'])->name('settings.create');
    Route::post('/settings', [SettingsController::class, 'store'])->name('settings.store');
    Route::get('/settings/edit', [SettingsController::class, 'edit'])->name('settings.edit');
    Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');
    Route::get('/settings/{settings}/delete', [SettingsController::class, 'delete'])->name('settings.delete');
    Route::delete('/settings/{settings}', [SettingsController::class, 'destroy'])->name('settings.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
   // Admin routes 
   Route::resource('users', AdminController::class);
   Route::get('admin/users', [AdminController::class, 'index'])->name('admin.users.index');
   Route::get('admin/users/create', [AdminController::class, 'create'])->name('admin.users.create');
   Route::get('admin/users/{user}/edit', [AdminController::class, 'edit'])->name('admin.users.edit');
    Route::get('admin/users/{user}', [AdminController::class, 'show'])->name('admin.users.show');
    Route::post('admin/users', [AdminController::class, 'store'])->name('admin.users.store');
    Route::delete('admin/users/{user}', [AdminController::class, 'destroy'])->name('admin.users.destroy');
    Route::put('admin/users/{user}', [AdminController::class, 'update'])->name('admin.users.update');
    Route::post('/admin/users/{user}/toggle-admin', [AdminController::class, 'toggleAdminStatus'])->name('admin.users.toggle-admin');
  
});

require __DIR__.'/auth.php';
