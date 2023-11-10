<nav class="shadow-lg h-16 w-full flex justify-center bg-white z-50 fixed" id="navbar">
    <div class="w-full md:w-[95vw] lg:w-[80vw] xl:w-[70vw] h-full flex items-center justify-between">
        <a href="/" class="text-mainColor font-TripBold text-3xl">Apotek</a>

        <form action="" class="relative">
            <input type="text" placeholder="Paracetamol"
                class="px-3 py-2 w-[400px] rounded-2xl shadow-sm shadow-semiBlack border border-1 border-semiBlack">
            <button class="absolute right-4 top-2">
                <i class="fa-solid fa-magnifying-glass text-2xl text-secondaryColor"></i>
            </button>
        </form>

        <div class="flex gap-4 justify-center items-center relative">
            @guest
            {{-- JIKA USER BELUM LOGIN --}}
            <a href="login"
                class="text-mainColor font-semibold text-lg border-2 flex items-center text-center border-mainColor h-[35px] px-3 rounded-lg">
                Masuk
            </a>

            <a href="register"
                class="bg-mainColor font-semibold text-lg border-2 flex items-center text-center border-mainColor text-white h-[35px] px-3 rounded-lg">
                Daftar
            </a>
            @else
            {{-- JIKA USER SUDAH LOGIN --}}
                @if (auth()->user()->role == 'user')
                <a href="" class="flex justify-center items-center h-[40px] w-[40px] relative">
                    <i class="fa-solid fa-cart-shopping text-3xl text-mainColor"></i>
                    <span
                        class="absolute bg-secondaryColor h-6 w-6 p-2 font-semibold flex justify-center items-center align-middle rounded-full left-6 bottom-6 text-white font-sans border-2 border-white text-[15px]">18</span>
                </a>

                <button onclick="toggleProfile()"
                    class="border-2 border-mainColor h-[35px] w-[35px] rounded-full flex justify-center items-center overflow-hidden relative">
                    <i class="fa-solid fa-user text-3xl absolute top-1 text-mainColor"></i>
                </button>
                @elseif (auth()->user()->role == 'cashier' || auth()->user()->role == 'owner')
                <a href="/dashboard" class="bg-mainColor text-white flex justify-center items-center h-[40px] w-[100px] rounded-lg relative">
                    Dashboard
                </a>

                <form action="/logout" method="POST" class="bg-red-500 text-white flex justify-center items-center h-[40px] w-[100px] rounded-lg relative">
                    @csrf
                    <button type="submit" class="w-full h-full">Logout</button>
                </form>
                @endif

                {{-- USER DROPDOWN START --}}
                <div class="absolute top-16 right-0 bg-white shadow-md shadow-semiBlack w-64 h-fit rounded-md overflow-hidden cursor-pointer font-medium hidden opacity-0 transition-opacity duration-200 ease-in-out" id="dropdownMenu">   
                    <div class="border border-1 border-b-mediumGrey border-opacity-60 py-2 px-4 flex items-center gap-2">
                        <i class="fa-solid fa-circle-user text-3xl text-mainColor"></i>
                        
                        <div class="flex justify-center flex-col">
                            <p class="font-semibold text-mainColor">{{ Auth()->user()->username }}</p>
                            <p class="text-xs opacity-60">{{ Auth()->user()->email }}</p>
                        </div>
                    </div>

                    <a href="/user-profile" class="flex justify-between px-4 pt-4 pb-2 items-center bg-semiWhite hover:bg-lightGrey duration-300 ease-in-out transition">
                        <div class="flex gap-2 items-center">
                            <i class="fa-solid fa-gear"></i>
                            <p>Pengaturan Akun</p>
                        </div>
                        <i class="fa-solid fa-chevron-right"></i>
                    </a>

                    <a href="#" class="flex justify-between px-4 pt-2 pb-4 items-center bg-semiWhite hover:bg-lightGrey duration-300 ease-in-out transition">
                        <div class="flex gap-2 items-center">
                            <i class="fa-solid fa-list"></i>
                            <p>Riwayat Pesanan</p>
                        </div>
                        <i class="fa-solid fa-chevron-right"></i>
                    </a>

                    <form action="/logout" method="POST" class="flex justify-center items-center bg-red-600 text-white">
                        @csrf
                        <button class="w-full h-full py-2 px-4">Logout</button>
                    </form>
                </div>
                {{-- USER DROPDOWN END --}}

            @endguest   
        </div>
    </div>
</nav>

{{-- agar position fixed navbar tidak diambil content dibawahnya  --}}
<div class="h-16 w-full"></div>

<script>
    const toggleProfile = () => {
        const menu = document.getElementById('dropdownMenu');

        if (menu.classList.contains('hidden')) {
            requestAnimationFrame(() => {
                menu.classList.remove('hidden');
                requestAnimationFrame(() => {
                    menu.classList.add('opacity-100');
                });
            });
        } else {
            requestAnimationFrame(() => {
                menu.classList.remove('opacity-100');
                requestAnimationFrame(() => {
                    menu.classList.add('hidden');
                });
            });
        }
    }

    const menu = document.querySelector('#dropdownMenu');

    document.addEventListener('click', (event) => {
        if (event.target !== menu) {
            menu.classList.add('hidden');
            menu.classList.remove('opacity-100');
            menu.classList.add('opacity-0');
        }
    });
</script>