<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class CashierLiveshow extends Component
{
    public $search;
    public $categories;
    public $groups;
    public $units;
    protected $queryString = ['search'];
    public $products;

    public function search_product()
    {
        if ($this->search === null) {
            $this->products = Product::all();
        } else {
            $this->products = Product::where("product_name", "LIKE", "%" . $this->search . "%")->get();
        }
        $this->categories = Category::orderBy('category')->get();
        $this->groups = Group::orderBy('group')->get();
        $this->units = Unit::orderBy('unit')->get();
    }

    public function render()
    {
        return view('livewire.cashier-liveshow', [
            'product' => $this->products ?? [],
            "categories"=> $categories ?? [],
            "units"=> $units ?? [],
            "groups"=> $groups ?? [],
            ]
        );
    }
}
