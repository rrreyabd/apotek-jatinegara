<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cashier;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Group;
use App\Models\Unit;
use App\Models\SellingInvoice;
use App\Models\BuyingInvoice;
use App\Models\PopularProduct;
use App\Models\LastTransaction;
use App\Models\ProductDescription;
use App\Models\ProductDetail;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Log;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreCashierRequest;
use App\Http\Requests\UpdateCashierRequest;
use App\Policies\SellingInvoiceDetailPolicy;
use Illuminate\Support\Facades\Storage;


class OwnerController extends Controller
{
    public function display()
    {
        $popular = PopularProduct::take(3)->get();
        $last = LastTransaction::orderBy('Tanggal_Transaksi')->get();
        $count_product = Product::count();
        $count_supplier = Supplier::count();
        $count_user = User::where('role', 'user')->count();
        $count_pending = SellingInvoice::where('order_status','Menunggu Pengembalian')->count();

        return view ('pemilik.index', [
            'popular' => $popular,
            'last' => $last,
            'product' => $count_product,
            'supplier' => $count_supplier,
            'pending' => $count_pending,
            'user' => $count_user
        ]);
    }

    public function total_pesanan_online()
    {
        $total_pesanan_online = SellingInvoice::where('order_status','Berhasil')->count();
        return $total_pesanan_online;
    }
    
    public function display_user()
    {
        $user = Customer::all();
        return view('pemilik.list-user', [
            'user' => $user,
            'total' => $this->total_pesanan_online()
        ]);
    }

    public function delete_user(Request $request, $id)
    {
        $user = Customer::find($id);
        User::where('user_id',$user->user_id)->delete();

        Customer::where('customer_id', $request->id)->delete();
        return redirect('/owner/user')->with('delete_status','User berhasil dihapus');
    }

    public function display_product()
    {
        $products = Product::all();
        
        return view('pemilik.list-produk',[
            'product' => $products,
            'total' => $this->total_pesanan_online()
        ]);
    }
    public function detail_product($id)
    {
        $products = Product::find($id);

        return view('pemilik.detail-produk',[
            'product' => $products,
            'total' => $this->total_pesanan_online()
        ]);
    }

    public function add_product()
    {
        $category = Category::orderBy('category')->get();
        $group = Group::orderBy('group')->get();
        $unit = Unit::orderBy('unit')->get();
        $supplier = Supplier::orderBy('supplier')->get();
        $type = ProductDescription::distinct()->pluck('product_type');

        return view('pemilik.tambah-produk',[
            "categories"=> $category ?? [],
            "units"=> $unit ?? [],
            "groups"=> $group ?? [],
            "suppliers"=> $supplier ?? [],
            "types" => $type ?? [],
        ]);
    }

    public function add_product_process(Request $request)
    {
        $validated_data = $request->validate([
            'gambar_obat' => ['required', 'file', 'max:5120', 'mimes:png,jpeg,jpg'],
        ]);

        
        $carbonDate = Carbon::parse($request->expired_date);
        $formatted = $carbonDate->format('Y-m-d H:i:s');
        $GambarObat = $validated_data['gambar_obat']->store('gambar-obat');
        
        DB::select('CALL add_product_procedure(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            $request->id,
            $request->desc_id,
            $request->nama_obat,
            $request->status,
            str_replace("gambar-obat/","",$GambarObat),
            $request->desc_id,
            $request->kategori,
            $request->golongan,
            $request->satuan_obat,
            $request->NIE,
            $request->tipe,
            $request->pemasok,
            $request->produksi,
            $request->deskripsi,
            $request->efek_samping,
            $request->dosis,
            $request->indikasi,
            $request->peringatan,
            $request->harga_beli,
            $formatted,
            $request->harga_jual,
            $request->stock,
            $request->detail_id
        ]);
        
        return redirect('/owner/produk')->with('add_status','Produk berhasil ditambah');
    }

    public function edit_product($id)
    {
        $products = Product::findOrFail($id);
        $category = Category::orderBy('category')->get();
        $group = Group::orderBy('group')->get();
        $unit = Unit::orderBy('unit')->get();
        $supplier = Supplier::orderBy('supplier')->get();
        $type = ProductDescription::distinct()->pluck('product_type');
        $state = Product::distinct()->pluck('product_status');

        return view('pemilik.edit-produk',[
            "product"=> $products ?? NULL,
            "categories"=> $category ?? [],
            "units"=> $unit ?? [],
            "groups"=> $group ?? [],
            "suppliers"=> $supplier ?? [],
            "types" => $type ?? [],
            "status" => $state ?? [],
        ]);
    }

    public function edit_product_process(Request $request,$id)
    {
        $products = Product::find($id);
        
        $validated_data = $request->validate([
            'gambar_obat' => ['file', 'max:5120', 'mimes:png,jpeg,jpg'],
        ]);

        $carbonDate = Carbon::parse($request->expired_date);
        $formatted = $carbonDate->format('Y-m-d H:i:s');

        $products -> product_status = $request->status;
        $products -> product_name = $request->nama_obat;
        $products -> description -> category_id = $request->kategori;
        $products -> detail()-> orderBy('product_expired')-> first()-> product_buy_price = $request->harga_beli;
        $products -> detail()->orderBy('product_expired')->first()->product_expired = $formatted;
        $products -> description -> group_id = $request->golongan;
        $products -> detail()-> orderBy('product_expired')-> first()-> product_sell_price = $request->harga_jual;
        $products -> detail()->orderBy('product_expired')->first()->product_stock = $request->stock;
        $products -> description -> unit_id = $request->satuan_obat;
        $products -> description -> product_DPN = $request->NIE;
        $products -> description->product_type = $request->tipe;
        $products -> description -> supplier_id = $request->pemasok;
        $products -> description -> product_manufacture = $request->produksi;
        $products -> description -> product_description = $request->deskripsi;
        $products -> description -> product_sideEffect = $request->efek_samping;
        $products -> description -> product_dosage = $request->dosis;
        $products -> description -> product_indication = $request->indikasi;
        $products -> description -> product_notice = $request->peringatan;

        if ($request->hasFile('gambar_obat')) {
            $GambarObat = $validated_data['gambar_obat']->store('gambar-obat');
            $products -> description -> product_photo = str_replace("gambar-obat/","",$GambarObat);
        }

        $products->save();
        $products->description->save();
        $products->detail()->orderBy('product_expired')->first()->save();

        return redirect('/owner/produk')->with('edit_status','Produk berhasil diperbaharui');

    }

    public function delete_product_expired(Request $request){
        DB::beginTransaction();

        try{
            ProductDetail::where('detail_id', $request->detail_id)->first()->product->update([
                'product_status' => 'aktif',
            ]);
            ProductDetail::where('detail_id', $request->detail_id)->delete();

            DB::commit();
            return redirect()->back()->with('success', "Status Kembali Aktif");
        }catch (\Exception $e) {
            DB::rollback();
            // throw $e;
            return redirect()->back()->with('error', "Terjadi Kesalahan");
        }
    }

    public function add_batch($id)
    {
        $products = Product::find($id);

        return view('pemilik.tambah-batch',[
            'product' => $products
        ]);
    }

    public function add_batch_process(Request $request)
    {
        $carbonDate = Carbon::parse($request->expired_date);
        $formatted = $carbonDate->format('Y-m-d H:i:s');

        $new_detail = new ProductDetail;
        $new_detail -> product_id = $request->id;
        $new_detail -> detail_id = $request->detail_id;
        $new_detail -> product_buy_price = $request->harga_beli;
        $new_detail -> product_expired = $formatted;
        $new_detail -> product_stock = $request->stock;

        $new_detail->save();
        return redirect('/owner/produk')->with('add_status','Batch produk berhasil ditambah');
    }

    public function display_supplier()
    {
        $supplier = Supplier::orderBy('supplier')->get();

        return view('pemilik.list-supplier',[
            'suppliers' => $supplier,
            'total' => $this->total_pesanan_online()
        ]);
    }

    public function add_supplier(Request $request)
    {
        $new_supplier = new Supplier;
        $new_supplier -> supplier_id = Str::uuid();
        $new_supplier -> supplier = $request->nama_supplier;
        $new_supplier -> supplier_address = $request->alamat;
        $new_supplier -> supplier_phone = $request->no_telp;

        $new_supplier->save();
        return redirect('owner/supplier')->with('add_status','Supplier berhasil ditambah');
    }

    public function edit_supplier(Request $request,$id)
    {
        $suppliers = Supplier::find($id);
        $suppliers -> supplier = $request->nama_supplier;
        $suppliers -> supplier_address = $request->alamat;
        $suppliers -> supplier_phone = $request->no_telp;

        $suppliers ->save();
        return redirect('owner/supplier')->with('edit_status','Supplier berhasil diedit');
    }

    public function delete_supplier(Request $request,$id)
    {
        Supplier::where('supplier_id', $request->id)->delete();
        return redirect('/owner/supplier')->with('delete_status','Supplier berhasil dihapus');
    }

    public function log_penjualanan()
    {
        $selling = SellingInvoice::get();

        return view('pemilik.log-transaksi-penjualan',[
            'sellings' => $selling,
            'total' => $this->total_pesanan_online()
        ]);

    }

    public function log_pembelian()
    {
        $buying = BuyingInvoice::get();
        $supplierNames = $buying->pluck('supplier_name')->all();
        $supplier = Supplier::whereIn('supplier', $supplierNames)->first();

        return view('pemilik.log-transaksi-pembelian',[
            'buying' => $buying,
            'supplier' => $supplier,
            'total' => $this->total_pesanan_online()
        ]);

    }

    public function lihatKasir(){

        $cashiers = User::where('role', 'cashier')
        ->get();

        return view ('pemilik.list-kasir', [
            'cashiers' => $cashiers,
            'total' => $this->total_pesanan_online()
        ]);
    }

    public function tambahKasir(Request $request){
        $new_user = new User;
        $uuid = Str::uuid();

        $new_user->user_id = $uuid;
        $new_user->username = $request->username;
        $new_user->email = $request->email;
        $new_user->role = 'cashier';
        $new_user->password = $request->password;
        $new_user->save();

        $new_cashier = new Cashier;
        $new_cashier -> cashier_id = Str::uuid();
        $new_cashier -> user_id = $uuid;
        $new_cashier -> cashier_phone = $request->no_hp;
        $new_cashier -> cashier_gender = $request->gender;
        $new_cashier -> cashier_address = $request->address;
        $new_cashier -> save();

        return redirect('/owner/kasir')->with('add_status','Kasir berhasil ditambah');
    }
    
    public function editKasir(Request $request,$id)
    {
        $cashiers= Cashier::find($id);
        $cashiers -> cashier_phone = $request->no_hp;
        $cashiers -> cashier_gender = $request->gender;
        $cashiers -> cashier_address = $request->address;
        
        $cashiers -> save();
        return redirect('/owner/kasir')->with('edit_status','Kasir berhasil diedit');
    }

    public function deleteKasir(Request $request)
    {
        User::where('user_id', $request->id)->delete();
        return redirect('/owner/kasir')->with('delete_status','Kasir berhasil dihapus');
    }

    public function pendingOrder()
    {
        $pendingOrders = SellingInvoice::where('order_status', 'Menunggu Pengembalian')
            ->orderBy('order_date', 'desc')
            ->get();
    
        return view('pemilik.pesanan-pending', [
            'pendingOrders' => $pendingOrders, 
            'total' => $this->total_pesanan_online()
        ]);
    }
    
    public function resep_dokter(Request $request){
        return view('pemilik.show-image',[
            'title' => 'Resep Dokter',
            'root' => 'resep-dokter',
            'file'=> $request->img,
        ]);
    }

    public function refund(Request $request, $id){
        try{
        $order = SellingInvoice::findOrFail($id);
        // dd($request->buktiRefund);
        
        $validated_data = $request->validate([
            'buktiRefund' => ['required', 'file', 'max:5120', 'mimes:pdf,png,jpeg,jpg'],
        ], [
            'buktiRefund.required' => 'Lampirkan bukti pengembalian uang terlebih dahulu.',
            'buktiRefund.file' => 'Dokumen pengembalian harus berupa file.',
            'buktiRefund.max' => 'Dokumen yang dilampirkan tidak boleh lebih dari 5 mb',
            'buktiRefund.mimes' => 'Format dokumen yang diterima adalah PDF, PNG, JPEG, or JPG file.',
        ]);
        $refund_file = basename($validated_data['buktiRefund']->store('refund'));
        
        $order->update([
            'refund_file' =>$refund_file,
            'order_status' => 'Refund',
        ]);
        return redirect()->back()->with('success', 'Berhasil melakukan refund.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $ex) {
        return redirect()->back()->with('error', 'Pesanan tidak ditemukan.');
        }
    }

    public function display_log()
    {
        $logs = Log::all();
        return view('pemilik.log',[
            'logs' => $logs,
            'total' => $this->total_pesanan_online()
        ]);
    }

    
}