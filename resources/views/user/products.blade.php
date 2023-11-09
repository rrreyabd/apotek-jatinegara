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
                    <form action="">
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
                            <div class="flex items-center text-mediumGrey justify-between bg-white">
                                <p class="text-xl font-TripBold ml-10">Kategori</p>
                                <button type="button" onclick="showFilter('filter1', 'filterIcon1')" class="h-full flex items-center text-darkGrey text-xl pr-2">
                                    <i class="fa-solid fa-plus" id="filterIcon1"></i>
                                </button>
                            </div>

                            <hr class="border-1 border border-[#cccccc]">

                            <div class="bg-lightGrey w-full min-h-[200px] h-fit rounded-md shadow-md shadow-gray-300 px-10 flex flex-col text-mediumGrey font-bold text-xl gap-4 py-4 hidden" id="filter1">
                                <div class="flex items-center text-mainColor text-lg gap-2">
                                    <input id="kategori1" type="radio" value="" name="kategori" class="w-4 h-4 text-mainColor bg-gray-100">
                                    <label for="kategori1">Semua (200)</label>
                                </div>
                                <div class="flex items-center text-mainColor text-lg gap-2">
                                    <input id="kategori2" type="radio" value="" name="kategori" class="w-4 h-4 text-mainColor bg-gray-100">
                                    <label for="kategori2">Obat Demam (20)</label>
                                </div>
                                <div class="flex items-center text-mainColor text-lg gap-2">
                                    <input id="kategori3" type="radio" value="" name="kategori" class="w-4 h-4 text-mainColor bg-gray-100">
                                    <label for="kategori3">Obat Asam Urat (40)</label>
                                </div>
                                <div class="flex items-center text-mainColor text-lg gap-2">
                                    <input id="kategori4" type="radio" value="" name="kategori" class="w-4 h-4 text-mainColor bg-gray-100">
                                    <label for="kategori4">Obat Hipertensi (24)</label>
                                </div>
                                <div class="flex items-center text-mainColor text-lg gap-2">
                                    <input id="kategori4" type="radio" value="" name="kategori" class="w-4 h-4 text-mainColor bg-gray-100">
                                    <label for="kategori4">Obat Hipertensi (24)</label>
                                </div>
                                <div class="flex items-center text-mainColor text-lg gap-2">
                                    <input id="kategori4" type="radio" value="" name="kategori" class="w-4 h-4 text-mainColor bg-gray-100">
                                    <label for="kategori4">Obat Hipertensi (24)</label>
                                </div>
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
                                    <label for="golongan1">Golongan</label>
                                </div>
                                <div class="flex items-center text-mainColor text-lg gap-2">
                                    <input id="golongan2" type="radio" value="" name="golongan" class="w-4 h-4 text-mainColor bg-gray-100">
                                    <label for="golongan2">Golongan</label>
                                </div>
                                <div class="flex items-center text-mainColor text-lg gap-2">
                                    <input id="golongan3" type="radio" value="" name="golongan" class="w-4 h-4 text-mainColor bg-gray-100">
                                    <label for="golongan3">Golongan</label>
                                </div>
                                <div class="flex items-center text-mainColor text-lg gap-2">
                                    <input id="golongan4" type="radio" value="" name="golongan" class="w-4 h-4 text-mainColor bg-gray-100">
                                    <label for="golongan4">Golongan</label>
                                </div>
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
                                    <input id="bentuk1" type="radio" value="" name="golongan" class="w-4 h-4 text-mainColor bg-gray-100">
                                    <label for="bentuk1">Bentuk Obat</label>
                                </div>
                                <div class="flex items-center text-mainColor text-lg gap-2">
                                    <input id="bentuk2" type="radio" value="" name="golongan" class="w-4 h-4 text-mainColor bg-gray-100">
                                    <label for="bentuk2">Bentuk Obat</label>
                                </div>
                                <div class="flex items-center text-mainColor text-lg gap-2">
                                    <input id="bentuk3" type="radio" value="" name="golongan" class="w-4 h-4 text-mainColor bg-gray-100">
                                    <label for="bentuk3">Bentuk Obat</label>
                                </div>
                                <div class="flex items-center text-mainColor text-lg gap-2">
                                    <input id="bentuk4" type="radio" value="" name="golongan" class="w-4 h-4 text-mainColor bg-gray-100">
                                    <label for="bentuk4">Bentuk Obat</label>
                                </div>
                                <div class="flex items-center text-mainColor text-lg gap-2">
                                    <input id="bentuk5" type="radio" value="" name="golongan" class="w-4 h-4 text-mainColor bg-gray-100">
                                    <label for="bentuk5">Bentuk Obat</label>
                                </div>
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
                                <input type="number" name="" id="" placeholder="Harga Minimum"
                                class="border-lightGrey border-2 border-l-0 rounded-r-md h-12 px-4 py-2 w-full text-lg">
                            </div>
                            {{-- HARGA MINIMUM END --}}
                            
                            {{-- HARGA MAKSIMUM START --}}
                            <div class="flex w-full">
                                <div class="bg-lightGrey h-12 w-20 border-lightGrey border-2 border-r-0 rounded-l-md text-darkGrey flex justify-center items-center text-xl font-bold">Rp</div>
                                <input type="number" name="" id="" placeholder="Harga Maksimum"
                                class="border-lightGrey border-2 border-l-0 rounded-r-md h-12 px-4 py-2 w-full text-lg">
                            </div>
                            {{-- HARGA MAKSIMUM END --}}
                            
                        </div>
                        {{-- HARGA END --}}

                        <button type="submit" class="bg-secondaryColor font-semibold text-lg w-full h-12 text-white shadow-md rounded-lg shadow-semiBlack">Cari</button>

                    </div>
                </form>
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
                    @for ($i = 0; $i < 10; $i++)
                    <div class="h-fit w-[230px] shadow-md border-2 shadow-semiBlack rounded-lg p-4 flex flex-col bg-white">
                        <a href="">
                            <div class="px-2">
                                <p class="font-semibold text-lg namaObat">Acyclovir 200 mgssssssssssssssssssssss</p>
                            </div>
    
                            <center class="relative">
                                <span class="bg-red-500 text-white font-semibold px-2 py-1 text-sm rounded-md absolute top-1 left-2">Resep</span>
                                <img src="{{ asset('img/obat1.jpg/') }}" width="150px" alt="" draggable="false">    
                            </center>
                        </a>
    
                        <div class="flex justify-between items-center">
                            <div class="px-2 flex flex-col justify-center w-[80%] whitespace-normal break-words">
                                <p><span class="font-TripBold text-secondaryColor">Rp. 250.000.000.000.000.000</span> / kotak</p>
                                <p class="font-semibold">Stok: 90000000000000000000</p>
                            </div>
                            
                            <div class="w-[20%] h-full">
                                <button type="button" class="bg-mainColor h-[40px] w-full rounded-full text-white text-2xl cursor-pointer">+</button>
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>

                <!-- PAGINATION START -->
                <div class="w-full flex justify-end items-center h-[20vh]">
                    <div class="flex gap-8 items-center">
                        <a href="" class="font-normal hover:font-semibold transition duration-300 ease-in-out">
                            <i class="fa-solid fa-chevron-left"></i>
                        </a>
                        <a href="" class="font-normal hover:font-semibold transition duration-300 ease-in-out">1</a>
                        <!-- tambahkan class pageActive untuk page yang sedang dibuka -->
                        <a href="" class="font-normal hover:font-semibold transition duration-300 ease-in-out pageActive">2</a>
                        <a href="" class="font-normal hover:font-semibold transition duration-300 ease-in-out ">3</a>
                        <p class="unselectable">...</p>
                        <a href="" class="font-normal hover:font-semibold transition duration-300 ease-in-out">7</a>
                        <a href="" class="font-normal hover:font-semibold transition duration-300 ease-in-out">
                            <i class="fa-solid fa-chevron-right"></i>
                        </a>
                    </div>
                </div>
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

            if (obatText.length > 18) {
                obatElements[i].textContent = obatText.slice(0, 17) + "...";
            }
        }
    </script>
</body>
</html>