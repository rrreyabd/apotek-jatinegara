<?php

namespace App\Livewire;
use App\Models\User;
use App\Models\Cart;
use App\Models\Product;
use App\Models\SellingInvoice;
use App\Models\SellingInvoiceDetail;
use Illuminate\Support\Str;
use Livewire\Component;
use Illuminate\Support\Facades\DB;


class Cartdisplay extends Component
{
    public $user_id;
    public $product_id;
    public $cartItems;
    public $totalProducts = 0;
    public $quantity;
    protected $listeners = ['productAddedToCart', 'decrementButton', 'incrementButton'];

    public function mount() {
        $this->cartItems = Cart::where('user_id', auth()->user()->user_id)->get();
    }

    public function productAddedToCart($user, $product)
    {
        $existingCart = Cart::where('user_id', $user)
        ->where('product_id', $product)
        ->first();

        if (!$existingCart) {
            Cart::create([
                "cart_id" => Str::uuid(),
                'user_id' => $this->user,
                'product_id' => $this->product,
                'quantity' => 1
            ]);
        }
        $this->cartItems = Cart::where('user_id', $user)->get();
    }

    public function checkout()
    {
        DB::beginTransaction();
        $uuid = Str::uuid();
        
        try{
            $cartItems = Cart::all();
            
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
            
            foreach ($cartItems as $cartItem) {
                SellingInvoiceDetail::create([
                    'selling_detail_id' => Str::uuid(),
                    'selling_invoice_id' => $uuid,
                    'product_name' => $cartItem->product->product_name,
                    'product_sell_price' => $cartItem->product->detail()->orderBy('product_expired')->first()->product_sell_price,
                    'quantity' => $cartItem->quantity,
                ]);
            }

            Cart::truncate();

            DB::commit();
        } 
        catch (\Exception $e) {
            DB::rollBack();

        }
    }

    public function decrementButton($cart, $detail_product) {
        if($cart['quantity'] > $detail_product['product_stock']) {
            Cart::where('cart_id', $cart['cart_id'])->update([
                'quantity'=> $detail_product['product_stock'],
            ]);
        }else if($cart['quantity'] <= $detail_product['product_stock'] && $cart['quantity'] > 1) {
            Cart::where('cart_id', $cart['cart_id'])->update([
                'quantity'=> $cart['quantity'] - 1,
            ]);
        }else {
            Cart::where('cart_id', $cart['cart_id'])->delete();
        }
        $this->cartItems = Cart::where('user_id', auth()->user()->user_id)->get();
        // $this->quantity = Cart::where('cart_id', $this->cart_id)->first()->quantity;
        // $this->dispatch('quantity', $this->cart_id, $this->quantity);
    }

        public function incrementButton($cart, $detail_product) {
            // $carts = collect($cart);
            // dd($detail_product['product_stock']);
            if($cart['quantity'] > $detail_product['product_stock']) {
                Cart::where('cart_id', $cart['cart_id'])->update([
                    'quantity'=> $detail_product['product_stock'],
                ]);
            }else if($cart['quantity'] <= $detail_product['product_stock'] && $cart['quantity'] >= 1) {
                Cart::where('cart_id', $cart['cart_id'])->update([
                    'quantity'=> $cart['quantity'] + 1,
                ]);
            }else{
                Cart::where('cart_id', $cart['cart_id'])->update([
                    'quantity'=> 1,
                ]);
            }
            $this->cartItems = Cart::where('user_id', auth()->user()->user_id)->get();
            // $quantity = Cart::where('cart_id', $this->cart_id)->first()->quantity;
            // $this->dispatch('quantity', $this->cart_id, $this->quantity);
        }
    // private function updateCartItems($user, $product)
    // {
    // }

    public function render()
    {
        return view('livewire.cartdisplay');
    }
}