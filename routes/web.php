<?php
use App\Http\Livewire\ProductPagination;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ProductController;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\BuyingInvoice;
use App\Models\Cart;
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
});

// halaman akses tanpa login
Route::controller(GoogleController::class)->group(function() {
    Route::get('auth/google', 'redirectToGoogle')->name('auth.goole');
    Route::get('auth/google/callback','handleGoogleCallback');
});

Route::get('/', [ProductController::class, 'home'])->name('home');

Route::get('/produk', [ProductController::class,'produk'])->name('produk');
Route::get('/deskripsi/{product}', [ProductController::class,'deskripsiProduk'])->name('deskripsi-produk');
// akhir halaman akses tanpa login

// halama user, cashier, owner
Route::middleware(['auth', 'verified', 'cekRole:user,cashies,owner'])->group(function () {
});
// akhir halaman user, cashier, owner

// halaman user
Route::middleware(['auth', 'verified', 'cekRole:user'])->group(function () {
    Route::get('/user-profile', [UserController::class, 'profile'])->name('profile-user');
    Route::post('/user-profile', [UserController::class, 'ubah'])->name('change-profile');
    Route::post('/hapus-akun', [UserController::class, 'hapus'])->name('delete-profile');

    Route::get('/pembayaran', function () {
        return view('user.pembayaran');
    });

    Route::get('/detail-pesanan', function () {
            return view('user.detail-pesanan');
    });

    Route::get('/riwayat-pesanan', [UserController::class,'riwayatTransaksi'])->name('riwayat-transaksi');
    Route::get('/detail-riwayat-pesanan', [UserController::class,'detailRiwayatTransaksi'])->name('detail-riwayat-transaksi');

    Route::get('/keranjang', [CartController::class,'keranjang'])->name('keranjang');
    Route::post('/keranjang/jumlah', [CartController::class,'jumlahItem'])->name('jumlah-keranjang');
    Route::post('/keranjang/hapus', [CartController::class,'hapusItem'])->name('hapus-keranjang');
    Route::post('/keranjang/tambah', [CartController::class,'tambahItem'])->name('tambah-keranjang');

    Route::get('/booking', [CustomerController::class,'booking'])->name('booking');
});
// akhir halaman user

// Halaman Cashier
Route::middleware(['auth', 'verified', 'cekRole:cashier'])->group(function () {
    Route::get('/cashier', [ProductController::class,'produk_cashier'])->name('cashier_product');

    Route::get('/cashier/riwayat-transaksi', function () {
        return view('kasir.riwayat-transaksi');
    });

    Route::get('/cashier/img', function () {
        return view('kasir.show-image');
    });

    Route::get('/cashier/pesanan-pending', function () {
        return view('kasir.pesanan-pending');
    });

    Route::get('/cashier/pesanan-online', function () {
        return view('kasir.pesanan-online');
    });
    
});
// Akhir Halaman Cashier

// halaman owner
Route::middleware(['auth', 'verified', 'cekRole:owner'])->group(function () {
    Route::get('/owner', function () {
        return view('pemilik.index');
    });
    Route::get('/owner/produk', function () {
        return view('pemilik.list-produk');
    });
    
    Route::get('/owner/detail-produk', function () {
        return view('pemilik.detail-produk');
    });

    Route::get('/owner/tambah-produk', function () {
        return view('pemilik.tambah-produk');
    });

    Route::get('/owner/edit-produk', function () {
        return view('pemilik.edit-produk');
    });

    Route::get('/owner/kasir', function () {
        return view('pemilik.list-kasir');
    });

    Route::get('/owner/transaksi-penjualan', function () {
        return view('pemilik.log-transaksi-penjualan');
    });

    Route::get('/owner/transaksi-pembelian', function () {
        return view('pemilik.log-transaksi-pembelian');
    });

    Route::get('/owner/supplier', function () {
        return view('pemilik.list-supplier');
    });

    Route::get('/owner/user', function () {
        return view('pemilik.list-user');
    });

    Route::get('/owner/pesanan-pending', function () {
        return view('pemilik.pesanan-pending');
    });
});
// akhir halaman owner

require __DIR__.'/auth.php';