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
    @livewireStyles
</head>

<body class="font-Inter relative">

    @include('kasir.components.sidebar')

    <main class="flex flex-grow bg-plat" id="mainContent">
        <div class="flex flex-col gap-8 w-[67%] p-10">
            <div class="flex gap-8">
                <button onclick="toggleSidebar()" class="bg-white h-10 w-10 rounded-md shadow-md p-1">
                    <i class="fa-solid fa-bars text-mediumGrey"></i>
                </button>

                <livewire:cashier-liveshow>
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
                        class="origin-top-right absolute left-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                        <div class="py-2 p-2" role="menu" aria-orientation="vertical" aria-labelledby="dropdown-button">

                            @foreach ($categories as $category)
                            <form action="" method="GET">
                                <input type="hidden" name="" id="" value="">
                                <button
                                    class="flex rounded-md px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer"
                                    role="menuitem">
                                    {{ $category -> category }}
                                </button>
                            </form>
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
                        class="origin-top-right absolute left-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                        <div class="py-2 p-2" role="menu" aria-orientation="vertical" aria-labelledby="dropdown-button">

                            @foreach ($units as $unit)

                            <form action="" method="GET">
                                <input type="hidden" name="" id="" value="">
                                <button
                                    class="flex rounded-md px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer"
                                    role="menuitem">
                                    {{ $unit->unit }}
                                </button>
                            </form>
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
                        class="origin-top-right absolute left-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                        <div class="py-2 p-2" role="menu" aria-orientation="vertical" aria-labelledby="dropdown-button">

                            @foreach ($groups as $group)
                            <form action="" method="GET">
                                <input type="hidden" name="" id="" value="">
                                <button
                                    class="flex rounded-md px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer"
                                    role="menuitem">
                                    {{ $group->group }}
                                </button>
                            </form>
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
                    @auth
                        @if ($item->product_status == 'aktif')
                        <button wire:click="cashier_count({{ '$item->product_id' }})"
                            class="text-white font-semibold bg-mainColor w-full py-1 rounded-md">Tambah</button>
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
            {{ $products ? $products->links() : "" }}
            {{-- PAGINATION END --}}
        </div>

        {{-- CART START --}}
        <livewire:cartdisplay :user="auth()->user()->user_id" :product="$item->product_id"/>
        {{-- CART END --}}
    </main>
    @livewireScripts
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