<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class CashierLiveshow extends Component
{
    public $search;
    protected $queryString = ['search'];
    public $products;

    public function search_product()
    {
        if ($this->search === null) {
            $this->products = Product::all();
        } else {
            $this->products = Product::where("product_name", "LIKE", "%" . $this->search . "%")->get();
        }
    }

    public function render()
    {
        return view('livewire.cashier-liveshow', ['product' => $this->products ?? []]);
    }
}
