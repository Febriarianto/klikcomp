<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pembelian', [\App\Http\Controllers\PembelianController::class, 'index'])->name('pembelian.index');
Route::post('/pembelian/fetch', [\App\Http\Controllers\PembelianController::class, 'fetch'])->name('pembelian.fetch');

Route::get('penjualan/{id}/tambah', [\App\Http\Controllers\PenjualanController::class, 'tambah'])->name('penjualan.tambah');
Route::delete('penjualan/hapus', [\App\Http\Controllers\PenjualanController::class, 'hapus'])->name('penjualan.hapus');
Route::patch('penjualan/update', [\App\Http\Controllers\PenjualanController::class, 'update'])->name('penjualan.update');
Route::get('/penjualan', [\App\Http\Controllers\PenjualanController::class, 'index'])->name('penjualan.index');
Route::delete('barang.hapus', [\App\Http\Controllers\BarangController::class, 'hapus'])->name('barang.hapus');
Route::put('barang.ubah', [\App\Http\Controllers\BarangController::class, 'ubah'])->name('barang.ubah');
Route::delete('pelanggan.hapus', [\App\Http\Controllers\PelangganControler::class, 'hapus'])->name('pelanggan.hapus');
Route::put('pelanggan.ubah', [\App\Http\Controllers\PelangganControler::class, 'ubah'])->name('pelanggan.ubah');
Route::delete('supplier.hapus', [\App\Http\Controllers\SupplierController::class, 'hapus'])->name('supplier.hapus');
Route::put('supplier.ubah', [\App\Http\Controllers\SupplierController::class, 'ubah'])->name('supplier.ubah');
Route::delete('kategori.hapus', [\App\Http\Controllers\KategoriController::class, 'hapus'])->name('kategori.hapus');
Route::put('kategori.ubah', [\App\Http\Controllers\KategoriController::class, 'ubah'])->name('kategori.ubah');
Route::resource('/kategori', \App\Http\Controllers\KategoriController::class);
Route::resource('/supplier', \App\Http\Controllers\SupplierController::class);
Route::resource('/pelanggan', \App\Http\Controllers\PelangganControler::class);
Route::resource('/barang', \App\Http\Controllers\BarangController::class);
