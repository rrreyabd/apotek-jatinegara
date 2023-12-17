<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\ProductDetail;
use App\Models\SellingInvoice;
use App\Models\SellingInvoiceDetail;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public function keranjang() {
        $carts = DB::table('cart_view')->where('user_id', auth()->user()->user_id)->get();

        return view("user.keranjang",[
            "carts"=> $carts,
        ]);
    }

    public function hapusItem(Request $request) {
        if( $request->hapus == "semua" ) {
            Cart::on('user')->where('user_id', auth()->user()->user_id)->delete();
        }elseif( $request->hapus == 'satuan') {
            Cart::on('user')->where('cart_id', $request->cart_id)->delete();
        }
        
        return redirect()->back();
    }

    public function tambahItem(Request $request) {
        $carts = Cart::on('user')->where('product_id', $request->product_id)->where('user_id', auth()->user()->user_id)->get();

        if($carts->first() == NULL && Cart::on('user')->where('user_id', auth()->user()->user_id)->count() < 30){
            Cart::on('user')->create([
                'cart_id' => Str::uuid(),
                'user_id' => auth()->user()->user_id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity ?? 1,
            ]);
        }else{
            return redirect()->back()->with('error', 'Product Telah Berada Dalam Keranjang/Lebih Dari 30 Produk');
        }
        
        return redirect()->back();
    }

    public function hapus_keranjang() {
        Cart::on('user')->where('user_id', auth()->user()->user_id)->delete();
        return redirect()->back();
    }

    public function checkout()
    {
        DB::beginTransaction();
        $uuid = Str::uuid();
        
        try{
            $cart = Cart::on('cashier')->where('user_id', auth()->user()->user_id)->get();
            $produk_id = SellingInvoice::on('cashier')->orderBy('invoice_code', 'desc')->pluck('invoice_code')->first();
            $number = intval(str_replace("INV-", "", $produk_id)) + 1;
            SellingInvoice::on('cashier')->create([
                'selling_invoice_id' => $uuid,
                'invoice_code' => 'INV-' . str_pad($number, 6, '0', STR_PAD_LEFT),
                'cashier_name' => auth()->user()->username,
                'order_date' => now(),
                'order_complete' => now(),
                'order_status' => 'Offline',
            ]);
            
            
            foreach ($cart as $item) {
                SellingInvoiceDetail::on('cashier')->create([
                    'selling_detail_id' => Str::uuid(),
                    'selling_invoice_id' => $uuid,
                    'product_name' => $item->product->product_name,
                    'product_type' => $item->product->description->product_type,
                    'product_sell_price' => $item->product->product_sell_price,
                    'quantity' => $item->quantity,
                ]);

                // mengurangi stock
                while ($item->quantity > 0) {
                    if ($item->quantity >= $item->product->detail()->where('product_stock' , '>', 0)->orderBy('product_expired')->first()->product_stock) {
                        $item->quantity = $item->quantity - $item->product->detail()->where('product_stock' , '>', 0)->orderBy('product_expired')->first()->product_stock;

                        if($item->product->detail()->count() > 1){
                            $item->product->detail()->where('product_stock' , '>', 0)->orderBy('product_expired')->first()->delete();
                        }else{
                            $item->product->detail()->where('product_stock' , '>', 0)->orderBy('product_expired')->first()->update([
                                'product_stock' => 0,
                            ]);
                        }
                    }else{
                        $item->product->detail()->where('product_stock' , '>', 0)->orderBy('product_expired')->first()->update([
                            'product_stock' => $item->product->detail()->where('product_stock' , '>', 0)->orderBy('product_expired')->first()->product_stock - $item->quantity,
                        ]);

                        $item->quantity = 0;
                    }
                }
                // akhir mengurangi stock

                // mengubah status jadi tidak aktif
                if ($item->product->detail()->where('product_stock' , '>', 0)->first() == NULL) {
                    $item->product->update([
                        'product_status' => 'tidak aktif',
                    ]);
                }
                // akhir mengubah status menjadi tidak aktif
            }


            foreach($cart as $item)
            {
                $item->delete();
            }

            DB::commit();
            return redirect()->back()->with('success', 'Pembayaran Berhasil');
        } 
        catch (\Exception $e) {
            DB::rollBack();

            // throw $e;
            return redirect()->back()->with('error', 'Transaksi Gagal');
        }
    }
}