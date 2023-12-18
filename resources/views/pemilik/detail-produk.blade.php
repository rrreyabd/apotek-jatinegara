<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pemilik Apotek | Produk</title>
    @vite('resources/css/app.css')

    {{-- FONT AWESOME --}}
    <script src="https://kit.fontawesome.com/e87c4faa10.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1fc4ea1c6a.js" crossorigin="anonymous"></script>

</head>

<body class="font-Trip bg-[#DEDEDE]">
    <div class="flex flex-col mb-8">
        <div class="p-10 flex flex-col">

            {{-- back button --}}
            <a href="/owner/produk" class="p-3 px-4 rounded-full bg-mainColor w-fit">
                <i class="fa-solid fa-arrow-left" style="color: white;"></i>
            </a>

            <p class="text-3xl font-TripBold my-3 mt-8">Detail Produk</p>

            @if (session('success'))
                    <div class="absolute top-4 left-[42.5vw] bg-mainColor shadow-md w-[25vw] h-14 z-20 gap-2 items-center px-4 animate-notif opacity-0 justify-center rounded-md flex unselectable">
                        <i class="text-white fa-solid fa-circle-check"></i>
                        <p class="text-lg text-white font-semibold"> {{ session('success') }} </p>
                    </div>
                @endif
                @if (session('error'))
                    <div class="absolute top-4 left-[42.5vw] bg-red-600 shadow-md w-[15vw] h-14 z-20 gap-2 items-center px-4 animate-notif opacity-0 justify-center rounded-md flex unselectable">
                        <i class="text-white fa-solid fa-triangle-exclamation"></i>
                        <p class="text-lg text-white font-semibold"> {{ session('error') }} </p>
                    </div>
                @endif

            @foreach ($product->detail as $detail)
            {{-- container --}}
            <div class="mb-10 rounded-lg shadow-lg w-full bg-white h-fit md:p-16 md:px-24 p-3 overflow-x-auto">
                <p class="text-3xl font-TripBold my-5 flex justify-center">{{ $product->product_name }}</p>

                <div class="sm:flex sm:grid-cols-3 md:gap-20 gap-3">
                    {{-- gambar obat --}}
                    <div class="sm:w-1/6 mb-7 border-2 border-black rounded-lg h-fit">
                        @if (file_exists(public_path('storage/gambar-obat/' . $product->description->product_photo)) && $product->description->product_photo !== NULL)
                            <img src="{{ asset('storage/gambar-obat/' . $product->description->product_photo) }}" alt="" class="w-full p-5">
                        @else
                            <img src="{{ asset('img/Pencernaan.png') }}" alt="" class="w-full p-5">
                        @endif
                        <p class="font-TripBold flex justify-center py-3 rounded-b-lg border-t-2 text-center">{{ $product->product_name }}</p>
                    </div>

                    {{-- detail obat --}}
                    <div class="1/3">
                        <p class="font-TripBold text-lg">Detail Obat:</p>
                        
                            <table>
                                <tr>
                                    <td class="py-1">Status Obat</td>
                                    <td>: {{ $product->product_status }}</td>
                                </tr>
                                @php
                                    $carbonDate = \Carbon\Carbon::parse( $detail->product_expired);
                                    $formattedDate = $carbonDate->format('j F Y');
                                @endphp
                                <tr>
                                    <td class="py-1">Expired Obat</td>
                                    <td>: {{ $formattedDate }}</td>
                                </tr>
                                <tr>
                                    <td class="py-1">Stok Obat</td>
                                    <td>: {{ $detail->product_stock }}</td>
                                </tr>
                                <tr>
                                    <td class="py-1">Tipe Obat</td>
                                    <td>: {{ $product->description->product_type }}</td>
                                </tr>
                                <tr>
                                    <td class="py-1">Harga Beli Obat</td>
                                    <td>: {{ number_format($detail->product_buy_price,0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td class="py-1">Harga Jual Obat</td>
                                    <td>: {{ number_format($product->product_sell_price, 0, ',', '.') }}</td>
                                </tr>
                            </table>
                    </div>
                    <div class="w-1/3">
                            <table class="mt-7">
                                <tr>
                                    <td class="py-1">Kategori Obat</td>
                                    <td>: {{ $product->description->category->category }}</td>
                                </tr>
                                <tr>
                                    <td class="py-1">Golongan Obat</td>
                                    <td>: {{ $product->description->group->group }}</td>
                                </tr>
                                <tr>
                                    <td class="py-1">Satuan Obat</td>
                                    <td>: {{ $product->description->unit->unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-1">NIE Obat</td>
                                    <td>: {{ $product->description->product_DPN }}</td>
                                </tr>
                                <tr>
                                    <td class="py-1">Pemasok Obat</td>
                                    <td>: {{ $product->description->supplier->supplier }}</td>
                                </tr>
                                <tr>
                                    <td class="py-1">Produksi dari</td>
                                    <td>: {{ $product->description->product_manufacture }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    {{-- deskripsi obat --}}
                    <div class="w-full my-2">
                        <p class="font-TripBold text-lg">Deskripsi Obat:</p>
                        <p class="text-lg">{{ $product->description->product_description }}</p>
                    </div>

                    <div class="w-full my-2">
                        <p class="font-TripBold text-lg">Dosis Obat:</p>
                        <p class="text-lg">{{ $product->description->product_dosage }}
                        </div>
                    @if ($product->description->product_notice != NULL)
                    <div class="w-full my-2">
                        <p class="font-TripBold text-lg">Peringatan Obat:</p>
                        <p class="text-lg">{{ $product->description->product_notice }}</p>
                    </div>
                    @else
                    
                    @endif

                    <div class="w-full my-2">
                        <p class="font-TripBold text-lg">Efek Samping Obat:</p>
                        <p class="text-lg">{{ $product->description->product_sideEffect }}</p>
                    </div>
                    @if ($product->description->product_indication != NULL)
                        <div class="w-full my-2">
                            <p class="font-TripBold text-lg">Indikasi Umum Obat:</p>
                            <p class="text-lg">{{ $product->description->product_indication }}</p>
                        </div>
                    @endif
                    @if (\Carbon\Carbon::parse($detail->product_expired)->lte(\Carbon\Carbon::now()->addMonths(3)))
                        @if ($detail->where('product_id', $detail->product_id)->count() > 1)
                            <form action="{{ route('hapus-expired') }}" method="POST">
                                @csrf
                                <input type="hidden" name="detail_id" value="{{ $detail->detail_id }}">
                                <div class="flex mt-10">
                                    <button type="submit" class="bg-red-500 ms-auto rounded-md px-5 py-2 font-bold text-white">
                                        Hapus Produk Expired
                                    </button>
                                </div>
                            </form>
                        @elseif ($product->product_status == 'tidak aktif')
                        <div class="flex mt-10">
                            <p class="bg-red-500 ms-auto rounded-md px-5 py-2 font-bold text-white">
                                Silahkan Beli Obat Baru Untuk Membuka Status Obat Menjadi Aktif!
                            </p>
                        </div>
                        @endif
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </body>
    </html>