<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kasir | Home</title>
    @vite('resources/css/app.css')

    {{-- FONT AWESOME --}}
    <script src="https://kit.fontawesome.com/e87c4faa10.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1fc4ea1c6a.js" crossorigin="anonymous"></script>
</head>
<body class="font-Inter relative">
    
    @include('kasir.components.sidebar')
    
    <main class="flex flex-grow bg-plat" id="mainContent">
        <div class="flex flex-col gap-8 w-[67%] p-10">
            <div class="flex gap-8">
                <button onclick="toggleSidebar()" class="bg-white h-10 w-10 rounded-md shadow-md p-1">
                    <i class="fa-solid fa-bars text-mediumGrey"></i>
                </button>

                <form action="" class="relative">
                    <input type="text" name="" id="" class="h-10 w-96 rounded-md shadow-md pl-4 pr-14 placeholder:text-sm" placeholder="Cari produk disini...">
                    <button type="submit" class="absolute right-1 top-1 bg-mainColor font-semibold text-white px-2 py-1 rounded-md">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
            </div>

            {{-- FILTER START --}}
            <div class="flex gap-8">    
                @for ($i = 0; $i < 4; $i++)
                <div class="relative inline-block text-left">
                    <button id="dropdown-button{{$i}}" class="inline-flex justify-center gap-2 items-center w-full px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-2  focus:ring-mainColor">
                        Filter
                        <i class="fa-solid fa-chevron-down"></i>
                    </button>
                    <div id="dropdown-menu{{$i}}" class="origin-top-right absolute left-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                        <div class="py-2 p-2" role="menu" aria-orientation="vertical" aria-labelledby="dropdown-button">

                            @for ($j = 1; $j < 5; $j++)
                            <form action="" method="GET">
                                <input type="hidden" name="" id="" value="">
                                <button class="flex rounded-md px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer" role="menuitem">
                                    Option {{$j}}
                                </button>
                            </form>
                            @endfor

                        </div>
                    </div>
                </div>
                @endfor
            </div>
            {{-- FILTER END --}}

            {{-- PRODUCT START --}}
            <div class="flex flex-wrap justify-start gap-8">
                @for ($i = 0; $i < 8; $i++)
                <div class="bg-white w-52 p-4 flex flex-col rounded-md shadow-md gap-2">
                    <div class="h-36 w-full overflow-hidden flex justify-center object-contain rounded-md">
                        <img src="https://i.pinimg.com/564x/22/04/72/2204725ec0bd13c61131bc099467b04c.jpg" class="w-full" alt="">
                    </div>
                    
                    <p class="w-full font-semibold text-base namaObat leading-tight break-words">Paracetamol 500 kg Paracetamol 500 kg Paracetamol 500 kg Paracetamol 500 kg Paracetamol 500 kg</p>
                    <p class="bg-red-600 text-white w-fit px-2 py-1 text-sm rounded-md font-semibold">Resep</p>
                    
                    <div class="flex flex-col">
                        <p> <span class="text-secondaryColor font-bold leading-tight break-all">Rp. 5.000</span> / Strip </p>
                        <p class="font-semibold leading-tight break-all">Stok : 10</p>
                    </div>

                    <form action="">
                        <button type="button" onclick="grow()" class="text-white font-semibold bg-mainColor w-full py-1 rounded-md">Tambah</button>
                    </form>

                </div>
                @endfor
            </div>
            {{-- PRODUCT END --}}

            {{-- PAGINATION START --}}
            <div class="w-full flex justify-center items-center py-8">
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
            {{-- PAGINATION END --}}
        </div>

        {{-- CART START --}}
        <div class="w-[33%] bg-white py-10 px-8 flex flex-col justify-between gap-10">
            <div class="flex flex-col gap-4">
                <p class="font-bold text-2xl">Detail Pesanan</p>
                <hr class="border border-1 border-mediumGrey opacity-20">
                
                <div class="w-full flex flex-col gap-4">
                    @for ($i = 0; $i < 4; $i++)
                    <div class="flex gap-2">
                        <img src="https://i.pinimg.com/564x/22/04/72/2204725ec0bd13c61131bc099467b04c.jpg" class="w-24 rounded-md" alt="">

                        <div class="flex flex-col justify-between">
                            <p class="bg-red-600 text-white w-fit px-2 py-1 text-sm rounded-md font-semibold">Resep</p>
                            <p class="w-full font-semibold text-base namaObat leading-tight break-words">Paracetamol 500 kg Paracetamol 500 kg Paracetamol 500 kg Paracetamol 500 kg Paracetamol 500 kg</p>
                            <div class="flex justify-between">
                                <div class="w-[50%] text-secondaryColor font-bold break-all leading-tight">
                                    Rp. 5.000 <span class="text-black"> / Strip </span>
                                </div>
                                {{-- JUMLAH START --}}
                                <div class="w-[50%] flex justify-end">
                                    <div class="w-fit border-1 border-semiBlack border rounded-md flex gap-4 px-2">
                                        <form action="">
                                            <button>
                                                <i class="text-mainColor fa-solid fa-minus"></i>
                                            </button>
                                        </form>

                                        <p class="font-semibold">2</p>

                                        <form action="">
                                            <button>
                                                <i class="text-mainColor fa-solid fa-plus"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                {{-- JUMLAH END --}}
                            </div>
                        </div>
                    </div>
                    @endfor

                </div>
            </div>
            
            {{-- TOTAL START --}}
            <form action="" method=""
            class="flex flex-col gap-4">
                <p class="font-bold text-2xl">Total Pesanan</p>
                <hr class="border border-1 border-mediumGrey opacity-20">            

                <div class="">
                    <div class="flex justify-between text-lg">
                        <p class="font-bold text-mediumGrey">Total Barang</p>
                        <p class="font-bold ">4 Barang</p>
                    </div>

                    <div class="flex justify-between text-lg">
                        <p class="font-bold text-mediumGrey">Total Harga</p>
                        <p class="font-bold text-secondaryColor">Rp. 25.000</p>
                    </div>
                </div>

                <button type="submit" class="w-full py-2 bg-mainColor text-white font-bold text-lg rounded-md">Bayar</button>
            </form>
            {{-- TOTAL END --}}
        </div>
        {{-- CART END --}}
    </main>

    <script>
        function initializeDropdown(buttonId, menuId) {
            const dropdownButton = document.getElementById(buttonId);
            const dropdownMenu = document.getElementById(menuId);
            let isDropdownOpen = true;

            function toggleDropdown() {
                isDropdownOpen = !isDropdownOpen;
                if (isDropdownOpen) {
                    dropdownMenu.classList.remove('hidden');
                } else {
                    dropdownMenu.classList.add('hidden');
                }
            }

            toggleDropdown();

            dropdownButton.addEventListener('click', toggleDropdown);

            window.addEventListener('click', (event) => {
                if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.classList.add('hidden');
                    isDropdownOpen = false;
                }
            });
        }

        // samakan dengan jumlah filter
        for (let i = 0; i < 4; i++) {
            initializeDropdown('dropdown-button' + i, 'dropdown-menu' + i);
        }

        // Script untuk membatasi jumlah karakter di nama obat
        const obatElement = document.getElementsByClassName("namaObat");

        for (let i = 0; i < obatElement.length; i++) {
            const obatText = obatElement[i].textContent;

            if (obatText.length > 18) {
                obatElement[i].textContent = obatText.slice(0, 38) + "...";
            }
        }

        const toggleSidebar = () => {
            const sidebar = document.getElementById('sidebar');
            const main = document.getElementById('mainContent');

            if (sidebar.classList.contains('-translate-x-80')) {
                sidebar.classList.remove('-translate-x-80')
                main.classList.add('brightness-50')
            } else {
                sidebar.classList.add('-translate-x-80')
                main.classList.remove('brightness-50')
            }

        }
    </script>
</body>
</html>