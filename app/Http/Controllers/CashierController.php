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

class CashierController extends Controller
{
public function riwayatTransaksi()
    {
        $histories = SellingInvoice::where('order_status', 'Berhasil')
            ->orWhere('order_status','Offline')
            ->orWhere('order_status','Gagal')
            ->orWhere('order_status','Refund')
            ->orderBy('order_date', 'desc')
            ->get();
            // dd($histories);
    
        return view('kasir.riwayat-transaksi', ['histories' => $histories]);
    }
    public function pendingOrder()
    {
        $pendingOrders = SellingInvoice::where('order_status', 'Menunggu Pengambilan')
            ->orderBy('order_date', 'desc')
            ->get();
            // dd($pendingOrders);
    
        return view('kasir.pesanan-pending', ['pendingOrders' => $pendingOrders,]);
    }
    
    public function onlineOrder(){
        $onlineOrders = SellingInvoice::where('order_status', 'Menunggu Konfirmasi')
            ->orderBy('order_date', 'desc')
            ->get();
            // dd($onlineOrders);

        return view('kasir.pesanan-online', ['onlineOrders' => $onlineOrders]);
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

    public function updateStatus(Request $request, $id){
        try{
            $order = SellingInvoice::findOrFail($id);
            
            
            if($request->status == 'terima'){
                $order->order_status = 'Menunggu Pengambilan';
                
                $order->cashier_name = auth()->user()->username;
                $order->save();
                
                return redirect()->back()->with('success', 'Pesanan berhasil diterima.');
            } else if($request->status == 'tolak'){
                $order->order_status = 'Gagal';
                $order->cashier_name = auth()->user()->username;

                $request->validate([
                    'alasanTolak' => ['required', 'string', 'min:10', 'regex:/^[a-zA-Z0-9 ]+$/', 'max:255']
                ]);
                $order->reject_comment = $request->alasanTolak; 

                $order->save();
                
                return redirect()->back()->with('success', 'Pesanan berhasil ditolak.');
            } else if($request->status == 'refund'){
                $order->order_status = 'Menunggu Pengembalian';
                $order->cashier_name = auth()->user()->username;
                
                $request->validate([
                    'alasanRefund' => ['required', 'string', 'min:10', 'regex:/^[a-zA-Z0-9 ]+$/', 'max:255']
                ]);
                $order->reject_comment = $request->alasanRefund; 

                $order->save();
                
                return redirect()->back()->with('success', 'Pesanan akan diproses untuk pengembalian.');
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

    public function destroy(Cashier $cashier)
    {
        //
    }
}