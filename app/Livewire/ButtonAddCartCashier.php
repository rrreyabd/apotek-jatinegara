<?php

namespace App\Livewire;

use App\Models\Cart;
use Illuminate\Support\Str;
use Livewire\Component;

class ButtonAddCartCashier extends Component
{
    public $user_id;
    public $product_id;

    public function mount($user,$product)
    {
        $this->user_id = $user;
        $this->product_id = $product;
    }

    public function productAddedToCart()
    {
        $existingCart = Cart::where('user_id', $this->user_id)
        ->where('product_id', $this->product_id)
        ->first();

        if (!$existingCart) {
            Cart::create([
                "cart_id" => Str::uuid(),
                'user_id' => $this->user_id,
                'product_id' => $this->product_id,
                'quantity' => 1
            ]);
        }
        $this->dispatch('productAddedToCart', $this->user_id, $this->product_id);
    }

    public function render()
    {
        return view('livewire.button-add-cart-cashier');
    }
}
