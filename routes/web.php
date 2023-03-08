<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\TanggapanController;
use App\Http\Controllers\MasyarakatController;
use App\Http\Controllers\PetugasController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/login', [LoginController::class, 'showLoginMasyarakat'])->name('login');
Route::post('/login', [LoginController::class, 'loginMasyarakat']);
Route::get('/petugas/login', [LoginController::class, 'showLoginPetugas'])->name('login.petugas');
Route::post('/petugas/login', [LoginController::class, 'loginPetugas']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/register', [RegisterController::class, 'showRegisterMasyarakat']);
Route::post('/register', [RegisterController::class, 'registerMasyarakat'])->name('register');

// Route::resource('/masyarakat', MasyarakatController::class);

Route::get('/pengaduan', function () {
    return view('pengaduan.index');
});

Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan.index');
Route::resource('pengaduan', PengaduanController::class);
Route::get('/petugas/pengaduan', [PengaduanController::class, 'indexPetugas'])->name('pengaduan.indexPetugas');

Route::get('/petugas/tanggapan', [TanggapanController::class, 'index'])->name('role.tanggapan.index');
Route::get('/petugas/tanggapan/create/{id_pengaduan}', [TanggapanController::class, 'create'])->name('tanggapan.create');
Route::post('/petugas/tanggapan/store/{id_pengaduan}', [TanggapanController::class, 'store'])->name('tanggapan.store');
Route::get('/petugas/tanggapan/edit/{id_tanggapan}', [TanggapanController::class, 'edit'])->name('tanggapan.edit');
Route::post('/petugas/tanggapan/update/{id_tanggapan}', [TanggapanController::class, 'update'])->name('tanggapan.update');
Route::delete('/petugas/tanggapan/destroy/{id_tanggapan}', [TanggapanController::class, 'destroy'])->name('tanggapan.destroy');

// Route::get('/petugas/masyarakat', [MasyarakatController::class, 'index'])->name('masyarakat.index');
// Route::resource('masyarakat', MasyarakatController::class);

Route::get('/petugas/masyarakat', [MasyarakatController::class, 'index'])->name('role.masyarakat.index');
Route::delete('/petugas/masyarakat/destroy/{id}', [MasyarakatController::class, 'destroy'])->name('masyarakat.destroy');

Route::get('/petugas/petugas', [PetugasController::class, 'index'])->name('role.petugas.index');
Route::get('/petugas/petugas/create', [PetugasController::class, 'create'])->name('petugas.create');
Route::post('/petugas/petugas/store', [PetugasController::class, 'store'])->name('petugas.store');
Route::get('/petugas/petugas/edit/{id}', [PetugasController::class, 'edit'])->name('petugas.edit');
Route::post('/petugas/petugas/update/{id}', [PetugasController::class, 'update'])->name('petugas.update');
Route::delete('/petugas/petugas/destroy/{id}', [PetugasController::class, 'destroy'])->name('petugas.destroy');

Route::get('/petugas/laporan', [TanggapanController::class, 'indexLaporan'])->name('role.indexLaporan');
Route::middleware('isAdmin')->group(function() {
    Route::get('/petugas/generate_pdf', [TanggapanController::class, 'generatePDF'])->name('generate.pdf');
});