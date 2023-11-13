<div class="flex justify-between">
    <div class="flex gap-8">
         {{-- toggle --}}
         <button onclick="sidebar()" class="p-3 px-4 rounded-lg shadow-md bg-white w-fit" style="transition: 0.25s;" id="buttonToggle">
            <i class="fa-solid fa-bars" id="toggle"></i>
        </button>

        <form action="" class="relative">
            <input type="text" name="" id="" class="h-full md:w-96 rounded-md shadow-md pl-4 pr-14 placeholder:text-sm" placeholder="Cari produk disini...">
            <button type="submit" class="absolute right-2 top-1.5 bg-mainColor font-semibold text-white px-2.5 py-1.5 rounded-md">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
    </div>
</div>

<script>
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