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


Route::get('/', [\App\Http\Controllers\TamuController::class, 'index'])->name('welcome');
Route::get('/filter/{id}', [\App\Http\Controllers\TamuController::class, 'kategori'])->name('filter.kategori');
Route::get('/detail/{id}', [\App\Http\Controllers\TamuController::class, 'detail'])->name('tamu.detail');

Auth::routes();

Route::middleware(['auth', 'user-access:user'])->group(function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

Route::middleware(['auth', 'user-access:admin'])->group(function () {


    Route::get('/admin/home', [\App\Http\Controllers\HomeController::class, 'adminHome'])->name('admin.home');

    Route::get('/pembelian', [\App\Http\Controllers\PembelianController::class, 'index'])->name('pembelian.index');
    Route::post('/pembelian/fetch', [\App\Http\Controllers\PembelianController::class, 'fetch'])->name('pembelian.fetch');
    Route::post('/pembelian/tambah', [\App\Http\Controllers\PembelianController::class, 'tambah'])->name('pembelian.tambah');
    Route::delete('pembelian/hapus', [\App\Http\Controllers\PembelianController::class, 'hapus'])->name('pembelian.hapus');
    Route::patch('pembelian/update', [\App\Http\Controllers\PembelianController::class, 'update'])->name('pembelian.update');

    Route::get('penjualan/{id}/tambah', [\App\Http\Controllers\PenjualanController::class, 'tambah'])->name('penjualan.tambah');
    Route::delete('penjualan/hapus', [\App\Http\Controllers\PenjualanController::class, 'hapus'])->name('penjualan.hapus');
    Route::patch('penjualan/update', [\App\Http\Controllers\PenjualanController::class, 'update'])->name('penjualan.update');
    Route::get('/penjualan', [\App\Http\Controllers\PenjualanController::class, 'index'])->name('penjualan.index');


    Route::delete('pelanggan.hapus', [\App\Http\Controllers\PelangganControler::class, 'hapus'])->name('pelanggan.hapus');
    Route::put('pelanggan.ubah', [\App\Http\Controllers\PelangganControler::class, 'ubah'])->name('pelanggan.ubah');
    Route::resource('/pelanggan', \App\Http\Controllers\PelangganControler::class);

    Route::delete('supplier.hapus', [\App\Http\Controllers\SupplierController::class, 'hapus'])->name('supplier.hapus');
    Route::put('supplier.ubah', [\App\Http\Controllers\SupplierController::class, 'ubah'])->name('supplier.ubah');
    Route::resource('/supplier', \App\Http\Controllers\SupplierController::class);

    Route::delete('kategori.hapus', [\App\Http\Controllers\KategoriController::class, 'hapus'])->name('kategori.hapus');
    Route::put('kategori.ubah', [\App\Http\Controllers\KategoriController::class, 'ubah'])->name('kategori.ubah');
    Route::resource('/kategori', \App\Http\Controllers\KategoriController::class);

    Route::delete('gambar/hapus', [\App\Http\Controllers\BarangController::class, 'hapus'])->name('gambar.hapus');
    Route::resource('/barang', \App\Http\Controllers\BarangController::class);
});
