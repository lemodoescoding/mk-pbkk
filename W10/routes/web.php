<?php

use App\Http\Controllers\Admin\MahasiswaController as AdminMahasiswaController;
use App\Http\Controllers\Auth\DemoLoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/beranda', [PageController::class, 'home'])->name('beranda');
Route::get('/profil-mahasiswa', [PageController::class, 'profil'])->name('profil');
Route::get('/ide-agent', [PageController::class, 'ide'])->name('ide');
Route::post('/ide-agent', [PageController::class, 'kirimIde'])->name('ide.kirim');

Route::get('/dashboard', DashboardController::class)
    ->middleware('auth')
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::delete('/admin/hapus-mahasiswa/{mahasiswa}', [AdminMahasiswaController::class, 'destroy'])
    ->middleware(['auth', 'permission:hapus-data'])
    ->name('admin.mahasiswa.destroy');

Route::redirect('/admin/dashboard', '/admin')
    ->middleware(['auth', 'role:Admin|Staf'])
    ->name('admin.dashboard');

if (app()->environment('local', 'testing')) {
    Route::match(['get', 'post'], '/demo-login/{role}', DemoLoginController::class)
        ->middleware('guest')
        ->name('demo.login');
}

require __DIR__.'/auth.php';
