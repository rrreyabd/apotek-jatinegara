<div>
    <form action="/produk" method="GET" id="search-results"class="relative">
        <label for="product_name"></label>
        <input autocomplete="off" type="text" id="cari" name="cari" value="{{ request()->cari ?? "" }}" placeholder="Paracetamol"
            class="px-3 py-2 w-[400px] rounded-2xl shadow-sm shadow-semiBlack border border-1 border-semiBlack">
        {{-- <input type="hidden" id="product_id" name=""> --}}
            <button class="absolute right-4 top-2">
            <i class="fa-solid fa-magnifying-glass text-2xl text-secondaryColor"></i>
        </button>
    </form>

    <div id="livesearch" class="absolute top-16 overflow-hidden rounded-md bg-white -z-10 w-[25rem]">
        @foreach ($products as $product)
        <a href="/produk?cari={{ $product->product_name }}" class="py-1 border border-black border-opacity-10 px-5 w-full  hover:bg-lightGrey flex gap-2 items-center">
            @if (file_exists(public_path('storage/gambar-obat/' . $product->description->product_photo)) && $product->description->product_photo !== NULL)
                    <img src="{{ asset('storage/gambar-obat/' . $product->description->product_photo) }}" class="w-14" alt="">
                @else
                    <img src="{{ asset('img/obat1.jpg')}}" alt="" class="w-14">
                @endif
            <div class="flex flex-col">
                <p class="font-semibold"> {{ Str::limit($product->product_name, 34, "") }} </p>
                <p class="font-semibold"> Rp {{ number_format($product->product_sell_price) }} </p>
            </div>
        
        </a>
        @endforeach
    </div>
</div>
