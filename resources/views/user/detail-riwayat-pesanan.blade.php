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

<body class="font-Trip">
    @include('user.components.navbar')

    
    <div class="flex flex-col items-center mb-8">

        <div class="w-[70vw] mt-8 flex flex-col">
            <div class="flex gap-4">
                {{-- back button --}}
                <a href="/riwayat-pesanan"
                class="flex justify-start items-center rounded-3xl shadow-md h-[40px] px-3 text-center text-lg text-gray-500 font-semibold">
                <svg xmlns="http://www.w3.org/2000/svg" class="pe-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M9 14l-4 -4l4 -4"></path>
                    <path d="M5 10h11a4 4 0 1 1 0 8h-1"></path>
                </svg>
                Kembali</a>
            </div>
            <p class="my-7 mb-3 text-3xl font-semibold">Detail Pesanan - {{ $purcase->invoice_code }}</p>
            
            <div class="flex gap-6 items-center">
                <p class="w-fit rounded-lg p-1.5 px-4 
                @if($purcase->order_status == 'Berhasil') 
                    bg-green-700
                @elseif($purcase->order_status == 'Menunggu Pengembalian' || $purcase->order_status == 'Menunggu Konfirmasi' || $purcase->order_status == 'Menunggu Pengambilan')
                bg-secondaryColor
                @elseif($purcase->order_status == 'Gagal' || $purcase->order_status == 'Refund')
                bg-red-500
                @endif
                    text-white font-semibold">{{ $purcase->order_status }}</p>

                @if ($purcase->order_status == 'Berhasil')
                    {{-- masuk ke halaman struk --}}
                    <a target="_blank" href="/cetak-struk/{{ $purcase->selling_invoice_id }}" class="underline me-1 text-lg">
                        <i class="fa-solid fa-note-sticky"></i>
                        {{ $purcase->invoice_code }}
                    </a>
                    @elseif ($purcase->order_status == 'Refund')
                    {{-- keluarin gambar --}}
                    <a href="/refund/{{ $purcase->refund_file }}/{{ $purcase->selling_invoice_id }}" class="underline me-1 text-lg">
                        <i class="fa-solid fa-note-sticky"></i>
                        Refund_{{ $purcase->invoice_code }}
                    </a>
                @endif
            </div>
            <p class="my-7 mb-3 text-xl font-semibold">Informasi Pesanan</p>

            <div class="bg-tertiaryColor rounded-lg">
                <div class="flex grid-cols-3 gap-4 justify-between p-5 overflow-x-auto">
                    <div>
                        <p>Tanggal Pemesanan : {{ date('d M Y',strtotime($purcase->order_date)) }}</p>
                        <p class="my-2">No. Handphone : {{ $purcase->recipient_phone }}</p> 
                        <p>Resep Dokter : 
                        @if ($purcase->recipient_file)
                            <a class="underline" href="/resep_dokter/{{ $purcase->recipient_file }}/{{ $purcase->selling_invoice_id }}">{{ $purcase->recipient_file }}</a>
                        @endif</p>
                        </div>
                    <div>
                        <p>Nama Penerima : {{ $purcase->recipient_name }}</p> 
                        <p class="my-2">Batas Pengambilan : {{ date('d M Y',strtotime($purcase->order_date . '3 days ')) }}</p>
                        <p>Tanggal Pengambilan : {{ date('d M Y',strtotime($purcase->order_complete)) }}</p>
                    </div>
                    <div class="w-1/3">
                        <p>Catatan Tambahan</p>
                        <div class="bg-white shadow-lg rounded-lg p-2 mt-1 overflow-y-scroll h-16">{{ $purcase->recipient_request ?? "-" }}</div>
                    </div>
                </div>
            </div>

            <div class="sm:flex my-7 mb-3 text-xl ">
            <p class="font-semibold me-2">Informasi Pembayaran:</p>
            <a href="/informasi_pembayaran/{{ $purcase->recipient_payment }}/{{ $purcase->selling_invoice_id }}" class="underline me-1 text-lg">
                <i class="fa-solid fa-note-sticky"></i>
                {{ $purcase->recipient_payment }}</a>
                <p class="text-lg">({{ $purcase->recipient_bank }})</p>
            </div>

            @if ($purcase->reject_comment)
            <div class="sm:flex sm:grid-col-2 my-5">
                <p class="text-xl font-semibold me-2 w-1/5">Alasan Penolakan:</p>
                <div class="shadow-md w-4/5 p-2 rounded-lg min-h-[80px]">
                    {{ $purcase->reject_comment }}
                </div>
            </div>
            @endif
            
            <p class="text-xl font-semibold me-2 w-1/4 mt-4">Daftar Pesanan:</p>

            {{-- table --}}
            <div class="shadow-lg rounded-lg w-full h-fit my-3">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-mainColor text-white">
                            <tr>
                                <th class="p-3 rounded-tl-lg" scope="col">Nama Produk</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Kuantitas</th>
                                <th class="p-3 rounded-tr-lg max-w-1/5" scope="col">Total Harga</th>
                            </tr>
                        </thead>

                        <tbody class="border-t">
                            @php
                                $totalHarga = 0;
                            @endphp
                            @foreach ($detail_products as $detail)
                            <tr>
                                <th class="py-2" scope="row">
                                    <p>{{ $detail->product_name }}</p>
                                </th>
                                <th>
                                    <p>Rp {{ number_format($detail->product_sell_price , 0, ',', '.') }}</p>
                                </th>
                                <th>
                                    <p class="text-lg">{{ $detail->quantity }}</p>
                                </th>
                                <th>
                                    <p class="text-lg">Rp {{ number_format($detail->product_sell_price * $detail->quantity , 0, ',', '.') }}</p>
                                </th>
                            </tr>
                            @php
                                $totalHarga += $detail->product_sell_price * $detail->quantity
                            @endphp
                            @endforeach
                        </tbody>
                        <tfoot class="border-t">
                            <tr class="bg-tertiaryColor">
                                <th></th>
                                <th></th>
                                <th></th>
                                <th class="py-2">Total Belanja : Rp. {{ number_format($totalHarga , 0, ',', '.') }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

        </div>
    </div>
    @include('user.components.footer')
</body>

</html>