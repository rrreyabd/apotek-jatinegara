<nav class="shadow-lg h-16 w-full flex justify-center bg-white z-50 fixed" id="navbar">
    <div class="w-full md:w-[95vw] lg:w-[80vw] xl:w-[70vw] h-full flex items-center justify-between">
        <a href="/" class="text-mainColor font-TripBold text-3xl">Apotek</a>

        <div class="flex gap-4 justify-center items-center">
            @guest
            <a href="login" class="text-mainColor font-semibold text-lg border-2 flex items-center text-center border-mainColor h-[35px] px-3 rounded-lg">
                Masuk
            </a>

            <a href="register" class="bg-mainColor font-semibold text-lg border-2 flex items-center text-center border-mainColor text-white h-[35px] px-3 rounded-lg">
                Daftar
            </a>

            @else
            <a href="" class="flex justify-center items-center h-[40px] w-[40px] relative">
                <i class="fa-solid fa-cart-shopping text-3xl text-mainColor"></i>
                <span
                    class="absolute bg-secondaryColor h-6 w-6 p-2 font-semibold flex justify-center items-center align-middle rounded-full left-6 bottom-6 text-white font-sans border-2 border-white text-[15px]">18</span>
            </a>
            
            <a href="/user-profile"
                class="border-2 border-mainColor h-[35px] w-[35px] rounded-full flex justify-center items-center overflow-hidden relative">
                <i class="fa-solid fa-user text-3xl absolute top-1 text-mainColor"></i>
            </a>
            <p>{{ Auth()->user()->username }}</p>
            @endguest
            <form action="/logout" method="POST">
                @csrf
                <button
                    class="text-white font-semibold text-lg border-2 flex items-center text-center bg-red-500 h-[35px] px-3 rounded-lg">Logout</button>
            </form>
        </div>
    </div>
</nav>

{{-- agar position fixed navbar tidak diambil content dibawahnya  --}}
<div class="h-16 w-full"></div>