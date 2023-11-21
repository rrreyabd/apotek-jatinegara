<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Apotek | Produk</title>
    @vite('resources/css/app.css')
    @livewireStyles

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
                <a href="/produk"
                    class="flex justify-start items-center rounded-3xl shadow-md h-[40px] px-3 text-center text-lg text-gray-500 font-semibold">
                    <svg xmlns="http://www.w3.org/2000/svg" class="pe-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M9 14l-4 -4l4 -4"></path>
                        <path d="M5 10h11a4 4 0 1 1 0 8h-1"></path>
                    </svg>
                    Kembali</a>
            </div>

            <div class="md:flex gap-8 md:grid-cols-2">
                {{-- product --}}
                <div class="md:w-1/2 p-5">
                    <img src="{{ asset('img/obat1.jpg/') }}" alt="">
                </div>

                <div class="p-2 md:w-1/2">
                    @if ($description_product->product_type == "resep dokter")
                    <span class="bg-red-500 rounded-md px-2 py-1 text-white text-sm font-semibold">Resep</span>
                    @endif
                    <p class="font-semibold text-2xl my-3">{{ $description_product->product_name }}</p>
                    <p class="font-semibold text-2xl text-orange-400 my-2">Rp {{ number_format($description_product->product_sell_price, 0, ',', '.') }} <span class="text-black text-base">/ {{ $description_product->unit }}</span></p>
                    <p class="text-lg my-3 text-gray-500">
                        {{$description_product->product_description}}
                    </p>
                    <p class="text-lg my-1">
                        Stok : {{ $description_product->product_stock }}
                    </p>
                    @auth
                    <livewire:counter-product :stock="$description_product->product_stock" :user="auth()->user()->user_id" :product="$description_product->product_id" :status="$description_product->product_status"/>
                    @if (session('error'))
                        <div class="text-sm text-red-500 mt-1 ms-3 mb-0 text-left">
                            * {{ session('error') }}
                        </div>
                    @endif
                    @else
                    <div class="flex items-center gap-8 mt-8">
                    <i class="fa-solid fa-triangle-exclamation fa-2xl text-mediumRed"></i>
                    <p class="text-mediumRed text-lg font-medium">Mohon untuk <a href="/login" class="underline font-bold">login</a> terlebih dahulu sebelum melakukan pemesanan produk.</p>
                    </div>
                    @endauth
                </div>
            </div>
            
            {{-- line --}}
            <div class="w-fill shadow border border-neutral-200"></div>

            <div class="gap-8 md:grid-cols-2 py-7">
                <div class="flex items-start">
                    <p class="  rounded-lg p-1 px-4 mb-5 text-white text-lg font-semibold bg-mainColor">Detail Produk</p>
                </div>

                <table>
                    <tr>
                        <td class="pt-5 w-1/6">Manufaktur</td> 
                        <td class="pt-5">:</td>
                        <td class="pt-5 ps-5">{{ $description_product->product_manufacture }}</td>
                    </tr>
                    <tr>
                        <td class="pt-5">Golongan Obat</td> 
                        <td class="pt-5">:</td>
                        <td class="pt-5 ps-5">{{ $description_product->group }}</td>
                    </tr>
                    <tr>
                        <td class="pt-5">Kategori Obat</td> 
                        <td class="pt-5">:</td>
                        <td class="pt-5 ps-5">{{ $description_product->category }}</td>
                    </tr>
                    <tr>
                        <td class="pt-5">Tanggal Kadaluwarsa</td>
                        <td class="pt-5">:</td>
                        <td class="pt-5 ps-5">{{ date('d F Y',strtotime($description_product->product_expired)) }}</td>
                    </tr>
                    <tr>
                        <td class="pt-5">No. Izin Edar (BPOM)</td>
                        <td class="pt-5">:</td>
                        <td class="pt-5 ps-5">{{ $description_product->product_DPN }}</td>
                    </tr>
                    <tr>
                        <td class="pt-5">Efek Samping</td>
                        <td class="pt-5">:</td>
                        <td class="pt-5 ps-5">{{ $description_product->product_sideEffect }}</td>
                    </tr>
                </table>
            </div>

            {{-- line --}}
            <div class="w-fill shadow border border-neutral-200"></div>

            <div class="gap-8 md:grid-cols-2 py-4">
                <div class="pb-2">
                    <div class="flex items-start">
                        <p class="rounded-lg py-1 px-4 text-white text-lg font-semibold bg-mainColor">Dosis</p>
                    </div>
                    <p class="py-3 text-mediumGrey ms-5">{{$description_product->product_dosage}}
                    </p>
                </div>
                @if ($description_product->product_indication)
                <div class="pb-2">
                    <div class="flex items-start">
                        <p class="rounded-lg p-1 px-4 text-white text-lg font-semibold bg-mainColor">Indikasi Umum</p>
                    </div>
                    <p class="py-3 text-mediumGrey ms-5">{{$description_product->product_indication }}</p>
                </div>
                @endif

                @if ($description_product->product_notice)
                <div class="py-2">
                    <div class="flex items-start">
                        <p class="rounded-lg p-1.5 px-4 text-white text-lg font-semibold bg-mainColor">Perhatian</p>
                    </div>
                    <p class="py-3 text-gray-500 ms-5">{{$description_product->product_notice}}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
    @include('user.components.footer')
    @livewireScripts
</body>

</html>