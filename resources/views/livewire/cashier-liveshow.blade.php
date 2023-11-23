<div class="flex flex-col gap-8 w-[67%] p-10">
    <div class="flex gap-8">
        <button onclick="toggleSidebar()" class="bg-white h-10 w-10 rounded-md shadow-md p-1">
            <i class="fa-solid fa-bars text-mediumGrey"></i>
        </button>
        <input type="text" wire:model="search" wire:keyup="search_product"
            class="h-10 w-96 rounded-md shadow-md pl-4 pr-14 placeholder:text-sm" placeholder="Cari produk disini...">
    </div>

    {{-- FILTER SECTION START --}}
    <div class="flex gap-8">
        {{-- CATEGORY START --}}
        <div class="relative inline-block text-left">
            <button id="dropdown-button0"
                class="inline-flex justify-center gap-2 items-center w-full px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-2  focus:ring-mainColor">
                Kategori Obat
                <i class="fa-solid fa-chevron-down"></i>
            </button>
            <div id="dropdown-menu0"
                class="origin-top-right absolute left-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden">
                <div class="py-2 p-2" role="menu" aria-orientation="vertical" aria-labelledby="dropdown-button">

                    @foreach ($categories as $category)
                        <input type="hidden" name="" id="" value="">
                        <button wire:click="applyFilter('category', '{{ $category->category_id }}')"
                            class="flex rounded-md px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer"
                            role="menuitem">
                            {{ $category -> category }}
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
        {{-- CATEGORY END --}}

        {{-- UNIT START --}}
        <div class="relative inline-block text-left">
            <button id="dropdown-button1"
                class="inline-flex justify-center gap-2 items-center w-full px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-2  focus:ring-mainColor">
                Bentuk Obat
                <i class="fa-solid fa-chevron-down"></i>
            </button>
            <div id="dropdown-menu1"
                class="origin-top-right absolute left-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden">
                <div class="py-2 p-2" role="menu" aria-orientation="vertical" aria-labelledby="dropdown-button">

                    @foreach ($units as $unit)
                        <button wire:click="applyFilter('unit', '{{ $unit->unit_id }}')"
                            class="flex rounded-md px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer"
                            role="menuitem">
                            {{ $unit->unit }}
                        </button>
                    @endforeach

                </div>
            </div>
        </div>
        {{-- UNIT END --}}

        {{-- GROUP START --}}
        <div class="relative inline-block text-left">
            <button id="dropdown-button2"
                class="inline-flex justify-center gap-2 items-center w-full px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-2  focus:ring-mainColor">
                Golongan
                <i class="fa-solid fa-chevron-down"></i>
            </button>
            <div id="dropdown-menu2"
                class="origin-top-right absolute left-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden">
                <div class="py-2 p-2" role="menu" aria-orientation="vertical" aria-labelledby="dropdown-button">

                    @foreach ($groups as $group)
                        <button wire:click="applyFilter('group', '{{ $group->group_id }}')"
                            class="flex rounded-md px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer"
                            role="menuitem">
                            {{ $group->group }}
                        </button>
                    @endforeach

                </div>
            </div>
        </div>
        {{-- GROUP END --}}

    </div>
    {{-- FILTER SECTION END --}}

    {{-- PRODUCT START --}}
    <div class="flex flex-wrap justify-start gap-8">
        @foreach ($products as $item)

        <div class="bg-white w-52 p-4 flex flex-col rounded-md shadow-md gap-2">
            <div class="h-36 w-full overflow-hidden flex justify-center object-contain rounded-md">
                <img src="https://i.pinimg.com/564x/22/04/72/2204725ec0bd13c61131bc099467b04c.jpg" class="w-full"
                    alt="">
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
                        ',', '.') }}</span> / </p>
                <p> {{ $item->description->unit->unit }}</p>
                <p class="font-semibold leading-tight break-all">Stok : {{
                    $item->detail()->orderBy('product_expired')->first()->product_stock }}</p>
            </div>
            @auth
            @if ($item->product_status == 'aktif' && $item->detail()->orderBy('product_expired')->first()->product_stock
            > 0)
                    <button wire:click="AddedToCart({{ $item }})" type="button"
                        class="text-white font-semibold bg-mainColor w-full py-1 rounded-md">Tambah</button>
                {{-- <livewire:buttonAddCartCashier :user="auth()->user()->user_id" :product="$item->product_id" /> --}}
            @else
            <button type="button" disabled
                class="text-mediumGrey font-semibold bg-lightGrey w-full py-1 rounded-md">Tambah</button>
            @endif
            @endauth
            <form action="">
            </form>
        </div>
        @endforeach
    </div>
    {{-- PRODUCT END --}}

    {{-- PAGINATION START --}}
    <div class="w-full flex justify-center items-center py-8">
        <div class="flex gap-8 items-center">
            
            @if ($products->currentPage() > 1)
                <button wire:click="previousPage" class="font-normal hover:font-semibold transition duration-300 ease-in-out">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>
            @else
                <span class="cursor-not-allowed opacity-50">
                    <i class="fa-solid fa-chevron-left"></i>
                </span>
            @endif
    
            @for ($i = 1; $i <= $products->lastPage(); $i++)
                <button wire:click="gotoPage({{ $i }})" class="font-normal hover:font-semibold transition duration-300 ease-in-out {{ $products->currentPage() == $i ? 'pageActive' : '' }}">
                    {{ $i }}
                </button>
            @endfor
    
            @if ($products->hasMorePages())
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
    {{-- PAGINATION END --}}
</div>