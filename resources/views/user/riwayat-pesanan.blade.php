<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Apotek | Riwayat Pesanan</title>
    @vite('resources/css/app.css')

    {{-- FONT AWESOME --}}
    <script src="https://kit.fontawesome.com/e87c4faa10.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1fc4ea1c6a.js" crossorigin="anonymous"></script>
</head>

<body class="font-Inter">
    @include('user.components.navbar')

    <div class="flex flex-col items-center mb-8">

        <div class="w-[70vw] mt-8 flex flex-col">
            <div class="flex gap-4">
                {{-- back button --}}

                <a href="/"
                    class="flex justify-start items-center rounded-3xl shadow-md h-[40px] px-3 text-center text-lg text-gray-500 font-semibold">
                    <svg xmlns="http://www.w3.org/2000/svg" class="pe-1" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M9 14l-4 -4l4 -4"></path>
                        <path d="M5 10h11a4 4 0 1 1 0 8h-1"></path>
                    </svg>
                    Kembali</a>
            </div>

            <div class="my-7">
                <p class="text-3xl font-semibold">Riwayat Pesanan</p>

                {{-- search --}}
                <form action="/riwayat-pesanan" method="GET" class="relative my-3">
                    @if (request()->status)
                        <input type="hidden" name="status" value="{{ request()->status }}">
                    @endif
                    <input type="text" name="cari" placeholder="INV-******" value="{{ request()->cari ?? "" }}"
                        class="pl-4 pr-10 py-2 w-full rounded-md shadow-sm shadow-semiBlack border border-1 border-semiBlack">
                    <button type="submit" class="absolute right-2 top-2">
                        <i class="fa-solid fa-magnifying-glass text-2xl text-secondaryColor"></i>
                    </button>
                </form>

                <button onclick="toggleStatus()" class="w-fit rounded-lg border-2 border-mainColor p-1.5 px-3 mt-7">{{ request()->status ?? "Status Pesanan" }} <i class="fa-solid fa-chevron-down"></i></button>

                {{-- STATUS DROPDOWN START --}}
                <div class="absolute top-[21rem] bg-white shadow-md shadow-semiBlack w-64 h-fit rounded-md cursor-pointer hidden overflow-hidden font-medium opacity-0 transition-opacity duration-200 ease-in-out" id="dropdownMenu2">
                    @if (request()->status)
                        <a href={{ request()->cari ? "/riwayat-pesanan?cari=".request()->cari : "/riwayat-pesanan" }} class="border border-1 w-full border-b-mediumGrey border-opacity-60 py-2 px-4 flex items-center gap-2 hover:bg-lightGrey duration-300">
                            Semua Pesanan
                        </a>
                    @endif

                    @foreach ($status as $stat)
                    <form action="/riwayat-pesanan" method="GET" class="text-center">
                        <input type="hidden" name="status" value="{{ $stat }}">
                        @if (request()->cari)
                        <input type="hidden" name="cari" value="{{ request()->cari }}">
                        @endif
                        <button type="submit" class="border border-1 w-full border-b-mediumGrey border-opacity-60 py-2 px-4 flex items-center gap-2 hover:bg-lightGrey duration-300">
                            {{ $stat }}
                        </button>
                    </form>
                    @endforeach
                </div>
                {{-- STATUS DROPDOWN END --}}

                {{-- table --}}
                <div class="overflow-x-auto">
                    <table class="w-full mt-5 ">
                        <thead>
                            <tr>
                                <th class="pb-2">No. Invoice</th>
                                <th class="pb-2">Tanggal Belanja</th>
                                <th class="pb-2">Keterangan</th>
                                <th class="pb-2">Status</th>
                                <th class="pb-2">Total Belanja</th>
                            </tr>
                        </thead>
                    
                        <tbody class="shadow-lg">
                            @foreach ($products_purcase as $product_purcase)
                            <tr class="p-3 border-[1px] border-black h-[55px]">
                                <th>{{ $product_purcase->invoice_code }}</th>
                                <th class="font-light">{{ date('d M Y',strtotime($product_purcase->order_date)) }}</th>
                                <th><a href="/detail-riwayat-pesanan?pesanan={{ $product_purcase->selling_invoice_id }}" class="text-blue-600 underline font-semibold">Lihat Detail</a></th>
                                <th class="py-3 flex justify-center items-center">
                                    <p class="
                                    @if($product_purcase->order_status == 'Berhasil') bg-green-700 
                                    @elseif ($product_purcase->order_status == 'Menunggu Pengembalian' || $product_purcase->order_status == 'Menunggu Konfirmasi' || $product_purcase->order_status == 'Menunggu Pengambilan') 
                                    bg-secondaryColor
                                    @elseif ($product_purcase->order_status == 'Gagal' || $product_purcase->order_status == 'Refund')
                                    bg-red-500
                                    @endif w-56 py-1 px-4 rounded-lg text-white font-semibold">{{ $product_purcase->order_status }}</p>
                                </th>
                                @php
                                    $totalBelanja = 0;

                                    $product=$product_purcase->sellingInvoiceDetail;
                                    foreach ($product as $p) {
                                        $totalBelanja += $p->product_sell_price * $p->quantity;
                                    }
                                @endphp
                                <th>Rp {{ number_format($totalBelanja , 0, ',', '.') }}</th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $products_purcase->links() }}
                </div>
            </div>
        </div>
    </div>

    <script>
        const toggleStatus = () => {
            const menu2 = document.getElementById('dropdownMenu2');
    
            if (menu2.classList.contains('hidden')) {
                requestAnimationFrame(() => {
                    menu2.classList.remove('hidden');
                    requestAnimationFrame(() => {
                        menu2.classList.add('opacity-100');
                    });
                });
            } else {
                requestAnimationFrame(() => {
                    menu2.classList.remove('opacity-100');
                    requestAnimationFrame(() => {
                        menu2.classList.add('hidden');
                    });
                });
            }
        }
    
        const menu2 = document.querySelector('#dropdownMenu2');
    
        document.addEventListener('click', (event) => {
            if (event.target !== menu) {
                menu2.classList.add('hidden');
                menu2.classList.remove('opacity-100');
                menu2.classList.add('opacity-0');
            }
        });
    </script>

    @include('user.components.footer')
</body>

</html>