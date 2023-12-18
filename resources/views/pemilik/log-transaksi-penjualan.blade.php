<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pemilik Apotek | Transaksi Penjualan</title>
    @vite('resources/css/app.css')

    {{-- FONT AWESOME --}}
    <script src="https://kit.fontawesome.com/e87c4faa10.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1fc4ea1c6a.js" crossorigin="anonymous"></script>

    {{-- DATATABLES --}}
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
</head>

<body class="font-Inter relative">
    @include('pemilik.components.sidebar')
    <main class="p-10 font-Inter bg-plat min-h-[100vh] h-full" id="mainContent">
        @include('pemilik.components.navbar')

        <p class="text-3xl font-bold mt-10 mb-4">Log Transaksi Penjualan</p>

        <div class="flex flex-col gap-8">
            <div class="flex justify-between">

            {{-- FILTER START --}}
            
            {{-- FILTER END --}}
        </div>

        <div class="bg-white rounded-lg p-4 shadow-md overflow-x-auto">
            <table id="myTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pembeli</th>
                        <th>Tanggal Transaksi</th>
                        <th>Nomor Invoice</th>
                        <th>Status Transaksi</th>
                        <th>Detail Pesanan</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                        $index = 1;
                    @endphp
                    @foreach ($sellings as $item)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>
                            <span class="font-bold">{{ $item->recipient_name }}</span>
                        </td>
                        @php
                            $carbonDate = \Carbon\Carbon::parse( $item->order_complete);
                            $formattedDate = $carbonDate->format('j F Y');
                        @endphp
                        <td>{{ $formattedDate }}</td>
                        <td>{{ $item->invoice_code }}</td>
                        <td>
                            <div class="w-full flex gap-2 items-center">
                                {{-- GREEN = BERHASIL, YELLOW = REFUND, RED = GAGAL --}}
                                @if ($item->order_status == "Offline")
                                    <i class="text-green-600 fa-solid fa-circle"></i>
                                    <p class="font-bold">Offline</p>
                                @elseif($item->order_status == "Berhasil")
                                    <i class="text-green-600 fa-solid fa-circle"></i>
                                    <p class="font-bold">Berhasil</p>
                                @elseif($item->order_status == "Gagal")
                                    <i class="text-red-600 fa-solid fa-circle"></i>
                                    <p class="font-bold">Gagal</p>
                                @else
                                    <i class="text-yellow-600 fa-solid fa-circle"></i>
                                    <p class="font-bold">{{ $item->order_status }}</p>

                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="flex w-full">
                                <button
                                    class="border-2 border-secondaryColor rounded-md hover:bg-transparent hover:text-secondaryColor font-bold px-4 py-1 bg-secondaryColor text-white duration-300 transition-colors ease-in-out"
                                    type="button" onclick="toggleDetail({{ $index }})" data-index="{{ $index }}">Lihat</button>
                            </div>

                            {{-- MODAL TRANSAKSI PENJUALAN START --}}
                            <div class="absolute w-full h-full top-0 left-0 flex justify-center items-center backdrop-brightness-75 z-10 hidden"
                                id="detailModal{{ $index }}">
                                <div
                                    class="w-[70%] h-fit max-h-full bg-white rounded-md shadow-md p-8 flex flex-col gap-6 overflow-auto">
                                    <div class="flex justify-between items-center">
                                        <button onclick="toggleDetail({{ $index }})" type="button"
                                            class="bg-mainColor py-1 px-4 text-white font-semibold rounded-md">
                                            <i class="fa-solid fa-arrow-left"></i>
                                            Kembali
                                        </button>

                                        <p class="font-bold">{{ $item->invoice_code }}</p>

                                        <div class="flex gap-2 items-center">
                                            {{-- GREEN = BERHASIL, YELLOW = REFUND, RED = GAGAL --}}
                                            @if ($item->order_status == "Offline")
                                                <i class="text-green-600 fa-solid fa-circle"></i>
                                                <p class="font-bold">Offline</p>
                                            @elseif($item->order_status == "Berhasil")
                                                <i class="text-green-600 fa-solid fa-circle"></i>
                                                <p class="font-bold">Berhasil</p>
                                            @elseif($item->order_status == "Gagal")
                                                <i class="text-red-600 fa-solid fa-circle"></i>
                                                <p class="font-bold">Gagal</p>
                                            @else
                                                <i class="text-yellow-600 fa-solid fa-circle"></i>
                                                <p class="font-bold">{{ $item->order_status }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="px-8 py-2 w-[100%] flex justify-between">
                                        <div class="w-[70%]">
                                            <div class="flex flex-col gap-8 overflow-y-auto h-72">
                                                <table class="w-full">
                                                    <tr
                                                        class="border-2 border-b-mainColor border-transparent text-mainColor font-bold w-[100%]">
                                                        <td class="w-[10%] pb-2 text-center">No</td>
                                                        <td class="w-[30%] pb-2">Nama</td>
                                                        <td class="w-[10%] pb-2 text-center">Jumlah</td>
                                                        <td class="w-[25%] pb-2 text-center">Harga</td>
                                                        <td class="w-[25%] pb-2">Total</td>
                                                    </tr>
                                                    @php
                                                        $j = 1;
                                                        $subtotal = 0
                                                    @endphp
                                                    @foreach ($item->sellingInvoiceDetail as $detail)
                                                    <tr>
                                                        <td class="py-2 text-center">{{$j++}}</td>
                                                        <td class="py-2">{{ $detail->product_name }}</td>
                                                        <td class="py-2 text-center">{{ $detail->quantity }}</td>
                                                        <td class="py-2 text-center">Rp
                                                            {{ number_format($detail->product_sell_price , 0, ',', '.') }}</td>
                                                        <td class="py-2">Rp
                                                            {{ number_format($detail->quantity * $detail->product_sell_price , 0, ',', '.') }}</td>
                                                    </tr>
                                                    @php
                                                        $subtotal += $detail->quantity * $detail->product_sell_price
                                                    @endphp
                                                    @endforeach
                                                </table>
                                            </div>

                                            <div class="flex flex-col gap-2 py-2">
                                                <hr class="border-2 border-transparent border-b-mainColor">
                                                <div class="flex font-bold gap-2">
                                                    <p class="w-28">Total Harga</p>
                                                    <p>:</p>
                                                    <p class="text-secondaryColor">Rp
                                                        {{ number_format($subtotal , 0, ',', '.') }}</p>
                                                </div>
                                                <div class="flex font-bold gap-2">
                                                    <p class="w-28">Kasir</p>
                                                    <p>:</p>
                                                    <p class="text-mainColor">{{ $item->cashier_name }}</p>
                                                </div>
                                                {{-- ALASAN GAGAL KALAU ADA --}}
                                                @if ($item->order_status == "Gagal")
                                                <div class="flex font-bold gap-2">
                                                    <p class="w-28">Alasan Gagal</p>
                                                    <p>:</p>
                                                    <p class="text-mainColor w-[70%]">{{ $item->reject_comment }}</p>
                                                </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="w-[25%]">
                                            <p class="text-center font-bold text-mainColor pb-2">Keterangan</p>
                                            <hr class="border-2 border-transparent border-b-mainColor">
                                            <div class="py-2">
                                                <p class="font-bold">Pelanggan :</p>
                                                <p>{{ $item->recipient_name }}</p>
                                                <p class="font-bold">Nomor HP :</p>
                                                <p>{{ $item->recipient_phone }}</p>
                                                <p class="font-bold">Tanggal Pengambilan :</p>
                                                @php
                                                    $orderDate = \Carbon\Carbon::parse($item->order_date);
                                                    $dateAfter3Days = $orderDate->addDays(3);
                                                    $convertedDate = $dateAfter3Days->format('j F Y');
                                                @endphp
                                                <p>{{ $convertedDate }}</p>
                                                <p class="font-bold">Metode Pembayaran :</p>
                                                <p>{{ $item->recipient_bank }}</p>
                                                <p class="font-bold">Bukti Pembayaran :</p>
                                                <a href="/owner/bukti-pembayaran/{{ $item->recipient_payment }}" target="_blank"
                                                    class="text-blue-600 underline">{{ $item->recipient_payment }}</a>
                                                <p class="font-bold">Catatan :</p>
                                                <p>{{ $item->recipient_request }}</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            {{-- MODAL DETAIL TRANSAKSI PENJUALAN END --}}
                        </td>
                    </tr>
                    @php
                        $index++
                    @endphp
                        @endforeach
                </tbody>
            </table>
        </div>
        </div>
    </main>

    {{-- DATATABLES SCRIPT --}}
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="{{ asset('js/datatables.js') }}"></script>

    <script>
        const toggleDetail = (index) => {
            const modal = document.getElementById('detailModal' + index);

            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden')
                document.body.classList.add('h-fit')
            } else {
                modal.classList.add('hidden')
                document.body.classList.remove('h-fit')
            }
        }

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
        for (let i = 0; i < 1; i++) {
            initializeDropdown('dropdown-button' + i, 'dropdown-menu' + i);
        }
    </script>
</body>

</html>