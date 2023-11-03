<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Apotek | Produk</title>
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
                <button onclick=""
                    class="flex justify-start items-center rounded-3xl shadow-md h-[40px] px-3 text-center text-lg font-semibold">
                    <i class="pe-2">icon</i>
                    Kembali</button>
            </div>

            <p class="py-7 text-sm text-red-500">*Jumlah maksimum barang 30</p>

            <div class="md:flex md:grid-cols-2 justify-between">
                <p class="font-semibold text-2xl mb-3">Keranjang anda</p>
                <button onclick="" class="rounded-lg border border-mainColor flex p-3">
                    <i class="pe-3">icon</i>
                    <p class="text-mainColor">Kosongkan keranjang</p>
                </button>
            </div>

            {{-- table --}}
            <div class="shadow-lg rounded-lg w-full h-fit my-7">
                <div class="overflow-x-auto p-5">
                    <table class="w-full">
                        <thead class="bg-white">
                            <tr>
                                <th scope="col">Produk</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Harga</th>
                            </tr>
                        </thead>

                        <tbody class="border-t">
                            <tr>
                                <th scope="row">
                                    <div class="sm:flex sm:grid-cols-3 gap-4 justify-center">
                                        <i class="w-1/4 text-start">icon</i>
                                        <div class="w-1/4">
                                            <img src="{{asset('img/obat1.jpg/')}}" alt="" class="w-[50px]">
                                        </div>
                                        <div class="2/4">
                                        <p>tes</p>
                                        <p>tes</p>
                                        <p>tes</p>
                                        <p>tes</p>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="sm:flex sm:grid-cols-3 gap-4 justify-center">
                                        <i class="">icon</i>
                                        <p class="mx-2">3</p>
                                        <i class="">icon</i>
                                    </div>
                                </th>
                                <th>
                                    <p class="font-semibold text-lg">Rp 50.000</p>
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <p class="text-end font-semibold">
                Total harga : <span class="text-lg">Rp 50.000</span></p>

            <div class="flex justify-end items-end my-3">
                <a href="" class="p-2 px-7 rounded-lg shadow-lg text-white font-semibold bg-orange-400">Booking</a>
            </div>
        </div>
    </div>

    @include('user.components.footer')
</body>

</html>