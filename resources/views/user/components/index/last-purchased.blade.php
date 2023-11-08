<div class="flex flex-col items-center mb-8">
    <div class="w-[70vw] mt-8 flex flex-col gap-8">
        <p class="font-TripBold text-4xl">Terakhir Dibeli</p>    

        <div class="flex justify-start relative">
            <div class="flex flex-wrap justify-center gap-4">
                @if ($products->first() != NULL)
                {{-- @dd($products_last_purcase->take(1)); --}}
                @foreach ($products as $product)
                    <a @if ($product->first()->product_stock != 0) href="" @endif class="mb-7 h-72 w-[200px] shadow-md border-2 shadow-semiBlack rounded-lg p-4 flex flex-col bg-white">
                        {{-- <div class="flex justify-start mb-2">
                            <span class="bg-red-500 text-white font-semibold px-2 py-1 text-sm rounded-md">Resep</span>
                        </div> --}}
    
                        <div class="px-2">
                            <p class="font-semibold text-lg namaObat">{{ $product->first()->product_name }}</p>
                        </div>
    
                        <center class="relative">
                            @if ($product->first()->detail->product_type == "resep dokter")
                            <span class="bg-red-500 text-white font-semibold px-2 py-1 text-sm rounded-md absolute top-1 left-2">Resep</span>
                            @endif

                            <img src="{{ asset('img/obat1.jpg/') }}" width="150px" alt="" draggable="false">    
                        </center>
                        
                        <div class="flex justify-between items-center">
                            <div class="px-2 flex flex-col justify-center">
                                <p><span class="font-TripBold text-secondaryColor">Rp. {{ number_format($product->first()->product_sell_price, 0,
                                    ',', '.') }}</span> / {{ $product->first()->detail->unit->unit }}</p>
                                <p class="font-semibold">Stok: {{ $product->first()->product_stock }}</p>
                            </div>
                            
                            @if ($product->first()->product_stock == 0)
                            @else
                            <button type="submit" class="bg-mainColor h-[40px] w-[40px] rounded-full text-white text-2xl cursor-pointer">+</button>
                            @endif
                        </div>
    
                        {{-- <div class="px-2">
                            <span class="bg-red-500 text-white font-semibold px-2 py-1 text-sm rounded-md">Resep</span>
                        </div> --}}
                    </a>
                @endforeach
                @else
                <p class="text-2xl">Belum Membeli Produk Apapun!</p>  
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    const obatElements = document.getElementsByClassName("namaObat");

    for (let i = 0; i < obatElements.length; i++) {
    const obatText = obatElements[i].textContent;

    if (obatText.length > 20) {
        obatElements[i].textContent = obatText.slice(0, 18) + "...";
    }
    }
</script>