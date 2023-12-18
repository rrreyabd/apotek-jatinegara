<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Apotek | Produk</title>
    @vite('resources/css/app.css')
    @livewireStyles

    {{-- FONT AWESOME --}}
    <script src="https://kit.fontawesome.com/e87c4faa10.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1fc4ea1c6a.js" crossorigin="anonymous"></script>

    <style>
        input[type="radio"] {
            accent-color: #1A8889;
        }
    </style>

</head>
<body class="font-Inter relative">
    @include('user.components.navbar')

    <div class="flex flex-col items-center mb-8">
        <div class="w-[70vw] mt-8 flex gap-8">

            {{-- bagian kiri --}}
            <div class="w-[30%] p-4 overflow-hidden">
                
                    <div class="h-full w-full flex gap-10 flex-col">
                        <div class="flex gap-4 flex-col">
                            <div class="flex items-center text-mainColor gap-4 bg-white">
                                <i class="fa-solid fa-sliders border-2 border-mainColor p-1 rounded-md"></i>
                                <p class="text-2xl font-TripBold">Filter</p>
                            </div>

                            <hr class="border-1 border border-[#cccccc]">
                            <div class="bg-lightGrey w-full h-fit rounded-md shadow-md shadow-gray-300 py-4 px-10 leading-relaxed flex flex-col text-mediumGrey font-bold text-lg justify-center">
                                @php
                                    $filters = ['Popular', 'Nama A - Z', 'Nama Z - A', 'Harga Rendah - Tinggi', 'Harga Tinggi - Rendah', 'Hapus Filter']
                                @endphp
                                @foreach ($filters as $filter)
                                <form action="/produk" method="GET">
                                    <input type="hidden" name="filter" value="{{ $filter == "Hapus Filter" ? "" : $filter }}">
                                    @if (request()->cari)
                                        <input type="hidden" name="cari" value="{{ request()->cari }}">
                                    @endif
                                    @if (request()->kategori)
                                        <input type="hidden" name="kategori" value="{{ request()->kategori }}">
                                    @endif
                                    @if (request()->golongan)
                                        <input type="hidden" name="golongan" value="{{ request()->golongan }}">
                                    @endif
                                    @if (request()->bentuk)
                                        <input type="hidden" name="bentuk" value="{{ request()->bentuk }}">
                                    @endif
                                    @if (request()->minimum)
                                        <input type="hidden" name="minimum" value="{{ request()->minimum }}">
                                    @endif
                                    @if (request()->maksimum)
                                        <input type="hidden" name="maksimum" value="{{ request()->maksimum }}">
                                    @endif
                                    <button type="submit" class="hover:text-black change-color-on-click">{{ $filter }}</button>
                                </form>
                                @endforeach
                            </div>
                        </div>

                        {{-- CATEGORY START --}}
                    <div class="flex gap-4 flex-col">
                        <form action="/produk" method="GET">
                            @if (request()->cari)
                                <input type="hidden" name="cari" value="{{ request()->cari }}">
                            @endif
                            <div class="flex items-center mb-3 text-mediumGrey justify-between bg-white">
                                <p class="text-xl font-TripBold ml-10">Kategori</p>
                                <button type="button" onclick="showFilter('filter1', 'filterIcon1')" class="h-full flex items-center text-darkGrey text-xl pr-2">
                                    <i class="fa-solid fa-plus" id="filterIcon1"></i>
                                </button>
                            </div>

                            <hr class="border-1 mb-3 border border-[#cccccc]">

                            <div class="bg-lightGrey w-full min-h-[200px] h-fit rounded-md shadow-md shadow-gray-300 px-10 flex flex-col text-mediumGrey font-bold text-xl gap-4 py-4 hidden" id="filter1">
                                <div class="flex items-center text-mainColor text-lg gap-2">
                                    <input id="kategori1" type="radio" value="" name="kategori" class="w-4 h-4 text-mainColor bg-gray-100">
                                    <label for="kategori1">Semua ({{ $all_products != NULL ? $all_products->count() : "0" }})</label>
                                </div>
                                @php
                                    $i = 2;
                                @endphp
                                @foreach ($categories as $category)
                                    @php
                                        $jumlah = 0;
                                        $jumlah = $category->product_description->count();
                                    @endphp
                                <div class="flex items-center text-mainColor text-lg gap-2">
                                    <input id="kategori{{ $i }}" type="radio" value="{{ $category->category }}" name="kategori" class="w-4 h-4 text-mainColor bg-gray-100" @if (request()->kategori == $category->category)
                                        checked
                                    @endif>
                                    <label for="kategori{{ $i }}">{{ $category->category }} ({{ $jumlah }})</label>
                                </div>
                                @php
                                    $i++;
                                @endphp
                                @endforeach
                            </div>
                        </div>
                        {{-- CATEGORY END --}}

                        {{-- GOLONGAN START --}}
                        <div class="flex gap-4 flex-col">
                            <div class="flex items-center text-mediumGrey justify-between bg-white">
                                <p class="text-xl font-TripBold ml-10">Golongan</p>
                                <button type="button" onclick="showFilter('filter2', 'filterIcon2')" class="h-full flex items-center text-darkGrey text-xl pr-2">
                                    <i class="fa-solid fa-plus" id="filterIcon2"></i>
                                </button>
                            </div>

                            <hr class="border-1 border border-[#cccccc]">

                            <div class="bg-lightGrey w-full min-h-[200px] h-fit rounded-md shadow-md shadow-gray-300 px-10 flex flex-col text-mediumGrey font-bold text-xl gap-4 py-4 hidden" id="filter2">
                                <div class="flex items-center text-mainColor text-lg gap-2">
                                    <input id="golongan1" type="radio" value="" name="golongan" class="w-4 h-4 text-mainColor bg-gray-100">
                                    <label for="golongan1">Semua ({{ $all_products->count() }})</label>
                                </div>
                                @php
                                    $i = 2;
                                @endphp
                                @foreach ($groups as $group)
                                    @php
                                        $jumlah = 0;
                                        $jumlah = $group->product_description->count();
                                    @endphp
                                <div class="flex items-center text-mainColor text-lg gap-2">
                                    <input id="golongan{{ $i }}" type="radio" value="{{ $group->group }}" name="golongan" class="w-4 h-4 text-mainColor bg-gray-100" @if (request()->golongan == $group->group)
                                        checked
                                    @endif>
                                    <label for="golongan{{ $i }}">{{ $group->group }} ({{ $jumlah }})</label>
                                </div>
                                @php
                                    $i++;
                                @endphp
                                @endforeach
                            </div>
                        </div>
                        {{-- GOLONGAN END --}}

                        {{-- BENTUK OBAT START --}}
                        <div class="flex gap-4 flex-col">
                            <div class="flex items-center text-mediumGrey justify-between bg-white">
                                <p class="text-xl font-TripBold ml-10">Bentuk Obat</p>
                                <button type="button" onclick="showFilter('filter3', 'filterIcon3')" class="h-full flex items-center text-darkGrey text-xl pr-3">
                                    <i class="fa-solid fa-plus" id="filterIcon3"></i>
                                </button>
                            </div>

                            <hr class="border-1 border border-[#cccccc]">

                            <div class="bg-lightGrey w-full min-h-[200px] h-fit rounded-md shadow-md shadow-gray-300 px-10 flex flex-col text-mediumGrey font-bold text-xl gap-4 py-4 hidden" id="filter3">
                                <div class="flex items-center text-mainColor text-lg gap-2">
                                    <input id="bentuk1" type="radio" value="" name="bentuk" class="w-4 h-4 text-mainColor bg-gray-100">
                                    <label for="bentuk1">Semua ({{ $all_products->count() }})</label>
                                </div>
                                @php
                                    $i = 2;
                                @endphp
                                @foreach ($units as $unit)
                                    @php
                                        $jumlah = 0;
                                        $jumlah = $unit->product_description->count();
                                    @endphp
                                <div class="flex items-center text-mainColor text-lg gap-2">
                                    <input id="bentuk{{ $i }}" type="radio" value="{{ $unit->unit }}" name="bentuk" class="w-4 h-4 text-mainColor bg-gray-100" @if (request()->bentuk == $unit->unit)
                                    checked
                                    @endif>
                                    <label for="bentuk{{ $i }}">{{ $unit->unit }} ({{ $jumlah }})</label>
                                </div>
                                @php
                                    $i++;
                                @endphp
                                @endforeach
                            </div>
                        </div>
                        {{-- BENTUK OBAT END --}}
                        
                        {{-- HARGA START --}}
                        <div class="flex gap-4 flex-col">
                            <div class="flex items-center text-mediumGrey justify-between bg-white">
                                <p class="text-xl font-TripBold ml-10">Harga</p>
                            </div>

                            <hr class="border-1 border border-[#cccccc]">

                            {{-- HARGA MINIMUM START --}}
                            <div class="flex w-full">
                                <div class="bg-lightGrey h-12 w-20 border-lightGrey border-2 border-r-0 rounded-l-md text-darkGrey flex justify-center items-center text-xl font-bold">Rp</div>
                                <input type="number" name="minimum" id="" placeholder="Harga Minimum" value="{{ request()->minimum }}"
                                class="border-lightGrey border-2 border-l-0 rounded-r-md h-12 px-4 py-2 w-full text-lg">
                            </div>
                            {{-- HARGA MINIMUM END --}}
                            
                            {{-- HARGA MAKSIMUM START --}}
                            <div class="flex w-full">
                                <div class="bg-lightGrey h-12 w-20 border-lightGrey border-2 border-r-0 rounded-l-md text-darkGrey flex justify-center items-center text-xl font-bold">Rp</div>
                                <input type="number" name="maksimum" id="" placeholder="Harga Maksimum" value="{{ request()->maksimum }}"
                                class="border-lightGrey border-2 border-l-0 rounded-r-md h-12 px-4 py-2 w-full text-lg">
                            </div>
                            {{-- HARGA MAKSIMUM END --}}
                            
                        </div>
                        {{-- HARGA END --}}

                        <button type="submit" class="bg-secondaryColor font-semibold text-lg w-full h-12 text-white shadow-md rounded-lg shadow-semiBlack">Cari</button>

                    </form>
                </div>
            </div>

            {{-- bagian kanan --}}
            <div class="w-[70%] flex flex-col gap-8">
                <div class="flex justify-between items-center">
                    <form action="/produk" method="GET" class="relative">
                        @if (request()->filter)
                            <input type="hidden" name="filter" value="{{ request()->filter }}">
                        @endif
                        @if (request()->kategori)
                            <input type="hidden" name="kategori" value="{{ request()->kategori }}">
                        @endif
                        @if(request()->golongan)
                            <input type="hidden" name="golongan" value="{{ request()->golongan }}">
                        @endif
                        @if (request()->bentuk)
                            <input type="hidden" name="bentuk" value="{{ request()->bentuk }}">
                        @endif
                        @if (request()->minimum)
                            <input type="hidden" name="minimum" value="{{ request()->minimum }}">
                        @endif
                        @if (request()->maksimum)
                            <input type="hidden" name="maksimum" value="{{ request()->maksimum }}">
                        @endif
                        <input autocomplete="off" type="text" id="cari" name="cari" value="{{ request()->cari }}" placeholder="Cari nama produk di sini..."
                        class="h-12 w-96 shadow-md rounded-md px-4">

                        <button type="submit" class="absolute right-3 top-3 text-xl">
                            <i class="fa-solid fa-magnifying-glass text-mainColor"></i>
                        </button>
                    </form>

                    @if (request()->filter)
                    <p class="font-semibold text-mediumGrey">Filter: {{ request()->filter }}</p>
                    @endif
                </div>

                <div class="flex flex-wrap gap-4">
                    @if (request()->kategori)
                    <form action="/produk" method="GET">
                        @if (request()->filter)
                            <input type="hidden" name="filter" value="{{ request()->filter }}">
                        @endif
                        @if (request()->cari)
                            <input type="hidden" name="cari" value="{{ request()->cari }}">
                        @endif
                        @if (request()->golongan)
                            <input type="hidden" name="golongan" value="{{ request()->golongan }}">
                        @endif
                        @if (request()->bentuk)
                            <input type="hidden" name="bentuk" value="{{ request()->bentuk }}">
                        @endif
                        @if (request()->minimum)
                            <input type="hidden" name="minimum" value="{{ request()->minimum }}">
                        @endif
                        @if (request()->maksimum)
                            <input type="hidden" name="maksimum" value="{{ request()->maksimum }}">
                        @endif
                        <input type="hidden" name="kategori" value="">
                        <div class="w-fit py-2 bg-mainColor flex items-center px-3 text-white rounded-md gap-2">
                            <p>Kategori: {{ request()->kategori }}</p>
                            <button type="submit" class="bg-red-500 w-6 h-6 flex items-center justify-center rounded-full font-semibold">&#10005;</button>
                        </div>
                    </form>
                    @endif
                    @if (request()->golongan)
                    <form action="/produk" method="GET">
                        @if (request()->filter)
                            <input type="hidden" name="filter" value="{{ request()->filter }}">
                        @endif
                        @if (request()->cari)
                            <input type="hidden" name="cari" value="{{ request()->cari }}">
                        @endif
                        @if (request()->kategori)
                            <input type="hidden" name="kategori" value="{{ request()->kategori }}">
                        @endif
                        @if (request()->bentuk)
                            <input type="hidden" name="bentuk" value="{{ request()->bentuk }}">
                        @endif
                        @if (request()->minimum)
                            <input type="hidden" name="minimum" value="{{ request()->minimum }}">
                        @endif
                        @if (request()->maksimum)
                            <input type="hidden" name="maksimum" value="{{ request()->maksimum }}">
                        @endif
                        <input type="hidden" name="golongan" value="">
                        <div class="w-fit py-2 bg-mainColor flex items-center px-3 text-white rounded-md gap-2">
                            <p>Golongan: {{ request()->golongan }}</p>
                            <button type="submit" class="bg-red-500 w-6 h-6 flex items-center justify-center rounded-full font-semibold">&#10005;</button>
                        </div>
                    </form>
                    @endif
                    @if (request()->bentuk)
                    <form action="/produk" method="GET">
                        @if (request()->filter)
                            <input type="hidden" name="filter" value="{{ request()->filter }}">
                        @endif
                        @if (request()->cari)
                            <input type="hidden" name="cari" value="{{ request()->cari }}">
                        @endif
                        @if (request()->kategori)
                            <input type="hidden" name="kategori" value="{{ request()->kategori }}">
                        @endif
                        @if (request()->golongan)
                            <input type="hidden" name="golongan" value="{{ request()->golongan }}">
                        @endif
                        @if (request()->minimum)
                            <input type="hidden" name="minimum" value="{{ request()->minimum }}">
                        @endif
                        @if (request()->maksimum)
                            <input type="hidden" name="maksimum" value="{{ request()->maksimum }}">
                        @endif
                        <input type="hidden" name="bentuk" value="">
                        <div class="w-fit py-2 bg-mainColor flex items-center px-3 text-white rounded-md gap-2">
                            <p>Bentuk: {{ request()->bentuk }}</p>
                            <button type="submit" class="bg-red-500 w-6 h-6 flex items-center justify-center rounded-full font-semibold">&#10005;</button>
                        </div>
                    </form>
                    @endif
                    @if (request()->minimum)
                    <form action="/produk" method="GET">
                        @if (request()->filter)
                            <input type="hidden" name="filter" value="{{ request()->filter }}">
                        @endif
                        @if (request()->cari)
                            <input type="hidden" name="cari" value="{{ request()->cari }}">
                        @endif
                        @if (request()->kategori)
                            <input type="hidden" name="kategori" value="{{ request()->kategori }}">
                        @endif
                        @if (request()->golongan)
                            <input type="hidden" name="golongan" value="{{ request()->golongan }}">
                        @endif
                        @if (request()->bentuk)
                            <input type="hidden" name="bentuk" value="{{ request()->bentuk }}">
                        @endif
                        @if (request()->maksimum)
                            <input type="hidden" name="maksimum" value="{{ request()->maksimum }}">
                        @endif
                        <input type="hidden" name="minimum" value="">
                        <div class="w-fit py-2 bg-mainColor flex items-center px-3 text-white rounded-md gap-2">
                            <p>Minimum: {{ number_format(request()->minimum,0, ',', '.') }}</p>
                            <button type="submit" class="bg-red-500 w-6 h-6 flex items-center justify-center rounded-full font-semibold">&#10005;</button>
                        </div>
                    </form>
                    @endif
                    @if (request()->maksimum)
                    <form action="/produk" method="GET">
                        @if (request()->filter)
                            <input type="hidden" name="filter" value="{{ request()->filter }}">
                        @endif
                        @if (request()->cari)
                            <input type="hidden" name="cari" value="{{ request()->cari }}">
                        @endif
                        @if (request()->kategori)
                            <input type="hidden" name="kategori" value="{{ request()->kategori }}">
                        @endif
                        @if (request()->golongan)
                            <input type="hidden" name="golongan" value="{{ request()->golongan }}">
                        @endif
                        @if (request()->bentuk)
                            <input type="hidden" name="bentuk" value="{{ request()->bentuk }}">
                        @endif
                        @if (request()->minimum)
                            <input type="hidden" name="minimum" value="{{ request()->minimum }}">
                        @endif
                        <input type="hidden" name="maksimum" value="">
                        <div class="w-fit py-2 bg-mainColor flex items-center px-3 text-white rounded-md gap-2">
                            <p>Maksimum: {{ number_format(request()->maksimum,0 ,',', '.') }}</p>
                            <button type="submit" class="bg-red-500 w-6 h-6 flex items-center justify-center rounded-full font-semibold">&#10005;</button>
                        </div>
                    </form>
                    @endif
                </div>

                <div id="liveshow" class="hidden flex flex-wrap justify-start gap-4">
                    <livewire:liveshow-product :filter="request()->filter" :kategori="request()->kategori" :golongan="request()->golongan" :bentuk="request()->bentuk" :minimum="request()->minimum" :maksimum="request()->maksimum"/>
                </div>

                <div id="product-list" class="flex flex-wrap justify-start gap-4">
                    @if ($products != NULL)
                    @foreach ($products as $product)
                    <div class="h-fit w-[230px] shadow-md border-2 shadow-semiBlack rounded-lg p-4 flex flex-col bg-white">
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
                                        <livewire:button-add-cart :user="auth()->user()->user_id" :product="$product->product_id"/>
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

                <div id="pagination">
                    <!-- PAGINATION START -->
                    {{ $products ? $products->links() : "" }}
                    <!-- PAGINATION END -->
                </div>
            </div>
        </div>
    </div>
    
    @include('user.components.footer')

    <script>
        const showFilter = (filterId, iconId) => {
            const filter = document.getElementById(filterId);
            const icon = document.getElementById(iconId);

            if (filter.classList.contains('hidden')) {
                filter.classList.remove('hidden');
                icon.classList.remove('fa-plus');
                icon.classList.add('fa-minus');
            } else {
                filter.classList.add('hidden');
                icon.classList.remove('fa-minus');
                icon.classList.add('fa-plus');
            }
        }

        const obatElements = document.getElementsByClassName("namaObat");

        for (let i = 0; i < obatElements.length; i++) {
            const obatText = obatElements[i].textContent;

            if (obatText.length > 20) {
                obatElements[i].textContent = obatText.slice(0, 16) + "..";
            }
        }
    </script>

    <script>
        var input = document.querySelector('#cari');
        var liveshow = document.querySelector('#liveshow');
        var productList = document.querySelector('#product-list');
        var pagination = document.querySelector('#pagination');
        var cari;
        
        document.addEventListener('livewire:init', ()=>{
                input.addEventListener('keyup',  function(){
                    if(input.value == ""){
                        productList.classList.remove('hidden');
                        pagination.classList.remove('hidden');
                        liveshow.classList.add('hidden');
                    }else{
                        productList.classList.add('hidden');
                        pagination.classList.add('hidden');
                        liveshow.classList.remove('hidden');
                        cari = input.value;
                        Livewire.dispatch('liveshow', {cari: cari})
                    }
                })
        })
    </script>
    @livewireScripts
</body>
</html>