<?php

namespace App\Livewire;

use App\Models\Cart;
use Livewire\Component;

class ProductPriceCart extends Component
{
    protected $listeners = ['quantity'];
    public $product_price;
    public $product_quantity;
    public $cart_id;
    public $cart;
    public $quantity;
    
    public function mount($price, $cart) {
        $this->product_price = $price;
        $this->cart = $cart;
    }
    public function quantity ($cart_id, $quantity){
        $this->cart_id = $cart_id;
        $this->product_quantity = $quantity;
        $this->quantity = Cart::where('cart_id', $this->cart)->first()->quantity;
        $this->dispatch('totalHarga', $this->quantity * $this->product_price);
    }


    public function render()
    {
        return view('livewire.product-price-cart');
    }
}
