<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PemilikTokoController;
use App\Http\Controllers\TokoStokBarangController;
use App\Http\Controllers\RakPenyimpananController;
use App\Http\Controllers\UserController;
use App\Models\TokoStokBarang;

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
    return redirect()->route('login');
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');


Route::group(['middleware' => ['auth:sanctum', 'verified', 'checkrole:admin,pemilik_toko']], function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::view('forms', 'forms')->name('forms');
    Route::view('suppliers', 'suppliers')->name('suppliers');
    Route::view('pemilik_tokos', 'pemilik_tokos')->name('pemilik_tokos');
    Route::view('barangs', 'barangs')->name('barangs');

    // Rute untuk Barang
    Route::resource('barang', BarangController::class);

    // Rute untuk Supplier
    Route::resource('supplier', SupplierController::class);

    // Rute untuk Pemilik Toko
    Route::resource('pemilik_toko', PemilikTokoController::class);

    // Rute untuk Toko Stok Barang
    Route::resource('toko_stok_barang', TokoStokBarangController::class);

    // Rute untuk Rak Penyimpanan
    Route::resource('rak_penyimpanan', RakPenyimpananController::class);


    Route::get('barangs', [BarangController::class, 'index'])->name('barangs.index');
    Route::get('barangs/create', [BarangController::class, 'create'])->name('barangs.create');
    Route::get('barangs/pdf', [BarangController::class, 'generatePDF'])->name('barangs.pdf');
    Route::post('barangs', [BarangController::class, 'store'])->name('barangs.store'); // Updated to use POST method
    Route::delete('barangs/{id}', [BarangController::class, 'destroy'])->name('barangs.destroy'); 

    Route::get('suppliers', [SupplierController::class, 'index'])->name('suppliers.index');
    Route::get('suppliers/create', [SupplierController::class, 'create'])->name('suppliers.create');
    Route::get('suppliers/pdf', [SupplierController::class, 'generatePDF'])->name('suppliers.pdf');
    Route::post('suppliers', [SupplierController::class, 'store'])->name('suppliers.store'); // Updated to use POST method
    Route::delete('suppliers/{id}', [SupplierController::class, 'destroy'])->name('suppliers.destroy'); // Using DELETE method

    Route::get('pemilik_tokos', [PemilikTokoController::class, 'index'])->name('pemilik_tokos.index');
    Route::get('pemilik_tokos/create', [PemilikTokoController::class, 'create'])->name('pemilik_tokos.create');
    Route::get('pemilik_tokos/pdf', [PemilikTokoController::class, 'generatePDF'])->name('pemilik_tokos.pdf');
    Route::post('pemilik_tokos', [PemilikTokoController::class, 'store'])->name('pemilik_tokos.store'); // Updated to use POST method
    Route::delete('pemilik_tokos/{id}', [PemilikTokoController::class, 'destroy'])->name('pemilik_tokos.destroy'); 

    Route::get('rak_penyimpanans', [RakPenyimpananController::class, 'index'])->name('rak_penyimpanans.index');
    Route::get('rak_penyimpanans/create', [RakPenyimpananController::class, 'create'])->name('rak_penyimpanans.create');
    Route::get('rak_penyimpanans/pdf', [RakPenyimpananController::class, 'generatePDF'])->name('rak_penyimpanans.pdf');
    Route::post('rak_penyimpanans', [RakPenyimpananController::class, 'store'])->name('rak_penyimpanans.store'); // Updated to use POST method
    Route::delete('rak_penyimpanans/{id}', [RakPenyimpananController::class, 'destroy'])->name('rak_penyimpanans.destroy'); 

    Route::get('toko_stok_barangs', [TokoStokBarangController::class, 'index'])->name('toko_stok_barangs.index');
    Route::get('toko_stok_barangs/create', [TokoStokBarangController::class, 'create'])->name('toko_stok_barangs.create');
    Route::get('toko_stok_barangs/pdf', [TokoStokBarangController::class, 'generatePDF'])->name('toko_stok_barangs.pdf');
    Route::post('toko_stok_barangs', [TokoStokBarangController::class, 'store'])->name('toko_stok_barangs.store'); // Updated to use POST method
    Route::delete('toko_stok_barangs/{id}', [TokoStokBarangController::class, 'destroy'])->name('toko_stok_barangs.destroy'); 
});

Route::group(['middleware' => ['auth:sanctum', 'verified', 'checkrole:admin,pemilik_toko,karyawan,agent']], function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::get('barangs', [BarangController::class, 'index'])->name('barangs.index');
    Route::get('barangs/create', [BarangController::class, 'create'])->name('barangs.create');
    Route::get('barangs/pdf', [BarangController::class, 'generatePDF'])->name('barangs.pdf');
    Route::post('barangs', [BarangController::class, 'store'])->name('barangs.store'); // Updated to use POST method
    Route::delete('barangs/{id}', [BarangController::class, 'destroy'])->name('barangs.destroy'); 

    Route::get('suppliers', [SupplierController::class, 'index'])->name('suppliers.index');
    Route::get('suppliers/create', [SupplierController::class, 'create'])->name('suppliers.create');
    Route::get('suppliers/pdf', [SupplierController::class, 'generatePDF'])->name('suppliers.pdf');
    Route::post('suppliers', [SupplierController::class, 'store'])->name('suppliers.store'); // Updated to use POST method
    Route::delete('suppliers/{id}', [SupplierController::class, 'destroy'])->name('suppliers.destroy'); // Using DELETE method
});
