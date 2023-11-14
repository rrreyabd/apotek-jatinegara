<div>
    <div class="sm:flex sm:grid-cols-3 gap-4 justify-center">
        @if ($quantity <= 1)
        <button wire:click='decrement' type="button" class="inline-flex items-center justify-center p-3.5 rounded-lg shadow-lg text-sm font-medium h-6 w-6 text-gray-500 bg-white border border-gray-300 focus:ring-2 focus:ring-mainColor focus:ring-opacity-25 opacity-50" disabled>
            <i class="fa-solid fa-minus"></i>
        </button>
        @else
        <button wire:click='decrement' type="button" class="inline-flex items-center justify-center p-3.5 rounded-lg shadow-lg text-sm font-medium h-6 w-6 text-gray-500 bg-white border border-gray-300 focus:ring-2 focus:ring-mainColor focus:ring-opacity-25" type="button">
            <i class="fa-solid fa-minus"></i>
        </button>
        @endif
        <div>
            <input name="quantity" type="number" class="w-10 text-center px-1 py-1 m-0" value="{{ $quantity }}" readonly>
        </div>
        @if ($quantity >= $stock_product)
        <button wire:click='increment' type="button" class="inline-flex items-center justify-center h-6 w-6 p-3.5 rounded-lg shadow-lg text-sm font-medium text-white bg-mainColor border border-gray-300 focus:ring-2 focus:ring-mainColor focus:ring-opacity-25 opacity-50" disabled>
            <i class="fa-solid fa-plus"></i>
        </button>
        @else
        <button wire:click='increment' type="button" class="inline-flex items-center justify-center h-6 w-6 p-3.5 rounded-lg shadow-lg text-sm font-medium text-white bg-mainColor border border-gray-300 focus:ring-2 focus:ring-mainColor focus:ring-opacity-25">
            <i class="fa-solid fa-plus"></i>
        </button>
        @endif
    </div>
    
</div>
