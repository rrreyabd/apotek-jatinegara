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
            <a href="javascript:history.back()" class="p-3 px-4 rounded-full bg-mainColor w-fit">
                <i class="fa-solid fa-arrow-left" style="color: white;"></i>
            </a>

            <p class="text-3xl font-TripBold my-3 mt-8">Detail Produk</p>

            {{-- container --}}
            @php
                $uuid = $product->product_id;

                $numericValue = hexdec(substr($uuid, -12));

                $formatted = 'P-' . str_pad($numericValue, 4, '0', STR_PAD_LEFT);
            @endphp
            <div class="rounded-lg shadow-lg w-full bg-white h-fit md:p-16 md:px-24 p-3 overflow-x-auto">
                <p class="text-3xl font-TripBold my-5 flex justify-center">{{ $formatted }}</p>

                <div class="sm:flex sm:grid-cols-3 md:gap-20 gap-3">
                    {{-- gambar obat --}}
                    <div class="sm:w-1/6 mb-7 border-2 border-black rounded-lg h-fit">
                        <img src="{{ asset('img/Pencernaan.png/') }}" alt="" class="w-full p-5">
                        <p class="font-TripBold flex justify-center py-3 rounded-b-lg border-t-2">{{ $product->product_name }}</p>
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
                                    $carbonDate = \Carbon\Carbon::parse( $product->detail()->orderBy('product_expired')->first()->product_expired);
                                    $formattedDate = $carbonDate->format('j F Y');
                                @endphp
                                <tr>
                                    <td class="py-1">Expired Obat</td>
                                    <td>: {{ $formattedDate }}</td>
                                </tr>
                                <tr>
                                    <td class="py-1">Stok Obat</td>
                                    <td>: {{ $product->detail()->orderBy('product_expired')->first()->product_stock }}</td>
                                </tr>
                                <tr>
                                    <td class="py-1">Tipe Obat</td>
                                    <td>: {{ $product->description->product_type }}</td>
                                </tr>
                                <tr>
                                    <td class="py-1">Harga Beli Obat</td>
                                    <td>: {{ $product->detail()->orderBy('product_expired')->first()->product_buy_price }}</td>
                                </tr>
                                <tr>
                                    <td class="py-1">Harga Jual Obat</td>
                                    <td>: {{ $product->detail()->orderBy('product_expired')->first()->product_sell_price }}</td>
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
            </div>
        </div>
    </div>
</body>
</html>