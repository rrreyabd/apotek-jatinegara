<?php

namespace App\Livewire;

use Livewire\Component;
use App\Model\Products;

class FilterComponent extends Component
{
    public $options;
    public $selectedOption;
    public $filteredResults;

    public function mount($choice)
    {
        if (choice == 'category' ) {
            $this->options = Product::pluck('','')->toArray();
        }
        $this->options = Product::pluck('name', 'id')->toArray();
    }
    public function render()
    {
        $this->filteredResults = Product::when($this->selectedOption, function ($query) {
            return $query->where('column_name', $this->selectedOption);
        })->get();
        return view('livewire.filter-component');
    }
}
