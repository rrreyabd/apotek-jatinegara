<nav class="shadow-lg h-16 w-full flex justify-center bg-white duration-200 transition" id="navbar">
    <div class="w-[70vw] h-full flex items-center justify-between">
        <p class="text-mainColor font-TripBold text-3xl">Apotek</p>

        <form action="" class="relative">
            <input type="text" placeholder="Search"
                class="px-3 py-2 w-[400px] rounded-2xl shadow-sm shadow-semiBlack border border-1 border-semiBlack">
            <button class="absolute right-2 top-2">
                <i class="fa-solid fa-magnifying-glass text-2xl text-secondaryColor"></i>
            </button>
        </form>

        <div class="flex gap-4 justify-center items-center">
            {{-- JIKA USER BELUM LOGIN --}}
            <a href="login" class="text-mainColor font-semibold text-lg border-2 border-mainColor py-1 px-3 rounded-lg">
                Masuk
            </a>

            <a href="register" class="text-white font-semibold text-lg border-2 border-mainColor bg-mainColor py-1 px-3 rounded-lg">
                Daftar
            </a>

            {{-- JIKA USER SUDAH LOGIN --}}
            <a href="" class="flex justify-center items-center h-[40px] w-[40px] relative">
                <i class="fa-solid fa-cart-shopping text-3xl text-mainColor"></i>
                <span
                    class="absolute bg-secondaryColor h-6 w-6 p-2 font-semibold flex justify-center items-center align-middle rounded-full left-6 bottom-6 text-white font-sans border-2 border-white text-[15px]">8</span>
            </a>
            
            <a href=""
                class="border-2 border-mainColor h-[35px] w-[35px] rounded-full flex justify-center items-center overflow-hidden relative">
                <i class="fa-solid fa-user text-3xl absolute top-1 text-mainColor"></i>
            </a>
        </div>
    </div>
</nav>

<script>
    window.onscroll = function() {
        var navbar = document.getElementById('navbar');

        if (window.scrollY > 0) {
            navbar.classList.add('fixed');
        } else {
            navbar.classList.remove('fixed');
        }
    };
</script>