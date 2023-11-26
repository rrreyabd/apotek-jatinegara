<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kasir | Riwayat Transaksi</title>
    @vite('resources/css/app.css')

    {{-- FONT AWESOME --}}
    <script src="https://kit.fontawesome.com/e87c4faa10.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1fc4ea1c6a.js" crossorigin="anonymous"></script>

    {{-- DATATABLES --}}
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
</head>
<body class="font-Inter relative">
    @include("kasir.components.sidebar")
    <main class="p-10 font-Inter bg-plat min-h-[100vh] h-full" id="mainContent">
        @include("kasir.components.navbar")

        <div class="flex flex-col gap-8 mt-10">
            <p class="text-3xl font-bold">Riwayat Transaksi</p>

            <div class="bg-white rounded-lg p-4 shadow-md">
                <table id="myTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>
                                <span class="text-center"> No. </span>
                            </th>
                            <th>Nomor Invoice</th>
                            <th>Nama Penerima</th>
                            <th>Waktu Pemesanan</th>
                            <th>Total Harga</th>
                            <th>Status Pesanan</th>
                            <th>Detail Pesanan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1;  @endphp
                        @php $index = 1;  @endphp
                        @foreach ($histories as $history)               
                        <tr>
                            <td>{{ $i }}</td>
                            <td>
                                <span class="font-bold">{{ $history->invoice_code }}</span>
                            </td>
                            <td>{{$history->recipient_name}}</td>
                            <td>{{ date('d M Y',strtotime($history->order_complete)) }}</td>
                                @php
                                    $totalPrice = 0; // Initialize the variable to store the total price
                                @endphp
                                @foreach ($history->sellingInvoiceDetail as $invoice)
                                    @php
                                    $totalPrice = $totalPrice + ($invoice->product_sell_price * $invoice->quantity); // Accumulate the price
                                    @endphp
                                @endforeach
                            <td>Rp {{ number_format($totalPrice, 0, ',', '.') }}</td>
                            <td>
                                <div class="w-full flex gap-2 items-center">
                                    {{-- GREEN = BERHASIL, YELLOW = REFUND, RED = GAGAL --}}
                                    @if ( $history->order_status == 'Berhasil' || $history->order_status == 'Offline')
                                        <i class="text-green-600 fa-solid fa-circle"></i>
                                    @elseif ($history->order_status == 'Refund')
                                        <i class="text-yellow-600 fa-solid fa-circle"></i>
                                    @elseif ($history->order_status == 'Gagal')
                                        <i class="text-red-600 fa-solid fa-circle"></i>
                                    @endif
                                    <p class="font-bold">
                                        {{ $history->order_status }}
                                        {{-- @if ($history->order_status == 'Berhasil')
                                            {{ 'Online' }}
                                        @else {{ $history->order_status }}
                                        @endif --}}
                                    </p>
                                </div>
                            </td>
                            <td>
                                <div class="flex justify-center w-full">
                                    <button class="border-2 border-secondaryColor rounded-md hover:bg-transparent hover:text-secondaryColor font-bold px-4 py-1 bg-secondaryColor text-white duration-300 transition-colors ease-in-out"
                                    type="button" onclick="toggleDetail({{ $index }})" data-index="{{ $index }}">Lihat</button>
                                </div>
                             @php $i++; @endphp

                                {{-- MODAL DETAIL RIWAYAT TRANSAKSI START --}}
                                <div class="fixed w-full h-screen top-0 left-0 flex justify-center items-center backdrop-brightness-75 z-10 hidden" id="detailModal{{ $index }}">                                    
                                    <div class="w-[70%] h-fit max-h-full bg-white rounded-md shadow-md p-8 flex flex-col gap-6 overflow-auto">
                                        <div class="flex justify-between items-center">
                                            <button onclick="toggleDetail({{ $index }})" type="button" class="bg-mainColor py-1 px-4 text-white font-semibold rounded-md">
                                                <i class="fa-solid fa-arrow-left"></i>
                                                Kembali
                                            </button>
    
                                            <p class="font-bold">{{ $history->invoice_code }}</p>
    
                                            <div class="flex gap-2 items-center">
                                                {{-- GREEN = BERHASIL, YELLOW = REFUND, RED = GAGAL --}}
                                                @if ( $history->order_status == 'Berhasil' || $history->order_status == 'Offline')
                                                <i class="text-green-600 fa-solid fa-circle"></i>
                                                @elseif ($history->order_status == 'Refund')
                                                    <i class="text-yellow-600 fa-solid fa-circle"></i>
                                                @elseif ($history->order_status == 'Gagal')
                                                    <i class="text-red-600 fa-solid fa-circle"></i>
                                                @endif
                                                <p class="font-bold">{{ $history->order_status }}</p>
                                            </div>
                                        </div>
                                        <div class="px-8 py-2 w-[100%] flex justify-between">
                                            <div class="w-[70%]">
                                                <div class="flex flex-col gap-8">
                                                    <table class="w-full">
                                                        <tr class="border-2 border-b-mainColor border-transparent text-mainColor font-bold w-[100%]">
                                                            <td class="w-[10%] pb-2 text-center">No</td>
                                                            <td class="w-[30%] pb-2">Nama</td>
                                                            <td class="w-[10%] pb-2 text-center">Jumlah</td>
                                                            <td class="w-[25%] pb-2 text-center">Harga</td>
                                                            <td class="w-[25%] pb-2">Total</td>
                                                        </tr>
                                                            @php $j = 1; @endphp
                                                        @foreach($history->sellingInvoiceDetail as $invoice)
                                                        <tr>
                                                            <td class="py-2 text-center">{{ $j }}</td>
                                                            <td class="py-2">{{ $invoice->product_name }}</td>
                                                            <td class="py-2 text-center">{{ $invoice->quantity }}</td>
                                                            <td class="py-2 text-center">Rp {{ number_format($invoice->product_sell_price, 0, ',', '.') }}</td>
                                                            <td class="py-2">Rp {{ number_format($invoice->quantity * $invoice->product_sell_price, 0, ',', '.')}}</td>
                                                        </tr>
                                                            @php $j++ @endphp
                                                        @endforeach
                                                    </table>
                                                </div>
    
                                                <div class="flex flex-col gap-2 py-2">
                                                    <hr class="border-2 border-transparent border-b-mainColor">
                                                    <div class="flex font-bold gap-2">
                                                        <p class="w-28">Total Harga</p>
                                                        <p>:</p>
                                                        <p class="text-secondaryColor">
                                                            Rp {{ number_format($totalPrice, 0, ',', '.') }}
                                                        </p>
                                                    </div>
                                                    <div class="flex font-bold gap-2">
                                                        <p class="w-28">Kasir</p>
                                                        <p>:</p>
                                                        <p class="text-mainColor">{{ $history->cashier_name }}</p>
                                                    </div>
                                                    {{-- ALASAN GAGAL KALAU ADA --}}
                                                    @if($history->order_status == 'Gagal')
                                                        <div class="flex font-bold gap-2">
                                                            <p class="w-28">Alasan Gagal</p>                                
                                                            <p>:</p>
                                                            <p class="text-mainColor">{{ $history->reject_comment }}</p>
                                                        </div>
                                                    @else 
                                                        <div></div>
                                                    @endif
                                                </div>
                                            </div>
    
                                            <div class="w-[25%]">
                                                <p class="text-center font-bold text-mainColor pb-2">Keterangan</p>
                                                <hr class="border-2 border-transparent border-b-mainColor">
                                                <div class="py-2">
                                                    <p class="font-bold">Pelanggan :</p>
                                                    <p>{{ $history->recipient_name }}</p>
                                                    <p class="font-bold">Nomor HP :</p>
                                                    <p>{{ $history->recipient_phone }}</p>
                                                    <p class="font-bold">Tanggal Selesai :</p>
                                                    <p>{{ date('d M Y',strtotime($history->order_complete)) }}</p>
                                                    <p class="font-bold">Metode Pembayaran :</p>
                                                    <p>{{ $history->recipient_bank }}</p>
                                                    <p class="font-bold">Bukti Pembayaran :</p>
                                                    <a href="/cashier/informasi_pembayaran/{{ $history->recipient_payment }}" target="_blank" class="text-blue-600 underline">{{ $history->recipient_payment }}</a>
                                                    <p class="font-bold">Catatan :</p>
                                                    <p>{{ $history->recipient_request }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- MODAL DETAIL RIWAYAT TRANSAKSI END --}}
                            </td>
                        </tr>
                        @php $index++ @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    {{-- DATATABLES SCRIPT --}}
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/datatables.js') }}"></script>

    <script>
        const toggleDetail = (index) => {
            const modal = document.getElementById('detailModal' + index);

            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden');
            } else {
                modal.classList.add('hidden');
            }
        };
    </script>
</body>
</html>