<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Category;
use App\Models\Group;
use App\Models\Unit;
use App\Models\Cart;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class CashierLiveshow extends Component
{
    use WithPagination;

    public $search;
    public $categories;
    public $groups;
    public $units;
    public $product;

    public $selectedUnit;
    public $selectedGroup;
    public $selectedCategory;

    protected $listeners = ['filterChanged' => 'getFilteredProducts'];

    public function AddedToCart($product)
    {
        $existingCart = Cart::where('user_id', auth()->user()->user_id)
        ->where('product_id', $product['product_id'])
        ->first();

        if (!$existingCart) {
            Cart::create([
                "cart_id" => Str::uuid(),
                'user_id' => auth()->user()->user_id,
                'product_id' => $product['product_id'],
                'quantity' => 1
            ]);
        }
        $this->dispatch('productAddedToCart', auth()->user()->user_id, $product['product_id']);
    }

    public function search_product()
    {
        return $this->search
            ? Product::where("product_name", "LIKE", "%" . $this->search . "%")->orderBy('product_status')->paginate(8)
            : Product::orderBy('product_status')->paginate(8);
    }

    public function getFilteredProducts()
    {
        $products = Product::query();
        if ($this->selectedUnit) {
            $products->whereHas('description.unit', function ($query) {
                $query->where('unit_id', $this->selectedUnit);
            });
        }

        if ($this->selectedGroup) {
            $products->whereHas('description.group', function ($query) {
                $query->where('group_id', $this->selectedGroup);
            });
        }

        if ($this->selectedCategory) {
            $products->whereHas('description.category', function ($query) {
                $query->where('category_id', $this->selectedCategory);
            });
        }

        $products = $product->orderBy('product_status')->paginate(8);
    }
    
    public function applyFilter($filterType, $filterId)
    {
        switch ($filterType) {
            case 'unit':
                $this->selectedUnit = $filterId;
                $this->selectedGroup = null;
                $this->selectedCategory = null;
            break;

            case 'group':
                $this->selectedGroup = $filterId;
                $this->selectedUnit = null;
                $this->selectedCategory = null;
            break;
                    
            case 'category':
                $this->selectedCategory = $filterId;
                $this->selectedUnit = null;
                $this->selectedGroup = null;
            break;
        }

        $this->dispatch('filterChanged');
    }

    public function render()
    {
        $product = $this->search_product();

        $this->categories = Category::orderBy('category')->get();
        $this->groups = Group::orderBy('group')->get();
        $this->units = Unit::orderBy('unit')->get();

        return view('livewire.cashier-liveshow', [
            'products' => $product ?? [],
            'categories' => $this->categories ?? [],
            'units' => $this->units ?? [],
            'groups' => $this->groups ?? [],
        ]);
    }
}
