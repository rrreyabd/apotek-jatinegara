<?php

use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ProductController;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Models\BuyingInvoice;
use App\Models\Cashier;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Group;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\SellingInvoice;
use App\Models\Supplier;

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


Route::get('/test', function () {
    $produk_id = SellingInvoice::orderBy('invoice_code', 'desc')->pluck('invoice_code')->first();
        $number = intval(str_replace("INV-", "", $produk_id)) + 1;

    echo('INV-'. str_pad($number, 6, '0', STR_PAD_LEFT));

    // $hasi = Group::where('group', 'repellendus')->first()->group_id;
    // $hasil = ProductDetail::where('group_id', $hasi)->get();
    // echo($hasil);
});

Route::controller(GoogleController::class)->group(function() {
    Route::get('auth/google', 'redirectToGoogle')->name('auth.goole');
    Route::get('auth/google/callback','handleGoogleCallback');
});

Route::get('/', [ProductController::class, 'home'])->name('home');

Route::get('/produk', function () {
        return view('user.products');
});

Route::get('/profile', function () {
        return view('user.profile-user');
});

Route::get('/detail-pesanan', function () {
        return view('user.detail-pesanan');
});

Route::get('/pembayaran', function () {
        return view('user.pembayaran');
});


Route::middleware(['auth', 'verified', 'cekRole:user'])->group(function () {

});

Route::middleware(['auth', 'verified', 'cekRole:cashier'])->group(function () {
    Route::get('/cashier', function () {
        return view('kasir.index');
    });
    
});

Route::middleware(['auth', 'verified', 'cekRole:owner'])->group(function () {
    Route::get('/owner', function () {
        return view('pemilik.index');
    });
    
});

require __DIR__.'/auth.php';
