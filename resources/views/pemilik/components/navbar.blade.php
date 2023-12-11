<div class="flex justify-between">
    <div class="sm:flex gap-8">
        {{-- toggle --}}
        <button onclick="sidebar()" class="p-3 px-4 rounded-lg shadow-md bg-white w-fit" style="transition: 0.25s;" id="buttonToggle">
            <i class="fa-solid fa-bars" id="toggle"></i>
        </button>

        <form action="" class="relative">
            <input type="text" name="" id="" class="sm:h-full h-12 md:w-96 rounded-md shadow-md pl-4 pr-14 placeholder:text-sm" placeholder="Cari produk disini...">
            <button type="submit" class="absolute right-2 top-1.5 bg-mainColor font-semibold text-white px-2.5 py-1.5 rounded-md">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
    </div>
    
    <a href="/owner/pesanan-online" class="flex gap-2 items-center text-mainColor bg-white shadow-md rounded-full px-2 py-1">
        <i class="fa-solid fa-circle-exclamation text-xl"></i>
        <p class="font-bold">{{ $total }} Pesanan Online</p>
    </a>
</div>

<script>
    const sidebar = () => {
        const sidebar = document.getElementById('sidebar');
        const main = document.getElementById('mainContent');

        if (sidebar.classList.contains('-translate-x-96')) {
            sidebar.classList.remove('-translate-x-96')
            main.classList.add('brightness-50')
            // document.body.classList.add('h-[100vh]')
            // document.body.classList.add('overflow-hidden')
        } else {
            sidebar.classList.add('-translate-x-96')
            main.classList.remove('brightness-50')
            // document.body.classList.remove('h-[100vh]')
            // document.body.classList.remove('overflow-hidden')
        }

    }
</script>