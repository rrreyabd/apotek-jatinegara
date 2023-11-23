<div>
    {{-- PRODUCT START --}}
    <div class="flex flex-wrap justify-start gap-8">
        @foreach ($all_products as $item)

        <div class="bg-white w-52 p-4 flex flex-col rounded-md shadow-md gap-2">
            <div class="h-36 w-full overflow-hidden flex justify-center object-contain rounded-md">
                <img src="https://i.pinimg.com/564x/22/04/72/2204725ec0bd13c61131bc099467b04c.jpg"
                    class="w-full" alt="">
            </div>

            <p class="w-full font-semibold text-base namaObat leading-tight break-words">{{ $item->product_name
                }}</p>
            @if ($item->description->product_type == "resep dokter")
            <p class="bg-red-600 text-white w-fit px-2 py-1 text-sm rounded-md font-semibold">Resep</p>
            @endif

            <div class="flex flex-col">
                <p> <span class="text-secondaryColor font-bold leading-tight break-all">Rp. {{
                        number_format($item->detail()->orderBy('product_expired')->first()->product_sell_price,
                        0,
                        ',', '.') }}</span> / {{ $item->description->unit->unit }} </p>
                <p class="font-semibold leading-tight break-all">Stok : {{
                    $item->detail()->orderBy('product_expired')->first()->product_stock }}</p>
            </div>

            <form action="">
                <button type="button" onclick="grow()"
                    class="text-white font-semibold bg-mainColor w-full py-1 rounded-md">Tambah</button>
            </form>
        </div>
        @endforeach
    </div>
    {{-- PRODUCT END --}}

    <div class="w-full flex justify-center items-center py-8">
        <div class="flex gap-8 items-center">
    
            @if ($all_products->currentPage() > 1)
                <button wire:click="previousPage" class="font-normal hover:font-semibold transition duration-300 ease-in-out">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>
            @else
                <span class="cursor-not-allowed opacity-50">
                    <i class="fa-solid fa-chevron-left"></i>
                </span>
            @endif
    
            @for ($i = 1; $i <= $all_products->lastPage(); $i++)
                <button wire:click="gotoPage({{ $i }})" class="font-normal hover:font-semibold transition duration-300 ease-in-out {{ $all_products->currentPage() == $i ? 'pageActive' : '' }}">
                    {{ $i }}
                </button>
            @endfor
    
            @if ($all_products->hasMorePages())
                <button wire:click="nextPage" class="font-normal hover:font-semibold transition duration-300 ease-in-out">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
            @else
                <span class="cursor-not-allowed opacity-50">
                    <i class="fa-solid fa-chevron-right"></i>
                </span>
            @endif
    
        </div>
    </div>
    
</div>