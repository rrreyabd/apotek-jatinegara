<?php

namespace App\Http\Controllers;

use App\Models\Cashier;
use App\Models\SellingInvoice;
use App\Models\Product;
use App\Models\SellingInvoiceDetail;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCashierRequest;
use App\Http\Requests\UpdateCashierRequest;
use App\Policies\SellingInvoiceDetailPolicy;
use Illuminate\Support\Facades\DB;

class CashierController extends Controller
{
public function riwayatTransaksi()
    {
        $histories = SellingInvoice::where('cashier_name',auth()->user()->username)
            ->where('order_status', 'Berhasil')
            ->orWhere('order_status','Offline')
            ->orWhere('order_status','Gagal')
            ->orWhere('order_status','Refund')
            ->orderBy('invoice_code', 'desc')
            ->get();
            // dd($histories);

        $total = SellingInvoice::where('order_status', 'Menunggu Konfirmasi')
            ->count();
    
        return view('kasir.riwayat-transaksi', ['histories' => $histories, 'total' => $total]);
    }
    public function pendingOrder()
    {
        $pendingOrders = SellingInvoice::where('order_status', 'Menunggu Pengambilan')
            ->orderBy('order_date', 'desc')
            ->get();
            // dd($pendingOrders);

            $total = SellingInvoice::where('order_status', 'Menunggu Konfirmasi')
            ->count();
    
        return view('kasir.pesanan-pending', ['pendingOrders' => $pendingOrders,  'total' => $total]);
    }
    
    public function onlineOrder(){
        $onlineOrders = SellingInvoice::where('order_status', 'Menunggu Konfirmasi')
            ->orderBy('order_date', 'desc')
            ->get();
            // dd($onlineOrders);
        $total = $onlineOrders->count();

        return view('kasir.pesanan-online', ['onlineOrders' => $onlineOrders, 'total' => $total]);
    }


    public function finishOrder($id){
        try {
            $order = SellingInvoice::findOrFail($id);
            
            // Ubah status menjadi 'Berhasil'
            $order->order_status = 'Berhasil';
            $order->order_complete = now();
            $order->save();
    
            // Redirect ke halaman atau tindakan yang sesuai
            return redirect()->back()->with('success', 'Status berhasil diperbarui.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $ex) {
            return redirect()->back()->with('error', 'Pesanan tidak ditemukan.');
        }
    }

    public function failOrder($id){
        try {
            DB::beginTransaction();
            $order = SellingInvoice::findOrFail($id);
            
            DB::select("CALL order_fail(?, ?, ?)", array($id, auth()->user()->username, "Telah Melewati Batas Waktu Pengambilan, Tidak Akan Dilakukan Refund!!"));

            foreach($order->sellingInvoiceDetail as $detail) {
                $product_id = Product::where('product_name', $detail->product_name)->first()->product_id;
                // dd($product_id);
                DB::select("CALL stock_back(?, ?)", array($detail->quantity, $product_id));
            }
            DB::commit();
    
            // Redirect ke halaman atau tindakan yang sesuai
            return redirect()->back()->with('success', 'Status berhasil diperbarui.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $ex) {
            return redirect()->back()->with('error', 'Pesanan tidak ditemukan.');
        }
    }

    public function updateStatus(Request $request, $id){
        try{
            $order = SellingInvoice::findOrFail($id);
            
            
            if($request->status == 'terima'){
                DB::select("CALL order_success(?, ?)", array($id, auth()->user()->username));
                
                return redirect()->back()->with('success', 'Pesanan berhasil diterima.');
            } else if($request->status == 'tolak'){
                try {
                    $request->validate([
                        'alasanTolak' => ['required', 'string', 'min:10', 'regex:/^[a-zA-Z0-9 ]+$/', 'max:255']
                    ]);
                    DB::beginTransaction();
                        
                        DB::select("CALL order_fail(?, ?, ?)", array($id, auth()->user()->username, $request->alasanTolak));

                        foreach($order->sellingInvoiceDetail as $detail) {
                            $product_id = Product::where('product_name', $detail->product_name)->first()->product_id;
                            // dd($product_id);
                            DB::select("CALL stock_back(?, ?)", array($detail->quantity, $product_id));
                        }
                        
                    DB::commit();
                    return redirect()->back()->with('success', 'Pesanan akan diproses untuk pengembalian.');
                } catch (\Exception $e) {
                    // throw $e;
                    return redirect()->back()->with('error', 'Terjadi Kesalahan Penolakan');
                }
            } else if($request->status == 'refund'){
                try {
                    DB::beginTransaction();
                        $request->validate([
                            'alasanRefund' => ['required', 'string', 'min:10', 'regex:/^[a-zA-Z0-9 ]+$/', 'max:255']
                        ]);
                        DB::select("CALL order_refund(?, ?, ?)", array($id, auth()->user()->username, $request->alasanRefund));


                        foreach($order->sellingInvoiceDetail as $detail) {
                            $product_id = Product::where('product_name', $detail->product_name)->first()->product_id;
                            // dd($product_id);
                            DB::select("CALL stock_back(?, ?)", array($detail->quantity, $product_id));
                        }
                        
                    DB::commit();
                    return redirect()->back()->with('success', 'Pesanan akan diproses untuk pengembalian.');
                } catch (\Exception $e) {
                    // throw $e;
                    return redirect()->back()->with('error', 'Terjadi Kesalahan Refund');
                }
            }
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $ex) {
            return redirect()->back()->with('error', 'Pesanan tidak ditemukan.');
        }
    }
    public function informasi_pembayaran(Request $request){
        return view('kasir.show-image',[
            'title' => 'Bukti Pembayaran',
            'root' => 'bukti-pembayaran',
            'file'=> $request->img,
        ]);
    }

    public function resep_dokter(Request $request){
        return view('kasir.show-image',[
            'title' => 'Resep Dokter',
            'root' => 'resep-dokter',
            'file'=> $request->img,
        ]);
    }

    public function refund(Request $request){
        return view('kasir.show-image',[
            'title' => 'Refund',
            'root' => 'refund',
            'file'=> $request->img,
        ]);
    }
}