<?php

use App\Http\Controllers\Authentifikasi;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\DataUser;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\Tes;
use App\Http\Controllers\TransaksiController;
use App\Http\Middleware\SesiTrue;
use App\Http\Middleware\SesiFalse;
use App\Http\Middleware\Sesirule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect('/login');
});
Route::middleware([SesiTrue::class])->group(function () {
    // kp

    // DASHBORAD
    route::get('/dashboard', [Dashboard::class,'dashboard']);
    // transaksi user
    Route::get('/transaksi', [TransaksiController::class,'index']);
    Route::get('/transaksi/tambah', [TransaksiController::class,'tambah']);
    Route::post('/transaksi/tambah/simpan', [TransaksiController::class,'tambahSimpan']);
    Route::get('/transaksi/edit/{id}', [TransaksiController::class,'edit']);
    Route::post('/transaksi/edit/simpan', [TransaksiController::class,'simpanEdit']);

    // kategori user
    Route::get('/kategori', [TransaksiController::class,'kategori']);
    Route::post('/kategori/simpan', [TransaksiController::class,'kategoriSimpan']);

    // profile user
    route::get('/profile/{id_user}',[DataUser::class,'profile']);
    route::get('/profile/edit',[DataUser::class,'profileEdit']);

    // laporan
    route::any('/laporan',[LaporanController::class,'laporan']);
});

Route::middleware([SesiFalse::class])->group(function () {
    // login
    Route::get('/login', [Authentifikasi::class, 'index']);
    Route::post('/login/loginProses', [Authentifikasi::class, 'loginProses'])->name('loginproses');
    Route::any('/veriflogin/{token}', [Authentifikasi::class, 'veriflogin'])->name('verif.akun');
    // register
    Route::get('/register', [Authentifikasi::class, 'register']);
    Route::post('/registerProses', [Authentifikasi::class, 'registerProses']);
    // lupa pw
    Route::any('/lupa-password', [Authentifikasi::class, 'lupa_password']);
    Route::any('/reset-password/{token}', [Authentifikasi::class, 'showResetPasswordForm'])->name('reset.password.get');
});

Route::middleware([Sesirule::class])->group(function () {
    // user
    Route::get('/user', [DataUser::class,'user']);
    Route::get('/user/hapus/{id_user}',[DataUser::class,'hapusUser']);
    Route::get('/user/edit/{id_user}',[DataUser::class,'editUser']);
    Route::post('/user/edit/simpan',[DataUser::class,'simpanEdit']);

    // transaksi
    Route::get('/transaksi/hapus/{id}', [TransaksiController::class,'hapus']);

    // kategori
    Route::get('/kategori/edit/{id}', [TransaksiController::class,'editkategori']);
    Route::post('/kategoriedit/simpan', [TransaksiController::class,'editsimpan']);
    Route::get('/kategori/hapus/{id}', [TransaksiController::class,'hapuskategori']);
});
Route::get('/logout', [Authentifikasi::class, 'logout']);
Route::get('/tes',[Tes::class, 'index']);
