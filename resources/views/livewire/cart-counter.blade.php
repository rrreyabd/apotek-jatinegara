<div>
    @if ($quantity > 1)
    <button wire:click="decrementButton">
        <i class="text-mainColor fa-solid fa-minus"></i>
    </button>
    @else
    <button wire:click="decrementButton" disabled>
        <i class="text-mediumGrey fa-solid fa-minus"></i>
    </button>
    @endif

    <input type="number" min="1" class="font-semibold w-8 text-center" value="{{ $quantity }}" readonly>
    @if ($quantity == $stock_product)
    <button wire:click="incrementButton" disabled>
        <i class="text-mediumGrey fa-solid fa-plus"></i>
    </button>
    @else
    <button wire:click="incrementButton">
        <i class="text-mainColor fa-solid fa-plus"></i>
    </button>
    @endif
</div>