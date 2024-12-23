<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarcodeController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\HomeControllers;
use App\Http\Controllers\JaringanController;
use App\Http\Controllers\KantorController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KembalikanController;
use App\Http\Controllers\LoggerController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\MonitorController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PeminjamanController;
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

Route::get('/barang/cetak', [PDFController::class, 'cetakSemuaBarang'])->name('barang.cetak');
Route::get('/barang/{id}/ticket/cetak', [PDFController::class, 'cetakticket'])->name('ticket.cetak');
Route::get('/barang/exportexcel', [ExcelController::class, 'exportExcel'])->name('barang.export');

Route::middleware(['auth', 'role:Petugas Monitor Logger|superadmin|Petugas Utama'])->group(function () {
    Route::get('/logger', [LoggerController::class, 'index'])->name('logger.index');
    Route::get('/logger/create', [LoggerController::class, 'create'])->name('logger.create');
    Route::post('/logger', [LoggerController::class, 'store'])->name('logger.store');
    Route::get('/logger/{id}/edit', [LoggerController::class, 'edit'])->name('logger.edit');
    Route::put('/logger/{id}', [LoggerController::class, 'update'])->name('logger.update');
    Route::delete('/logger/{id}', [LoggerController::class, 'destroy'])->name('logger.destroy');
});

Route::middleware(['auth', 'role:Petugas Monitor Jaringan|superadmin|Petugas Utama'])->group(function () {
    Route::get('/monitorjaringan', [MonitorController::class, 'index'])->name('monitor.index');
    Route::get('/monitorjaringan/create', [MonitorController::class, 'create'])->name('monitor.create');
    Route::post('/monitorjaringan', [MonitorController::class, 'store'])->name('monitor.store');
    Route::get('/monitorjaringan/{id}/edit', [MonitorController::class, 'edit'])->name('monitor.edit');
    Route::put('/monitorjaringan/{id}', [MonitorController::class, 'update'])->name('monitor.update');
    Route::delete('/monitorjaringan/{id}', [MonitorController::class, 'destroy'])->name('monitor.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [HomeControllers::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
    Route::get('peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::post('peminjaman', [PeminjamanController::class, 'store'])->name('peminjaman.store');
    Route::post('peminjamanauto', [PeminjamanController::class, 'storeAuto'])->name('peminjaman.store.auto');
    Route::get('kembalikan', [KembalikanController::class, 'index'])->name('kembalikan.index');
    Route::post('kembalikan', [KembalikanController::class, 'store'])->name('kembalikan.store');
    Route::post('kembalikanauto', [KembalikanController::class, 'storeAuto'])->name('kembalikan.store.auto');

    Route::get('maintenance', [MaintenanceController::class, 'index'])->name('maintenance.index');
    Route::get('maintenance/create', [MaintenanceController::class, 'create'])->name('maintenance.create');
    Route::post('maintenance', [MaintenanceController::class, 'store'])->name('maintenance.store');
    Route::get('maintenance/{id}/edit', [MaintenanceController::class, 'edit'])->name('maintenance.edit');
    Route::put('maintenance/{id}', [MaintenanceController::class, 'update'])->name('maintenance.update');
    Route::delete('maintenance/{id}', [MaintenanceController::class, 'destroy'])->name('maintenance.destroy');
});

Route::middleware(['auth', 'role:superadmin'])->group(function () {
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

    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
    Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

    Route::get('/kantor', [KantorController::class, 'index'])->name('kantor.index');
    Route::get('/kantor/create', [KantorController::class, 'create'])->name('kantor.create');
    Route::post('/kantor', [KantorController::class, 'store'])->name('kantor.store');
    Route::get('/kantor/{id}/edit', [KantorController::class, 'edit'])->name('kantor.edit');
    Route::put('/kantor/{id}', [KantorController::class, 'update'])->name('kantor.update');
    Route::delete('/kantor/{id}', [KantorController::class, 'destroy'])->name('kantor.destroy');

    Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
    Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
    Route::get('/barang/nama', [BarangController::class, 'show'])->name('barang.show');
    Route::get('/barang/{id}', [BarangController::class, 'detail'])->name('barang.detail');

    Route::get('/generate-qrcode/{kode}', [BarcodeController::class, 'Barcode'])->name('generateQRCode');
    Route::get('/barang/{id}/barcode/cetak', [PDFController::class, 'cetakBarcode'])->name('barcode.cetak');



    Route::get('/pegawai', [UserController::class, 'index'])->name('pegawai.index');
    Route::get('/pegawai/create', [UserController::class, 'create'])->name('pegawai.create');
    Route::post('/pegawai', [UserController::class, 'store'])->name('pegawai.store');
    Route::get('/pegawai/{id}', [UserController::class, 'edit'])->name('pegawai.edit');
    Route::put('/pegawai/{id}', [UserController::class, 'update'])->name('pegawai.update');
    Route::delete('/pegawai/{id}', [UserController::class, 'destroy'])->name('pegawai.destroy');
});


require __DIR__ . '/auth.php';
