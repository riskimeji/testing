<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/', [App\Http\Controllers\WahanaController::class, 'landing_page'])->name('landing-page');
Route::get('/kontak-kami', [App\Http\Controllers\WahanaController::class, 'kontak_kami'])->name('kontak-kami');
Route::get('/faq', [App\Http\Controllers\WahanaController::class, 'faq'])->name('faq');
Route::get('/detail-wahana/{id}', [App\Http\Controllers\WahanaController::class, 'detail'])->name('detail-wahana');
Route::middleware(['auth'])->group(function () {
    Route::get('/wahana', [App\Http\Controllers\WahanaController::class, 'index'])->name('wahana.index');
    Route::post('/wahana', [App\Http\Controllers\WahanaController::class, 'store'])->name('wahana.store');
    Route::get('/wahana/{id}', [App\Http\Controllers\WahanaController::class, 'edit'])->name('wahana.edit');
    Route::delete('/wahana/{id}', [App\Http\Controllers\WahanaController::class, 'destroy'])->name('wahana.destroy');

    Route::get('/payment', [App\Http\Controllers\PaymentController::class, 'index'])->name('payment.index');
    Route::post('/payment', [App\Http\Controllers\PaymentController::class, 'store'])->name('payment.store');

    Route::get('/jadwal', [App\Http\Controllers\JadwalController::class, 'index'])->name('jadwal.index');
    Route::post('/jadwal', [App\Http\Controllers\JadwalController::class, 'store'])->name('jadwal.store');
    Route::delete('/jadwal/{id}', [App\Http\Controllers\JadwalController::class, 'destroy'])->name('jadwal.destroy');

    Route::get('/pengaturan', [App\Http\Controllers\UserController::class, 'create'])->name('pengaturan');
    Route::post('/edit/name', [App\Http\Controllers\UserController::class, 'name'])->name('edit.name');
    Route::post('/edit/password', [App\Http\Controllers\UserController::class, 'password'])->name('edit.password');
    Route::get('/transaksi/{kode}', [App\Http\Controllers\LaporanController::class, 'show'])->name('transaksi.show');

    Route::middleware(['petugas'])->group(function () {
        Route::get('/pembayaran/{id}', [App\Http\Controllers\LaporanController::class, 'pembayaran'])->name('pembayaran');
        Route::get('/petugas', [App\Http\Controllers\LaporanController::class, 'petugas'])->name('petugas');
        Route::post('/petugas', [App\Http\Controllers\LaporanController::class, 'kode'])->name('petugas.kode');

        Route::middleware(['admin'])->group(function () {
            Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
            Route::resource('/category', App\Http\Controllers\CategoryController::class);
            Route::resource('/transportasi', App\Http\Controllers\TransportasiController::class);
            Route::resource('/rute', App\Http\Controllers\RuteController::class);
            Route::resource('/user', App\Http\Controllers\UserController::class);
            Route::get('/transaksi', [App\Http\Controllers\LaporanController::class, 'index'])->name('transaksi');

            Route::get('/update/{id}', [App\Http\Controllers\PemesananController::class, 'acc'])->name('update.acc');
            Route::get('/ubah/{id}', [App\Http\Controllers\PemesananController::class, 'dec'])->name('update.dec');
        });
    });

    Route::middleware(['penumpang'])->group(function () {
        Route::get('/pesan/{kursi}/{data}', [App\Http\Controllers\PemesananController::class, 'pesan'])->name('pesan');
        Route::get('/cari/kursi/{data}', [App\Http\Controllers\PemesananController::class, 'edit'])->name('cari.kursi');
        Route::resource('/dashboard', App\Http\Controllers\PemesananController::class);
        Route::get('/history', [App\Http\Controllers\LaporanController::class, 'history'])->name('history');
        Route::get('/{id}/{data}', [App\Http\Controllers\PemesananController::class, 'show'])->name('show');
        Route::get('/detail-pesanan', [App\Http\Controllers\PemesananController::class, 'mendetail'])->name('mendetail');
        Route::post('/detail-pesanan', [App\Http\Controllers\PemesananController::class, 'bayar'])->name('bayar');
    });
});
