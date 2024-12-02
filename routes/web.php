<?php

use App\Http\Controllers\HomeControllers;
use App\Http\Controllers\JaringanController;
use App\Http\Controllers\LoggerController;
use App\Http\Controllers\MonitorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Spatie\Permission\Models\Role;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'role:Petugas Monitor Logger|superadmin|Petugas Utama'])->group(function () {
    Route::get('/logger', [LoggerController::class, 'index'])->name('logger.index');
    Route::get('/logger/create', [LoggerController::class, 'create'])->name('logger.create');
    Route::post('/logger', [LoggerController::class, 'store'])->name('logger.store');
    Route::get('/logger/{id}/edit', [LoggerController::class, 'edit'])->name('logger.edit');
    Route::put('/logger/{id}', [LoggerController::class, 'update'])->name('logger.update');
    Route::delete('/logger/{id}', [LoggerController::class, 'destroy'])->name('logger.destroy');
});

Route::middleware(['auth','role:Petugas Monitor Jaringan|superadmin|Petugas Utama'])->group(function () {
    Route::get('/monitorjaringan', [MonitorController::class, 'index'])->name('monitor.index');
    Route::get('/monitorjaringan/create', [MonitorController::class, 'create'])->name('monitor.create');
    Route::post('/monitorjaringan', [MonitorController::class, 'store'])->name('monitor.store');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::get('/dashboard', [HomeControllers::class, 'index'])->name('dashboard');

    Route::get('/ruangan', [RuanganController::class, 'index'])->name('ruangan.index');
    Route::get('/ruangan/create', [RuanganController::class, 'create'])->name('ruangan.create');
    Route::post('/ruangan', [RuanganController::class, 'store'])->name('ruangan.store');
    Route::get('/ruangan/{id}/edit', [RuanganController::class, 'edit'])->name('ruangan.edit');
    Route::put('/ruangan/{id}', [RuanganController::class, 'update'])->name('ruangan.update');
    Route::delete('/ruangan/{id}', [RuanganController::class, 'destroy'])->name('ruangan.destroy');

    Route::get('/jaringan', [JaringanController::class, 'index'])->name('jaringan.index');
    Route::get('/jaringan/create', [JaringanController::class, 'create'])->name('jaringan.create');
    Route::post('/jaringan', [JaringanController::class, 'store'])->name('jaringan.store');
    Route::get('/jaringan/{id}/edit', [JaringanController::class, 'edit'])->name('jaringan.edit');
    Route::put('/jaringan/{id}', [JaringanController::class, 'update'])->name('jaringan.update');
    Route::delete('/jaringan/{id}', [JaringanController::class, 'destroy'])->name('jaringan.destroy');

    Route::get('/pegawai', [UserController::class, 'index'])->name('pegawai.index');
    Route::get('/pegawai/create', [UserController::class, 'create'])->name('pegawai.create');
    Route::post('/pegawai', [UserController::class, 'store'])->name('pegawai.store');
    Route::get('/pegawai/{id}', [UserController::class, 'edit'])->name('pegawai.edit');
    Route::put('/pegawai/{id}', [UserController::class,'update'])->name('pegawai.update');
    Route::delete('/pegawai/{id}', [UserController::class, 'destroy'])->name('pegawai.destroy');
});


require __DIR__ . '/auth.php';
