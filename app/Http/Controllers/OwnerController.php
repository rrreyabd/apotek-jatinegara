<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SellingInvoice;
use App\Models\PopularProduct;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCashierRequest;
use App\Http\Requests\UpdateCashierRequest;
use App\Policies\SellingInvoiceDetailPolicy;
use Illuminate\Support\Facades\Storage;


class OwnerController extends Controller
{
    public function display()
    {
        $popular = PopularProduct::take(3)->get();
        $count_product = Product::count();
        $count_supplier = Supplier::count();
        $count_user = User::where('role', 'user')->count();
        $count_pending = SellingInvoice::where('order_status','Menunggu Pengembalian')->count();

        return view ('pemilik.index', [
            'popular' => $popular,
            'product' => $count_product,
            'supplier' => $count_supplier,
            'pending' => $count_pending,
            'user' => $count_user
        ]);
    }

    public function display_user()
    {
        $total_pesanan_online = SellingInvoice::where('order_status','Berhasil')->count();;
        return view('pemilik.list-user', [
            'total' => $total_pesanan_online
        ]);
    }

    public function lihatKasir(){

        $cashiers = User::where('role', 'cashier')
        ->get();

        // dd($cashiers);
        return view ('pemilik.list-kasir', ['cashiers' => $cashiers]);
    }
    public function pendingOrder()
    {
        $pendingOrders = SellingInvoice::where('order_status', 'Menunggu Pengembalian')
            ->orderBy('order_date', 'desc')
            ->get();
            // dd($pendingOrders);

            $total = SellingInvoice::where('order_status', 'Menunggu Pengembalian')
            ->count();
    
        return view('pemilik.pesanan-pending', ['pendingOrders' => $pendingOrders,  'total' => $total]);
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
        $buktiRefund = $validated_data['buktiRefund']->store('refund');

        $order->update([
            'refund_file' =>$buktiRefund,
            'order_status' => 'Refund',
        ]);
        return redirect()->back()->with('success', 'Berhasil melakukan refund.');
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $ex) {
        return redirect()->back()->with('error', 'Pesanan tidak ditemukan.');
    }
}
}