<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Apotek | Produk</title>
    @vite('resources/css/app.css')

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
    @include('user.components.secondNavbar')

    <div class="flex flex-col items-center mb-8">
        <div class="w-[70vw] mt-8 flex gap-8">

            {{-- 1 --}}
            <div class="w-[30%] p-4 overflow-hidden">
                
                    <div class="h-full w-full flex gap-10 flex-col">
                        <div class="flex gap-4 flex-col">
                            <div class="flex items-center text-mainColor gap-4 bg-white">
                                <i class="fa-solid fa-sliders border-2 border-mainColor p-1 rounded-md"></i>
                                <p class="text-2xl font-TripBold">Filter</p>
                            </div>

                            <hr class="border-1 border border-[#cccccc]">

                            <div class="bg-lightGrey w-full h-[200px] rounded-md shadow-md shadow-gray-300 px-10 leading-relaxed flex flex-col text-mediumGrey font-bold text-lg justify-center">
                                <a href="" class="hover:text-black change-color-on-click">Popular</a>
                                <a href="" class="hover:text-black change-color-on-click">Nama A - Z</a>
                                <a href="" class="hover:text-black change-color-on-click">Nama Z - A</a>
                                <a href="" class="hover:text-black change-color-on-click">Harga Tinggi - Rendah</a>
                                <a href="" class="hover:text-black change-color-on-click">Harga Rendah - Tinggi</a>
                            </div>
                        </div>

                        {{-- CATEGORY START --}}
                    <div class="flex gap-4 flex-col">
                        <form action="/produk" method="GET">
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
                                        $detail = $category->product_detail;

                                        foreach ($detail as $d) {
                                            $jumlah += $d->product->count();
                                        }
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
                                        $detail = $group->product_detail;

                                        foreach ($detail as $d) {
                                            $jumlah += $d->product->count();
                                        }
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
                                        $detail = $unit->product_detail;

                                        foreach ($detail as $d) {
                                            $jumlah += $d->product->count();
                                        }
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

            {{-- 2 --}}
            <div class="w-[70%] flex flex-col gap-8">
                <div class="flex justify-between items-center">
                    <form action="" class="relative">
                        <input type="text" placeholder="Cari nama produk di sini..."
                        class="h-12 w-96 shadow-md rounded-md px-4">

                        <button type="submit" class="absolute right-3 top-3 text-xl">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </form>

                    <p class="font-semibold text-mediumGrey">Filter: Harga Tinggi - Rendah</p>
                </div>

                <div class="flex flex-wrap gap-4">
                    @for ($i = 0; $i < 3; $i++)    
                    <div class="w-fit py-2 bg-mainColor flex items-center px-3 text-white rounded-md gap-2">
                        <p>Kategori: Obat Demam</p>
                        <button type="button" class="bg-red-500 w-6 h-6 flex items-center justify-center rounded-full font-semibold">&#10005;</button>
                    </div>
                    @endfor
                </div>

                <div class="flex flex-wrap justify-start gap-4">
                    @if ($products != NULL)
                    @foreach ($products as $product)
                    <div class="h-[350px] w-[230px] shadow-md border-2 shadow-semiBlack rounded-lg p-4 flex flex-col bg-white">
                        <a href="">
                            <div class="px-2 w-full">
                                <p class="font-semibold text-lg namaObat flex whitespace-normal break-words">{{ $product->product_name }}</p>
                            </div>
    
                            <center class="relative">
                                @if ($product->detail->product_type == "resep dokter")
                                <span class="bg-red-500 text-white font-semibold px-2 py-1 text-sm rounded-md absolute top-1 left-2">Resep</span>
                                @endif
    
                                <img src="{{ asset('img/obat1.jpg')}}" width="150px" alt="" draggable="false">    
                            </center>
                        </a>
    
                        <div class="flex justify-between items-center">
                            <div class="px-2 flex flex-col justify-center w-[80%] whitespace-normal break-words">
                                <p><span class="font-TripBold text-secondaryColor">Rp. {{ number_format($product->product_sell_price, 0,
                                        ',', '.') }}</span> / </br> {{ $product->detail->unit->unit }}</span></p>
                                <p class="font-semibold">Stok: {{ $product->product_stock }}</p>
                            </div>
                            
                            <div class="w-[20%] h-full">
                                @if ($product->product_stock == 0)
                                @else
                                <button type="submit" class="bg-mainColor h-[40px] w-[40px] rounded-full text-white cursor-pointer flex justify-center items-center">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>

                <!-- PAGINATION START -->
                {{ $products ? $products->links() : "" }}
                <!-- PAGINATION END -->
            </div>
            {{-- FILTER PRODUK START --}}
                
            {{-- FILTER PRODUK END --}}
        </div>
    </div>
    
    @include('user.components.footer')

    <script>
        // const showFilter = () => {
        //     const filter = document.querySelector('#filter'),
        //           icon = document.getElementById('filterIcon');

        //     if (filter.classList.contains('hidden')) {
        //         filter.classList.remove('hidden')
        //         icon.classList.remove('fa-plus')
        //         icon.classList.add('fa-minus')
        //     } else {
        //         filter.classList.add('hidden')
        //         icon.classList.remove('fa-minus')
        //         icon.classList.add('fa-plus')
        //     }
        // }

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
                obatElements[i].textContent = obatText.slice(0, 17) + "...";
            }
        }
    </script>
</body>
</html>