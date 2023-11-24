<div class="flex justify-between">
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

    <div class="flex gap-2 items-center text-mainColor bg-white shadow-md rounded-full px-2 py-1">
        <i class="fa-solid fa-circle-exclamation text-xl"></i>
        <p class="font-bold">{{ $total }} Pesanan Pending</p>
    </div>
</div>

<script>
    const toggleSidebar = () => {
        const sidebar = document.getElementById('sidebar');
        const main = document.getElementById('mainContent');

        if (sidebar.classList.contains('-translate-x-80')) {
            sidebar.classList.remove('-translate-x-80')
            main.classList.add('brightness-50')
            // document.body.classList.add('h-[100vh]')
            // document.body.classList.add('overflow-hidden')
        } else {
            sidebar.classList.add('-translate-x-80')
            main.classList.remove('brightness-50')
            // document.body.classList.remove('h-[100vh]')
            // document.body.classList.remove('overflow-hidden')
        }

    }
</script>