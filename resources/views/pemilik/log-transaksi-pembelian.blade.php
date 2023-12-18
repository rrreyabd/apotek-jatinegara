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

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>

    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

    <!-- DataTables Buttons -->
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
</head>

<body class="font-Inter relative">
    @include('pemilik.components.sidebar')
    <main class="p-10 font-Inter bg-plat min-h-[100vh] h-full" id="mainContent">
        @include('pemilik.components.navbar')

        <p class="text-3xl font-bold mt-10 mb-4">Log Transaksi Pembelian</p>

        <div class="flex flex-col gap-8">
            <div class="flex justify-between">

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
                                <div class="fixed w-full h-screen top-0 left-0 flex justify-center items-center backdrop-brightness-75 z-10 hidden" id="detailModal{{ $index }}">
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
                                                    <table class="w-full" id="table_list">
                                                        <tr class="border-2 border-b-mainColor border-transparent text-mainColor font-bold w-[100%] justify-between">
                                                            <th class="pb-2 text-center">No</th>
                                                            <th class="pb-2">Nama</th>
                                                            <th class="pb-2 text-center">Tanggal Kadaluarsa</th>
                                                            <th class="pb-2 text-center">Jumlah</th>
                                                            <th class="pb-2 text-center">Harga</th>
                                                            <th class="pb-2">Total</th>
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
                                                <div class="flex gap-4 mt-4">
                                                    <a href="{{ route('invoice-supplier',['id'=> $uuid]) }}" target="_blank" class="bg-mainColor py-1 px-4 text-white font-semibold rounded-md">
                                                        <i class="fa-solid fa-print"></i>
                                                        Download Invoice
                                                    </a>
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
    </script>

</body>

</html>