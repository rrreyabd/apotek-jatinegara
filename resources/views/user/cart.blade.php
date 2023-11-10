<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Apotek | Keranjang</title>
    @vite('resources/css/app.css')

    {{-- FONT AWESOME --}}
    <script src="https://kit.fontawesome.com/e87c4faa10.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1fc4ea1c6a.js" crossorigin="anonymous"></script>
</head>

<body class="font-Trip">
    @include('user.components.secondNavbar')

    <div class="flex flex-col items-center mb-8">

        <div class="w-[70vw] mt-8 flex flex-col">
            <div class="flex gap-4">
                {{-- back button --}}
                <button onclick=""
                    class="flex justify-start items-center rounded-3xl shadow-md h-[40px] px-3 text-center text-lg text-gray-500 font-semibold">
                    <svg xmlns="http://www.w3.org/2000/svg" class="pe-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M9 14l-4 -4l4 -4"></path>
                        <path d="M5 10h11a4 4 0 1 1 0 8h-1"></path>
                     </svg>
                    Kembali</button>
            </div>

            <p class="py-7 text-sm text-red-500">*Jumlah maksimum barang 30</p>

            <div class="md:flex md:grid-cols-2 justify-between">
                <p class="font-semibold text-2xl mb-3">Keranjang anda</p>
                <button onclick="" class="rounded-lg flex p-2 border border-mainColor hover:bg-mainColor text-mainColor hover:text-white">
                    <i class="fa-regular fa-trash-can p-1 pe-2"></i>  
                    <p>Kosongkan keranjang</p>
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
                                    <div class="sm:flex sm:grid-cols-3 gap-4 justify-center my-5">
                                        <i class="fa-solid fa-trash w-1/4 text-start my-auto" style="color: darkGrey"></i>
                                        <div class="w-1/4">
                                            <img src="{{asset('img/obat1.jpg/')}}" alt="" class="w-[100px]">
                                        </div>
                                        <div class="2/4 text-sm text-start">
                                            <span
                                                class="bg-red-500 rounded-md px-2 py-1 text-white">Resep</span>
                                            <p class="font-semibold my-1 mt-3">Paracetamol 500 mg 10 tablet</p>
                                           <p class="font-light">Kategori : Obat Demam</p> 
                                           <p class="font-light">Exp : 12 Oktober 2023</p> 
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="sm:flex sm:grid-cols-3 gap-4 justify-center">

                                        <button class="inline-flex items-center justify-center p-3.5 rounded-lg shadow-lg text-sm font-medium h-6 w-6 text-gray-500 bg-white border border-gray-300 focus:ring-2 focus:ring-mainColor focus:ring-opacity-25" type="button">
                                            <i class="fa-solid fa-minus"></i>
                                        </button>
                                        <div>
                                            <input type="number" class="w-10 px-1 py-1 m-0" placeholder="1">
                                        </div>
                                        <button class="inline-flex items-center justify-center h-6 w-6 p-3.5 rounded-lg shadow-lg text-sm font-medium text-white bg-mainColor border border-gray-300 focus:ring-2 focus:ring-mainColor focus:ring-opacity-25" type="button">
                                            <i class="fa-solid fa-plus"></i>
                                        </button>

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
                <a href="" class="p-2 px-7 rounded-lg shadow-lg text-white font-semibold bg-secondaryColor hover:bg-orange-400">Booking</a>
            </div>
        </div>
    </div>

    @include('user.components.footer')
</body>

</html>