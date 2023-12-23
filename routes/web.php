<?php
use App\Http\Livewire\ProductPagination;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\printPDFController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\OwnerController;
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
use App\Models\Information;
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
// halaman akses tanpa login
Route::controller(GoogleController::class)->group(function() {
    Route::get('auth/google', 'redirectToGoogle')->name('auth.goole');
    Route::get('auth/google/callback','handleGoogleCallback');
});

Route::get('/', [ProductController::class, 'home'])->name('home');

Route::get('/produk', [ProductController::class,'produk'])->name('produk');
Route::get('/deskripsi/{product}', [ProductController::class,'deskripsiProduk'])->name('deskripsi-produk');

Route::get('/s&k', function () {
    $apotek = Information::first();
    // dd($nama_toko);

    return view('user.syarat-ketentuan', [
        'apotek'=> $apotek,
    ]);
});

Route::get('/cara-belanja', function () {
        return view('user.cara-belanja');
});
// akhir halaman akses tanpa login\

// halaman user
Route::middleware(['auth', 'verified', 'cekRole:user'])->group(function () {
    Route::get('/user-profile', [UserController::class, 'profile'])->name('profile-user');
    Route::post('/user-profile', [UserController::class, 'ubah'])->name('change-profile');
    Route::post('/hapus-akun', [UserController::class, 'hapus'])->name('delete-profile');

    Route::get('/riwayat-pesanan', [UserController::class,'riwayatTransaksi'])->name('riwayat-transaksi');
    Route::get('/detail-riwayat-pesanan', [UserController::class,'detailRiwayatTransaksi'])->name('detail-riwayat-transaksi');

    Route::get('/keranjang', [CartController::class,'keranjang'])->name('keranjang');
    Route::post('/keranjang/hapus', [CartController::class,'hapusItem'])->name('hapus-keranjang');
    Route::post('/keranjang/tambah', [CartController::class,'tambahItem'])->name('tambah-keranjang');

    Route::get('/booking', [CustomerController::class,'booking'])->name('booking');
    Route::post('/booking', [CustomerController::class,'booking_detail'])->name('booking-detail');
    Route::post('/pembayaran', [CustomerController::class, 'pembayaran'])->name('pembayaran');

    Route::get('/informasi_pembayaran/{file}/{id}', [CustomerController::class, 'informasi_pembayaran'])->name('informasi-pembayaran');
    Route::get('/resep_dokter/{file}/{id}', [CustomerController::class, 'resep_dokter'])->name('resep-dokter');
    Route::get('/refund/{file}/{id}', [CustomerController::class, 'refund'])->name('refund');

    Route::get('/cetak-struk/{id}', [CustomerController::class,'cetak_struk'])->name('cetak_struk');
});
// akhir halaman user

// Halaman Cashier
Route::middleware(['auth', 'verified', 'cekRole:cashier'])->prefix('cashier')->group(function () {
    Route::get('/', function()
    {
        return view('kasir.index');
    });

    Route::get('bayar',[CartController::class, 'checkout'])->name('bayar_offline');
    Route::post('hapuskeranjang', [CartController::class,'hapus_keranjang'])->name('hapus_keranjang');

    Route::get('riwayat-transaksi', [CashierController::class, 'riwayatTransaksi'])->name('riwayat-transaksi-kasir');
    Route::get('pesanan-pending', [CashierController::class, 'pendingOrder'])->name('pesanan-pending-kasir');
    Route::get('pesanan-berhasil/{id}', [CashierController::class, 'finishOrder'])->name('successOrder');
    Route::get('pesanan-gagal/{id}', [CashierController::class, 'failOrder'])->name('failOrder');
    Route::get('pesanan-online', [CashierController::class, 'onlineOrder']);
    Route::post('pesanan-online/{id}', [CashierController::class, 'updateStatus'])->name('updateStatus');

    Route::get('informasi_pembayaran/{img}', [CashierController::class, 'informasi_pembayaran'])->name('informasi-pembayaran-cust');
    Route::get('resep_dokter/{img}', [CashierController::class, 'resep_dokter'])->name('resep-dokter-cust');
    }); 
// Akhir Halaman Cashier

// halaman owner
Route::middleware(['auth', 'verified', 'cekRole:owner'])->prefix('owner')->group(function () {
    Route::get('/', [OwnerController::class, 'display'])->name('dashboard');

    Route::get('produk', [OwnerController::class, 'display_product'])->name('product');
    
    Route::get('detail-produk/{id}', [OwnerController::class, 'detail_product'])->name('product-detail');

    Route::get('tambah-produk', [OwnerController::class, 'add_product'])->name('add-product');
    Route::put('tambah-produk-process', [OwnerController::class, 'add_product_process'])->name('add-product-process');
    Route::get('tambah-batch-produk/{id}', [OwnerController::class, 'add_batch'])->name('add-product-batch');
    Route::put('tambah-batch-proccess', [OwnerController::class, 'add_batch_process'])->name('add-batch-process');
    
    Route::get('edit-produk/{id}', [OwnerController::class, 'edit_product'])->name('product-edit');
    Route::put('update-produk-process/{id}', [OwnerController::class, 'edit_product_process'])->name('product-proccess-update');

    Route::get('delete-produk/{id}', [OwnerController::class, 'delete_product'])->name('product-delete');
    Route::post('hapus-expired', [OwnerController::class, 'delete_product_expired'])->name('hapus-expired');
    
    
    Route::get('kasir', [OwnerController::class,'lihatKasir'])->name('list-kasir');
    Route::put('edit-kasir/{id}', [OwnerController::class,'editKasir'])->name('edit-kasir');
    Route::put('tambah-kasir', [OwnerController::class,'tambahKasir'])->name('tambah-kasir');
    Route::put('delete-kasir', [OwnerController::class,'deleteKasir'])->name('delete-kasir');
    
    Route::get('transaksi-penjualanan', [OwnerController::class,'log_penjualanan'])->name('list-selling-transaction');
    
    Route::get('transaksi-pembelian', [OwnerController::class,'log_pembelian'])->name('list-buying-transaction');
    
    Route::get('supplier', [OwnerController::class,'display_supplier'])->name('list-supplier');
    Route::put('tambah-supplier-process', [OwnerController::class, 'add_supplier'])->name('add-supplier');
    Route::put('edit-supplier-process/{id}', [OwnerController::class, 'edit_supplier'])->name('edit-supplier');
    Route::put('delete-supplier-process/{id}', [OwnerController::class, 'delete_supplier'])->name('delete-supplier');
    
    
    Route::get('user', [OwnerController::class, 'display_user'])->name('list-user');
    Route::put('delete-user-process/{id}', [OwnerController::class, 'delete_user'])->name('delete-user');

    Route::get('pesanan-pending', [OwnerController::class, 'pendingOrder'])->name('pesanan-pending');
    Route::post('pesanan-pending/{sellingInvoiceID}', [OwnerController::class, 'refund'])->name('owner-refund');
    Route::get('resep_dokter/{img}', [OwnerController::class, 'resep_dokter']);
    Route::get('bukti-pembayaran/{img}', [OwnerController::class, 'bukti_pembayaran']);
    Route::get('log', [OwnerController::class, 'display_log']);
    Route::post('report', [OwnerController::class, 'report'])->name('cetak-report');
    Route::get('invoice/{id}', [OwnerController::class, 'display_invoice'])->name('invoice-supplier');

});
// akhir halaman owner

require __DIR__.'/auth.php';