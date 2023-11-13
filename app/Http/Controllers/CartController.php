<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public function keranjang() {
        $carts = Auth()->user()->cart;

        return view("user.keranjang",[
            "carts"=> $carts,
        ]);
    }

    public function jumlahItem(Request $request) {
        $cart = Cart::find($request->cart_id);

        if( $request->operasi == "kurang" ) {
            if($request->quantity > $cart->product->detail()->orderBy('product_expired')->first()->product_stock) {
                Cart::where('cart_id', $request->cart_id)->update([
                    'quantity'=> $cart->product->detail()->orderBy('product_expired')->first()->product_stock,
                ]);
            }else if($request->quantity <= $cart->product->detail()->orderBy('product_expired')->first()->product_stock && $request->quantity >= 1) {
                Cart::where('cart_id', $request->cart_id)->update([
                    'quantity'=> $request->quantity - 1,
                ]);
            }else{
                Cart::where('cart_id', $request->cart_id)->update([
                    'quantity'=> 1,
                ]);
            }
        }elseif( $request->operasi == 'tambah') {
            if($request->quantity > $cart->product->detail()->orderBy('product_expired')->first()->product_stock) {
                Cart::where('cart_id', $request->cart_id)->update([
                    'quantity'=> $cart->product->detail()->orderBy('product_expired')->first()->product_stock,
                ]);
            }else if($request->quantity <= $cart->product->detail()->orderBy('product_expired')->first()->product_stock && $request->quantity >= 1) {
                Cart::where('cart_id', $request->cart_id)->update([
                    'quantity'=> $request->quantity + 1,
                ]);
            }else{
                Cart::where('cart_id', $request->cart_id)->update([
                    'quantity'=> 1,
                ]);
            }
        }
        
        return redirect()->back();
    }

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
                'quantity' => 1
            ]);
        }
        
        return redirect()->back();
    }
}
