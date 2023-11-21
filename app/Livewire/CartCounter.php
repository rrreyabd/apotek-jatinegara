<?php

namespace App\Livewire;
use App\Models\Cart;
use Livewire\Component;

class CartCounter extends Component
{
    public $stock_product;
    public $quantity;
    public $cart_id;

    public function mount($stock,$quantity, $cart)
    {
        $this->stock_product = $stock;
        $this->quantity = $quantity;
        $this->cart_id = $cart;
    }

    public function cashier_count($item)
    {
        $this->dispatch('addToCart',auth()->user()->user_id,$item);
    }

    public function decrementButton() {
            if($this->quantity > $this->stock_product) {
                Cart::where('cart_id', $this->cart_id)->update([
                    'quantity'=> $this->stock_product,
                ]);
            }else if($this->quantity <= $this->stock_product && $this->quantity >= 1) {
                Cart::where('cart_id', $this->cart_id)->update([
                    'quantity'=> $this->quantity - 1,
                ]);
            }else{
                Cart::where('cart_id', $this->cart_id)->update([
                    'quantity'=> 1,
                ]);
            }
            $this->quantity = Cart::where('cart_id', $this->cart_id)->first()->quantity;
            $this->dispatch('quantity', $this->cart_id, $this->quantity);
        
    }

    public function incrementButton() {
            if($this->quantity > $this->stock_product) {
                Cart::where('cart_id', $this->cart_id)->update([
                    'quantity'=> $this->stock_product,
                ]);
            }else if($this->quantity <= $this->stock_product && $this->quantity >= 1) {
                Cart::where('cart_id', $this->cart_id)->update([
                    'quantity'=> $this->quantity + 1,
                ]);
            }else{
                Cart::where('cart_id', $this->cart_id)->update([
                    'quantity'=> 1,
                ]);
            }
            $this->quantity = Cart::where('cart_id', $this->cart_id)->first()->quantity;
            $this->dispatch('quantity', $this->cart_id, $this->quantity);
    }

    public function render()
    {
        return view('livewire.cart-counter');
    }
}
