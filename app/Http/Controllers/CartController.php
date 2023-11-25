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

    // public function jumlahItem(Request $request) {
    //     $cart = Cart::find($request->cart_id);

    //     if( $request->operasi == "kurang" ) {
    //         if($request->quantity > $cart->product->detail()->orderBy('product_expired')->first()->product_stock) {
    //             Cart::where('cart_id', $request->cart_id)->update([
    //                 'quantity'=> $cart->product->detail()->orderBy('product_expired')->first()->product_stock,
    //             ]);
    //         }else if($request->quantity <= $cart->product->detail()->orderBy('product_expired')->first()->product_stock && $request->quantity >= 1) {
    //             Cart::where('cart_id', $request->cart_id)->update([
    //                 'quantity'=> $request->quantity - 1,
    //             ]);
    //         }else{
    //             Cart::where('cart_id', $request->cart_id)->update([
    //                 'quantity'=> 1,
    //             ]);
    //         }
    //     }elseif( $request->operasi == 'tambah') {
    //         if($request->quantity > $cart->product->detail()->orderBy('product_expired')->first()->product_stock) {
    //             Cart::where('cart_id', $request->cart_id)->update([
    //                 'quantity'=> $cart->product->detail()->orderBy('product_expired')->first()->product_stock,
    //             ]);
    //         }else if($request->quantity <= $cart->product->detail()->orderBy('product_expired')->first()->product_stock && $request->quantity >= 1) {
    //             Cart::where('cart_id', $request->cart_id)->update([
    //                 'quantity'=> $request->quantity + 1,
    //             ]);
    //         }else{
    //             Cart::where('cart_id', $request->cart_id)->update([
    //                 'quantity'=> 1,
    //             ]);
    //         }
    //     }
        
    //     return redirect()->back();
    // }

    public function hapusItem(Request $request) {
        if( $request->hapus == "semua" ) {
            Cart::where('user_id', auth()->user()->user_id)->delete();
        }elseif( $request->hapus == 'satuan') {
            Cart::where('cart_id', $request->cart_id)->delete();
        }
        
        return redirect()->back();
    }

    public function tambahItem(Request $request) {
        $carts = Cart::where('product_id', $request->product_id)->where('user_id', auth()->user()->user_id)->get();

        if($carts->first() == NULL && Cart::where('user_id', auth()->user()->user_id)->count() < 30){
            Cart::create([
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
        Cart::where('user_id', auth()->user()->user_id)->delete();
        return redirect()->back();
    }

    public function checkout()
    {
        DB::beginTransaction();
        $uuid = Str::uuid();
        
        try{
            $cart = Cart::where('user_id', auth()->user()->user_id)->get();
            $produk_id = SellingInvoice::orderBy('invoice_code', 'desc')->pluck('invoice_code')->first();
            $number = intval(str_replace("INV-", "", $produk_id)) + 1;
            SellingInvoice::create([
                'selling_invoice_id' => $uuid,
                'invoice_code' => 'INV-' . str_pad($number, 6, '0', STR_PAD_LEFT),
                'cashier_name' => auth()->user()->username,
                'order_date' => now(),
                'order_complete' => now(),
                'order_status' => 'Offline',
            ]);
            // dd(auth()->user()->username);
            
            
            foreach ($cart as $item) {
                SellingInvoiceDetail::create([
                    'selling_detail_id' => Str::uuid(),
                    'selling_invoice_id' => $uuid,
                    'product_name' => $item->product->product_name,
                    'product_sell_price' => $item->product->detail()->orderBy('product_expired')->first()->product_sell_price,
                    'quantity' => $item->quantity,
                ]);

                ProductDetail::where('product_id',$item->product_id)->update([
                    'product_stock' => $item->product->detail()->orderBy('product_expired')->first()->product_stock - $item->quantity
                ]);
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