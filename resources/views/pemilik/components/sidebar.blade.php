<div class="font-TripBold bg-white h-screen fixed w-0 z-10 " id="sidebar" style="transition: 0.3s;">
    <div class="overflow-x-hidden overflow-y-hidden pt-10 flex justify-center w-full" style="transition: 0.3s;">
        <p class="bg-mainColor text-white font-bold px-7 py-1 rounded-br-xl rounded-tl-xl text-lg">Jati Negara</p>
    </div>

    {{-- line --}}
    <div class="w-full shadow border border-neutral-200 my-3"></div>

    <div class="overflow-x-hidden text-mediumGrey mt-8" style="transition: 0.3s;">
        <a href="{{ route('dashboard') }}" class="flex items-center text-lg">
            <i class="fa-solid fa-chart-line me-3"></i>
            <p>Dashboard</p>
        </a>
    </div>

    <div class="overflow-x-hidden text-mediumGrey my-4" style="transition: 0.3s;">
        <a href="{{ route('list-user') }}" class="flex items-center text-lg">
            <i class="fa-regular fa-user me-3"></i>
            <p>User</p>
        </a>
    </div>

    <div class="overflow-x-hidden text-mediumGrey my-4" style="transition: 0.3s;">
        <a href="/owner/kasir" class="flex items-center text-lg">
            <i class="fa-regular fa-credit-card me-3"></i>
            <p>Kasir</p>
        </a>


        <div class="overflow-x-hidden text-mediumGrey my-4" style="transition: 0.3s;">
            <a href="/owner/supplier" class="flex items-center text-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-truck-delivery me-1.5" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M7 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                    <path d="M17 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                    <path d="M5 17h-2v-4m-1 -8h11v12m-4 0h6m4 0h2v-6h-8m0 -5h5l3 5"></path>
                    <path d="M3 9l4 0"></path>
                 </svg>
                <p>Supplier</p>
            </a>
        </div>

        <div class="overflow-x-hidden text-mediumGrey my-4" style="transition: 0.3s;">
            <a href="/owner/produk" class="flex items-center text-lg">
                <i class="fa-solid fa-bag-shopping me-3"></i>
                <p>Produk</p>
            </a>
        </div>

        <div class="overflow-x-hidden text-mediumGrey my-4" style="transition: 0.3s;">
            <a href="{{ route('list-selling-transaction') }}" class="flex items-center text-lg">
                <i class="fa-regular fa-clipboard me-3"></i>
                <p>Transaksi Penjualan</p>
            </a>
        </div>

        <div class="overflow-x-hidden text-mediumGrey my-4" style="transition: 0.3s;">
            <a href="/owner/transaksi-pembelian" class="flex items-center text-lg">
                <i class="fa-regular fa-clipboard me-3"></i>
                <p>Transaksi Pembelian</p>
            </a>
        </div>

        <div class="overflow-x-hidden text-mediumGrey my-4" style="transition: 0.3s;">
            <a href="/owner/pesanan-pending" class="flex items-center text-lg">
                <i class="fa-solid fa-spinner me-3"></i>
                <p>Pesanan Pending</p>
            </a>
        </div>

        <div class="overflow-x-hidden text-mediumGrey my-4" style="transition: 0.3s;">
            <a href="/owner/log" class="flex items-center text-lg">
                <i class="fa-regular fa-folder-open me-3"></i>
                <p>Log</p>
            </a>
        </div>

        <div class="overflow-x-hidden text-mediumGrey my-4" style="transition: 0.3s;">
            <form action="/logout" method="POST">
                @csrf
                <button class="flex justify-cent text-lger items-center">
                    <i class="fa-solid fa-arrow-right-from-bracket me-3"></i>
                    <p>Logout</p>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    const sidebar = () => {
            const sidebar = document.getElementById('sidebar');
            const icon = document.getElementById('toggle');
            const buttonToggle = document.getElementById('buttonToggle');
            
            if (sidebar.classList.contains('w-0')) {
                sidebar.classList.remove('w-0')
                sidebar.classList.add('px-12')
                icon.classList.remove('fa-bars')
                icon.classList.add('fa-xmark')
                buttonToggle.classList.add('ms-[17rem]')
            } else {
                sidebar.classList.add('w-0')
                sidebar.classList.remove('px-12')
                icon.classList.add('fa-bars')
                icon.classList.remove('fa-xmark')
                buttonToggle.classList.remove('ms-[17rem]')
            }
        }
</script>