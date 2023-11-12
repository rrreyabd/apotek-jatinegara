{{-- SIDEBAR START --}}
<nav class="bg-white p-8 w-[20%] shadow-md absolute left-0 top-0 min-h-[100vh] h-full z-10 shadow-semiBlack -translate-x-80 transition-transform duration-300 ease-in-out flex flex-col gap-4" id="sidebar">
    <div class="flex justify-between w-full">
        <p class="bg-mainColor text-white font-bold px-2 py-1 rounded-br-xl rounded-tl-xl text-lg">Jati Negara</p>

        <button onclick="toggleSidebar()" class="text-xl text-black font-bold">
            &#10005;
        </button>
    </div>

    <hr class="border border-1 border-mediumGrey opacity-20">

    <div class="flex flex-col gap-4 py-4 font-bold text-lg text-mediumGrey">
        <a href="/cashier" class="hover:text-mainColor">
            <i class="mr-4 fa-solid fa-bag-shopping"></i>
            Produk
        </a>
        <a href="" class="hover:text-mainColor">
            <i class="mr-4 fa-solid fa-cart-shopping"></i>
            Pesanan Online
        </a>
        <a href="/cashier/riwayat-transaksi" class="hover:text-mainColor">
            <i class="mr-4 fa-solid fa-clock-rotate-left"></i>
            Riwayat Transaksi
        </a>
        <a href="/logout" class="hover:text-mainColor">
            <i class="mr-4 fa-solid fa-arrow-right-from-bracket"></i>
            Logout
        </a>
    </div>
</nav>
{{-- SIDEBAR END --}}