<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kasir | Pesanan Online</title>
    @vite('resources/css/app.css')

    {{-- FONT AWESOME --}}
    <script src="https://kit.fontawesome.com/e87c4faa10.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1fc4ea1c6a.js" crossorigin="anonymous"></script>

    {{-- DATATABLES --}}
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <style>
        textarea {
            min-height: 300px; 
            resize: vertical; 
        }
    </style>
</head>
<body class="font-Inter relative">
    @include("kasir.components.sidebar")
    <main class="p-10 font-Inter bg-plat min-h-[100vh] h-full" id="mainContent">
        @include("kasir.components.navbar")

        <div class="flex flex-col gap-8 mt-10">
            <p class="text-3xl font-bold">Pesanan Online</p>

            @if (session('success'))
                <div class="absolute top-4 left-[42.5vw] bg-mainColor shadow-md w-[25vw] h-14 z-20 gap-2 items-center px-4 animate-notif opacity-0 justify-center rounded-md flex unselectable">
                    <i class="text-white fa-solid fa-circle-check"></i>
                    <p class="text-lg text-white font-semibold"> {{ __('Status Berhasil Diperbaharui') }} </p>
                </div>
            @endif
            @if (session('error'))
                <div class="absolute top-4 left-[42.5vw] bg-red-600 shadow-md w-[15vw] h-14 z-20 gap-2 items-center px-4 animate-notif opacity-0 justify-center rounded-md flex unselectable">
                    <i class="text-white fa-solid fa-triangle-exclamation"></i>
                    <p class="text-lg text-white font-semibold"> {{ __('Terjadi Kesalahan') }} </p>
                </div>
            @endif
    
        @error('alasanTolak')
            <div class="text-md font-bold text-red-500 mt-1 ms-3 mb-0 text-left">
                {{ $message }}
            </div>
        @enderror
        @error('alasanRefund')
            <div class="text-md font-bold text-red-500 mt-1 ms-3 mb-0 text-left">
                {{ $message }}
            </div>
        @enderror

            <div class="bg-white rounded-lg p-4 shadow-md">
                <table id="myTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nomor Invoice</th>
                            <th>Nama Pengambil</th>
                            <th>Nomor HP</th>
                            <th>Metode Pembayaran</th>
                            <th>Bukti Transfer</th>
                            <th>Total</th>
                            <th>Detail Pesanan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1;  @endphp
                        @php $index = 1;  @endphp
                        @foreach ($onlineOrders as $order)                
                        <tr>
                            <td>{{$i}}</td>
                            <td><span class="font-bold">{{ $order->invoice_code }}</span></td>
                            <td>
                                {{ $order->recipient_name }}
                            </td>
                            <td>{{ $order->recipient_phone }}</td>
                            <td>{{ $order->recipient_bank }}</td>
                            <td>
                                <a href="/cashier/informasi_pembayaran/{{ $order->recipient_payment }}" target="_blank" class="text-blue-600 underline">{{ $order->recipient_payment }}</a>
                            </td>
                            <td>
                                @php
                                    $totalPrice = 0; // Initialize the variable to store the total price
                                @endphp
                                @foreach ($order->sellingInvoiceDetail as $detail)
                                    @php
                                    $totalPrice = $totalPrice + ($detail->product_sell_price * $detail->quantity); // Accumulate the price
                                    @endphp
                                @endforeach
                                <p class="font-bold">Rp {{ number_format($totalPrice, 0, ',', '.') }}</p>
                            </td>
                            <td>
                                <div class="flex justify-center w-full">
                                    <button class="border-2 border-secondaryColor rounded-md hover:bg-transparent hover:text-secondaryColor font-bold px-4 py-1 bg-secondaryColor text-white duration-300 transition-colors ease-in-out" 
                                    type="button" onclick="toggleDetail({{ $index }})">Lihat</button>
                                </div>

                                {{-- MODAL DETAIL PESANAN ONLINE START --}}
                                <div class="absolute w-full h-[100%] top-0 left-0 flex justify-center items-center backdrop-brightness-75 z-10 py-8 hidden" id="detailModal{{ $index }}">
                                    <div class="w-[70%] h-fit max-h-full bg-white rounded-md shadow-md p-8 flex flex-col gap-6 overflow-auto">
                                        <div class="flex justify-start items-center">
                                            <button onclick="toggleDetail({{ $index }})" type="button" class="bg-mainColor py-1 px-4 text-white font-semibold rounded-md">
                                                <i class="fa-solid fa-arrow-left"></i>
                                                Kembali
                                            </button>
                                        </div>
    
                                        <div class="px-8 py-2 w-[100%] flex justify-between">
                                            <div class="w-[70%]">
                                                <div class="flex flex-col gap-8">
                                                    <div class="overflow-y-auto h-96">
                                                        <table class="w-full h-fit max-h-[20px] overflow-scroll">
                                                            <tr class="border-2 border-b-mainColor border-transparent text-mainColor font-bold w-[100%]">
                                                                <td class="w-[10%] pb-2 text-center">No</td>
                                                                <td class="w-[30%] pb-2">Nama</td>
                                                                <td class="w-[10%] pb-2 text-center">Jumlah</td>
                                                                <td class="w-[25%] pb-2 text-center">Resep Dokter</td>
                                                            </tr>
                                                            @php $j = 1; @endphp
                                                            @foreach ($order->sellingInvoiceDetail as $detail)              
                                                            <tr>
                                                                <td class="py-2 text-center">{{ $j }}</td>
                                                                <td class="py-2">{{ $detail->product_name }}</td>
                                                                <td class="py-2 text-center">{{ $detail->quantity }}</td>
                                                                <td class="py-2 text-center">{{ $detail->product_type }}</td>
                                                            </tr>
                                                            @php $j++ @endphp
                                                            @endforeach
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
    
                                            <div class="w-[25%] flex flex-col justify-between gap-8">
                                                <div class="">
                                                    <p class="text-center font-bold text-mainColor pb-2">Catatan</p>
                                                    <hr class="border-2 border-transparent border-b-mainColor">
                                                    <p>{{ $order->recipient_request }}</p>
                                                </div>
    
                                                <div class="">
                                                    <p class="text-center font-bold text-mainColor pb-2">Resep Dokter</p>
                                                    <hr class="border-2 border-transparent border-b-mainColor">
                                                    <div class="mt-2">
                                                        <a href="/cashier/resep_dokter/{{ $order->recipient_file }}" target="_blank" class="text-blue-600 underline">{{ $order->recipient_file }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
    
                                        <div class="flex justify-between">
                                            <button onclick="modalTolak({{ $index }})" class="bg-red-600 font-semibold text-xl text-white px-8 py-1 rounded-md">Tolak</button>
                                            <button onclick="modalRefund({{ $index }})" class="bg-yellow-500 font-semibold text-xl text-white px-8 py-1 rounded-md">Refund</button>
                                            <button onclick="modalTerima({{ $index }})" class="bg-green-600 font-semibold text-xl text-white px-8 py-1 rounded-md">Terima</button>
                                        </div>
                                    </div>
                                </div>
                                {{-- MODAL DETAIL PESANAN ONLINE END --}}
    
                                {{-- MODAL TOLAK START --}}
                                <div class="absolute w-full h-[100%] top-0 left-0 flex justify-center items-center backdrop-brightness-50 z-10 hidden" id="modalTolak{{ $index }}">
                                    <div class="w-[30%] h-fit max-h-full bg-white rounded-md shadow-md p-8 flex flex-col gap-8 overflow-auto items-center text-center">
                                        <i class="text-red-600 text-6xl fa-solid fa-exclamation"></i>
                                        
                                        <div class="text-center flex items-center flex-col gap-2">
                                            <p class="font-bold text-2xl w-[80%]">Apakah Anda Yakin Ingin <span class="text-mainColor">Menolak</span> Pesanan {{ $order->recipient_name }}?</p>
                                            
                                            <p class="text-red-600 font-semibold w-[80%] text-sm">Penolakan Pesanan Hanya Dilakukan Di Kondisi Tertentu</p>
                                        </div>
    
                                        <div class="flex justify-between w-[70%]">
                                            <button onclick="modalTolak({{ $index }})" type="button" class="bg-green-600 w-[8rem] px-8 py-2 font-semibold text-xl text-white rounded-md">Tidak</button>
                                            <form action="">
                                                @csrf
                                                <button type="button" onclick="modalAlasanTolak({{ $index }})" class="bg-red-600 w-[8rem] px-8 py-2 font-semibold text-xl text-white rounded-md">Ya</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- MODAL TOLAK END --}}
    
                                {{-- MODAL TERIMA START --}}
                                <div class="absolute w-full h-[100%] top-0 left-0 flex justify-center items-center backdrop-brightness-50 z-10 hidden" id="modalTerima{{ $index }}">
                                    <div class="w-[30%] h-fit max-h-full bg-white rounded-md shadow-md p-8 flex flex-col gap-8 overflow-auto items-center text-center">
                                        <i class="text-green-600 text-6xl fa-solid fa-exclamation"></i>
                                        
                                        <div class="text-center flex items-center flex-col gap-2">
                                            <p class="font-bold text-2xl w-[80%]">Apakah Anda Yakin Ingin <span class="text-mainColor">Menerima</span> Pesanan {{ $order->recipient_name }}?</p>
                                        </div>
    
                                        <div class="flex justify-between w-[70%]">                                            
                                            <button onclick="modalTerima({{ $index }})" type="button" class="bg-red-600 w-[8rem] px-8 py-2 font-semibold text-xl text-white rounded-md">Tidak</button>
                                            <form action="{{ route('updateStatus', $order->selling_invoice_id) }}" method="post">
                                                @csrf
                                                <input type="hidden" name="status" value="terima">
                                                <button type="submit" class="bg-green-600 w-[8rem] px-8 py-2 font-semibold text-xl text-white rounded-md">Ya</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- MODAL TERIMA END --}}
    
                                {{-- MODAL REFUND START --}}
                                <div class="absolute w-full h-[100%] top-0 left-0 flex justify-center items-center backdrop-brightness-50 z-10 hidden" id="modalRefund{{ $index }}">
                                    <div class="w-[30%] h-fit max-h-full bg-white rounded-md shadow-md p-8 flex flex-col gap-8 overflow-auto items-center text-center">
                                        <i class="text-yellow-600 text-6xl fa-solid fa-exclamation"></i>
                                        
                                        <div class="text-center flex items-center flex-col gap-2">
                                            <p class="font-bold text-2xl w-[80%]">Apakah Anda Yakin Ingin <span class="text-mainColor">Mengembalikan</span> Pesanan {{ $order->recipient_name }}?</p>
                                        </div>
    
                                        <div class="flex justify-between w-[70%]">
                                            <button onclick="modalRefund({{ $index }})" type="button" class="bg-green-600 w-[8rem] px-8 py-2 font-semibold text-xl text-white rounded-md">Tidak</button>
                                            <form action="">
                                                @csrf
                                                <button type="button" onclick="modalAlasanRefund({{ $index }})" class="bg-red-600 w-[8rem] px-8 py-2 font-semibold text-xl text-white rounded-md">Ya</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- MODAL REFUND END --}}
    
    
                                {{-- MODAL ALASAN TOLAK START --}}
                                <div class="absolute w-full h-[100%] top-0 left-0 flex justify-center items-center backdrop-brightness-50 z-20 hidden" id="alasanTolak{{ $index }}">
                                    <div class="w-[30%] h-fit max-h-full bg-white rounded-md shadow-md p-8 flex flex-col gap-8 overflow-auto items-center text-center">
                                        <p class="text-3xl font-bold text-mainColor">Input Alasan Tolak Pesanan</p>
                                        <form action="{{ route('updateStatus', $order->selling_invoice_id) }}" method="post" class="w-[100%] flex items-center flex-col gap-4">
                                            @csrf
                                            <input type="hidden" name="status" value="tolak">
                                            <textarea name="alasanTolak" id="alasanTolak" rows="10" class="border-2 border-mediumGrey border-opacity-50 rounded-md p-4 w-full"></textarea>
                                            <div class="flex justify-between w-[70%]">
                                                <button onclick="modalAlasanTolak({{ $index }})" type="button" class="bg-red-600 w-[8rem] px-8 py-2 font-semibold text-xl text-white rounded-md">Batal</button>
                                                <button type="submit" class="bg-green-600 w-[8rem] px-8 py-2 font-semibold text-xl text-white rounded-md">Kirim</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                {{-- MODAL ALASAN TOLAK END --}}

                                {{-- MODAL ALASAN REFUND START --}}
                                <div class="absolute w-full h-[100%] top-0 left-0 flex justify-center items-center backdrop-brightness-50 z-20 hidden" id="alasanRefund{{ $index }}">
                                    <div class="w-[30%] h-fit max-h-full bg-white rounded-md shadow-md p-8 flex flex-col gap-8 overflow-auto items-center text-center">
                                        <p class="text-3xl font-bold text-mainColor">Input Alasan Refund Pesanan</p>
                                        <form action="{{ route('updateStatus', $order->selling_invoice_id) }}" method="post" class="w-[100%] flex items-center flex-col gap-4">
                                            @csrf
                                            <input type="hidden" name="status" value="refund">
                                            <textarea name="alasanRefund" id="alasanRefund" rows="10" class="border-2 border-mediumGrey border-opacity-50 rounded-md p-4 w-full"></textarea>
                                            <div class="flex justify-between w-[70%]">
                                                <button onclick="modalAlasanRefund({{ $index }})" type="button" class="bg-red-600 w-[8rem] px-8 py-2 font-semibold text-xl text-white rounded-md">Batal</button>
                                                <button type="submit" class="bg-green-600 w-[8rem] px-8 py-2 font-semibold text-xl text-white rounded-md">Kirim</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                {{-- MODAL ALASAN REFUND END --}}
                            </td>
                        </tr>
                        @php $i++ @endphp
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
                modal.classList.remove('hidden')
            } else {
                modal.classList.add('hidden')
            }
        }

        const modalTolak = (index) => {
            const modal = document.getElementById('modalTolak' + index);

            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden')
            } else {
                modal.classList.add('hidden')
            }
        }

        const modalRefund = (index) => {
            const modal = document.getElementById('modalRefund' + index);

            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden')
            } else {
                modal.classList.add('hidden')
            }
        }

        const modalTerima = (index) => {
            const modal = document.getElementById('modalTerima' + index);

            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden')
            } else {
                modal.classList.add('hidden')
            }
        }

        const modalAlasanRefund = (index) => {
            const modal = document.getElementById('alasanRefund' + index);

            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden')
            } else {
                modal.classList.add('hidden')
            }
        }
        const modalAlasanTolak = (index) => {
            const modal = document.getElementById('alasanTolak' + index);

            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden')
            } else {
                modal.classList.add('hidden')
            }
        }
    </script>
</body>
</html>