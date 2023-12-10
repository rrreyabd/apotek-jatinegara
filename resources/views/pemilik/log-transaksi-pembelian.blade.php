<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pemilik Apotek | Transaksi Pembelian</title>
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

        <p class="text-3xl font-bold mt-10 mb-4">Log Transaksi Pembelian</p>

        <div class="flex flex-col gap-8">
            <div class="flex justify-between">
                <div class="sm:flex">
                    <input type="month" name="" id="" class="w-fit p-3 rounded-lg shadow-lg border-none">
                    <p class="mx-3 font-extrabold flex items-center text-2xl">-</p>
                    <input type="month" name="" id="" class="w-fit p-3 rounded-lg shadow-lg border-none">
                </div>

            {{-- FILTER START --}}
            @for ($i = 0; $i < 1; $i++) 
            <div class="relative inline-block text-left">
                    <button id="dropdown-button{{$i}}"
                        class="inline-flex justify-center gap-4 items-center w-full px-4 py-2 sm:h-full text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-2  focus:ring-mainColor">
                        Filter
                        <i class="fa-solid fa-chevron-down"></i>
                    </button>
                    <div id="dropdown-menu{{$i}}"
                        class="origin-top-left absolute bottom-16 right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                        <div class="py-2 p-2" role="menu" aria-orientation="vertical" aria-labelledby="dropdown-button">

                            @for ($j = 1; $j < 5; $j++) <form action="" method="GET">
                                <input type="hidden" name="" id="" value="">
                                <button
                                    class="flex rounded-md px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer"
                                    role="menuitem">
                                    Option {{$j}}
                                </button>
                                </form>
                                @endfor

                        </div>
                    </div>
            </div>
            @endfor
            {{-- FILTER END --}}
        </div>

            <div class="bg-white rounded-lg p-4 shadow-md overflow-x-auto">
                <table id="myTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Supplier</th>
                            <th>Tanggal Transaksi</th>
                            <th>Nomor Faktur</th>
                            <th>Detail Pesanan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                            $index = 1;
                        @endphp
                        @foreach ($buying as $item)
                            <td>{{$i++}}</td>
                            <td>
                                <span class="font-bold">{{ $item->supplier_name }}</span>
                            </td>
                            @php
                            $carbonDate = \Carbon\Carbon::parse( $item->order_date);
                            $formattedDate = $carbonDate->format('j F Y');
                            $uuid = $item->buying_invoice_id;

                            $numericValue = hexdec(substr($uuid, -5));

                            $formatted = 'FR-' . str_pad($numericValue, 6, '0', STR_PAD_LEFT);
                            @endphp
                            <td>{{ $formattedDate }}</td>

                            <td>{{ $formatted }}</td>
                            
                            <td>
                                <div class="flex w-full">
                                    <button class="border-2 border-secondaryColor rounded-md hover:bg-transparent hover:text-secondaryColor font-bold px-4 py-1 bg-secondaryColor text-white duration-300 transition-colors ease-in-out" type="button" onclick="toggleDetail({{ $index }})" data-index="{{ $index }}">Lihat</button>
                                </div>

                                {{-- MODAL DETAIL TRANSAKSI PEMBELIAN START --}}
                                <div class="absolute w-full h-screen top-0 left-0 flex justify-center items-center backdrop-brightness-75 z-10 hidden" id="detailModal{{ $index }}">
                                    <div class="w-[70%] h-fit max-h-full bg-white rounded-md shadow-md p-8 flex flex-col gap-6 overflow-auto">
                                        <div class="flex justify-between items-center">
                                            <button onclick="toggleDetail({{ $index }})" type="button" class="bg-mainColor py-1 px-4 text-white font-semibold rounded-md">
                                                <i class="fa-solid fa-arrow-left"></i>
                                                Kembali
                                            </button>
    
                                            <p class="font-bold">{{ $formatted }}</p>
                                            <div></div>
                                        </div>
    
                                        <div class="px-8 py-2 w-[100%] flex justify-between">
                                            <div class="w-full">
                                                <div class="flex justify-between">
                                                    <div class="font-bold">
                                                        <p class="text-mainColor">Tanggal Pembelian</p> 
                                                        <p>{{ $formattedDate }}</p>
                                                    </div>
                                                    <div class="font-bold">
                                                        <p class="text-mainColor">Supplier</p> 
                                                        <p>{{ $item->supplier_name }}</p>
                                                    </div>
                                                    <div class="font-bold">
                                                        <p class="text-mainColor">Nomor HP</p> 
                                                        <p>{{ $supplier->supplier_phone }}</p>
                                                    </div>
                                                    <div class="font-bold">
                                                        <p class="text-mainColor">Alamat</p> 
                                                        <p class="whitespace-pre-wrap w-72">{{ $supplier->supplier_address }}</p>
                                                    </div>
                                                </div>

                                                <div class="flex flex-col gap-8 mt-8 overflow-y-auto h-72">
                                                    <table class="w-full">
                                                        <tr class="border-2 border-b-mainColor border-transparent text-mainColor font-bold w-[100%] justify-between">
                                                            <td class="pb-2 text-center">No</td>
                                                            <td class="pb-2">Nama</td>
                                                            <td class="pb-2 text-center">Tanggal Kadaluarsa</td>
                                                            <td class="pb-2 text-center">Jumlah</td>
                                                            <td class="pb-2 text-center">Harga</td>
                                                            <td class="pb-2">Total</td>
                                                        </tr>
                                                        @php
                                                            $j =1;
                                                            $subtotal = 0;
                                                        @endphp
                                                        @foreach ($item->buyingInvoiceDetail as $detail)
                                                        <tr>
                                                            <td class="py-2 text-center">{{$j++}}</td>
                                                            <td class="py-2">{{ $detail->product_name }}</td>
                                                            @php
                                                                $carbonDated = \Carbon\Carbon::parse( $detail->exp_date);
                                                                $formattedEXPDate = $carbonDated->format('j F Y');
                                                                $subtotal += $detail->quantity * $detail->product_buy_price
                                                            @endphp
                                                            <td class="py-2 text-center">{{ $formattedEXPDate }}</td>
                                                            <td class="py-2 text-center">{{ $detail->quantity }}</td>
                                                            <td class="py-2 text-center">Rp
                                                                {{ number_format($detail->product_buy_price , 0, ',', '.') }}</td>
                                                            <td class="py-2">Rp
                                                                {{ number_format($detail->quantity * $detail->product_buy_price , 0, ',', '.') }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </table>
                                                </div>
    
                                                <div class="flex flex-col gap-2 py-2 items-end mt-5">
                                                    <hr class="border-2 border-transparent border-t-mainColor">
                                                    <div class="flex font-bold gap-2">
                                                        <p class="w-28">Total Harga</p>
                                                        <p>:</p>
                                                        <p class="text-secondaryColor">Rp
                                                            {{ number_format($subtotal , 0, ',', '.') }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
    
                                    </div>
                                </div>
                                {{-- MODAL DETAIL TRANSAKSI PEMBELIAN END --}}
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