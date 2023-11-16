<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class Livesearch extends Component
{
    protected $listeners = ["livesearch"];
    public $product;
    public $cari;

    public function livesearch($cari){
            $this->product = Product::where("product_name", "Like", "%". $cari ."%")->pluck('product_name')->take(10);
    }
    
    public function render()
    {
        
        return view('livewire.livesearch',[
            'products'=> $this->product ?? [],
        ]);
    }
}