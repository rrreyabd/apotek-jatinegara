<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Apotek | Keranjang</title>
    @vite('resources/css/app.css')
    @livewireStyles

    {{-- FONT AWESOME --}}
    <script src="https://kit.fontawesome.com/e87c4faa10.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1fc4ea1c6a.js" crossorigin="anonymous"></script>

    <style>
        tr {
            border-bottom: 1px solid rgba(0, 0, 0, .3);
        }
    </style>
</head>

<body class="font-Inter">
    @include('user.components.navbar')

    <div class="flex flex-col items-center mb-8">

        <div class="w-[70vw] mt-8 flex flex-col">
            <div class="flex gap-4">
                {{-- back button --}}
                <a href="/"
                    class="flex justify-start items-center text-lg text-gray-500 font-semibold">
                    <svg xmlns="http://www.w3.org/2000/svg" class="pe-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M9 14l-4 -4l4 -4"></path>
                        <path d="M5 10h11a4 4 0 1 1 0 8h-1"></path>
                    </svg>
                    <p>Kembali</p>
                </a>
            </div>

            <p class="py-7 text-sm text-red-500">*Jumlah maksimum barang 30</p>

            <div class="md:flex md:grid-cols-2 justify-between">
                <p class="font-semibold text-4xl">Keranjang anda</p>                
                    <button type="button" onclick="cartAlert()" class="rounded-lg flex p-2 border border-mainColor hover:bg-mainColor text-mainColor hover:text-white transition-colors duration-300 ease-in-out">
                        <i class="fa-regular fa-trash-can p-1 pe-2"></i>  
                        <p class="font-semibold">Kosongkan keranjang</p> 
                    </button>
            </div>

            {{-- table --}}
            <div class="rounded-md w-full h-fit my-7">
                <div class="overflow-x-auto py-5">
                    <table class="w-full">
                        <thead class="bg-white">
                            <tr class="bg-mainColor text-white h-[5vh] rounded-tl-md rounded-tr-md">
                                <th>HAPUS</th>
                                <th scope="col">PRODUK</th>
                                <th scope="col">HARGA</th>
                                <th scope="col">JUMLAH</th>
                                <th scope="col">TOTAL</th>
                            </tr>
                        </thead>
                        @php
                            $jumlah = 0;
                        @endphp
                        <tbody class="border-t">
                            @isset($carts)
                            @foreach ($carts as $cart)
                            <tr>
                                <th scope="row" class="w-1/12">
                                    <form action="/keranjang/hapus" method="POST">
                                        @csrf
                                        <input type="hidden" name="hapus" value="satuan">
                                        <input type="hidden" name="cart_id" value="{{ $cart->cart_id }}">
                                        <button type="submit" class="w-[50px] h-[50px]">
                                            <i class="fa-solid fa-trash w-1/8 text-start my-auto text-red-500"></i>
                                        </button>
                                    </form>
                                </th>
                                <th scope="row" class="w-5/12">
                                    <div class="sm:flex sm:grid-cols-3 gap-4 justify-center my-5">
                                        <div class="w-2/5">
                                            @if (file_exists(public_path('storage/gambar-obat/' . $cart->product_photo)) && $cart->product_photo !== NULL)
                                                <img src="{{ asset('storage/gambar-obat/' . $cart->product_photo) }}" alt="" class="w-full">
                                            @else
                                                <img src="{{asset('img/obat1.jpg/')}}" alt="" class="w-full">
                                            @endif
                                        </div>
                                        <div class="w-3/5 text-start flex flex-col gap-1">
                                            <p class="font-semibold text-wrap">{{ $cart->product_name }}</p>
                                            <p class="font-normal">Kategori : {{ $cart->category }}</p> 
                                            <p class="font-normal">Exp : {{ date('d M Y',strtotime($cart->product_expired)) }}</p> 
                                            @if ($cart->product_type == "resep dokter")
                                            <span class="text-sm font-semibold bg-red-500 rounded-md w-fit px-2 py-1 text-white">Resep</span>
                                            @endif
                                        </div>
                                    </div>
                                </th>
                                <th scope="row" class="w-2/12">
                                    <p class="font-semibold text-lg">Rp {{ number_format($cart->product_sell_price , 0, ',', '.') }}</p>
                                </th>
                                <th class="w-2/12">
                                    <div class="sm:flex sm:grid-cols-3 gap-4 justify-center">
                                        <livewire:count-product-cart :price="$cart->product_sell_price" :cart="$cart->cart_id" :stock="$cart->product_stock" :quantity="$cart->quantity" :keranjang="true"/>
                                    </div>
                                </th>
                                <th class="w-2/12">
                                    <livewire:product-price-cart :cart="$cart->cart_id" :totalprice="$cart->total_harga"/>
                                    </th>
                                </tr>
                                @php
                                $jumlah += $cart->total_harga
                                @endphp
                            @endforeach
                            @endisset
                        </tbody>
                    </table>
                </div>
            </div>

            @isset($cart)
                <livewire:product-total-price :user="$cart->user_id" :total="$jumlah" />

                <div class="flex justify-end items-end my-3 me-10">
                    <a href="/booking" class="p-2 px-7 rounded-lg shadow-lg text-white font-semibold bg-secondaryColor hover:bg-orange-400">Booking</a>
                </div>
            @else
                <div class="text-mainColor text-center flex flex-col items-center justify-center px-60 gap-4 h-96">
                    <i class="fa-solid fa-cart-plus text-6xl"></i>
                    <p class="text-center text-2xl font-bold">
                        Keranjang Anda masih kosong. <br>
                        Silahkan masukkan produk ke keranjang.
                    </p>
                </div>

                {{-- <div class="flex justify-end items-end my-3 me-10">
                    <button disabled class="p-2 px-7 rounded-lg shadow-lg text-white font-semibold bg-slate-400">Booking</button>
                </div> --}}
            @endisset

        </div>
    </div>

    <form action="/keranjang/hapus" method="POST" class="w-screen h-screen opacity-0 absolute top-0 backdrop-blur-md z-50 hidden flex justify-center items-center transition duration-300 ease-in-out backdrop-brightness-50" id="cartAlertPopUp">
        @csrf
        <input type="hidden" name="hapus" value="semua">    
        <div class="bg-white h-fit w-[30%] rounded-lg shadow-sm shadow-semiBlack py-10 px-8 flex flex-col gap-4 items-center text-center">
            <i class="text-7xl text-mainColor fa-solid fa-circle-question"></i>
            <p class="text-2xl font-bold w-[80%]">Apakah Anda Yakin Ingin Menghapus Seluruh Data Keranjang ?</p>
            <button onclick="cartAlert()" type="button" class="bg-mainColor px-4 w-52 py-2 text-white font-bold rounded-md shadow-md shadow-semiBlack">Kembali</button>
            <button type="submit" class="bg-mediumRed w-52 px-4 py-2 text-white font-bold rounded-md shadow-md shadow-semiBlack" disabled id="btnCart">Hapus</button>
        </div>
    </form>  

    @include('user.components.footer')
    @livewireScripts
    <script>
        const cartAlert = () => {
        const modals = document.getElementById('cartAlertPopUp');
        const buttons = document.getElementById("btnCart");

        if (modals.classList.contains('hidden')) {
            buttons.disabled = false;
            requestAnimationFrame(() => {
                modals.classList.remove('hidden');
                document.body.classList.add('max-h-[100vh]', 'overflow-hidden');
                requestAnimationFrame(() => {
                    modals.classList.add('opacity-100');
                });
            });
        } else {
            buttons.disabled = true;
            requestAnimationFrame(() => {
                modals.classList.remove('opacity-100');
                document.body.classList.remove('max-h-[100vh]', 'overflow-hidden');
                requestAnimationFrame(() => {
                    modals.classList.add('hidden');
                });
            });
        }
    }
    </script>
</body>

</html>