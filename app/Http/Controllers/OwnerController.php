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
use Exception;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\Echo_;

class OwnerController extends Controller
{
    public function display()
    {
        $popular = PopularProduct::take(3)->get();
        $last = LastTransaction::orderBy('Tanggal_Transaksi', 'desc')->get();
        $count_product = Product::count();
        $count_supplier = Supplier::count();
        $count_user = User::where('role', 'user')->count();
        $count_pending = SellingInvoice::where('order_status','Menunggu Pengembalian')->count();

        $result = DB::table('selling_invoices')
            ->selectRaw('YEAR(MIN(order_complete)) as minYear, YEAR(MAX(order_complete)) as maxYear')
            ->whereNotNull('order_complete')
            ->first();

        $minYear = $result->minYear;
        $maxYear = $result->maxYear;

        $results = DB::table('selling_invoices')
            ->selectRaw('YEAR(order_complete) as year')
            ->selectRaw('total_keuntungan(CONCAT(YEAR(order_complete), "-01-01"), CONCAT(YEAR(order_complete), "-12-31")) as total_profit')
            ->whereYear('order_complete', '>=', $minYear)
            ->whereYear('order_complete', '<=', $maxYear)
            ->whereNotNull('order_complete')
            ->get();
    
 
        $resultsArray = $results->toArray();

        return view ('pemilik.index', [
            'popular' => $popular,
            'last' => $last,
            'product' => $count_product,
            'supplier' => $count_supplier,
            'pending' => $count_pending,
            'user' => $count_user,
            'results' => $resultsArray
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
        DB::beginTransaction();
        try{
            $user = Customer::find($id);

            // insert log
            DB::select('CALL insert_log(?, ?, ?, ?, ?, ?)', array($user->user->username, auth()->user()->username, 'username', 'delete', $user->user->username, '-'));

            DB::select('CALL insert_log(?, ?, ?, ?, ?, ?)', array($user->user->username, auth()->user()->username, 'email', 'delete', $user->user->email, '-'));

            if($user->customer_phone != NULL){
                DB::select('CALL insert_log(?, ?, ?, ?, ?, ?)', array($user->user->username, auth()->user()->username, 'nomor telepon', 'delete', $user->customer_phone, '-'));
            }
            // akhir insert log

            User::where('user_id',$user->user_id)->delete();
            Customer::where('customer_id', $request->id)->delete();

            DB::commit();
            return redirect('/owner/user')->with('add_status','User berhasil dihapus');
        }catch(Exception $e){
            // throw $e;
            DB::rollBack();
            return redirect('/owner/user')->with('error_status','User gagal dihapus');
        }
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
            // "status" => $state ?? [],
        ]);
    }

    public function add_product_process(Request $request)
    {
        $validated_data = $request->validate([
            'nama_obat' => ['required', 'min:5', 'max:255', 'unique:products,product_name'],
            'gambar_obat' => ['required', 'file', 'max:5120', 'mimes:png,jpeg,jpg'],
            'kategori' => ['required'],
            'golongan' => ['required'],
            'satuan_obat' => ['required'],
            'NIE' => ['required', 'size:15'],
            'tipe' => ['required'],
            'pemasok' => ['required'],
            'produksi' => ['required', 'min:5', 'max:255'],
            'deskripsi' => ['required', 'regex:/^[a-zA-Z0-9 - .]+$/'],
            'efek_samping' => ['required', 'regex:/^[a-zA-Z0-9 - .]+$/'],
            'dosis' => ['required', 'regex:/^[a-zA-Z0-9 - .]+$/'],
            'harga_beli' => ['required', 'numeric', 'min:3'],
            'harga_jual' => ['required', 'numeric', 'min:3'],
            'stock' => ['required', 'numeric', 'min:0'],
            'expired_date' => 'required|date|after_or_equal:3 months',
            ], 
            [
            'expired_date.after_or_equal' => 'Tanggal harus lebih dari 3 bulan dari sekarang.',
            ]);

            DB::beginTransaction();
            try{
                $carbonDate = Carbon::parse($request->expired_date);
                $formatted = $carbonDate->format('Y-m-d H:i:s');
                $GambarObat = $validated_data['gambar_obat']->store('gambar-obat');
                
                DB::select('CALL insert_log(?, ?, ?, ?, ?, ?)', array($request->nama_obat, auth()->user()->username, 'product', 'insert', '-', $request->nama_obat));

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
                
                DB::commit();
                return redirect('/owner/produk')->with('add_status','Produk berhasil ditambah');
            }catch(Exception $e){
                DB::rollBack();
                return redirect('/owner/produk')->with('error_status','Produk gagal ditambah');
            }
        }

    public function edit_product($id)
    {
        $products = Product::findOrFail($id);
        $category = Category::orderBy('category')->get();
        $group = Group::orderBy('group')->get();
        $unit = Unit::orderBy('unit')->get();
        $supplier = Supplier::orderBy('supplier')->get();
        $type = ProductDescription::distinct()->pluck('product_type');
        $state = ['aktif', 'tidak aktif'];

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

        if($products->product_name == $request->nama_obat){
            $validated_data = $request->validate([
                'nama_obat' => ['required', 'min:5', 'max:255'],
                'gambar_obat' => ['file', 'max:5120', 'mimes:png,jpeg,jpg'],
                'kategori' => ['required'],
                'golongan' => ['required'],
                'satuan_obat' => ['required'],
                'NIE' => ['required', 'size:15'],
                'tipe' => ['required'],
                'pemasok' => ['required'],
                'produksi' => ['required', 'min:5', 'max:255'],
                'deskripsi' => ['required', 'regex:/^[a-zA-Z0-9 - .]+$/'],
                'efek_samping' => ['required', 'regex:/^[a-zA-Z0-9 - .]+$/'],
                'dosis' => ['required', 'regex:/^[a-zA-Z0-9 - .]+$/'],
                'harga_jual' => ['required', 'numeric', 'min:3'],
            ]);
        }else{
            $validated_data = $request->validate([
                'nama_obat' => ['required', 'min:5', 'max:255', 'unique:products,product_name'],
                'gambar_obat' => ['file', 'max:5120', 'mimes:png,jpeg,jpg'],
                'kategori' => ['required'],
                'golongan' => ['required'],
                'satuan_obat' => ['required'],
                'NIE' => ['required', 'size:15'],
                'tipe' => ['required'],
                'pemasok' => ['required'],
                'produksi' => ['required', 'min:5', 'max:255'],
                'deskripsi' => ['required', 'regex:/^[a-zA-Z0-9 - .]+$/'],
                'efek_samping' => ['required', 'regex:/^[a-zA-Z0-9 - .]+$/'],
                'dosis' => ['required', 'regex:/^[a-zA-Z0-9 - .]+$/'],
                'harga_jual' => ['required', 'numeric', 'min:3'],
            ]);
        }
        
        $validated_data = $request->validate([
            'gambar_obat' => ['file', 'max:5120', 'mimes:png,jpeg,jpg'],
        ]);

        DB::beginTransaction();
        try{
            // insert log
            if($products->product_status != $request->status){
                DB::select('CALL insert_log(?, ?, ?, ?, ?, ?)', array($request->nama_obat, auth()->user()->username, 'status obat', 'update', $products->product_status, $request->status));
            }

            if($products->product_name != $request->nama_obat){
                DB::select('CALL insert_log(?, ?, ?, ?, ?, ?)', array($request->nama_obat, auth()->user()->username, 'nama obat', 'update', $products->product_name, $request->nama_obat));
            }

            if($products->description->category_id != $request->kategori){
                DB::select('CALL insert_log(?, ?, ?, ?, ?, ?)', array($request->nama_obat, auth()->user()->username, 'kategori obat', 'update', Category::where('category_id', $products->description->category)->category, Category::where('category_id', $request->kategori)->category));
            }

            if($products->description->group_id != $request->golongan){
                DB::select('CALL insert_log(?, ?, ?, ?, ?, ?)', array($request->nama_obat, auth()->user()->username, 'golongan obat', 'update', Group::where('group_id', $products->description->group)->group, Group::where('group_id', $request->golongan)->group));
            }

            if($products->product_sell_price != $request->harga_jual){
                DB::select('CALL insert_log(?, ?, ?, ?, ?, ?)', array($request->nama_obat, auth()->user()->username, 'harga jual obat', 'update', $products->product_sell_price, $request->harga_jual));
            }

            if($products->description->unit_id != $request->satuan_obat){
                DB::select('CALL insert_log(?, ?, ?, ?, ?, ?)', array($request->nama_obat, auth()->user()->username, 'satuan obat', 'update', Unit::where('unit_id', $products->description->unit)->unit, Unit::where('unit_id', $request->satuan_obat)->unit));
            }

            if($products->description->supplier_id != $request->pemasok){
                DB::select('CALL insert_log(?, ?, ?, ?, ?, ?)', array($request->nama_obat, auth()->user()->username, 'pemasok obat', 'update', Supplier::where('supplier_id', $products->description->supplier_id)->supplier), Supplier::where('supplier_id', $request->pemasok)->supplier);
            }

            if($products->description->product_DPN != $request->NIE){
                DB::select('CALL insert_log(?, ?, ?, ?, ?, ?)', array($request->nama_obat, auth()->user()->username, 'NIE obat', 'update', $products->description->product_DPN, $request->NIE));
            }

            if($products->description->product_type != $request->tipe){
                DB::select('CALL insert_log(?, ?, ?, ?, ?, ?)', array($request->nama_obat, auth()->user()->username, 'tipe obat', 'update', $products->description->product_type, $request->tipe));
            }

            if($products->description->product_manufacture != $request->produksi){
                DB::select('CALL insert_log(?, ?, ?, ?, ?, ?)', array($request->nama_obat, auth()->user()->username, 'tipe obat', 'update', $products->description->product_manufacture, $request->produksi));
            }

            if($products->description->product_description != $request->deskripsi){
                DB::select('CALL insert_log(?, ?, ?, ?, ?, ?)', array($request->nama_obat, auth()->user()->username, 'deskripsi obat', 'update', $products->description->product_description, $request->deskripsi));
            }

            if($products->description->product_sideEffect != $request->efek_samping){
                DB::select('CALL insert_log(?, ?, ?, ?, ?, ?)', array($request->nama_obat, auth()->user()->username, 'deskripsi obat', 'update', $products->description->product_sideEffect, $request->efek_samping));
            }

            if($products->description->product_dosage != $request->dosis){
                DB::select('CALL insert_log(?, ?, ?, ?, ?, ?)', array($request->nama_obat, auth()->user()->username, 'dosis obat', 'update', $products->description->product_dosage, $request->dosis));
            }

            if($products->description->product_indication != $request->indikasi){
                DB::select('CALL insert_log(?, ?, ?, ?, ?, ?)', array($request->nama_obat, auth()->user()->username, 'indikasi obat', 'update', $products->description->product_indication, $request->indikasi));
            }

            if($products->description->product_notice != $request->peringatan){
                DB::select('CALL insert_log(?, ?, ?, ?, ?, ?)', array($request->nama_obat, auth()->user()->username, 'peringatan obat', 'update', $products->description->product_notice, $request->peringatan));
            }
            // akhir insert log 

            $products -> product_status = $request->status;
            $products -> product_name = $request->nama_obat;
            $products -> description -> category_id = $request->kategori;
            $products -> description -> group_id = $request->golongan;
            $products -> product_sell_price = $request->harga_jual;
            $products -> description -> unit_id = $request->satuan_obat;
            $products -> description -> product_DPN = $request->NIE;
            $products -> description-> product_type = $request->tipe;
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
            
            DB::commit();
            return redirect('/owner/produk')->with('add_status','Produk berhasil diperbaharui');
        }catch(Exception $e){
            DB::rollBack();
            return redirect('/owner/produk')->with('error_status','Produk gagal diperbaharui');
        }
    }

    public function delete_product_expired(Request $request){
        DB::beginTransaction();

        try{
            // insert log
            DB::select('CALL insert_log(?, ?, ?, ?, ?, ?)', array(ProductDetail::where('detail_id', $request->detail_id)->first()->product->product_name, auth()->user()->username, 'tanggal obat expired', 'delete', ProductDetail::where('detail_id', $request->detail_id)->first()->product_expired, '-'));

            DB::select('CALL insert_log(?, ?, ?, ?, ?, ?)', array(ProductDetail::where('detail_id', $request->detail_id)->first()->product->product_name, auth()->user()->username, 'stock obat expired', 'delete', ProductDetail::where('detail_id', $request->detail_id)->first()->product_stock, '-'));

            DB::select('CALL insert_log(?, ?, ?, ?, ?, ?)', array(ProductDetail::where('detail_id', $request->detail_id)->first()->product->product_name, auth()->user()->username, 'harga beli obat expired', 'delete', ProductDetail::where('detail_id', $request->detail_id)->first()->product_buy_price, '-'));

            DB::select('CALL insert_log(?, ?, ?, ?, ?, ?)', array(ProductDetail::where('detail_id', $request->detail_id)->first()->product->product_name, auth()->user()->username, 'status obat expired', 'update', 'exp', 'aktif'));
            // akhir insert log

            ProductDetail::where('detail_id', $request->detail_id)->first()->product->update([
                'product_status' => 'aktif',
            ]);
            ProductDetail::where('detail_id', $request->detail_id)->delete();

            DB::commit();
            return redirect()->back()->with('add_status', "Status Kembali Aktif");
        }catch (\Exception $e) {
            DB::rollback();
            // throw $e;
            return redirect()->back()->with('error_status', "Terjadi Kesalahan");
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

        DB::beginTransaction();
        try{
            // insert log
            DB::select('CALL insert_log(?, ?, ?, ?, ?, ?)', array(Product::where('product_id', $request->id)->first()->product_name, auth()->user()->username, 'batch harga beli', 'insert', '-', $request->harga_beli));

            DB::select('CALL insert_log(?, ?, ?, ?, ?, ?)', array(Product::where('product_id', $request->id)->first()->product_name, auth()->user()->username, 'batch expired', 'insert', '-', $formatted));
        
            DB::select('CALL insert_log(?, ?, ?, ?, ?, ?)', array(Product::where('product_id', $request->id)->first()->product_name, auth()->user()->username, 'batch stock', 'insert', '-', $request->stock));
            // akhir insert log

            $new_detail = new ProductDetail;
            $new_detail -> product_id = $request->id;
            $new_detail -> detail_id = $request->detail_id;
            $new_detail -> product_buy_price = $request->harga_beli;
            $new_detail -> product_expired = $formatted;
            $new_detail -> product_stock = $request->stock;
    
            $new_detail->save();

            DB::commit();
            return redirect('/owner/produk')->with('add_status','Batch produk berhasil ditambah');
        }catch(Exception $e){
            DB::rollBack();
            return redirect('/owner/produk')->with('error_status','Batch produk gagal ditambah');
        }
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
        $request->validate([
            'nama_supplier' => ['required', 'string', 'min:5', 'max:255', 'unique:suppliers,supplier'],
            'no_telp' => ['required','numeric', 'nullable', 'digits_between:10,14', 'starts_with:08'],
            'alamat' => ['required', 'min:10', 'max:255']
        ]);
        
        DB::beginTransaction();
        try{
            DB::select('CALL insert_log(?, ?, ?, ?, ?, ?)', array($request->nama_supplier, auth()->user()->username, 'supplier', 'insert', '-', $request->nama_supplier));
            
            $new_supplier = new Supplier;
            $new_supplier -> supplier_id = Str::uuid();
            $new_supplier -> supplier = $request->nama_supplier;
            $new_supplier -> supplier_address = $request->alamat;
            $new_supplier -> supplier_phone = $request->no_telp;
            
            $new_supplier->save();

            DB::commit();
            return redirect('owner/supplier')->with('add_status','Supplier Berhasil Ditambah');
        }catch(Exception $e){
            DB::rollBack();

            return redirect('/owner/supplier')->with('error_status','Terjadi Kesalahan')->with('error', $e->validator->errors()->messages());
        }
    }

    public function edit_supplier(Request $request,$id)
    {
        $request->validate([
            'no_telp' => ['required','numeric', 'nullable', 'digits_between:10,14', 'starts_with:08'],
            'alamat' => ['required', 'min:10', 'max:255']
        ]);

        DB::beginTransaction();
        try{
            $suppliers = Supplier::find($id);

            if($suppliers->supplier_address != $request->alamat){
                DB::select('CALL insert_log(?, ?, ?, ?, ?, ?)', array($suppliers->supplier, auth()->user()->username, 'alamat supplier', 'update', $suppliers->supplier_address, $request->alamat));
            }

            if($suppliers->supplier_phone != $request->no_telp){
                DB::select('CALL insert_log(?, ?, ?, ?, ?, ?)', array($suppliers->supplier, auth()->user()->username, 'nomor telpon supplier', 'update', $suppliers->supplier_phone, $request->no_telp));
            }

            $suppliers -> supplier_address = $request->alamat;
            $suppliers -> supplier_phone = $request->no_telp;

            $suppliers ->save();

            DB::commit();
            return redirect('owner/supplier')->with('add_status','Supplier Berhasil Diedit');
        }catch(Exception $e){
            DB::rollBack();

            return redirect('/owner/supplier')->with('error_status','Terjadi Kesalahan')->with('error', $e->validator->errors()->messages());
        }
    }

    public function delete_supplier(Request $request,$id)
    {
        DB::beginTransaction();
        try{
            DB::select('CALL insert_log(?, ?, ?, ?, ?, ?)', array(Supplier::where('supplier_id', $request->id)->supplier, auth()->user()->username, 'nama supplier', 'delete', Supplier::where('supplier_id', $request->id)->supplier, '-'));

            DB::select('CALL insert_log(?, ?, ?, ?, ?, ?)', array(Supplier::where('supplier_id', $request->id)->supplier, auth()->user()->username, 'alamat supplier', 'delete', Supplier::where('supplier_id', $request->id)->supplier_address, '-'));

            DB::select('CALL insert_log(?, ?, ?, ?, ?, ?)', array(Supplier::where('supplier_id', $request->id)->supplier, auth()->user()->username, 'nomor telepon supplier', 'delete', Supplier::where('supplier_id', $request->id)->supplier_phone, '-'));

            Supplier::where('supplier_id', $request->id)->delete();

            DB::commit();
            return redirect('/owner/supplier')->with('add_status','Supplier berhasil dihapus');
        }catch(Exception $e){
            DB::rollBack();

            return redirect('/owner/supplier')->with('error_status','Tidak Dapat menghapus Supplier, Sedang Digunakan Oleh Produk');
        }
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
        $request->validate([
            'username' => ['required', 'string', 'min:5', 'max:255', 'regex:/^[^\s]+$/', 'unique:users'],
            'email' => ['required', 'email:dns', 'unique:users'],
            'password' => ['required', 'min:8', 'regex:/^[^\s]+$/'],
            'nohp' => ['required','numeric', 'nullable', 'digits_between:10,14', 'starts_with:08'],
            'address' => ['required', 'min:10']
        ]);

        DB::beginTransaction();
        try{
            DB::select('CALL insert_log(?, ?, ?, ?, ?, ?)', array($request->username, auth()->user()->username, 'cashier', 'insert', '-', $request->username));

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
            $new_cashier -> cashier_phone = $request->nohp;
            $new_cashier -> cashier_gender = $request->gender;
            $new_cashier -> cashier_address = $request->address;
            $new_cashier -> save();
    
            DB::commit();
            return redirect('/owner/kasir')->with('add_status','Kasir Berhasil Ditambah');
        }catch(Exception $e){
            DB::rollBack();

            return redirect('/owner/kasir')->with('error_status','Terjadi Kesalahan');
        }
    }
    
    public function editKasir(Request $request,$id)
    {
        $request->validate([
            'nohp' => ['required','numeric', 'nullable', 'digits_between:10,14', 'starts_with:08'],
            'address' => ['required', 'min:10']
        ]);

        DB::beginTransaction();
        try{
            $cashiers= Cashier::find($id);

            if ($cashiers->cashier_phone != $request->nohp) {
                DB::select('CALL insert_log(?, ?, ?, ?, ?, ?)', array($cashiers->user->first()->username, auth()->user()->username, 'nomor telpon cashier', 'update', $cashiers->cashier_phone, $request->nohp));
            }

            if ($cashiers->cashier_gender != $request->gender) {
                DB::select('CALL insert_log(?, ?, ?, ?, ?, ?)', array($cashiers->user->first()->username, auth()->user()->username, 'gender cashier', 'update', $cashiers->cashier_gender, $request->gender));
            }

            if ($cashiers->cashier_address != $request->address) {
                DB::select('CALL insert_log(?, ?, ?, ?, ?, ?)', array($cashiers->user->first()->username, auth()->user()->username, 'alamat cashier', 'update', $cashiers->cashier_address, $request->address));
            }

            $cashiers -> cashier_phone = $request->nohp;
            $cashiers -> cashier_gender = $request->gender;
            $cashiers -> cashier_address = $request->address;
            
            $cashiers -> save();

            DB::commit();
            return redirect('/owner/kasir')->with('add_status','Kasir Berhasil Diedit');
        }catch(Exception $e){
            DB::rollBack();
            throw $e;

            return redirect('/owner/kasir')->with('error_status','Terjadi Kesalahan');
        }
    }

    public function deleteKasir(Request $request)
    {
        DB::beginTransaction();

        try{
            DB::select('CALL insert_log(?, ?, ?, ?, ?, ?)', array(User::where('user_id', $request->id)->username, auth()->user()->username, 'kasir', 'delete', User::where('user_id', $request->id)->username, '-'));

            User::where('user_id', $request->id)->delete();

            DB::commit();
            return redirect('/owner/kasir')->with('add_status','Kasir berhasil dihapus');
        }catch(Exception $e){
            DB::rollBack();
            
            return redirect('/owner/kasir')->with('error_status','Kasir gagal dihapus');
        }
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

    public function report(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date_format:Y-m',
        ]);

        $date = $request->input('tanggal');
        
        // Mengekstrak bulan dan tahun dari tanggal yang dipilih
        list($selectedYear, $selectedMonth) = explode('-', $date . '-01');

        // Menggabungkan hasil dari kedua tabel
        $report = LastTransaction::whereMonth('Tanggal_Transaksi', $selectedMonth)
        ->whereYear('Tanggal_Transaksi', $selectedYear)
        ->orderBy('Tanggal_Transaksi')
        ->get();

        $expenses = LastTransaction::whereMonth('Tanggal_Transaksi', $selectedMonth)
        ->whereYear('Tanggal_Transaksi', $selectedYear)
        ->where('tipe_transaksi', 'pembelian')
        ->get();
        
        $sales = LastTransaction::whereMonth('Tanggal_Transaksi', $selectedMonth)
        ->whereYear('Tanggal_Transaksi', $selectedYear)
        ->where('tipe_transaksi', 'penjualan')
        ->get();

        if ($report->isEmpty()) {
            // Array kosong, atur sesuai kebutuhan
            $reportData = [];
            return redirect()->back()->with('error', 'Tidak ada transaksi di bulan ini.');

        } else {
            // Array tidak kosong, dapat diakses dengan aman
            $reportData = $report;
            // ... operasi lainnya
        }
        // dd($report);
            return view('pemilik.laporan-keuangan', ['reports'=>$report,
        'month'=>$selectedMonth,
        'year'=>$selectedYear,
        'expenses'=>$expenses,
        'sales'=>$sales
        ]);
    }
}