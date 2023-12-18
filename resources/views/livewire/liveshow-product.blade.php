<div class="flex flex-wrap justify-start gap-4">
    @if ($products != NULL)
    @foreach ($products as $product)
    <div class="h-[350px] w-[230px] shadow-md border-2 shadow-semiBlack rounded-lg p-4 flex flex-col bg-white">
        <a href="/deskripsi/{{ Str::slug($product->product_name) }}">
            <div class="px-2 w-full">
                <p class="font-semibold text-lg namaObat flex whitespace-normal break-words">{{ $product->product_name }}</p>
            </div>

            <center class="relative">
                @if ($product->description->product_type == "resep dokter")
                <span class="bg-red-500 text-white font-semibold px-2 py-1 text-sm rounded-md absolute top-1 left-2">Resep</span>
                @endif
                @if (file_exists(public_path('storage/gambar-obat/' . $product->description->product_photo)) && $product->description->product_photo !== NULL)
                    <img src="{{ asset('storage/gambar-obat/' . $product->description->product_photo) }}" width="150px" alt="" draggable="false">
                @else
                    <img src="{{ asset('img/obat1.jpg')}}" width="150px" alt="" draggable="false">    
                @endif

            </center>
        </a>

        <div class="flex justify-between items-center">
            <div class="px-2 flex flex-col justify-center w-[80%] whitespace-normal break-words">
                <p><span class="font-TripBold text-secondaryColor">Rp. {{ number_format($product->product_sell_price, 0,
                        ',', '.') }}</span> / </br> {{ $product->description->unit->unit }}</span></p>
                <p class="font-semibold">Stok: {{ $product->detail()->orderBy('product_expired')->first()->product_stock }}</p>
            </div>
            
            <div class="w-[20%] h-full">
                @auth
                    @if ($product->product_status == 'aktif')
                    <button wire:click="counts({{ $product }})" type="button" class="bg-mainColor h-[40px] w-[40px] rounded-full text-white cursor-pointer flex justify-center items-center">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                        {{-- <livewire:button-add-cart :user="auth()->user()->user_id" :product="$product->product_id"/> --}}
                    @else
                        <button type="button" class="bg-lightGrey h-[40px] w-[40px] rounded-full text-white cursor-pointer flex justify-center items-center">
                            <i class="fa-solid fa-plus"></i>
                        </button> 
                    @endif
                @endauth
            </div>
        </div>
    </div>
    @endforeach
    @endif
</div>
