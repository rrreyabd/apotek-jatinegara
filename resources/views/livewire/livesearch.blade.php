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

    <div id="livesearch" class="absolute top-14 text-xl w-[25rem] shadow-lg">
        @foreach ($products as $product)
        <a href="/produk?cari={{ $product }}" class="block py-1 border border-black bg-white px-5 w-full rounded-lg hover:bg-mainColor">{{ Str::limit($product, 34, "...") }}</a>
        @endforeach
    </div>
</div>
