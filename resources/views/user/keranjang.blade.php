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
</head>

<body class="font-Trip">
    @include('user.components.navbar')

    <div class="flex flex-col items-center mb-8">

        <div class="w-[70vw] mt-8 flex flex-col">
            <div class="flex gap-4">
                {{-- back button --}}
                <a href="/"
                    class="flex justify-start items-center rounded-3xl shadow-md h-[40px] px-3 text-center text-lg text-gray-500 font-semibold">
                    <svg xmlns="http://www.w3.org/2000/svg" class="pe-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M9 14l-4 -4l4 -4"></path>
                        <path d="M5 10h11a4 4 0 1 1 0 8h-1"></path>
                    </svg>
                    Kembali</a>
            </div>

            <p class="py-7 text-sm text-red-500">*Jumlah maksimum barang 30</p>

            <div class="md:flex md:grid-cols-2 justify-between">
                <p class="font-semibold text-2xl mb-3">Keranjang anda</p>
                <form action="/keranjang/hapus" method="POST">
                    @csrf
                    <input type="hidden" name="hapus" value="semua">
                    <button type="submit" class="rounded-lg flex p-2 border border-mainColor hover:bg-mainColor text-mainColor hover:text-white">
                    <i class="fa-regular fa-trash-can p-1 pe-2"></i>  
                    Kosongkan keranjang</button>
                </form>
            </div>

            {{-- table --}}
            <div class="shadow-lg rounded-lg w-full h-fit my-7">
                <div class="overflow-x-auto p-5">
                    <table class="w-full">
                        <thead class="bg-white">
                            <tr>
                                <th></th>
                                <th scope="col">Produk</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Total</th>
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
                                <th scope="row" class="w-1/3">
                                    <div class="sm:flex sm:grid-cols-3 gap-4 justify-center my-5">
                                        <div class="w-1/4">
                                            <img src="{{asset('img/obat1.jpg/')}}" alt="" class="w-[100px]">
                                        </div>
                                        <div class="w-1/2 text-sm text-start">
                                            @if ($cart->product->description->product_type == "resep dokter")
                                            <span class="bg-red-500 rounded-md px-2 py-1 text-white">Resep</span>
                                            @endif
                                            <p class="font-semibold my-1 mt-3 text-wrap">{{ $cart->product->product_name }}</p>
                                            <p class="font-light">Kategori : {{ $cart->product->description->category->category }}</p> 
                                            <p class="font-light">Exp : {{ date('d M Y',strtotime($cart->product->detail()->orderBy('product_expired')->first()->product_expired)) }}</p> 
                                        </div>
                                    </div>
                                </th>
                                <th scope="row" class="w-1/12">
                                    <p class="font-semibold text-lg">Rp {{ number_format($cart->product->detail()->orderBy('product_expired')->first()->product_sell_price , 0, ',', '.') }}</p>
                                </th>
                                <th>
                                    <div class="sm:flex sm:grid-cols-3 gap-4 justify-center">
                                        <livewire:count-product-cart :price="$cart->product->detail()->orderBy('product_expired')->first()->product_sell_price" :cart="$cart->cart_id" :stock="$cart->product->detail()->orderBy('product_expired')->first()->product_stock" :quantity="$cart->quantity" :keranjang="true"/>
                                        </div>
                                    </th>
                                    <th>
                                        <livewire:product-price-cart :cart="$cart->cart_id" :price="$cart->product->detail()->orderBy('product_expired')->first()->product_sell_price" :quantity="$cart->quantity"/>
                                        </th>
                                    </tr>
                                @php
                                $jumlah += $cart->product->detail()->orderBy('product_expired')->first()->product_sell_price * $cart->quantity
                                @endphp
                            @endforeach
                            @endisset
                        </tbody>
                    </table>
                </div>
            </div>

            @isset($cart)
                <livewire:product-total-price :user="$cart->user_id" :total="$jumlah" />
            @endisset

            <div class="flex justify-end items-end my-3 me-10">
                <a href="/booking" class="p-2 px-7 rounded-lg shadow-lg text-white font-semibold bg-secondaryColor hover:bg-orange-400">Booking</a>
            </div>
        </div>
    </div>

    @include('user.components.footer')
    @livewireScripts
</body>

</html>