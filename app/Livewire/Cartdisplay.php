<?php

namespace App\Livewire;
use App\Models\Cart;
use Livewire\Component;

class Cartdisplay extends Component
{
    public $user_id;
    public $product_id;
    public $cartItems;
    public $totalProducts = 0;
    public $quantity;
    protected $listeners = ['productAddedToCart'];

    public function mount($user,$product)
    {
        $this->user_id = $user;
        $this->product_id = $product;
        $this->updateCartItems();
    }
    public function productAddedToCart()
    {
        $this->updateCartItems();
    }
    private function updateCartItems()
    {
        $this->cartItems = Cart::where('user_id', $this->user_id)->get();
        $this->totalProducts = $this->cartItems->count('product_id');
    }

    public function render()
    {
        return view('livewire.cartdisplay');
    }
}
